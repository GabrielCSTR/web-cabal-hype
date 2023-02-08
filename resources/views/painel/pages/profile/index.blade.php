@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Profile - {{ mb_strtoupper(Auth::user()->ID) }}</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Profile
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
    <div id="user-profile">
        <div class="row">
            <div class="col-12">
                <div class="animated bounceInUp card profile-with-cover">
                    <div class="card-img-top img-fluid bg-cover height-300"
                        style="background: url('images/news-image.jpg') 0 300px; background-color:black"></div>
                    {{-- <div class="media profil-cover-details w-100">
                        <div class="media-left pl-2 pt-2">
                            <a href="#" class="profile-image">
                                <img src="{{ asset('images/logo-1.png') }}" class="rounded-circle img-border height-100"
                                    alt="Card image">
                            </a>
                        </div>
                        <div class="media-body pt-3 px-2">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title">{{ mb_strtoupper(Auth::user()->ID) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <nav class="navbar navbar-light navbar-profile align-self-end">
                        <button class="navbar-toggler d-sm-none" type="button" data-toggle="collapse" aria-expanded="false"
                            aria-label="Toggle navigation"></button>
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#"><i class="la la-line-chart"></i> Perfil <span
                                                class="sr-only">(current)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </nav> --}}
                    </nav>
                </div>

                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
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
                        {{-- <div class="card-text">
                          <p>Olá, {{ Auth::user()->ID }}. Aqui fica algumas
                            informações básica do seu perfil.</p>
                        </div> --}}

                          <div class="form-body">
                            {{-- <h4 class="form-section"><i class="ft ft-eye"></i> Sobre User - {{ mb_strtoupper(Auth::user()->ID) }}</h4> --}}
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput1">ID</label>
                                  <input type="text" id="userinput1" class="form-control border-primary" placeholder="Name" name="name" value="{{ Auth::user()->ID }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userinput5">Email</label>
                                    <input class="form-control border-primary" type="email" placeholder="email" id="userinput5" value="{{  Auth::user()->Email }}">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput3">Criado</label>
                                  <input type="text" class="form-control" id="dateTimeCreate" value="{{ \Carbon\Carbon::createFromTimestamp(strtotime(Auth::user()->createDate))->format('d-m-Y')}}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput4">Último login</label>
                                  <input type="text" class="form-control" id="dateTimeLastLogin" value="{{ Auth::user()->LogoutTime ? \Carbon\Carbon::createFromTimestamp(strtotime(Auth::user()->LogoutTime))->format('d-m-Y') : 'N/A'}}">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions left">
                            <div class="form-group">
                                <h5>Trocar senha:</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning mr-1" data-toggle="modal" data-target="#changePW">
                                    <i class="ft-x"></i> Alterar
                                </button>
                                <!-- Modal -->
                                <div class="modal animated pulse text-left" id="changePW" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" style="display: none;" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header bg-danger white">
                                        <h4 class="modal-title white" id="myModalLabel12"><i class="la la-tree"></i> Trocar senha</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" id="passwordForm">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                              <div class="alert alert-danger" style="display:none"></div>
                                              <label>Password: </label>
                                              <div class="form-group position-relative has-icon-left">
                                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">

                                                <div class="form-control-position">
                                                  <i class="ft ft-lock font-medium-5 line-height-1 text-muted icon-align"></i>
                                                </div>
                                              </div>
                                              <label>Confirmar-Password: </label>
                                              <div class="form-group position-relative has-icon-left">
                                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password" class="form-control">
                                                <div class="form-control-position">
                                                  <i class="ft ft-lock font-large-1 line-height-1 text-muted icon-align"></i>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer formGroup formGroup-button">
                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                <button class="btn btn-outline-success">Save changes</button>
                                              </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

@section('scripts')
@parent
<script>
    $(function () {
        $('#passwordForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serializeArray();
            $(".invalid-feedback").children("strong").text("");
            $("#passwordForm input").removeClass("is-invalid");
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('profile.updatePW') }}",
                data: formData,
                success: function (resp) {
                        if (resp.success) {
                            $("#modal_close").trigger("click");
                            $("#password").val('');
                            $("#password_confirmation").val('');
                            toastr.success(resp.message);
                        } else {
                            toastr.error(resp.message);
                        }
                },
                error: (response) => {
                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;
                        $('.alert-danger').html('');
                        Object.keys(errors).forEach(function (key) {
                            console.log(key);
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>'+errors[key][0]+'</li>');
                    });
                    }
                }
            })
        });
    });
</script>
@endsection
@endsection

