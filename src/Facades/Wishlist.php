<?php

namespace LamaLama\Wishlist\Facades;

use Illuminate\Support\Facades\Facade;

class Wishlist extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wishlist';
    }
}
