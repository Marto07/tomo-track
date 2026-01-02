<?php

namespace Modules\Tool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class ToolMovement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tool_movements';

    protected $fillable = [
        'tool_id',
        'from_location_id',
        'to_location_id',
        'from_construction_id',
        'to_construction_id',
        'type',
        'moved_at',
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

}
