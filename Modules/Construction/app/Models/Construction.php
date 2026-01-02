<?php

namespace Modules\Construction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Models\Company;
use Modules\Core\Models\Address;

class Construction extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'code',
        'type',
        'status',
        'start_date',
        'estimated_end_date',
        'actual_end_date',
        'description',
        'budget',
        'progress',
    ];



    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
