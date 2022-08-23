<!-- Modal -->
<div class="modal animated pulse text-left" id="editPoints-{{ $char->CharacterIdx }}" tabindex="-1" role="dialog"
    aria-labelledby="myModal-{{ $char->CharacterIdx }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-bg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title white" id="myModal-{{ $char->CharacterIdx }}"><i
                        class="la la-tree"></i>Distribuir Pontos: Char - {{ $char->Name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert bg-warning alert-icon-left mb-2" role="alert">
                    <span class="alert-icon"><i class="ft ft-alert-octagon"></i></span>
                    <strong>Importante!</strong>
                    <p>
                        - Para adicionar pontos em seu personagem é necessário deslogar da sua conta.<br>
                        - Seu personagem precisa ter pontos sobrando.
                    </p>
                </div>
                <strong>PONTOS: {{ $char->PNT }}</strong>
                <hr>
                <form method="POST" id="editPointsForm-{{ $char->CharacterIdx }}">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display:none"></div>
                        <label>FOR: {{ $char->STR }}</label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" id="FOR" name="FOR" placeholder="Força" class="form-control" value="0">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                        <label>INT: {{ $char->INT }} </label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" id="INT" name="INT" placeholder="Inteligencia" class="form-control"
                                value="0">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                        <label>DES: {{ $char->DEX }}</label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" id="DES" name="DES" placeholder="Destresa" class="form-control"
                                value="0">
                            <div class="form-control-position">
                                <i class="ft ft-chevrons-right font-large-1 line-height-1 text-muted icon-align"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer formGroup formGroup-button">
                        <input type="hidden" id="characterIdx" name="characterIdx" value="{{ $char->CharacterIdx }}">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-outline-success">Distribuir Pontos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal animated pulse text-left" id="cleanPK-{{ $char->CharacterIdx }}" tabindex="-1" role="dialog"
    aria-labelledby="myModal-{{ $char->CharacterIdx }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-bg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title white" id="myModal-{{ $char->CharacterIdx }}"><i
                        class="la la-tree"></i>Limpar PK: Char - {{ $char->Name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($char->PKPenalty)
                    <div class="alert bg-danger alert-icon-left mb-2" role="alert">
                        <span class="alert-icon"><i class="ft ft-alert-octagon"></i></span>
                        <strong>Importante!</strong>
                        <p>
                            - Para Limpa sua penalidade é necessário deslogar da sua conta.<br>
                            - É necessário ter em seu inventário o valor cobrado parar limpar sua penalidade
                        </p>
                    </div>
                    <strong>CHAR:
                        {{ $char->Name }}
                    </strong>
                    <br>
                    <strong>PENALIDADE:
                        <div class="badge badge-warning">
                            <span> {{ $char->PKPenalty }} </span>
                        </div>
                        <br>
                        VALOR ALZ:
                        <div class="badge badge-danger">
                            <span>{{ $char->PKPenalty * 2000 }}</span>
                        </div>
                    </strong>
                    <form method="POST" id="cleanPK-{{ $char->CharacterIdx }}">
                        @csrf
                        @method('POST')
                        <div class="modal-footer formGroup formGroup-button">
                            <input type="hidden" id="characterIdx" name="characterIdx"
                                value="{{ $char->CharacterIdx }}">
                            <button type="button" class="btn grey btn-outline-secondary"
                                data-dismiss="modal">Close</button>
                            <button class="btn btn-outline-danger">LIMPAR PK</button>
                        </div>
                    </form>
                @else
                    <div class="alert bg-warning alert-icon-left mb-2" role="alert">
                        <span class="alert-icon"><i class="ft ft-alert-octagon"></i></span>
                        <strong>Aviso!</strong>
                        <p>
                            - Este char não tem PK para limpar!<br>
                        </p>
                    </div>
                    <div class="modal-footer formGroup formGroup-button">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
    <script>
        $(function() {

            $('#editPointsForm-{{ $char->CharacterIdx }}').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $(".invalid-feedback").children("strong").text("");
                $("#editPointsForm input").removeClass("is-invalid");
                var url = "{{ route('chars.addPNT', ':id') }}";
                url = url.replace(':id', {{ $char->CharacterIdx }});
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
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
        });
    </script>

    <script>
        $(function() {

            $('#cleanPK-{{ $char->CharacterIdx }}').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                var url = "{{ route('chars.cleanPK', ':id') }}";
                url = url.replace(':id', {{ $char->CharacterIdx }});
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url + '?_token=' + '{{ csrf_token() }}',
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
        });
    </script>
@endsection
