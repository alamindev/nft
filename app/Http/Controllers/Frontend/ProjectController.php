<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Image;
use Auth;
use Illuminate\Support\Str;
use App\Services\Slug;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Project::where('user_id', auth()->user()->id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src=' . asset($row->photo) . ' width="100" alt="page-image">';
                })
                ->addColumn('links', function ($row) {
                    $links= '';
                    if($row->website_link != null){
                        $links.= '<a href='.$row->website_link.' target="_blank"><i class="fas fa-globe-americas p-2 text-indigo-600"></i></a>';
                    }
                    if($row->discord_link != null){
                        $links.= '<a href='.$row->discord_link.' target="_blank" ><i class="fab fa-discord p-2 text-indigo-600"></i></a>';
                    }
                    if($row->twitter_link != null){
                        $links.= '<a href='.$row->twitter_link.' target="_blank"    ><i class="fab fa-twitter p-2 text-indigo-600"></i></a>';
                    }
                    return $links;
                })
                ->addColumn('launch_date', function ($row) {
                    $date = Carbon::parse($row->launch_date)->format('Y-m-d');
                    $time = Carbon::parse($row->launch_time)->format('h:i A');
                    return $date .' ' . $time;
                })
                ->addColumn('status', function ($row) {
                    if($row->status == 0){
                        return  '<p class="text-white bg-indigo-600 py-1 px-2 text-xs">Pending</p>';
                    }else{
                        return  '<p class="text-white bg-indigo-600 py-1 px-2 text-xs">Approved</p>';
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route("details", $row->slug) . '><i class="fa fa-eye p-2 text-indigo-600"></i></a><a href=' . route("projects.edit", $row->slug) . '  ><i class="fa fa-edit p-2 text-purple-600"></i></a><a href="javascript:void(0)"  data-remote=' . route("projects.destroy", $row->id) . ' class="delete"><i class="fa fa-trash p-2 text-red-600"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo','launch_date','links','status'])
                ->make(true);
        }


        return view('frontend.pages.project.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.pages.project.create');
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
            'photo' => 'required|mimes:jpeg,png,jpg,gif|max:1024',
            'website_link' => 'nullable|url',
            'discord_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'launch_date' => 'required',
            'launch_time' => 'required',
        ]);

        $img = $this->upload_site_photo($request);
        $project  = new Project();
        $project->project_id = time() . Str::random(3);
        $project->name = $request->name;
        $project->slug =   Slug::createSlug($request->name);
        $project->website_link = $request->website_link;
        $project->discord_link = $request->discord_link;
        $project->twitter_link = $request->twitter_link;
        $project->launch_date = $request->launch_date;
        $project->launch_time = $request->launch_time;
        $project->description = $request->description;
        $project->photo = $img;
        $project->user_id = auth()->user()->id;
        $project->save();

        toast('Project created successfully!', 'success');

        return redirect()->route('projects');
    }

    /**
     *
     * update photo
     */
    private function upload_site_photo($request)
    {
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = 'project_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/project/' . Auth::id() .'/';
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/project/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/project/'. Auth::id().'/'. $filename;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if(auth()->user()->id != $project->user_id){
            return redirect()->back();
        }
        return view('frontend.pages.project.edit',compact('project'));
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

        $request->validate([
            'name' => 'required',
            'photo' => 'mimes:jpeg,png,jpg,gif|max:1024',
            'website_link' => 'nullable|url',
            'discord_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'launch_date' => 'required',
            'launch_time' => 'required',
        ]);

        $project  = Project::find($id);

        if(auth()->user()->id != $project->user_id){
            return redirect()->back();
        }

        $project->name = $request->name;
        $project->website_link = $request->website_link;
        $project->discord_link = $request->discord_link;
        $project->twitter_link = $request->twitter_link;
        $project->launch_date = $request->launch_date;
        $project->launch_time = $request->launch_time;
        $project->description = $request->description;
        $project->photo =  $this->update_site_image($request, $project);
        $project->save();

        toast('Project updated successfully!', 'success');

        return redirect()->route('projects');
    }
  /**
     * update photo
     */
    private function update_site_image($request, $project)
    {

        if ($request->has('photo') && $request->photo != 'null') {
            $file = $request->file('photo');
            $filename = 'project_' . time() . Str::random(5) . '.' .  $file->getClientOriginalExtension();
            $folder = public_path() . '/uploads/project/' . Auth::id() .'/';
            $path =  public_path() . $project->photo;
            if (\File::exists($path)) {
                \File::delete($path);
            }
            if (!\File::exists($folder)) {
                \File::makeDirectory($folder, 0775, true, true);
            }
            $location = public_path() . '/uploads/project/' . Auth::id().'/'. $filename;
            $image= Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $location);
            }
            else {
                $image->save($location);
            }
            $filePath = '/uploads/project/'. Auth::id().'/'. $filename;
            return $filePath;
        } else {
            return $project->photo;
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

        $project = Project::find($id);
        if(auth()->user()->id != $project->user_id){
            return redirect()->back();
        }
        if ($project) {
            $path =  public_path() . $project->photo;
            if (\File::exists($path)) {
                \File::delete($path);
            }
            $project->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error']);
        }
    }
}
