<div>
    <div id="order_customer_pie_chart"></div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [25, 75],
                chart: {
                    width: '100%',
                    type: 'pie',
                },
                labels: ["Old Users", "New Users"],
                theme: {
                    monochrome: {
                        enabled: true
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#order_customer_pie_chart"), options);
            chart.render();
        }, false);
    </script>
@endpush
