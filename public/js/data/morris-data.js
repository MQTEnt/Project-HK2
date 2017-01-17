$(function() {
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Tháng 1',
            a: 100,
            b: 90,
            c: 50,
            d: 60,
            e: 70
        }, {
            y: 'Tháng 2',
            a: 75,
            b: 65,
            c: 50,
            d: 60,
            e: 70
        }, {
            y: 'Tháng 3',
            a: 50,
            b: 40,
            c: 50,
            d: 60,
            e: 70
        }],
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'd', 'e'],
        labels: ['Hạn hán', 'Lũ lụt', 'Động đất', 'Sạt lở đất', 'Khác'],
        hideHover: 'auto',
        resize: true
    });

    var data = [{
        label: "Hạn hán",
        data: 1
    }, {
        label: "Lũ lụt",
        data: 3
    }, {
        label: "Động đất",
        data: 9
    }, {
        label: "Sạt lở đất",
        data: 20
    }, {
        label: "Khác",
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
