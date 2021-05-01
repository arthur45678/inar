
@if(isset($post->chartTextTop))

    @switch($chart->type)

        @case('bar-and-line')

        <x-charts.chart-bar-and-line :id="$chart->id"></x-charts.chart-bar-and-line>
        @break
        @case('sorted-bar-chart')
        <x-charts.sorted-bar-chart :id="$chart->id"></x-charts.sorted-bar-chart>
        @break

        @case('column-with-rotated-series')
        <x-charts.column-with-rotated-series :id="$chart->id"></x-charts.column-with-rotated-series>
        @break
        @case('stacked-column-chart-100')
        <x-charts.stacked-column-chart-100 :id="$chart->id"></x-charts.stacked-column-chart-100>
        @break
        @case('clustered-column-chart')
        <x-charts.clustered-column-chart :id="$chart->id"></x-charts.clustered-column-chart>
        @break
        @case('simple-pie-chart')
        <x-charts.simple-pie-chart :id="$chart->id"></x-charts.simple-pie-chart>
        @break
        @case('pie-chart-3d')
        <x-charts.pie-chart-3d :id="$chart->id"></x-charts.pie-chart-3d>
        @break

        @case('pie-chart-with-legend')
        <x-charts.pie-chart-with-legend :id="$chart->id"></x-charts.pie-chart-with-legend>
        @break
        @case('live-radar')
        <x-charts.live-radar :id="$chart->id"></x-charts.live-radar>
        @break
        @case('scatter-chart')
        <x-charts.scatter-chart :id="$chart->id"></x-charts.scatter-chart>
        @break


        @default

    @endswitch
@else

@endif




