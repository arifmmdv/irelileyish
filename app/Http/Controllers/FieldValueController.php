<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldValueRequest;
use App\Http\Requests\UpdateFieldValueRequest;
use App\Models\FieldValue;

class FieldValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFieldValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFieldValueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function show(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function edit(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFieldValueRequest  $request
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFieldValueRequest $request, FieldValue $fieldValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FieldValue  $fieldValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(FieldValue $fieldValue)
    {
        //
    }
}
