@extends('layouts.advisers-private')
@section('body')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="text-blue-standar m-0 fw-bold">{{ __('adviser-dashboard.team-view-header') }}</h6>
            </div>
            
            <div class="col d-flex d-sm-flex d-md-flex justify-content-end align-items-center justify-content-sm-end justify-content-md-end">
                <form action="{{route('adviser.vbo')}}" method="POST" onsubmit="return confirm('Seguro deseas dar VBO al equipo? ')">
                    @csrf
                    <input type="hidden" name="TeamId" value="{{$teamsview[0]->id}}">
                    @if ($teamsview[0]->TeamVBO == 1)
                        <button class="btn text-white bg-orange-standar" type="submit" disabled>
                    @else
                        <button class="btn text-white bg-orange-standar" type="submit">
                    @endif
                        {{ __('adviser-dashboard.team-request-vbo') }} <i class="fa fa-check"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col">
            <div class="row">
                <div class="col border-end">
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('adviser-dashboard.team-view-name') }}</h5><span>{{$teamsview[0]->Team}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('adviser-dashboard.team-view-categorie') }}</h5><span>{{$teamsview[0]->Categorie}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('adviser-dashboard.team-view-event') }}</h5><span>{{$teamsview[0]->Event}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('adviser-dashboard.team-view-teammates') }}</h5>
                            <ul>
                                @foreach ($teamsview as $item)
                                    <li>{{$item->Student}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('adviser-dashboard.team-view-status') }}</h5>
                            <div class="row">
                                @if ($teamsview[0]->TeamStatus < 5)
                                    <div class="col">
                                        <span>{{ __('students-dashboard.team-view-s-incomplete') }}</span>
                                    </div>
                                    <div class="col d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-end justify-content-sm-end justify-content-md-end justify-content-lg-end justify-content-xl-end justify-content-xxl-end">
                                        <i class="fa fa-remove fs-5 text-danger"></i>
                                    </div>
                                @else
                                    <div class="col">
                                        <span>{{ __('students-dashboard.team-view-s-complete') }}</span>
                                    </div>
                                    <div class="col d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-end justify-content-sm-end justify-content-md-end justify-content-lg-end justify-content-xl-end justify-content-xxl-end">
                                        <i class="fa fa-check fs-5 text-success"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-grid gap-2 mt-2">
                            <a class="btn bg-orange-standar text-white" href="{{route('viewDocument',$teamsview[0]->TeamDoc)}}">{{ __('adviser-dashboard.team-view-file') }} <i class="fa fa-file"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <form class="h-100" method="POST" action="" onsubmit="return confirm('Seguro deseas proporcionar el visto bueno al equipo : '.$teamsview[0]->Team)">
                        @csrf
                        <span class="mb-3">Deja tus comentarios </span>
                        <small>(Puedes enviar cuantos creas necesarios)</small>
                        <input class="form-control" name="TeamId" type="hidden" value="{{$teamsview[0]->TeamId}}" />
                        <textarea class="form-control h-75" name="comment"></textarea>
                        <button class="btn btn-success mt-1 text-white" type="button" disabled>
                            {{ __('adviser-dashboard.team-request-button') }} <i class="fa fa-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection