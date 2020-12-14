@extends('layouts.app')

@section('content')
        @if (session()->has('error'))
        <div class="alert alert-danger">
          {{ session()->get('error') }}
        </div>
        @endif
        <div class="clearfix">
            <div class="float-right">
            <a href="{{ route('categorie.create') }}" class="btn btn-success mb-3" type="button">Create Categorie</a>
            </div>
        </div>
        <div class="card">
          
            <div class="card-header">
                All Categories
            </div>
      
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Categorie Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Creted at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $categorie )
                        <tr>
                            <td>{{ $categorie->id }}</td>
                            <td>{{ $categorie->name}}</td>
                            <td>{{ $categorie->created_at }}</td>
                            <td>{{ $categorie->updated_at }}</td>
                            <td> 
                              <a href="{{ route('categorie.edit',$categorie->id)}}" class="btn btn-primary btn-sm">
                                Edit
                              </a>
                            </td>
                            <td> 
                                <form action="{{ route('categorie.destroy',$categorie->id)}}" method="POST">
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