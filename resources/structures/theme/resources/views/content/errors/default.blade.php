@extends('DummyAlias::content.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="article-wrap">
                    <h1 class="post-title">
                        {{ HttpResponseCode::MAINTENANCE_MODE . ' - ' . trans(WEBED_CORE . '::errors.' . HttpResponseCode::MAINTENANCE_MODE . '.title') }}
                    </h1>
                    <article class="post-body">
                        <div class="post-content">
                            {{ trans(WEBED_CORE . '::errors.' . HttpResponseCode::MAINTENANCE_MODE . '.message') }}
                        </div>
                        @if(isset($exception) && $exception instanceof Exception)
                            <div class="post-content">{{ $exception->getMessage() }}</div>
                        @endif
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
