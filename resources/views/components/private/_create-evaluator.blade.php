<div class="card shadow col-12">
    <div class="card-header py-3">
        <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.evaluators-creation-header') }}</h6>
    </div>
    <div class="card-body">
        <form class="user p-4" method="POST" autocomplete="off" action="{{ route('admin.evaluators-store') }}">
            @csrf
            <div class="row mb-3">
                <input class="form-control" type="text" placeholder="{{ __('admin-dashboard.evaluators-c-placeholder-name') }}" name="name" />
                @error('name')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="row mb-3">
                <input class="form-control" type="email" placeholder="{{ __('admin-dashboard.evaluators-c-placeholder-email') }}" name="email" />
                @error('email')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="row mb-3">
                <label>{{ __('admin-dashboard.evaluators-c-placeholder-event') }}</label>
                <select class="form-select" name="event">
                    @foreach ($events as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row mb-3">
                <label>{{ __('admin-dashboard.evaluators-c-placeholder-categorie') }}</label>
                <select class="form-select" name="categorie">
                    @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success d-block btn-user w-100" type="submit">{{ __('admin-dashboard.evaluators-creation-button') }} <i class="far fa-save fs-5 text-white"></i></button>
        </form>
    </div>
</div>