@extends('layouts.app')
@section('title')
  View Users
@endsection
@section('content')
<div class="content">
  <div class="row">
  <div class="col-lg-12">
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
       <h4>View Users</h4>
       <a href="{{ route('users') }}" class="btn btn-success"> <i class="fa  fa-arrow-left "></i> Back</a>
    </div>
        <div class="card-body card-block">
             <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $view->name }}</td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>:</td>
                        <td>
                           @if ($view->photo)
                        <img src='{{  asset($view->photo) }}' width="100" alt="user-image">
                        @else
                        no photo
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $view->email }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{ $view->address }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection
