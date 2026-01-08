<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class LocationAddress extends Model
{
    use HasFactory;

    protected $table = 'location_addresses';
    protected $fillable = [
        'description', 
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
