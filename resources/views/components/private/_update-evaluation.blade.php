@extends('layouts.admin-private')

@section('body')
    <div class="card shadow col-12">
        <div class="card-header py-3">
            <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.items-header-view-edit') }}</h6>
        </div>
        <div class="card-body">
            <form id="updateEvaluation" method="POST" action="{{ route('admin.evaluations-update',$evaluationView[0]->fk_evaluations) }}">
                @csrf
                <div class="col">
                    <div class="row mb-3">
                        <div class="col">
                            <span class="mb-3">{{ __('admin-dashboard.evaluations-creation-name') }}</span>
                            <input name="name" class="form-control" type="text" value="{{$evaluationView[0]->EvaluationName}}"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <span class="mb-3">{{ __('admin-dashboard.evaluations-creation-categorie') }}</span>
                            <select class="form-select" name="categoria">
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}"
                                        @if ($evaluationView[0]->CategorieId == $cat->id)
                                            selected
                                        @endif
                                        >{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="bg-blue-standar border-bottom p-1 rounded-top d-flex justify-content-center align-items-center">
                                <span class="fs-5 text-light"><i class="fas fa-th"></i> {{ __('admin-dashboard.evaluations-creation-items') }}</span>
                            </div>
                            <div class="bg-blue-standar d-flex justify-content-center align-items-center">
                                <div class="col d-flex align-items-center justify-content-center text-white border-end">
                                    <span>{{ __('admin-dashboard.evaluations-creation-name') }}</span>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center text-white">
                                    <span>{{ __('admin-dashboard.evaluations-creation-score') }}</span>
                                </div>
                            </div>
                            <select id="Box" name="box" class="form-select border-0" size="10" onchange="Send()">
                                @foreach ($items as $item)
                                    <option value="{{$item->score}}" id="{{$item->id}}">{{$item->name}} - {{$item->score}} pts</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <div class="bg-blue-standar border-bottom p-1 rounded-top d-flex justify-content-center align-items-center">
                                <span class="fs-5 text-light"><i class="fas fa-th"></i>{{ __('admin-dashboard.evaluations-creation-itemsOn') }}</span>
                            </div>
                            <div class="bg-blue-standar d-flex justify-content-center align-items-center">
                                <div class="col d-flex align-items-center justify-content-center text-white border-end">
                                    <span>{{ __('admin-dashboard.evaluations-creation-name') }}</span>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center text-white">
                                    <span>{{ __('admin-dashboard.evaluations-creation-score') }}</span>
                                </div>
                            </div>
                            <select id="Box1" name="Box1" class="form-select border-0" size="10" onchange="Delete()">
                                @foreach ($evaluationView as $item)
                                    <option value="{{$item->ItemScore}}" id="{{$item->fk_items}}">{{$item->ItemName}} - {{$item->ItemScore}} pts</option>
                                @endforeach
                            </select>
                            @foreach ($evaluationView as $item)
                                <input type="hidden" name="array[]" id="hidden-{{$item->fk_items}}" value="{{$item->fk_items}}">        
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-grid gap-2">
                            <span>{{ __('admin-dashboard.evaluations-creation-score') }}</span>
                            <input id="Tot" name="score" style="outline: none;" value="{{$evaluationView[0]->EvaluationScore}}" readonly/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-grid gap-2">
                            <button id="confirmEvaCreate" class="btn btn-success text-white" type="submit">{{ __('admin-dashboard.evaluations-creation-button') }} 
                                <i class="far fa-save fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var score = parseInt(document.getElementById("Tot").value);
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
                document.getElementById("updateEvaluation").appendChild(input);
                document.getElementById("Tot").value  = score;
                x.options[x.selectedIndex].remove(); 
            }else{
                score = score - parseInt(Select_value);
                document.getElementById("Tot").value  = score;
            }

            if(score == 100){
                document.getElementById("confirmEvaCreate").disabled = false;
            }else if(score > 100 || score < 100){
                document.getElementById("confirmEvaCreate").disabled = true;
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