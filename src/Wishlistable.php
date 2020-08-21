<?php

namespace LamaLama\Wishlist;

use Auth;
use DB;

trait Wishlistable
{
    /**
     * Get all of the wishes for the model.
     */
    public function wishes()
    {
        return $this->morphToMany('App\Models\User', 'model', 'wishlist');
    }

    /**
     * isWished.
     */
    public function isWished()
    {
        return DB::table('wishlist')
            ->where('user_id', Auth::id())
            ->where('model_type', get_class($this))
            ->where('model_id', $this->id)
            ->first();
    }
}
