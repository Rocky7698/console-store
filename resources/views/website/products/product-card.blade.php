<div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
    <div class="product-item-inner border rounded">
        <div class="product-item-inner-item">
            <img src="{{ ($product->image) }}"class="img-fluid w-100 rounded-top" alt="">
            <div class="product-new">New</div>
            <div class="product-details">
                <a href="{{ route('website.products.show', [$product->id]) }}"><i class="fa fa-eye fa-1x"></i></a>
            </div>
        </div>
        <div class="text-center rounded-bottom p-4">
            <a href="{{ route('website.products.show', [$product->id]) }}" class="d-block mb-2">Cansole</a>
            <a href="{{ route('website.products.show', [$product->id]) }}"
                class="d-block h4">{{ ucfirst($product->name) }} </a>
            <del class="me-2 fs-5">₹{{ $product->price }}</del>
            <span class="text-primary fs-5">₹{{ $product->price }}</span>
        </div>
    </div>
    <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
        <a href="{{ route('website.carts.create', [$product->id]) }}"
            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star"></i>
            </div>
            <div class="d-flex">
                {{-- <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a> --}}
            </div>
        </div>
    </div>
</div>
