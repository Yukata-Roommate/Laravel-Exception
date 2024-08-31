@extends('YR::Mail::template', [
    'title' => $subject,
])

@section('content')
    <div class="exception-item">
        <p class="exception-item__title">Occurred At</p>

        <p class="exception-item__content">{{ $datetime }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">Exception Class</p>

        <p class="exception-item__content">{{ $className }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">URL</p>

        <p class="exception-item__content">{{ $url }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">Message</p>

        <p class="exception-item__content">{{ $message }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">Status Code</p>

        <p class="exception-item__content">{{ $code }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">File</p>

        <p class="exception-item__content">{{ $file }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">Line</p>

        <p class="exception-item__content">{{ $line }}</p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">Stack Trace</p>

        @foreach ($traces as $trace)
            <p class="exception-item__content">{{ $trace }}</p>
        @endforeach
    </div>
@stop

@section('head')
    <style>
        .exception-item {
            margin-bottom: 20px;
        }

        .exception-item__title {
            margin: 0;
            margin-bottom: 1rem;
            font-size: 1.5em;
        }

        .exception-item__content {
            margin: 0;
            font-size: 1em;
        }
    </style>
@stop
