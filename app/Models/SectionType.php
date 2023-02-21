<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionType extends Model
{
    use HasFactory;

    public function sections()
    {
        return $this->hasMany('App\Models\Section', 'section_type_id','id')->where('parent_id',0);
    }
}
