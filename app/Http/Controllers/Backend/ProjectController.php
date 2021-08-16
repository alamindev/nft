<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\PromotedProject;
use Illuminate\Http\Request;
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
            $data = Project::with('user','promoted_project')->latest()->get();
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
                ->addColumn('photo', function ($row) {
                    return '<img src=' . asset($row->photo) . ' width="100" alt="page-image">';
                })

                ->addColumn('status', function ($row) {
                    $status = '';
                    if($row->status === 1){
                        if($row->promoted_project && $row->promoted_project->project_id == $row->id){
                            $status .= '<p disabled class="btn btn-success btn-success btn-sm m-0" >Promoted</p>';
                        }else{
                            $status .= '<a href='. route('admin.projects.promoted', $row->id) .' disabled  class="btn btn-info btn-info btn-sm" onclick="return confirm("Are you sure you want to Promote!")">Promote now</a>';
                        }
                        $status .= '<button type="button" disabled  class="btn btn-info btn-blue btn-sm ml-1">Approved</button>
                        <a href='. route('admin.projects.reject', $row->id) .' disabled  class="btn btn-danger btn-danger btn-sm" onclick="return confirm("Are you sure you want to reject!")">Reject</a>';
                    }else{
                        $status .= '<a href='. route('admin.projects.approve', $row->id) .'  class="btn btn-info btn-blue">Approve now</a>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route("admin.projects.show", $row->id) . '><i class="fa fa-eye p-2 text-primary"></i></a><a href="javascript:void(0)"  data-remote=' . route("admin.projects.destroy", $row->id) . ' class="delete"><i class="fa fa-trash p-2 text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['user','action', 'photo','status'])
                ->make(true);
        }


        return view('pages.project.index');
    }
    /**
     * Show Project
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $show = Project::findOrFail($id);
        return view('pages.project.show', compact('show'));
    }
    /**
     * Approve Project
     *
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        Project::where('id', $id)->update(['status' => 1]);
        toast('Project approved successfully!', 'success');
        return redirect()->back();
    }
    /**
     * Approve Project
     *
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        Project::where('id', $id)->update(['status' => 0]);
        toast('Project reject successfully!', 'success');
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
         $project = Project::find($id);
        if ($project) {
            $path =  public_path() . $project->photo;
            if (\File::exists($path)) {
                \File::delete($path);
            }
            $project->delete();
            toast('Project delete successfully!', 'success');
            return redirect()->back();
        }
        toast('Something went wrong!', 'error');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function promoted($id)
    {
        $totalPromoted  = PromotedProject::count();
        if($totalPromoted <= 10){
            $check = PromotedProject::where('project_id', $id)->first();
            if(empty($check)){
                PromotedProject::create(['project_id' => $id]);
                toast('Project Promoted success!', 'success');
            }
            toast('Project already added!', 'error');
        }else{
            toast('Already added 10 projects!', 'error');
        }
        return redirect()->back();
    }
}
