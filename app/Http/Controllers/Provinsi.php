<?php

namespace App\Http\Controllers;

use App\Models\Provinsi_model;
use Illuminate\Http\Request;

class Provinsi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('provinsi_v');
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
    public function show(Provinsi_model $provinsi_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi_model $provinsi_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi_model $provinsi_model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi_model $provinsi_model)
    {
        //
    }
}
