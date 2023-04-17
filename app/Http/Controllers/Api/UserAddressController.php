<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddress\AddUserAddressRequest;
use App\Http\Requests\UserAddress\Api\EditUserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAddresses = UserAddress::first()->paginate(10);

        return responseJson(200,'Success', $userAddresses);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserAddressRequest $request)
    {
        $userAddress = new UserAddress();
        $userAddress->fill($request->validated());
        $userAddress->save();

        return responseJson(200,'Success', $userAddress);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $address)
    {
        $userAddress = UserAddress::find($address);
        if($userAddress)
            return responseJson(200,'Success', $userAddress);
        else
            return responseJson(200,'Address Not Found');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserAddressRequest $request, UserAddress $address)
    {
        $address->fill($request->validated());
        $address->save();

        return responseJson(200,'Success', $address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $address)
    {
        $address->delete();

        return responseJson(200,'Success');

    }
}
