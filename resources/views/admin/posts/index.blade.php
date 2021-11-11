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
    <h1 class="mb-2">Posts</h1>
    <table class="table table-striped">
        <thead>
          <tr> 
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
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
                  @if ($post->category)
                    {{$post->category->name}}
                  @endif
                </td>                  
                <td>
                  @if ($post->tags)
                    @foreach ($post->tags as $tag)
                      @if ($loop->last)
                        {{($tag->name)}}                       
                      @else
                        {{($tag->name.',')}}
                      @endif
                    @endforeach
                  @endif
                </td>                  
                <td>
                    <a class="btn btn-info" href="{{route('admin.posts.show', $post['id'])}}">Details</a>
                    <a class="btn btn-warning" href="{{route('admin.posts.edit', $post['id'])}}">Modify</a>
                    <form class="d-inline-block delete-post" method="post" action="{{route('admin.posts.destroy', $post['id'])}}">
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