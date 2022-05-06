<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.evaluations-creation-header') }}</h6>
    </div>
    <div class="card-body">
        <form id="creationEvaluation" class="p-2" method="POST" action="{{ route('admin.evaluations-store') }}">
            @csrf
            <div class="col">
                <div class="row mb-3">
                    <div class="col">
                        <span class="mb-3">{{ __('admin-dashboard.evaluations-creation-name') }}</span>
                        <input id="name" name="name" class="form-control" type="text" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <span class="mb-3">{{ __('admin-dashboard.evaluations-creation-categorie') }}</span>
                        <select class="form-select" id="categoria" name="categoria">
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
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
                        <select id="Box1" name="Box1" class="form-select border-0" size="10" onchange="Delete()"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col d-grid gap-2">
                        <span>{{ __('admin-dashboard.evaluations-creation-score') }}</span>
                        <input id="Tot" name="score" style="outline: none;" readonly/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col d-grid gap-2">
                        <button id="confirmEvaCreate" class="btn btn-success text-white" type="submit" disabled>{{ __('admin-dashboard.evaluations-creation-button') }} 
                            <i class="far fa-save fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        
    </script>
@endpush