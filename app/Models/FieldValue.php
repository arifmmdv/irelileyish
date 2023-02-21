<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FieldValue extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['field_value'];

    public function field()
    {
        return $this->hasOne('App\Models\Field','id','field_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
}
