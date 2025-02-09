<?php

namespace App\Http\Controllers\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlatformAccount;


class PlatformAccountSelect2Controller extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = PlatformAccount::query()
                ->with([
                    'platform'=>function($query){
                        return $query->select('platforms.id', 'platforms.name');
                    }
                ])
                ->whereHas('platform', function($q) use ($search){
                    $q->where('platforms.name','LIKE', "%$search%");
                })
                ->orWhere('name','LIKE',"%$search%")
                
                ->paginate(25);
        }
        else{
            $data = PlatformAccount::query()
            ->with([
                'platform'=>function($query){
                    return $query->select('platforms.id', 'platforms.name');
                }
            ])
            ->paginate(25); 
        }
        return response()->json($data);
    }
}
