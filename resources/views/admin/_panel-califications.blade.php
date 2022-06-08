@extends('layouts.admin-private')

@section('body')
<div class="card shadow col-12">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h4 class="text-blue-standar m-0 fw-bold">{{ __('adviser-dashboard.califications-header') }}</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="teamsCalificationsTable" class="table table-striped table-hover" style="80%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('adviser-dashboard.califications-column-team') }}</th>
                    <th>{{ __('adviser-dashboard.califications-column-categorie') }}</th>
                    <th>{{ __('adviser-dashboard.califications-column-score') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->teamName}}</td>
                        <td>{{$item->categorieName}}</td>
                        @if ($item->score == null)
                            <td>-.-</td>
                        @else
                            <td>{{$item->score}}</td>
                        @endif
                        
                        <td>
                            @if ($item->score == null)
                                <a class="btn btn-success" href="{{route('evaluator-evaluation',$item->teamId)}}">
                                    Evaluacion <i class="fas fa-book-open"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{route('evaluator-evaluation-view',$item->teamId)}}">
                                    Ver <i class="fas fa-edit fa-fw"></i>
                                </a>
                            @endif
                            
                            <a class="btn btn-outline-danger" >
                                {{ __('students-dashboard.team-dt-btn-table') }} <i class="fa fa-remove"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __('adviser-dashboard.califications-column-team') }}</th>
                    <th>{{ __('adviser-dashboard.califications-column-categorie') }}</th>
                    <th>{{ __('adviser-dashboard.califications-column-score') }}</th>
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
            $('#teamsCalificationsTable').DataTable();
        });
    </script>
@endpush