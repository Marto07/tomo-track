<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\Address;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'description',
        'street', 
        'apartment',
        'number',
        'city_id',
        'location_type_id'
    ];

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function locationType()
    {
        return $this->belongsTo(LocationType::class);
    }

    public function city()
    {
        return $this->belongsTo(\Modules\Core\Models\City::class);
    }
}
