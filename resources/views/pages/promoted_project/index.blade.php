@extends('layouts.app')
@section('title')
Promoted project
@endsection

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Promoted Projects </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th data-priority="1">Name</th>
                                            <th data-priority="2">Photo</th>
                                            <th data-priority="4">Launch Date</th>
                                            <th data-priority="5">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse ($promoted as $promote)
                                            @if(!empty($promote))
                                            <tr>
                                                <td class="serial">{{ $i++}}.</td>
                                                <td>{{ $promote->project->name }}</td>
                                                <td><img src="{{ asset($promote->project->photo) }}" width="100" alt="page-image"></td>
                                                <td>
                                                    @php
                                                    $date = \Carbon\Carbon::parse($promote->project->launch_date)->format('d-m-Y');
                                                    $time = \Carbon\Carbon::parse($promote->project->launch_time)->format('h:i A');
                                                @endphp
                                                {{ $date . ' ' . $time }}
                                                </td>
                                                <td>
                                                    <a  href="{{ route('admin.projects.show', $promote->project->id) }}" class="btn btn-info btn-info" style="color: white"  >View</a>
                                                    <a  href="{{ route('admin.promoted_project.destroy', $promote->id) }}" class="btn btn-danger btn-danger" style="color: white" onclick="return confirm('Are you sure you want to delete!')">Delete</a>
                                                </td>
                                            </tr>
                                            @endif
                                         @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data found!</td>
                                            </tr>
                                         @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
@endsection
