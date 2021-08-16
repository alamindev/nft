@extends('layouts.app')
@section('title')
    Project details
@endsection
@section('content')
<div class="content">
  <div class="row">
  <div class="col-lg-12">
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
       <h4>Project details</h4>
       <a href="{{ route('admin.ads') }}" class="btn btn-success"> <i class="fa  fa-arrow-left "></i> Back</a>
    </div>
        <div class="card-body card-block">
             <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $show->name }}</td>
                    </tr>
                    <tr>
                        <td>Desktop ads</td>
                        <td>:</td>
                        <td><img src="{{ asset($show->desktop_ads) }}" width="300" alt="page-image"></td>
                    </tr>
                    <tr>
                        <td>Mobile ads</td>
                        <td>:</td>
                        <td><img src="{{ asset($show->mobile_ads) }}" width="100" alt="page-image"></td>
                    </tr>
                    <tr>
                        <td>Created Date</td>
                        <td>:</td>
                       <td>
                   {{\Carbon\Carbon::parse($show->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                       <td>@if($show->status == 0)
                            <p class="btn btn-success">Pending</p>
                        @else
                            <p class="btn btn-success">Approved</p>
                        @endif
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

  </div>
  </div>
</div>
@endsection
