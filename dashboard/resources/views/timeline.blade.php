@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div>
    <label for="yearFilter">Kies jaar: </label>
    <select id="yearFilter" onchange="updateChart()">
        <option value="alle">Alle</option>
        @foreach(range(date('Y'), 2000, -1) as $year)
        <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>
</div>

<div id="chart"></div>

<script>
    var originalData;
    var chart;

    function updateChart() {
        var selectedYear = document.getElementById('yearFilter').value;

        var filteredData = originalData.filter(function(project) {
            var projectStartYear = new Date(project.y[0]).getFullYear();
            var projectEndYear = new Date(project.y[1]).getFullYear();

            return selectedYear === 'alle' || (projectStartYear <= selectedYear && projectEndYear >= selectedYear);
        });

        chart.updateSeries([{
            data: filteredData
        }]);
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (isset($projects) && !empty($projects)){
            // @phpstan-ignore-next-line
            var projects = <?php echo json_encode($projects); ?>;
        } else {
            var projects = [];
        }  

        originalData = projects.map(function(project) {
            return {
                x: project.name,
                y: [
                    new Date(project.start_date).getTime(),
                    new Date(project.end_date).getTime()
                ],
                url: '/projects/' + project.id,
                fillColor: getColorByStatus(project.project_status)
            };
        });

        function getColorByStatus(status) {
            if (status === 'Op schema') {
                return '#52C41A';
            } else if (status === 'Vertraagd') {
                return '#FAAD14';
            } else if (status === 'Afgewezen') {
                return '#FF4D4F';
            }
        }

        var nowLine = {
            x: new Date().getTime(),

            borderColor: '#1890FF',
            borderWidth: 3,
            label: {
                borderColor: '#1890FF',
                offsetY: -10,
                style: {
                    fontSize: '12px',
                    color: '#fff',
                    background: '#1890FF'

                },
                text: 'Nu',
                orientation: 'horizontal'
            }
        };

        var years = Array.from(new Set(originalData.flatMap(project => [new Date(project.y[0]).getFullYear(), new Date(project.y[1]).getFullYear()])));

        years.sort((a, b) => b - a);

        var select = document.getElementById('yearFilter');
        select.innerHTML = '<option value="alle">Alle</option>';
        years.forEach(function(year) {
            var option = document.createElement('option');
            option.value = year;
            option.text = year;
            select.add(option);
        });

        var options = {
            series: [{
                data: originalData
            }],
            chart: {
                type: 'rangeBar',
                events: {
                    click: function(event, chartContext, config) {
                        if (config.dataPointIndex !== undefined && originalData[config.dataPointIndex]?.url) {
                            window.location.href = originalData[config.dataPointIndex].url;
                        }
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            xaxis: {
                type: 'datetime'
            },
            annotations: {
                xaxis: [{
                    x: nowLine.x,
                    borderColor: nowLine.borderColor,
                    label: nowLine.label,
                    strokeDashArray: nowLine.strokeDashArray,
                    borderWidth: nowLine.borderWidth,
                    labelOrientation: nowLine.label.orientation
                }]
            }
        };

        chart = new ApexCharts(document.querySelector('#chart'), options);
        chart.render();
    });
</script>
@endsection