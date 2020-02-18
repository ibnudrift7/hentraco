! function(e) {
    function n() {
        return 1 == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
    }

    function i() {
        window.innerHeight > 480 ? (e("div.slider-container").css("height", window.innerHeight), e("div.flexslider").css("height", window.innerHeight), e("div.main-slide").css("height", window.innerHeight)) : (e("div.slider-container").css("height", 480), e("div.flexslider").css("height", 480), e("div.main-slide").css("height", 480)), window.innerWidth < 1e3 && e("header.short").delay(800).animate({
            "margin-top": 0
        }, 200), e(".slides iframe").css("height", window.innerHeight), e(".slides iframe").css("width", window.innerWidth), a = parseInt(e("body.responsive").css("min-width")), n() === !0 ? e("a.touch-nav-open").fadeIn(400, "easeInOutQuad") : window.innerWidth < 1e3 ? e("a.touch-nav-open").fadeIn(400, "easeInOutQuad") : e("a.touch-nav-open").hide()
    }
    var a;
    e(document).ready(function() {
        function a() {
            function i() {
                t = !1
            }

            function a() {
                o = !1, n() === !0 && e("a.touch-nav-open").fadeIn(400, "easeInOutQuad")
            }
            var t, o;
            window.innerWidth > 999 ? (t = !1, o = !0, e("header.short").delay(1600).animate({
                "margin-top": -90
            }, 200, "easeInOutQuad", a), e("a.touch-nav-open").click(function() {
                e(this).fadeOut(200, "easeInOutQuad")
            })) : (n() === !0 && e("a.touch-nav-open").fadeIn(400, "easeInOutQuad"), e("a.touch-nav-open").click(function() {
                e("html,body").animate({
                    scrollTop: e("nav.footer").offset().top
                }, 400)
            })), e("body").mousemove(function(s) {
                window.innerWidth > 999 && s.pageY < 181 && !t ? o ? (e("header.short").stop(!0), a()) : (t = !0, n() === !0 ? e("header.short").delay(200).animate({
                    "margin-top": 0
                }, 200, "easeInOutQuad", i) : e("header.short").delay(800).animate({
                    "margin-top": 0
                }, 200, "easeInOutQuad", i)) : window.innerWidth > 999 && s.pageY > 180 && !o && !t && (o = !0, e("header.short").delay(800).animate({
                    "margin-top": -90
                }, 200, "easeInOutQuad", a))
            })
        }

        function t(e) {
            var n = $f(e);
            n.addEvent("play", function() {
                jQuery(".flexslider").flexslider("pause")
            }), n.addEvent("pause", function() {
                jQuery(".flexslider").flexslider("play")
            })
        }

        function t(e) {
            var n = $f(e);
            n.addEvent("play", function() {
                jQuery(".flexslider").flexslider("pause")
            }), n.addEvent("pause", function() {
                jQuery(".flexslider").flexslider("play")
            })
        }
        if (e("body").jpreLoader({
            splashID: "#jSplash",
            showSplash: !0,
            showPercentage: !0,
            autoClose: !0,
            onetimeLoad: !0,
            splashFunction: function() {
                e("#circle").delay(250).animate({
                    opacity: 1
                }, 500, "linear")
            }
        }), e(".body-container").css("visibility", "hidden"), e(".body-container").hide(), i(), a(), e("a.sdb-close").click(function() {
            var n = e("div.slider-content-box-container").height();
            e(".flex-control-nav").delay(400).fadeIn(400, "easeInOutQuad"), e("div.slider-content-box-container").animate({
                "margin-bottom": -n
            }, {
                easing: "easeInOutQuad",
                duration: 400,
                complete: function() {
                    e(this).hide(), e("a.sdb-open").delay(0).fadeIn(400, "easeInOutQuad")
                }
            })
        }), e("a.sdb-open").click(function() {
            e("a.sdb-open").fadeOut(200, "easeInOutQuad"), e(".flex-control-nav").fadeOut(200, "easeInOutQuad"), e("div.slider-content-box-container").show().animate({
                "margin-bottom": 0
            }, {
                easing: "easeInOutQuad",
                duration: 400
            })
        }), e("ul.slides").hasClass("videos")) {
            for (var o, s = jQuery(".flexslider").find("iframe"), d = 0, r = s.length; r > d; d++) o = s[d], $f(o).addEvent("ready", t);
            jQuery(".flexslider").fitVids().flexslider({
                animation: "fade",
                easing: "easeInOutQuad",
                animationLoop: !0,
                animationSpeed: 800,
                smoothHeight: !1,
                useCSS: !0,
                touch: !1,
                controlNav: !0,
                directionNav: !0,
                prevText: "",
                nextText: "",
                pauseOnHover: !1,
                before: function(e) {
                    0 !== e.slides.eq(e.currentSlide).find("iframe").length && $f(e.slides.eq(e.currentSlide).find("iframe").attr("id")).api("pause")
                }
            })
        } else e(".flexslider").flexslider({
            animation: "fade",
            easing: "easeInOutQuad",
            animationLoop: !0,
            slideshowSpeed: 4800,
            animationSpeed: 800,
            smoothHeight: !1,
            useCSS: !0,
            touch: !1,
            controlNav: !0,
            directionNav: !0,
            prevText: "",
            nextText: "",
            pauseOnHover: !1
        }); if (e("div.flexslider-intro").hasClass("welcome")) {
            for (var o, s = jQuery(".flexslider").find("iframe"), d = 0, r = s.length; r > d; d++) o = s[d], $f(o).addEvent("ready", t);
            jQuery("div.flexslider-intro").fitVids().flexslider({
                animation: "fade",
                easing: "easeInOutQuad",
                animationLoop: !1,
                animationSpeed: 800,
                smoothHeight: !1,
                useCSS: !0,
                touch: !1,
                controlNav: !0,
                directionNav: !0,
                prevText: "",
                nextText: "",
                pauseOnHover: !1,
                before: function(e) {
                    0 !== e.slides.eq(e.currentSlide).find("iframe").length && $f(e.slides.eq(e.currentSlide).find("iframe").attr("id")).api("pause")
                }
            });
            var l = e("#player_1")[0],
                o = $f(l);
            e("a.watch-intro").click(function() {
                e("div.flexslider").fadeOut(400, "easeInOutQuad"), o.api("play"), e("div.flexslider-intro").delay(400).fadeIn(800, "easeInOutQuad", function() {})
            }), e("a.close-video").click(function() {
                o.api("pause"), e("div.flexslider-intro").fadeOut(400, "easeInOutQuad"), e("div.flexslider").delay(400).fadeIn(800, "easeInOutQuad")
            })
        }
        e("ul.slides").hasClass("images") || e("ul.slides").hasClass("videos") ? e(".flex-control-nav").show() : e(".flex-control-nav").hide(), e("a.flex-prev").addClass("line-arrow square left"), e("a.flex-next").addClass("line-arrow square right");
        e("ul.sf-menu").superfish({
            popUpSelector: "ul",
            hoverClass: "sfHover",
            pathClass: "current",
            pathLevels: 1,
            delay: 800,
            animation: {
                opacity: "show",
                height: "show"
            },
            animationOut: {
                opacity: "hide"
            },
            speed: "normal",
            speedOut: "fast",
            cssArrows: !1,
            disableHI: !1
        });
        e("#mobnav-btn").click(function() {
            e(".sf-menu").toggleClass("xactive")
        }), e(".mobnav-subarrow").click(function() {
            e(this).parent().toggleClass("xpopdrop")
        })
    }), e(window).load(function() {
        e(".body-container").css("visibility", "visible"), e(".body-container").fadeIn(800, function() {}), e("a[href*=#]:not([href=#])").click(function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
                var n = e(this.hash);
                if (n = n.length ? n : e("[name=" + this.hash.slice(1) + "]"), n.length) return e("html,body").animate({
                    scrollTop: n.offset().top
                }, 400), !1
            }
        }), e("h5").click(function() {
            e(this).next("p").slideToggle("fast")
        })
    }), e(window).resize(function() {
        i()
    })
}(jQuery);
