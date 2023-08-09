@extends('layouts.app-master')

@section('content')
@auth
<form method="post" action="{{ route('blog.update',$blog->id) }}">
        @method('PUT')       
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <h1 class="h3 mb-3 fw-normal">Update Blog</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="title" value="{{ $blog->title }}" placeholder="Title" required="required" autofocus>
            <label for="floatingTitle">Title</label>
            @if ($errors->has('title'))
                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="floatingTextarea" name="content" style="height: 100px" value="{{ $blog->content }}" placeholder="Content">{{ $blog->content }}</textarea>
            <label for="floatingTextarea">Content</label>
            @if ($errors->has('content'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="tag" value="{{ $blog->tag }}" placeholder="Tags" autofocus>
            <label for="floatingTags">tags</label>
            @if ($errors->has('tag'))
                <span class="text-danger text-left">{{ $errors->first('tag') }}</span>
            @endif
        </div>
        @include('auth.partials.copy')
    
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update Blog</button>
    </div>
</form> 
    @endauth
@endsection