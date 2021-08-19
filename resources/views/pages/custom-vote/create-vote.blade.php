@extends('layouts.app')

@section('title')
   edit Vote
@endsection
@section('content')
<div class="content">
    <form action="{{ route('admin.votes.store') }}" method="post" class="form-horizontal">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Back</h3>
                        <a href="{{ route('admin.votes') }}" class="btn btn-success">   Back</a>
                     </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="vote" class=" form-control-label">Vote </label>
                            <input type="number" required id="vote" value="{{ old('vote') }}" name="vote" class="form-control" >
                            <input type="hidden" value="{{ $id }}" name="project_id">
                            @if($errors->has('vote'))
                                <div class="text-danger">{{ $errors->first('vote') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
