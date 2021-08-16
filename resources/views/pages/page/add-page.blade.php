 @extends('layouts.app')

@section('title')
   Add new page or post
@endsection

@section('style')
    <link href="{{ asset('assets/css/lib/chosen/chosen.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
    <form action="{{ route('page.store') }}" method="post"  enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                       Page
                    </div>
                    <div class="card-body card-block">

                        <div class="form-group">
                            <label for="title" class=" form-control-label">Menu name <span class="text-danger">*</span></label>
                            <input type="text" required id="title" value="{{old('title')}}" name="title" class="form-control" placeholder="Enter Page title">
                            @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="type" class=" form-control-label">Menu Type <span class="text-danger">*</span></label>
                            <select type="text" required id="type" name="menu_type" class="form-control">
                                <option value="0">Header Menu</option>
                                <option value="1">Footer Menu</option>
                            </select>
                            @if($errors->has('menu_type'))
                                <div class="text-danger">{{ $errors->first('menu_type') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="thumb" class=" form-control-label">Upload Photo<span class="text-danger">*</span></label>
                           <input  type="file" name="thumb"   id="thumb" class="form-control" />
                            @if($errors->has('thumb'))
                                <div class="text-danger">{{ $errors->first('thumb') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-control-label">Description<span class="text-danger">(optional)</span></label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                          <div class="form-group">
                            <label for="keyword" class=" form-control-label">keyword <span class="text-danger">(optional)</span></label>
                            <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Enter keywords">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script src="{{ asset('assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
<script>

     CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{asset('/admin/page/uploads?_token=' . csrf_token()) }}&type=file",
            imageUploadUrl: "{{asset('/admin/page/uploads?_token='. csrf_token() )  }}&type=image",
            filebrowserBrowseUrl: "{{asset('/admin/page/file_browser') }}",
            filebrowserUploadMethod: 'form'
		});
    jQuery("#category").chosen({
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });
</script>
@endpush
