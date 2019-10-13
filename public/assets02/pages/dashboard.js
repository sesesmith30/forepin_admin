! function(e) {
    "use strict";
    var t = function() {};
    t.prototype.createStackedChart = function(e, t, a, i, o, r) {
        Morris.Bar({
            element: e,
            data: t,
            xkey: a,
            ykeys: i,
            stacked: !0,
            labels: o,
            hideHover: "auto",
            resize: !0,
            gridLineColor: "#eeeeee",
            barColors: r
        })
    }, t.prototype.createDonutChart = function(e, t, a) {
        Morris.Donut({
            element: e,
            data: t,
            resize: !0,
            colors: a
        })
    }, e(".peity-pie").each(function() {
        e(this).peity("pie", e(this).data())
    }), e(".peity-donut").each(function() {
        e(this).peity("donut", e(this).data())
    }), e(".peity-line").each(function() {
        e(this).peity("line", e(this).data())
    })
}(window.jQuery),
function(e) {
    "use strict";
}();