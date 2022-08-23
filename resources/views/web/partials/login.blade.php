    <!-- Sign In -->
    <div class="modal_window icon-modal-reg" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="login_modal"
        aria-hidden="true">
        <h3>Login</h3>
        <div class='modal_form'>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" id="loginForm">
                            @csrf
                            @method('POST')

                            <div class="formGroup">
                                <span class="formGroup-name">Login</span>
                                <div class="col-md-6">
                                    <input id="ID" type="text" class="form-control" name="ID"
                                        value="{{ old('ID') }}" autocomplete="account" autofocus required>

                                    <span class="IDErrorGroup" role="alert" id="IDError">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="formGroup">
                                <span class="formGroup-name">Password</span>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" required autocomplete="password">

                                    <span class="passwordErrorGroup" role="alert" id="passwordError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <p class="agree"> <input type="checkbox" class="checkbox" id="agree" name="agree"
                                    checked required>
                                <label for="agree"></label> Remember me.
                            </p>
                            <a href="" class="lost-pass">Lost password?</a>
                            <div class="formGroup">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="loginMain">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
