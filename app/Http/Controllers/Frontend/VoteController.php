<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Vote($project_id)
    {
        if(auth()->check() && auth()->user()->id === $project_id){
            return redirect()->back();
        }

        $voteCheck = Vote::where('user_id', auth()->user()->id)->where('project_id', $project_id)->first();
        if($voteCheck){
            $voteDate = Carbon::parse($voteCheck->updated_at);
             $voteDateCheck = $voteDate->diffInHours(Carbon::now());
            if($voteDateCheck > 24){
                $voteCheck = Vote::where('project_id', $project_id)->increment('votes');
                toast('Thank you for voting!', 'success');
            }else{
                toast('You need to wait 24hrs for next vote', 'error');
            }
            return redirect()->back();
        }else{
            $vote = new Vote();
            $vote->votes = 1;
            $vote->project_id = $project_id;
            $vote->user_id = auth()->user()->id;
            $vote->save();
            toast('Thank you for voting!', 'success');
            return redirect()->back();
        }

    }

}
