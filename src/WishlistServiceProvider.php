<?php

namespace LamaLama\Wishlist;

use Illuminate\Support\ServiceProvider;
use LamaLama\Wishlist\Wishlist;

class WishlistServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('wishlist', function () {
            return new Wishlist();
        });
    }
}
