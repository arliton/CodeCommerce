@extends('store.store')

@section('categories')
    @include('store.categories')
@stop

@section('products')
    <div class="col-sm-9 padding-right">

        <?php $num_images = count($product->images); ?>

        <div class="product-details"><!--product-details-->
            <div class="col-sm-5" >
                @if($num_images)
                    <img src="{{ url('uploads/'.$product->images->first()->id . '.' .$product->images->first()->extension) }}" width="400" />
                @else
                    <img src="{{ url('images/no-img.jpg') }}" alt="" width="200" />
                @endif
            </div>

            <div class="col-sm-6" >
                <div class="product-information"><!--/product-information-->

                    <h2>{{ $product->category->name }} :: {{ $product->name }}</h2>

                    <p>{{ $product->description }}</p>

                    <br>

                    <p>
                        <i><h5>Tags: </h5></i>
                        @foreach($product->tags as $tag)
                            <i><a href="{{ route('store.tags', ['id' => $tag->id]) }}" >{{ $tag->name }}</a></i>
                        @endforeach
                    </p>

                    <br>

                    <span>R$ {{ $product->price }}</span>
                        <a href="#" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>Adicionar no Carrinho</a>
                    </span>

                </div>
                <!--/product-information-->
            </div>


            <div class="col-sm-7">

                @if($num_images > 1)
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php $count = 0; ?>
                            @while($count < $num_images)
                                @if($count == 0)
                                    <li data-target="#carousel-example-generic" data-slide-to="{{ $count }}" class="active"></li>
                                @else
                                    <li data-target="#carousel-example-generic" data-slide-to="{{ $count }}"></li>
                                @endif
                                <?php $count++; ?>
                            @endwhile
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php $count = 0; ?>
                            @foreach($product->images as $image)
                                @if($count == 0)
                                    <div class="item active">
                                        <img src="{{ url('uploads/'.$image->id . '.' .$image->extension) }}" width="600" height="200">
                                    </div>
                                @else
                                    <div class="item">
                                        <img src="{{ url('uploads/'.$image->id . '.' .$image->extension) }}" width="600" height="200">
                                    </div>
                                @endif
                                    <?php $count++; ?>
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                @endif

            </div>

        <!--/product-details-->
        </div>
    </div>
@endsection