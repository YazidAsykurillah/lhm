<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UmrahBatch;

class UmrahBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('umrah-batch.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $umrah_batch = UmrahBatch::findOrFail($id);
        return view('umrah-batch.show')
            ->with('umrah_batch', $umrah_batch);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
