<div class="card shadow col-12">
    <div class="card-header py-3">
        <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.advisers-creation-header') }}</h6>
    </div>
    <div class="card-body">
        <form class="user px-4" method="POST" autocomplete="off" action="{{ route('admin.adviser-store') }}">
            @csrf
            <div class="row mb-3">
                <input class="form-control" type="email" placeholder="{{ __('admin-dashboard.advisers-c-placeholder-email') }}" name="emailadviser" />
                @error('emailadviser')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <button class="btn btn-success d-block btn-user w-100" type="submit">{{ __('admin-dashboard.advisers-creation-button') }} <i class="far fa-save fs-5 text-white"></i></button>
        </form>
    </div>
</div>