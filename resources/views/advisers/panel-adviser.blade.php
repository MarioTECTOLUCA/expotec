@extends('layouts.advisers-private')

@section('body')    
    @if (session()->get('LoggedUser')->status == 0)
        <h3 class="text-dark mb-4">{{ __('adviser-dashboard.head') }}</h3>
        @include('components.private._adviser-completeregister')
    @else
        
    @endif
@endsection