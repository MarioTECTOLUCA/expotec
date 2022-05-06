@extends('layouts.students-private')

@section('body')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-blue-standar m-0 fw-bold">{{ __('students-dashboard.team-view-header') }}</h6>
        </div>
        <div class="card-body">
            <form method="post" autocomplete="off" action="{{route('students.teams-refresh') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6 border-end border-secondary">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-name') }}</span>
                            <input  name="idTeam" value="{{$teamsview[0]->TeamId}}" type="hidden">
                            <input class="form-control" name="name" placeholder="{{$teamsview[0]->Team}}" type="text">
                        </div>
                        <div class="col-6">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-adviser') }}</span>
                            <div class="row">
                                <div class="col-auto col-lg-8">
                                    <input list=advisersList class="form-control" type="email" name="emailadviser"
                                        @if ($requestsnotify)   
                                            placeholder="Solicitud enviada debes esperar a que sea respondida" disabled
                                        @else
                                            placeholder="{{$teamsview[0]->Adviser}}"
                                        @endif
                                    >
                                    <datalist id=advisersList>
                                        @foreach ($advisers as $item)
                                            <option value="{{$item->email}}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border-end border-secondary">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-categorie') }}</span>
                            <select class="form-select" name="categorie">
                                @foreach ($categories as $item)
                                <option value="{{$item->id}}"
                                    @if ($teamsview[0]->CategorieId == $item->id)
                                        selected
                                    @endif
                                >{{$item->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-event') }}</span>
                            <input class="form-control" name="event" type="text" placeholder="{{$teamsview[0]->Event}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border-end border-secondary">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-status') }}</span>
                            @if ($teamsview[0]->status < 2)
                                <h5 class="mt-1">{{ __('students-dashboard.team-view-s-incomplete') }}</h5>
                            @else
                                <h5 class="mt-1">{{ __('students-dashboard.team-view-s-complete') }}</h5>
                            @endif
                           
                        </div>
                        <div class="col-6">
                            <span class="fw-bolder">{{ __('students-dashboard.team-view-file') }}</span>
                            <div class="row">
                                <div class="col-auto col-lg-8 col-xl-9">
                                    <input class="form-control" type="file" name="file">
                                </div>
                                <div class="col-auto mt-lg-1 mt-md-1 mt-sm-1 mt-xs-1 mt-xs-1">
                                    <a class="btn btn-outline-success" href="{{route('viewDocument',$teamsview[0]->TeamDoc)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">
                                    <strong>{{ __('students-dashboard.team-view-teammates') }}</strong>
                                    <br>
                                </label>
                                <ul>
                                    @foreach ($teamsview as $item)
                                        <li>{{$item->Student}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-success btn-icon-split p-0" type="submit">
                            <span class="text-white-50 icon">
                                <i class="far fa-save fs-5 text-white"></i>
                            </span>
                            <span class="text-white text">{{ __('students-dashboard.team-view-savebtn') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection