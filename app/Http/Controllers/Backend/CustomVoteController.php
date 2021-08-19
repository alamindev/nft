<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomVote;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class CustomVoteController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::withSum('custom_vote','vote')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src=' . asset($row->photo) . ' width="100" alt="page-image">';
                })
                ->addColumn('vote', function ($row) {
                    if($row->custom_vote_sum_vote != null){
                        return $row->custom_vote_sum_vote;
                    }
                    return '0';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-primary "href=' . route("admin.votes.edit", $row->id) . '>Edit Vote</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo','vote'])
                ->make(true);
        }


        return view('pages.custom-vote.votes');
    }

    /**
     * Show Project
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = CustomVote::where('project_id',$id)->first();
        if($edit){
            return view('pages.custom-vote.edit-vote', compact('edit', 'id'));
        }else{
            return view('pages.custom-vote.create-vote', compact('id'));
        }
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
            'vote' => 'required|numeric',
        ]);
            $vote= new CustomVote;
            $vote->vote = $request->vote;
            $vote->project_id = $request->project_id;
            $vote->save();
        toast('Vote Added successfully!', 'success');

        return redirect()->route('admin.votes');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'vote' => 'required|numeric',
        ]);

        CustomVote::where('id', $id)->update(['vote' => $request->vote]);



        toast('Vote updated successfully!', 'success');

        return redirect()->route('admin.votes');
    }
}

