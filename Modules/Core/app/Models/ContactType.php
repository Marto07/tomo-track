<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "contact_types";
    protected $fillable = ['name'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
 
}
