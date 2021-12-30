@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.Site') }}: {{ $url->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tr>
                        <td>ID</td>
                        <td>{{ $url->id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.Name') }}</td>
                        <td>{{ $url->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.Date of creation') }}</td>
                        <td>{{ $url->created_at }}</td>
                    </tr>
                </table>
            </div>
    <h2 class="mt-5 mb-3">{{ __('messages.Checks') }}</h2>
    {{ Form::open(['url' => route('urls.checks.store', [$url->id])]) }}
        {{ Form::submit(__('messages.Run check'), ['class' => 'btn btn-primary mb-3']) }}
    {{ Form::close() }}
        <table class="table table-bordered table-hover text-nowrap">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.Status code') }}</th>
            <th scope="col">h1</th>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">{{ __('messages.Date of creation') }}</th>
        </tr>
        @if ($urlChecks)
            @foreach ($urlChecks as $urlCheck)
                <tr>
                    <td scope="row">{{ $urlCheck->id }}</td>
                    <td>{{ $urlCheck->status_code }}</td>
                    <td>{{ Str::limit($urlCheck->h1, 50) }}</td>
                    <td>{{ Str::limit($urlCheck->title, 50) }}</td>
                    <td>{{ Str::limit($urlCheck->description, 50) }}</td>
                    <td>{{ $urlCheck->created_at }}</td>
                </tr>
            @endforeach
        @endif
        </table>
    </div>
</main>
@endsection
