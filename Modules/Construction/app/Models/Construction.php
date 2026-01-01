<?php

namespace Modules\Construction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Construction\Database\Factories\ConstructionFactory;
use Modules\Company\Models\Company;
class Construction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ConstructionFactory
    // {
    //     // return ConstructionFactory::new();
    // }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
