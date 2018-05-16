!function (t) {
    function e(o) {
        if (a[o])return a[o].exports;
        var n = a[o] = {exports: {}, id: o, loaded: !1};
        return t[o].call(n.exports, n, n.exports, e), n.loaded = !0, n.exports
    }

    var a = {};
    return e.m = t, e.c = a, e.p = "", e(0)
}({
    0: function (t, e, a) {
        t.exports = a(5)
    }, 5: function (t, e) {
        $(function () {
            var s = {};
            s.BtnsUl = {
                position: "absolute",
                bottom: "8px",
                right: "12px",
                zIndex: 3,
                height: "16px"
            }, s.IconSpan = {
                backgroundColor: "#cfcfcf",
                borderRadius: "8px",
                cursor: "pointer",
                display: "block",
                height: "16px",
                width: "16px",
                textIndent: "10em",
                overflow: "hidden"
            }, s.overSpan = {
                backgroundColor: "#e95d26",
                width: "25px"
            }, $.playround("#js-looppic", s), $.makeTab("#js-tab", {lastIsMore: !0}), $.makeTab("#js-media-tab"), $.makeTab("#js-raiders-tab"), $.makeTab("#js-list-outer-n1");
        }),
            $(function () {
            function t() {
                n.detach(), o.detach()
            }

            function e() {
                //$.ajax({
                //    url: "http://u.api.37.com.cn/gwapi/_getGwServerList/?gid=1002540&type=1",
                //    type: "get",
                //    dataType: "jsonp",
                //    success: function (t) {
                //        for (var e = "", a = 0; a < t.data.length; a++) {
                //            var o = new Date(1e3 * t.data[a].ATIME), n = o.getFullYear() + "-" + (o.getMonth() + 1 < 10 ? "0" + (o.getMonth() + 1) : o.getMonth() + 1) + "-" + (o.getDate() < 10 ? "0" + o.getDate() : o.getDate()), i = (o.getHours() < 10 ? "0" + o.getHours() : o.getHours()) + ":" + (o.getMinutes() < 10 ? "0" + o.getMinutes() : o.getMinutes()), r = t.data[a].SNAME;
                //            e += "<ul class='kf-content'><li>" + n + "</li><li>" + i + "</li><li>" + r + "</li></ul>"
                //        }
                //        $(".kf-table").eq(1).append(e)
                //    }
                //}), $.ajax({
                //    url: "http://u.api.37.com.cn/gwapi/_getGwServerList/?gid=1002540&type=2",
                //    type: "get",
                //    dataType: "jsonp",
                //    success: function (t) {
                //        for (var e = "", a = 0; a < t.data.length; a++) {
                //            var o = new Date(1e3 * t.data[a].ATIME), n = o.getFullYear() + "-" + (o.getMonth() + 1 < 10 ? "0" + (o.getMonth() + 1) : o.getMonth() + 1) + "-" + (o.getDate() < 10 ? "0" + o.getDate() : o.getDate()), i = (o.getHours() < 10 ? "0" + o.getHours() : o.getHours()) + ":" + (o.getMinutes() < 10 ? "0" + o.getMinutes() : o.getMinutes()), r = t.data[a].SNAME;
                //            e += "<ul class='kf-content'><li>" + n + "</li><li>" + i + "</li><li>" + r + "</li></ul>"
                //        }
                //        $(".kf-table").eq(0).append(e)
                //    }
                //})

//                $.getJSON("http://api.99you.cn/server/lists?appid=jyqk&jsoncallback=?", function(data) {
//                    e = '';
//                    var j = 0;
//                    for(var i=0; i<data.data.server.length&&j<9; i++){
//                        e += "<ul class='kf-content'><li>"+data.data.server[i].opendate+"</li><li>"+data.data.server[i].opentime+"</li><li>荣耀"+data.data.server[i].seq+"服</li></ul>";
//                        j++;
//                    }
//                    $(".kf-table").eq(0).append(e);
//                }),
//                $.getJSON("http://api.99you.cn/server/lists?appid=jyqkios&jsoncallback=?", function(data) {
//                    e = '';
//                    var j = 0;
//                    for(var i=0; i<data.data.server.length&&j<9; i++){
//                        e += "<ul class='kf-content'><li>"+data.data.server[i].opendate+"</li><li>"+data.data.server[i].opentime+"</li><li>荣耀"+data.data.server[i].seq+"服</li></ul>";
//                        j++;
//                    }
//                    $(".kf-table").eq(1).append(e);
//                })

            }

            $.slideMouse($(".mj-con")), $.slideMask($(".jietu-con"));
            var a = {};
            a.cover = {
                position: "fixed",
                left: "0",
                top: "0",
                width: "100%",
                height: "100%",
                backgroundColor: "#000",
                opacity: ".5",
                filter: "alpha(opacity=50)",
                cursor: "pointer",
                zIndex: "999"
            }, a.box = {
                position: "fixed",
                border: "3px solid black",
                top: "50%",
                left: "50%",
                zIndex: "1000",
                marginLeft: "-403px",
                marginTop: "-227px",
                backgroundColor: "#333",
                width: "800px",
                height: "450px"
            }, a.closeBtn = {
                width: "84px",
                height: "84px",
                right: "-87px",
                top: "-3px",
                overflow: "hidden",
                textIndent: "-100px",
                position: "absolute",
                cursor: "pointer",
                backgroundImage: "url(http://image.37wan.cn/snmst/images/dlg-close.png)"
            };
            var o = $("<div />").css(a.cover), n = $("<div />").css(a.box), i = $("<div />").css(a.closeBtn);
            n.append(i), i.click(t);
            var r = $("#js-tv");
            r.click(function () {
                $("body").append(o).append(n)
            });
            $(".sign-trigger").on("click", function (t) {
                t.stopPropagation(), s.openCalendar()
            }), e()
        })
    }
});