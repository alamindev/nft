<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PromotedProject;
use Illuminate\Http\Request;

class PromotedProjectController extends Controller
{
    public function index(){
        $promoted = PromotedProject::with('project')->get();
        return view('pages.promoted_project.index', compact('promoted'));
    }

    public function destroy($id){
        $promoted = PromotedProject::find($id);
        if($promoted){
            $promoted->delete();
        }
        toast('Promoted Project deleted successfully!', 'success');
        return redirect()->route('admin.promoted_projects');
    }
}
