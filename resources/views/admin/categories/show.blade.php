@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Category N. {{$category->id}}</h1>
                <h2>{{$category->name}}</h2>
                <p>{{$category->slug}}</p>
            </div>
            <div class="col-12 mt-4">
                <h2>Posts with {{$category->name}}</h2>
                <ul>
                    @forelse ($category->posts as $post)
                        <li><a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></li>                        
                    @empty
                       <p>No posts with this category (yet)</p> 
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection