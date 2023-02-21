<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use App\Models\Language;
use App\Models\Template;
use App\Models\FieldValue;
use App\Models\Media;
use App\Models\SectionType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Image;

class SectionController extends Controller
{
    private function uniqueSlug($title) {
        $slug = Str::slug($title,'-');
        if(Section::where('slug',$slug)->exists()){
            $count = Section::where('slug','LIKE',"{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            return $newCount > 0 ? "$slug-$newCount" : "$slug";
        }else{
            return "$slug";
        }
    }

    public function index()
    {
        $sections = Section::where('parent_id',0)->get();
        return view('dashboard.sections.index')->with("sections",$sections);
    }

    public function create()
    {
        $sectionType = SectionType::find(1);
        $sections = Section::where(['parent_id'=>0])->get();
        $languages =  Language::where('active',1)->get();
        return view('dashboard.sections.create', compact('sections','languages','sectionType'));
    }

    public function createSub($id)
    {
        $languages =  Language::where('active',1)->get();
        $section = Section::find($id);
        $sectionType = SectionType::find($section->section_type_id);
        return view('dashboard.sections.create', compact('section','languages','sectionType'));
    }

    public function store(StoreSectionRequest $request)
    {
        $parent_section = Section::find($request->input('parent_id'));
        $languages =  Language::where('active',1)->get();

        $section = new Section;

        foreach ($languages as $language){
            $section->setTranslation('title', $language->locale, $request->input("title_{$language->locale}"));
            $section->setTranslation('content', $language->locale, $request->input("content_{$language->locale}"));
        }

        $section->parent_id = $request->input('parent_id');
        $section->section_type_id = $request->input('section_type_id');
        $section->slug = $this->uniqueSlug($request->input("title_en"));

        if(!empty($parent_section->sub_sections_template)){
            $section->template_id = $parent_section->sub_sections_template;
        }

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = Str::slug($filename, '-');
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('image')->storeAs('sections', $fileNameToStore);
            $section->image = $fileNameToStore;
        }

        $section->save();

        return redirect('/dashboard/sections/'.$section->id.'/edit')->with('success', 'Section created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('dashboard.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $languages =  Language::all();
        $templates = Template::all();
        return view('dashboard.sections.edit', compact('section','languages','templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $languages =  Language::all();
        $title = [];
        $content = [];
        $seo_title = [];
        $seo_desc = [];
        foreach ($languages as $language){
            $title[$language->locale] = $request->input("title_".$language->locale);
            $content[$language->locale] = htmlspecialchars($request->input("content_".$language->locale));
            $seo_title[$language->locale] = $request->input("seo_title_".$language->locale);
            $seo_desc[$language->locale] = $request->input("seo_description_".$language->locale);
        }
        $section->replaceTranslations('title',$title);
        $section->replaceTranslations('content',$content);
        $section->replaceTranslations('seo_title',$seo_title);
        $section->replaceTranslations('seo_description',$seo_desc);
        $section->template_id = $request->input('template_id');
        $section->sub_sections_template = $request->input('sub_sections_template');
        $section->status = $request->input('status');
        $section->class_name = $request->input('class');

        if($request->hasFile('image')){
					$filenameWithExt = $request->file('image')->getClientOriginalName();
					$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
					$extension = $request->file('image')->getClientOriginalExtension();
					$filename = Str::slug($filename, '-');
					$fileNameToStore = $filename.'_'.time().'.'.$extension;

					$section->addMedia($request->file('image'))
						->usingFileName($fileNameToStore)
						->toMediaCollection('main');
        }

        $section->save();

        // Save Fields
        if(isset($section->template->fields)) {
					foreach ($section->template->fields as $field) {
						if($field->field_type == 3) {
							// Upload Image

							if($request->hasFile("custom_".$field->slug)){
								$filenameWithExt = $request->file("custom_".$field->slug)->getClientOriginalName();
								$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
								$extension = $request->file("custom_".$field->slug)->getClientOriginalExtension();
								$filename = Str::slug($filename, '-');
								$fileNameToStore = $filename.'_'.time().'.'.$extension;
								
								$field->addMedia($request->file("custom_".$field->slug))
									->usingFileName($fileNameToStore)
									->toMediaCollection('field');
							}

						} else {
							if (FieldValue::where(['section_id' => $section->id, 'field_id' => $field->id])->exists()) {
								$fieldValue = FieldValue::where(['section_id' => $section->id, 'field_id' => $field->id])->first();
							} else {
								$fieldValue = new FieldValue;
								$fieldValue->field_id = $field->id;
								$fieldValue->section_id = $section->id;
							}
							
							$value = [];
							foreach ($languages as $language){
								$value[$language->locale] = htmlspecialchars($request->input("custom_".$field->slug."_".$language->locale));
							}
							$fieldValue->replaceTranslations(
								'field_value', 
								$value
							);
							$fieldValue->save();	
						}

					}
        }

        return redirect()->back()->with('success', 'Section updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->back()->with('success', 'Section Removed!');
    }

    public function deleteImage ($id) {
        $media = Media::find($id);
        $media->delete();
        return redirect()->back()->with('success', 'Image Removed!');
    }
}
