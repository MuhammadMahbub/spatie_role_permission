<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{

     /**
     * Construct
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('verified');
        // $this->middleware('checkAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.generalSettings.index', [

            'generalSettings' => GeneralSetting::first()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralSetting $generalSetting)
    {
        // Form Validation
        $request->validate([
            'logo'              => 'image',
            'favicon'           => 'image',

            'phone'             => 'required',
            'address'           => 'required',
            'email'             => 'required',

            'meta_title'        => 'required', 
            'meta_description'  => 'required', 
            'meta_keywords'     => 'required',
        ]);

         //  Logo
         if($request->hasFile('logo')){

            $logo = $request->file('logo'); 
            $filename = 'logo.'. $logo->extension('logo');
            $location = public_path('uploads/generalSettings/'); 
            $logo->move($location, $filename); 

            $generalSetting->logo = $filename; 

        }

        //  Favicon
        if($request->hasFile('favicon')){

            $favicon = $request->file('favicon'); 
            $favicon_filename = 'favicon.'. $favicon->extension('favicon');
            $favicon_location = public_path('uploads/generalSettings/'); 
            $favicon->move($favicon_location, $favicon_filename); 

            $generalSetting->favicon = $favicon_filename; 
        }


        $generalSetting->email             = $request->email;
        $generalSetting->phone             = $request->phone;
        $generalSetting->address           = $request->address;
        $generalSetting->meta_title        = $request->meta_title;
        $generalSetting->meta_description  = $request->meta_description;
        $generalSetting->meta_keywords     = $request->meta_keywords;


        $generalSetting->save();

        return back()->withSuccess('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
