<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Document extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "documents";
    protected $fillable = ['document_type_id', 'value'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

}
