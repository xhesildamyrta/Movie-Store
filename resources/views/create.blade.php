@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-left card-title mb-5">Add new product</h2>
            <form action="{{ route('create-post') }}" method="POST" id="new-product" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row flex-wrap">
                    <div class="col-sm-6 mb-2">
                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                             alt="preview image" class="mb-5 img-fluid img-thumbnail">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Choose image" id="image">
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <label for="photoURL" class="h4">Image Url:</label>
                            <input type="text" name="photoURL" id="photoURL" placeholder="Image URL here..." class="col-xl-12" required>
                        </div>
                        <br>
                        <div>
                        <label for="runtime" class="h4">Runtime:</label>
                        <input type="text" name="runtime" id="Runtime" placeholder="Runtime here..." class="col-xl-12" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title" class="h4">Title:</label><br>
                            <input type="text" name="title" id="title" placeholder="Title here..." class="col-xl-12" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="h4">Description:</label><br>
                            <textarea name="description" id="description" placeholder="Description here..." rows="10" class="col-xl-12" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="year" class="h4">Year of release:</label><br>
                            <input type="number" name="year" id="year" min="1900" max="2021" class="col-xl-12" placeholder="Year of release here..." required>
                        </div>
                        <div class="form-group">
                            <label for="categories" class="h4">Categories:</label><br>
                            @foreach($categories as $category)
                                <input type="checkbox" id="category" name="category[]" value="{{ $category->id }}">

                                <label for="category">{{ $category->name }}</label><br>
                                @endforeach
                        </div>
                        <div class="form-group">
                            <label for="rental" class="h4">Rental Price:</label><br>
                            <input type="number" name="rental" id="rental" min="0" class="col-xl-12" placeholder="Rental price here...">
                        </div>
                        <div class="form-group">
                            <label for="rating" class="h4">Rating:</label><br>
                            <input type="number" name="rating" id="rating" min="0" class="col-xl-12" placeholder="Rating here..." required>
                        </div>
                        <div class="form-group">
                            <label for="trailerURL" class="h4">Trailer URL:</label><br>
                            <input type="text" name="trailerURL" id="trailerURL" placeholder="Trailer URL here..." class="col-xl-12" required>
                        </div>
                        <div class="form-group">
                            <label for="video" class="h4">Video URL:</label><br>
                            <input type="text" name="video" placeholder="Enter Video Url..." id="video" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3" id="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </main>
@endsection
@section('footer_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
