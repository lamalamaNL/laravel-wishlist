<?php

namespace LamaLama\Wishlist;

use Auth;
use DB;

trait Wishlistable
{
    public function isWished()
    {
        return DB::table('wishlist')
            ->where('user_id', Auth::id())
            ->where('model_type', get_class($this))
            ->where('model_id', $this->id)
            ->first();
    }
}
