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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-icons">Items</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="card-text">
                            <p>Adicione os items das categorias</p>
                        </div>
                        <form class="form" action="{{ route('shop.add-items') }}" method="post" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @if ($errors->any())
                                <div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2">
                                    <span class="alert-icon"><i class="ft ft-thumbs"></i></span>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="timesheetinput1">Nome do Item</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="Name" class="form-control" placeholder="nome do item"
                                            name="Name">
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput7">Descrição</label>
                                    <div class="position-relative has-icon-left">
                                        <textarea id="Description" rows="5" class="form-control" name="Description"
                                            placeholder="descrição do item"></textarea>
                                        <div class="form-control-position">
                                            <i class="ft-file"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput2">Item IDX</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ItemIDX" class="form-control" placeholder="item IDX"
                                            name="ItemIDX">
                                        <div class="form-control-position">
                                            <i class="ft ft-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput2">Option Item</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="OptionIDX" class="form-control" placeholder="Item Option"
                                            name="OptionIDX">
                                        <div class="form-control-position">
                                            <i class="ft ft-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput7">Duração do Item</label>
                                    <fieldset class="form-group position-relative">
                                        <select class="form-control input-lg" id="Duration" name="Duration">
                                            <option selected="">Duração</option>
                                            <option value="28">90 Minutos</option>
                                            <option value="1">1 Hora</option>
                                            <option value="2">2 Horas</option>
                                            <option value="3">3 Horas</option>
                                            <option value="4">4 Horas</option>
                                            <option value="5">5 Horas</option>
                                            <option value="6">6 Horas</option>
                                            <option value="7">10 Horas</option>
                                            <option value="8">12 Horas</option>
                                            <option value="9">1 Dia</option>
                                            <option value="10">3 Dias</option>
                                            <option value="11">5 Dias</option>
                                            <option value="12">7 Dias</option>
                                            <option value="13">10 Dias</option>
                                            <option value="14">14 Dias</option>
                                            <option value="15">15 Dias</option>
                                            <option value="16">20 Dias</option>
                                            <option value="17">30 Dias</option>
                                            <option value="18">45 Dias</option>
                                            <option value="19">60 Dias</option>
                                            <option value="20">90 Dias</option>
                                            <option value="21">100 Dias</option>
                                            <option value="22">120 Dias</option>
                                            <option value="23">180 Dias</option>
                                            <option value="24">270 Dias</option>
                                            <option value="31">Permanente</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput7">Item Image</label>
                                    <fieldset class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="Image" name="Image">
                                            <label class="custom-file-label" for="Image">Image</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput2">Estoque</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="Stock" class="form-control" placeholder="estoque"
                                            name="Stock">
                                        <div class="form-control-position">
                                            <i class="ft ft-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Valor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Valor"
                                            aria-label="Amount (to the nearest dollar)" name="Price">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput7">Categoria</label>
                                    <fieldset class="form-group position-relative">
                                        <select class="form-control input-lg" id="category" name="category">
                                            @foreach ($categorys as $category)
                                                <option value="{{ $category->ProductCategoryID }}">{{ $category->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <label for="timesheetinput7">Destacar como Novo</label>
                                    <div class="input-group">
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="destaque1" name="destaque1" checked>
                                            <label class="custom-control-label" for="destaque1">NÃO</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="destaque2" name="destaque2">
                                            <label class="custom-control-label" for="destaque2">SIM</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ft ft-check"></i> Adicionar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista dos Items</h4>
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
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>ItemIDX</th>
                                    <th>OptionIDX</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $product->Name }}</td>
                                    <td>{{ $product->Description }}</td>
                                    <td>{{ $product->Price }}</td>
                                    <td>{{ $product->ItemIDX }}</td>
                                    <td>{{ $product->OptionIDX }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-flat btn-sm remove-category" data-id="{{ $product->ProductID }}" >Deletar</button>
                                    </td>
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

@section('scripts')
@parent
<script type="text/javascript">

    $(document).ready(function(){

        $('.remove-category').click(function(){

            let id = $(this).attr('data-id');

            Swal.fire({
                  title: "Você tem certeza que deseja REMOVER esse item?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Sim, Deletar!",
                  cancelButtonText: "Não, Cancelar!",
                  closeOnConfirm: false,
                  closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed)
                {
                    var url = "{{ route('shop.delete-item') }}";
                    $.ajax({
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url + '?_token=' + '{{ csrf_token() }}',
                        data: 'productID='+id,
                        success: function (resp) {
                            console.log(resp);
                            if (resp.success) {
                                swal.fire("Deletado!", "Produto foi removido com sucesso!", "success").then(function(){
                                    location.reload();
                                });
                            } else {
                                swal.fire("Error!", 'Sumething went wrong.', "error");
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
