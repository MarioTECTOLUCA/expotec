<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ExpoSIS</title>
    <link rel="icon" type="image/png" href="{{URL::asset('/img/icontecnm.png')}}" sizes="16x16">
    @include('resources\public\css\ccspubliclinks')
</head>

<body>
    <!--Navegacion gobierno-->
        <div style="max-height: 84px;">
            <div class="row goberment-info">
                <div class="col-3 d-sm-flex justify-content-sm-center align-items-sm-center">
                    <div class="m-3">
                        <img class="img-fluid goberment-img-brand" src="{{URL::asset('/img/img-gob.png')}}" >
                    </div>
                </div>
                <div class="col-9 col-lg-8 d-flex d-sm-flex d-md-flex d-lg-flex justify-content-md-end align-items-md-center">
                    <div class="navbar pe-2">
                        <ul class="list-inline d-flex align-items-md-center p-7">
                            <li class="list-inline-item nav-item mr-auto text-white fw-bolder">{{ __('landingpage.GOBIERNO') }}</li>
                            <li class="list-inline-item nav-item mr-auto text-white fw-bolder">{{ __('landingpage.PARTICIPA') }}</li>
                            <li class="list-inline-item nav-item mr-auto text-white fw-bolder">{{ __('landingpage.DATOS') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <!--Navegacion TECNM-->
        <div>
            <div class="container pt-3 pb-3">
                <div class="row row-cols-3">
                    <div class="col-md-4 d-flex align-items-center justify-content-md-center align-items-md-center border border-warning border-top-0 border-bottom-0 border-start-0">
                        <a href="https://www.gob.mx/sep">
                            <img class="img-fluid" src="{{URL::asset('/img/pleca-gob2.1639682774.png')}}">
                        </a>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-md-center align-items-md-center border border-warning border-top-0 border-bottom-0 border-start-0">
                        <a href="https://tecnm.mx/">
                            <img class="img-fluid" src="{{URL::asset('/img/logo.1639672614.jpg')}}">
                        </a>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center justify-content-md-center align-items-md-center">
                        <a href="/">
                            <img class="img-fluid" src="{{URL::asset('/img/logo-instituto-tecnologico-de-toluca.1639680793.png')}}" style="width: 97px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <!--Navegacion pagina-->
        <nav class="navbar navbar-dark navbar-expand-md navbar-header">
            <div class="container-fluid">
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                    <span class="visually-hidden"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-md-flex d-lg-flex justify-content-md-center" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link link-primary shadow-lg fw-bolder" >{{ __('landingpage.INFORMACION') }}</a>
                        </li>
                        @if (Session::has('LoggedUser'))
                            @if (session()->get('LoggedUser')->role == 0)
                                <li class="nav-item">
                                    <a class="nav-link text-white fs-6 fw-bolder" href="{{route('students.panel')}}">{{ __('landingpage.PANELESTUDIANTES') }}</a>
                                </li>
                            @else
                                @if (session()->get('LoggedUser')->role == 1)
                                    <li class="nav-item">
                                        <a class="nav-link text-white fs-6 fw-bolder" href="{{route('adviser.panel')}}">{{ __('landingpage.PABELASESORES') }}</a>
                                    </li>
                                @else
                                    @if (session()->get('LoggedUser')->role == 2)
                                        <li class="nav-item">
                                            <a class="nav-link text-white fs-6 fw-bolder" href="{{route('evaluator.panel')}}">{{ __('landingpage.PABELEVALUADORES') }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link text-white fs-6 fw-bolder" href="{{route('admins.panel')}}">{{ __('landingpage.PABELADMINS') }}</a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white fs-6 fw-bolder" data-bs-toggle="modal" data-bs-target="#registroModal">{{ __('landingpage.REGISTRARSE') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fs-6 fw-bolder" data-bs-toggle="modal" data-bs-target="#logModal">{{ __('landingpage.ENTRAR') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    <!--Cuerpo-->
        <div>
            @include('notify::components.notify')
            <x:notify-messages />
            @yield('cuerpo')
        </div>

        <footer class="pb-5 pt-5" style="background: #0b231e;">
            <div style="background: url({{URL::asset('/img/img-1639674472.1639674475.jpg')}}) center / cover no-repeat;padding-top: 40px;">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex justify-content-xxl-center align-items-xxl-center">
                                    <img src="{{URL::asset('/img/img-gob.png')}}" style="max-height: 47px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="fs-6 text-white">{{ __('landingpage.ENLACES') }}</h4>
                                <ul class="list-unstyled">
                                    <li class="text-white fs-6" style="text-decoration: underline;">
                                        <a class="footer-link" href="https://participa.gob.mx/">{{ __('landingpage.PARTICIPA') }}</a>
                                    </li>
                                    <li class="text-white fs-6" style="text-decoration: underline;">
                                        <a class="footer-link" href="https://www.gob.mx/publicaciones">{{ __('landingpage.PUBLICACIONES') }}</a>
                                    </li>
                                    <li class="text-white fs-6" style="text-decoration: underline;">
                                        <a class="footer-link" href="http://www.ordenjuridico.gob.mx/">{{ __('landingpage.MARCO') }}</a>
                                    </li>
                                    <li class="text-white fs-6" style="text-decoration: underline">
                                        <a class="footer-link" href="https://consultapublicamx.inai.org.mx/vut-web/">{{ __('landingpage.PLATAFORMA') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <h4 class="main-title_small">{{ __('landingpage.QUEES') }}</h4>
                                <ul class="list-unstyled">
                                    <li style="height: 93px;"><a class="footer-link" href="https://www.gob.mx/que-es-gobmx"><br>Es el portal único de trámites, información y participación ciudadana. Leer más<br><br></a></li>
                                    <li><a class="footer-link" href="https://datos.gob.mx/">Portal de datos abiertos</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/accesibilidad">Declaracion de acesibilidad</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/privacidadintegral">Aviso de privacidad simplificado</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/privacidadintegral">Terminos y condiciones</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/privacidadintegral">Politica de seguridad</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/privacidadintegral">Mapa de sitio</a></li>
                                    <li><a class="footer-link" href="https://www.gob.mx/privacidadintegral">Aviso de privacidad integral</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h4 class="main-title_small">{{ __('landingpage.SIGUENOS') }}</h4>
                                <ul class="list-unstyled d-flex">
                                    <li class="p-2">
                                        <a href="https://www.facebook.com/gobmexico">
                                            <i class="fa fa-facebook fs-3 text-white"></i>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a href="https://twitter.com/GobiernoMX">
                                            <i class="fa fa-twitter fs-3 text-white"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center p-2">
                <p class="ittol-info-footer d-md-flex justify-content-md-center align-items-md-center">Instituto Tecnológico de Toluca - Algunos Derechos Reservados - 2022<br></p><p class="text-center ittol-info-footer">Av. Tecnológico s/n. Colonia Agrícola Bellavista<br>
                                                                                    Metepec, Edo. de México, México C. P. 52149<br>
                                                                                            Tel. (52) (722) 2 08 72 00</p>
            </div>
        </footer>
    <!--Modal ingreso-->
        @include('components.public._log')
    <!--Modal registro-->
        @include('components.public._registro')
    
    @include('resources.public.js.jspubliclinks')
</body>
</html>