@extends('layouts.admin-private')

@section('body')    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col col-lg-6">
                <h4 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.evaluations-header') }}</h4>
            </div>
            <div class="col-md-auto col-lg-6">
                <div class="row d-flex flex-row-reverse">
                    <div class="col-auto">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#itemcreateModal">{{ __('admin-dashboard.items-creation-button') }} <i class="fa fa-check-square"></i></a>
                    </div>
                    <div class="col-auto mb-md-auto">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#evaluationCreateModal">{{ __('admin-dashboard.evaluations-creation-button') }} <i class="fa fa-file-text"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-auto col-lg-6">
                <table id="adminEvaluationsTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.evaluations-column-name') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-score') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-categorie') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-view/del') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->score}} </td>
                                <td>{{$item->CatName}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.evaluations-show',$item->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromEvaluation{{$item->id}}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                    @include('components.private._delete-from-evaluation')
                                </td>
                            </tr>
                        @endforeach
                            
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.evaluations-column-name') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-score') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-categorie') }}</th>
                            <th>{{ __('admin-dashboard.evaluations-column-view/del') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-auto col-lg-6">
                <table id="adminItemsTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.items-column-name') }}</th>
                            <th>{{ __('admin-dashboard.items-column-score') }}</th>
                            <th>{{ __('admin-dashboard.items-column-view/del') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->score}}</td>
                                <td>
                                    <a class="btn btn-success view-edit-item" data-bs-toggle="modal" data-bs-target="#itemvieweditModal">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a  class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteFromItem{{$item->id}}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                    @include('components.private._delete-from-item')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin-dashboard.items-column-name') }}</th>
                            <th>{{ __('admin-dashboard.items-column-score') }}</th>
                            <th>{{ __('admin-dashboard.items-column-view/del') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
    </div>
</div>
<!--Modal create item-->
<div class="modal fade" id="itemcreateModal" name="itemcreateModal" tabindex="-1" aria-labelledby="teamcreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                @include('components.private._create-item-evaluation')
            </div>
        </div>
    </div>
</div>

<!--Modal view/edit item-->
<div class="modal fade" id="itemvieweditModal" name="itemvieweditModal" tabindex="-1" aria-labelledby="addstudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                @include('components.private._update-item-evaluation')
            </div>
        </div>
    </div>
</div>

<!--Modal new evaluation-->
<div class="modal fade" id="evaluationCreateModal" name="evaluationCreateModal" tabindex="-1" aria-labelledby="addstudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                @include('components.private._create-evaluation')
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table1 = $('#adminItemsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });

            var table2 = $('#adminEvaluationsTable').DataTable({
                "scrollY": 200,
                "scrollX": true
            });

            table1.on('click','.view-edit-item', function(){
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = tr.prev('.parent');
                }
                var data  = table1.row($tr).data();       
                $('#idforitem').val(data[0]);
                $('#nameforitem').val(data[1]);
                console.log(data[2]);
                $('#scoreforitem').val(data[2]);
                $('#itemvieweditModal').show();
            });
        });
        var score = 0;
            function Send (){
                var x = document.getElementById("Box");
                var Select_text = x.options[x.selectedIndex].text;
                var Select_value = x.options[x.selectedIndex].value;
                var Select_id = x.options[x.selectedIndex].id;
                score = score + parseInt(Select_value);
                if(score <= 100){
                    var opt = document.createElement('option');
                    opt.innerHTML = Select_text;
                    opt.value = Select_value;
                    opt.id = Select_id;
                    document.getElementById("Box1").appendChild(opt);
                    var input = document.createElement("input");
                    var id = "hidden-".concat(Select_id);
                    input.setAttribute("id", id);
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "array[]");
                    input.setAttribute("value", Select_id);
                    document.getElementById("creationEvaluation").appendChild(input);
                    document.getElementById("Tot").value  = score;
                    x.options[x.selectedIndex].remove(); 
                }else{
                    document.getElementById("Tot").value  = score;
                    score = score - parseInt(Select_value);
                }

                if(score == 100){
                    document.getElementById("confirmEvaCreate").disabled = false;
                }
            }
            function Delete (){
                var x = document.getElementById("Box1");
                var Select_text = x.options[x.selectedIndex].text;
                var Select_value = x.options[x.selectedIndex].value;
                var Select_id = x.options[x.selectedIndex].id;

                var opt = document.createElement('option');
                opt.innerHTML = Select_text;
                opt.value = Select_value;
                opt.id = Select_id;
                document.getElementById("Box").appendChild(opt);
                score = score - parseInt(Select_value);
                var id = "hidden-".concat(Select_id);
                document.getElementById(id).remove();
                x.options[x.selectedIndex].remove();
                document.getElementById("Tot").value  = score;
                if(score < 100){
                    document.getElementById("confirmEvaCreate").disabled = true;
                }
            }
    </script>
@endpush
