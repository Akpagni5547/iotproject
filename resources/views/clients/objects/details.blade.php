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
                        @foreach( $averages as $key => $value)
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Moyenne {{$key}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                  data-target="{{round($value, 2)}}">0</span>
                                                </h4>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-water text-primary"></i>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                                <span
                                                    id="text-state-command">{{ $actuator['statut'] == 'ON' ? 'Allumé' : "Eteint" }}</span>
                                            </h4>

                                        </div>
                                        <div class="">
                                            <!-- Rounded Buttons -->
                                            <button type="button" id="btn-command"
                                                    class="btn rounded-pill btn-primary waves-effect waves-light"
                                                    onclick="sendCommand()">
                                                {{ $actuator['statut'] == 'ON' ? 'Éteindre' : "Allumer" }}
                                            </button>
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
                </div>

                @if( $type == "Captor" || $type == "Both")
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Graphe</h4>
                                </div>

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts"
                                             data-colors='["#FF5733", "#336600", "#6793DA"]' class="apex-charts"
                                             dir="ltr"></div>
                                    </div>
                                </div>
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
                const date = response.map((item) => item.dateTime);
                const dataByKey = {};
                response.forEach(item => {
                    Object.entries(item).forEach(([key, value]) => {
                        if (key === 'dateTime') return;
                        if (!dataByKey[key]) {
                            dataByKey[key] = []; // Créez un tableau vide si la clé n'existe pas encore
                        }
                        dataByKey[key].push(value); // Ajoutez la valeur à la clé correspondante
                    });
                });
                // Affiche les données organisées par clé
                let series = [];
                Object.entries(dataByKey).forEach(([key, values]) => {
                    series.push({
                        name: key,
                        type: "area",
                        data: values,

                    })

                });
                var options = {
                    series: series,
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
                        opacity: [0.6, 0.3, 0.5],
                    },
                    markers: {
                        size: [0, 0, 0],
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
            const apiUrl = "{{ env('API_URL') }}";
            let url = apiUrl + '/device-data-realtime?device_id=' + {!! json_encode($object->code) !!};
            setInterval(function () {
                fetch(url, optionsHeaders)
                    .then(response => response.json())
                    .then(body => {
                        const values = JSON.parse(body.values)
                        delete values['dateTime']
                        const name = Object.keys(values);
                        const value = Object.values(values);
                        const div = document.getElementById('realtime-object')
                        div.innerHTML = '';
                        name.forEach((key, index) => {
                            const h5 = document.createElement('h5');
                            h5.textContent = `${key}: ${value[index]}`;
                            div.appendChild(h5);
                        });
                    });
            }, 3000)
        }

    </script>
    <script>
        function sendCommand() {
            const button = document.getElementById('btn-command');
            const textState = document.getElementById('text-state-command');
            // get text in button
            const text = button.textContent.trim();
            const apiUrl = "{{ env('API_URL') }}";
            const url = apiUrl + '/send-command';
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    device_id: {!! json_encode($object->code) !!},
                    command: 'ON'
                })
            };
            // manage loading
            button.textContent = 'Loading...';
            // disable button
            button.disabled = true;
            fetch(url, options)
                .then(response => response.json())
                .then(body => {
                    if (body['statut'] === 'success') {
                        button.textContent = text === 'Allumer' ? 'Éteindre' : 'Allumer';
                        textState.textContent = text === 'Allumer' ? 'Allumé' : 'Eteint';
                    } else {
                        button.textContent = text === 'Allumer' ? 'Allumer' : 'Éteindre';
                        textState.textContent = text === 'Allumer' ? 'Eteint' : 'Allumé';
                    }
                    button.disabled = false;
                }).catch(error => {
                console.log('error', error)
                button.textContent = text === 'Allumer' ? 'Allumer' : 'Éteindre';
                textState.textContent = text === 'Allumer' ? 'Eteint' : 'Allumé';
                button.disabled = false;
            });
        }
    </script>
@endsection
