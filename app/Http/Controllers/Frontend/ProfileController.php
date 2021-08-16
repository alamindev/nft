<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.pages.profile.index');
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
            'photo' => 'mimes:jpeg,png,jpg,gif|max:1024',
            'address' => 'max:300'
        ]);

        $datas = $request->only('name', 'address');

        auth()->user()->update($datas);
        if($request->hasFile('photo')){
            $file = $request->file('photo');

            if(auth()->user()->photo != null ){
                  $path =  public_path() . auth()->user()->photo;
                 if (\File::exists($path)) {
                     \File::delete($path);
                 }
             }

            $filename = 'profile_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/users/' . Auth::id() .'/';
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }

            $location = public_path() . '/uploads/users/' . Auth::id().'/'. $filename;

            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/users/'. Auth::id().'/'. $filename;
            Auth()->user()->update(['photo'=>$filePath]);


        }
        toast('Profile updated Successfully!', 'success');
        return redirect()->route('profile');
    }
}
