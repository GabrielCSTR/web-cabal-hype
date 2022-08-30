@extends('painel.layouts.master')

@section('header')
	<div class="content-header-left col-md-6 col-12">
		<h1 class="content-header-title mb-0">Serviço Premium / Passe De batalha</h1>
	</div>
	<div class="content-header-right text-md-right col-md-6 col-12">
		{{--  @include('instaciaFilial')  --}}
	</div>
	<div class="col-12">
		<hr/>
	</div>
@endsection

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-content">
              <div class="card-body">
                <h4 class="card-title">Passe de Batalha</h4>
              </div>
              <img class="card-img img-fluid mb-1" src="{{ asset('images/passe.png') }}" alt="Card image vip">
              <div class="card-body">
                <p class="card-text">Passe de batalha, EM BREVE!!!</p>
                {{-- <a href="#" class="card-link pink">ITENS</a> --}}
              </div>
            </div>
          </div>
      </div>

      <div class="col-6">
        <div class="card">
            <div class="card-content">
              <div class="card-body">
                <h4 class="card-title">VIP - Premium</h4>
              </div>
              <img class="card-img img-fluid mb-1" src="{{ asset('images/vip.png') }}" alt="Card image vip">
              <div class="card-body">
                <p class="card-text">Sistema de VIP, compre agora e adiquira os status do vip</p>
                <a href="#" class="card-link pink">CASH: 3.000</a>
                <div class="card collapse-icon accordion-icon-rotate">
                    <div id="heading52" class="card-header border-danger mt-1">
                      <a data-toggle="collapse" data-parent="#accordionWrap5" href="#accordion52" aria-expanded="false" aria-controls="accordion52" class="card-title lead danger collapsed">VIP - STATUS</a>
                    </div>
                    <div id="accordion52" role="tabpanel" aria-labelledby="heading52" class="card-collapse collapse" aria-expanded="false" style="">
                      <div class="card-content">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-primary float-right">250%</span>
                                  EXP
                                </li>
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-info float-right">400%</span>
                                  AXP
                                </li>
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-warning float-right">140%</span>
                                  WEXP
                                </li>
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-success float-right">400%</span>
                                  EXP TEC
                                </li>
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-danger float-right">140%</span>
                                  EXP CRAFT
                                </li>
                                <li class="list-group-item">
                                 <span class="badge badge-default badge-pill bg-danger float-right">100%</span>
                                   T-POINT
                                </li>
                                <li class="list-group-item">
                                  <span class="badge badge-default badge-pill bg-danger float-right">3x</span>
                                   DROP ITENS
                                </li>
                                <li class="list-group-item list-group-item-action flex-column align-items-start active">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="text-bold-600 white">Atributos</h5>
                                        <small>duração 30 dias.</small>
                                      </div>
                                      <p>
                                        - Slot de Pet Extra<br>
                                        - 1 Poção Inesgotável 1k HP (30Dias)<br>
                                        - 1 Poção Inesgotável 1k MP (30Dias)<br>
                                        - 30 Abas no Leilão<br>
                                        - Socio Yekaterina (Ja Incluida no Status do Vip)<br>
                                        - Destreinamento de Pet (10)<br>
                                        - Quantidade de itens 150<br>
                                        - Todas as 8 Abas Armazem Liberadas<br>
                                        - Todas as 4 Abas Inventario<br>
                                        - Cartão Loja Remota (30Dias)<br>
                                        - Cartão Armazem Remoto (30Dias)<br>
                                        - Cartão de Agente Remoto (30Dias)<br>
                                        - Nucleo Guia (30Dias)<br>
                                        - Pedra da Fronteira x3 (30Dias)<br>
                                    </p>
                                </li>
                              </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                <form method="POST">
                    @csrf
                    @method('POST')
                  <button type="button" class="btn btn-success btn-block buy-vip">COMPRAR</button>
                </form>
              </div>
            </div>
          </div>
      </div>
  </div>

@endsection

@section('scripts')
@parent
    <script>
       $(document).ready(function(){

        $('.buy-vip').click(function(){

            Swal.fire({
                title: "Você deseja comprar esse vip - premium?",
                text: "Você precisa ter o cash no valor de 3.000 para poder fazer a compra do vip!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, Comprar!",
                cancelButtonText: "Não, Cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed)
                {
                    var url = "{{ route('premium.buyvip') }}";
                    $.ajax({
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url + '?_token=' + '{{ csrf_token() }}',
                        success: function (resp) {
                            console.log(resp);
                            if (resp.success) {
                                swal.fire("VIP - PREMIUM!", "Seu vip foi comprado com sucesso, Obrigado!", "success").then(function(){
                                    location.reload();
                                });
                            } else {
                                swal.fire("Alerta!", resp.message, "error");
                            }
                        },
                        error: (response) => {
                            if(response.status === 422) {
                                swal.fire("Error!", 'Sumething went wrong.', "error");
                            }
                        }
                    });
                }
            });


        });

        });
    </script>
@endsection
