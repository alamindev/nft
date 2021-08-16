<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', 0)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        return '<img src=' . asset($row->photo) . ' width="40" alt="user-image">';
                    }
                    return 'No photo';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href=' . route("user.show", $row->id) . '  class="view btn btn-info btn-sm mr-2">View User</a> <a href="javascript:void(0)"  data-remote=' . route("user.destroy", $row->id) . ' class="delete btn btn-danger btn-sm">Delete user</a>';
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }

        return view('pages.user.users');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = User::find($id);
        return view('pages.user.view-user', compact('view'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('is_admin', 0)->find($id);
        if ($user) {
            $path = public_path($user->photo);
                if (\File::exists($path)) {
                    \File::delete($path);
                }
            $user->delete();
            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => 'error']);
    }
}
