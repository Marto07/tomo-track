<?php

namespace Modules\Tool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class MovementType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'movement_types';
    protected $fillable = [
        'name'
    ];

    public function toolMovements()
    {
        return $this->hasMany(ToolMovement::class);
    }
}
