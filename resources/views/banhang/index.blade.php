@extends('layout.master')
@section('content')
<div class="rev-slider">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                        @foreach($slide as $sl)
                        <!-- THE FIRST SLIDE -->
                        <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="source/image/slide/{{ $sl->image}}" data-src="source/image/slide/{{ $sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{ $sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;"></div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </div>
            </div>

            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->
</div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>New Products</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">438 styles found</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($new_products as $pro)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="product.html"><img src="/source/image/product/{{ $pro->image }}"
                                                        alt="" style="width: 20em; height:20em"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $pro->name }}</p>
                                                <div class="single-item-price" style="margin: 1rem 0;">
                                                    <div style="text-decoration: line-through">
                                                        {{ $pro->promotion_price != 0 ? $pro->unit_price : '' }}</div>
                                                    <div class="text-danger" style="font-size: 1.3rem">
                                                        {{ $pro->promotion_price != 0 ? $pro->promotion_price : $pro->unit_price }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart', $pro->id)}}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="product.html">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>
                        {{ $products->links() }}
                        <div class="beta-products-list">
                            <h4>All Products</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">438 styles found</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($products as $pro)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="product.html"><img src="/source/image/product/{{ $pro->image }}"
                                                        alt="" style="width: 20em; height:20em"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $pro->name }}</p>
                                                <div class="single-item-price" style="margin: 1rem 0;">
                                                    <div style="text-decoration: line-through">
                                                        {{ $pro->promotion_price != 0 ? $pro->unit_price : '' }}</div>
                                                    <div class="text-danger" style="font-size: 1.3rem">
                                                        {{ $pro->promotion_price != 0 ? $pro->promotion_price : $pro->unit_price }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart', $pro->id)}}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="product.html">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="space40">&nbsp;</div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->
            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
