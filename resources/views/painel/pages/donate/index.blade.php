@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Donate - Account ( {{ mb_strtoupper(Auth::user()->ID) }} )</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Donate
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
    <div class="market-container">
        <div class="marketInfo flex-s-c">
            <div class="marketInfo-left">
                <h1>Donate</h1>
            </div>
            <div class="marketInfo-right flex-s-c">
                <div class="marketInfo-deposit flex-s-c">
                    <div class="marketInfo-deposit_coins">
                        <i class="icon icon-coin"></i> {{ $cash->CashTotal }}
                    </div>
                    <div class="marketInfo-deposit_button">
                        <a href="#" class="button button-small">CASH</a>
                    </div>
                </div>
            </div>
            <!--marketInfo-right-->
        </div>
        <!--marketInfo-->
        <div class="market-content">
            <div class="market-title">
                <i class="icon icon-plus-dark"></i> Planos
            </div>
            <div class="depositBlocks flex-c-c">
                {{-- @foreach ($plans as $plan)
                    <div class="depositBlock flex-c">
                        <span class="depositBlock-check"></span>
                        <span class="depositBlock-coin coin-1"></span>
                        <div class="depositBlock-info">
                            <p class="depositBlock-cash">{{ $plan->Cash }}</p>
                            <span>Cash</span>
                        </div>
                        <input type="hidden" class="depositBlock-plan"  value="{{ $plan->Name }}"/>
                        <span class="depositBlock-price">{{ $plan->Price }}</span>
                    </div>
                @endforeach --}}

                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-1"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">2.000</p>
                        <span>Cash</span>
                    </div>
                    <span class="depositBlock-price">
                        <span class="depositBlock-price"><script src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                            data-preference-id="573815282-559881c4-c677-4745-9d93-8c334e59178f" data-source="button">
                            </script></span>

                    </span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-2"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">2.000</p>
                        <span>Cash</span>
                    </div>
                    <span class="depositBlock-price">$20</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-2"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">3.000</p>
                        <span>Cash</span>
                    </div>
                    <span class="depositBlock-price">$30</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-3"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">5.000</p>
                        <span>Cash</span>
                    </div>
                    <span class="depositBlock-price">$50</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-4"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">10.000</p>
                        <span>Cash</span>
                    </div>
                    <span class="depositBlock-price">$100</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-5"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">15.000</p>
                        <span>Coins</span>
                    </div>
                    <span class="depositBlock-price">$150</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-5"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">20.000</p>
                        <span>Coins</span>
                    </div>
                    <span class="depositBlock-price">$200</span>
                </div>
                <div class="depositBlock flex-c">
                    <span class="depositBlock-check"></span>
                    <span class="depositBlock-coin coin-5"></span>
                    <div class="depositBlock-info">
                        <p class="depositBlock-cash">50.000</p>
                        <span>Coins</span>
                    </div>
                    <span class="depositBlock-price">$500</span>
                </div>
            </div>
            <!--depositBlocks-->
            {{-- <div class="payMethod">
                <div class="market-content-title">
                    <span>Metodo Pagamento</span>
                </div>
                <div class="payMethod-blocks flex-c-c">
                    <div class="payMethod-block active flex-c-c">
                        <span class="depositBlock-check"></span>
                        <img src="images/pix-payment.png" alt="" width="200">
                    </div>
                </div>
            </div> --}}
            <!--payMethod-->
            {{-- <div class="confOrder">
                <div class="market-content-title">
                    <span>Confirme Dados</span>
                </div>
                <div class="orderBlocks flex-c-c">
                    <div class="orderBlock">
                        <p>Pacote:</p>
                        <span id="plan"></span>
                    </div>
                    <div class="orderBlock">
                        <p>Pacote Cash:</p>
                        <span id="cash">0</span>
                    </div>
                    <div class="orderBlock">
                        <p>Metodo Pagamento:</p>
                        <span>PIX</span>
                    </div>
                    <div class="orderBlock">
                        <p>Total Pagamento:</p>
                        <span id="price">$0</span>
                    </div>
                    <div class="orderBlock">
                        <button class="button-medium" onclick="cobrarPix()">Pagar agora</button>
                    </div>
                </div>
            </div> --}}
        </div>
        <!--market-content-->
    </div>

    {{-- <div class="pixModal modal fade" data-backdrop="static" id="pixModal" tabindex="-1" aria-labelledby="pixModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Pagamento via Pix</h5>
                    <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body text-center">
                    <p class="font-xss mb-3">Pix copia e cola: abra
                        o
                        aplicativo do seu banco
                        pelo
                        celular, selecione PIX e faça o pagamento.
                        Ou
                        escaneie o código com um
                        celular.</p>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <img src="https://via.placeholder.com/300x300" class="img-fluid img-qrcode mb-2">
                        </div>
                        <div class="col-8">
                            <div class="input-group input-group-sm">
                                <input type="text" name="codigoPix" id="inputPixPayload"
                                    onclick="this.setSelectionRange(0, this.value.length)" class="form-control"
                                    readonly="">
                                <div class="input-group-append">
                                    <a type="button" class="btn btn-info" onclick="copyPayLoadPix()">
                                        <svg class="svg-inline--fa fa-copy fa-w-14" aria-hidden="true" focusable="false"
                                            data-prefix="fa" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z">
                                            </path>
                                        </svg>
                                        <!-- <i class="fa fa-copy"></i> -->
                                        {{-- Copiar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none">
                        <div class="col-12">
                            <p class="mt-3 text-uppercase font-xs font-weight-500">
                                Não quer
                                pagar
                                com QR Code?</p>
                            <a href="#" alt="Pagar com MercadoPago" class="btn btn-wide">
                                <img src="webfiles/img/mercado-pago-logo.svg" class="img-fluid"
                                    style="max-height: 25px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
{{-- @section('scripts')
    @parent

    <script>
        $(document).ready(function() {

            var numberButtons = document.getElementsByClassName("depositBlock");

            for (var i = 0; i < numberButtons.length; i++) {
                numberButtons[i].addEventListener("click", changeButton);
            }

            function changeButton(e) {

                var oldActive = document.getElementsByClassName("depositBlock flex-c active");

                for (var i = 0; i < oldActive.length; i++) {
                    oldActive[i].classList.remove("active");
                }

                e.currentTarget.classList.add("active");

                var cashSpan = e.currentTarget.getElementsByClassName('depositBlock-cash');
                let dataCash = [].map.call(cashSpan, item => item.textContent);

                const spanCash = document.getElementById('cash');
                spanCash.innerHTML = dataCash + ' Cash';


                var priceSpan = e.currentTarget.getElementsByClassName('depositBlock-price');
                let dataPrice = [].map.call(priceSpan, item => item.textContent);

                const spanPrice = document.getElementById('price');
                spanPrice.innerHTML = dataPrice;

                var planSpan = e.currentTarget.getElementsByClassName('depositBlock-plan');
                let dataPlan = [].map.call(planSpan, item => item.defaultValue);

                const spanPlan = document.getElementById('plan');
                spanPlan.innerHTML = dataPlan;

            }
        });
    </script>

    <script type="text/javascript">
        function cobrarPix() {

            var dados = {
                'price': document.getElementById('price').innerText,
                'planName': document.getElementById('plan').innerText,

            }
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('mercadopago.index') }}' + '?_token=' + '{{ csrf_token() }}',
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: dados,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Gerando pagamento',
                        html: 'Aguarde...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                    });
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Ops!',
                        text: xhr.responseJSON.message,
                        // timer: 3000,
                    });
                },
                success: function(response) {
                    console.log(response);
                    Swal.close();

                    if (response.result === 1) {
                        $('#pixModal').modal("show");
                        $("#pixModal").find('.img-qrcode').attr('src',
                            `data:image/jpeg;base64,${response.pix.qr_code_base64}`);
                        $('#pixModal').find("[name=codigoPix]").val(response.pix.qr_code);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops!',
                            text: response.message,
                            timer: 3000,
                            buttons: false,
                        });
                    }
                }
            });
        }

        function copyPayLoadPix() {

            /* Get the text field */
            var copyText = document.getElementById("inputPixPayload");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            alert("código copiado com sucesso");

        }

    </script>
@endsection --}}
@endsection
