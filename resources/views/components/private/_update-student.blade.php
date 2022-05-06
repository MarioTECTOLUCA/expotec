@extends('layouts.admin-private')

@section('body')
<div class="card shadow">
    <div class="card-header p-2">
        <div class="row d-flex align-items-center">
            <div class="col d-flex align-items-center">
                <h2 class="text-blue-standar fw-bold fs-4">{{ __('admin-dashboard.students-header') }}</h2>
            </div>
            <div class="col d-flex justify-content-end aling-items-center">
                <span class="mx-1 shadow rounded-circle span-minimize d-flex align-items-center justify-content-center"><i class="far fa-window-minimize text-white"></i></span>
                <span class="mx-1 shadow span-restore mx-1 rounded-circle d-flex align-items-center justify-content-center"><i class="far fa-window-maximize text-white"></i></span>
                <span class="mx-1 shadow span-close mx-1 rounded-circle d-flex align-items-center justify-content-center"><i class="fas fa-times text-white"></i></span></div>
        </div>
    </div>
    <div class="card-body bg-window">
        <form class="p-1" method="POST" action="{{route('admin.students-update',$student->id)}}">
            @csrf
            <div class="mb-3 form-floating">  
                <input id="flotatingName" class="form-control text-white bg-transparent" type="text" name="name" value="{{$student->name}}" />
                <label class="form-label text-white" for="flotatingName">{{ __('admin-dashboard.students-column-name') }}</label>
                @error('name')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 form-floating">
                <input id="flotatingEmail" class="form-control text-white bg-transparent " type="text" name="email" value="{{$student->email}}"/>
                <label class="form-label text-white" for="flotatingEmail">{{ __('admin-dashboard.students-column-email') }}</label>
                @error('email')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col mb-3 form-floating">
                    <input id="flotatingEmail-1" class="form-control text-white bg-transparent " type="text" name="noctrl" value="{{$student->noctrl}}"/>
                    <label class="form-label text-white" for="flotatingEmail">{{ __('admin-dashboard.students-column-noctrl') }}</label>
                    @error('noctrl')
                        <small>*{{$message}}</small>
                    @enderror
                </div>
                <div class="col p-1">
                    <a class="btn bg-orange-standar text-white" href="{{route('admin.students-pass',$student->id)}}">
                        <i class="fas fa-key"></i> {{ __('admin-dashboard.students-column-newpassword') }}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 form-floating">
                    <input id="flotatingSemestre" class="form-control text-white bg-transparent " type="number" name="semestre" value="{{$student->semester}}"/>
                    <label class="form-label text-white" for="flotatingSemestre">{{ __('admin-dashboard.students-column-semestre') }}</label>
                    @error('semestre')
                        <small>*{{$message}}</small>
                    @enderror
                </div>
                <div class="col mb-3 form-floating">
                    <select id="flotatingGenero" class="form-select bg-transparent text-white" name="gender">
                        @foreach ($gender as $item)
                            <option  class="bg-window" value="{{$item->id}}"
                                @if ($item->id == $student->fk_gender)
                                    selected
                                @endif    
                            >{{$item->name}}</option>
                        @endforeach
                    </select>
                    <label class="form-label text-white" for="flotatingGenero">{{ __('admin-dashboard.students-column-gender') }}</label>
                    @error('genero')
                        <small>*{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3 form-floating">
                <input id="flotatingFecha" class="form-control text-white bg-transparent " type="date" name="nac" value="{{$student->birthday}}"/>
                <label class="form-label text-white" for="flotatingFecha">{{ __('admin-dashboard.students-column-birthday') }}</label>
                @error('nac')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 form-floating">
                <select id="flotatingCareer" class="form-select bg-transparent text-white" name="career">
                    @foreach ($careers as $item)
                        <option class="bg-window" value="{{$item->id}}"
                        @if ($item->id == $student->fk_career)
                            selected
                        @endif     
                        >{{$item->name}}</option>
                    @endforeach
                </select>
                <label class="form-label text-white" for="flotatingCareer">{{ __('admin-dashboard.students-column-carrera') }}</label>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-submit-outline fw-bold" type="submit">{{ __('admin-dashboard.students-update-button') }} 
                    <i class="fas fa-save fs-6"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
