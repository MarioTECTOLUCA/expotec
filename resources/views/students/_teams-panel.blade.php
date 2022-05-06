@extends('layouts.students-private')

@section('body')
    <div class="card shadow col-12">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h4 class="text-primary m-0 fw-bold">{{ __('students-dashboard.team-header') }}</h4>
                </div>
                <div class="col d-flex flex-row-reverse">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teamcreateModal">{{ __('students-dashboard.team-creation-button') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="teamsStudentTable" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('students-dashboard.team-dt-header-id') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-name') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-adviser') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-categorie') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-event') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-document') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-student') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teamsview as $item)
                        <tr>
                            <td>{{$item->TeamId}}</td>
                            <td>{{$item->Team}}</td>
                            <td>{{$item->Adviser}}</td>
                            <td>{{$item->Categorie}}</td>
                            <td>{{$item->Event}}</td> 
                            <td>
                                <a class="btn btn-success" href="{{ route('students.team-view',$item->TeamId) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                @if ($item->TeamInv < 5)
                                    <a class="btn btn-primary request-student-join" data-bs-toggle="modal" data-bs-target="#addstudentModal">
                                @else
                                    <a class="btn bg-secondary request-student-join" style="pointer-events: none" data-bs-toggle="modal" data-bs-target="#addstudentModal">
                                @endif
                                        <i class="fa fa-user-plus"></i>
                                    </a>
                            </td>
                            <td>
                                <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromTeam{{$item->TeamId}}">
                                    {{ __('students-dashboard.team-dt-btn-table') }} <i class="fa fa-remove"></i>
                                </a>
                                @include('components.private._delete-from-team')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{ __('students-dashboard.team-dt-header-id') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-name') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-adviser') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-categorie') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-event') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-document') }}</th>
                        <th>{{ __('students-dashboard.team-dt-header-student') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!--Modal create team-->
    <div class="modal fade" id="teamcreateModal" name="teamcreateModal" tabindex="-1" aria-labelledby="teamcreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body">
                    @include('components.private._create-team')
                </div>
            </div>
        </div>
    </div>

    <!--Modal send request-->
    <div class="modal fade" id="addstudentModal" name="addstudentModal" tabindex="-1" aria-labelledby="addstudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body">
                    <div class="card shadow col-12">
                        <div class="card-header py-3">
                            <h6 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.items-header-creation') }}</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" autocomplete="off" action="{{ route('teams.request-student') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ __('students-dashboard.team-request-header') }}</label>
                                    <input type="hidden" name="idTeam" id="idTeam" value="">
                                    <input class="form-control" name="noctrl" >
                                    <small class="form-text text-warning">{{ __('students-dashboard.team-request-reminder') }}</small>
                                  </div>
                                  <div class="form-group mt-3 d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center mb-3">
                                    <button class="btn btn-success"><i class="fa-regular fa-paper-plane"></i> {{ __('students-dashboard.team-request-button') }}</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#teamsStudentTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
            table.on('click','.request-student-join', function(){
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = tr.prev('.parent');
                }
                var data  = table.row($tr).data();       
                $('#idTeam').val(data[0]);
                $('#addstudentModal').show();
            });
        });
    </script>
@endpush