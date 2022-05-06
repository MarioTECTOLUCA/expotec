<div class="modal fade" id="categoriecreateModal" name="categoriecreateModal" tabindex="-1" aria-labelledby="categoriecreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="card shadow col-12">
                    <div class="card-header py-3">
                        <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.categories-header-creation') }}</h6>
                    </div>
                    <div class="card-body">
                        <form class="user p-2" method="POST" autocomplete="off" action="{{ route('admins.categories-store') }}">
                            @csrf
                            <div class="row mb-3 mx-1">
                                <input class="form-control" type="text" placeholder="{{ __('admin-dashboard.categories-creation-name') }}" name="name" />
                            </div>
                            <button class="btn btn-success d-block btn-user w-100" type="submit">{{ __('admin-dashboard.categories-creation-btn') }} <i class="far fa-save fs-5 text-white"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
