<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{

    public function index()
    {
        $organizations = Organization::latest()->get();
        return response()->json($organizations, 201);

    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'domain_name'=> 'required',
        ]);
        $organization = Organization::create($request->all());

        return response()->json($organization, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return response()->json($organization, 201);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return response()->json($organization, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->all());

        return response()->json($organization, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->json($organization, 201);
    }


    public function getAllAdmins(){
 
        $admins = DB::table('users')
       ->join('role', 'users.role_id', '=', 'role.role_id')
       ->where('role.name', '=', 'admin')
        ->get();
        return response()->json($admins, 201);
    }
    public function getAllEmployees(){
       
        $employees = DB::table('users')
        ->join('role', 'users.role_id', '=', 'role.role_id')
        ->where('role.name', '=', 'employee')
         ->get();
         return response()->json($employees, 201);
    }
    public function getAllDevelopers(){
        $developers = DB::table('users')
        ->join('role', 'users.role_id', '=', 'role.role_id')
        ->where('role.name', '=', 'developer')
         ->get();
         return response()->json($developers, 201);
    }
 
}
