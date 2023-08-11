<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    public function promoter(): BelongsTo
    {
        return $this->belongsTo(Promoter::class);
    }

    public function order(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(EventGallery::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(EventPackage::class);
    }

    public function cheapest()
    {
        return $this->hasOne('App\Models\EventPackage')->orderBy('price', 'asc');
    }

    public function getDateFormatedAttribute()
    {
        if (!empty($this->date_on)) {
            $d = Carbon::parse($this->date_on);
            return $d->format('M, d Y');
        } else {
            return null;
        }
    }
}
