<?php

namespace LamaLama\Wishlist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Wishlist extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wishlist';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the owning wishlistable model.
     */
    public function wishlistable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the wish.
     */
    public function wishes(): belongsTo
    {
        return $this->belongsTo(config('wishlist.user_model'));
    }
}
