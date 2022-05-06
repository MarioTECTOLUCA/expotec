<div class="card shadow col-12">
    <div class="card-header py-3">
        <h6 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.items-header-view-edit') }}</h6>
    </div>
    <div class="card-body">
        <form class="user" method="POST" autocomplete="off" action="{{ route('admin.i-update') }}">
            @csrf
            <div class="row mb-3 mx-1">
                <input type="hidden" name="id" id="idforitem">
                <input class="form-control" type="text" name="name" id="nameforitem"/>
            </div>
            <div class="row mb-3 mx-1">
                <span class="text-muted">{{ __('admin-dashboard.items-creation-score') }}</span>
                <input class="form-control" type="number" min="1" max="100" name="score" id="scoreforitem"/>
            </div>
            <button class="btn btn-success d-block btn-user w-100" type="submit">
                {{ __('admin-dashboard.evaluations-item-update-button') }} <i class="far fa-save fs-5 text-white"></i>
            </button>
        </form>
    </div>
</div>