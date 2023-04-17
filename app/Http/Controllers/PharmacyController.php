<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPharmacies = Pharmacy::withTrashed()->paginate(5);
        return view('pharmacies.index', [
            'pharmacies' => $allPharmacies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $areas = Area::all();
        return view('pharmacies.create',
            compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $allPharmacies = Pharmacy::create($request->all());
        if($allPharmacies){
            return redirect()->route('pharmacies.index')->with('success','Pharmacy created successfully!');
        }else{
            return back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::find($id);
        $areas = Area::all();
        return view('pharmacies.edit', compact( 'pharmacy','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());
        return redirect()->route('pharmacies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pharmacy = Pharmacy::withTrashed()->find($id);
        if ($pharmacy->trashed()) {
            $pharmacy->forceDelete();
        } else {
            $pharmacy->delete();
        }
        return redirect()->route('pharmacies.index');
    }
    public function restore($id)
    {
        $pharmacy = Pharmacy::withTrashed()->find($id);
        $pharmacy->restore();
        return redirect()->route('pharmacies.index');
    }
}
