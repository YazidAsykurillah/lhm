<?php

namespace App\Http\Controllers\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserSelect2Controller extends Controller
{
    public function selectUserForUmrahManifest(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = User::query()
                ->where('name','LIKE',"%$search%")
                ->paginate(5);
        }
        else{
            $data = User::query()
            ->paginate(5); 
        }
        return response()->json($data);
    }
}
