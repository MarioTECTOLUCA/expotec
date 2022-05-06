<div class="modal fade" id="evaluatorvieweditModal-{{$item->id}}" name="evaluatorvieweditModal-{{$item->id}}" tabindex="-1" aria-labelledby="evaluatorvieweditModal-{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="card shadow col-12">
                    <div class="card-header py-3">
                        <h6 class="text-blue-standar m-0 fw-bold">{{ __('admin-dashboard.evaluators-header-view-edit') }}</h6>
                    </div>
                    <div class="card-body">
                        <form class="user p-4" method="POST" autocomplete="off" action="{{ route('admin.evaluators-update',$item->id) }}">
                            @csrf
                            <div class="row mb-3">
                                <input class="form-control" type="text" value="{{$item->name}}" name="name" />
                                @error('name')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <input class="form-control" type="email" value="{{$item->email}}" name="email" />
                                @error('email')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label>{{ __('admin-dashboard.evaluators-c-placeholder-event') }}</label>
                                <select class="form-select" name="event">
                                    @foreach ($events as $event)
                                        <option value="{{$event->id}}"
                                            @if ($event->id == $item->fk_event)
                                                selected
                                            @endif
                                            >{{$event->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <label>{{ __('admin-dashboard.evaluators-c-placeholder-categorie') }}</label>
                                <select class="form-select" name="categorie">
                                    @foreach ($categories as $cat)
                                        <option value="{{$cat->id}}"
                                            @if ($cat->id == $item->fk_categorie)
                                                selected
                                            @endif
                                        >{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success d-block btn-user w-100" type="submit">{{ __('admin-dashboard.evaluators-update-button') }} <i class="far fa-save fs-5 text-white"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>