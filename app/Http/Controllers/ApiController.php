<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\SectionType;
use App\Models\Field;
use App\Models\FieldValue;
use Illuminate\Support\Facades\App;
use App\Http\Resources\SectionCollection;

class ApiController extends Controller
{

    public function sections($locale, $slug) {
        App::setLocale($locale);

        $sectionType = SectionType::where('slug',$slug)->first();
        $pages = Section::where(['section_type_id'=>$sectionType->id,'parent_id'=>0])->get();
        $sections = [];
        foreach ($pages as $section) {

            $newFields = [];
            $newSection['slug'] = $section->slug;
            $newSection['image'] = $section->getFirstMediaUrl('main');
            $newSection['title'] = $section->title;
            $newSection['content'] = $section->content;
            $newSection['seoTitle'] = $section->seo_title;
            $newSection['seoDescription'] = $section->seo_description;

            $fields = FieldValue::where('section_id',$section->id)->with('field')->get();
            foreach ($fields as $field) {
                if ($field->field->field_type == 3) {
                    $newFields[$field->field->slug] = $field->field->getFirstMediaUrl('field');
                } else {
                    $newFields[$field->field->slug] = $field->field_value;
                }
            }
            $newSection['custom_fields'] = $newFields;
            $sections[$section->slug] = $newSection;
        }

        return response()->json($sections);
    }

    public function children($locale, $slug) {
        App::setLocale($locale);

        $page = Section::where('slug',$slug)->first();
        $sections = [];
        foreach ($page->children as $section) {

            $newFields = [];
            $newSection['slug'] = $section->slug;
            $newSection['image'] = $section->getFirstMediaUrl('main');
            $newSection['title'] = $section->title;
            $newSection['content'] = $section->content;
            $newSection['seoTitle'] = $section->seo_title;
            $newSection['seoDescription'] = $section->seo_description;

            $fields = FieldValue::where('section_id',$section->id)->with('field')->get();
            foreach ($fields as $field) {
                if ($field->field->field_type == 3) {
                    $newFields[$field->field->slug] = $field->field->getFirstMediaUrl('field');
                } else {
                    $newFields[$field->field->slug] = $field->field_value;
                }
            }
            $newSection['custom_fields'] = $newFields;
            $sections[$section->slug] = $newSection;
        }

        return response()->json($sections);
    }

    public function section($locale, $slug) {

        App::setLocale($locale);

        $section = Section::where('slug',$slug)->first();
        $fields = FieldValue::where('section_id',$section->id)->with('field')->get();

        $newFields = []; //
        $newSection = []; //
        foreach ($fields as $field) {
            if ($field->field->field_type === 3) {
                $newFields[$field->field->slug] = $field->field->getFirstMediaUrl('field');
            } else {
                $newFields[$field->field->slug] = $field->field_value;
            }
        }

        $newSection['slug'] = $section->slug;
        $newSection['image'] = $section->getFirstMediaUrl('main');
        $newSection['title'] = $section->title;
        $newSection['content'] = $section->content;
        $newSection['seoTitle'] = $section->seo_title;
        $newSection['seoDescription'] = $section->seo_description;
        $newSection['custom_fields'] = $newFields;

        return response()->json($newSection);
    }
}
