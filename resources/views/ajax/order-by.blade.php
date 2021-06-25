@foreach ($products as $product)
    @php
        $image = '';
        if(count($product->images) > 0){
            $image = $product->images[0]['img'];
        } else {
            $image = 'img/no_image.png';
        }
    @endphp


    <div class="catalog-item">
        <div class="image_catalog-item">
            <a href="/catalog/{{$product->category['titleID']}}/{{$product['titleID']}}_{{$product['id']}}"><img src="/{{$image}}" alt="item"></a>
        </div>
        <h3><a href="/catalog/{{$product['titleID']}}_{{$product['id']}}">{{$product['title']}}</a></h3>
        <p class="price-collection">{{$product['price']}}<sub class="currency-collection">руб.</sub></p>
    </div>

@endforeach
