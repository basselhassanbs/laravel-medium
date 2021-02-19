@extends('articles.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">New Article</h1>
        <form method="POST" action="/articles" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                        <div class="form-group">
                            <label class="lead" for="title">Article Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') border-danger @enderror" 
                                value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @enderror
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                        <div class="form-group">
                            <label class="lead" for="excerpt">Article Excerpt</label>
                            <textarea 
                                class="form-control @error('excerpt') border-danger @enderror" 
                                id="excerpt" 
                                name="excerpt" 
                                rows="3"
                                >{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <p class="text-danger">{{ $errors->first('excerpt') }}</p>
                            @enderror
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="lead" for="body">Article Body</label>
                        <textarea 
                            class="form-control @error('body') border-danger @enderror" 
                            id="body" 
                            name="body" 
                            rows="3"
                            >{{ old('body') }}</textarea>
                        @error('body')
                                <p class="text-danger">{{ $errors->first('body') }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                      <label class="lead" for="filenames">Add at least one photo</label>
                      <input type="file" name="filenames[]" class="form-control @error('filenames') border-danger @enderror" multiple>
                        @error('filenames')
                            <p class="text-danger">{{ $errors->first('filenames') }}</p>
                        @enderror
                      <small id="helpId" class="text-muted"></small>
                    </div>
                </div>
            </div>
            <label class="lead" for="body">Article Tags</label>
            <div class="input_fields_wrap row">
                <div class="form-group col-2">
                    <input type="text" name="tags[]" class="form-control @error('tags.*') border-danger @enderror">
                    @error('tags.*')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <button class="add_field_button btn btn-info">+</button>
                    <button class="remove_field_button btn btn-danger">-</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>            
        </form>
    </div>
    @endsection
    @section('script')

    <script>
        $(document).ready(function() {
    var max_fields      = 6; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var remove_button   = $(".remove_field_button"); //Remove button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
        $(wrapper).append('<div id="input" class="form-group col-2"><input class="form-control" type="text" name="tags[]"/>');
        }
    });
    $(remove_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x >1){
            $("#input").remove(); 
            x--;
        }
    });
});
    </script>

    @endsection