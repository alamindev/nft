@extends('layouts.app')
@section('title')
Links
@endsection
@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        @if(count($links) > 0)
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Recent Instagram link </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>Link</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($links as $index => $link)
                                        <tr>
                                            <td class="serial">{{$index + $links->firstItem()}}</td>
                                            <td><a class="text-lowercase" target="_blank" href="{{ $link->link }}">{{ $link->link }}</a></td>
                                            <td>{{ \Carbon\Carbon::parse($link->created_at)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($link->created_at)->format('H:i') }}</td>
                                            <td>
                                               <form method="post" action="{{ route('link.approve', $link->id) }}">
                                                @csrf
                                                    @if($link->active === 1)
                                                    <button type="button" disabled  class="btn btn-info btn-blue">Approved</button>
                                                    <a href="{{ route('link.reject', $link->id) }}" disabled  class="btn btn-primary btn-primary">Reject</a>
                                                    <a  href="{{ route('link.destroy', $link->id) }}" class="btn btn-danger btn-danger" style="color: white" onclick="return confirm('Are you sure you want to delete!')">Delete</a>

                                                    @else
                                                    <button  type="sumbit" class="btn btn-info btn-blue">Approve now</button>
                                                    <a  href="{{ route('link.destroy', $link->id) }}" class="btn btn-danger btn-danger" style="color: white" onclick="return confirm('Are you sure you want to delete!')">Delete</a>
                                                    @endif
                                               </form>
                                            </td>
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                {{ $links->links() }}
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>
        @endif
    </div>
    <!-- .animated -->
</div>
@endsection
