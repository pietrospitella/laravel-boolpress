@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Post N.{{$post->id}}</h1>
                <p>{{$post->content}}</p>
            </div>
        </div>
    </div>
@endsection