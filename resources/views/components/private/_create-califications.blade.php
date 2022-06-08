@extends('layouts.admin-private')

@section('body')
    <div class="card shadow mb-4">
        <div class="card-header py-1">
            <div class="row d-flex align-items-center">
                <div class="col d-flex align-items-center justify-content-center">
                    <h2 class="fs-4">EVALUACION</h2>
                </div>
                <div class="col d-flex justify-content-end aling-items-center"><span class="mx-1 rounded-circle span-minimize d-flex align-items-center justify-content-center"><i class="far fa-window-minimize text-white"></i></span><span class="mx-1 span-restore mx-1 rounded-circle d-flex align-items-center justify-content-center"><i class="far fa-window-maximize text-white"></i></span><span class="mx-1 span-close mx-1 rounded-circle d-flex align-items-center justify-content-center"><i class="fas fa-times text-white"></i></span></div>
            </div>
        </div>
        <div class="card-body bg-window">
            <form class="p-1 text-white" method="POST" action="{{route('evaluator-evaluation-store')}}">
                @csrf
                @foreach ($evaluation as $item)
                    <div class="row border-bottom">
                        <div class="border-end col-8 d-flex justify-content-start align-items-center">
                            <h6>{{$item->id}}.-</h6>
                            <h6 class="mx-1">{{$item->name}}</h6>
                            <input type="hidden" name="id[]" value="{{$item->id}}">
                            <input type="hidden" name="idTeam" value="{{$id}}">
                        </div>
                        <div class="border-start col-4 d-flex justify-content-center align-items-center p-1">
                            <div class="row">
                                <div class="col-auto d-flex justify-content-end align-items-center">
                                    <h6>{{$item->score}} pts. /</h6>
                                </div>
                                <div class="col-auto d-flex">
                                    <input class="form-control mx-1" type="number" name="score[]" inputmode="numeric" min="0" max="{{$item->score}}" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="border-end col-8 d-flex justify-content-start align-items-center"></div>
                    <div class="border col-4 d-flex justify-content-center align-items-center p-1">
                        <div class="row">
                            <div class="col-auto d-flex justify-content-end align-items-center">
                                <h6>Total: </h6>
                            </div>
                            <div class="col-auto d-flex"><button class="btn btn-success btn-sm text-white" type="submit">Confirmar evaluacion <i class="fas fa-check text-white"></i></button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush