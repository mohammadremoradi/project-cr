// am5.ready(function () {
//     am5core.useTheme(am4themes_animated);
//     var i = parseInt($("#instagram").val()),
//         g = parseInt($("#google").val()),
//         f = parseInt($("#friends").val()),
//         t = parseInt($("#telegram").val()),
//         l = parseInt($("#linkedin").val()),
//         n = am4core.create("piediv", am4charts.PieChart3D);
//     (n.hiddenState.properties.opacity = 0),
//         (n.legend = new am4charts.Legend()),
//         (n.data = [
//             { country: "instagram", litres: i },
//             { country: "google", litres: g },
//             { country: "friend", litres: f },
//             { country: "linkedin", litres: l },
//             { country: "Telegram", litres: t },
//         ]);
//     var s = n.series.push(new am4charts.PieSeries3D());
//     (s.dataFields.value = "litres"), (s.dataFields.category = "country");
// });

// am5.ready(function () {
//     var root = am5.Root.new("piediv");

//     root.setThemes([am5themes_Animated.new(root)]);

//     // Create chart
//     // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
//     var chart = root.container.children.push(
//         am5percent.PieChart.new(root, {
//             endAngle: 270,
//         })
//     );

//     var i = parseInt($("#instagram").val()),
//         g = parseInt($("#google").val()),
//         f = parseInt($("#friends").val()),
//         t = parseInt($("#telegram").val()),
//         l = parseInt($("#linkedin").val());

//     // Create series
//     // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
//     var series = chart.series.push(
//         am5percent.PieSeries.new(root, {
//             valueField: "value",
//             categoryField: "category",
//             endAngle: 270,
//         })
//     );

//     series.states.create("hidden", {
//         endAngle: -90,
//     });

//     // Set data
//     // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
//     series.data.setAll([
//         {
//             category: "Instagram",
//             value: i ,
//         },
//         {
//             category: "Telegram",
//             value: t,
//         },
//         {
//             category: "Google",
//             value: g,
//         },
//         {
//             category: "Linkedin",
//             value: l,
//         },
//         {
//             category: "Friend",
//             value: f,
//         },
//     ]);

//     series.appear(1000, 100);
// });

am5.ready(function () {
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("piediv");

    var i = parseInt($("#instagram").val());
    var g = parseInt($("#google").val());
    var f = parseInt($("#friend").val());
    var t = parseInt($("#telegram").val());
    var l = parseInt($("#linkedin").val());

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([am5themes_Animated.new(root)]);

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
        am5percent.PieChart.new(root, {
            endAngle: 270,
        })
    );

    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    var series = chart.series.push(
        am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            endAngle: 270,
        })
    );

    series.states.create("hidden", {
        endAngle: -90,
    });

    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series.data.setAll([
        {
            category: "Instagram",
            value: i,
        },
        {
            category: "Telegram",
            value: t,
        },
        {
            category: "google",
            value: g,
        },
        {
            category: "Friend",
            value: f,
        },
        {
            category: "Linkedin",
            value: l,
        },
    ]);

    series.appear(1000, 100);
});

am5.ready(function () {
    var root = am5.Root.new("chartdiv");

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([am5themes_Animated.new(root)]);

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(
        am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout,
        })
    );

    // Data
    var colors = chart.get("colors");

    var number = parseInt($("#count").val());

    var ar = [];
    for (var a = 1; a <= number; a++) {
        var t = parseInt($("#jam" + a).val());
        var d = $("#day" + a).val();

        v = {
            country: d,
            visits: t,
            icon: "https://www.amcharts.com/wp-content/uploads/flags/united-states.svg",
            columnSettings: {
                fill: colors.next(),
            },
        };

        ar.push(v);
    }

    console.log(ar);

    var data = ar;

    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(
        am5xy.CategoryAxis.new(root, {
            categoryField: "country",
            renderer: am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
            }),
            bullet: function (root, axis, dataItem) {
                return am5xy.AxisBullet.new(root, {
                    location: 0.5,
                    sprite: am5.Picture.new(root, {
                        width: 24,
                        height: 24,
                        centerY: am5.p50,
                        centerX: am5.p50,
                        src: dataItem.dataContext.icon,
                    }),
                });
            },
        })
    );

    xAxis.get("renderer").labels.template.setAll({
        paddingTop: 20,
    });

    xAxis.data.setAll(data);

    var yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {}),
        })
    );

    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    var series = chart.series.push(
        am5xy.ColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "visits",
            categoryXField: "country",
        })
    );

    series.columns.template.setAll({
        tooltipText: "{categoryX}: {valueY}",
        tooltipY: 0,
        strokeOpacity: 0,
        templateField: "columnSettings",
    });

    series.data.setAll(data);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();
    chart.appear(1000, 100);
}); // end am5.ready()













am5.ready(function () {
    var root = am5.Root.new("survey_chart");

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([am5themes_Animated.new(root)]);

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(
        am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout,
        })
    );

    // Data
    var colors = chart.get("colors");

    var number = parseInt($("#count").val());

    var ar = [];
    for (var a = 1; a <= number; a++) {
        var t = parseInt($("#avg" + a).val());
        var d = $("#name" + a).val();

        v = {
            country: d,
            visits: t,
            icon: "https://www.amcharts.com/wp-content/uploads/flags/united-states.svg",
            columnSettings: {
                fill: colors.next(),
            },
        };

        ar.push(v);
    }

    console.log(ar);

    var data = ar;

    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(
        am5xy.CategoryAxis.new(root, {
            categoryField: "country",
            renderer: am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
            }),
            bullet: function (root, axis, dataItem) {
                return am5xy.AxisBullet.new(root, {
                    location: 0.5,
                    sprite: am5.Picture.new(root, {
                        width: 24,
                        height: 24,
                        centerY: am5.p50,
                        centerX: am5.p50,
                        src: dataItem.dataContext.icon,
                    }),
                });
            },
        })
    );

    xAxis.get("renderer").labels.template.setAll({
        paddingTop: 20,
    });

    xAxis.data.setAll(data);

    var yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {}),
        })
    );

    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    var series = chart.series.push(
        am5xy.ColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "visits",
            categoryXField: "country",
        })
    );

    series.columns.template.setAll({
        tooltipText: "{categoryX}: {valueY}",
        tooltipY: 0,
        strokeOpacity: 0,
        templateField: "columnSettings",
    });

    series.data.setAll(data);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();
    chart.appear(1000, 100);
}); // end am5.ready()
