<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Client;
use App\File;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Mail\MailMessage;
use App\Notifications\AccountConfirmation;
use App\Notifications\AccountPasswordReset;
use App\Notifications\AdminNomination;
use App\Notifications\PendingInvoice;
use App\Notifications\AccountRejected;
use App\Photo;
use App\Registration;
use App\Request;
use App\Server;
use App\User;
use DB;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use League\ISO3166\ISO3166;
use function request;

class SupportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($action = null)
    {
        switch ($action) {
            case 'users':
                return $this->users();
            case 'accounts':
                return $this->accountBox();
            case 'requests':
                return $this->requests();
            case 'clients':
                return $this->accounts();
            default:
                return redirect(route('support', ['section' => 'users']));
        }
    }

    private function accountBox()
    {
        $account = Account::query()->findOrNew(request('account_id'));
        if (request()->isMethod('post')) {
            if (request('action') == 'delete') {
                $account->delete();
                $message = 'Deleted';
            } else {
                $rules = [
                    'name' => 'required',
                    'cookie' => 'required',
                    'account' => 'required',
                    'mind_antiddos_'=>'required',
                ];

                request()->validate($rules);

                DB::beginTransaction();
                $account->fill(request()->only('name', 'cookie', 'account','mind_antiddos_'));
                $account->save();


                if ($account->wasRecentlyCreated) {
                    $message = sprintf('Account [%s] has been created.', $account->name);
                } else {
                    $message = sprintf('Account [%s] has been updated.', $account->name);
                }

                DB::commit();
            }
            return redirect(route('support', ['section' => 'accounts']))->with('message', $message);
        } else if (request()->isMethod('GET')) {
            if (request('action') == 'edit') {
                return view('admin/accounts', compact('account'));
            } else {
                if (request('action') == 'default') {
                    cache()->forever('default_wallet', $account->id);
                }
                $accounts = Account::query()->get();
                return view('admin/accounts', compact('accounts', 'account'));
            }
        }
    }

    private function users()
    {
        $countries = collect((new ISO3166())->all())->map(function ($e) {
            return (object) $e;
        });
        $user = User::query()->findOrNew(request('user'));
        if (request()->isMethod('post')) {
         //   die(print_r('this '));
            
            if (request('action') == 'delete') {
                $user->delete();
                $message = 'Deleted';
            }
            else if (request('action') == 'reset_password') {
                $password = request('password');
                $user->password = bcrypt($password);
                $user->save();
                $user->notify(new AccountPasswordReset($password));
                $message = 'Password Reset';
                session()->put("success", "$message");
            }
            else {
                // chandan code start
				if (!request()->hasFile('image')) {
				    
                
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,id,' . $user->id,
                    'status' => 'required',
                ];

                request()->validate($rules);

                DB::beginTransaction();
                $user->fill(request()->only('name', 'status', 'email', 'acting_role'));
                  $user->user_mail = request()->has('user_mail');
                $password = Str::random(6);
                $user->password = bcrypt($password);
                $user->save();

                if (request('status') == 'suspended') {
                    cache()->forever('logout_' . $user->id, true);
                }

                if ($user->wasRecentlyCreated) {
                    $user->notify(new VerifyEmail());
                    $user->notify(new AdminNomination($password));
                    $message = sprintf('User [%s] has been created.', $user->name);
                } else {
                    $message = sprintf('User [%s] has been updated.', $user->name);
                }
				}
				else
				{
				    
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,id,' . $user->id,
                    'status' => 'required',
                ];

                request()->validate($rules);

                DB::beginTransaction();
                	// file save code start
				   $file = File::from(request()->file('image'), 'images');
            $photo = new Photo();
            $photo->file()->associate($file);
            $photo->profile_type = class_basename($user);
            $photo->profile_id = $user->id;

            $user->photos()->get()->map(function ($e) {
                $e->delete();
            });

            $user->photos()->save($photo);
				
				// file save code ends
                $user->fill(request()->only('name', 'status', 'email', 'acting_role'));
                 $user->user_mail = request()->has('user_mail');
                $password = Str::random(6);
                $user->password = bcrypt($password);
                $user->save();

                if (request('status') == 'suspended') {
                    cache()->forever('logout_' . $user->id, true);
                }

                if ($user->wasRecentlyCreated) {
                    $user->notify(new VerifyEmail());
                    $user->notify(new AdminNomination($password));
                    $message = sprintf('User [%s] has been created.', $user->name);
                } else {
                    $message = sprintf('User [%s] has been updated.', $user->name);
                }  
				}
                DB::commit();
            }
            return redirect(route('support', ['section' => 'users']))->with('message', $message);
        } else if (request()->isMethod('GET')) {
            if (request('action') == 'edit') {
                return view('admin/users', compact('user', 'user', 'countries'));
            } else {
                $users = User::query()->get();
                return view('admin/users', compact('users', 'user', 'countries'));
            }
        }
    }

    private function requests()
    {
        $registration = Registration::query()->findOrNew(request('request'));
        if (request()->isMethod('GET')) {
            if (request()->has('action')) {
                if (request('action') == 'reject') {
                    $registration->status = 'rejected';
                    $registration->save();
                    $message = 'Deleted';
                    $registration->notify(new AccountRejected($registration, 'incomplete details'));
                } else if (request('action') == 'dismiss') {
                    $registration->status = 'dismissed';
                    $registration->save();
                    $message = 'Dismissed';
                } else {
                    DB::beginTransaction();
                    if (Client::query()->where('email', $registration->email)->exists()) {
                        return redirect(route('support', ['action' => 'requests']))->withError('A client with the same email address exists');
                    } else {
                        $transaction = $registration->apply();
                        $message = sprintf('Request [%s] has been updated.', $registration->name);
                        $registration->notify(new AccountConfirmation($transaction));
                        $registration->status = 'approved';
                        $registration->save();
                    }
                    DB::commit();
                }
                return redirect(route('support', ['section' => 'requests']))->with('message', $message);
            }
            $registrations = Registration::query()->where('status', request('status', 'pending'))->get();
            return view('admin/registrations', compact('registrations'));
        }
    }

    private function accounts()
    {
        $countries = collect((new ISO3166())->all())->map(function ($e) {
            return (object) $e;
        });
        $client = Client::query()->findOrNew(request('client'));
        if (request()->isMethod('post')) {
            if (request('action') == 'delete') {
                $client->delete();
                $message = 'Deleted';
            } else if (request('action') == 'reset_password') {
                $password = request('password');
                $client->password = bcrypt($password);
                $client->save();
                $client->notify(new AccountPasswordReset($password));
                $message = 'Password Reset';
                \session()->put("success", "$message");
            } else {
                try {
                    DB::beginTransaction();
                    if (request()->hasFile('image')) {
                        $file = File::from(request()->file('image'), 'images');
                        $photo = new Photo();
                        $photo->file()->associate($file);
                        $photo->profile_type = class_basename($client);
                        $photo->profile_id = $client->id;

                        $client->photos()->get()->map(function ($e) {
                            $e->delete();
                        });

                        $client->photos()->save($photo);
                        $message = sprintf('Client [%s] has been updated.', $client->name);
                    } else {


                        $rules = [
                            'name' => 'required',
                            'email' => 'required|email|unique:clients,id,' . $client->id,
                            'status' => 'required',
                        ];

                        request()->validate($rules);


                        $client->fill(request()->only('name', 'status', 'account_id', 'user_id', 'commission', 'email', 'notes'));
                        if (request('status') == 'suspended') {
                            cache()->forever('logout_' . $client->id, true);
                        }
                        $client->client_deposit_total = request()->has('client_deposit_total');
                        $client->client_mail = request()->has('client_mail');
                        if (!$client->exists) {
                            $password = Str::random(6);
                            $client->password = bcrypt($password);
                            $client->save();
                            $client->notify(new VerifyEmail());
                            $client->notify(new AccountConfirmation($password));
                            $message = sprintf('Client [%s] has been created.', $client->name);
                        } else {
                            $client->save();
                            $message = sprintf('Client [%s] has been updated.', $client->name);
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }
            return redirect(route('support', ['section' => 'clients']))->withSuccess($message);
        } else if (request()->isMethod('GET')) {
            if (request('action') == 'edit') {
                return view('admin/clients', compact('client', 'countries'));
            } else {
                $clients = Client::query()->orderBy('name')->get();
                return view('admin/clients', compact('clients', 'client', 'countries'));
            }
        }
    }

    public function mailbox()
    {
       // die(print(request('body')));
        if (request()->has('subject')) {
            //die(print(request('body')));
            $clients = Client::query()
               ->where('client_mail','=','1')->pluck('email')->toArray();
               // die(print_r($clients));
            Mail::bcc($clients)->send(new MailMessage(request('subject'), request('body')));
            Session::put('success', "Messages Sent");
            return redirect()->intended();
        } else {
            if (request()->has('recipients')) {
                $recipients = request('recipients');
                return view('admin.mailbox', compact('recipients'));
            } else {
                $recipients = base64_encode(Client::query()->pluck('email')->toJson());
                return redirect(route('mailbox', compact('recipients')));
            }
        }
    }

    public function commission()
    {
        if (request()->has('account')) {
            $query = ['accounts' => base64_encode(json_encode(request('account')))];
            $query = array_merge($query, request()->except('_token', 'account'));
            return redirect(route('commission', $query));
        }
        $accounts = json_decode(base64_decode(request()->accounts));
        if (request()->isMethod('post')) {
            foreach ($accounts as $id) {
                $rates = json_decode(file_get_contents("http://api.exchangeratesapi.io/latest?base=THB"), true)['rates'];
                $account = Account::query()->findOrFail($id);
                $fx = 1 / request($account->currency, $rates[$account->currency]) * request($account->commission_currency, $rates[$account->commission_currency]);
                $invoice = new Invoice([
                    'profit' => $account->transactions()->whereBetween('closed_at', [request('from'), request('to')])->profit(),
                    'commission' => $account->commission,
                    'commission_fx' => $fx,
                    'commission_currency' => $account->commission_currency,
                    'period_start' => request('from'),
                    'period_end' => request('to')
                ]);
                $account->invoices()->save($invoice);
                $account->client->notify(new PendingInvoice($invoice->id));
            }
            \session()->put("success", "Invoices sent");
            return redirect(route('report'))->with('message', 'Invoices Sent');
        } else {
            $rates = json_decode(file_get_contents("http://api.exchangeratesapi.io/latest?base=THB"), true)['rates'];
            $currencies = Account::query()->select('commission_currency')->distinct()->whereIn('id', $accounts)->pluck('commission_currency');
            $currencies = $currencies
                ->merge(Account::query()->select('currency')->distinct('currency')
                    ->whereIn('id', $accounts)->pluck('currency'))->reject(function ($a) {
                    return $a == "THB";
                })->unique();
            return view('admin.invoices', compact('rates', 'currencies'));
        }
    }
}
