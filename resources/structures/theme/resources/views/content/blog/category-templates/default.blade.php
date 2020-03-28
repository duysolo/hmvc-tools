@extends('DummyAlias::content.master')

@section('content')
    <article>
        {!! $object->content ?? '' !!}
    </article>
@endsection
