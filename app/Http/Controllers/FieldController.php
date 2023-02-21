<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Field;
use App\Models\FieldValue;
use Illuminate\Support\Str;

class FieldController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFieldRequest $request, $id)
    {
        $field = new Field;
        $field->title = $request->input('title');
        $field->field_type = $request->input('field_type');
        $field->template_id = $id;
        $field->slug = Str::slug($request->input('title'),'_');
        $field->save();

        return redirect('/dashboard/templates/'.$id.'/edit')->with('success', 'Field created!');
    }

    public function edit($id)
    {
        $field = Field::find($id);
        return view('dashboard.templates.field')->with('field', $field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFieldRequest  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFieldRequest $request, $id)
    {
        $field = Field::find($id);
        $field->title = $request->input('title');
        $field->slug = Str::slug($request->input('title'),'_');
        $field->save();

        return redirect("/dashboard/templates/$field->template_id/edit")->with('success', 'Field updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();
        foreach ($field->values as $value) {
            $value->delete();
        }
        return redirect()->back()->with('success', 'Field Removed!');
    }
}
