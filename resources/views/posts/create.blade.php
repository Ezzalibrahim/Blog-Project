@extends('layouts.app')

@section('trix')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <div class="card justify-content-center">
        <div class="card-header">      
            {{ isset($post)? "Update Post":"Create Post" }}      
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ isset($post)? route('posts.update', $post->id) :
                 route('posts.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif
                    <div class="form-group ">
                            <label for="title" class="">Title :</label>
                            <input type="text" value="{{ isset($post)? $post->title :'' }}"
                             name="title" class=" @error('title') is-invalid  @enderror form-control" 
                             placeholder="Post Title" id="">
                            @error('title') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group ">
                        <label for="description" class="">Description :</label>
                        <textarea  rows="2"
                         name="description" class=" @error('description') is-invalid  @enderror form-control" 
                         placeholder="Post Description" id="">{{ isset($post)? $post->description :'' }}</textarea>
                        @error('description') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                   </div>
                    <div class="form-group ">
                        <label for="content" class="">Content :</label>
                        <input id="x" type="hidden" name="content" value="{{ isset($post)? $post->content :'' }}">
                        <trix-editor input="x" class=" @error('content') is-invalid  @enderror form-control" ></trix-editor>
                        @error('content') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 
                    @if (isset($post))
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$post->image) }}" width="100%" alt="" srcset="">
                        </div>    
                    @endif
                    <div class="form-group">
                        <label for="select_category">Category : </label>
                        <select name="category_id" class="form-control" id="select_category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$tags->count() == 0)
                        <div class="form-group">
                            <label for="select_tag">Tag : </label>
                            <select name="tags[]" class="form-control tags" id="select_tag" multiple>
                                @foreach ($tags as $tag)
                                    <option  value="{{ $tag->id }}"
                                        @if (isset($post))
                                            @if ($post->hasTag($tag->id))
                                            selected
                                            @endif
                                        @endif
                                        >{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group ">
                        <label for="title" class="">Image :</label>
                        <input type="file" name="image"  class="form-control">
                    </div>
                   
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            {{ isset($post)? "Update":"Add" }}      
                        </button>
                    </div>
                </form>
            </div>  
            
        </div>
    </div>

@endsection  
    @section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script >
    $(document).ready(function(){
        $('.tags').select2();
    });
</script>
@endsection