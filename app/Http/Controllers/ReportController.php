<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\AdminReports;
use App\Http\Controllers\Reports\CryptoReports;
use App\Http\Controllers\Reports\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use ReflectionClass;

class ReportController extends Controller
{
    use AdminReports, FinancialReport;

    protected $clientReports = ['account_statement', 'account_ftp_statement'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin,client');
    }

    public function report(Request $request, $name = null)
    {
        $class = new ReflectionClass($this);
        $reports = collect($class->getMethods())->reject(function ($method) {
            return !$method->isPrivate();
        })->map(function ($method) {
            $name = implode(' ', preg_split('/(?=[A-Z])/', $method->name));
            return (object)['name' => $method->name, 'title' => $method->name == "clientDepositsByUser" ? "J and J Report" : title_case($name), 'slug' => str_slug($name, '_')];
        })->toArray();
        if (user()->role == 'admin' || user()->role == 'client' && in_array($name, $this->clientReports)) {
            foreach ($reports as $report) {
                if ($report->slug == $name) {
                    return call_user_func_array([$this, $report->name], [$request, $report]);
                }
            }
        } else {
            abort(404, "Nothing here!");
        }

        return view('reports.index', compact('reports'));
    }

    protected function parseDates()
    {
        return [Carbon::parse(request('from'))->startOfDay(), Carbon::parse(request('to', Carbon::now()))->endOfDay()];
    }
}
