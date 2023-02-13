@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">SHOP - PREMIUM</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">SHOP
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="media width-250 float-right">
            <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
            </media-left>
            <div class="media-body media-right text-right">
                <h3 class="m-0"> </h3>
                <span class="text-muted"></span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylev2.css') }}">
<div class="row">
    <div class="col-12">


<div class="market-container">
    <div class="marketInfo flex-s-c">
        <div class="marketInfo-left">
            <h1>SHOP - PREMIUM</h1>
        </div>
        <div class="marketInfo-right flex-s-c">
            <div class="marketInfo-deposit flex-s-c">
                <div class="marketInfo-deposit_coins">
                    <i class="icon icon-coin"></i>  {{ $cash ? $cash->CashTotal : 0 }}
                </div>
                <div class="marketInfo-deposit_button">
                    <a href="{{ route('donate.index') }}" class="button button-small login open_modal">Cash</a>
                </div>
            </div>
            <div class="marketInfo-cart">
                <p>Carrinho</p>
                @php $total = 0 @endphp
                {{-- <a href="{{ route('cart.index') }}">({{ count((array) session('cart')) }}) items</a> --}}
                <a href="{{ route('cart.index') }}">({{ $itemsCart }}) items</a>
            </div>
        </div><!--marketInfo-right-->
    </div><!--marketInfo-->
    <div class="market-content">
        <div class="filter flex-c-c">
            {{-- <span class="active"><i class="icon icon-swords"></i> Swords</span> --}}
            @foreach ($categorys as $category)
                <span class="{{ $page == $category->ProductCategoryID ? 'active' : '' }}" ><a href="{{ route('shop.index' ,$category->ProductCategoryID) }}"><i class="icon icon-swords"></i> {{ $category->Name }}</a></span>
            @endforeach
        </div><!--filter-->
        <div class="search">
            {{-- <input type="search" class="search-input" placeholder="Search..."> <button class="search-button"></button> --}}
        </div><!--search-->
        <div class="market-title-flex flex-s-c">
            <div class="market-title">
                <i class="icon icon-sword"></i> {{ $categoryName->Name }}
            </div>
        </div><!--market-title-flex-->
        {{-- <div class="info">
            <i class="icon icon-info"></i>
            <div class="infoBlock">
                <p>No items found!</p>
                <span>Please choose another items category or enter the correct search query.</span>
            </div>
        </div><!--info--> --}}
        <div class="itemsBlock flex-c-c">
            @foreach ($products as $product)
            <div class="item">
                @if($product->Destaque)
                    <div class="item-corner new-item"><span>New</span></div>
                @endif
                <div class="item-img flex-c-c">
                    @if (file_exists('storage/shop/images/'. $product->Image))
                        <img src="{{ asset('storage/shop/images/' . $product->Image) }}" alt="" width="120" height="120">
                    @endif
                </div>
                <div class="item-name">
                   {{ $product->Name }}
                </div>
                <div class="item-char">
                    {{ $product->Description }}
                </div>
                {{-- <div class="item-char-n">
                    3 ~ 7
                </div> --}}
                <div class="item-price">
                    <i class="icon icon-coin"></i>  {{ $product->Price }}
                </div>
                <div class="item-buy">
                    <a href="{{ route('add.to.cart', $product->ProductID) }}">Add to cart</a>
                </div>
            </div><!--item-->
            @endforeach
        </div><!--itemsBlock-->
        {{-- <ul class="pagination">
            <li><a href="#" class="pag-left number"></a></li>
            <li><a href="#" class="active number">1</a></li>
            <li><a href="#" class="number">2</a></li>
            <li><a href="#" class="number">3</a></li>
            <li><a href="#" class="number">4</a></li>
            <li><a href="#" class="number">5</a></li>
            <li><a href="#" class="number">6</a></li>
            <li><a href="#" class="number">...</a></li>
            <li><a href="#" class="number">25</a></li>
            <li><a href="#" class="pag-right number"></a></li>
        </ul> --}}
    </div><!--market-content-->
</div>
</div>
</div>
@endsection

