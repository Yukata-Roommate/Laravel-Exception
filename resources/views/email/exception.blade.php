@extends('yr-exception::email.layout', ['title' => $subject])

@section('style')
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
@endsection

@section('content')
    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.occurred-at') }}
        </p>

        <p class="exception-item__content">
            {{ $datetime }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.class') }}
        </p>

        <p class="exception-item__content">
            {{ $className }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.url') }}
        </p>

        <p class="exception-item__content">
            {{ $url }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.message') }}
        </p>

        <p class="exception-item__content">
            {{ $exception }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.status-code') }}
        </p>

        <p class="exception-item__content">
            {{ $code }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.file') }}
        </p>

        <p class="exception-item__content">
            {{ $file }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.line') }}
        </p>

        <p class="exception-item__content">
            {{ $line }}
        </p>
    </div>

    <div class="exception-item">
        <p class="exception-item__title">
            {{ __('yr-exception::item.stack-trace') }}
        </p>

        @foreach ($traces as $trace)
            <p class="exception-item__content">
                {{ $trace }}
            </p>
        @endforeach
    </div>
@endsection
