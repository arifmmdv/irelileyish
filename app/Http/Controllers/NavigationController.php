<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNavigationRequest;
use App\Http\Requests\UpdateNavigationRequest;
use App\Models\Navigation;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigations =  Navigation::all();
        return view('dashboard.navigations.index')->with("navigations",$navigations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.navigations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNavigationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNavigationRequest $request)
    {
        $navigation = new Navigation;
        $navigation->title = $request->input('title');
        $navigation->save();

        return redirect('/dashboard/navigations/')->with('success', 'Navigation created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Navigation $navigation)
    {
        return view('dashboard.navigations.edit')->with('navigation', $navigation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNavigationRequest  $request
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNavigationRequest $request, Navigation $navigation)
    {
        $navigation->title = $request->input('title');
        $navigation->save();

        return redirect('/dashboard/navigations/')->with('success', 'Navigation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navigation $navigation)
    {
        $navigation->delete();
        return redirect('/dashboard/navigations/')->with('success', 'Navigation Removed!');
    }
}
