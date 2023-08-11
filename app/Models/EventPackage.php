<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPackage extends Model
{
    use HasFactory;
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getTotalAmountAttribute() {
        return $this->price + $this->tax;
    }

    public function getPriceFormattedAttribute() {
        return number_format($this->price,0);
    }

    public function getTaxFormattedAttribute(){
        return number_format($this->tax, 0);
    }

    public function getTotalAmountFormattedAttribute(){
        return number_format($this->price + $this->tax, 0);
    }
}
