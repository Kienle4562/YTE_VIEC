window.ui = function(e) {
 function t(o) {
  if (i[o]) return i[o].exports;
  var n = i[o] = {
   i: o,
   l: !1,
   exports: {}
  };
  return e[o].call(n.exports, n, n.exports, t), n.l = !0, n.exports
 }
 var i = {};
 return t.m = e, t.c = i, t.d = function(e, i, o) {
  t.o(e, i) || Object.defineProperty(e, i, {
   configurable: !1,
   enumerable: !0,
   get: o
  })
 }, t.n = function(e) {
  var i = e && e.__esModule ? function() {
   return e.default
  } : function() {
   return e
  };
  return t.d(i, "a", i), i
 }, t.o = function(e, t) {
  return Object.prototype.hasOwnProperty.call(e, t)
 }, t.p = "", t(t.s = 11)
}([function(e, t) {
 ! function() {
  e.exports = window.jQuery
 }()
}, , , , , , , , , , , function(e, t, i) {
 "use strict";
 i(12), i(16), i(20), i(21), i(22), i(23), i(24)
}, function(e, t, i) {
 "use strict";

 function o(e, t) {
  if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
 }
 var n = function() {
  function e(e, t) {
   for (var i = 0; i < t.length; i++) {
    var o = t[i];
    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
   }
  }
  return function(t, i, o) {
   return i && e(t.prototype, i), o && e(t, o), t
  }
 }();
 i(13), i(14);
 var s = i(15),
  a = function(e) {
   return e && e.__esModule ? e : {
    default: e
   }
  }(s),
  r = function() {
   function e() {
    o(this, e), this.initTopJobScrollBar(), this.setSearchBoxValues(), this.setupTopBanner(), this.setUpTopJobCarousel(), this.setUpHrInsiderCarousel(), this.initFeatures(), this.setUpChannelCarousel()
   }
   return n(e, [{
    key: "setUpChannelCarousel",
    value: function() {
     $(".home__top-management-jobs").find(".channel-content").slick({
      dots: !0,
      slidesToShow: 4,
      slidesToScroll: 4,
      centerMode: !0,
      centerPadding: "0px",
      prevArrow: "",
      nextArrow: "",
      responsive: [{
       breakpoint: 768,
       settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        centerMode: !0,
        centerPadding: "5px",
        dots: !0,
        infinite: !0,
        speed: 300
       }
      }]
     })
    }
   }, {
    key: "setUpTopJobCarousel",
    value: function() {
     var e = $(".home__jobs-you-will-love"),
      t = e.find(".job-carousels");
     t.slick({
      dots: !0,
      prevArrow: '\n        <div class="slick-prev slick-arrow">\n            \n         <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 24 24" version="1.1">        \n                <path style=" " d="M 7.75 1.34375 L 6.25 2.65625 L 14.65625 12 L 6.25 21.34375 L 7.75 22.65625 L 16.75 12.65625 L 17.34375 12 L 16.75 11.34375 Z "></path>\n            </svg>\n        \n        </div>\n        ',
      nextArrow: '\n        <div class="slick-next slick-arrow">\n            \n         <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 24 24" version="1.1">        \n                <path style=" " d="M 7.75 1.34375 L 6.25 2.65625 L 14.65625 12 L 6.25 21.34375 L 7.75 22.65625 L 16.75 12.65625 L 17.34375 12 L 16.75 11.34375 Z "></path>\n            </svg>\n        \n        </div>\n        '
     });
     var i = e.find(".slick-dots"),
      o = e.find(".slick-next"),
      n = e.find(".slick-prev"),
      s = i.find("li");
     $('<div class="dots"></div>').prependTo(i), n.prependTo(i);
     var a = i.find(".dots");
     s.appendTo(a), o.appendTo(i), $('.home__jobs-you-will-love a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
      "topJobTab" == e.target.id && t.slick("setPosition")
     })
    }
   }, {
    key: "setUpHrInsiderCarousel",
    value: function() {
     setTimeout(function() {
      1 == $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").length ? $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").addClass("span12").removeClass("span2") : 2 == $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").length ? $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").addClass("span6").removeClass("span2") : 3 == $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").length ? $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").addClass("span4").removeClass("span2") : 4 == $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").length && $("#adc_TOP_COMPANIES_HORISONTAL").find("div.span2").addClass("span3").removeClass("span2")
     }, 5e3);
     var e = $(".home__hr-insider"),
      t = e.find(".article-contain"),
      i = function(e) {
       var i = (0, a.default)("Read article"),
        o = function(e, t, o, n) {
         return '\n                        <div class="col-md-4 article">\n                                <a href="' + n + '" target="_blank" >\n                                    <div class="article-image" style="background-image: url(' + t + ');"></div>\n                                </a>\n                                <div class="content">\n                                    <h3>' + o + '</h3>\n                                    <p class="inside-content">' + e + '</p>\n                                    <a href="' + n + '" target="_blank" class=" btn btn-outline btn-primary btn-lg btn-block" >' + i + "</a>\n                                </div>\n                        </div>\n                    "
        },
        n = e.map(function(e) {
         var t = e.content,
          i = e.picture,
          n = e.title,
          s = e.url;
         return o(t, i, n, s)
        }),
        s = n.join("");
       t.html(s)
      };
     $.ajax({
      type: "GET",
      url: "loadnews",
      dataType: "json",
      success: function(o) {
       if (200 === o.code) {
        var n = o.data;
        i(n);
        var s = $(window).width(),
         a = t.find(".inside-content"),
         r = t.find("h3"),
         l = s >= 768,
         d = 2 * parseInt(r.first().css("line-height"), 10);
        r.dotdotdot({
         height: d
        }), l ? a.dotdotdot({
         height: 85
        }) : a.dotdotdot({
         height: 65
        }), t.slick({
         dots: !0,
         slidesToShow: 3,
         slidesToScroll: 3,
         centerMode: !0,
         centerPadding: "0px",
         prevArrow: "",
         nextArrow: "",
         responsive: [{
          breakpoint: 768,
          settings: {
           slidesToShow: 1,
           slidesToScroll: 1,
           centerMode: !0,
           centerPadding: "5px",
           dots: !0,
           infinite: !0,
           speed: 300
          }
         }]
        });
        var c = $(".home__hr-insider .slick-dots"),
         u = c.find("li");
        $('<div class="insider-dots"></div>').prependTo(c);
        var p = c.find(".insider-dots");
        u.appendTo(p)
       } else console.log("Code !== 200; Data retrieved:", o), e.hide()
      },
      error: function() {
       e.hide()
      }
     })
    }
   }, {
    key: "initTopJobScrollBar",
    value: function() {
     if (navigator.userAgent.toLowerCase().indexOf("windows") > -1) {
      var e = document.querySelector(".scrollbar");
      e && SimpleScrollbar.initEl(e)
     }
    }
   }, {
    key: "setSearchBoxValues",
    value: function() {
     var e = getCookie("vnwSearchJob[keyword]"),
      t = getCookie("vnwSearchJob[industry]"),
      i = getCookie("vnwSearchJob[city]");
     e || (e = "");
     var o = decodeURIComponent(e).replace(/\+/g, " ");
     t || (t = -1), i || (i = -1), $("#keywordMainSearch").val(o), $("#cateListMainSearch").val(t).change(), $("#locationMainSearch").val(i).change()
    }
   }, {
    key: "setupTopBanner",
    value: function() {
     setTimeout(function() {
      if (!getCookie("doNotShowTopBanner")) {
       $(".js-top-banner").slideDown("fast").find(".close").click(function(e) {
        e.stopPropagation(), setCookie("doNotShowTopBanner", !0, 7), $(this).closest(".js-top-banner").stop().slideUp("fast")
       })
      }
     }, 500)
    }
   }, {
    key: "initFeatures",
    value: function() {
     "B" == HOME_AB_TESTING && this.initLazyLoadTopJobsLogo()
    }
   }, {
    key: "initLazyLoadTopJobsLogo",
    value: function() {
     var e = null;
     $(window).on("scroll.topjobs", function() {
      e && clearTimeout(e), e = setTimeout(function() {
       e = null, $(window).scrollTop() + $(window).height() >= $(".home__jobs-you-will-love").height() && ($(window).off("scroll.topjobs"))
      }, 500)
     })
    }
   }]), e
  }();
 $(function() {
  new r
 }), $(function() {
  function e(e, t) {
   jQuery.cookie(e, t)
  }

  function t(e) {
   return jQuery.cookie(e)
  }

  function i() {
   e("bottomPopupVisibleState", "true")
  }

  function o() {
   e("bottomPopupVisibleState", "false"), e("bottomPopupVisibleCloseTime", u.getTime())
  }

  function n() {
   r.removeClass("out").animate({
    bottom: "-300px"
   }, 200).find(".banner-content a").fadeIn("fast").promise().done(function() {
    l = !1
   }), a.addClass("icon-close-inverse-black").removeClass("icon-expand-inverse-black"), i()
  }

  function s() {
   r.addClass("out").find(".banner-content a").fadeOut("fast").end().animate({
    bottom: "-345px"
   }, 200), a.removeClass("icon-close-inverse-black").addClass("icon-expand-inverse-black"), o()
  }
  var a = $(".move-up-banner .toggle-button"),
   r = $(".move-up-banner"),
   l = !1,
   d = !0,
   c = !0,
   u = new Date;
  c = null !== t("bottomPopupVisibleCloseTime") && u.getTime() - parseInt(t("bottomPopupVisibleCloseTime"), 10) < 6048e5, d = null === t("bottomPopupVisibleState") || (1 != c || "true" == t("bottomPopupVisibleState")), 1 == d ? n() : function() {
   r.addClass("out").find(".banner-content a").hide().end().css({
    bottom: "-345px"
   }), a.removeClass("icon-close-inverse-black").addClass("icon-expand-inverse-black")
  }();
  var p, h, f = !1;
  $(".move-up-banner img").hover(function() {
   0 == f ? p = setTimeout(function() {
    r.stop(!0, !1).animate({
     bottom: 0
    }, "fast"), r.addClass("in"), f = !0
   }, 300) : clearTimeout(h)
  }, function() {
   clearTimeout(p), 1 == f && (h = setTimeout(function() {
    0 == $(".move-up-banner .toggle-button:hover").length && (r.stop(!0, !1).animate({
     bottom: -300
    }, "fast"), r.removeClass("in"), f = !1)
   }, 300))
  }), a.mouseleave(function() {
   r.hasClass("in") && 0 == l && r.removeClass("in").stop(!0, !1).animate({
    bottom: "-300px"
   }, "fast")
  }), a.click(function() {
   l = !0, r.hasClass("out") ? n() : s()
  }), -1 != navigator.appVersion.indexOf("Mac") && $(".move-up-banner").css("right", "20px");
  var g = !!window.opera || navigator.userAgent.indexOf(" OPR/") >= 0;
  !1 == (!!window.chrome && !g) && $("#openChromeExtension").addClass("hidden");
  var v = navigator.platform.match(/(iPhone|iPod|iPad)/i),
   m = navigator.userAgent.match(/Android/i);
  if (v || m) {
   $("#keywordMainSearch").focus(function() {
    $(".vnw-home").find(".vnw_download_app").hide()
   }).focusout(function() {
    $(".vnw-home").find(".vnw_download_app").show()
   });
   (function() {
    var e = !!navigator.cookieEnabled;
    return void 0 !== navigator.cookieEnabled || e || (document.cookie = "testcookie", e = -1 != document.cookie.indexOf("testcookie")), e
   })() ? (null === sessionStorage.getItem("alertDownLoadAppHome") && "false" != sessionStorage.getItem("alertDownLoadAppDetail") && localStorage.setItem("showAlertApp", "true"), "true" === localStorage.getItem("showAlertApp") ? ($(".vnw-home").find(".vnw_download_app").show(), sessionStorage.setItem("alertDownLoadAppHome", "true")) : $(".vnw-home").find(".vnw_download_app").hide()) : $(".vnw-home").find(".vnw_download_app").show(), v ? ($("#shopApp").text("App Store"), $(".install_vwn_app").attr("href", "https://itunes.apple.com/app/apple-store/id1180866051?pt=1608090&ct=vnw_popup&mt=8")) : ($("#shopApp").text("Google Play"), $(".install_vwn_app").attr("href", "https://play.google.com/store/apps/details?id=com.yteviec.yteviec&referrer=utm_source%3Dvnwpopup"))
  } else $(".vnw-home").find(".vnw_download_app").hide();
  $(".install_vwn_app").click(function() {
   v ? customEvent("DlAppAlertIos", "DlAppAlertIosView", null, null) : customEvent("DlAppAlertAndroid", "DlAppAlertAndroidView", null, null)
  }), $(".close_vnw_download_app_alert").click(function() {
   v ? customEvent("DlAppAlertIos", "DlAppAlertIosClose", null, null) : customEvent("DlAppAlertAndroid", "DlAppAlertAndroidClose", null, null), $(".vnw_download_app").remove(), sessionStorage.setItem("alertDownLoadAppHome", "false"), localStorage.setItem("showAlertApp", "false")
  })
 });
 var l = {
  init: function() {
   this.$locationSelect = $(".select-location"), this.getLocation()
  },
  setCookie: function(e, t, i) {
   if (i) {
    var o = new Date;
    o.setTime(o.getTime() + 24 * i * 60 * 60 * 1e3);
    var n = "; expires=" + o.toUTCString()
   } else var n = "";
   document.cookie = e + "=" + t + n + "; path=/"
  },
  getCookie: function(e) {
   for (var t = e + "=", i = document.cookie.split(";"), o = 0; o < i.length; o++) {
    for (var n = i[o];
     " " == n.charAt(0);) n = n.substring(1, n.length);
    if (0 == n.indexOf(t)) return n.substring(t.length, n.length)
   }
   return null
  },
  setup: function() {
   var e = l.getCookie("vnwSearchJob[city]");
   if ("-1" === e || !e) {
    l.getCookie("geoAllowed") || l.init()
   }
  },
  getLocation: function() {
   var e = this,
    t = function(t) {
     e.thisPosition = t;
     var i = t.coords.longitude,
      o = t.coords.latitude;
     e.setCookie("geoAllowed", !0, 7), e.geoCodeLatLong(o, i)
    },
    i = function(t) {
     e.setCookie("geoAllowed", !1, 7)
    };
   ! function() {
    navigator.geolocation ? navigator.geolocation.getCurrentPosition(t, i) : console.log("Geolocation is not supported by this browser.")
   }()
  },
  geoCodeLatLong: function(e, t) {
   var i = this,
    o = new google.maps.Geocoder,
    n = {
     lat: e,
     lng: t
    };
   o.geocode({
    location: n
   }, function(e, t) {
    if ("OK" === t) {
     var o = e[0].address_components.length - 2,
      n = e[0].address_components[o].long_name;
     i.setLocation(n)
    } else console.log("Geocoder failed due to: " + t)
   })
  },
  setLocation: function(e) {
   var t = this,
    i = this.$locationSelect;
   "en" === $("html").attr("lang") && (e = t.convertToASCII(e));
   var o = i.find("option").filter(function() {
    if ($(this).text().trim() === e) return !0
   }).attr("value");
   "Thừa Thiên Huế" !== e && "Thua Thien Hue" !== e || (o = 57), o && (i.select2("val", o), l.setCookie("vnwSearchJob[city]", o, 365))
  },
  convertToASCII: function(e) {
   var t = /[aáàảãạăắằẳẵặâấầẩẫậ]/g,
    i = /[iíìỉĩị]/g,
    o = /[uúùủũụưứừửữự]/g,
    n = /[eéèẻẽẹêếềểễệ]/g,
    s = /[oóòỏõọôốồổỗộơớờởỡợ]/g,
    a = /[Đ]/g;
   return e.replace(t, "a").replace(i, "i").replace(o, "u").replace(n, "e").replace(s, "o").replace(a, "D")
  }
 };
 l.setup
}, function(e, t, i) {
 var o, n, s;
 ! function(a) {
  "use strict";
  n = [i(0)], o = a, void 0 !== (s = "function" == typeof o ? o.apply(t, n) : o) && (e.exports = s)
 }(function(e) {
  "use strict";
  var t = window.Slick || {};
  t = function() {
   function t(t, o) {
    var n, s = this;
    s.defaults = {
     accessibility: !0,
     adaptiveHeight: !1,
     appendArrows: e(t),
     appendDots: e(t),
     arrows: !0,
     asNavFor: null,
     prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
     nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
     autoplay: !1,
     autoplaySpeed: 3e3,
     centerMode: !1,
     centerPadding: "50px",
     cssEase: "ease",
     customPaging: function(t, i) {
      return e('<button type="button" />').text(i + 1)
     },
     dots: !1,
     dotsClass: "slick-dots",
     draggable: !0,
     easing: "linear",
     edgeFriction: .35,
     fade: !1,
     focusOnSelect: !1,
     focusOnChange: !1,
     infinite: !0,
     initialSlide: 0,
     lazyLoad: "ondemand",
     mobileFirst: !1,
     pauseOnHover: !0,
     pauseOnFocus: !0,
     pauseOnDotsHover: !1,
     respondTo: "window",
     responsive: null,
     rows: 1,
     rtl: !1,
     slide: "",
     slidesPerRow: 1,
     slidesToShow: 1,
     slidesToScroll: 1,
     speed: 500,
     swipe: !0,
     swipeToSlide: !1,
     touchMove: !0,
     touchThreshold: 5,
     useCSS: !0,
     useTransform: !0,
     variableWidth: !1,
     vertical: !1,
     verticalSwiping: !1,
     waitForAnimate: !0,
     zIndex: 1e3
    }, s.initials = {
     animating: !1,
     dragging: !1,
     autoPlayTimer: null,
     currentDirection: 0,
     currentLeft: null,
     currentSlide: 0,
     direction: 1,
     $dots: null,
     listWidth: null,
     listHeight: null,
     loadIndex: 0,
     $nextArrow: null,
     $prevArrow: null,
     scrolling: !1,
     slideCount: null,
     slideWidth: null,
     $slideTrack: null,
     $slides: null,
     sliding: !1,
     slideOffset: 0,
     swipeLeft: null,
     swiping: !1,
     $list: null,
     touchObject: {},
     transformsEnabled: !1,
     unslicked: !1
    }, e.extend(s, s.initials), s.activeBreakpoint = null, s.animType = null, s.animProp = null, s.breakpoints = [], s.breakpointSettings = [], s.cssTransitions = !1, s.focussed = !1, s.interrupted = !1, s.hidden = "hidden", s.paused = !0, s.positionProp = null, s.respondTo = null, s.rowCount = 1, s.shouldClick = !0, s.$slider = e(t), s.$slidesCache = null, s.transformType = null, s.transitionType = null, s.visibilityChange = "visibilitychange", s.windowWidth = 0, s.windowTimer = null, n = e(t).data("slick") || {}, s.options = e.extend({}, s.defaults, o, n), s.currentSlide = s.options.initialSlide, s.originalSettings = s.options, void 0 !== document.mozHidden ? (s.hidden = "mozHidden", s.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (s.hidden = "webkitHidden", s.visibilityChange = "webkitvisibilitychange"), s.autoPlay = e.proxy(s.autoPlay, s), s.autoPlayClear = e.proxy(s.autoPlayClear, s), s.autoPlayIterator = e.proxy(s.autoPlayIterator, s), s.changeSlide = e.proxy(s.changeSlide, s), s.clickHandler = e.proxy(s.clickHandler, s), s.selectHandler = e.proxy(s.selectHandler, s), s.setPosition = e.proxy(s.setPosition, s), s.swipeHandler = e.proxy(s.swipeHandler, s), s.dragHandler = e.proxy(s.dragHandler, s), s.keyHandler = e.proxy(s.keyHandler, s), s.instanceUid = i++, s.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, s.registerBreakpoints(), s.init(!0)
   }
   var i = 0;
   return t
  }(), t.prototype.activateADA = function() {
   this.$slideTrack.find(".slick-active").attr({
    "aria-hidden": "false"
   }).find("a, input, button, select").attr({
    tabindex: "0"
   })
  }, t.prototype.addSlide = t.prototype.slickAdd = function(t, i, o) {
   var n = this;
   if ("boolean" == typeof i) o = i, i = null;
   else if (i < 0 || i >= n.slideCount) return !1;
   n.unload(), "number" == typeof i ? 0 === i && 0 === n.$slides.length ? e(t).appendTo(n.$slideTrack) : o ? e(t).insertBefore(n.$slides.eq(i)) : e(t).insertAfter(n.$slides.eq(i)) : !0 === o ? e(t).prependTo(n.$slideTrack) : e(t).appendTo(n.$slideTrack), n.$slides = n.$slideTrack.children(this.options.slide), n.$slideTrack.children(this.options.slide).detach(), n.$slideTrack.append(n.$slides), n.$slides.each(function(t, i) {
    e(i).attr("data-slick-index", t)
   }), n.$slidesCache = n.$slides, n.reinit()
  }, t.prototype.animateHeight = function() {
   var e = this;
   if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
    var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
    e.$list.animate({
     height: t
    }, e.options.speed)
   }
  }, t.prototype.animateSlide = function(t, i) {
   var o = {},
    n = this;
   n.animateHeight(), !0 === n.options.rtl && !1 === n.options.vertical && (t = -t), !1 === n.transformsEnabled ? !1 === n.options.vertical ? n.$slideTrack.animate({
    left: t
   }, n.options.speed, n.options.easing, i) : n.$slideTrack.animate({
    top: t
   }, n.options.speed, n.options.easing, i) : !1 === n.cssTransitions ? (!0 === n.options.rtl && (n.currentLeft = -n.currentLeft), e({
    animStart: n.currentLeft
   }).animate({
    animStart: t
   }, {
    duration: n.options.speed,
    easing: n.options.easing,
    step: function(e) {
     e = Math.ceil(e), !1 === n.options.vertical ? (o[n.animType] = "translate(" + e + "px, 0px)", n.$slideTrack.css(o)) : (o[n.animType] = "translate(0px," + e + "px)", n.$slideTrack.css(o))
    },
    complete: function() {
     i && i.call()
    }
   })) : (n.applyTransition(), t = Math.ceil(t), !1 === n.options.vertical ? o[n.animType] = "translate3d(" + t + "px, 0px, 0px)" : o[n.animType] = "translate3d(0px," + t + "px, 0px)", n.$slideTrack.css(o), i && setTimeout(function() {
    n.disableTransition(), i.call()
   }, n.options.speed))
  }, t.prototype.getNavTarget = function() {
   var t = this,
    i = t.options.asNavFor;
   return i && null !== i && (i = e(i).not(t.$slider)), i
  }, t.prototype.asNavFor = function(t) {
   var i = this,
    o = i.getNavTarget();
   null !== o && "object" == typeof o && o.each(function() {
    var i = e(this).slick("getSlick");
    i.unslicked || i.slideHandler(t, !0)
   })
  }, t.prototype.applyTransition = function(e) {
   var t = this,
    i = {};
   !1 === t.options.fade ? i[t.transitionType] = t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : i[t.transitionType] = "opacity " + t.options.speed + "ms " + t.options.cssEase, !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
  }, t.prototype.autoPlay = function() {
   var e = this;
   e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed))
  }, t.prototype.autoPlayClear = function() {
   var e = this;
   e.autoPlayTimer && clearInterval(e.autoPlayTimer)
  }, t.prototype.autoPlayIterator = function() {
   var e = this,
    t = e.currentSlide + e.options.slidesToScroll;
   e.paused || e.interrupted || e.focussed || (!1 === e.options.infinite && (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? e.direction = 0 : 0 === e.direction && (t = e.currentSlide - e.options.slidesToScroll, e.currentSlide - 1 == 0 && (e.direction = 1))), e.slideHandler(t))
  }, t.prototype.buildArrows = function() {
   var t = this;
   !0 === t.options.arrows && (t.$prevArrow = e(t.options.prevArrow).addClass("slick-arrow"), t.$nextArrow = e(t.options.nextArrow).addClass("slick-arrow"), t.slideCount > t.options.slidesToShow ? (t.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.prependTo(t.options.appendArrows), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.appendTo(t.options.appendArrows), !0 !== t.options.infinite && t.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : t.$prevArrow.add(t.$nextArrow).addClass("slick-hidden").attr({
    "aria-disabled": "true",
    tabindex: "-1"
   }))
  }, t.prototype.buildDots = function() {
   var t, i, o = this;
   if (!0 === o.options.dots && o.slideCount > o.options.slidesToShow) {
    for (o.$slider.addClass("slick-dotted"), i = e("<ul />").addClass(o.options.dotsClass), t = 0; t <= o.getDotCount(); t += 1) i.append(e("<li />").append(o.options.customPaging.call(this, o, t)));
    o.$dots = i.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active")
   }
  }, t.prototype.buildOut = function() {
   var t = this;
   t.$slides = t.$slider.children(t.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), t.slideCount = t.$slides.length, t.$slides.each(function(t, i) {
    e(i).attr("data-slick-index", t).data("originalStyling", e(i).attr("style") || "")
   }), t.$slider.addClass("slick-slider"), t.$slideTrack = 0 === t.slideCount ? e('<div class="slick-track"/>').appendTo(t.$slider) : t.$slides.wrapAll('<div class="slick-track"/>').parent(), t.$list = t.$slideTrack.wrap('<div class="slick-list"/>').parent(), t.$slideTrack.css("opacity", 0), !0 !== t.options.centerMode && !0 !== t.options.swipeToSlide || (t.options.slidesToScroll = 1), e("img[data-lazy]", t.$slider).not("[src]").addClass("slick-loading"), t.setupInfinite(), t.buildArrows(), t.buildDots(), t.updateDots(), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), !0 === t.options.draggable && t.$list.addClass("draggable")
  }, t.prototype.buildRows = function() {
   var e, t, i, o, n, s, a, r = this;
   if (o = document.createDocumentFragment(), s = r.$slider.children(), r.options.rows > 0) {
    for (a = r.options.slidesPerRow * r.options.rows, n = Math.ceil(s.length / a), e = 0; e < n; e++) {
     var l = document.createElement("div");
     for (t = 0; t < r.options.rows; t++) {
      var d = document.createElement("div");
      for (i = 0; i < r.options.slidesPerRow; i++) {
       var c = e * a + (t * r.options.slidesPerRow + i);
       s.get(c) && d.appendChild(s.get(c))
      }
      l.appendChild(d)
     }
     o.appendChild(l)
    }
    r.$slider.empty().append(o), r.$slider.children().children().children().css({
     width: 100 / r.options.slidesPerRow + "%",
     display: "inline-block"
    })
   }
  }, t.prototype.checkResponsive = function(t, i) {
   var o, n, s, a = this,
    r = !1,
    l = a.$slider.width(),
    d = window.innerWidth || e(window).width();
   if ("window" === a.respondTo ? s = d : "slider" === a.respondTo ? s = l : "min" === a.respondTo && (s = Math.min(d, l)), a.options.responsive && a.options.responsive.length && null !== a.options.responsive) {
    n = null;
    for (o in a.breakpoints) a.breakpoints.hasOwnProperty(o) && (!1 === a.originalSettings.mobileFirst ? s < a.breakpoints[o] && (n = a.breakpoints[o]) : s > a.breakpoints[o] && (n = a.breakpoints[o]));
    null !== n ? null !== a.activeBreakpoint ? (n !== a.activeBreakpoint || i) && (a.activeBreakpoint = n, "unslick" === a.breakpointSettings[n] ? a.unslick(n) : (a.options = e.extend({}, a.originalSettings, a.breakpointSettings[n]), !0 === t && (a.currentSlide = a.options.initialSlide), a.refresh(t)), r = n) : (a.activeBreakpoint = n, "unslick" === a.breakpointSettings[n] ? a.unslick(n) : (a.options = e.extend({}, a.originalSettings, a.breakpointSettings[n]), !0 === t && (a.currentSlide = a.options.initialSlide), a.refresh(t)), r = n) : null !== a.activeBreakpoint && (a.activeBreakpoint = null, a.options = a.originalSettings, !0 === t && (a.currentSlide = a.options.initialSlide), a.refresh(t), r = n), t || !1 === r || a.$slider.trigger("breakpoint", [a, r])
   }
  }, t.prototype.changeSlide = function(t, i) {
   var o, n, s, a = this,
    r = e(t.currentTarget);
   switch (r.is("a") && t.preventDefault(), r.is("li") || (r = r.closest("li")), s = a.slideCount % a.options.slidesToScroll != 0, o = s ? 0 : (a.slideCount - a.currentSlide) % a.options.slidesToScroll, t.data.message) {
    case "previous":
     n = 0 === o ? a.options.slidesToScroll : a.options.slidesToShow - o, a.slideCount > a.options.slidesToShow && a.slideHandler(a.currentSlide - n, !1, i);
     break;
    case "next":
     n = 0 === o ? a.options.slidesToScroll : o, a.slideCount > a.options.slidesToShow && a.slideHandler(a.currentSlide + n, !1, i);
     break;
    case "index":
     var l = 0 === t.data.index ? 0 : t.data.index || r.index() * a.options.slidesToScroll;
     a.slideHandler(a.checkNavigable(l), !1, i), r.children().trigger("focus");
     break;
    default:
     return
   }
  }, t.prototype.checkNavigable = function(e) {
   var t, i, o = this;
   if (t = o.getNavigableIndexes(), i = 0, e > t[t.length - 1]) e = t[t.length - 1];
   else
    for (var n in t) {
     if (e < t[n]) {
      e = i;
      break
     }
     i = t[n]
    }
   return e
  }, t.prototype.cleanUpEvents = function() {
   var t = this;
   t.options.dots && null !== t.$dots && (e("li", t.$dots).off("click.slick", t.changeSlide).off("mouseenter.slick", e.proxy(t.interrupt, t, !0)).off("mouseleave.slick", e.proxy(t.interrupt, t, !1)), !0 === t.options.accessibility && t.$dots.off("keydown.slick", t.keyHandler)), t.$slider.off("focus.slick blur.slick"), !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow && t.$prevArrow.off("click.slick", t.changeSlide), t.$nextArrow && t.$nextArrow.off("click.slick", t.changeSlide), !0 === t.options.accessibility && (t.$prevArrow && t.$prevArrow.off("keydown.slick", t.keyHandler), t.$nextArrow && t.$nextArrow.off("keydown.slick", t.keyHandler))), t.$list.off("touchstart.slick mousedown.slick", t.swipeHandler), t.$list.off("touchmove.slick mousemove.slick", t.swipeHandler), t.$list.off("touchend.slick mouseup.slick", t.swipeHandler), t.$list.off("touchcancel.slick mouseleave.slick", t.swipeHandler), t.$list.off("click.slick", t.clickHandler), e(document).off(t.visibilityChange, t.visibility), t.cleanUpSlideEvents(), !0 === t.options.accessibility && t.$list.off("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().off("click.slick", t.selectHandler), e(window).off("orientationchange.slick.slick-" + t.instanceUid, t.orientationChange), e(window).off("resize.slick.slick-" + t.instanceUid, t.resize), e("[draggable!=true]", t.$slideTrack).off("dragstart", t.preventDefault), e(window).off("load.slick.slick-" + t.instanceUid, t.setPosition)
  }, t.prototype.cleanUpSlideEvents = function() {
   var t = this;
   t.$list.off("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.off("mouseleave.slick", e.proxy(t.interrupt, t, !1))
  }, t.prototype.cleanUpRows = function() {
   var e, t = this;
   t.options.rows > 0 && (e = t.$slides.children().children(), e.removeAttr("style"), t.$slider.empty().append(e))
  }, t.prototype.clickHandler = function(e) {
   !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault())
  }, t.prototype.destroy = function(t) {
   var i = this;
   i.autoPlayClear(), i.touchObject = {}, i.cleanUpEvents(), e(".slick-cloned", i.$slider).detach(), i.$dots && i.$dots.remove(), i.$prevArrow && i.$prevArrow.length && (i.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove()), i.$nextArrow && i.$nextArrow.length && (i.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove()), i.$slides && (i.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
    e(this).attr("style", e(this).data("originalStyling"))
   }), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.detach(), i.$list.detach(), i.$slider.append(i.$slides)), i.cleanUpRows(), i.$slider.removeClass("slick-slider"), i.$slider.removeClass("slick-initialized"), i.$slider.removeClass("slick-dotted"), i.unslicked = !0, t || i.$slider.trigger("destroy", [i])
  }, t.prototype.disableTransition = function(e) {
   var t = this,
    i = {};
   i[t.transitionType] = "", !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
  }, t.prototype.fadeSlide = function(e, t) {
   var i = this;
   !1 === i.cssTransitions ? (i.$slides.eq(e).css({
    zIndex: i.options.zIndex
   }), i.$slides.eq(e).animate({
    opacity: 1
   }, i.options.speed, i.options.easing, t)) : (i.applyTransition(e), i.$slides.eq(e).css({
    opacity: 1,
    zIndex: i.options.zIndex
   }), t && setTimeout(function() {
    i.disableTransition(e), t.call()
   }, i.options.speed))
  }, t.prototype.fadeSlideOut = function(e) {
   var t = this;
   !1 === t.cssTransitions ? t.$slides.eq(e).animate({
    opacity: 0,
    zIndex: t.options.zIndex - 2
   }, t.options.speed, t.options.easing) : (t.applyTransition(e), t.$slides.eq(e).css({
    opacity: 0,
    zIndex: t.options.zIndex - 2
   }))
  }, t.prototype.filterSlides = t.prototype.slickFilter = function(e) {
   var t = this;
   null !== e && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(e).appendTo(t.$slideTrack), t.reinit())
  }, t.prototype.focusHandler = function() {
   var t = this;
   t.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function(i) {
    i.stopImmediatePropagation();
    var o = e(this);
    setTimeout(function() {
     t.options.pauseOnFocus && (t.focussed = o.is(":focus"), t.autoPlay())
    }, 0)
   })
  }, t.prototype.getCurrent = t.prototype.slickCurrentSlide = function() {
   return this.currentSlide
  }, t.prototype.getDotCount = function() {
   var e = this,
    t = 0,
    i = 0,
    o = 0;
   if (!0 === e.options.infinite)
    if (e.slideCount <= e.options.slidesToShow) ++o;
    else
     for (; t < e.slideCount;) ++o, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
   else if (!0 === e.options.centerMode) o = e.slideCount;
   else if (e.options.asNavFor)
    for (; t < e.slideCount;) ++o, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
   else o = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
   return o - 1
  }, t.prototype.getLeft = function(e) {
   var t, i, o, n, s = this,
    a = 0;
   return s.slideOffset = 0, i = s.$slides.first().outerHeight(!0), !0 === s.options.infinite ? (s.slideCount > s.options.slidesToShow && (s.slideOffset = s.slideWidth * s.options.slidesToShow * -1, n = -1, !0 === s.options.vertical && !0 === s.options.centerMode && (2 === s.options.slidesToShow ? n = -1.5 : 1 === s.options.slidesToShow && (n = -2)), a = i * s.options.slidesToShow * n), s.slideCount % s.options.slidesToScroll != 0 && e + s.options.slidesToScroll > s.slideCount && s.slideCount > s.options.slidesToShow && (e > s.slideCount ? (s.slideOffset = (s.options.slidesToShow - (e - s.slideCount)) * s.slideWidth * -1, a = (s.options.slidesToShow - (e - s.slideCount)) * i * -1) : (s.slideOffset = s.slideCount % s.options.slidesToScroll * s.slideWidth * -1, a = s.slideCount % s.options.slidesToScroll * i * -1))) : e + s.options.slidesToShow > s.slideCount && (s.slideOffset = (e + s.options.slidesToShow - s.slideCount) * s.slideWidth, a = (e + s.options.slidesToShow - s.slideCount) * i), s.slideCount <= s.options.slidesToShow && (s.slideOffset = 0, a = 0), !0 === s.options.centerMode && s.slideCount <= s.options.slidesToShow ? s.slideOffset = s.slideWidth * Math.floor(s.options.slidesToShow) / 2 - s.slideWidth * s.slideCount / 2 : !0 === s.options.centerMode && !0 === s.options.infinite ? s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2) - s.slideWidth : !0 === s.options.centerMode && (s.slideOffset = 0, s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2)), t = !1 === s.options.vertical ? e * s.slideWidth * -1 + s.slideOffset : e * i * -1 + a, !0 === s.options.variableWidth && (o = s.slideCount <= s.options.slidesToShow || !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(e) : s.$slideTrack.children(".slick-slide").eq(e + s.options.slidesToShow), t = !0 === s.options.rtl ? o[0] ? -1 * (s.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === s.options.centerMode && (o = s.slideCount <= s.options.slidesToShow || !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(e) : s.$slideTrack.children(".slick-slide").eq(e + s.options.slidesToShow + 1), t = !0 === s.options.rtl ? o[0] ? -1 * (s.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, t += (s.$list.width() - o.outerWidth()) / 2)), t
  }, t.prototype.getOption = t.prototype.slickGetOption = function(e) {
   return this.options[e]
  }, t.prototype.getNavigableIndexes = function() {
   var e, t = this,
    i = 0,
    o = 0,
    n = [];
   for (!1 === t.options.infinite ? e = t.slideCount : (i = -1 * t.options.slidesToScroll, o = -1 * t.options.slidesToScroll, e = 2 * t.slideCount); i < e;) n.push(i), i = o + t.options.slidesToScroll, o += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
   return n
  }, t.prototype.getSlick = function() {
   return this
  }, t.prototype.getSlideCount = function() {
   var t, i, o = this;
   return i = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function(n, s) {
    if (s.offsetLeft - i + e(s).outerWidth() / 2 > -1 * o.swipeLeft) return t = s, !1
   }), Math.abs(e(t).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
  }, t.prototype.goTo = t.prototype.slickGoTo = function(e, t) {
   this.changeSlide({
    data: {
     message: "index",
     index: parseInt(e)
    }
   }, t)
  }, t.prototype.init = function(t) {
   var i = this;
   e(i.$slider).hasClass("slick-initialized") || (e(i.$slider).addClass("slick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots(), i.checkResponsive(!0), i.focusHandler()), t && i.$slider.trigger("init", [i]), !0 === i.options.accessibility && i.initADA(), i.options.autoplay && (i.paused = !1, i.autoPlay())
  }, t.prototype.initADA = function() {
   var t = this,
    i = Math.ceil(t.slideCount / t.options.slidesToShow),
    o = t.getNavigableIndexes().filter(function(e) {
     return e >= 0 && e < t.slideCount
    });
   t.$slides.add(t.$slideTrack.find(".slick-cloned")).attr({
    "aria-hidden": "true",
    tabindex: "-1"
   }).find("a, input, button, select").attr({
    tabindex: "-1"
   }), null !== t.$dots && (t.$slides.not(t.$slideTrack.find(".slick-cloned")).each(function(i) {
    var n = o.indexOf(i);
    if (e(this).attr({
      role: "tabpanel",
      id: "slick-slide" + t.instanceUid + i,
      tabindex: -1
     }), -1 !== n) {
     var s = "slick-slide-control" + t.instanceUid + n;
     e("#" + s).length && e(this).attr({
      "aria-describedby": s
     })
    }
   }), t.$dots.attr("role", "tablist").find("li").each(function(n) {
    var s = o[n];
    e(this).attr({
     role: "presentation"
    }), e(this).find("button").first().attr({
     role: "tab",
     id: "slick-slide-control" + t.instanceUid + n,
     "aria-controls": "slick-slide" + t.instanceUid + s,
     "aria-label": n + 1 + " of " + i,
     "aria-selected": null,
     tabindex: "-1"
    })
   }).eq(t.currentSlide).find("button").attr({
    "aria-selected": "true",
    tabindex: "0"
   }).end());
   for (var n = t.currentSlide, s = n + t.options.slidesToShow; n < s; n++) t.options.focusOnChange ? t.$slides.eq(n).attr({
    tabindex: "0"
   }) : t.$slides.eq(n).removeAttr("tabindex");
   t.activateADA()
  }, t.prototype.initArrowEvents = function() {
   var e = this;
   !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.off("click.slick").on("click.slick", {
    message: "previous"
   }, e.changeSlide), e.$nextArrow.off("click.slick").on("click.slick", {
    message: "next"
   }, e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow.on("keydown.slick", e.keyHandler), e.$nextArrow.on("keydown.slick", e.keyHandler)))
  }, t.prototype.initDotEvents = function() {
   var t = this;
   !0 === t.options.dots && t.slideCount > t.options.slidesToShow && (e("li", t.$dots).on("click.slick", {
    message: "index"
   }, t.changeSlide), !0 === t.options.accessibility && t.$dots.on("keydown.slick", t.keyHandler)), !0 === t.options.dots && !0 === t.options.pauseOnDotsHover && t.slideCount > t.options.slidesToShow && e("li", t.$dots).on("mouseenter.slick", e.proxy(t.interrupt, t, !0)).on("mouseleave.slick", e.proxy(t.interrupt, t, !1))
  }, t.prototype.initSlideEvents = function() {
   var t = this;
   t.options.pauseOnHover && (t.$list.on("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.on("mouseleave.slick", e.proxy(t.interrupt, t, !1)))
  }, t.prototype.initializeEvents = function() {
   var t = this;
   t.initArrowEvents(), t.initDotEvents(), t.initSlideEvents(), t.$list.on("touchstart.slick mousedown.slick", {
    action: "start"
   }, t.swipeHandler), t.$list.on("touchmove.slick mousemove.slick", {
    action: "move"
   }, t.swipeHandler), t.$list.on("touchend.slick mouseup.slick", {
    action: "end"
   }, t.swipeHandler), t.$list.on("touchcancel.slick mouseleave.slick", {
    action: "end"
   }, t.swipeHandler), t.$list.on("click.slick", t.clickHandler), e(document).on(t.visibilityChange, e.proxy(t.visibility, t)), !0 === t.options.accessibility && t.$list.on("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), e(window).on("orientationchange.slick.slick-" + t.instanceUid, e.proxy(t.orientationChange, t)), e(window).on("resize.slick.slick-" + t.instanceUid, e.proxy(t.resize, t)), e("[draggable!=true]", t.$slideTrack).on("dragstart", t.preventDefault), e(window).on("load.slick.slick-" + t.instanceUid, t.setPosition), e(t.setPosition)
  }, t.prototype.initUI = function() {
   var e = this;
   !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show()
  }, t.prototype.keyHandler = function(e) {
   var t = this;
   e.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === e.keyCode && !0 === t.options.accessibility ? t.changeSlide({
    data: {
     message: !0 === t.options.rtl ? "next" : "previous"
    }
   }) : 39 === e.keyCode && !0 === t.options.accessibility && t.changeSlide({
    data: {
     message: !0 === t.options.rtl ? "previous" : "next"
    }
   }))
  }, t.prototype.lazyLoad = function() {
   function t(t) {
    e("img[data-lazy]", t).each(function() {
     var t = e(this),
      i = e(this).attr("data-lazy"),
      o = e(this).attr("data-srcset"),
      n = e(this).attr("data-sizes") || a.$slider.attr("data-sizes"),
      s = document.createElement("img");
     s.onload = function() {
      t.animate({
       opacity: 0
      }, 100, function() {
       o && (t.attr("srcset", o), n && t.attr("sizes", n)), t.attr("src", i).animate({
        opacity: 1
       }, 200, function() {
        t.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
       }), a.$slider.trigger("lazyLoaded", [a, t, i])
      })
     }, s.onerror = function() {
      t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), a.$slider.trigger("lazyLoadError", [a, t, i])
     }, s.src = i
    })
   }
   var i, o, n, s, a = this;
   if (!0 === a.options.centerMode ? !0 === a.options.infinite ? (n = a.currentSlide + (a.options.slidesToShow / 2 + 1), s = n + a.options.slidesToShow + 2) : (n = Math.max(0, a.currentSlide - (a.options.slidesToShow / 2 + 1)), s = a.options.slidesToShow / 2 + 1 + 2 + a.currentSlide) : (n = a.options.infinite ? a.options.slidesToShow + a.currentSlide : a.currentSlide, s = Math.ceil(n + a.options.slidesToShow), !0 === a.options.fade && (n > 0 && n--, s <= a.slideCount && s++)), i = a.$slider.find(".slick-slide").slice(n, s), "anticipated" === a.options.lazyLoad)
    for (var r = n - 1, l = s, d = a.$slider.find(".slick-slide"), c = 0; c < a.options.slidesToScroll; c++) r < 0 && (r = a.slideCount - 1), i = i.add(d.eq(r)), i = i.add(d.eq(l)), r--, l++;
   t(i), a.slideCount <= a.options.slidesToShow ? (o = a.$slider.find(".slick-slide"), t(o)) : a.currentSlide >= a.slideCount - a.options.slidesToShow ? (o = a.$slider.find(".slick-cloned").slice(0, a.options.slidesToShow), t(o)) : 0 === a.currentSlide && (o = a.$slider.find(".slick-cloned").slice(-1 * a.options.slidesToShow), t(o))
  }, t.prototype.loadSlider = function() {
   var e = this;
   e.setPosition(), e.$slideTrack.css({
    opacity: 1
   }), e.$slider.removeClass("slick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad()
  }, t.prototype.next = t.prototype.slickNext = function() {
   this.changeSlide({
    data: {
     message: "next"
    }
   })
  }, t.prototype.orientationChange = function() {
   var e = this;
   e.checkResponsive(), e.setPosition()
  }, t.prototype.pause = t.prototype.slickPause = function() {
   var e = this;
   e.autoPlayClear(), e.paused = !0
  }, t.prototype.play = t.prototype.slickPlay = function() {
   var e = this;
   e.autoPlay(), e.options.autoplay = !0, e.paused = !1, e.focussed = !1, e.interrupted = !1
  }, t.prototype.postSlide = function(t) {
   var i = this;
   if (!i.unslicked && (i.$slider.trigger("afterChange", [i, t]), i.animating = !1, i.slideCount > i.options.slidesToShow && i.setPosition(), i.swipeLeft = null, i.options.autoplay && i.autoPlay(), !0 === i.options.accessibility && (i.initADA(), i.options.focusOnChange))) {
    e(i.$slides.get(i.currentSlide)).attr("tabindex", 0).focus()
   }
  }, t.prototype.prev = t.prototype.slickPrev = function() {
   this.changeSlide({
    data: {
     message: "previous"
    }
   })
  }, t.prototype.preventDefault = function(e) {
   e.preventDefault()
  }, t.prototype.progressiveLazyLoad = function(t) {
   t = t || 1;
   var i, o, n, s, a, r = this,
    l = e("img[data-lazy]", r.$slider);
   l.length ? (i = l.first(), o = i.attr("data-lazy"), n = i.attr("data-srcset"), s = i.attr("data-sizes") || r.$slider.attr("data-sizes"), a = document.createElement("img"), a.onload = function() {
    n && (i.attr("srcset", n), s && i.attr("sizes", s)), i.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === r.options.adaptiveHeight && r.setPosition(), r.$slider.trigger("lazyLoaded", [r, i, o]), r.progressiveLazyLoad()
   }, a.onerror = function() {
    t < 3 ? setTimeout(function() {
     r.progressiveLazyLoad(t + 1)
    }, 500) : (i.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), r.$slider.trigger("lazyLoadError", [r, i, o]), r.progressiveLazyLoad())
   }, a.src = o) : r.$slider.trigger("allImagesLoaded", [r])
  }, t.prototype.refresh = function(t) {
   var i, o, n = this;
   o = n.slideCount - n.options.slidesToShow, !n.options.infinite && n.currentSlide > o && (n.currentSlide = o), n.slideCount <= n.options.slidesToShow && (n.currentSlide = 0), i = n.currentSlide, n.destroy(!0), e.extend(n, n.initials, {
    currentSlide: i
   }), n.init(), t || n.changeSlide({
    data: {
     message: "index",
     index: i
    }
   }, !1)
  }, t.prototype.registerBreakpoints = function() {
   var t, i, o, n = this,
    s = n.options.responsive || null;
   if ("array" === e.type(s) && s.length) {
    n.respondTo = n.options.respondTo || "window";
    for (t in s)
     if (o = n.breakpoints.length - 1, s.hasOwnProperty(t)) {
      for (i = s[t].breakpoint; o >= 0;) n.breakpoints[o] && n.breakpoints[o] === i && n.breakpoints.splice(o, 1), o--;
      n.breakpoints.push(i), n.breakpointSettings[i] = s[t].settings
     }
    n.breakpoints.sort(function(e, t) {
     return n.options.mobileFirst ? e - t : t - e
    })
   }
  }, t.prototype.reinit = function() {
   var t = this;
   t.$slides = t.$slideTrack.children(t.options.slide).addClass("slick-slide"), t.slideCount = t.$slides.length, t.currentSlide >= t.slideCount && 0 !== t.currentSlide && (t.currentSlide = t.currentSlide - t.options.slidesToScroll), t.slideCount <= t.options.slidesToShow && (t.currentSlide = 0), t.registerBreakpoints(), t.setProps(), t.setupInfinite(), t.buildArrows(), t.updateArrows(), t.initArrowEvents(), t.buildDots(), t.updateDots(), t.initDotEvents(), t.cleanUpSlideEvents(), t.initSlideEvents(), t.checkResponsive(!1, !0), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), t.setPosition(), t.focusHandler(), t.paused = !t.options.autoplay, t.autoPlay(), t.$slider.trigger("reInit", [t])
  }, t.prototype.resize = function() {
   var t = this;
   e(window).width() !== t.windowWidth && (clearTimeout(t.windowDelay), t.windowDelay = window.setTimeout(function() {
    t.windowWidth = e(window).width(), t.checkResponsive(), t.unslicked || t.setPosition()
   }, 50))
  }, t.prototype.removeSlide = t.prototype.slickRemove = function(e, t, i) {
   var o = this;
   if ("boolean" == typeof e ? (t = e, e = !0 === t ? 0 : o.slideCount - 1) : e = !0 === t ? --e : e, o.slideCount < 1 || e < 0 || e > o.slideCount - 1) return !1;
   o.unload(), !0 === i ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(e).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit()
  }, t.prototype.setCSS = function(e) {
   var t, i, o = this,
    n = {};
   !0 === o.options.rtl && (e = -e), t = "left" == o.positionProp ? Math.ceil(e) + "px" : "0px", i = "top" == o.positionProp ? Math.ceil(e) + "px" : "0px", n[o.positionProp] = e, !1 === o.transformsEnabled ? o.$slideTrack.css(n) : (n = {}, !1 === o.cssTransitions ? (n[o.animType] = "translate(" + t + ", " + i + ")", o.$slideTrack.css(n)) : (n[o.animType] = "translate3d(" + t + ", " + i + ", 0px)", o.$slideTrack.css(n)))
  }, t.prototype.setDimensions = function() {
   var e = this;
   !1 === e.options.vertical ? !0 === e.options.centerMode && e.$list.css({
    padding: "0px " + e.options.centerPadding
   }) : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({
    padding: e.options.centerPadding + " 0px"
   })), e.listWidth = e.$list.width(), e.listHeight = e.$list.height(), !1 === e.options.vertical && !1 === e.options.variableWidth ? (e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".slick-slide").length))) : !0 === e.options.variableWidth ? e.$slideTrack.width(5e3 * e.slideCount) : (e.slideWidth = Math.ceil(e.listWidth), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".slick-slide").length)));
   var t = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
   !1 === e.options.variableWidth && e.$slideTrack.children(".slick-slide").width(e.slideWidth - t)
  }, t.prototype.setFade = function() {
   var t, i = this;
   i.$slides.each(function(o, n) {
    t = i.slideWidth * o * -1, !0 === i.options.rtl ? e(n).css({
     position: "relative",
     right: t,
     top: 0,
     zIndex: i.options.zIndex - 2,
     opacity: 0
    }) : e(n).css({
     position: "relative",
     left: t,
     top: 0,
     zIndex: i.options.zIndex - 2,
     opacity: 0
    })
   }), i.$slides.eq(i.currentSlide).css({
    zIndex: i.options.zIndex - 1,
    opacity: 1
   })
  }, t.prototype.setHeight = function() {
   var e = this;
   if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
    var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
    e.$list.css("height", t)
   }
  }, t.prototype.setOption = t.prototype.slickSetOption = function() {
   var t, i, o, n, s, a = this,
    r = !1;
   if ("object" === e.type(arguments[0]) ? (o = arguments[0], r = arguments[1], s = "multiple") : "string" === e.type(arguments[0]) && (o = arguments[0], n = arguments[1], r = arguments[2], "responsive" === arguments[0] && "array" === e.type(arguments[1]) ? s = "responsive" : void 0 !== arguments[1] && (s = "single")), "single" === s) a.options[o] = n;
   else if ("multiple" === s) e.each(o, function(e, t) {
    a.options[e] = t
   });
   else if ("responsive" === s)
    for (i in n)
     if ("array" !== e.type(a.options.responsive)) a.options.responsive = [n[i]];
     else {
      for (t = a.options.responsive.length - 1; t >= 0;) a.options.responsive[t].breakpoint === n[i].breakpoint && a.options.responsive.splice(t, 1), t--;
      a.options.responsive.push(n[i])
     }
   r && (a.unload(), a.reinit())
  }, t.prototype.setPosition = function() {
   var e = this;
   e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e])
  }, t.prototype.setProps = function() {
   var e = this,
    t = document.body.style;
   e.positionProp = !0 === e.options.vertical ? "top" : "left", "top" === e.positionProp ? e.$slider.addClass("slick-vertical") : e.$slider.removeClass("slick-vertical"), void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === e.options.useCSS && (e.cssTransitions = !0), e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : e.options.zIndex = e.defaults.zIndex), void 0 !== t.OTransform && (e.animType = "OTransform", e.transformType = "-o-transform", e.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.MozTransform && (e.animType = "MozTransform", e.transformType = "-moz-transform", e.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (e.animType = !1)), void 0 !== t.webkitTransform && (e.animType = "webkitTransform", e.transformType = "-webkit-transform", e.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.msTransform && (e.animType = "msTransform", e.transformType = "-ms-transform", e.transitionType = "msTransition", void 0 === t.msTransform && (e.animType = !1)), void 0 !== t.transform && !1 !== e.animType && (e.animType = "transform", e.transformType = "transform", e.transitionType = "transition"), e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType
  }, t.prototype.setSlideClasses = function(e) {
   var t, i, o, n, s = this;
   if (i = s.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), s.$slides.eq(e).addClass("slick-current"), !0 === s.options.centerMode) {
    var a = s.options.slidesToShow % 2 == 0 ? 1 : 0;
    t = Math.floor(s.options.slidesToShow / 2), !0 === s.options.infinite && (e >= t && e <= s.slideCount - 1 - t ? s.$slides.slice(e - t + a, e + t + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = s.options.slidesToShow + e, i.slice(o - t + 1 + a, o + t + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === e ? i.eq(i.length - 1 - s.options.slidesToShow).addClass("slick-center") : e === s.slideCount - 1 && i.eq(s.options.slidesToShow).addClass("slick-center")), s.$slides.eq(e).addClass("slick-center")
   } else e >= 0 && e <= s.slideCount - s.options.slidesToShow ? s.$slides.slice(e, e + s.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= s.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (n = s.slideCount % s.options.slidesToShow, o = !0 === s.options.infinite ? s.options.slidesToShow + e : e, s.options.slidesToShow == s.options.slidesToScroll && s.slideCount - e < s.options.slidesToShow ? i.slice(o - (s.options.slidesToShow - n), o + n).addClass("slick-active").attr("aria-hidden", "false") : i.slice(o, o + s.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
   "ondemand" !== s.options.lazyLoad && "anticipated" !== s.options.lazyLoad || s.lazyLoad()
  }, t.prototype.setupInfinite = function() {
   var t, i, o, n = this;
   if (!0 === n.options.fade && (n.options.centerMode = !1), !0 === n.options.infinite && !1 === n.options.fade && (i = null, n.slideCount > n.options.slidesToShow)) {
    for (o = !0 === n.options.centerMode ? n.options.slidesToShow + 1 : n.options.slidesToShow, t = n.slideCount; t > n.slideCount - o; t -= 1) i = t - 1, e(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i - n.slideCount).prependTo(n.$slideTrack).addClass("slick-cloned");
    for (t = 0; t < o + n.slideCount; t += 1) i = t, e(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i + n.slideCount).appendTo(n.$slideTrack).addClass("slick-cloned");
    n.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
     e(this).attr("id", "")
    })
   }
  }, t.prototype.interrupt = function(e) {
   var t = this;
   e || t.autoPlay(), t.interrupted = e
  }, t.prototype.selectHandler = function(t) {
   var i = this,
    o = e(t.target).is(".slick-slide") ? e(t.target) : e(t.target).parents(".slick-slide"),
    n = parseInt(o.attr("data-slick-index"));
   if (n || (n = 0), i.slideCount <= i.options.slidesToShow) return void i.slideHandler(n, !1, !0);
   i.slideHandler(n)
  }, t.prototype.slideHandler = function(e, t, i) {
   var o, n, s, a, r, l = null,
    d = this;
   if (t = t || !1, !(!0 === d.animating && !0 === d.options.waitForAnimate || !0 === d.options.fade && d.currentSlide === e)) {
    if (!1 === t && d.asNavFor(e), o = e, l = d.getLeft(o), a = d.getLeft(d.currentSlide), d.currentLeft = null === d.swipeLeft ? a : d.swipeLeft, !1 === d.options.infinite && !1 === d.options.centerMode && (e < 0 || e > d.getDotCount() * d.options.slidesToScroll)) return void(!1 === d.options.fade && (o = d.currentSlide, !0 !== i && d.slideCount > d.options.slidesToShow ? d.animateSlide(a, function() {
     d.postSlide(o)
    }) : d.postSlide(o)));
    if (!1 === d.options.infinite && !0 === d.options.centerMode && (e < 0 || e > d.slideCount - d.options.slidesToScroll)) return void(!1 === d.options.fade && (o = d.currentSlide, !0 !== i && d.slideCount > d.options.slidesToShow ? d.animateSlide(a, function() {
     d.postSlide(o)
    }) : d.postSlide(o)));
    if (d.options.autoplay && clearInterval(d.autoPlayTimer), n = o < 0 ? d.slideCount % d.options.slidesToScroll != 0 ? d.slideCount - d.slideCount % d.options.slidesToScroll : d.slideCount + o : o >= d.slideCount ? d.slideCount % d.options.slidesToScroll != 0 ? 0 : o - d.slideCount : o, d.animating = !0, d.$slider.trigger("beforeChange", [d, d.currentSlide, n]), s = d.currentSlide, d.currentSlide = n, d.setSlideClasses(d.currentSlide), d.options.asNavFor && (r = d.getNavTarget(), r = r.slick("getSlick"), r.slideCount <= r.options.slidesToShow && r.setSlideClasses(d.currentSlide)), d.updateDots(), d.updateArrows(), !0 === d.options.fade) return !0 !== i ? (d.fadeSlideOut(s), d.fadeSlide(n, function() {
     d.postSlide(n)
    })) : d.postSlide(n), void d.animateHeight();
    !0 !== i && d.slideCount > d.options.slidesToShow ? d.animateSlide(l, function() {
     d.postSlide(n)
    }) : d.postSlide(n)
   }
  }, t.prototype.startLoad = function() {
   var e = this;
   !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(), e.$slider.addClass("slick-loading")
  }, t.prototype.swipeDirection = function() {
   var e, t, i, o, n = this;
   return e = n.touchObject.startX - n.touchObject.curX, t = n.touchObject.startY - n.touchObject.curY, i = Math.atan2(t, e), o = Math.round(180 * i / Math.PI), o < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === n.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === n.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === n.options.rtl ? "right" : "left" : !0 === n.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical"
  }, t.prototype.swipeEnd = function(e) {
   var t, i, o = this;
   if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
   if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;
   if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
    switch (i = o.swipeDirection()) {
     case "left":
     case "down":
      t = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
      break;
     case "right":
     case "up":
      t = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1
    }
    "vertical" != i && (o.slideHandler(t), o.touchObject = {}, o.$slider.trigger("swipe", [o, i]))
   } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {})
  }, t.prototype.swipeHandler = function(e) {
   var t = this;
   if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== e.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), e.data.action) {
    case "start":
     t.swipeStart(e);
     break;
    case "move":
     t.swipeMove(e);
     break;
    case "end":
     t.swipeEnd(e)
   }
  }, t.prototype.swipeMove = function(e) {
   var t, i, o, n, s, a, r = this;
   return s = void 0 !== e.originalEvent ? e.originalEvent.touches : null, !(!r.dragging || r.scrolling || s && 1 !== s.length) && (t = r.getLeft(r.currentSlide), r.touchObject.curX = void 0 !== s ? s[0].pageX : e.clientX, r.touchObject.curY = void 0 !== s ? s[0].pageY : e.clientY, r.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(r.touchObject.curX - r.touchObject.startX, 2))), a = Math.round(Math.sqrt(Math.pow(r.touchObject.curY - r.touchObject.startY, 2))), !r.options.verticalSwiping && !r.swiping && a > 4 ? (r.scrolling = !0, !1) : (!0 === r.options.verticalSwiping && (r.touchObject.swipeLength = a), i = r.swipeDirection(), void 0 !== e.originalEvent && r.touchObject.swipeLength > 4 && (r.swiping = !0, e.preventDefault()), n = (!1 === r.options.rtl ? 1 : -1) * (r.touchObject.curX > r.touchObject.startX ? 1 : -1), !0 === r.options.verticalSwiping && (n = r.touchObject.curY > r.touchObject.startY ? 1 : -1), o = r.touchObject.swipeLength, r.touchObject.edgeHit = !1, !1 === r.options.infinite && (0 === r.currentSlide && "right" === i || r.currentSlide >= r.getDotCount() && "left" === i) && (o = r.touchObject.swipeLength * r.options.edgeFriction, r.touchObject.edgeHit = !0), !1 === r.options.vertical ? r.swipeLeft = t + o * n : r.swipeLeft = t + o * (r.$list.height() / r.listWidth) * n, !0 === r.options.verticalSwiping && (r.swipeLeft = t + o * n), !0 !== r.options.fade && !1 !== r.options.touchMove && (!0 === r.animating ? (r.swipeLeft = null, !1) : void r.setCSS(r.swipeLeft))))
  }, t.prototype.swipeStart = function(e) {
   var t, i = this;
   if (i.interrupted = !0, 1 !== i.touchObject.fingerCount || i.slideCount <= i.options.slidesToShow) return i.touchObject = {}, !1;
   void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (t = e.originalEvent.touches[0]), i.touchObject.startX = i.touchObject.curX = void 0 !== t ? t.pageX : e.clientX, i.touchObject.startY = i.touchObject.curY = void 0 !== t ? t.pageY : e.clientY, i.dragging = !0
  }, t.prototype.unfilterSlides = t.prototype.slickUnfilter = function() {
   var e = this;
   null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit())
  }, t.prototype.unload = function() {
   var t = this;
   e(".slick-cloned", t.$slider).remove(), t.$dots && t.$dots.remove(), t.$prevArrow && t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove(), t.$nextArrow && t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove(), t.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
  }, t.prototype.unslick = function(e) {
   var t = this;
   t.$slider.trigger("unslick", [t, e]), t.destroy()
  }, t.prototype.updateArrows = function() {
   var e = this;
   Math.floor(e.options.slidesToShow / 2), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && !e.options.infinite && (e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === e.currentSlide ? (e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode ? (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode && (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
  }, t.prototype.updateDots = function() {
   var e = this;
   null !== e.$dots && (e.$dots.find("li").removeClass("slick-active").end(), e.$dots.find("li").eq(Math.floor(e.currentSlide / e.options.slidesToScroll)).addClass("slick-active"))
  }, t.prototype.visibility = function() {
   var e = this;
   e.options.autoplay && (document[e.hidden] ? e.interrupted = !0 : e.interrupted = !1)
  }, e.fn.slick = function() {
   var e, i, o = this,
    n = arguments[0],
    s = Array.prototype.slice.call(arguments, 1),
    a = o.length;
   for (e = 0; e < a; e++)
    if ("object" == typeof n || void 0 === n ? o[e].slick = new t(o[e], n) : i = o[e].slick[n].apply(o[e].slick, s), void 0 !== i) return i;
   return o
  }
 })
}, function(e, t, i) {
 var o, n, s;
 ! function(a) {
  "use strict";
  n = [i(0)], o = a, void 0 !== (s = "function" == typeof o ? o.apply(t, n) : o) && (e.exports = s)
 }(function(e) {
  var t = -1,
   i = -1,
   o = function(e) {
    return parseFloat(e) || 0
   },
   n = function(t) {
    var i = e(t),
     n = null,
     s = [];
    return i.each(function() {
     var t = e(this),
      i = t.offset().top - o(t.css("margin-top")),
      a = s.length > 0 ? s[s.length - 1] : null;
     null === a ? s.push(t) : Math.floor(Math.abs(n - i)) <= 1 ? s[s.length - 1] = a.add(t) : s.push(t), n = i
    }), s
   },
   s = function(t) {
    var i = {
     byRow: !0,
     property: "height",
     target: null,
     remove: !1
    };
    return "object" == typeof t ? e.extend(i, t) : ("boolean" == typeof t ? i.byRow = t : "remove" === t && (i.remove = !0), i)
   },
   a = e.fn.matchHeight = function(t) {
    var i = s(t);
    if (i.remove) {
     var o = this;
     return this.css(i.property, ""), e.each(a._groups, function(e, t) {
      t.elements = t.elements.not(o)
     }), this
    }
    return this.length <= 1 && !i.target ? this : (a._groups.push({
     elements: this,
     options: i
    }), a._apply(this, i), this)
   };
  a.version = "master", a._groups = [], a._throttle = 80, a._maintainScroll = !1, a._beforeUpdate = null, a._afterUpdate = null, a._rows = n, a._parse = o, a._parseOptions = s, a._apply = function(t, i) {
   var r = s(i),
    l = e(t),
    d = [l],
    c = e(window).scrollTop(),
    u = e("html").outerHeight(!0),
    p = l.parents().filter(":hidden");
   return p.each(function() {
    var t = e(this);
    t.data("style-cache", t.attr("style"))
   }), p.css("display", "block"), r.byRow && !r.target && (l.each(function() {
    var t = e(this),
     i = t.css("display");
    "inline-block" !== i && "flex" !== i && "inline-flex" !== i && (i = "block"), t.data("style-cache", t.attr("style")), t.css({
     display: i,
     "padding-top": "0",
     "padding-bottom": "0",
     "margin-top": "0",
     "margin-bottom": "0",
     "border-top-width": "0",
     "border-bottom-width": "0",
     height: "100px",
     overflow: "hidden"
    })
   }), d = n(l), l.each(function() {
    var t = e(this);
    t.attr("style", t.data("style-cache") || "")
   })), e.each(d, function(t, i) {
    var n = e(i),
     s = 0;
    if (r.target) s = r.target.outerHeight(!1);
    else {
     if (r.byRow && n.length <= 1) return void n.css(r.property, "");
     n.each(function() {
      var t = e(this),
       i = t.attr("style"),
       o = t.css("display");
      "inline-block" !== o && "flex" !== o && "inline-flex" !== o && (o = "block");
      var n = {
       display: o
      };
      n[r.property] = "", t.css(n), t.outerHeight(!1) > s && (s = t.outerHeight(!1)), i ? t.attr("style", i) : t.css("display", "")
     })
    }
    n.each(function() {
     var t = e(this),
      i = 0;
     r.target && t.is(r.target) || ("border-box" !== t.css("box-sizing") && (i += o(t.css("border-top-width")) + o(t.css("border-bottom-width")), i += o(t.css("padding-top")) + o(t.css("padding-bottom"))), t.css(r.property, s - i + "px"))
    })
   }), p.each(function() {
    var t = e(this);
    t.attr("style", t.data("style-cache") || null)
   }), a._maintainScroll && e(window).scrollTop(c / u * e("html").outerHeight(!0)), this
  }, a._applyDataApi = function() {
   var t = {};
   e("[data-match-height], [data-mh]").each(function() {
    var i = e(this),
     o = i.attr("data-mh") || i.attr("data-match-height");
    t[o] = o in t ? t[o].add(i) : i
   }), e.each(t, function() {
    this.matchHeight(!0)
   })
  };
  var r = function(t) {
   a._beforeUpdate && a._beforeUpdate(t, a._groups), e.each(a._groups, function() {
    a._apply(this.elements, this.options)
   }), a._afterUpdate && a._afterUpdate(t, a._groups)
  };
  a._update = function(o, n) {
   if (n && "resize" === n.type) {
    var s = e(window).width();
    if (s === t) return;
    t = s
   }
   o ? -1 === i && (i = setTimeout(function() {
    r(n), i = -1
   }, a._throttle)) : r(n)
  }, e(a._applyDataApi);
  var l = e.fn.on ? "on" : "bind";
  e(window)[l]("load", function(e) {
   a._update(!1, e)
  }), e(window)[l]("resize orientationchange", function(e) {
   a._update(!0, e)
  })
 })
}, function(e, t, i) {
 "use strict";
 Object.defineProperty(t, "__esModule", {
  value: !0
 });
 var o = function(e) {
  var t = {
    "Password can not be empty": "Vui lòng nhập mật khẩu",
    "Password is the same with email": "Mật khẩu tương tự với email, vui lòng nhập mật khẩu khác",
    "Password length must be minimum 6 characters and maximum 20 characters": "Mật khẩu phải có ít nhất 6 ký tự và nhiều nhất 20 ký tự",
    "Password needs contain at least 1 uppercase character": "Mật khẩu cần chứa ít nhất 1 chữ in hoa",
    "Password needs contain at least 1 lowercase character": "Mật khẩu cần chứa ít nhất 1 chữ thường",
    "Password needs contain at least 1 number": "Mật khẩu cần chứa ít nhất 1 số",
    "Password should not be the same with email address.": "Mật khẩu không nên trùng với địa chỉ email.",
    "Read article": "Xem thêm",
    "Passwords with : 6 to 50 characters, 1 uppercase, 1 number.": "Mật khẩu từ 6 đến 50 ký tự, ít nhất 1 ký tự viết hoa và 1 chữ số.",
    "Error in uploading file, please check your file and upload again": "Có lỗi trong lúc tải hồ sơ, bạn vui lòng kiểm tra và tải lại.",
    "File uploaded size needs to smaller than 2MB": "Dung lượng hồ sơ phải nhỏ hơn 2MB",
    "Change file": "Đổi tập tin"
   },
   i = language || 2;
  return e = e.trim(), 2 === i ? e : t[e]
 };
 t.default = o
}, function(e, t, i) {
 "use strict";

 function o(e) {
  return e && e.__esModule ? e : {
   default: e
  }
 }

 function n(e) {
  
 }
 var s = i(17),
  a = o(s),
  r = i(18),
  l = o(r),
  d = i(19),
  c = o(d);
 window.setLocalStorage = function(e, t) {
  if ("function" != typeof setCookie);
  setCookie(e, t, null)
 }, window.getLocalStorage = function(e) {
  if ("function" != typeof getCookie);
  return getCookie(e)
 }, n("placeholders_autoinit.js?version=" + system_version), n("jqueryUiQuickSearchBlock.js?version=" + system_version), n("quickSearchBlock.min.js?version=" + system_version), n("master.js?version=" + system_version), $(function() {
  new l.default, new c.default, new a.default(".global__splitter-menu", ".menu-toggler")
 })
}, function(e, t, i) {
 "use strict";

 function o(e, t) {
  if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(t, "__esModule", {
  value: !0
 });
 var n = function() {
   function e(e, t) {
    for (var i = 0; i < t.length; i++) {
     var o = t[i];
     o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
   }
   return function(t, i, o) {
    return i && e(t.prototype, i), o && e(t, o), t
   }
  }(),
  s = document.querySelector("html"),
  a = function() {
   function e(t, i) {
    o(this, e), this.initElements(t, i), this.initInitialState(), this.bindBehaviours()
   }
   return n(e, [{
    key: "initElements",
    value: function(e, t) {
     this.splitterRoot = document.querySelector(e), this.splitterToggler = document.querySelector(t), this.splitterSide = this.splitterRoot.querySelector(".splitter-side"), this.splitterOverlay = this.splitterRoot.querySelector(".splitter-overlay")
    }
   }, {
    key: "initInitialState",
    value: function() {
     this.splitterRoot.style.display = "none", this.splitterOverlay.style.display = "none", this.splitterSide.classList.add("animated", "fadeInLeft", "fadeOutLeft"), this.splitterOverlay.classList.add("animated", "fadeIn", "fadeOut")
    }
   }, {
    key: "bindBehaviours",
    value: function() {
     var e = this,
      t = this.splitterToggler,
      i = this.splitterOverlay;
     this.splitterSide;
     t.addEventListener("click", function() {
      e.showSplitter()
     }), i.addEventListener("click", function() {
      e.hideSplitter()
     })
    }
   }, {
    key: "showSplitter",
    value: function() {
     this.splitterRoot.style.display = "block", this.splitterOverlay.style.display = "block", this.splitterOverlay.classList.remove("fadeOut"), this.splitterSide.classList.remove("fadeOutLeft"), setTimeout(function() {
      s.classList.add("page-vertical-scroll-locked")
     }, 300)
    }
   }, {
    key: "hideSplitter",
    value: function() {
     var e = this;
     this.splitterSide.classList.add("fadeOutLeft"), this.splitterOverlay.classList.add("fadeOut"), setTimeout(function() {
      e.splitterRoot.style.display = "none", e.splitterOverlay.style.display = "none", s.classList.remove("page-vertical-scroll-locked")
     }, 300)
    }
   }]), e
  }();
 t.default = a
}, function(e, t, i) {
 "use strict";

 function o(e, t) {
  if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(t, "__esModule", {
  value: !0
 });
 var n = function() {
   function e(e, t) {
    for (var i = 0; i < t.length; i++) {
     var o = t[i];
     o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
   }
   return function(t, i, o) {
    return i && e(t.prototype, i), o && e(t, o), t
   }
  }(),
  s = function() {
   function e() {
    o(this, e), this.checkFooterBadgeHREF(), this.initMenuToggler(), this.initGlobalNotification()
   }
   return n(e, [{
    key: "checkFooterBadgeHREF",
    value: function() {
     $(".footer__app-badges").find("a").each(function() {
      $(this).attr("href") || $(this).addClass("non-clickable").removeAttr("href target")
     })
    }
   }, {
    key: "initMenuToggler",
    value: function() {
    
    }
   }, {
    key: "initGlobalNotification",
    value: function() {
     var e = $("body"),
      t = $(".alert-notifications"),
      i = t.find(".number"),
      o = $(".global__notification-popover"),
      n = $(".navbar-right .alert-notifications .fa-bell"),
      s = $(".dropdown.user-account"),
      a = function() {
       o.removeClass("fadeOut").addClass("in animated fadeIn").show(), t.trigger("showPopover")
      },
      r = function() {
       t.trigger("hidePopover"), o.removeClass("in fadeIn").addClass("animated fadeOut"), setTimeout(function() {
        o.hide()
       }, 300)
      };
     t.click(function(e) {
      e.stopPropagation(), o.hasClass("in") ? r() : a()
     }), t.click(function(e) {
      e.stopPropagation(), i.fadeOut("fast")
     }), $(document).click(function() {
      r()
     }), t.on("showPopover", function() {
      if ($(document).width() > 991) {
       var e = o.width(),
        t = $(document).width() - n.offset().left - n.width() / 2,
        i = {
         right: t,
         marginRight: -e / 2
        };
       o.css(i)
      }
     }), t.on("showPopover", function() {
      o.find(".job-title, .company-name").each(function() {
       $(this).dotdotdot({
        height: 41
       })
      })
     }), t.on("showPopover", function() {
      s.removeClass("open")
     }), s.on("shown.bs.dropdown", function() {
      r()
     }), t.on("showPopover", function() {
      e.width() < 992 && e.addClass("vertical-scroll-locked")
     }).on("hidePopover", function() {
      e.removeClass("vertical-scroll-locked")
     })
    }
   }]), e
  }();
 t.default = s
}, function(e, t, i) {
 "use strict";

 function o(e, t) {
  if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(t, "__esModule", {
  value: !0
 });
 var n = function() {
   function e(e, t) {
    for (var i = 0; i < t.length; i++) {
     var o = t[i];
     o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
    }
   }
   return function(t, i, o) {
    return i && e(t.prototype, i), o && e(t, o), t
   }
  }(),
  s = function() {
   function e() {
    o(this, e), this.checkWindowOS(), this.initCollapseFooter()
   }
   return n(e, [{
    key: "checkWindowOS",
    value: function() {
     navigator.userAgent.indexOf("Win") > -1 && $("html").addClass("isWindow")
    }
   }, {
    key: "initCollapseFooter",
    value: function() {
     $(document).width() < 992 ? ($(".link-listing-item .title").find("i").addClass("collapsed"), $(".link-listing-item .title").parent().find(".link-listing").addClass("collapsed")) : $(".link-listing-item").removeClass("mobile"), $(".link-listing-item .title").click(function(e) {
      $(document).width() < 992 ? ($(".link-listing-item").addClass("mobile"), e.preventDefault(), $(this).find("i").toggleClass("collapsed"), $(this).parent().find(".link-listing").toggleClass("collapsed")) : $(".link-listing-item").removeClass("mobile")
     }), $(window).resize(function() {
      $(document).width() < 992 || $(".link-listing-item").removeClass("mobile")
     })
    }
   }]), e
  }();
 t.default = s
}, function(e, t, i) {
 "use strict";
 ! function(e, t) {
  if (e.cleanData) {
   var i = e.cleanData;
   e.cleanData = function(t) {
    for (var o, n = 0; null != (o = t[n]); n++) e(o).triggerHandler("remove");
    i(t)
   }
  } else {
   var o = e.fn.remove;
   e.fn.remove = function(t, i) {
    return this.each(function() {
     return i || t && !e.filter(t, [this]).length || e("*", this).add([this]).each(function() {
      e(this).triggerHandler("remove")
     }), o.call(e(this), t, i)
    })
   }
  }
  e.widget = function(t, i, o) {
   var n, s = t.split(".")[0];
   t = t.split(".")[1], n = s + "-" + t, o || (o = i, i = e.Widget), e.expr[":"][n] = function(i) {
    return !!e.data(i, t)
   }, e[s] = e[s] || {}, e[s][t] = function(e, t) {
    arguments.length && this._createWidget(e, t)
   };
   var a = new i;
   a.options = e.extend(!0, {}, a.options), e[s][t].prototype = e.extend(!0, a, {
    namespace: s,
    widgetName: t,
    widgetEventPrefix: e[s][t].prototype.widgetEventPrefix || t,
    widgetBaseClass: n
   }, o), e.widget.bridge(t, e[s][t])
  }, e.widget.bridge = function(i, o) {
   e.fn[i] = function(n) {
    var s = "string" == typeof n,
     a = Array.prototype.slice.call(arguments, 1),
     r = this;
    return n = !s && a.length ? e.extend.apply(null, [!0, n].concat(a)) : n, s && "_" === n.charAt(0) ? r : (s ? this.each(function() {
     var o = e.data(this, i),
      s = o && e.isFunction(o[n]) ? o[n].apply(o, a) : o;
     if (s !== o && s !== t) return r = s, !1
    }) : this.each(function() {
     var t = e.data(this, i);
     t ? t.option(n || {})._init() : e.data(this, i, new o(n, this))
    }), r)
   }
  }, e.Widget = function(e, t) {
   arguments.length && this._createWidget(e, t)
  }, e.Widget.prototype = {
   widgetName: "widget",
   widgetEventPrefix: "",
   options: {
    disabled: !1
   },
   _createWidget: function(t, i) {
    e.data(i, this.widgetName, this), this.element = e(i), this.options = e.extend(!0, {}, this.options, this._getCreateOptions(), t);
    var o = this;
    this.element.bind("remove." + this.widgetName, function() {
     o.destroy()
    }), this._create(), this._trigger("create"), this._init()
   },
   _getCreateOptions: function() {
    return e.metadata && e.metadata.get(this.element[0])[this.widgetName]
   },
   _create: function() {},
   _init: function() {},
   destroy: function() {
    this.element.unbind("." + this.widgetName).removeData(this.widgetName), this.widget().unbind("." + this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass + "-disabled ui-state-disabled")
   },
   widget: function() {
    return this.element
   },
   option: function(i, o) {
    var n = i;
    if (0 === arguments.length) return e.extend({}, this.options);
    if ("string" == typeof i) {
     if (o === t) return this.options[i];
     n = {}, n[i] = o
    }
    return this._setOptions(n), this
   },
   _setOptions: function(t) {
    var i = this;
    return e.each(t, function(e, t) {
     i._setOption(e, t)
    }), this
   },
   _setOption: function(e, t) {
    return this.options[e] = t, "disabled" === e && this.widget()[t ? "addClass" : "removeClass"](this.widgetBaseClass + "-disabled ui-state-disabled").attr("aria-disabled", t), this
   },
   enable: function() {
    return this._setOption("disabled", !1)
   },
   disable: function() {
    return this._setOption("disabled", !0)
   },
   _trigger: function(t, i, o) {
    var n = this.options[t];
    if (i = e.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), o = o || {}, i.originalEvent)
     for (var s, a = e.event.props.length; a;) s = e.event.props[--a], i[s] = i.originalEvent[s];
    return this.element.trigger(i, o), !(e.isFunction(n) && !1 === n.call(this.element[0], i, o) || i.isDefaultPrevented())
   }
  }
 }(jQuery),
 function(e, t) {
  var i, o = "ui-button ui-widget ui-state-default ui-corner-all",
   n = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
   s = function(t) {
    e(":ui-button", t.target.form).each(function() {
     var t = e(this).data("button");
     setTimeout(function() {
      t.refresh()
     }, 1)
    })
   },
   a = function(t) {
    var i = t.name,
     o = t.form,
     n = e([]);
    return i && (n = o ? e(o).find("[name='" + i + "']") : e("[name='" + i + "']", t.ownerDocument).filter(function() {
     return !this.form
    })), n
   };
  e.widget("ui.button", {
   options: {
    disabled: null,
    text: !0,
    label: null,
    icons: {
     primary: null,
     secondary: null
    }
   },
   _create: function() {
    this.element.closest("form").unbind("reset.button").bind("reset.button", s), "boolean" != typeof this.options.disabled && (this.options.disabled = this.element.attr("disabled")), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
    var t = this,
     n = this.options,
     r = "checkbox" === this.type || "radio" === this.type;
    null === n.label && (n.label = this.buttonElement.html()), this.element.is(":disabled") && (n.disabled = !0), this.buttonElement.addClass(o).attr("role", "button").bind("mouseenter.button", function() {
     n.disabled || (e(this).addClass(""), this === i && e(this).addClass(""))
    }).bind("mouseleave.button", function() {
     n.disabled || e(this).removeClass("")
    }).bind("focus.button", function() {
     e(this).addClass("")
    }).bind("blur.button", function() {
     e(this).removeClass("")
    }), r && this.element.bind("change.button", function() {
     t.refresh()
    }), "checkbox" === this.type ? this.buttonElement.bind("click.button", function() {
     if (n.disabled) return !1;
     e(this).toggleClass("ui-state-active"), t.buttonElement.attr("aria-pressed", t.element[0].checked)
    }) : "radio" === this.type ? this.buttonElement.bind("click.button", function() {
     if (n.disabled) return !1;
     e(this).addClass("ui-state-active"), t.buttonElement.attr("aria-pressed", !0);
     var i = t.element[0];
     a(i).not(i).map(function() {
      return e(this).button("widget")[0]
     }).removeClass("ui-state-active").attr("aria-pressed", !1)
    }) : (this.buttonElement.bind("mousedown.button", function() {
     if (n.disabled) return !1;
     e(this).addClass("ui-state-active"), i = this, e(document).one("mouseup", function() {
      i = null
     })
    }).bind("mouseup.button", function() {
     if (n.disabled) return !1;
     e(this).removeClass("ui-state-active")
    }).bind("keydown.button", function(t) {
     if (n.disabled) return !1;
     t.keyCode != e.ui.keyCode.SPACE && t.keyCode != e.ui.keyCode.ENTER || e(this).addClass("ui-state-active")
    }).bind("keyup.button", function() {
     e(this).removeClass("ui-state-active")
    }), this.buttonElement.is("a") && this.buttonElement.keyup(function(t) {
     t.keyCode === e.ui.keyCode.SPACE && e(this).click()
    })), this._setOption("disabled", n.disabled)
   },
   _determineButtonType: function() {
    if (this.element.is(":checkbox") ? this.type = "checkbox" : this.element.is(":radio") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button", "checkbox" === this.type || "radio" === this.type) {
     this.buttonElement = this.element.parents().last().find("label[for=" + this.element.attr("id") + "]"), this.element.addClass("ui-helper-hidden-accessible");
     var e = this.element.is(":checked");
     e && this.buttonElement.addClass("ui-state-active"), this.buttonElement.attr("aria-pressed", e)
    } else this.buttonElement = this.element
   },
   widget: function() {
    return this.buttonElement
   },
   destroy: function() {
    this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(o + " ui-state-hover ui-state-active  " + n).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title"), e.Widget.prototype.destroy.call(this)
   },
   _setOption: function(t, i) {
    e.Widget.prototype._setOption.apply(this, arguments), "disabled" === t && (i ? this.element.attr("disabled", !0) : this.element.removeAttr("disabled")), this._resetButton()
   },
   refresh: function() {
    var t = this.element.is(":disabled");
    t !== this.options.disabled && this._setOption("disabled", t), "radio" === this.type ? a(this.element[0]).each(function() {
     e(this).is(":checked") ? e(this).button("widget").addClass("ui-state-active").attr("aria-pressed", !0) : e(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", !1)
    }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", !0) : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", !1))
   },
   _resetButton: function() {
    if ("input" === this.type) return void(this.options.label && this.element.val(this.options.label));
    var t = this.buttonElement.removeClass(n),
     i = e("<span></span>").addClass("ui-button-text").html(this.options.label).appendTo(t.empty()).text(),
     o = this.options.icons,
     s = o.primary && o.secondary;
    o.primary || o.secondary ? (t.addClass("ui-button-text-icon" + (s ? "s" : o.primary ? "-primary" : "-secondary")), o.primary && t.prepend("<span class='ui-button-icon-primary ui-icon " + o.primary + "'></span>"), o.secondary && t.append("<span class='ui-button-icon-secondary ui-icon " + o.secondary + "'></span>"), this.options.text || (t.addClass(s ? "ui-button-icons-only" : "ui-button-icon-only").removeClass("ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary"), this.hasTitle || t.attr("title", i))) : t.addClass("ui-button-text-only")
   }
  }), e.widget("ui.buttonset", {
   _create: function() {
    this.element.addClass("ui-buttonset")
   },
   _init: function() {
    this.refresh()
   },
   _setOption: function(t, i) {
    "disabled" === t && this.buttons.button("option", t, i), e.Widget.prototype._setOption.apply(this, arguments)
   },
   refresh: function() {
    this.buttons = this.element.find(":button, :submit, :reset, :checkbox, :radio, a, :data(button)").filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function() {
     return e(this).button("widget")[0]
    }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":visible").filter(":first").addClass("ui-corner-left").end().filter(":last").addClass("ui-corner-right").end().end().end()
   },
   destroy: function() {
    this.element.removeClass("ui-buttonset"), this.buttons.map(function() {
     return e(this).button("widget")[0]
    }).removeClass("ui-corner-left ui-corner-right").end().button("destroy"), e.Widget.prototype.destroy.call(this)
   }
  })
 }(jQuery),
 function(e, t) {
  if (e.cleanData) {
   var i = e.cleanData;
   e.cleanData = function(t) {
    for (var o, n = 0; null != (o = t[n]); n++) e(o).triggerHandler("remove");
    i(t)
   }
  } else {
   var o = e.fn.remove;
   e.fn.remove = function(t, i) {
    return this.each(function() {
     return i || t && !e.filter(t, [this]).length || e("*", this).add([this]).each(function() {
      e(this).triggerHandler("remove")
     }), o.call(e(this), t, i)
    })
   }
  }
  e.widget = function(t, i, o) {
   var n, s = t.split(".")[0];
   t = t.split(".")[1], n = s + "-" + t, o || (o = i, i = e.Widget), e.expr[":"][n] = function(i) {
    return !!e.data(i, t)
   }, e[s] = e[s] || {}, e[s][t] = function(e, t) {
    arguments.length && this._createWidget(e, t)
   };
   var a = new i;
   a.options = e.extend(!0, {}, a.options), e[s][t].prototype = e.extend(!0, a, {
    namespace: s,
    widgetName: t,
    widgetEventPrefix: e[s][t].prototype.widgetEventPrefix || t,
    widgetBaseClass: n
   }, o), e.widget.bridge(t, e[s][t])
  }, e.widget.bridge = function(i, o) {
   e.fn[i] = function(n) {
    var s = "string" == typeof n,
     a = Array.prototype.slice.call(arguments, 1),
     r = this;
    return n = !s && a.length ? e.extend.apply(null, [!0, n].concat(a)) : n, s && "_" === n.charAt(0) ? r : (s ? this.each(function() {
     var o = e.data(this, i),
      s = o && e.isFunction(o[n]) ? o[n].apply(o, a) : o;
     if (s !== o && s !== t) return r = s, !1
    }) : this.each(function() {
     var t = e.data(this, i);
     t ? t.option(n || {})._init() : e.data(this, i, new o(n, this))
    }), r)
   }
  }, e.Widget = function(e, t) {
   arguments.length && this._createWidget(e, t)
  }, e.Widget.prototype = {
   widgetName: "widget",
   widgetEventPrefix: "",
   options: {
    disabled: !1
   },
   _createWidget: function(t, i) {
    e.data(i, this.widgetName, this), this.element = e(i), this.options = e.extend(!0, {}, this.options, this._getCreateOptions(), t);
    var o = this;
    this.element.bind("remove." + this.widgetName, function() {
     o.destroy()
    }), this._create(), this._trigger("create"), this._init()
   },
   _getCreateOptions: function() {
    return e.metadata && e.metadata.get(this.element[0])[this.widgetName]
   },
   _create: function() {},
   _init: function() {},
   destroy: function() {
    this.element.unbind("." + this.widgetName).removeData(this.widgetName), this.widget().unbind("." + this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass + "-disabled ui-state-disabled")
   },
   widget: function() {
    return this.element
   },
   option: function(i, o) {
    var n = i;
    if (0 === arguments.length) return e.extend({}, this.options);
    if ("string" == typeof i) {
     if (o === t) return this.options[i];
     n = {}, n[i] = o
    }
    return this._setOptions(n), this
   },
   _setOptions: function(t) {
    var i = this;
    return e.each(t, function(e, t) {
     i._setOption(e, t)
    }), this
   },
   _setOption: function(e, t) {
    return this.options[e] = t, "disabled" === e && this.widget()[t ? "addClass" : "removeClass"](this.widgetBaseClass + "-disabled ui-state-disabled").attr("aria-disabled", t), this
   },
   enable: function() {
    return this._setOption("disabled", !1)
   },
   disable: function() {
    return this._setOption("disabled", !0)
   },
   _trigger: function(t, i, o) {
    var n = this.options[t];
    if (i = e.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), o = o || {}, i.originalEvent)
     for (var s, a = e.event.props.length; a;) s = e.event.props[--a], i[s] = i.originalEvent[s];
    return this.element.trigger(i, o), !(e.isFunction(n) && !1 === n.call(this.element[0], i, o) || i.isDefaultPrevented())
   }
  }
 }(jQuery),
 function(e, t) {
  e.ui = e.ui || {};
  var i = /left|center|right/,
   o = /top|center|bottom/,
   n = "center",
   s = e.fn.position,
   a = e.fn.offset;
  e.fn.position = function(t) {
   if (!t || !t.of) return s.apply(this, arguments);
   t = e.extend({}, t);
   var a, r, l, d = e(t.of),
    c = d[0],
    u = (t.collision || "flip").split(" "),
    p = t.offset ? t.offset.split(" ") : [0, 0];
   return 9 === c.nodeType ? (a = d.width(), r = d.height(), l = {
    top: 0,
    left: 0
   }) : c.setTimeout ? (a = d.width(), r = d.height(), l = {
    top: d.scrollTop(),
    left: d.scrollLeft()
   }) : c.preventDefault ? (t.at = "left top", a = r = 0, l = {
    top: t.of.pageY,
    left: t.of.pageX
   }) : (a = d.outerWidth(), r = d.outerHeight(), l = d.offset(), l.top += d.height()), e.each(["my", "at"], function() {
    var e = (t[this] || "").split(" ");
    1 === e.length && (e = i.test(e[0]) ? e.concat([n]) : o.test(e[0]) ? [n].concat(e) : [n, n]), e[0] = i.test(e[0]) ? e[0] : n, e[1] = o.test(e[1]) ? e[1] : n, t[this] = e
   }), 1 === u.length && (u[1] = u[0]), p[0] = parseInt(p[0], 10) || 0, 1 === p.length && (p[1] = p[0]), p[1] = parseInt(p[1], 10) || 0, "right" === t.at[0] ? l.left += a : t.at[0] === n && (l.left += a / 2), "bottom" === t.at[1] ? l.top += r : t.at[1] === n && (l.top += r / 2), l.left += p[0], l.left = l.left + .5, l.top += p[1], this.each(function() {
    var i, o = e(this),
     s = o.outerWidth(),
     d = o.outerHeight(),
     c = parseInt(e.css(this, "marginLeft", !0)) || 0,
     h = parseInt(e.css(this, "marginTop", !0)) || 0,
     f = s + c + parseInt(e.css(this, "marginRight", !0)) || 0,
     g = d + h + parseInt(e.css(this, "marginBottom", !0)) || 0,
     v = e.extend({}, l);
    "right" === t.my[0] ? v.left -= s : t.my[0] === n && (v.left -= s / 2), "bottom" === t.my[1] ? v.top -= d : t.my[1] === n && (v.top -= d / 2), v.left = parseInt(v.left), v.top = parseInt(v.top), i = {
     left: v.left - c,
     top: v.top - h
    }, e.each(["left", "top"], function(o, n) {
     e.ui.position[u[o]] && e.ui.position[u[o]][n](v, {
      targetWidth: a,
      targetHeight: r,
      elemWidth: s,
      elemHeight: d,
      collisionPosition: i,
      collisionWidth: f,
      collisionHeight: g,
      offset: p,
      my: t.my,
      at: t.at
     })
    }), e.fn.bgiframe && o.bgiframe(), outerWidthJS = 2 * parseInt(e(t.of).css("margin-left").replace("px", ""), 10) + 2 * parseInt(e(t.of).css("padding-left").replace("px", ""), 10), nextButton = e(t.of).next(), o.css("minWidth", e(t.of).width() + outerWidthJS + nextButton.width()), o.css("overflow-x", "hidden"), o.offset(e.extend(v, {
     using: t.using
    }))
   })
  }, e.ui.position = {
   fit: {
    left: function(t, i) {
     var o = e(window),
      n = i.collisionPosition.left + i.collisionWidth - o.width() - o.scrollLeft();
     t.left = n > 0 ? t.left - n : Math.max(t.left - i.collisionPosition.left, t.left)
    },
    top: function(t, i) {
     var o = e(window),
      n = i.collisionPosition.top + i.collisionHeight - o.height() - o.scrollTop();
     t.top = n > 0 ? t.top - n : Math.max(t.top - i.collisionPosition.top, t.top)
    }
   },
   flip: {
    left: function(t, i) {
     if (i.at[0] !== n) {
      var o = e(window),
       s = i.collisionPosition.left + i.collisionWidth - o.width() - o.scrollLeft(),
       a = "left" === i.my[0] ? -i.elemWidth : "right" === i.my[0] ? i.elemWidth : 0,
       r = "left" === i.at[0] ? i.targetWidth : -i.targetWidth,
       l = -2 * i.offset[0];
      t.left += i.collisionPosition.left < 0 ? a + r + l : s > 0 ? a + r + l : 0
     }
    },
    top: function(t, i) {
     if (i.at[1] !== n) {
      var o = e(window),
       s = i.collisionPosition.top + i.collisionHeight - o.height() - o.scrollTop(),
       a = "top" === i.my[1] ? -i.elemHeight : "bottom" === i.my[1] ? i.elemHeight : 0,
       r = "top" === i.at[1] ? i.targetHeight : -i.targetHeight,
       l = -2 * i.offset[1];
      t.top += i.collisionPosition.top < 0 ? a + r + l : s > 0 ? a + r + l : 0
     }
    }
   }
  }, e.offset.setOffset || (e.offset.setOffset = function(t, i) {
   /static/.test(e.css(t, "position")) && (t.style.position = "relative");
   var o = e(t),
    n = o.offset(),
    s = parseInt(e.css(t, "top", !0), 10) || 0,
    a = parseInt(e.css(t, "left", !0), 10) || 0,
    r = {
     top: i.top - n.top + s,
     left: i.left - n.left + a
    };
   "using" in i ? i.using.call(t, r) : o.css(r)
  }, e.fn.offset = function(t) {
   var i = this[0];
   return i && i.ownerDocument ? t ? this.each(function() {
    e.offset.setOffset(this, t)
   }) : a.call(this) : null
  })
 }(jQuery),
 function(e) {
  e.widget("ui.menu", {
   _create: function() {
    var t = this;
    this.element.attr({
     role: "listbox",
     "aria-activedescendant": "ui-active-menuitem"
    }).click(function(i) {
     e(i.target).closest(".ui-menu-item a").length && (i.preventDefault(), t.select(i))
    }), this.refresh()
   },
   refresh: function() {
    var t = this;
    this.element.children("li:not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "menuitem").children("a").addClass("ui-corner-all").attr("tabindex", -1).mouseenter(function(i) {
     t.activate(i, e(this).parent())
    }).mouseleave(function() {
     t.deactivate()
    })
   },
   activate: function(e, t) {
    if (this.deactivate(), this.hasScroll()) {
     var i = t.offset().top - this.element.offset().top,
      o = this.element.attr("scrollTop"),
      n = this.element.height();
     i < 0 ? this.element.attr("scrollTop", o + i) : i >= n && this.element.attr("scrollTop", o + i - n + t.height())
    }
    this.active = t.eq(0).children("a").addClass("ui-state-hover").attr("id", "ui-active-menuitem").end(), this._trigger("focus", e, {
     item: t
    })
   },
   deactivate: function() {
    this.active && (this.active.children("a").removeClass("ui-state-hover").removeAttr("id"), this._trigger("blur"), this.active = null)
   },
   next: function(e) {
    this.move("next", ".ui-menu-item:first", e)
   },
   previous: function(e) {
    this.move("prev", ".ui-menu-item:last", e)
   },
   first: function() {
    return this.active && !this.active.prevAll(".ui-menu-item").length
   },
   last: function() {
    return this.active && !this.active.nextAll(".ui-menu-item").length
   },
   move: function(e, t, i) {
    if (!this.active) return void this.activate(i, this.element.children(t));
    var o = this.active[e + "All"](".ui-menu-item").eq(0);
    o.length ? this.activate(i, o) : this.activate(i, this.element.children(t))
   },
   nextPage: function(t) {
    if (this.hasScroll()) {
     if (!this.active || this.last()) return void this.activate(t, this.element.children(".ui-menu-item:first"));
     var i = this.active.offset().top,
      o = this.element.height(),
      n = this.element.children(".ui-menu-item").filter(function() {
       var t = e(this).offset().top - i - o + e(this).height();
       return t < 10 && t > -10
      });
     n.length || (n = this.element.children(".ui-menu-item:last")), this.activate(t, n)
    } else this.activate(t, this.element.children(".ui-menu-item").filter(!this.active || this.last() ? ":first" : ":last"))
   },
   previousPage: function(t) {
    if (this.hasScroll()) {
     if (!this.active || this.first()) return void this.activate(t, this.element.children(".ui-menu-item:last"));
     var i = this.active.offset().top,
      o = this.element.height();
     result = this.element.children(".ui-menu-item").filter(function() {
      var t = e(this).offset().top - i + o - e(this).height();
      return t < 10 && t > -10
     }), result.length || (result = this.element.children(".ui-menu-item:first")), this.activate(t, result)
    } else this.activate(t, this.element.children(".ui-menu-item").filter(!this.active || this.first() ? ":last" : ":first"))
   },
   hasScroll: function() {
    return this.element.height() < this.element.attr("scrollHeight")
   },
   select: function(e) {
    this._trigger("selected", e, {
     item: this.active
    })
   }
  })
 }(jQuery)
}]).default;
//# sourceMappingURL=ui.js.map