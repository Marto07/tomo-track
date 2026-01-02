<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class EmployeeMovement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_movements';

    protected $fillable = [
        'employee_id',
        'from_construction_id',
        'to_construction_id',
        'from_location_id',
        'to_location_id',
        'assigned_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
