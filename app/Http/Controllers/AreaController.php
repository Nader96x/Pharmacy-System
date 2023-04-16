<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\AddAreaRequest;
use App\Models\Area;
use App\Models\Country;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.areas.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAreaRequest $request)
    {
        $area = Area::create($request->all());
        if($area){
            return redirect()->route('areas.index')->with('success','Area created successfully!');
        }else{
            return back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        if($area){
            $area->delete();
            return redirect()->route('areas.index')->with('success', 'Area Deleted Successfully');
        }else{
            return back()->with('error', 'Area Not Found');
        }
    }
}
