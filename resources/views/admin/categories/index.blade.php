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
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category['id']}}</th>
                <td>{{$category['name']}}</td>
                <td>{{$category['slug']}}</td>                  
                <td>
                    <a class="btn btn-info" href="{{ route('admin.categories.show', $category->id) }}">Details</a>
                    <a class="btn btn-warning" href="">Modify</a>
                    <form class="delete-post" method="post" action="">
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