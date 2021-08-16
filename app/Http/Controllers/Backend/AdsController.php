<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
class AdsController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Ad::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return '
                        <a href='. route('user.show', $row->user->id) .' class="">
                            <img src=' . asset($row->user->photo) . ' class="rounded-circle" width="50" alt="page-image">
                            <p>'.$row->user->name.'</p>
                        </a>
                    ';
                })
                ->addColumn('desktop_ads', function ($row) {
                    return '<img src=' . asset($row->desktop_ads) . ' width="300" alt="page-image">';
                })
                ->addColumn('mobile_ads', function ($row) {
                    return '<img src=' . asset($row->mobile_ads) . ' width="100" alt="page-image">';
                })
                ->addColumn('created_date', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d');
                })
                ->addColumn('status', function ($row) {
                    if($row->status === 1){
                        return '<button type="button" disabled  class="btn btn-info btn-blue btn-sm">Approved</button>
                        <a href='. route('admin.ads.reject', $row->id) .' disabled  class="btn btn-danger btn-danger btn-sm" onclick="return confirm("Are you sure you want to reject!")">Reject</a>';
                    }else{
                        return '<a href='. route('admin.ads.approve', $row->id) .'  class="btn btn-info btn-blue">Approve now</a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route("admin.ads.show", $row->id) . '><i class="fa fa-eye p-2 text-primary"></i></a><a href="javascript:void(0)"  data-remote=' . route("admin.ads.destroy", $row->id) . ' class="delete"><i class="fa fa-trash p-2 text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['user','action', 'desktop_ads', 'mobile_ads','created_at','status'])
                ->make(true);
        }


        return view('pages.ads.index');
    }
    /**
     * Show ads
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $show = Ad::findOrFail($id);
        return view('pages.ads.show', compact('show'));
    }
    /**
     * Approve ads
     *
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        Ad::where('id', $id)->update(['status' => 1]);
        toast('ads approved successfully!', 'success');
        return redirect()->back();
    }
    /**
     * Approve ads
     *
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        Ad::where('id', $id)->update(['status' => 0]);
        toast('ads reject successfully!', 'success');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Ad::find($id);
        if ($ads) {
            $desktop_ads =  public_path() . $ads->desktop_ads;
            $mobile_ads =  public_path() . $ads->mobile_ads;
            if (\File::exists($desktop_ads)) {
                \File::delete($desktop_ads);
            }
            if (\File::exists($mobile_ads)) {
                \File::delete($mobile_ads);
            }
            $ads->delete();
            toast('Ads delete successfully!', 'success');
            return redirect()->back();
        }
        toast('Something went wrong!', 'error');
        return redirect()->back();
    }
}
