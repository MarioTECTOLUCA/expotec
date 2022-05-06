@extends('layouts.admin-private')

@section('body')    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col d-flex flex-row">
            <h4 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.evaluators-header') }}</h4>
        </div>
        <div class="col d-flex flex-row-reverse">
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#evaluatorcreateModal">{{ __('admin-dashboard.evaluators-creation-button') }} <i class="fas fa-user-tie"></i></a>
        </div>
    </div>
    
    <div class="card-body p-4">
        <table id="evaluatorsTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.evaluators-column-name') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-email') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-event') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-categorie') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-view/del') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluators as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->event}}</td>
                        <td>{{$item->categorie}}</td>
                        <td>
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#evaluatorvieweditModal-{{$item->id}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @include('components.private._update-evaluator')
                            <a  class="btn btn-outline-warning">
                                <i class="fas fa-key"></i>
                            </a>
                            <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromEvaluator-{{$item->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                            @include('components.private._delete-from-evaluator')
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.evaluators-column-name') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-email') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-event') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-categorie') }}</th>
                    <th>{{ __('admin-dashboard.evaluators-column-view/del') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Modal create team-->
<div class="modal fade" id="evaluatorcreateModal" name="teamcreateModal" tabindex="-1" aria-labelledby="teamcreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                @include('components.private._create-evaluator')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table1 = $('#evaluatorsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
        });
    </script>
@endpush