<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldValue;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Field extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function template()
    {
        return $this->belongsTo('App\Models\Template');
    }

    public function values()
    {
        return $this->hasMany('App\Models\FieldValue');
    }

    public function value($id, $locale) {
    
        if (FieldValue::where(['section_id' => $id, 'field_id' => $this->id])->exists()) {
            $fieldValue = FieldValue::where(['section_id' => $id, 'field_id' => $this->id])->first();
            return $fieldValue->getTranslation('field_value', $locale);
        } else {
            return "";
        }

    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('field')->singleFile();
    }
}
