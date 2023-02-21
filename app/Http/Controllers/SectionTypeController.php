<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionTypeRequest;
use App\Http\Requests\UpdateSectionTypeRequest;
use App\Models\SectionType;
use App\Models\Language;
use Illuminate\Support\Str;

class SectionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectionTypes =  SectionType::all();
        return view('dashboard.section-types.index')->with("sectionTypes",$sectionTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.section-types.create');
    }

    public function createSection($id)
    {
        $languages =  Language::where('active',1)->get();
        $sectionType = SectionType::find($id);
        return view('dashboard.sections.create', compact('sectionType','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSectionTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionTypeRequest $request)
    {
        $sectionType = new SectionType;
        $sectionType->title = $request->input('title');
        $sectionType->singular = $request->input('singular');
        $sectionType->plural = $request->input('plural');
        $sectionType->slug = Str::slug($request->input('plural'),'-');
        $sectionType->save();

        return redirect('/dashboard/section-types/')->with('success', 'Section Type created!');
    }

    public function show(SectionType $sectionType)
    {
        return view('dashboard.section-types.show', compact('sectionType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    public function edit(SectionType $sectionType)
    {
        return view('dashboard.section-types.edit')->with('sectionType', $sectionType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionTypeRequest  $request
     * @param  \App\Models\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionTypeRequest $request, SectionType $sectionType)
    {
        $sectionType->title = $request->input('title');
        $sectionType->singular = $request->input('singular');
        $sectionType->plural = $request->input('plural');
        $sectionType->save();

        return redirect('/dashboard/section-types/')->with('success', 'Section Type updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionType  $sectionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionType $sectionType)
    {
        $sectionType->delete();
        return redirect('/dashboard/section-types/')->with('success', 'Section Type Removed!');
    }
}
