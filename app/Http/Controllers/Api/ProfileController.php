<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
    return response()->json([
        'status'=>'Success',
        'message' => 'Profile fetched successfully',
        'user' => Auth::user()
    ], 200);
    }

    public function update(UpdateProfileRequest $request)
    {
    $user = Auth::user();

    $user->update($request->validated());

    return response()->json([
        'status'=>'Success',
        'message' => 'Profile updated successfully',
        'user' => $user
    ], 200);
    }


    public function updatePassword(UpdatePasswordRequest $request)
    {
    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status'=>'Error',
            'message' => 'Current password is incorrect'
        ], 422);
    }

    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return response()->json([
        'status'=>'Success',
        'message' => 'Password updated with succes'
    ], 200);
    }

    public function delete()
    {
    $user = Auth::user();
    $user->currentAccessToken()->delete();
    $user->delete();

    return response()->json([
        'message' => 'Account deleted with success'
    ], 200);
    }
}
