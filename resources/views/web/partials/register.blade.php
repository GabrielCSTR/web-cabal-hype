    <!-- Sign In -->
    <div class="modal_window icon-modal-reg" id="sign_up_modal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
        aria-hidden="true">
        <h3>Cadastro</h3>
        <div class='modal_form'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" id="registerForm">
                            @csrf

                            <div class="formGroup">
                                <span class="formGroup-name">Login</span>
                                <div class="col-md-6">
                                    <input id="ID" type="text" class="form-control" name="ID"
                                        value="{{ old('ID') }}" autocomplete="email" autofocus required>

                                        <span class="IDErrorGroup" role="alert" id="IDError">
                                            <strong></strong>
                                        </span>

                                </div>
                            </div>

                            <div class="formGroup">
                                <span class="formGroup-name">Email</span>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                        <span class="emailErrorGroup" role="alert" id="emailError">
                                            <strong></strong>
                                        </span>
                                </div>
                            </div>

                            <div class="formGroup">
                                <span class="formGroup-name">Password</span>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                        required autocomplete="new-password" value="{{ old('password') }}">

                                    <span class="invalid-feedback" role="alert" id="passwordError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="formGroup">
                                <span class="formGroup-name">Confirmar Password</span>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" value="{{ old('password-confirm') }}">

                                        <span class="password_confirmationErrorGroup" role="alert" id="password_confirmationError">
                                            <strong></strong>
                                        </span>
                                </div>
                            </div>
                            <p class="agree"> <input type="checkbox" class="checkbox" id="agree" name="agree"
                                    checked required>
                                <label for="agree"></label> Eu li e concordo com a <a
                                    href="https://discord.gg/63HNqrw4eG">regras do jogo.</a>
                            </p>
                            <div class="formGroup">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="registerMain">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')

    <script>
    $(function () {
        $(document).on('click', '#registerMain', function(event) {
            event.preventDefault();

            let formData = $('#registerForm').serializeArray();
            console.log(formData);
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('web.register') }}",
                data: formData,
                success: function (resp) {
                        if (resp.success) {
                            toastr.success(resp.message);
                            setTimeout(function() { // wait for 3 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 2000);
                        } else {
                            toastr.error(resp.message);
                        }
                },
                error: (response) => {
                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            console.log(key);
                            $("#" + key + "Error").addClass("errorGroup");
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                    }
                }
            })
        });


        $(document).on('click', '#loginMain', function(event) {
            event.preventDefault();

            toastr.success("Login desativado, Em breve sera liberado!");
        });
    })
    </script>
@endsection
