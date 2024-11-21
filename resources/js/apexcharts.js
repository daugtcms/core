import ApexCharts from 'apexcharts';

window.setupApexChart = function (options) {
    return {
        options: options,
        init() {
            const chart = new ApexCharts(this.$el, this.options);
            chart.render();
        },
    }
}
