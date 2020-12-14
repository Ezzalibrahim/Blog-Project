@extends('layouts.app')

@section('content')
    <div class="card">
  
        <div class="card-body">
          <div class="float-right mb-2">
            <a href="{{ route('users.create') }}" class="btn btn-success text-white">Create User</a>
        
            </div>
            <div class="card-body">
            @if ($users->count()>0)
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Image</th>
                  <th scope="col">Username</th>
                  <th scope="col">Role</th>         
                  <th scope="col">Change Role</th>         
                  
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user )
                  <tr>
                    <td>
                        <img src="{{ asset('storage/'.$user->image) }}" width="100px" height="75px" alt="" srcset="">
                        <span>Avatar</span>
                    </td>
                    <td>{{ $user->name}}</td>
                    <td >                     
                        {{ $user->role}}
                    </td>
                    <td>
                      @if (!$user->isAdmin())
                      <form method="POST"  action="{{ route('users.make-admin',$user->id) }}">
                        @csrf
                        <button class="btn btn-success" type="submit">
                          Make Admin</button>    
                      </form>
                    @else
                    <form method="POST"  action="{{ route('users.make-writer',$user->id) }}">
                      @csrf
                      <button class="btn btn-success " type="submit">
                        Make Writer</button>    
                    </form>
                    @endif
                    </td>
                  </tr>
                @endforeach                
              </tbody>
            </table>
            @else
              <h1 class="text-center">No Users Yet </h1>
            @endif
                

        </div>
    </div>

@endsection