<div class="card shadow col-12">
    <div class="card-header py-3">
        <h6 class="text-primary m-0 fw-bold">{{ __('students-dashboard.team-creation-header') }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" autocomplete="off" action="{{ route('students.teams-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <span>{{ __('students-dashboard.team-creation-name') }}</span>
                <input name="name" class="form-control" type="text">
                @error('name')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('students-dashboard.team-creation-event') }}</span>
                <select name="event" class="form-select">
                    @foreach ($events as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('event')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('students-dashboard.team-creation-categorie') }}</span>
                <select name="categorie" class="form-select">
                    @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('categorie')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('students-dashboard.team-creation-file') }}</span>
                <input class="form-control" type="file" name="file">
                @error('file')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <span>{{ __('students-dashboard.team-creation-emailadviser') }}</span>
                <input list=advisersList name="emailadviser" class="form-control" type="email">
                <datalist id=advisersList>
                    @foreach ($advisers as $item)
                        <option value="{{$item->email}}"></option>
                    @endforeach
                </datalist>
                @error('emailadviser')
                    <small>*{{$message}}</small>
                @enderror
            </div>
            <div class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center mb-3">
                <button class="btn btn-primary" type="submit">{{ __('students-dashboard.team-creation-btn') }}</button>
            </div>
        </form>
    </div>
</div>