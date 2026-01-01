<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Models\Address;
// use Modules\Company\Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Employee\Models\Employee;
use Modules\Tool\Models\Tool;
use Modules\Construction\Models\Construction;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "companies";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'legal_name',
        'tax_id',
        'phone',
        'email',
        'website',
        'status',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function constructions()
    {
        return $this->hasMany(Construction::class);
    }

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }


}
