@extends('layouts.dashboard')

@section('content')
    {{-- <ul>
        @foreach ($posts as $post)
            <li><a href="{{route('admin.posts.show',$post->slug)}}">{{$post->title}}</a><li>
        @endforeach
    </ul> --}}

    @if (session('status'))
        <div class="alert alert-info">{{session('status')}}</div>
    @endif

    <table class="table table-striped">
        <thead>
          <tr> 
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post['id']}}</th>
                <td>{{$post['title']}}</td>
                <td>{{$post['slug']}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('admin.posts.show', $post['id'])}}">Details</a>
                    <a class="btn btn-warning" href="{{route('admin.posts.edit', $post['id'])}}">Modify</a>
                    <form class="delete-post" method="post" action="{{route('admin.posts.destroy', $post['id'])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>                            
            </tr>
          @endforeach
        </tbody>
      </table>
@endsection