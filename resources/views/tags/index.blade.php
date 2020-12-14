@extends('layouts.app')

@section('content')
        @if (session()->has('error'))
        <div class="alert alert-danger">
          {{ session()->get('error') }}
        </div>
        @endif
        <div class="clearfix">
            <div class="float-right">
            <a href="{{ route('tags.create') }}" class="btn btn-success mb-3" type="button">Create Tag</a>
            </div>
        </div>
        <div class="card">
          
            <div class="card-header">
                All Tags
            </div>
      
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Creted at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag )
                        <tr>
                            <td>
                              {{ $tag->name}}
                             <span class="ml-2 badge badge-primary">
                                {{ $tag->posts()->count() }}
                             </span>
                            </td>
                            <td>{{ $tag->created_at }}</td>
                            <td>{{ $tag->updated_at }}</td>
                            <td> 
                              <a href="{{ route('tags.edit',$tag->id)}}" class="btn btn-primary btn-sm">
                                Edit
                              </a>
                            </td>
                            <td> 
                                <form action="{{ route('tags.destroy',$tag->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger btn-sm">
                                    Delete
                                  </button>
                                </form>
                            </td>
                        </tr>
                      @endforeach                
                    </tbody>
                  </table>


            </div>
        </div>

@endsection