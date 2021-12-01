<!DOCTYPE html>
<html lang="en">
<title>
    Core Web Vital - Insight
</title>
<link href="{{asset('vendor/corewebvitals/core-web-vital/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('vendor/corewebvitals/core-web-vital/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/corewebvitals/core-web-vital/apexcharts-bundle/dist/apexcharts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/corewebvitals/core-web-vital/js/jquery.js')}}"></script>

<style>
    body {
        background-color: #ffffff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='621' height='621' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='88' y1='88' x2='0' y2='0'%3E%3Cstop offset='0' stop-color='%23005092'/%3E%3Cstop offset='1' stop-color='%23007cc4'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='75' y1='76' x2='168' y2='160'%3E%3Cstop offset='0' stop-color='%23868686'/%3E%3Cstop offset='0.09' stop-color='%23ababab'/%3E%3Cstop offset='0.18' stop-color='%23c4c4c4'/%3E%3Cstop offset='0.31' stop-color='%23d7d7d7'/%3E%3Cstop offset='0.44' stop-color='%23e5e5e5'/%3E%3Cstop offset='0.59' stop-color='%23f1f1f1'/%3E%3Cstop offset='0.75' stop-color='%23f9f9f9'/%3E%3Cstop offset='1' stop-color='%23FFFFFF'/%3E%3C/linearGradient%3E%3Cfilter id='c' x='0' y='0' width='200%25' height='200%25'%3E%3CfeGaussianBlur in='SourceGraphic' stdDeviation='12' /%3E%3C/filter%3E%3C/defs%3E%3Cpolygon fill='url(%23a)' points='0 174 0 0 174 0'/%3E%3Cpath fill='%23000' fill-opacity='0.45' filter='url(%23c)' d='M121.8 174C59.2 153.1 0 174 0 174s63.5-73.8 87-94c24.4-20.9 87-80 87-80S107.9 104.4 121.8 174z'/%3E%3Cpath fill='url(%23b)' d='M142.7 142.7C59.2 142.7 0 174 0 174s42-66.3 74.9-99.3S174 0 174 0S142.7 62.6 142.7 142.7z'/%3E%3C/svg%3E");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: top left;
    }
</style>
<link rel="stylesheet" type="text/css"
      href="{{asset('vendor/corewebvitals/core-web-vital/DataTables/datatables.min.css')}}"/>
<script type="text/javascript"
        src="{{asset('vendor/corewebvitals/core-web-vital/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/corewebvitals/core-web-vital/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/corewebvitals/core-web-vital/js/daterangepicker.js')}}"></script>
<link rel="stylesheet" type="text/css"
      href="{{asset('vendor/corewebvitals/core-web-vital/css/daterangepicker.css')}}"/>
<body>
<div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('cwv-insight')}}" method="GET">
                            <div class="row justify-content-end">
                                <div class="col-4">
                                    <label for="daterange">Date Range: </label>
                                    <input type="text" name="daterange"
                                           value="{{date('m/d/Y',strtotime($date_from))}} - {{date('m/d/Y',strtotime($date_to))}}"/>
                                    <button type="submit" class="btn btn-success btn-sm">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CLS</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Cumulative Layout Shift </h6>
                        <p class="card-text">
                            Cumulative Layout Shift (CLS): measures visual stability. To provide a good user experience,
                            pages should maintain a CLS of 0.1. or less.
                        </p>
                        <br>
                        <div>
                            {{$cls_value}}
                        </div>

                        <div class="progress">
                            <div class="progress-bar {{$cls_progress_bar_class}}" role="progressbar"
                                 style="width: {{$cls_percentage}}%"
                                 aria-valuenow="{{$cls_percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LCP</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Largest Contentful Paint</h6>
                        <p class="card-text">
                            Largest Contentful Paint (LCP): measures loading performance. To provide a good user
                            experience, LCP should occur within 2.5 seconds of when the page first starts loading.
                        </p>
                        <div>
                            {{$lcp_value}} Sec
                        </div>
                        <div class="progress">
                            <div class="progress-bar {{$lcp_progress_bar_class}}" role="progressbar"
                                 style="width: {{$lcp_percentage}}%"
                                 aria-valuenow="{{$lcp_percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">FCP</h5>
                        <h6 class="card-subtitle mb-2 text-muted">First Contentful Paint</h6>
                        <p class="card-text">
                            The First Contentful Paint (FCP) metric measures the time from when the page starts loading
                            to when any part of the page's content is rendered on the screen.
                        </p>
                        <br>
                        <div>
                            {{$fcp_value}} Sec
                        </div>
                        <div class="progress">
                            <div class="progress-bar {{$fcp_progress_bar_class}}" role="progressbar"
                                 style="width: {{$fcp_percentage}}%"
                                 aria-valuenow="{{$fcp_percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mt-3">
                    <div id="chart-line"></div>
                    <div id="chart-line2"></div>
                    <div id="chart-area"></div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mt-3 p-3">
                    <table id="core-web-vital-table" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>URL</th>
                            <th>Web/Mobile</th>
                            <th>CLS</th>
                            <th>LCP</th>
                            <th>FCP</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($core_web_vital_url_records_by_url as $core_web_vital_url)
                            <tr>
                                <td>{{$core_web_vital_url->first()->coreWebVitalUrl->url}}</td>
                                <td>{{($core_web_vital_url->first()->coreWebVitalUrl->is_mobile==1)?'Mobile':'Web'}}</td>
                                <td>{{round($core_web_vital_url->avg('cls'),2)}}</td>
                                <td>{{round($core_web_vital_url->avg('lcp')/100,2)}}</td>
                                <td>{{round($core_web_vital_url->avg('fcp')/100,2)}}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    var options = {
        series: [{
            data: [
                    @foreach($daily_average_cls_records as $record)
                {
                    x: new Date('{{$record[0]}}').getTime(),
                    y: {{$record[1]}}
                },
                @endforeach
            ]
        }],
        xaxis: {
            type: 'datetime'
        },
        chart: {
            id: 'cls',
            group: 'corewebvitals',
            type: 'area',
            height: 160
        },
        title: {
            text: 'CLS',
            align: 'left'
        },
        colors: ['#008FFB'],
        yaxis: {
            labels: {
                minWidth: 40
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-line"), options);
    chart.render();

    var optionsLine2 = {
        series: [{
            data: [@foreach($daily_average_lcp_records as $record)
            {
                x: new Date('{{$record[0]}}').getTime(),
                y: {{$record[1]}}
            },
                @endforeach]
        }],
        xaxis: {
            type: 'datetime'
        },
        chart: {
            id: 'lcp',
            group: 'corewebvitals',
            type: 'area',
            height: 160
        },
        title: {
            text: 'LCP',
            align: 'left'
        },
        colors: ['#546E7A'],
        yaxis: {
            labels: {
                minWidth: 40
            }
        }
    };

    var chartLine2 = new ApexCharts(document.querySelector("#chart-line2"), optionsLine2);
    chartLine2.render();

    var optionsArea = {
        series: [{
            data: [@foreach($daily_average_fcp_records as $record)
            {
                x: new Date('{{$record[0]}}').getTime(),
                y: {{$record[1]}}
            },
                @endforeach]
        }],
        xaxis: {
            type: 'datetime'
        },
        chart: {
            id: 'fcp',
            group: 'corewebvitals',
            type: 'area',
            height: 160
        },
        title: {
            text: 'FCP',
            align: 'left'
        },
        colors: ['#00E396'],
        yaxis: {
            labels: {
                minWidth: 40
            }
        }
    };

    var chartArea = new ApexCharts(document.querySelector("#chart-area"), optionsArea);
    chartArea.render();

</script>

<script>
    $(document).ready(function () {
        $('#core-web-vital-table').DataTable();
    });
</script>
<script>
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
</body>

</html>
