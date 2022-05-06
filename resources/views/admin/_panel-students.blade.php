@extends('layouts.admin-private')

@section('body')    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col d-flex flex-row">
            <h4 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.students-header') }}</h4>
        </div>
        <div class="col d-flex flex-row-reverse">
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentcreateModal">{{ __('admin-dashboard.students-creation-button') }} <i class="fas fa-user-tie"></i></a>
        </div>
    </div>
    
    <div class="card-body p-4">
        <table id="studentsTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.students-column-name') }}</th>
                    <th>{{ __('admin-dashboard.students-column-noctrl') }}</th>
                    <th>{{ __('admin-dashboard.students-column-email') }}</th>
                    <th>{{ __('admin-dashboard.students-column-semestre') }}</th>
                    <th>{{ __('admin-dashboard.students-column-birthday') }}</th>
                    <th>{{ __('admin-dashboard.students-column-gender') }}</th>
                    <th>{{ __('admin-dashboard.students-column-carrera') }}</th>
                    <th>{{ __('admin-dashboard.students-column-view/del') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->noctrl}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->semester}}</td>
                        <td>{{$item->birthday}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->career}}</td>
                        <td>
                            <a class="btn btn-success" href="{{route('admin.students-show',$item->id)}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromStudent-{{$item->id}}">
                                <i class="fa fa-remove"></i>
                            </a>
                            @include('components.private._delete-from-student')
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.students-column-name') }}</th>
                    <th>{{ __('admin-dashboard.students-column-noctrl') }}</th>
                    <th>{{ __('admin-dashboard.students-column-email') }}</th>
                    <th>{{ __('admin-dashboard.students-column-semestre') }}</th>
                    <th>{{ __('admin-dashboard.students-column-birthday') }}</th>
                    <th>{{ __('admin-dashboard.students-column-gender') }}</th>
                    <th>{{ __('admin-dashboard.students-column-carrera') }}</th>
                    <th>{{ __('admin-dashboard.students-column-view/del') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Modal create student-->
@include('components.private._create-student')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table1 = $('#studentsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
        });
    </script>
@endpush