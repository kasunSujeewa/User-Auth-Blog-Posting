@extends('layouts.app-master')

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-5 rounded mb-3">
        @auth
        <h1>Blog</h1>
        <p class="lead">add your own blog posts</p>
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Blogs
          </button>
          <form action="" method="get">
            <div class="form-group mb-2">
                <input type="text" class="form-control" name="tags" value="{{ old('tags') }}" placeholder="Tags" autofocus>
            </div>
            <div class="buton-grp" style="display: flex;
            justify-content: end;">
                <button class="btn btn-sm btn-dark" type="submit" style="margin-right: 2%;">filter</button>
                <a href="/" class="btn btn-warning btn-sm">clear filter</a>
            </div>

          </form>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>

    @auth
        {{-- Blogs --}}
        @if ($blogs != null)
            
        @foreach ($blogs as $blog)

        <div class="card m-2">
            <div class="card-header text-end">
              Created By {{$blog->owner->name}}
            </div>
            <div class="card-body">
              <h5 class="card-title" style="display: flex;
              justify-content: space-between;">
                {{$blog->title}}
                <span class="text-end" style="color: gray">
                    #{{$blog->tag}}
                </span>
            </h5>
              <p class="card-text">
                  {{$blog->content}} 
              </p>
              @if (auth()->user()->id == $blog->owner->id)
              <div class="actions" style="display: flex;
              justify-content: right;">
                <a href="{{route('blog.edit',$blog->id)}}" class="btn btn-primary btn-sm" style="margin-right: 2%;">Edit</a>
                <div class="class-footer">
                  <form method="post" action="{{ route('blog.delete',$blog->id) }}">
                      @method('DELETE')
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>

              </div>
              @endif
            </div>
          </div>
            
        @endforeach
        <div class="d-flex justify-content-center">
          {{$blogs->links()}} 
      </div>
        @endif
    @endauth

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Blogs</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('blog.store') }}">
        
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                <h1 class="h3 mb-3 fw-normal">Add Blog</h1>
        
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title" required="required" autofocus>
                    <label for="floatingName">Title</label>
                    @if ($errors->has('title'))
                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="floatingTextarea" name="content" style="height: 100px" value="{{ old('content') }}" placeholder="Content"></textarea>
                    <label for="floatingTextarea">Content</label>
                    @if ($errors->has('content'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                  </div>

                  <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="tag" value="{{ old('tag') }}" placeholder="Tags" autofocus>
                    <label for="floatingTags">tags</label>
                    @if ($errors->has('tag'))
                        <span class="text-danger text-left">{{ $errors->first('tag') }}</span>
                    @endif
                </div>
                @include('auth.partials.copy')
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Blog</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection