<?php

namespace App\Http\Controllers;

use App\Models\notifigcation;
use Illuminate\Http\Request;

class NotifigcationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.notification');
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
    public function show(notifigcation $notifigcation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notifigcation $notifigcation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notifigcation $notifigcation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notifigcation $notifigcation)
    {
        //
    }
}
