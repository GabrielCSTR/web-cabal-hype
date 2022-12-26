@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">SHOP - CARRINHO</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">SHOP - CARRINHO
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
    <div class="row">
        <div class="col-12">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Produtos</th>
                        <th style="width:10%">Preço</th>
                        {{-- <th style="width:8%">Quantidade</th> --}}
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if ($itemsCart->count() > 0)
                        @foreach ($itemsCart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs mr-2"><img
                                                src="{{ asset('storage/shop/images/' . $details['image']) }}" width="100"
                                                height="100" class="img-responsive" /></div>
                                        <div class="col-sm-9">
                                            <h2 class="nomargin">{{ $details['Name'] }}</h2>
                                            <h4 class="nomargin">{{ $details['description'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">${{ $details['price'] }}</td>
                                {{-- <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}"
                                        class="form-control quantity update-cart" />
                                </td> --}}
                                <td data-th="Subtotal" class="text-center">
                                    ${{ $details['price'] * $details['quantity'] }}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm remove-from-cart"><i
                                            class="ft ft-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <h3><strong>Total ${{ $total }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right" data-th="">
                            <a href="{{ url('/shop/5') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                Continue Comprando</a>
                            <button class="btn btn-success buy-product">Comprar</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // $(".update-cart").change(function(e) {
        //     e.preventDefault();

        //     var ele = $(this);

        //     $.ajax({
        //         url: '{{ route('update.cart') }}',
        //         method: "patch",
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             id: ele.parents("tr").attr("data-id"),
        //             quantity: ele.parents("tr").find(".quantity").val()
        //         },
        //         success: function(response) {
        //             window.location.reload();
        //         }
        //     });
        // });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            Swal.fire({
                title: "Você tem certeza que deseja remover esse produto?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, Remover!",
                cancelButtonText: "Não, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('remove.from.cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });

        });

        $(".buy-product").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            Swal.fire({
                title: "Deseja comprar esses produtos?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, Comprar!",
                cancelButtonText: "Não, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('buy.product') }}',
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });

        });
    </script>
@endsection
