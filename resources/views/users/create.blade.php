@extends('layouts.app')

@section('trix')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <div class="card justify-content-center">
        <div class="card-header">      
            Create User       
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{  route('users.store')  }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group ">
                            <label for="name" class="">Name :</label>
                            <input type="text" 
                             name="name" class=" @error('name') is-invalid  @enderror form-control" >
                            @error('name') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group ">
                        <label for="email" class="">Email :</label>
                        <input name="email" type="email"  class=" @error('email') is-invalid  @enderror form-control" >
                        @error('email') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 
                    <div class="form-group ">
                        <label for="role" class="">Role :</label>
                         <input name="role" type="text" class=" @error('role') is-invalid  @enderror form-control" >
                        @error('role') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                   </div>
                   <div class="form-group ">
                        <label for="password" class="">Password :</label>
                        <input name="password" type="password"  class=" @error('role') is-invalid  @enderror form-control" >
                        @error('role') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="image" class="">Image :</label>
                        <input type="file" name="image"  class="form-control">
                    </div>
                   
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            Create User
                        </button>
                    </div>
                </form>
            </div>  
            
        </div>
    </div>

@endsection  
   