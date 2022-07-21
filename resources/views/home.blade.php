@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

{{--                    @if(auth()->user()->id === 1)--}}
{{--                        @if(auth()->user()->isSayarGyi())--}}
{{--                        only for SaYarGyi id 1--}}
{{--                        @endif--}}
                        @sayargyi
                            only for SaYarGyi
                        @else
                            <span class="h3 text-danger">you are not sayargyi</span>
                        @endsayargyi
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
