@extends('layouts.app')

@section('content')

    <div class="card justify-content-center">
        <div class="card-header">      
            {{ isset($categorie)? "Update Categorie":"Creat Categorie" }}      
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ isset($categorie)? route('categorie.update', $categorie->id) :
                 route('categorie.store') }}" method="POST" >
                    @csrf
                    @if(isset($categorie))
                        @method('PUT')
                    @endif
                    <div class="form-group ">
                            <label for="name" class="">Categorie Name :</label>
                            <input type="text" value="{{ isset($categorie)? $categorie->name :'' }}"
                             name="name" class=" @error('name') is-invalid  @enderror form-control" 
                             placeholder="Categorie Name" id="">
                            @error('name') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            {{ isset($categorie)? "Update":"Add" }}      
                        </button>
                    </div>
                </form>
            </div>  
            
        </div>
    </div>
    
@endsection