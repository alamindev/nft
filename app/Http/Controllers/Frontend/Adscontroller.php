<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Image;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
class Adscontroller extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Ad::where('user_id', auth()->user()->id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('desktop_ads', function ($row) {
                    return '<img src=' . asset($row->desktop_ads) . ' height="60" alt="page-image">';
                })
                ->addColumn('mobile_ads', function ($row) {
                    return '<img src=' . asset($row->mobile_ads) . ' height="60" alt="page-image">';
                })

                ->addColumn('created_date', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d');

                })
                ->addColumn('status', function ($row) {
                    if($row->status == 0){
                        return  '<p class="text-white bg-indigo-600 py-1 px-2 text-xs">Pending</p>';
                    }else{
                        return  '<p class="text-white bg-indigo-600 py-1 px-2 text-xs">Approved</p>';
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route("ads.show", $row->id) . '><i class="fa fa-eye p-2 text-indigo-600"></i></a><a href=' . route("ads.edit", $row->id) . '  ><i class="fa fa-edit p-2 text-purple-600"></i></a><a href="javascript:void(0)"  data-remote=' . route("ads.destroy", $row->id) . ' class="delete"><i class="fa fa-trash p-2 text-red-600"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'desktop_ads','mobile_ads','created_date','status'])
                ->make(true);
        }


        return view('frontend.pages.ads.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.pages.ads.create');
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
            'link' => 'required|url',
            'mobile_ads' => 'required|mimes:jpeg,png,jpg,gif|dimensions:min_width=310,  min_height=110,max_width=320,max_height=120',
            'desktop_ads' => 'required|mimes:jpeg,png,jpg,gif|dimensions:min_width=720,min_height=85,max_width=730,max_height=90',
        ]);

        $desktop_ads = $this->upload_desktop_ads($request);
        $mobile_ads = $this->upload_mobile_ads($request);
        $ad  = new Ad();
        $ad->name = $request->name;
        $ad->link = $request->link;
        $ad->mobile_ads = $mobile_ads;
        $ad->desktop_ads = $desktop_ads;
        $ad->user_id = auth()->user()->id;
        $ad->save();

        toast('Ads created successfully!', 'success');

        return redirect()->route('ads');
    }

    /**
     *
     * update photo
     */
    private function upload_mobile_ads($request)
    {
        if($request->hasFile('mobile_ads')){
            $file = $request->file('mobile_ads');
            $filename = 'ads_mobile_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/ads/' . Auth::id() .'/';
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/ads/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/ads/'. Auth::id().'/'. $filename;
            return $filePath;
        }
    }
    /**
     *
     * update photo
     */
    private function upload_desktop_ads($request)
    {
        if($request->hasFile('desktop_ads')){
            $file = $request->file('desktop_ads');
            $filename = 'ads_desktop_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/ads/' . Auth::id() .'/';
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/ads/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/ads/'. Auth::id().'/'. $filename;
            return $filePath;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $show = Ad::findOrFail($id);
        if(auth()->user()->id != $show->user_id){
            return redirect()->back();
        }
        return view('frontend.pages.ads.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        if(auth()->user()->id != $ad->user_id){
            return redirect()->back();
        }
        return view('frontend.pages.ads.edit',compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->id != $id){
            return redirect()->back();
        }
        $request->validate([
            'name' => 'required',
            'link' => 'required|url',
            'mobile_ads' => 'required|mimes:jpeg,png,jpg,gif|dimensions:min_width=310,min_height=110,max_width=320,max_height=120',
            'desktop_ads' => 'required|mimes:jpeg,png,jpg,gif|dimensions:min_width=720,min_height=85,max_width=730,max_height=90',
        ]);


        $ad  = Ad::find($id);
        if(auth()->user()->id != $ad->user_id){
            return redirect()->back();
        }
        $ad->name = $request->name;
        $ad->link = $request->link;
        $ad->mobile_ads = $this->update_mobile_ads($request,$ad);
        $ad->desktop_ads = $this->update_desktop_ads($request,$ad);
        $ad->save();

        toast('Ads updated successfully!', 'success');

        return redirect()->route('ads');
    }
  /**
     * update photo
     */
    private function update_desktop_ads($request, $ad)
    {
        if ($request->has('desktop_ads') && $request->desktop_ads != 'null') {
            $file = $request->file('desktop_ads');
            $filename = 'ads_desktop_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/ads/' . Auth::id() .'/';
            $path =  public_path() . $ad->desktop_ads;
            if (\File::exists($path)) {
                \File::delete($path);
            }
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/ads/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/ads/'. Auth::id().'/'. $filename;
            return $filePath;
        } else {
            return $project->photo;
        }
    }
    private function update_mobile_ads($request, $ad)
    {
        if ($request->has('mobile_ads') && $request->mobile_ads != 'null') {
            $file = $request->file('mobile_ads');
            $filename = 'ads_mobile_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/ads/' . Auth::id() .'/';
            $path =  public_path() . $ad->mobile_ads;
            if (\File::exists($path)) {
                \File::delete($path);
            }
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/ads/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/ads/'. Auth::id().'/'. $filename;
            return $filePath;
        } else {
            return $ad->photo;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $ad = Ad::find($id);
        if(auth()->user()->id != $ad->user_id){
            return redirect()->back();
        }
        if ($ad) {
            $desktop_ads =  public_path() . $ad->desktop_ads;
            $mobile_ads =  public_path() . $ad->mobile_ads;
            if (\File::exists($desktop_ads)) {
                \File::delete($desktop_ads);
            }
            if (\File::exists($mobile_ads)) {
                \File::delete($mobile_ads);
            }
            $ad->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error']);
        }
    }
}
