<?php

namespace App\Http\Controllers\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BankAccount;

class BankAccountSelect2Controller extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = BankAccount::query()
                ->where('status','=','active')
                ->where('name','LIKE',"%$search%")
                ->paginate(5);
        }
        else{
            $data = BankAccount::query()
            ->where('status','=','active')
            ->paginate(5); 
        }
        return response()->json($data);
    }
}
