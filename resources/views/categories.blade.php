@extends('layouts.app')
@section('content')
    <div class="container">
        <section>
            <!-- Heading & Description -->
            <div class="wow fadeIn">
                <!--Section heading-->
                <h1 class="h1 text-center mb-5">Categories</h1>
                <section>
                    <div class="container">
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-lg-4">
                                    <img src="{{ asset('img/'.$category->photoURL) }}" class="img-thumbnail" style="width: 600px; height: 160px">
                                    <h3><a href="{{ route('category', [$category->name]) }}" class="nav-link"> {{ $category->name }} </a></h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>


            </div>
        </section>
@endsection

@section('footer_scripts')
    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
@endsection
