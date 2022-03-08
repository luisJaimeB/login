<?php

namespace App\Providers;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("*", function($view){
            $sessionName = 'shoppingCartId';
            $shoppingCartId = Session::get($sessionName);
            $shoppingCart = ShoppingCart::finOrCreateBySessionId($shoppingCartId);
            Session::put($sessionName, $shoppingCart->id);
            $view->with('shoppingCart', $shoppingCart);
        });
    }
}
