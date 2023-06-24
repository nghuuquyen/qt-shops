<div wire:ignore class="cursor-pointer">
    <div
        x-data="{ 
            rangeDate: @entangle($attributes->wire('model')),

            getDefautStartDate() {
                if (this.rangeDate) {
                    dates = this.rangeDate.split('~');
                    if (dates[0]) {
                        return moment(dates[0], 'YYYY-MM-DD');
                    }
                }

                return false;
            },

            getDefautEndDate() {
                if (this.rangeDate) {
                    dates = this.rangeDate.split('~');
                    if (dates[1]) {
                        return moment(dates[1], 'YYYY-MM-DD');
                    }
                }

                return false;
            }
        }"
        x-ref="date_range_picker"
        x-init="
            start = getDefautStartDate() || moment().subtract(29, 'days');

            end = getDefautEndDate() || moment();

            function cb(start, end) {
                $($refs.date_range_picker_output).html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                rangeDate = start.format('YYYY-MM-DD') + '~' + end.format('YYYY-MM-DD');
            }

            $($refs.date_range_picker).daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
                }
            }, cb);

            cb(start, end);        
        "
        class="bg-surface-800 px-4 py-2 text-on-surface-600 rounded w-full flex flex-row gap-2"
    >
        @include('components.icons.calendar-days')
        <span x-ref="date_range_picker_output"></span>
    </div>
</div>