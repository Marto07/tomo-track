<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class LocationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'location_types';
    protected $fillable = ['name', 'description'];

}
