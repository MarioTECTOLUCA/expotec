@extends('layouts.admin-private')

@section('body')    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col col-lg-6">
                <h4 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.categories-header') }}</h4>
            </div>
            <div class="col-md-auto col-lg-6">
                <div class="row d-flex flex-row-reverse">
                    <div class="col-auto">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#categoriecreateModal">{{ __('admin-dashboard.categories-creation-btn') }} <i class="fa fa-check-square"></i></a>
                    </div>
                    <div class="col-auto mb-md-auto">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#careerCreateModal">{{ __('admin-dashboard.careers-creation-btn') }} <i class="fa fa-file-text"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-auto col-lg-6">
                <table id="adminCategoriesTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.categories-column-name') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#categorievieweditModal-{{$item->id}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @include('components.private._update-categorie')
                                    <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromCategorie-{{$item->id}}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                    @include('components.private._delete-from-categorie')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.categories-column-name') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-auto col-lg-6">
                <table id="adminCareersTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.careers-column-name') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($careers as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#careersvieweditModal-{{$item->id}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromCareer-{{$item->id}}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                    @include('components.private._update-careers')
                                    @include('components.private._delete-from-career')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.careers-column-name') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal create categorie-->
@include('components.private._create-categories')
<!--Modal create careers-->
@include('components.private._create-careers')


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table1 = $('#adminCategoriesTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });

            var table2 = $('#adminCareersTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
        });
    </script>
@endpush
