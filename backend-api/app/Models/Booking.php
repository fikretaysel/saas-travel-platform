<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'agency_id',
        'customer_id',
        'booking_reference',
        'provider',
        'origin',
        'destination',
        'departure_date',
        'return_date',
        'price',
        'currency',
        'status',
    ];

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
    public function agency(): BelongsTo{
        return $this->belongsTo(Agency::class);
    }


}
