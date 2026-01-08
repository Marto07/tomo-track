<?php

namespace Modules\Construction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class ConstructionType extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'description',
    ];

    public function constructions()
    {
        return $this->hasMany(Construction::class);
    }
}
