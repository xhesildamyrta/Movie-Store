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
            <h2 class="text-left card-title mb-5">Updateproduct</h2>
            <form action="{{ route('modify-post', ['id' => $product->id]) }}" method="POST" id="new-product">
                {{ csrf_field() }}
                <div class="row flex-wrap">
                    <div class="col-sm-6 mb-2">
                        <div>
                            <label for="runtime" class="h4">Runtime:</label>
                            <input type="text" name="runtime" id="Runtime" value="{{ $product->runtime }}" class="col-xl-12" required>
                            <br>
                            <label for="photoURL" class="h4">Photo URL:</label>
                            <input type="text" name="photoURL" id="photoURL" value="{{ $product->photoURL }}" class="col-xl-12" required>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title" class="h4">Title:</label><br>
                            <input type="text" name="title" id="title" value="{{ $product->title }}" class="col-xl-12" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="h4">Description:</label><br>
                            <textarea name="description" id="description"  rows="10" class="col-xl-12" required>
                                {{ trim($product->description)}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="year" class="h4">Year of release:</label><br>
                            <input type="number" name="year" id="year" min="1900" max="2021" class="col-xl-12" value="{{ $product->yearOfRelease }}" required>
                        </div>
                        <div class="form-group">
                            <label for="rental" class="h4">Rental Price:</label><br>
                            <input type="number" name="rental" id="rental" min="0" class="col-xl-12" value="{{ $product->rentalPrice }}">
                        </div>
                        <div class="form-group">
                            <label for="rating" class="h4">Rating:</label><br>
                            <input type="number" name="rating" id="rating" min="0" class="col-xl-12" value="{{ $product->rating }}" required>
                        </div>
                        <div class="form-group">
                            <label for="trailerURL" class="h4">Trailer URL:</label><br>
                            <input type="text" name="trailerURL" id="trailerURL" value="{{ $product->trailerURL }}" class="col-xl-12" required>
                        </div>
                        <div class="form-group">
                            <label for="video" class="h4">Video URL:</label><br>
                            <input type="text" name="video" value="{{ $product->videoURL }}" id="video" required>
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
