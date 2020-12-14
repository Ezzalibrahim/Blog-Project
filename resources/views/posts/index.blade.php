@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            All Posts
            <div class="float-right">
            <a href="{{ route('posts.create') }}" class="btn btn-success text-white">Create Post</a>
            </div>
        </div>  
        <div class="card-body">
            <div class="card-body">
            @if ($posts->count()>0)
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Image</th>
                  <th scope="col">Title</th>
                  @if (!$posts[0]->trashed())
                    <th scope="col">Edit</th>                          
                  @endif
                  @if ($posts[0]->trashed())
                    <th scope="col">Restore</th>                                              
                  @endif

                  
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($posts as $post )
                  <tr>
                    <td>
                       <img src="{{ asset('storage/'.$post->image) }}" width="100px" height="75px" alt="" srcset="">
                    </td>
             
                    <td>{{ $post->title}}</td>
                    @if (!$post->trashed())
                      <td>
                        <a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm">
                          Edit
                        </a>
                      </td> 
                      @else
                      <td>
                        <a href="{{ route('trashed.restore',$post->id)}}" class="btn btn-info btn-sm">
                          Restore
                        </a>
                      </td>    
                    @endif
                    
                    <td> 
                          <form action="{{ route('posts.destroy',$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              {{ $post->trashed() ?'Delete':'Trash' }}
                            </button>
                          </form>
                    </td>
                     

                  </tr>
                @endforeach                
              </tbody>
            </table>
            @else
            
      <h1 class="text-center">No Posts Yet </h1>

            @endif
                

        </div>
    </div>

@endsection