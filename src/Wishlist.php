<?php

namespace LamaLama\Wishlist;

use Auth;
use DB;

class Wishlist
{
    /**
     * getCount.
     * @return int
     */
    public function getCount(): int
    {
        return DB::table('wishlist')
            ->where('user_id', Auth::id())
            ->count();
    }
}
