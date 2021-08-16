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
       <a href="{{ route('admin.projects') }}" class="btn btn-success"> <i class="fa  fa-arrow-left "></i> Back</a>
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
                        <td>Slug</td>
                        <td>:</td>
                        <td>{{ $show->slug }}</td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>:</td>
                        <td><img src="{{ asset($show->photo) }}" width="200" alt="page-image"></td>
                    </tr>
                    <tr>
                        <td>Launch Date</td>
                        <td>:</td>
                       <td>   @php
                        $date = \Carbon\Carbon::parse($show->launch_date)->format('Y-m-d');
                       $time = \Carbon\Carbon::parse($show->launch_time)->format('h:i A');
                   @endphp
                   {{ $date . ' ' . $time }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                       <td>@if($show->status == 0){
                            <p class="btn btn-success">Pending</p>
                        @else
                            <p class="btn btn-success">Approved</p>
                        @endif
                    </td>
                    </tr>
                    <tr>
                        <td>Links</td>
                        <td>:</td>
                       <td>  @if($show->website_link != null)
                        <a href={{ $show->website_link }} target="_blank"><i class="fa fa-globe p-2 text-indigo-600"></i></a>
                    @endif
                     @if($show->discord_link != null)
                         <a href={{ $show->discord_link }} target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-discord" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                             <circle cx="9" cy="12" r="1" />
                             <circle cx="15" cy="12" r="1" />
                             <path d="M7.5 7.5c3.5 -1 5.5 -1 9 0" />
                             <path d="M7 16.5c3.5 1 6.5 1 10 0" />
                             <path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-1 2.5" />
                             <path d="M8.5 17c0 1 -1.356 3 -1.832 3c-1.429 0 -2.698 -1.667 -3.333 -3c-.635 -1.667 -.476 -5.833 1.428 -11.5c1.388 -1.015 2.782 -1.34 4.237 -1.5l1 2.5" />
                           </svg></a>
                         @endif
                     @if($show->twitter_link != null)
                        <a href={{ $show->twitter_link }} target="_blank"    ><i class="fa fa-twitter p-2 text-indigo-600"></i></a>
                     @endif</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                       <td> {!! $show->description !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

  </div>
  </div>
</div>
@endsection
