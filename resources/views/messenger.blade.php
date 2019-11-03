@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body" id="chatApp">
                        <messenger-component :user="{{ auth()->user() }}"></messenger-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('scripts')--}}
{{--    <script src="{{ asset('js/chatApp.js') }}"></script>--}}
{{--@endpush--}}
