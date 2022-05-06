<div class="modal fade" id="categorievieweditModal-{{$item->id}}" name="categorievieweditModal-{{$item->id}}" tabindex="-1" aria-labelledby="categorievieweditModalLabel-{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="card shadow col-12">
                    <div class="card-header py-3">
                        <h6 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.categories-header-view-edit') }}</h6>
                    </div>
                    <div class="card-body">
                        <form class="user" method="POST" autocomplete="off" action="{{ route('admin.categories-update') }}">
                            @csrf
                            <div class="row mb-3 mx-1">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input class="form-control" type="text" name="name" value="{{$item->name}}"/>
                            </div>
                            <button class="btn btn-success d-block btn-user w-100" type="submit">
                                {{ __('admin-dashboard.categories-item-update-button') }} <i class="far fa-save fs-5 text-white"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
