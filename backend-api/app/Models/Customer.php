<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'agency_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function agency(): BelongsTo{
        return $this->belongsTo(Agency::class);
    }

    public function bookings(): HasMany{
        return $this->hasMany(Booking::class);
    }
}
