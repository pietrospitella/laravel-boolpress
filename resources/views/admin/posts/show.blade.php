@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Post N. {{$post->id}}</h1>
                <p>{{$post->content}}</p>
                <h4>linked categories: <a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a></h4>
            </div>
        </div>
    </div>
@endsection