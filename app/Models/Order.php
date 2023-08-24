<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const STATUS_PAID = 'paid';

    public function information(): HasMany
    {
        return $this->hasMany(OrderInformation::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getEventDateFormatedAttribute()
    {
        if (!empty($this->event_date)) {
            $d = Carbon::parse($this->event_date);
            return $d->format('M, d Y');
        } else {
            return null;
        }
    }

    public function getCreatedAtFormattedAttribute()
    {
        if (!empty($this->created_at)) {
            $d = Carbon::parse($this->created_at);
            return $d->format('M, d Y');
        } else {
            return null;
        }
    }

    public function getPriceFormattedAttribute() {
        return number_format($this->price,0);
    }

    public function getTaxFormattedAttribute(){
        return number_format($this->tax, 0);
    }

    public function getTotalAmountFormattedAttribute(){
        return number_format($this->total_amount, 0);
    }
}
