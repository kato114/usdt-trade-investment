<?php

namespace App\Providers;

use App\Account;
use App\Attachment;
use App\Client;
use App\File;
use App\Message;
use App\SupportTicket;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require app_path("Foundation/Utils/helpers.php");
        Schema::defaultStringLength(191);
        $models = [Client::class, Account::class, User::class, SupportTicket::class, Message::class, File::class, Attachment::class];
        $map = [];

        foreach ($models as $a) {
            $map[class_basename($a)] = $a;
        }

        Relation::morphMap($map);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('icon', function ($expression) {
            return "<?php echo paste_icon($expression); ?>";
        });
        
        \Debugbar::disable();
    }
}
