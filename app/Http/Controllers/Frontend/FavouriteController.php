<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Vote;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function index()
    {
        if(!auth()->check()){
            return redirect()->back();
        }
        $favourite_projects = Favourite::with('project')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.pages.favourite-lists.index',compact('favourite_projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Favourite($project_id)
    {
        if(auth()->check() && auth()->user()->id === $project_id){
            return redirect()->back();
        }

        $favouriteCheck = Favourite::where('user_id', auth()->user()->id)->where('project_id', $project_id)->first();
        if($favouriteCheck){
            toast('Already Added!', 'error');
            return redirect()->back();
        }else{
            $favourite = new Favourite();
            $favourite->project_id = $project_id;
            $favourite->user_id = auth()->user()->id;
            $favourite->save();
            toast('Favourite project added in then list!', 'success');
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Unfavourite($project_id)
    {
        if(auth()->check() && auth()->user()->id === $project_id){
            return redirect()->back();
        }

        $favouriteCheck = Favourite::where('user_id', auth()->user()->id)->where('project_id', $project_id)->first();
        if($favouriteCheck){
            $favouriteCheck->delete();
        }
        toast('Favourite project removed from the list!', 'success');
        return redirect()->back();
    }

}
