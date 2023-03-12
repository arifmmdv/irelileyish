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
        return $page->template;
    }

    public function child($parent, $slug) {
        $fields = [];
        $page = Section::where('parent_id','!=',0)->where('slug',$slug)->firstOrFail();
        foreach ($page->template->fields as $field) {
            $fields[$field->slug] = $field->value($page->id,'az');
        }
        return view("templates.{$page->template->name}",compact(['page','fields']));
    }
}
