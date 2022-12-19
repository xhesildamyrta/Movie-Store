@extends('layouts.app')
@section('head_scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <section class="mb-5">

        <!-- Heading & Description -->
        <div class="wow fadeIn">
            <!--Section heading-->

            <section>
                <div class="container">
                    <div class="row">
                        <nav class="nav" style="margin:auto">
                            <a class="nav-link disabled cat-name target-category" id="{{ $category[0]->id }}" href="#">{{ $category[0]->name }}</a>
                            @foreach($categories as $cat)
                                @if($cat->name !== $category[0]->name)
                                    <a class="nav-link target-category" href="#" id="{{ $cat->id  }}">{{ $cat->name }}</a>
                                @endif
                            @endforeach
                        </nav>
                    </div>
                    <br><br>
                    <div class="row" id="result">
                        @foreach($products as $product)
                            <div class="col-lg-4">
                                <img src="{{ asset('img/'.$product->video->photoURL) }}" class="banner">
                                <h3>
                                    <a href="{{ route('product', ['category' => $category[0]->name, 'product' => $product->video->title]) }}"
                                       class="nav-link">{{ $product->video->title }} </a></h3>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>

            <!--Pagination-->

            <!--Pagination-->
        @endsection
        @section('footer_scripts')
            <!-- JQuery -->
                <script
                    src="https://code.jquery.com/jquery-3.6.0.min.js"
                    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
                    crossorigin="anonymous">
                </script>
    <script>
        $(".target-category").click(function(event){
            event.preventDefault();

            let catId = $(this).attr('id');
            let name = $(".cat-name").html();
            $.ajax({
                url: "/ajax",
                data:{
                    catId: catId,
                    name: name
                },
                success:function(response){
                        $('#result').replaceWith(response);
                        $('.cat-name').removeClass('disabled');
                    $('.target-category').removeClass('disabled');
                    $('#' + catId).addClass('disabled');

                },
            });
        });
    </script>
@endsection
