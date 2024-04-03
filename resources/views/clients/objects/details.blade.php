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
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">{{ $object->name}}</h4>
                                <p class="text-muted mb-0">{{$object->description}}</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="{{route('object.details', ['id' => $object->id])}}" method="GET">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-md-auto">
                                            <div class="input-group">
                                                <input type="text" class="form-control border dash-filter-picker"
                                                       data-provider="flatpickr" data-range-date="true"
                                                       data-date-format="d/m/Y"
                                                       data-deafult-date="{{$defaultRange}}" name="range">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i></div>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-soft-primary">
                                                <i class="bx bx-filter-alt align-middle me-1"></i>
                                                Filtrer
                                            </button>
                                        </div>

                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    @if( $type == "Captor" || $type == "Both")
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Moyenne humidité</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                  data-target="{{ $average['humidity']['average'] }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-water text-primary"></i>
                                    </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endif
                    @if( $type == "Captor" || $type == "Both")
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Moyenne température</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                  data-target="{{ $average['temperature']['average'] }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                       <i class='bx bxs-thermometer text-primary'></i>
                                    </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endif
                    @if( $type == "Actuator" || $type == "Both")
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Etat de l'objet</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span>Eteint</span>
                                            </h4>

                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-camera text-primary"></i>
                                    </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endif
                    @if( $type == "Captor" || $type == "Both")
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Donnée actuelle</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div id="realtime-object">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-sun text-primary"></i>
                                    </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endif
                </div> <!-- end row-->

                @if( $type == "Captor" || $type == "Both")
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Graphe</h4>
                                </div><!-- end card header -->

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts"
                                             data-colors='["#FF5733", "#336600"]' class="apex-charts"
                                             dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                @endif


            </div> <!-- end .h-100-->

        </div> <!-- end col -->

    </div>

@endsection


@section('script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function (value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(
                                newValue
                            );
                            if (color) return color.trim();
                            else return newValue;
                        } else {
                            var val = value.split(",");
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(
                                    document.documentElement
                                ).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                } else {
                    console.warn('data-colors atributes not found on', chartId);
                }
            }
        }

        const type = {!! json_encode($type) !!};

        if (type === "Captor" || type === "Both") {
            var linechartcustomerColors = getChartColorsArray("customer_impression_charts");
            if (linechartcustomerColors) {
                const response = {!! json_encode($data) !!};
                const date = response.map((item) => item.date);
                const temperature = response.map((item) => item['temperature']).filter(
                    (item) => item !== undefined
                );
                const humidity = response.map((item) => item['humidite']).filter(
                    (item) => item !== undefined
                );
                var options = {
                    series: [{
                        name: "Temperature",
                        type: "area",
                        data: temperature,
                    },
                        {
                            name: "Humidité",
                            type: "area",
                            data: humidity,
                        },
                    ],
                    chart: {
                        height: 370,
                        type: "line",
                        toolbar: {
                            show: false,
                        },
                    },
                    stroke: {
                        curve: "straight",
                        dashArray: [0, 0, 8],
                        width: [4, 0,],
                    },
                    fill: {
                        opacity: [0.6, 0.3,],
                    },
                    markers: {
                        size: [0, 0,],
                        strokeWidth: 2,
                        hover: {
                            size: 4,
                        },
                    },
                    xaxis: {
                        categories: date,
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                    grid: {
                        show: false,
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: false,
                            },
                        },
                        padding: {
                            top: 0,
                            right: -2,
                            bottom: 15,
                            left: 10,
                        },
                    },
                    legend: {
                        show: true,
                        horizontalAlign: "center",
                        offsetX: 0,
                        offsetY: -5,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 6,
                        },
                        itemMargin: {
                            horizontal: 10,
                            vertical: 0,
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "50%",
                            barHeight: "70%",
                        },
                    },
                    colors: linechartcustomerColors,
                };
                var chart = new ApexCharts(
                    document.querySelector("#customer_impression_charts"),
                    options
                );
                chart.render();
            }
        }

    </script>
    <script>
        if (type === "Captor" || type === "Both") {
            let optionsHeaders = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            };
            let baseUrl = window.location.origin;
            setInterval(function () {
                fetch(baseUrl + '/api/last-captor', optionsHeaders)
                    .then(response => response.json())
                    .then(body => {
                        const name = Object.keys(body);
                        const values = Object.values(body);
                        const div = document.getElementById('realtime-object')
                        div.innerHTML = '';
                        name.forEach((key, index) => {
                            const h5 = document.createElement('h5');
                            h5.textContent = `${key}: ${values[index]}`;
                            div.appendChild(h5);
                        });
                    });
            }, 3000)
        }

    </script>
@endsection
