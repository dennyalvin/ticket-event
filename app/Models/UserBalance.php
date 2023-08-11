<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBalance extends Model
{
    public const TRX_TYPE_ORDER = 'order_event';

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
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

    public function getCreditFormattedAttribute() {
        return number_format($this->credit,0);
    }

    public function getDebitFormattedAttribute() {
        return number_format($this->debit,0);
    }
}
