@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">SHOP - Items</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">SHOP - Items
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista dos Items <b>TOTAL VENDAS:
                        <div class="badge badge-warning round">
                            <span><b>${{ number_format($total_faturado) }}</b></span>
                            <i class="la la-money font-medium-2"></i>
                        </div>
                        </b></h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>ID Pagamento</th>
                                    <th>ID Referencia</th>
                                    <th>Pacote</th>
                                    <th>Valor Pago</th>
                                    <th>Cash</th>
                                    <th>Status</th>
                                    <th>Data Compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopLogsTransations as $key => $log)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $log->getAccount->ID }}</td>
                                        <td><b>{{ $log->id_payment }}</b></td>
                                        <td><b>{{ $log->id_ref }}</b></td>
                                        <td>{{ $log->getPacote ? $log->getPacote->Name : 'N/A' }}</td>
                                        <td>{{ $log->getPacote ? $log->getPacote->Price : 'N/A' }}</td>
                                        <td>{{ $log->getPacote ? $log->getPacote->Cash : 'N/A' }}</td>
                                        <td>
                                            @if ($log->status == '1')
                                            <div class="badge badge-success round">
                                                <span>ENTREGUE</span>
                                                <i class="la la-money font-medium-2"></i>
                                            </div>
                                            @else
                                                <div class="badge badge-danger round">
                                                    <span>CANCELADO</span>
                                                    <i class="la la-money font-medium-2"></i>
                                                </div>
                                            @endif

                                        </td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
