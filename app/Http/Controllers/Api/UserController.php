<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\updateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseController
{


    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse($user);
        } catch (ModelNotFoundException $exception) {
            return $this->sendError('User not found.', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, string $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            if ($request->hasFile('image')) {
                $old_image = $user->image;
                $user->image = $request->file('image')->store('images', 'public');
                Storage::delete($old_image);
            }
            $user->fill($request->validated());
            $user->save();
            return $this->sendResponse('Update');
        } else {
            return $this->sendError('User not found.', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

}
