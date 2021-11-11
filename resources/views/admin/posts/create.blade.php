@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>New Post</h1>
                <form action="{{route('admin.posts.store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                    @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">--Select a category--</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"{{old('category_id') == $category->id ? 'selected' : NULL}}>{{$category->name}}</option> 
                        @endforeach
                    </select>
                   
                </div>
                <div class="form-group">
                    <p>Select tags</p>
                    @foreach ($tags as $tag)
                        <div class="form-check form-check-inline">
                            <input value="{{$tag->id}}" id="{{'tag'.$tag->id}}" type="checkbox" name="tags[]" class="form-check-input">
                            <label for="{{'tag'.$tag->id}}" class="form-check-label">{{$tag->name}}</label>                        
                        </div>                        
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection