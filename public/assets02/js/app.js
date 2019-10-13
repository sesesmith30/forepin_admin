! function(i) {
    "use strict";
    var t = function() {};
    t.prototype.intSlimscrollmenu = function() {
        i(".slimscroll-menu").slimscroll({
            height: "auto",
            position: "right",
            size: "5px",
            color: "#9ea5ab",
            wheelStep: 5,
            touchScrollStep: 50
        })
    }, t.prototype.initSlimscrollnoti = function() {
        i(".slimscroll-noti").slimscroll({
            height: "208px",
            position: "right",
            size: "5px",
            color: "#98a6ad",
            wheelStep: 10
        })
    }, t.prototype.initMetisMenu = function() {
        i("#side-menu").metisMenu()
    }, t.prototype.initLeftMenuCollapse = function() {
        i(".button-menu-mobile").on("click", function(t) {
            t.preventDefault(), i("body").toggleClass("enlarged")
        })
    }, t.prototype.initEnlarge = function() {
        // i(window).width() < 1025 ? i("body").addClass("enlarged") : i("body").removeClass("enlarged")
    }, t.prototype.initActiveMenu = function() {
        i("#sidebar-menu a").each(function() {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t && (i(this).addClass("active"), i(this).parent().addClass("active"), i(this).parent().parent().addClass("in"), i(this).parent().parent().prev().addClass("active"), i(this).parent().parent().parent().addClass("active"), i(this).parent().parent().parent().parent().addClass("in"), i(this).parent().parent().parent().parent().parent().addClass("active"))
        })
    }, t.prototype.Preloader = function() {
        i(window).on("load", function() {
            i("#status").fadeOut(), i("#preloader").delay(350).fadeOut("slow"), i("body").delay(350).css({
                overflow: "visible"
            })
        })
    }, t.prototype.initComponents = function() {
        i('[data-toggle="tooltip"]').tooltip(), i('[data-toggle="popover"]').popover()
    }, t.prototype.initToggleSearch = function() {
        i(".toggle-search").on("click", function() {
            var t = i(this).data("target");
            t && i(t).toggleClass("open")
        })
    }, t.prototype.init = function() {
        this.intSlimscrollmenu(), this.initSlimscrollnoti(), this.initMetisMenu(), this.initLeftMenuCollapse(), this.initEnlarge(), this.initActiveMenu(), this.Preloader(), this.initComponents(), this.initToggleSearch()
    }, i.MainApp = new t, i.MainApp.Constructor = t
}(window.jQuery),
function(t) {
    "use strict";
    window.jQuery.MainApp.init()
}();