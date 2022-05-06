<div class="modal fade" id="studentcreateModal" tabindex="-1" aria-labelledby="studentcreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="login-dark">
                    <form method="POST" autocomplete="on" action="{{ route('student.create') }}" style="background: rgba(30,40,51,0.79);max-width: 600px;padding: 0;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="d-lg-flex justify-content-lg-end align-items-lg-center" style="background: #ffffff;height: 25px;border-top-left-radius: 5px;border-top-right-radius: 5px;"><span class="border rounded-circle wobble animated" style="background: var(--bs-danger);font-size: 10px;margin-right: 4px;margin-left: 4px;border-style: none;">&nbsp; &nbsp; &nbsp;</span><span class="border rounded-circle wobble animated" style="background: var(--bs-yellow);font-size: 10px;margin-right: 4px;border-style: none;">&nbsp; &nbsp; &nbsp;</span><span class="border rounded-circle wobble animated" style="background: var(--bs-green);font-size: 10px;margin-right: 4px;">&nbsp; &nbsp; &nbsp;</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div style="padding: 40px;"><h1>Bienvenid@ a ExpoSis !!!</h1>
                                    <div class = "mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Ingresa tu nombre</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="rname" name="name" class="form-control border-bottom border-light" type="text" required>
                                                </div>
                                                @error('name')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Ingresa tu correo institucional</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="remail" name="email" class="form-control border-bottom border-light" type="text" inputmode="email" required style="letter-spacing: 1px;">
                                                </div>
                                                @error('email')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Ingresa una contraseña</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="rpass" name="password" class="form-control border-bottom border-light" type="password" style="letter-spacing: 1px;">
                                                </div>
                                                @error('password')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">No. Ctrl</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="rnoctrl" name="noctrl" class="form-control border-bottom border-light" type="text">
                                                </div>
                                                @error('noctrl')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Semestre</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="rsemestre" name="semestre" class="form-control" type="number" min="1" max="13"></div>
                                                </div>
                                                @error('semestre')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Genero</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <select class="form-select form-control" id="rgenero" name="genero">
                                                        <optgroup style="background-color: #1e2833c9" label="Selecciona tu genero">
                                                            @foreach ($gender as $item)
                                                                <option style="background-color: #1e2833c9" value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                @error('genero')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Fecha nacimiento</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <input id="rnac" name="nac" class="form-control border-bottom border-light" type="date">
                                                </div>
                                                @error('nac')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <span class="text-success" style="font-family: VT323, monospace;">Semestre</span>
                                                </div>
                                                <div class="d-flex d-sm-flex d-md-flex d-lg-flex">
                                                    <span class="d-flex align-items-center span-console">SIS:~$</span>
                                                    <select class="form-select form-control" name="career" id="RCareer">
                                                        <optgroup style="background-color: #1e2833c9" label="Selecciona tu carrera">
                                                            @foreach ($careers as $item)
                                                                <option style="background-color: #1e2833c9" value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                    @error('career')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-block w-100" type="submit" style="background: rgba(33,74,128,0);color: #128400;font-weight: bold;font-family: VT323, monospace;font-size: 20px;padding: 6px;border: 3px dashed #128400 ;">Registrar</button>
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