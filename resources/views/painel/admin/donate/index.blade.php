@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">DONATE - Planos</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">DONATE - Planos
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="dropdown float-md-right">
          <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
          <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addPlan"><i class="la la-plus-circle"></i> Adicionar Plano</a>
          </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista dos Planos</h4>
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
                                    <th>Valor</th>
                                    <th>Cash</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $key => $plan)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $plan->Name }}</td>
                                        <td>{{ $plan->Price }}</td>
                                        <td>{{ $plan->Cash }}</td>
                                        <td>
                                            @if ($plan->Status == 1)
                                                <div class="badge badge-success round">
                                                    <span>Ativo</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <button id="deleteButton" class="btn btn-danger btn-flat btn-sm remove-category"
                                                data-id="{{ $plan->id }}">Deletar</button>
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


    <!-- Modal -->
<div class="modal animated pulse text-left" id="addPlan" tabindex="-1" role="dialog"
    aria-labelledby="myModalAddPlan" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-bg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title white" id="myModalAddPlan"><i
                        class="la la-money"></i>Adicionar Novo Plano</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert bg-warning alert-icon-left mb-2" role="alert">
                    <span class="alert-icon"><i class="ft ft-alert-octagon"></i></span>
                    <strong>Importante!</strong>
                    <p>
                        - Adicione corretamente os valores dos planos.<br>
                        - Certifique-se que não existe planos repetidos.
                    </p>
                </div>
                <strong>Dados Plano: </strong>
                <hr>
                <form method="POST" id="addPlanForm">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none"></div>
                        <label>Nome: </label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" id="name" name="name" placeholder="Nome Plano" class="form-control" value="">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                        <label>Valor:  </label>
                        <div class="form-group position-relative has-icon-left">
                             <input type="text" class="form-control currency-formatter" id="price" name="price" placeholder="Valor Plano">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                        <label>Cash: </label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" id="cash" name="cash" placeholder="Valor Cash" class="form-control"
                                value="">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                        <label>Status: </label>
                        <fieldset class="checkbox">
                            <label>
                              <input type="checkbox" name="status" checked=""> ATIVO
                            </label>
                        </fieldset>
                    </div>
                    <div class="modal-footer formGroup formGroup-button">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-outline-success">Adicionar Plano</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@parent
    <script>
        $(function() {

            $('.currency-formatter').formatter({
                'pattern': "${{9999}}"
            });

            $('#addPlanForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $(".invalid-feedback").children("strong").text("");
                $("#addPlanForm input").removeClass("is-invalid");
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('donate.plans.store') }}',
                    data: formData,
                    success: function(resp) {
                        if (resp.success) {
                            $("#modal_close").trigger("click");
                            toastr.success(resp.message);
                            setTimeout(function() { // wait for 3 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 2000);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            $('.alert-danger').html('');
                            Object.keys(errors).forEach(function(key) {
                                console.log(key);
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + errors[key][0] +
                                    '</li>');
                            });
                        }
                    }
                })
            });

            $('button#deleteButton').on('click', function(e){
                var id =  $(this).attr("data-id");
                console.log(id);
                e.preventDefault();
                Swal.fire({
                        title: `Tem certeza que deseja deletar este plano?`,
                        text: "Se você deletar essa plano ela não poderar ser recuperada!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {

                        if (willDelete)
                        {
                            var url = "{{ route('donate.plans.destroy', ':id') }}";
                            url = url.replace(':id', id );
                            $.ajax({
                                method: "DELETE",
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id
                                },
                                success: function(resp) {
                                    if (resp.success) {
                                        console.log(resp);
                                        toastr.success(resp.message);
                                        setTimeout(function() { // wait for 3 secs(2)
                                            location.reload(); // then reload the page.(3)
                                        }, 2000);

                                    } else {
                                        toastr.error(resp.message);
                                    }
                                },

                            });
                        }

                    });
            });

        });
    </script>
@endsection
