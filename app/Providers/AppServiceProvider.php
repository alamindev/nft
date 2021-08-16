<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $iconlink = Setting::first() ? Setting::first()->favicon : '';
        View::share('iconlink', $iconlink);
        $footertext = Setting::first() ? Setting::first()->copyright : '';
        $footer_menus = Page::where('menu_type', 1)->select('title', 'slug')->get();
        View::share('footertext', $footertext);
        View::share('footer_menus', $footer_menus);

        View::composer(['frontend.partials.header','frontend.auth.login','partials.header'], function ($view) {
            $logoLink = Setting::first() ? Setting::first()->site_logo : '';
            $header_menus = Page::where('menu_type', 0)->select('title', 'slug')->get();
            $view->with('logoLink', $logoLink);
            $view->with('header_menus', $header_menus);
        });


        if (request()->is('admin/*')) {
            ResetPassword::createUrlUsing(function ($user, string $token) {
                return env('APP_URL') . '/admin/reset-password/'.$token.'?email='.$user->email;
            });
        }else{
            ResetPassword::createUrlUsing(function ($user, string $token) {
                return env('APP_URL') . '/reset-password/'.$token.'?email='.$user->email;
            });
        }
    }
}
