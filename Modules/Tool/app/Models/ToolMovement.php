<?php

namespace Modules\Tool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Models\Location;
class ToolMovement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tool_movements';

    protected $fillable = [
        'tool_id',
        'from_location_id',
        'to_location_id',
        'quantity',
        'movement_type_id',
        'moved_at',
    ];


    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }

    public function movementType()
    {
        return $this->belongsTo(MovementType::class);
    }

}