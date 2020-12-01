<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Milestone;

class MilestoneController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param  Index  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Index $request)
    {
        $milestone = Milestone::latest()->get();
        return response()->json($milestone, 201);
    }    /**
          * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Milestone $request)
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            
        ]);
        $milestone = Milestone::create($request->all());

        return response()->json($milestone, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Milestone $milestone)
    {
        return response()->json($milestone, 201);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milestone)
    {
        return response()->json($milestone, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        $milestone->update($request->all());

        return response()->json($milestone, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return response()->json($milestone, 201);
    }
}
