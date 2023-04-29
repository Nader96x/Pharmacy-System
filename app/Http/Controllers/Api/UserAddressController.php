<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddress\AddUserAddressRequest;
use App\Http\Requests\UserAddress\Api\EditUserAddressRequest;
use App\Http\Resources\UserAddressResource;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userAddresses = UserAddress::where(['user_id'=>$user->id])->paginate(10);
        return responseJson(200,'Success', UserAddressResource::collection($userAddresses));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserAddressRequest $request)
    {
        $userAddress = new UserAddress();
        $userAddress->fill($request->validated());
        $userAddress->user_id = Auth::user()->id;
        $userAddress->save();
        return responseJson(200,'Success', new UserAddressResource($userAddress));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $address_id)
    {
        $user = Auth::user();
        $userAddress = UserAddress::where(['id' => $address_id , 'user_id' => $user->id]);
        if($userAddress)
            return responseJson(200,'Success', new UserAddressResource($userAddress));
        else
            return responseJson(404,'Address Not Found');

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
