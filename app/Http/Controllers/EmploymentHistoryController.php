<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmploymentHistoryRequest;
use App\Http\Requests\UpdateEmploymentHistoryRequest;
use App\Models\EmploymentHistory;

class EmploymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmploymentHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmploymentHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function show(EmploymentHistory $employmentHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmploymentHistory $employmentHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmploymentHistoryRequest  $request
     * @param  \App\Models\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmploymentHistoryRequest $request, EmploymentHistory $employmentHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmploymentHistory $employmentHistory)
    {
        //
    }
}
