<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "addresses";
    protected $fillable = [
        'street',
        'number',
        'apartment',
        'city_id',
        'is_principal',
        'addressable_id',
        'addressable_type',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function scopePrincipal($query)
    {
        return $query->where('is_principal', true);
    }
}
