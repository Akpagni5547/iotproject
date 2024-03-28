@extends('layouts.master')
@section('title')
    @lang('translation.widgets')
@endsection
{{--@section('css')--}}
{{--    <!-- plugin css -->--}}
{{--    <link href="{{URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />--}}

{{--    <link href="{{URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />--}}
{{--@endsection--}}
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Velzon
        @endslot
        @slot('title')
            Widgets
        @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
