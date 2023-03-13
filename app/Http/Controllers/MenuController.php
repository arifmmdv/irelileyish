<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\Navigation;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $nav =  Menu::where();
        return view('dashboard.menus.index')->with("menus",$menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $navigation =  Navigation::find($id);
        return view('dashboard.menus.create',compact('navigation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = new Menu;
        $menu->title = $request->input('title');
        $menu->slug = $request->input('slug');
        $menu->external = $request->input('external');
        $menu->parent_id = $request->input('parent_id');
        $menu->navigation_id = $request->input('navigation_id');
        $menu->save();

        if ($menu->parent_id != 0) {
            return redirect('/dashboard/menus/'.$request->input('parent_id').'/edit')->with('success', 'Menu created!');
        } else {
            return redirect('/dashboard/navigations/'.$menu->navigation_id.'/edit')->with('success', 'Menu created!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $parent_id = $menu->id;
        $navigation_id = $menu->navigation_id;
        $menus = $menu->children;
        return view('dashboard.menus.edit',compact('menu','parent_id','navigation_id','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->title = $request->input('title');
        $menu->slug = $request->input('slug');
        $menu->external = $request->input('external');
        $menu->save();

        return redirect('/dashboard/menus/'.$menu->id.'/edit')->with('success', 'Menu updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back()->with('success', 'Menu Removed!');
    }
}
