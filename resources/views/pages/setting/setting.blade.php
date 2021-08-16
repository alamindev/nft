@extends('layouts.app')
@section('title')
Setting
@endsection
@section('content')
<form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="content">
   <div class="card">
    <div class="card-header">
        Update Setting
    </div>
        <div class="card-body card-block">
                @csrf
                <input type="hidden" name="id" value="{{ $setting ? $setting->id : '' }}"/>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="site_logo" class=" form-control-label">Header Logo </label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" id="site_logo" name="site_logo" class="form-control-file">
                        @if($errors->has('site_logo'))
                                <div class="alert alert-danger">{{ $errors->first('site_logo') }}</div>
                            @endif
                            <div  class="py-2">
                        @if(!empty($setting) && $setting->site_logo != '')
                            <img src="{{ url('storage'.$setting->site_logo) }}" alt="site logo" width="100">
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="favicon" class=" form-control-label">Fav icon </label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" id="favicon" name="favicon" class="form-control-file">
                        @if($errors->has('favicon'))
                                <div class="alert alert-danger">{{ $errors->first('favicon') }}</div>
                            @endif
                            <div  class="py-2">
                        @if(!empty($setting) && $setting->favicon != '')
                            <img src="{{ url('storage'.$setting->favicon) }}" alt="site logo" width="100">
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="copyright" class="form-control-label">Copyright</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="copyright" value="{{ $setting ? $setting->copyright : old('copyright') }}"  name="copyright" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </div>
</form>
@endsection
