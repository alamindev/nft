<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Project;
use App\Models\PromotedProject;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function optimize(){

        \Artisan::call('optimize');
        \Artisan::call('config:cache');
        \Artisan::call('route:cache');

        return 'optimized';
    }
    public function optimizeClear(){

        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');

        return 'clear-optimize';
    }
    /**
     * showing the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::where('status', 1)->inRandomOrder()->limit(3)->get();
        $project_ids = PromotedProject::take(10)->pluck('project_id');
        $promoted_projects = Project::with('favourite')->withCount('votes', 'votes')
                                    ->whereIn('id', $project_ids)
                                    ->withSum('custom_vote','vote')
                                    ->orderByDesc('custom_vote_sum_vote')
                                    ->where('status', 1)
                                    ->get();
          $projects = Project::with('favourite')->withCount('votes', 'votes')
                                ->whereNotIn('id', $project_ids)
                                 ->withSum('custom_vote','vote')
                                ->orderByDesc('custom_vote_sum_vote')
                                ->inRandomOrder()
                                ->where('status', 1)
                                ->take(100)
                                ->paginate(12);
        return view('frontend.pages.index',compact('ads','promoted_projects', 'projects'));
    }

    /**
     * show newly listed data
     *
     * @return \Illuminate\Http\Response
     */
    public function NewlyListed()
    {
        $ads = Ad::where('status', 1)->inRandomOrder()->limit(3)->get();
         $date = Carbon::now()->subDays(5);
        $projects = Project::with('favourite')->withCount('votes', 'votes')
                         ->withSum('custom_vote','vote')
                        ->where('created_at', '>=', $date)
                        ->orderByDesc('custom_vote_sum_vote')
                        ->where('status', 1)
                        ->inRandomOrder()
                        ->paginate(50);
        return view('frontend.pages.new-listed',compact('ads', 'projects'));
    }

    /**
     * show all NFT's
     *
     * @return \Illuminate\Http\Response
     */
    public function AllNft()
    {
        $ads = Ad::where('status', 1)->inRandomOrder()->limit(3)->get();
        $projects = Project::with('favourite')->withCount('votes', 'votes')
                         ->withSum('custom_vote','vote')
                        ->orderByDesc('custom_vote_sum_vote')
                        ->inRandomOrder()
                        ->where('status', 1)
                        ->paginate(100);
            return view('frontend.pages.all-nft',compact('ads', 'projects'));
    }

    /**
     * show prelaunch data
     *
     * @return \Illuminate\Http\Response
     */
    public function Prelaunch()
    {
        $ads = Ad::where('status', 1)->inRandomOrder()->limit(3)->get();
        $projects = Project::with('favourite')->withCount('votes', 'votes')
                         ->withSum('custom_vote','vote')
                        ->orderByDesc('custom_vote_sum_vote')
                        ->whereDate('launch_date', '>=', Carbon::now()->addDay(1))
                        ->inRandomOrder()
                        ->where('status', 1)
                        ->paginate(100);
        return view('frontend.pages.prelaunch',compact('ads', 'projects'));
    }
    /**
     * show Project details
     *
     * @return \Illuminate\Http\Response
     */
    public function details($slug)
    {
        $ads = Ad::where('status', 1)->inRandomOrder()->limit(3)->get();
        $project= Project::withSum('custom_vote','vote')->where('status', 1)->where('slug', $slug)->first();
        if($project){
            $todayVote = Vote::whereDate('updated_at', Carbon::today())->where('project_id', $project->id)->sum('votes');
            return view('frontend.pages.project-details',compact('ads','project','todayVote'));
        }
        return abort(404);

    }
    /**
     * show Project Search
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(Request $request)
    {
        $value = $request->value;
        if($value != ''){
            $filterResult = Project::select('id','name','photo','slug')->where('name', 'LIKE', '%'.$value . '%')->get();
            if(count($filterResult) > 0){
                return response()->json(['success'=> true, 'data'=> $filterResult, 'url'=> env('APP_URL')]);
            }
            return response()->json(['success'=> false, 'data'=> $filterResult]);
        }
        return response()->json(['empty'=> true]);

    }
}
