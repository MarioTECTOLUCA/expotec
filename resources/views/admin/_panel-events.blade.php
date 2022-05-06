@extends('layouts.admin-private')

@section('body')    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col col-lg-6">
                <h4 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.events-header') }}</h4>
            </div>
            <div class="col-md-auto col-lg-6">
                <div class="row d-flex flex-row-reverse">
                    <div class="col-auto">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="" >{{ __('admin-dashboard.events-creation-button') }} <i class="fa fa-check-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <table id="adminEventsTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.events-column-name') }}</th>
                    <th>{{ __('admin-dashboard.events-column-time') }}</th>
                    <th>{{ __('admin-dashboard.events-column-logo') }}</th>
                    <th>{{ __('admin-dashboard.events-column-date') }}</th>
                    <th>{{ __('admin-dashboard.events-column-view/del') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->time}}</td>
                        <td>{{$item->image}}</td>
                        <td>{{$item->date}}</td>
                        <td>
                            <a class="btn btn-success" href="{{route('admin.eve-show',$item->id)}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a  class="btn btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach      
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin-dashboard.events-column-name') }}</th>
                    <th>{{ __('admin-dashboard.events-column-time') }}</th>
                    <th>{{ __('admin-dashboard.events-column-logo') }}</th>
                    <th>{{ __('admin-dashboard.events-column-date') }}</th>
                    <th>{{ __('admin-dashboard.events-column-view/del') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--Modal create team-->
<div class="modal fade" id="eventcreateModal" name="eventcreateModal" tabindex="-1" aria-labelledby="eventcreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                @include('components.private._create-events')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table1 = $('#adminEventsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });

            var table2 = $('#adminEvaluationsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
        });
    </script>
@endpush