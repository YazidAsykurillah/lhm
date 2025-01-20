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
        $old_profile_file_name = User::findOrFail($request->user_id)->photo_file;
        $photo_file_name = NULL;
        if($request->hasFile('photo_file')){
            $photo_file_name = time().'-'.$request->user_id.'.'.$request->photo_file->extension();
            $request->photo_file->move(public_path('photo-files'), $photo_file_name);
            //delete old_profile_file
            if(File::exists(public_path('photo-files/'.$old_profile_file_name))){
                File::delete(public_path('photo-files/'.$old_profile_file_name));
            }
        }else{
            $photo_file_name = $old_profile_file_name;
        }
        
        $old_ktp_file_name = User::findOrFail($request->user_id)->ktp_file;
        $ktp_file_name = NULL;
        if($request->has('ktp_file')){
            $ktp_file_name = time().'-'.$request->user_id.'.'.$request->ktp_file->extension();
            $request->ktp_file->move(public_path('ktp-files'), $ktp_file_name);
            //delete old_ktp_file
            if(File::exists(public_path('ktp-files/'.$old_ktp_file_name))){
                File::delete(public_path('ktp-files/'.$old_ktp_file_name));
            }
        }else{
            $ktp_file_name = $old_ktp_file_name;
        }
        
        $old_passport_file_name = User::findOrFail($request->user_id)->passport_file;
        $passport_file_name = NULL;
        if($request->has('passport_file')){
            $passport_file_name = time().'-'.$request->user_id.'.'.$request->passport_file->extension();
            $request->passport_file->move(public_path('passport-files'), $passport_file_name);
            //delete old_passport_file
            if(File::exists(public_path('passport-files/'.$old_passport_file_name))){
                File::delete(public_path('passport-files/'.$old_passport_file_name));
            }
        }else{
            $passport_file_name = $old_passport_file_name;
        }

        try {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->phone_number = trim(trim($request->phone_number));
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->photo_file = $photo_file_name;
            $user->ktp_number = $request->ktp_number;
            $user->ktp_file = $ktp_file_name;
            $user->passport_number = $request->passport_number;
            $user->passport_file = $passport_file_name;
            $user->email = $request->email;
            $user->is_profile_updated = TRUE;
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
