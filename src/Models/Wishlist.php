<?php

namespace LamaLama\Wishlist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $guarded = [];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
