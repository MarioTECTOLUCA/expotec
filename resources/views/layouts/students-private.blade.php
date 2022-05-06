<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ExpoSIS</title>
    <link rel="icon" type="image/png" href="{{URL::asset('/img/icontecnm.png')}}" sizes="16x16">
    @include('resources\private\css\studentscss')
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
                            <span>{{ __('students-dashboard.head') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="{{route('students.teams-create')}}">
                            <i class="fas fa-users"></i>
                            <span>{{ __('students-dashboard.equipos') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="table.html">
                            <i class="fas fa-list"></i>
                            <span>{{ __('students-dashboard.califaciones') }}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-transition">
                        <a class="nav-link" href="login.html">
                            <i class="far fa-user-circle"></i>
                            <span>{{ __('students-dashboard.perfil') }}</span>
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
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>{{ __('students-dashboard.perfil') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>{{ __('students-dashboard.cerrarS') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        @if (count($notifications)>0)
                                            <span class="badge bg-danger badge-counter">{{count($notifications)}}+</span>
                                        @endif
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-list dropdown-menu-end animated--grow-in" style="min-width:500px;">
                                        <h4 style="background: #1b396a;" class="dropdown-header fs-5">{{ __('students-dashboard.dashboard-notificationcenter-header') }}</h4>
                                        @if (count($notifications)>0)
                                                @foreach ($notifications as $item)
                                                <div class="d-flex align-items-center dropdown-item">
                                                    <div class="col-1 me-2">
                                                        <div class="bg-success icon-circle p-1">
                                                            <i class="fa fa-user-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <span class="small text-gray-500 fs-5">{{$item->requestdate}}</span>
                                                        <p class="fs-6">Tienes una nueva invitacion del equipo {{$item->name}} debes contestarla lo antes posible</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <form action="{{route('teams.respons-request-student')}}" method="POST" onsubmit="return confirm({{'Deseas confirmar tu participacion en el equipo: '. $item->team}})">
                                                                    @csrf
                                                                    <div>
                                                                        <input type="hidden" name="Teamid" value="{{$item->fk_team}}">
                                                                        <input type="hidden" name="flag" value="1">
                                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                                        <button class="btn btn-success btn-circle ms-1">
                                                                            <i class="fas fa-check text-white"></i>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="{{route('teams.respons-request-student')}}" method="POST" onsubmit="return confirm({{'Deseas rechazar tu participacion en el equipo: '. $item->team}})">
                                                                    @csrf
                                                                    <div>
                                                                        <input type="hidden" name="Teamid" value="{{$item->fk_team}}">
                                                                        <input type="hidden" name="flag" value="0">
                                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                                        <button class="btn btn-danger btn-circle ms-1">
                                                                            <i class="fas fa-trash text-white"></i>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                   
                                        @else
                                            <div class="d-flex align-items-center dropdown-item">
                                            <span> {{ __('students-dashboard.dashboard-notificationcenter-spandefault') }}</span>
                                            </div>
                                        @endif
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
    @include('resources.private.js.studentsjs')
</body>

</html>