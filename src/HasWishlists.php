<?php

namespace LamaLama\Wishlist;

use Illuminate\Database\Eloquent\Relations\hasMany;
use LamaLama\Wishlist\Models\Wishlist;

trait HasWishlists
{
    /**
     * Get the wishes for the user
     */
    public function wishes()
    {
        return $this->morphedByMany(Wishlist::class, 'model', 'wishlist');
    }

    /**
     * wish
     * @return void
     */
    public function wish($model)
    {
        $this->wishes()->save($model, [
            'collection_name' => config('wishlist.default_list_name')
        ]);
    }

    /**
     * unwish
     * @return void
     */
    public function unwish()
    {
        // Remove wished model from user
    }

    /**
     * wishlists
     * @return void
     */
    public function wishlists()
    {
        // Get all wishlists
    }

    /**
     * wishlist
     * @return void
     */
    public function wishlist()
    {
        // Get a specific wishlist
    }
}
