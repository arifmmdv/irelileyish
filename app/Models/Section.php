<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Section extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasTranslations, InteractsWithMedia;

    public $translatable = ['title','content','seo_title','seo_description'];

    public function template()
    {
        return $this->belongsTo('App\Models\Template');
    }

    public function sectionType()
    {
        return $this->belongsTo('App\Models\SectionType');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Section', 'parent_id','id');
    }

    public function fields()
    {
        return $this->hasMany('App\Models\FieldValue', 'section_id','id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(670)
            ->height(500);
        $this->addMediaConversion('large')
            ->width(1200);
    }
}
