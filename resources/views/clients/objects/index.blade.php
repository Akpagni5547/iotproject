@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Starter
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Total Tasks</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                            data-target="234">0</span>k</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                <i class="ri-arrow-up-line align-middle"></i> 17.32 %
                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                <i class="ri-ticket-2-line"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Pending Tasks</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                            data-target="64.5">0</span>k</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                <i class="ri-arrow-down-line align-middle"></i> 0.87 %
                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                <i class="mdi mdi-timer-sand"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Completed Tasks</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                            data-target="116.21">0</span>K</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                <i class="ri-arrow-down-line align-middle"></i> 2.52 %
                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                <i class="ri-checkbox-circle-line"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Deleted Tasks</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                            data-target="14.84">0</span>%</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                <i class="ri-arrow-up-line align-middle"></i> 0.63 %
                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                <i class="ri-delete-bin-line"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="tasksList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Tous les objets</h5>
                    </div>
                </div>
                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                            <thead class="table-light text-muted">
                            <tr>
                                <th class="sort" data-sort="id">ID</th>
                                <th class="sort" data-sort="project_name">Name</th>
                                <th class="sort" data-sort="tasks_name">Project</th>
                                <th class="sort" data-sort="client_name">Code</th>
                                <th class="sort" data-sort="status">Position</th>
                                <th class="sort" data-sort="priority">Crée le</th>
                            </tr>
                            </thead>
                            <tbody class="list form-check-all">
                            @foreach($objects as $object)
                                <tr>
                                    <td><a href="{{route('object.details', ['id' => $object->id])}}"
                                           class="fw-medium link-primary">{{$object->id}}</a></td>
                                    <td><a
                                            href="{{route('object.details', ['id' => $object->id])}}"
                                            class="fw-medium link-primary">{{$object->name}}</a></td>
                                    <td>{{$object->project->name}}</td>

                                    {{-- need to random code with this class badge bg-danger text-uppercase  --}}
                                    <td>
                                    <span class="badge <?php
                                        $randNum = rand(0, 4);
                                        if ($randNum == 0) {
                                            echo "bg-danger";
                                        } elseif ($randNum == 1) {
                                            echo "bg-success";
                                        } else {
                                            echo "bg-info";
                                        }
                                    ?> text-uppercase">{{$object->code}}</span>
                                    </td>
                                    <td>{{$object->position}}</td>
                                    <td>{{$object->created_at->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection
@section('script')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
