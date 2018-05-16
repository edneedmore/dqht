!function (t) {
    function e(n) {
        if (i[n])return i[n].exports;
        var a = i[n] = {exports: {}, id: n, loaded: !1};
        return t[n].call(a.exports, a, a.exports, e), a.loaded = !0, a.exports
    }

    var i = {};
    return e.m = t, e.c = i, e.p = "", e(0)
}({
    0: function (t, e, i) {
        t.exports = i(12)
    }, 12: function (t, e) {
        jQuery.extend({
            playround: function (t, e) {
                function n(t) {
                    var e = $(t + ">ul").first().remove();
                    $(t).append(d), $(".SlideBox").append(e);
                    var n = $(".SlideBox>ul").first().find("li");
                    if (l = n.length, $(".SlideBox").css(r.SlideBox), $(".SlideBox>ul:first-child").css(r.SlideUl), n.css(r.SlideLi), n.first().css({
                            zIndex: 2,
                            opacity: 1,
                            filter: "alpha(opacity=100)"
                        }), l > 1) {
                        if ($(".SlideBox").append(c), 0 != $(".BtnsUl").length)for (i = 1; i <= l; i++)s = "<li><span>" + i + "</span></li>", $(".BtnsUl").append(s);
                        $(".BtnsUl").css(r.BtnsUl), $(".BtnsUl>li").css(r.BtnsLi), $(".BtnsUl>li>span").css(r.IconSpan), $(".BtnsUl>li>span").first().css(r.overSpan)
                    }
                }

                function a() {
                    function t(t) {
                        var e = 0;
                        $(".SlideBox>ul:first-child>li").each(function (t, i) {
                            2 == $(this).css("z-index") && (e = t)
                        }), $(".SlideBox>ul:first-child>li").eq(e).css({zIndex: 1}).fadeTo(a, 0), $(".SlideBox>ul:first-child>li").eq(t).fadeTo(a, 1).css({zIndex: 2}), $(".BtnsUl>li>span").css(r.IconSpan), $(".BtnsUl>li>span").eq(t).css(r.overSpan)
                    }

                    function e() {
                        s++, s > l - 1 && (s = 0), t(s)
                    }

                    var i, n, a = 400, o = 5e3, s = 0, d = setInterval(e, o), c = 300;
                    $(".BtnsUl>li>span").hover(function () {
                        n = $(this), i && clearTimeout(i), i = setTimeout(function () {
                            clearInterval(d), n.parent().index() != s && (s = n.parent().index(), t(s))
                        }, c)
                    }, function () {
                        i && clearTimeout(i), i = setTimeout(function () {
                            clearInterval(d), d = setInterval(e, o)
                        }, c)
                    })
                }

                function o(t) {
                    n(t), l > 1 && a()
                }

                var r = new Object;
                r.SlideBox = {width: "100%", height: "100%", position: "relative"}, r.SlideUl = {
                    width: "100%",
                    height: "100%",
                    position: "relative"
                }, r.SlideLi = {
                    position: "absolute",
                    zIndex: 1,
                    left: 0,
                    top: 0,
                    opacity: 0,
                    filter: "alpha(opacity=0)"
                }, r.BtnsUl = {position: "absolute", bottom: "13px", right: "25px", zIndex: 3}, r.BtnsLi = {
                    float: "left",
                    paddingLeft: "8px"
                }, r.IconSpan = {
                    backgroundColor: "#9A1803",
                    borderRadius: "5px",
                    cursor: "pointer",
                    display: "block",
                    height: "10px",
                    width: "10px",
                    textIndent: "0",
                    fontSize: "0",
                    lineHeight: "0",
                    overflow: "hidden"
                }, r.overSpan = {backgroundColor: "#FFB606"}, e && (r = $.extend(r, e));
                var s, l, d = "<div class='SlideBox'></div>", c = "<ul class='BtnsUl'></ul>";
                o(t)
            }, AcrossSwitch: function (t, e, n, a, o) {
                function r() {
                    for (i = 0; i < a; i++)f.find(">li:last").prependTo(f);
                    f.css({"margin-left": -v}), f.animate({"margin-left": "0px"}, c)
                }

                function s() {
                    f.animate({"margin-left": -v}, c, function () {
                        for (i = 0; i < a; i++)f.find(">li:first").appendTo(f);
                        f.css({"margin-left": "0px"})
                    })
                }

                var l = 1, d = !1, c = 500, p = 5e3, f = $(t).find(">ul"), h = f.find(">li"), u = h.outerWidth(!0), m = h.length;
                f.width(u * m), arguments[3] && (l = a), arguments[4] && (d = o), arguments[5] && (c = Speed);
                var v = u * l;
                if ($(n).click(function () {
                        s()
                    }), $(e).click(function () {
                        r()
                    }), d) {
                    var x = setInterval(function () {
                        s()
                    }, p);
                    $(n).hover(function () {
                        clearInterval(x)
                    }, function () {
                        x = setInterval(function () {
                            s()
                        }, p)
                    }), $(e).hover(function () {
                        clearInterval(x)
                    }, function () {
                        x = setInterval(function () {
                            s()
                        }, p)
                    })
                }
            }, mediaShow: function (t, e, i) {
                function n() {
                    t.click(function () {
                        var t = $(this), e = $("<div />").css(l.cover), i = $("<div />").css(l.mediaBox), n = $("<div />").css(l.closeBtn).text("X"), a = new Image;
                        a.onload = function () {
                            e.appendTo("body");
                            var o = a.width, r = a.height;
                            if (parseInt(a.width, 10) > 800) {
                                var d = 800 / parseInt(a.width);
                                a.style.width = "800px", a.style.height = parseInt(a.height, 10) * d + "px"
                            } else a.style.width = o + "px", a.style.height = r + "px";
                            a = $(a);
                            var c = parseInt(a.css("width"), 10) / 2 + parseInt(i.css("border-width"), 10), p = parseInt(a.css("height"), 10) / 2 + parseInt(i.css("border-width"), 10);
                            if (i.append(a).append(n).css({
                                    "margin-left": -c + "px",
                                    "margin-top": -p + "px"
                                }), s.showDesc) {
                                var f = $("<div />").css(l.desc).css("bottom", "0px");
                                f.text(t.attr("title")).appendTo(i)
                            }
                            i.appendTo("body").fadeIn()
                        }, t.attr(s.dataAttr) && (a.src = t.attr(s.dataAttr)), n.click(function () {
                            e.remove(), i.remove()
                        }), e.click(function () {
                            i.remove(), e.remove()
                        })
                    })
                }

                function a() {
                    t.click(function () {
                        var t = $(this), e = t.attr(s.dataAttr), i = t.attr("title");
                        if (!e)return !1;
                        var n = $("<div />").css(l.cover), a = $("<div />").css(l.mediaBox), o = $("<div />").css(l.closeBtn).text("X"), r = '<objectclassid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800px" height="450px"> <param name="movie" value="http://image.37wan.cn/common/images/flvplayer.swf"> <param name="quality" value="high"> <param name="allowFullScreen" value="true"> <param name="wmode" value="Transparent"> <embed src="http://image.37wan.cn/common/images/flvplayer.swf" allowfullscreen="true" flashvars="vcastr_file=' + e + "&IsAutoPlay=1&IsShowTime=1&vcastr_title=" + i + '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800px" height="450px" wmode="Transparent"> </object>';
                        if (a.append(r), n.appendTo("body"), a.append(o).appendTo("body").css({displaly: "none"}), s.showDesc) {
                            var d = $("<div />").css(l.desc).css("top", "0px");
                            d.text(t.attr("title")).appendTo(a)
                        }
                        var c = parseInt(a.width(), 10) / 2, p = parseInt(a.height(), 10) / 2;
                        a.css({"margin-left": -c + "px", "margin-top": -p + "px"}).fadeIn(), o.click(function () {
                            n.remove(), a.remove()
                        }), n.click(function () {
                            a.remove(), n.remove()
                        })
                    })
                }

                var o = {};
                o.cover = {
                    position: "fixed",
                    width: "100%",
                    height: "100%",
                    top: "0px",
                    left: "0px",
                    backgroundColor: "rgba(0,0,0,.5)",
                    "*background-color": "#000",
                    "-ms-filter": "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
                    filter: "alpha(opacity=50)",
                    zIndex: 10
                }, o.mediaBox = {
                    position: "fixed",
                    backgroundColor: "#333",
                    border: "3px solid black",
                    top: "50%",
                    left: "50%",
                    "z-index": "1000"
                }, o.closeBtn = {
                    position: "absolute",
                    width: "45px",
                    height: "45px",
                    font: 'bold 30px/45px "Microsoft Yahei"',
                    "text-align": "center",
                    color: "#b38a54",
                    top: "-3px",
                    right: "-48px",
                    backgroundColor: "black",
                    cursor: "pointer"
                }, o.desc = {
                    position: "absolute",
                    height: "28px",
                    width: "100%",
                    left: "0px",
                    backgroundColor: "rgba(0,0,0,.5)",
                    "*background-color": "#000",
                    "-ms-filter": "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
                    filter: "alpha(opacity=50)",
                    "text-align": "center",
                    color: "#f4f4f4",
                    font: 'bold 16px/28px "Microsoft Yahei"'
                };
                var r = {mediaType: "image", dataAttr: "data-src", showDesc: !1}, s = {}, l = {};
                switch ($.extend(s, r, e), $.extend(l, o, i), t = $(t), s.mediaType) {
                    case"image":
                        n();
                        break;
                    case"vedio":
                        a();
                        break;
                    default:
                        n()
                }
            }, makeTab: function (t, e) {
                var i = {lastIsMore: !1, showIndex: 0, triggerEvent: "mouseenter", activeClass: "current"}, n = {};
                $.extend(n, i, e), "string" == typeof t && (t = $(t));
                var a = t.children("ul").find("li"), o = t.children("div.tab-box");
                n.lastIsMore && (a.last().attr("lastismore", "true"), a = t.children("ul").find("li:not([lastismore])")), a.on(n.triggerEvent, function () {
                    var t = $(this), e = a.index(t);
                    a.removeClass(n.activeClass), t.addClass(n.activeClass), o.hide().eq(e).fadeIn()
                }), a.eq(n.showIndex).trigger(n.triggerEvent)
            }, slideMouse: function (t) {
                function e(e) {
                    t.scrollLeft(e)
                }

                function i(t) {
                    return t * (l / o)
                }

                function n(t) {
                    e(i(t))
                }

                var t = t, a = t.children(".list"), o = t.width(), r = a.children("li"), s = parseInt(r.length * r.outerWidth(!0)) + 90;
                a.width(s);
                var l = s - o;
                t.on("mouseenter", function (t) {
                    var t = t || window.event, e = t.pageX - ($(window).width() - 1200) / 2;
                    n(e)
                }), t.on("mousemove", function (t) {
                    var e = t.pageX - ($(window).width() - 1200) / 2;
                    n(e)
                })
            }, slideMask: function (t) {
                function e(t) {
                    r = t;
                    var e = n.eq(t).find(".little-item");
                    n.eq(t).find(".big-item");
                    if (n.eq(t).stop().animate({width: a}), e.stop().animate({width: 0}), r != s) {
                        var i = n.eq(s).find(".little-item");
                        n.eq(s).find(".big-item");
                        n.eq(s).stop().animate({width: o + 2}), i.stop().animate({width: o + 2})
                    }
                    s = r
                }

                var t = t, i = t.find(".big-item"), n = (t.find(".little-item"), t.find("li")), a = i.width(), o = (t.width() - a) / (n.length - 1);
                n.width(o + 2), i.width(0);
                var r = 4, s = 4;
                e(r), t.on("mouseenter", ".little-item", function () {
                    var t = $(this).parent("li").index();
                    e(t)
                })
            }, getGift: function (t, e) {
                var i = {}, n = {};
                $.extend(n, i, e), "string" == typeof t && (t = $(t)), t.on("click", function (t) {
                    var e = $(this), i = e.attr("data-pid"), n = e.attr("data-gid"), a = e.attr("data-rid"), o = {
                        pid: i,
                        gid: n,
                        rid: a
                    };
                    i && n && a && $.ajax({
                        url: "http://api.m.37.com/wap/gcard",
                        type: "POST",
                        data: o,
                        dataType: "jsonp",
                        success: function (t) {
                            $.prompt ? "1" == t.state ? $.prompt('<div style="text-align:center;">领取成功！序列号为:<div style="font:bold 18px/27px;">' + t.data.CARD + "</div></div>") : "-10" == t.state ? $.prompt('<p style="padding-bottom:10px;text-align:center;">请您先登陆</p>', function () {
                                location.href = "http://m.37.com/login.html?url=" + location.href
                            }) : "-11" == t.state ? $.prompt('<p style="padding-bottom:10px;text-align:center;">您已经领过该礼包</p><p style="text-align:center;">序列号：' + t.data.CARD + "</p>") : $.prompt('<p style="padding-bottom:10px;text-align:center;">' + t.msg + "</p>") : "1" == t.state ? alert("领取成功！序列号为:" + t.data.CARD) : "-10" == t.state ? prompt("请您先登陆") && (location.href = "http://m.37.com/login.html?url=" + location.href) : "-11" == t.state ? alert("您已经领过该礼包,序列号：" + t.data.CARD) : alert(t.msg)
                        }
                    })
                })
            }
        })
    }
});