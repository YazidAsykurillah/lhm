<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompleteMyProfileRequest;
use App\Models\User;
use File;

class MyProfileController extends Controller
{
    public function index()
    {
        $profile = \Auth::user();
        return view('users.my-profile')
            ->with('profile', $profile);
    }

    public function completeProfile(CompleteMyProfileRequest $request)
    {
        $response=[];
        

        try {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->phone_number = trim(trim($request->phone_number));
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->save();
            $response['status'] = TRUE;
            $response['message'] = 'Profile has been completed';
            $response['data']['url'] = url('home');
        } catch (Exception $e) {
            return $e;
        }
        return response()->json($response);
        
    }
}
