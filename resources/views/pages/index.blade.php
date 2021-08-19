@extends('layouts.app')
@section('title')
Dashboard
@endsection

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('users') }}">
                    <div class="card color-purple">
                        <div class="card-body">
                            <div class="stat-widget-five ">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="fa fa-users text-white"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text text-white">{{ $userCount ? $userCount : '0' }}</div>
                                        <div class="stat-heading text-white">Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.projects') }}">
                    <div class="card color-blue">
                        <div class="card-body">
                            <div class="stat-widget-five ">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="fa fa-product-hunt text-white"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text text-white">{{ $projectCount ? $projectCount : '0' }}</div>
                                        <div class="stat-heading text-white">Projects</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.projects') }}">
                    <div class="card color-green">
                        <div class="card-body">
                            <div class="stat-widget-five ">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="fa fa-buysellads text-white"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text text-white">{{ $adsCount ? $adsCount : '0' }}</div>
                                        <div class="stat-heading text-white">Ads</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /Widgets -->

        <!--  /Traffic -->
        <div class="clearfix"></div>
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Recent Projects </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th data-priority="1">User</th>
                                            <th data-priority="1">Name</th>
                                            <th data-priority="2">Photo</th>
                                            <th data-priority="4">Status</th>
                                            <th data-priority="5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse($projects as $project)
                                        <tr>
                                            <td class="serial">{{ $i++}}.</td>
                                            <td>
                                                <a href="{{ route('user.show', $project->user->id) }}" class="d-flex flex-column align-items-center">
                                                    @if($project->user->photo == null)
                                                    <img src="{{ asset('images/avatar.png') }}" class="rounded-circle" width="50" alt="user-image">
                                                    @else
                                                    <img src="{{ asset($project->user->photo) }}" class="rounded-circle" width="50" alt="user-image">
                                                    @endif
                                                    <p>{{ $project->user->name }}</p>
                                                </a>
                                            </td>
                                            <td>{{ $project->name }}</td>
                                            <td><img src="{{ asset($project->photo) }}" width="100" alt="project-image"></td>
                                            <td>
                                                @if($project->status === 1)
                                                    @if($project->promoted_project && $project->promoted_project->project_id === $project->id)
                                                    <p disabled class="btn btn-success btn-success btn-sm m-0" >Promoted</p>
                                                @else
                                                    <a href="{{ route('admin.projects.promoted', $project->id) }}" disabled  class="btn btn-info btn-info btn-sm" onclick="return confirm('Are you sure you want to Promote!')">Promote now</a>
                                                @endif
                                                    <button type="button" disabled  class="btn btn-info btn-blue btn-sm">Approved</button>
                                                    <a href="{{ route('admin.projects.reject', $project->id) }}" disabled  class="btn btn-danger btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject!')">Reject</a>
                                                @else
                                                    <a href="{{ route('admin.projects.approve', $project->id) }}"  class="btn btn-info btn-blue">Approve now</a>
                                                 @endif
                                            </td>
                                            <td>
                                                <a  href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info btn-info" style="color: white"  >View</a>
                                                <a  href="{{ route('admin.projects.destroy', $project->id) }}" class="btn btn-danger btn-danger" style="color: white" onclick="return confirm('Are you sure you want to delete!')">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No data found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-body d-flex justify-content-center">
                                    <a href="{{route('admin.projects')}}" class="btn btn-success">Show all</a>
                                </div>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->

            </div>
        </div>
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Recent ads </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th data-priority="1">User</th>
                                            <th data-priority="1">Name</th>
                                            <th data-priority="2">Desktop ads</th>
                                            <th data-priority="3">Mobile ads</th>
                                            <th data-priority="4">created date</th>
                                            <th data-priority="4">Status</th>
                                            <th data-priority="5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse($ads as $ad)
                                        <tr>
                                            <td class="serial">{{ $i++}}.</td>
                                            <td>
                                                <a href="{{ route('user.show', $ad->user->id) }}" class="d-flex flex-column align-items-center">
                                                    @if($project->user->photo == null)
                                                    <img src="{{ asset('images/avatar.png') }}" class="rounded-circle" width="50" alt="user-image">
                                                    @else
                                                    <img src="{{ asset($project->user->photo) }}" class="rounded-circle" width="50" alt="user-image">
                                                    @endif
                                                    <p>{{ $ad->user->name }}</p>
                                                </a>
                                            </td>
                                            <td>{{ $ad->name }}</td>
                                            <td ><img src="{{ asset($ad->desktop_ads) }}"    alt="page-image" width="200"></td>
                                            <td><img src="{{ asset($ad->mobile_ads) }}" width="100" alt="page-image"></td>
                                            <td>
                                               {{\Carbon\Carbon::parse($ad->created_at)->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                @if($ad->status === 1)
                                                    <button type="button" disabled  class="btn btn-info btn-blue btn-sm">Approved</button>
                                                    <a href="{{ route('admin.ads.reject', $ad->id) }}" disabled  class="btn btn-danger btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject!')">Reject</a>
                                                @else
                                                    <a href="{{ route('admin.ads.approve', $ad->id) }}"  class="btn btn-info btn-blue btn-sm">Approve now</a>
                                                 @endif
                                            </td>
                                            <td>
                                                <a  href="{{ route('admin.ads.destroy', $ad->id) }}" class="btn btn-danger btn-danger btn-sm" style="color: white" onclick="return confirm('Are you sure you want to delete!')">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No data found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-body d-flex justify-content-center">
                                    <a href="{{route('admin.ads')}}" class="btn btn-success ">Show all</a>
                                </div>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
                <style>
                    .table-stats table th img, .table-stats table td img {
                        margin-right: 10px;
                        max-width: 300px;
                    }
                </style>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
@endsection
