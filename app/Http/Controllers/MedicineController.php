<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medicine\StoreMedicineRequest;
use App\Http\Requests\Medicine\UpdateMedicineRequest;
use App\Models\Medicine;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::paginate(10);
        return view('admin.medicines.index', ['medicines' => $medicines], compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        $medicine = new Medicine();
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->cost = $request->cost;
        $medicine->save();
        return redirect()->route('medicines.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medicine = Medicine::find($id);
        return view('admin.medicines.show', ['medicine' => $medicine], compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicine = Medicine::find($id);
        return view('admin.medicines.edit', ['medicine' => $medicine], compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineRequest $request)
    {
        $medicine = Medicine::find($id);
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->cost = $request->cost;
        $medicine->save();
        return redirect()->route('medicines.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
//        dd($id);
        $medicine = Medicine::find($id);
//        dd($medicine);
        $medicine->delete();
        return redirect()->route('medicines.index');
    }
}
