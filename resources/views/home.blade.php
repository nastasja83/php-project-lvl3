@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">{{ __('messages.Page analyzer') }}</h1>
                <p class="lead">{{ __('messages.Check for free if sites can be used for SEO') }}</p>
                {{ Form::open(['url' => route('home'), 'class' => 'd-flex justify-content-center']) }}
                    {{ Form::text('url[name]', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'https://www.example.com']) }}
                    {{ Form::submit(__('messages.Check'), ['class' => 'btn btn-lg btn-primary ms-3 px-5 text-uppercase']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</main>
@endsection

