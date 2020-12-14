@extends('layouts.app')

@section('content')

    <div class="card justify-content-center">
        <div class="card-header">      
            {{ isset($tag)? "Update tag":"Creat tag" }}      
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ isset($tag)? route('tags.update', $tag->id) :
                 route('tags.store') }}" method="POST" >
                    @csrf
                    @if(isset($tag))
                        @method('PUT')
                    @endif
                    <div class="form-group ">
                            <label for="name" class="">Tag Name :</label>
                            <input type="text" value="{{ isset($tag)? $tag->name :'' }}"
                             name="name" class=" @error('name') is-invalid  @enderror form-control" 
                             placeholder="Tag Name" id="">
                            @error('name') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            {{ isset($tag)? "Update":"Add" }}      
                        </button>
                    </div>
                </form>
            </div>  
            
        </div>
    </div>
    
@endsection