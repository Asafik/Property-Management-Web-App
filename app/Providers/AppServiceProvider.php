<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $storagePaths = [
            storage_path('framework/views'),
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('logs'),
        ];

        foreach ($storagePaths as $path) {
            if (!is_dir($path)) {
                @mkdir($path, 0755, true);
            }
        }

        if (file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         View::composer('*', function ($view) {

        if(auth()->check()){

            $notifications = auth()->user()->unreadNotifications;

            $view->with('notifications', $notifications);
            $view->with('countNotif', $notifications->count());

        }else{

            $view->with('notifications', collect());
            $view->with('countNotif', 0);

        }

    });
        Paginator::useBootstrapFive();
        Carbon::setLocale('id'); 
    }
}
