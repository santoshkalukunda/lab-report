<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization= Organization::first();
        return view('organization.organization',compact('organization'));
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
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        $data = $request->validated();
        $organization= Organization::first();
        if($request->logo != null){
            // if (File::exists($organization->logo)) {
              
            //     unlink($organization->logo);
            // }
            // $file = $request->file('logo');
            // $fileName = "logo-".date("Ymdhis").rand(0,9999).".".$file->getClientOriginalExtension();
            // $destinationPath = public_path();
            // $file->move($destinationPath,$fileName);
            // $data = ['logo'=>$fileName];
            
            Storage::delete($organization->logo);
            $baseDir = 'upload/logo/' . date('Y') . '/' . date('M');
            $imgPath = Storage::putFile($baseDir, $request->file('logo'));
            $data = ['logo'=>$imgPath];
        }
        
        $organization->update($data);
        return redirect()->back()->with('success',"Organization Profile Updated");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();
        
        if($request->logo != null){
            Storage::delete($organization->logo);
            $baseDir = 'upload/logo/' . date('Y') . '/' . date('M');
            $imgPath = Storage::putFile($baseDir, $request->file('logo'));
            $data = ['logo'=>$imgPath];
        }
        $organization->update($data);
        return redirect()->back()->with('success',"Organization Profile Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
