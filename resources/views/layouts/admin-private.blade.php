<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ExpoSIS</title>
    <link rel="icon" type="image/png" href="{{URL::asset('/img/icontecnm.png')}}" sizes="16x16">
    @include('resources\private\css\admincss')
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0 pt-5 pb-5" href="#">
                    <div class="sidebar-brand-icon"><img class="img-fluid" src="{{URL::asset('/img/logo-ittol-sf.png')}}"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>{{ __('admin-dashboard.opt1') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.events')}}">
                            <i class="fas fa-calendar-day"></i>
                            <span>{{ __('admin-dashboard.eventos') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i>
                            <span>{{ __('admin-dashboard.equipos') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.califications')}}">
                            <i class="fas fa-list"></i>
                            <span>{{ __('admin-dashboard.califaciones') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.advisers')}}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>{{ __('admin-dashboard.asesores') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.students')}}">
                            <i class="fas fa-user-graduate"></i>
                            <span>{{ __('admin-dashboard.estudiantes') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.evaluators')}}">
                            <i class="fas fa-user-tie"></i>
                            <span>{{ __('admin-dashboard.evaluadores') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.categories-careers')}}">
                            <i class="fas fa-border-all"></i>
                            <i class="fas fa-graduation-cap"></i>
                            <span>{{ __('admin-dashboard.categorias-carreras') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('admins.evaluations')}}">
                            <i class="fa fa-file-text"></i>
                            <span>{{ __('admin-dashboard.evaluaciones') }}</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ session()->get('LoggedUser')->name }}</span>
                                        <img class="border rounded-circle img-profile" src="{{URL::asset('/img/avatar.png')}}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>{{ __('admin-dashboard.perfil') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>{{ __('admin-dashboard.cerrarS') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    @include('notify::components.notify')
                    <x:notify-messages />
                    @yield('body')
                </div>
            </div>
        </div>
    </div>  
    @include('resources.private.js.adminjs')
</body>

</html>