<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::check())
                        <li><a href="">Hello {{ Auth::user()->full_name }}</a></li>
                        <li><a href="{{ route('banhang.logout') }}">Đăng xuất</a></li>
                    @else
                        <li><a href="{{ route('banhang.signup') }}">Đăng kí</a></li>
                        <li><a href="{{ route('banhang.login') }}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px"
                        alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s"
                            placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    @if (Session::has('cart'))
                        <div class="cart">
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                ({{ Session::has('cart') ? Session('cart')->totalQty : 'Trống' }}) <i
                                    class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                                @foreach ($productCarts as $product)
                                    <div class="cart-item">
                                        <a class="cart-item-delete"
                                            href="{{ route('xoagiohang', $product['item']['id']) }}"><i
                                                class="fa fa-times"></i></a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img
                                                    src="source/image/product/{{ $product['item']['image'] }}"
                                                    alt=""></a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                                <span class="cart-item-amount">{{ $product['qty'] }}*<span>
                                                        {{ $product['item']['promotion_price'] == 0
                                                            ? number_format($product['item']['unit_price'])
                                                            : number_format($product['item']['promotion_price']) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="cart-caption">
                                    <div class="cart-total text-right">Subtotal: <span
                                            class="cart-total-value">{{ number_format(Session('cart')->totalPrice) }}đ</span>
                                    </div>

                                    <div class="clearfix"></div>
                                    @if (Session::has('dathang'))
                                        <div class="alert alert-success">{{ Session::get('dathang') }}</div>
                                    @endif
                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{ route('banhang.checkout') }}"
                                            class="beta-btn primary text-center">Checkout <i
                                                class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .cart -->
                    @endif
                </div>

                {{-- Wishlist --}}
                <div class="beta-comp">
                    @if(isset($wishlists))
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-heart"></i> Wishlist (@if(isset($wishlists)&&count($wishlists)>0){{$sumWishlist}}@else
                        Trống @endif)
                      </button>
          
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-item" style="width: 20em">
                          @for($i = 0; $i< count($wishlists);$i++) <div class="cart-item" id="cart-item{{$productsInWishlist[$i]->id}}">
                            <a class="cart-item-delete" href="wishlist/delete/{{$wishlists[$i]->id}}"><i
                                class="fa fa-times"></i></a>
                            <div class="media">
                              <a class="pull-left" href="#"><img src="source/image/product/{{$productsInWishlist[$i]->image}}"
                                  alt="product"></a>
                              <div class="media-body">
                                <span class="cart-item-title">{{$productsInWishlist[$i]->name}}</span>
                                <span class="cart-item-amount">{{$wishlists[$i]->quantity}}*<span
                                    id="dongia{{$productsInWishlist[$i]->id}}">@if($productsInWishlist[$i]->promotion_price==0){{number_format($productsInWishlist[$i]->unit_price)}}@else
                                    {{number_format($productsInWishlist[$i]->promotion_price)}}@endif</span></span>
                              </div>
                            </div>
                        </div>
                        @endfor
                      </div>
          
                      <div class="dropdown-item">
                        <div class="cart-caption">
                          <div class="cart-total text-right">Tổng tiền: <span
                              class="cart-total-value">@if(isset($wishlists)){{number_format($totalWishlist)}}@else
                              0 @endif đồng</span></div>
                          <div class="clearfix"></div>
          
                          <div class="center">
                            <div class="space10">&nbsp;</div>
                            <a href="{{ route('wishlist.order') }}" class="beta-btn primary text-center">Đặt hàng <i
                                class="fa fa-chevron-right"></i></a>
                          </div>
                        </div>
                      </div>
          
                    </div>
                  </div>
                </div> <!-- .wishlist -->
                @endif
              </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                    class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('banhang.index')}}">Trang chủ</a></li>
                    <li><a href="#">Loại sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach ($loai_sp as $loai)
                                <li><a href="/type/{{ $loai->id }}">{{ $loai->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="contacts.html">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
