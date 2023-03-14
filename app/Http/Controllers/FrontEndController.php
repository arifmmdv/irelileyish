<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class FrontEndController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function page($slug) {
        $page = Section::where('parent_id',0)->where('slug',$slug)->firstOrFail();
        return view("templates.{$page->template->name}",compact(['page']));
    }

    public function child($parent, $slug) {
        $fields = [];
        $children = [];

        $page = Section::where('parent_id','!=',0)->where('slug',$slug)->firstOrFail();
        foreach ($page->template->fields as $field) {
            $fields[$field->slug] = $field->value($page->id,'az');
        }

        foreach ($page->children as $key => $child) {
            $children[$key]['title'] = $child->title;
            $children[$key]['content'] = $child->content;
            $children[$key]['updated_at'] = $child->updated_at;
            $children[$key]['slug'] = '/'.$page->slug.'/'.$child->slug;
            $children[$key]['status'] = $child->status;
            $children[$key]['image'] = $child->getFirstMediaUrl('images');
            $children[$key]['images'] = $child->getMedia('images');

            foreach ($child->template->fields as $field) {
                $children[$key]['fields'][$field->slug] = $field->value($child->id,'az');
            }
        }
        return view("templates.{$page->template->name}",compact(['page','fields','children']));
    }
}
