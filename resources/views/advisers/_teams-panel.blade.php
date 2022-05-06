@extends('layouts.advisers-private')

@section('body')
    <div class="card shadow col-12">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h4 class="text-blue-standar m-0 fw-bold">{{ __('adviser-dashboard.team-header') }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="teamsAdviserTable" class="table table-striped table-hover" style="80%">
                <thead>
                    <tr>
                        <th>{{ __('adviser-dashboard.team-dt-header-id') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-name') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-adviser') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-categorie') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-event') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-document') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $item)
                        @if ($item->status < 5 || $item->vbo == 0)
                            <tr style="background-color: #f47f20c7;">
                        @else
                            <tr style="background-color: #00800086;">
                        @endif
                        
                            <td style="color:white; font-weight: bold;">{{$item->TeamId}}</td>
                            <td style="color:white; font-weight: bold;">{{$item->name}}</td>
                            <td style="color:white; font-weight: bold;">{{$item->Adviser}}</td>
                            <td style="color:white; font-weight: bold;">{{$item->Categorie}}</td>
                            <td style="color:white; font-weight: bold;">{{$item->Event}}</td> 
                            <td>
                                <a class="btn btn-success" href="{{route('adviser.teamView',$item->TeamId)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>

                                <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromTeam{{$item->TeamId}}">
                                    {{ __('students-dashboard.team-dt-btn-table') }} <i class="fa fa-remove"></i>
                                </a>
                                @include('components.private._delete-from-team')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{ __('adviser-dashboard.team-dt-header-id') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-name') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-adviser') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-categorie') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-event') }}</th>
                        <th>{{ __('adviser-dashboard.team-dt-header-document') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#teamsAdviserTable').DataTable();
        });
    </script>
@endpush