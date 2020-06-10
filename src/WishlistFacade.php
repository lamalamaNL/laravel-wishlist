<?php

namespace LamaLama\Wishlist;

use Illuminate\Support\Facades\Facade;

class WishlistFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wishlist';
    }
}
