@extends($theme.'layouts.app')
@section('title',trans('Home'))

@section('content')
    @include($theme.'partials.heroBanner')
    @include($theme.'sections.feature')
    @include($theme.'sections.about-us')
    @include($theme.'sections.statistics')
    @include($theme.'sections.blog')
@endsection
