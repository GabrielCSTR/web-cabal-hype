@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">SHOP - Categorias</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">SHOP - CATEGORIAS
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
                    <h4 class="card-title" id="basic-layout-icons">SHOP - CATEGORIAS</h4>
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
                            <p>Adicionar Categoria</p>
                        </div>
                        <form class="form" action={{ route('shop.add-category') }} method="post" novalidate>
                            @csrf
                            @method('POST')
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="Name">Nome da Categoria</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="Name" class="form-control" placeholder="nome da categoria"
                                            name="Name">
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Icon">Deseja Destacar a Categoria?</label>
                                    <div class="input-group">
                                        <fieldset>
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                              <input type="radio" class="custom-control-input bg-success" name="news1" id="colorRadio2" checked>
                                              <label class="custom-control-label" for="colorRadio2">Sim</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                              <input type="radio" class="custom-control-input bg-danger" name="news1" id="colorRadio3">
                                              <label class="custom-control-label" for="colorRadio3">Não</label>
                                            </div>
                                        </fieldset>
                                        {{-- <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" name="news1" class="custom-control-input" id="news1">
                                            <label class="custom-control-label" for="news1">Yes</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio">
                                            <input type="radio" name="news0" class="custom-control-input" id="news0"
                                                checked>
                                            <label class="custom-control-label" for="news0">No</label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Icon">Status Categoria</label>
                                    <div class="input-group">
                                        <fieldset>
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                              <input type="radio" class="custom-control-input bg-success" name="active1" id="colorRadio1" checked>
                                              <label class="custom-control-label" for="active1">Ativo</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                              <input type="radio" class="custom-control-input bg-danger" name="active1" id="colorRadio4">
                                              <label class="custom-control-label" for="colorRadio4">Desativado</label>
                                            </div>
                                        </fieldset>
                                        {{-- <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" name="active1" class="custom-control-input" id="active1"
                                                checked>
                                            <label class="custom-control-label" for="active1">Ativo</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio">
                                            <input type="radio" name="active0" class="custom-control-input" id="active0">
                                            <label class="custom-control-label" for="active0">Desativado</label>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fx fx-check"></i> Save
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
                    <h4 class="card-title">Lista das Categorias</h4>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorys as $key => $category)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $category->Name }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-flat btn-sm remove-category" data-id="{{ $category->ProductCategoryID }}" >Deletar</button>
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
                  title: "Você tem certeza que deseja deletar essa categoria?",
                  text: "Se você deletar essa plano ela não poderar ser recuperada!",
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
                    var url = "{{ route('shop.delete-category') }}";
                    $.ajax({
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url + '?_token=' + '{{ csrf_token() }}',
                        data: 'category='+id,
                        success: function (resp) {
                            console.log(resp);
                            if (resp.success) {
                                swal.fire("Deletado!", "Categoria foi deletada com sucesso!", "success").then(function(){
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
