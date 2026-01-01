<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "contacts";

    protected $fillable = [
        'value',
        'contact_type_id',
        'contactable_id',
        'contactable_type',
    ];

    public function contactable()
    {
        return $this->morphTo();
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

}
