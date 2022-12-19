
<div class="row" id="result">
    @foreach($products as $product)
        <div class="col-lg-4">
            <img src="{{ asset('img/'.$product->video->photoURL) }}" class="banner">
            <h3>
                <a href="{{ route('product', ['category' => $name, 'product' => $product->video->title]) }}"
                   class="nav-link">{{ $product->video->title }} </a></h3>
        </div>
    @endforeach
</div>
