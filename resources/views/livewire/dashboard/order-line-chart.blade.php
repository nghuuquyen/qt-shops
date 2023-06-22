<div class="w-full">
    <div id="order_line_chart"></div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 160,
                },
                grid: {
                    show: false,
                },
                markers: {
                    size: 5,
                },
                series: [{
                    name: 'sales',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
                }
            }

            var chart = new ApexCharts(document.querySelector("#order_line_chart"), options);

            chart.render();
        }, false);
    </script>
@endpush
