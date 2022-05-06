<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="login-dark">
                    <form method="post" action="{{ route('auth.check') }}" style="background: rgba(30,40,51,0.79);max-width: 600px;padding: 0;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="d-lg-flex justify-content-lg-end align-items-lg-center" style="background: #ffffff;height: 25px;border-top-left-radius: 5px;border-top-right-radius: 5px;"><span class="border rounded-circle wobble animated" style="background: var(--bs-danger);font-size: 10px;margin-right: 4px;margin-left: 4px;border-style: none;">&nbsp; &nbsp; &nbsp;</span><span class="border rounded-circle wobble animated" style="background: var(--bs-yellow);font-size: 10px;margin-right: 4px;border-style: none;">&nbsp; &nbsp; &nbsp;</span><span class="border rounded-circle wobble animated" style="background: var(--bs-green);font-size: 10px;margin-right: 4px;">&nbsp; &nbsp; &nbsp;</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div style="padding: 40px;"><h1>Bienvenid@ a ExpoSis ! <br> comencemos con la aventura . . .</h1>
                                    <div id="div-login-email" class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">{{ __('landingpage.ENTRAR-EMAIL') }}</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input name="user" class="form-control border-bottom border-light" type="text" inputmode="email" required style="letter-spacing: 1px;">
                                                    @error('user')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div-login-pass" class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div><span class="text-success" style="font-family: VT323, monospace;">{{ __('landingpage.ENTRAR-CONTRASEÑA') }}<br></span></div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input name="password" class="form-control border-bottom border-light" type="password" style="letter-spacing: 1px;">
                                                    @error('password')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div-login-btn" class="mb-3">
                                        <button class="btn btn-login d-block w-100" type="submit">{{ __('landingpage.ENTRAR-BOTON') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
