@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Menu
        @endslot
        @slot('title')
            Projets
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div id="teamlist">
                    <div class="team-list grid-view-filter row" id="team-member-list">
                        @foreach($projects as $project)
                            @php
                                $num = rand(1, 12);
                            @endphp
                            <div class="col">
                                <div class="card team-box">
                                    <div class="team-cover">
                                        <img src="{{"build/images/small/img-". $num .".jpg"}}" alt=""
                                             class="img-fluid"/>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row align-items-center team-row">

                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="team-content">
                                                        <a class="member-name" data-bs-toggle="offcanvas" href="#"
                                                           aria-controls="member-overview">
                                                            <h5 class="fs-16 mb-1 text-white">{{$project->name}}</h5>
                                                        </a>
                                                        <p class="text-muted member-designation text-white-75 mb-0">{{$project->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1 projects-num">{{count($project->objets)}}</h5>
                                                        <p class="text-muted mb-0">Objets</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1 tasks-num">{{count($project->controllers)}}</h5>
                                                        <p class="text-muted mb-0">Microcontrolleurs</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="#" class="btn btn-light view-btn">Voir</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!--end row-->

@endsection
@section('script')
    {{--    <script src="{{ URL::asset('build/js/pages/team.init.js') }}"></script>--}}

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
