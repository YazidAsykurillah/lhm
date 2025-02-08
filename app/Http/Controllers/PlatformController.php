<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;
use App\Models\Platform;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('platform.index');
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
    public function store(StorePlatformRequest $request)
    {
        $response = [];

        try {
            
            $platform = new Platform;
            $platform->name = $request->name;
            $platform->save();
            
            $response['status'] = TRUE;
            $response['message'] = 'Platform has been saved';

        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $platform = Platform::findOrFail($id);
        return view('platform.show')
            ->with('platform', $platform);
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
    public function update(UpdatePlatformRequest $request, string $id)
    {
        $response = [];

        try {
            
            $platform = Platform::findOrFail($id);
            $platform->name = $request->name;
            $platform->save();
            
            $response['status'] = TRUE;
            $response['message'] = 'Platform has been updated';

        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
