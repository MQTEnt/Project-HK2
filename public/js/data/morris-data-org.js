$(function() {
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Tháng 1',
            a: 100
        }, {
            y: 'Tháng 2',
            a: 75
        }, {
            y: 'Tháng 3',
            a: 50
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Số tiền (triệu đồng)'],
        hideHover: 'auto',
        resize: true,
    });

    var data = [{
        label: "Tỉnh A",
        data: 1
    }, {
        label: "Tỉnh B",
        data: 3
    }, {
        label: "Tỉnh C",
        data: 9
    }, {
        label: "Tỉnh D",
        data: 20
    }, {
        label: "Tỉnh E",
        data: 20
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });
});

