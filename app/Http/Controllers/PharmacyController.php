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
//    public function store(Request $request)
//    {
//        //
//        $allPharmacies = Pharmacy::create($request->all());
//            return redirect()->route('pharmacies.index')->with('success','Pharmacy created successfully!');
//    }
    public function store(Request $request)
    {
//        // Validate the request data
//        $request->validate([
//            'name' => 'required',
//            'priority' => 'required|integer',
//            'area' => 'required',
//            'avatar' => 'nullable|image|max:2048', // max file size is 2MB
//        ]);

        $pharmacy = Pharmacy::create($request->all());
        // Handle the image upload, if provided
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();
//            $request->avatar->storeAs('public/images', $avatarName);
            $request->avatar->move('images/pharmacies/', $avatarName);
            $pharmacy->avatar = 'images/pharmacies/' . $avatarName;
        } else {
            $avatarName = null;
        }

        $pharmacy->save();

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy created successfully!');
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
//    public function update(Request $request, Pharmacy $pharmacy)
//    {
//        $pharmacy->update($request->all());
//        return redirect()->route('pharmacies.index');
//    }
    public function update(Request $request, Pharmacy $pharmacy)
    {
            $pharmacy->update($request->except('avatar'));
            if ($request->hasFile('avatar')) {
                $old_avatar = $pharmacy->avatar;
                $avatar = $request->avatar;
                $avatar_new_name = time().'.'.$request->avatar->extension();
                if ($avatar->move('images/pharmacies/', $avatar_new_name)) {
                    unlink($old_avatar);
                }
                $pharmacy->avatar = 'images/pharmacies/' . $avatar_new_name;
            }
        $pharmacy->save();
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
            if ($pharmacy->avatar) {
                unlink($pharmacy->avatar);
            }
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
