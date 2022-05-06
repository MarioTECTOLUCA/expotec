<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-primary m-0 fw-bold">{{ __('admin-dashboard.events-creation-button') }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('admin.eve-store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <span>{{ __('admin-dashboard.events-creation-name') }}</span>
                <input name="name" class="form-control" type="text">
                @error('name')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('admin-dashboard.events-creation-time') }}</span>
                <input name="time" class="form-control" type="time" style="color-scheme: dark;">
                @error('time')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('admin-dashboard.events-creation-date') }}</span>
                <input name="date" class="form-control" type="date" style="color-scheme: dark;">
                @error('date')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('admin-dashboard.events-creation-logo') }}</span>
                <input name="image" class="form-control" type="file" accept="image/*">
                @error('image')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 d-grid gap-2">
                <button class="btn btn-success" type="submit">{{ __('admin-dashboard.events-creation-button') }} <i class="far fa-save"></i></button>
            </div>
        </form>
    </div>
</div>