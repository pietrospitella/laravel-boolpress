@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Edit Post</h1>
                <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$post->title)}}">
                    @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror">{{old('content',$post->content)}}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">--Select a category--</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : NULL}}>{{$category->name}}</option> 
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection