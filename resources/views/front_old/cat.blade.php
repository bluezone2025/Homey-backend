@extends('layouts.front')
@section('title', $records->name)

@section('id', $records->id)
@section('cat_or_sub', 1)
@section('new_titles')
    <div class="container  border-main"><br>
        <div class="row  ">
            <div class="col-md-2 col-12 ">
                <h3
                    style="border-radius: 5px;padding: 10px 15px;background-color: #180a1a;color: white;margin-bottom: 15px">
                    Filter
                </h3>
                <hr>

                <ul>
                    @foreach ($sub_sub_cat as $sub)
                        <li>
                            <a href="{{ route('sub.cat.products', $sub->id) }}" style="font-weight: bold">
                                {{ $sub->name_en }}
                            </a>

                        </li>
                    @endforeach
                </ul>
                <hr>

            </div>
            <div class="col-md-10 col-12">
                <div class="row  ">

                    <h3
                        style="width: 100%;border-radius: 5px;margin: 0 15px;padding: 10px 15px;background: linear-gradient(90deg, rgba(0,24,36,1) 0%, rgba(9,32,121,1) 53%, rgba(0,212,255,1) 100%);color: white">
                        {{ $records->name_en }} </h3>
                @endsection
                @section('content')
                    @if ($populars->count() < 1)

                        <p style="text-align: center ;width: 100%;margin: 30px">
                            لا يوجد منتجات في هذا القسم
                        </p>
                    @else
                        @foreach ($populars as $one)
                            <div class=" col-6 col-md-4 col-lg-3 ">
                                <br>
                                <div class="card ">
                                    <h6 class="bg-main abs">ref:{{ $one->id }}</h6>
                                    <a href="{{ route('product', $one->id) }}">
                                        <div class="h-resp" style="height:38vh;overflow:hidden">

                                            <img style="
      width: auto;display: block;
      margin-left: auto;
      margin-right: auto;" src="{{ asset($one->img) }}" class="card-img-top  " alt="...">
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ route('product', $one->id) }}"
                                            class="card-text ">{{ $one->name_en }}</a>
                                        <p class="card-title" href=""><b> {{ get_price_helper($one->price,true) }}</b></p>

                                    </div>
                                    <div class="row mr-0">
                                        <a href="{{ route('add.cart', [$one->id, 1]) }}" class="btn btn-dark border col-9">add
                                            to cart</a>
                                        @if (!Auth::guard('client')->check())
                                            <div class="btn btn-light border col-3 heart text-center"><a
                                                    href="{{ route('login/client') }}"><i
                                                        class="fas fa-heart heart-none"></i><i
                                                        class="far fa-heart  heart-block"></i></a></div>
                                        @elseif(Auth::guard('client')->check())
                                            <div class="addToWishlist btn btn-light border col-3 heart text-center"
                                                data-product-id="{{ $one->id }}"> <i
                                                    class="fas fa-heart heart-none"></i><i
                                                    class="far fa-heart  heart-block"></i>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <br>
                {{ $populars->appends(request()->query())->links() }}
                <br><br>
            </div>
        </div>
    </div>
    <br><br>



@stop





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).on('click', '.addToWishlist', function(e) {

        e.preventDefault();
        $.ajax({
            type: 'get',
            url: "{{ route('wishlist.store') }}",
            data: {
                'productId': $(this).attr('data-product-id'),
            },
            success: function(data) {
                if (data.message) {
                    alert(data.message)
                } else {
                    alert('This product already in you wishlist');
                }
            }
        });


    });
</script>
