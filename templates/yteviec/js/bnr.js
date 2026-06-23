window.bnr = function(g) {
 function A(C) {
  if (I[C]) return I[C].exports;
  var e = I[C] = {
   i: C,
   l: !1,
   exports: {}
  };
  return g[C].call(e.exports, e, e.exports, A), e.l = !0, e.exports
 }
 var I = {};
 return A.m = g, A.c = I, A.d = function(g, I, C) {
  A.o(g, I) || Object.defineProperty(g, I, {
   configurable: !1,
   enumerable: !0,
   get: C
  })
 }, A.n = function(g) {
  var I = g && g.__esModule ? function() {
   return g.default
  } : function() {
   return g
  };
  return A.d(I, "a", I), I
 }, A.o = function(g, A) {
  return Object.prototype.hasOwnProperty.call(g, A)
 }, A.p = "", A(A.s = 1)
}([, function(g, A, I) {
 "use strict";

 function C(g) {
  return g && g.__esModule ? g : {
   default: g
  }
 }
 var e = I(2),
  n = C(e),
  t = I(3),
  a = C(t),
  i = I(4),
  o = C(i),
  r = I(5),
  s = C(r),
  c = I(6),
  l = C(c),
  d = I(7),
  m = C(d),
  u = I(8),
  p = C(u),
  v = I(9),
  f = C(v),
  h = I(10),
  w = C(h);
 "scrollRestoration" in history && (history.scrollRestoration = "manual"), $(function() {
  n.default.exec_request(), new a.default, $(document).on("scroll.bannerRequest", function() {
   $(window).scrollTop() > 100 && (new o.default, new l.default, s.default.exec_request(), m.default.exec_request(), p.default.exec_request(), f.default.exec_request(), w.default.exec_request(), $(document).off("scroll.bannerRequest"))
  })
 })
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  initCarousel: function() {
   var g = jQuery(".hero-carousel"),
    A = jQuery(".hero-carousel__pagination"),
    I = g.jcarousel({
     wrap: "circular",
     transitions: !0
    });
   1 === g.jcarousel("items").length && A.addClass("hidden"), A.on("jcarouselpagination:active", "a", function() {
    jQuery(this).addClass("active")
   }).on("jcarouselpagination:inactive", "a", function() {
    jQuery(this).removeClass("active")
   }).jcarouselPagination({
    carousel: I
   }), g.addClass("hero-carousel_loaded")
  },
  setHeroBannerItemWidth: function() {
   var g = $(window).width();
   jQuery(".hero-banner-item").width(g)
  },
  autoScroll: function(g) {
   var A, I;
   I = function() {
    jQuery(".hero-carousel").jcarousel("scroll", "+=1")
   }, A = setInterval(function() {
    I()
   }, g), jQuery(".hero-carousel__pagination").on("click", "a", function() {
    clearInterval(A), A = setInterval(function() {
     I()
    }, g)
   })
  },
  setHeroBannerBg: function() {
   jQuery(".hero-banner-item").each(function() {
    var g = encodeURI(jQuery(this).find("img").attr("src"));
    jQuery(this).css({
     "background-image": "url(" + g + ")",
     "background-size": "cover"
    }).fadeTo(1e3, 1)
   })
  },
  initBanner: function() {
   C.initCarousel(), C.setHeroBannerBg(), C.setHeroBannerItemWidth(), C.resizeWindow()
  },
  resizeWindow: function() {
   jQuery(window).resize(function() {
    C.setHeroBannerItemWidth()
   })
  },
  exec_request: function() {
   var g = jQuery(".hero-banner-list");
   console.log("Start loading hero banners..."), jQuery.ajax({
    url: "test2.php",
    success: function(A) {
     200 == A.code && (C.render_ads(g, A.data.result), C.initBanner(), A.data.result.length > 1 && C.autoScroll(A.data.rotate_time))
    },
    complete: function() {
     console.log("Complete loading hero banners"), $(C).trigger("dataRetrieved")
    }
   })
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = "", e = 0; e < I; e++) {
     var n = A[e],
      t = '<div class="hero-banner-item" style="width: 1440px; background-size: cover;">',
      a = '<div class="hero-banner-item__overlay"></div>';
     a += '<img src="' + n.imageURL + '" alt="" class="img-responsive" style="opacity: 0;">', a += '<a class="hot-corner hidden-xs" target="_blank" href="' + n.destinationURL + '">', a += '<div class="col-sm-4 hot-corner__logo">', a += '<img class="img-responsive" src="' + n.subimageURL + '" alt=""> </div>', a += '<div class="col-sm-8">', a += '<div class="hot-corner__description no-break-out">' + n.textLine1 + "</div>", a += '<div class="hot-corner__description no-break-out">' + n.textLine2 + "</div>", a += '<div class="hot-corner__view-link">', a += '<img alt="View more image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAACXBIWXMAAAsTAAALEwEAmpwYAAA5pmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxMzIgNzkuMTU5Mjg0LCAyMDE2LzA0LzE5LTEzOjEzOjQwICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgICAgICAgICB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIKICAgICAgICAgICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgICAgICAgICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgICAgICAgICB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIgogICAgICAgICAgICB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyI+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIENDIDIwMTUuNSAoTWFjaW50b3NoKTwveG1wOkNyZWF0b3JUb29sPgogICAgICAgICA8eG1wOkNyZWF0ZURhdGU+MjAxNi0xMS0wMVQxMTowNjozNCswNzowMDwveG1wOkNyZWF0ZURhdGU+CiAgICAgICAgIDx4bXA6TW9kaWZ5RGF0ZT4yMDE2LTExLTAxVDExOjA5OjAyKzA3OjAwPC94bXA6TW9kaWZ5RGF0ZT4KICAgICAgICAgPHhtcDpNZXRhZGF0YURhdGU+MjAxNi0xMS0wMVQxMTowOTowMiswNzowMDwveG1wOk1ldGFkYXRhRGF0ZT4KICAgICAgICAgPHhtcE1NOkluc3RhbmNlSUQ+eG1wLmlpZDpmYTAxN2VmNi0xNDc3LTRkMmItYmI4ZS1kYWMyNzlmNWE4Yjg8L3htcE1NOkluc3RhbmNlSUQ+CiAgICAgICAgIDx4bXBNTTpEb2N1bWVudElEPnhtcC5kaWQ6RUI4ODgwRkE5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3htcE1NOkRvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpEZXJpdmVkRnJvbSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgIDxzdFJlZjppbnN0YW5jZUlEPnhtcC5paWQ6RUI4ODgwRjc5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3N0UmVmOmluc3RhbmNlSUQ+CiAgICAgICAgICAgIDxzdFJlZjpkb2N1bWVudElEPnhtcC5kaWQ6RUI4ODgwRjg5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3N0UmVmOmRvY3VtZW50SUQ+CiAgICAgICAgIDwveG1wTU06RGVyaXZlZEZyb20+CiAgICAgICAgIDx4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ+eG1wLmRpZDpFQjg4ODBGQTk4MEMxMUU2ODEzQkNFQUUzMTE0QTgwMzwveG1wTU06T3JpZ2luYWxEb2N1bWVudElEPgogICAgICAgICA8eG1wTU06SGlzdG9yeT4KICAgICAgICAgICAgPHJkZjpTZXE+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPnNhdmVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6ZmEwMTdlZjYtMTQ3Ny00ZDJiLWJiOGUtZGFjMjc5ZjVhOGI4PC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE2LTExLTAxVDExOjA5OjAyKzA3OjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgMjAxNS41IChNYWNpbnRvc2gpPC9zdEV2dDpzb2Z0d2FyZUFnZW50PgogICAgICAgICAgICAgICAgICA8c3RFdnQ6Y2hhbmdlZD4vPC9zdEV2dDpjaGFuZ2VkPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgPC9yZGY6U2VxPgogICAgICAgICA8L3htcE1NOkhpc3Rvcnk+CiAgICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2UvcG5nPC9kYzpmb3JtYXQ+CiAgICAgICAgIDxwaG90b3Nob3A6Q29sb3JNb2RlPjI8L3Bob3Rvc2hvcDpDb2xvck1vZGU+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgICAgIDx0aWZmOlhSZXNvbHV0aW9uPjcyMDAwMC8xMDAwMDwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+NzIwMDAwLzEwMDAwPC90aWZmOllSZXNvbHV0aW9uPgogICAgICAgICA8dGlmZjpSZXNvbHV0aW9uVW5pdD4yPC90aWZmOlJlc29sdXRpb25Vbml0PgogICAgICAgICA8ZXhpZjpDb2xvclNwYWNlPjY1NTM1PC9leGlmOkNvbG9yU3BhY2U+CiAgICAgICAgIDxleGlmOlBpeGVsWERpbWVuc2lvbj4zMjwvZXhpZjpQaXhlbFhEaW1lbnNpb24+CiAgICAgICAgIDxleGlmOlBpeGVsWURpbWVuc2lvbj4zMjwvZXhpZjpQaXhlbFlEaW1lbnNpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8P3hwYWNrZXQgZW5kPSJ3Ij8+o3IIbAAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAADAFBMVEX///////8CAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6Pj4+QkJCRkZGSkpKTk5OUlJSVlZWWlpaXl5eYmJiZmZmampqbm5ucnJydnZ2enp6fn5+goKChoaGioqKjo6OkpKSlpaWmpqanp6eoqKipqamqqqqrq6usrKytra2urq6vr6+wsLCxsbGysrKzs7O0tLS1tbW2tra3t7e4uLi5ubm6urq7u7u8vLy9vb2+vr6/v7/AwMDBwcHCwsLDw8PExMTFxcXGxsbHx8fIyMjJycnKysrLy8vMzMzNzc3Ozs7Pz8/Q0NDR0dHS0tLT09PU1NTV1dXW1tbX19fY2NjZ2dna2trb29vc3Nzd3d3e3t7f39/g4ODh4eHi4uLj4+Pk5OTl5eXm5ubn5+fo6Ojp6enq6urr6+vs7Ozt7e3u7u7v7+/w8PDx8fHy8vLz8/P09PT19fX29vb39/f4+Pj5+fn6+vr7+/v8/Pz9/f3+/v7///9BN/q1AAAAAnRSTlP/AOW3MEoAAABySURBVHjanJNHEsAwCAPF/z+dSwpFZCfhZnltuuI0hbdLl/QOhBbkERciaZ7IkiWK4ogqGKKdJzEedGL6bIQJuxIu80LY4mXC1z8RWw9vQgFf/HJBQVKaVCgqNXUT5oEmimaSppr2gjZru/+yvMv6HwMAUVYDjKwj6zsAAAAASUVORK5CYII=">', a += "</div></div></a>", t += a + "</div>", C += t
    }
    g.html(C)
   }
  }
 };
 A.default = C
}, function(g, A, I) {
 "use strict";

 function C(g, A) {
  if (!(g instanceof A)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var e = function() {
   function g(g, A) {
    for (var I = 0; I < A.length; I++) {
     var C = A[I];
     C.enumerable = C.enumerable || !1, C.configurable = !0, "value" in C && (C.writable = !0), Object.defineProperty(g, C.key, C)
    }
   }
   return function(A, I, C) {
    return I && g(A.prototype, I), C && g(A, C), A
   }
  }(),
  n = function() {
   function g() {
    C(this, g), this.$section = $(".home__featured-companies"), this.$wrapper = $("#ads_TOP_COMPANIES_HORISONTAL"), this.exec_request()
   }
   return e(g, [{
    key: "exec_request",
    value: function() {
     var g = "undefined" != typeof bannerSettings && !!bannerSettings.vipLogosURL,
      A = g ? bannerSettings.vipLogosURL : "test3.php",
      I = this,
      C = (this.$section, this.$wrapper);
     I.display_animation(C, !0), console.log("Loading VIP logos..."), jQuery.ajax({
      url: A,
      success: function(g) {
       if (I.display_animation(C, !1), 200 !== g.code) return console.info("Code !== 200, will not render VIP logos"), void console.info("Data retrieved:", g);
       HOME_AB_TESTING && "B" === HOME_AB_TESTING ? I.render_ads_new(C, g.data.result) : I.render_ads(C, g.data.result)
      },
      error: function(g) {
       console.error("VIP Logo ERROR:", g)
      },
      complete: function() {
       console.log("Complete loading VIP logos."), $(I).trigger("dataRetrieved")
      }
     })
    }
   }, {
    key: "display_animation",
    value: function(g, A) {
     if (!A) return void g.empty();
     g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
    }
   }, {
    key: "render_ads",
    value: function(g, A) {
     var I = A.length;
     if (!(I <= 0)) {
      for (var C = '<div class="animated fadeIn">', e = 0; e < I; e++) {
       var n = A[e],
        t = '<div class="col-md-2 col-sm-2 col-xs-4">',
        a = n.destinationURL;
       a = a.replace("http://www.yteviec.com", "//www.yteviec.com"), a = a.replace("http://yteviec.com", "//www.yteviec.com"), a = a.replace("https://yteviec.com", "//www.yteviec.com");
       a += a.indexOf("?") > -1 ? "&utm_term=VA" : "?utm_term=VA", t += '<a class="single-bnr" target="_blank" href="' + a + '">', t += '<img class="salesLogoImage" src="' + n.imageURL + '" width="88" height="43">', t += '<span class="ad-slogan">' + n.slogan + "</span></a></div>", C += t
      }
      C += "</div>", g.html(C)
     }
    }
   }, {
    key: "render_ads_new",
    value: function(g, A) {
     if (A.length <= 0) return void console.info("length <= 0, will not render");
     var I = function(g) {
       var A = g.destinationURL,
        I = g.imageURL,
        C = g.is_new_posted_job,
        e = g.new_job_label,
        n = g.slogan,
        t = C ? '<span class="new-job-tag flex-center-xy">' + e + "</span>" : "";
       return A = A.replace("http://www.yteviec.com", "//www.yteviec.com"), A = A.replace("http://yteviec.com", "//www.yteviec.com"), A = A.replace("https://yteviec.com", "//www.yteviec.com"), '\n            <div class="col-md-2 col-sm-4 col-xs-6">\n                <a class="single-bnr" target="_blank"\n                   href="' + (A += A.indexOf("?") > -1 ? "&utm_term=VB" : "?utm_term=VB") + '">\n                    <div class="logo-box flex-center-y">\n                        <img class="salesLogoImage" src="' + I + '"\n                             width="88" height="43">\n                             ' + t + '\n                    </div>\n                    <span class="ad-slogan">' + n + "</span>\n                </a>\n            </div>\n            "
      },
      C = A.slice(0, 6).map(function(g) {
       return I(g)
      }).join(""),
      e = 2 === language ? "Featured Companies" : "Các Công Ty Hàng Đầu",
      n = "\n          <h1>" + e + '</h1>\n          <div class="animated fadeIn">\n            ' + C + "\n          </div>\n        ";
     g.html(n)
    }
   }]), g
  }();
 A.default = n
}, function(g, A, I) {
 "use strict";

 function C(g, A) {
  if (!(g instanceof A)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var e = function() {
   function g(g, A) {
    for (var I = 0; I < A.length; I++) {
     var C = A[I];
     C.enumerable = C.enumerable || !1, C.configurable = !0, "value" in C && (C.writable = !0), Object.defineProperty(g, C.key, C)
    }
   }
   return function(A, I, C) {
    return I && g(A.prototype, I), C && g(A, C), A
   }
  }(),
  n = function() {
   function g() {
    C(this, g), this.$section = $(".home__other-employers"), this.$logoList = this.$section.find(".logo-list"), this.getFeaturedCompanies()
   }
   return e(g, [{
    key: "getFeaturedCompanies",
    value: function() {
     var g = this,
      A = "undefined" != typeof HOME_AB_TESTING && "B" === HOME_AB_TESTING,
      I = A ? 12 : 14,
      C = "undefined" != typeof bannerSettings && !!bannerSettings.featureCompanyURL,
      e = C ? bannerSettings.featureCompanyURL : "vclick/index.php?group=common&zone=3&limit=" + I;
     $.ajax({
      method: "GET",
      type: "GET",
      url: e,
      success: function(I) {
       if (200 === I.code) {
        var C = I.data.result;
        if (A) g.render(C);
        else {
         var e = jQuery("#ads_TOP_COMPANIES");
         g.renderOldAds(e, C)
        }
       } else console.log("Company Spotlight: Code !== 200; Data retrieved:", I)
      },
      error: function(g) {
       console.error("Featured Company ERROR:", g)
      }
     })
    }
   }, {
    key: "renderOldAds",
    value: function(g, A) {
     var I = A.length;
     if (0 === I) return void console.info("Featured Employers: length === 0, will not render");
     for (var C = '<div id="adc_TOP_COMPANIES" class="animated fadeIn">', e = 0; e < I; e++) {
      var n = A[e],
       t = "",
       a = n.destinationURL;
      a = a.replace("http://www.yteviec.com", "//www.yteviec.com"), a = a.replace("http://yteviec.com", "//www.yteviec.com"), a = a.replace("https://yteviec.com", "//www.yteviec.com"), t += '<a class="cusLogo" target="_blank" href="' + a + '">', t += '<img class="salesLogoImage img-responsive" src="' + n.imageURL + '" width="88" height="43">', t += "</a>", C += t
     }
     C += "</div>", g.html(C)
    }
   }, {
    key: "render",
    value: function(g) {
     var A = this.$logoList,
      I = this.$section,
      C = 2 === language ? "View all employers →" : "Xem tất cả nhà tuyển dụng →",
      e = 2 === language ? "/featured-employers" : "/nha-tuyen-dung-hang-dau",
      n = function(g, A) {
       return '\n                <div class="logo col-xs-4 col-md-2">\n                    <a class="box flex-center-xy" href="' + g + '" target="_blank">\n                        <img class="img-responsive" src="' + A + '" alt="Logo">\n                    </a>\n                </div>       \n                '
      },
      t = '\n            <div class="text-right">\n                <a href="' + e + '" class="btn-view-all">\n                    ' + C + "\n                </a>\n            </div>\n        ",
      a = g.map(function(g) {
       var A = g.destinationURL,
        I = g.imageURL;
       return n(A, I)
      }),
      i = a.join("");
     A.html(i), A.after(t), I.removeClass("hidden")
    }
   }]), g
  }();
 A.default = n
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  exec_request: function() {
   var g = jQuery("#ads_ADV_CAMPAIGN");
   C.display_animation(g, !0), console.log("Loading marketing banner..."), jQuery.ajax({
    url: "vclick/index.php?group=common&zone=4",
    success: function(A) {
     C.display_animation(g, !1), 200 == A.code && (C.render_ads(g, A.data.result), C.rotatebanners(g, A.data.rotate_time))
    },
    complete: function() {
     console.log("Complete loading marketing banner."), $(C).trigger("dataRetrieved")
    }
   })
  },
  rotatebanners: function(g, A) {
   g.each(function() {
    var g = $(this),
     I = $(this).find("a:first");
    setInterval(function() {
     var A = g.find("a:visible"),
      C = A.next("a");
     A.hide().promise().done(function() {
      C.length > 0 ? C.css("display", "block") : I.css("display", "block")
     })
    }, A)
   })
  },
  display_animation: function(g, A) {
   if (!A) return void g.empty();
   g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = '<div id="adc_ADV_CAMPAIGN" class="animated fadeIn">', e = 0; e < I; e++) {
     var n = 0 == e ? "" : "display:none",
      t = A[e],
      a = "",
      i = t.destinationURL;
     i = i.replace("http://www.yteviec.com", "//www.yteviec.com"), i = i.replace("http://yteviec.com", "//www.yteviec.com"), i = i.replace("https://yteviec.com", "//www.yteviec.com"), a += '<a style="' + n + '" class="cusLogo" target="_blank" href="' + i + '">', a += '<img class="salesLogoImage img-responsive" src="' + t.imageURL + '" width="940" height="100">', a += "</a>", C += a
    }
    C += "</div>", g.html(C)
   }
  }
 };
 A.default = C
}, function(g, A, I) {
 "use strict";

 function C(g, A) {
  if (!(g instanceof A)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var e = function() {
   function g(g, A) {
    for (var I = 0; I < A.length; I++) {
     var C = A[I];
     C.enumerable = C.enumerable || !1, C.configurable = !0, "value" in C && (C.writable = !0), Object.defineProperty(g, C.key, C)
    }
   }
   return function(A, I, C) {
    return I && g(A.prototype, I), C && g(A, C), A
   }
  }(),
  n = function() {
   function g() {
    C(this, g), this.$section = $(".home__company-spotlight"), this.$companyList = this.$section.find(".company-list"), this.$section.length > 0 ? this.getCompanySpotlightData() : console.info("Company Spotlight Section does not exists, splotlighted companies will not be renderered")
   }
   return e(g, [{
    key: "getCompanySpotlightData",
    value: function() {
     var g = this,
      A = "undefined" != typeof bannerSettings && !!bannerSettings.companySpotlightURL,
      I = A ? bannerSettings.companySpotlightURL : "/vclick/index.php?group=companySpotlight&zone=17";
     $.ajax({
      method: "GET",
      type: "GET",
      url: I,
      success: function(A) {
       if (200 === A.code) {
        var I = A.data.result,
         C = A.data.rotate_time;
        I && I.length ? (g.render(I), I.length > 1 ? g.initCarousel(C) : (g.setHeightForCompanyItem(), console.info("companyListData has only 1 item, will not init the carousel"))) : (console.info("companyListData is `null` or an empty array: ", I), console.info("Company Spotlight will not be rendered"))
       } else console.log("Code !== 200; Data retrieved:", A)
      },
      error: function(g) {
       console.error("Company Spotlight ERROR:", g)
      }
     })
    }
   }, {
    key: "initCarousel",
    value: function(g) {
     this.$companyList.slick({
      dots: !0,
      prevArrow: '\n        <div class="slick-prev slick-arrow">\n            \n         <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 24 24" version="1.1">        \n                <path style=" " d="M 7.75 1.34375 L 6.25 2.65625 L 14.65625 12 L 6.25 21.34375 L 7.75 22.65625 L 16.75 12.65625 L 17.34375 12 L 16.75 11.34375 Z "></path>\n            </svg>\n        \n        </div>\n        ',
      nextArrow: '\n        <div class="slick-next slick-arrow">\n            \n         <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 24 24" version="1.1">        \n                <path style=" " d="M 7.75 1.34375 L 6.25 2.65625 L 14.65625 12 L 6.25 21.34375 L 7.75 22.65625 L 16.75 12.65625 L 17.34375 12 L 16.75 11.34375 Z "></path>\n            </svg>\n        \n        </div>\n        ',
      autoplay: !0,
      autoplaySpeed: g
     });
     var A = this.$section.find(".slick-dots"),
      I = this.$section.find(".slick-next"),
      C = this.$section.find(".slick-prev"),
      e = A.find("li");
     $('<div class="dots"></div>').prependTo(A), C.prependTo(A);
     var n = A.find(".dots");
     e.appendTo(n), I.appendTo(A), console.log("Company spotlight carousel initiated with the rotation time of " + g), this.setHeightForCompanyItem()
    }
   }, {
    key: "setHeightForCompanyItem",
    value: function() {
     this.$companyList.find(".description").dotdotdot({
      height: 85
     })
    }
   }, {
    key: "render",
    value: function(g) {
     var A = this.$companyList,
      I = this.$section,
      C = 2 === language ? "View more" : "Xem thêm",
      e = function(g) {
       var A = g.imageURL,
        I = g.destinationURL;
       return '\n            <div class="company-item" data-rendered="true">\n                <div class="background"\n                     style="background-image: url(' + A + ')">\n                </div>\n                <div class="foreground">\n                    <div class="row">\n                        <div class="col-md-2"></div>\n                        <div class="col-md-8">\n                            <div class="info-container box box-lg">\n                                <div class="row flex-center-xy">\n                                    <div class="col-sm-3 logo">\n                                        <a href="' + I + '" target="_blank">\n                                            <img class="img-responsive"\n                                                 src="' + g.subimageURL + '"\n                                                 alt="logo">\n                                        </a>\n                                    </div>\n                                    <div class="col-sm-9 company-info">\n                                        <a href="' + I + '" target="_blank" class="text-clip"><h2>' + g.comName + '</h2></a>\n                                        <p class="lead text-info"><em class="text-clip">' + g.textLine1 + '</em></p>\n                                        <p class="description">' + g.textLine2 + '</p>\n                                        <a target="_blank" href="' + I + '" class="btn btn-primary btn-outline btn-view-more btn-lg">\n                                            ' + C + '\n                                        </a>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class="col-md-2"></div>\n                    </div>\n                </div>\n            </div>\n            '
      },
      n = g.map(function(g) {
       return e(g)
      }).join("");
     A.html(n), I.removeClass("hidden"), console.info("Company Spotlight Rendered")
    }
   }]), g
  }();
 A.default = n
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  rotateSquareBanner: function(g, A) {
   g.each(function() {
    var g = $(this),
     I = $(this).find("a:first");
    setInterval(function() {
     var A = g.find("a:visible"),
      C = A.next("a");
     A.hide().promise().done(function() {
      C.length > 0 ? C.css("display", "block") : I.css("display", "block")
     })
    }, A)
   })
  },
  exec_request: function() {
   var g = $("#ads_ADV_HOME_1");
   C.display_animation(g, !0), console.log("Loading Square Banner 1..."), $.ajax({
    url: "vclick/index.php?group=common&zone=5",
    success: function(A) {
     if (C.display_animation(g, !1), 200 != A.code) return void g.remove();
     C.render_ads(g, A.data.result), C.rotateSquareBanner(g, A.data.rotate_time)
    }
   })
  },
  display_animation: function(g, A) {
   if (!A) return void g.empty();
   g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = '<div class="animated fadeIn" id="adc_ADV_HOME_1" pan_timer="15" align="center" border="0" cellpadding="0" cellspacing="0">', e = 0; e < I; e++) {
     var n = 0 == e ? "" : "hidden",
      t = A[e],
      a = "",
      i = t.destinationURL;
     i = i.replace("http://www.yteviec.com", "//www.yteviec.com"), i = i.replace("http://yteviec.com", "//www.yteviec.com"), i = i.replace("https://yteviec.com", "//www.yteviec.com"), a += "<a " + n + ' class="cusLogo" target="_blank" href="' + i + '">', a += '<img class="salesLogoImage img-responsive" src="' + t.imageURL + '" width="234" height="234">', a += "</a>", C += a
    }
    C += "</div>", g.html(C)
   }
  }
 };
 A.default = C
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  rotateSquareBanner: function(g, A) {
   g.each(function() {
    var g = $(this),
     I = $(this).find("a:first");
    setInterval(function() {
     var A = g.find("a:visible"),
      C = A.next("a");
     A.hide().promise().done(function() {
      C.length > 0 ? C.css("display", "block") : I.css("display", "block")
     })
    }, A)
   })
  },
  exec_request: function() {
   var g = $("#ads_ADV_HOME_2");
   C.display_animation(g, !0), console.log("Loading Square Banner 2..."), $.ajax({
    url: "vclick/index.php?group=common&zone=6",
    success: function(A) {
     if (C.display_animation(g, !1), 200 != A.code) return void g.remove();
     C.render_ads(g, A.data.result), C.rotateSquareBanner(g, A.data.rotate_time)
    }
   })
  },
  display_animation: function(g, A) {
   if (!A) return void g.empty();
   g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = '<div class="animated fadeIn" id="adc_ADV_HOME_2" pan_timer="15" align="center" border="0" cellpadding="0" cellspacing="0">', e = 0; e < I; e++) {
     var n = 0 == e ? "" : "hidden",
      t = A[e],
      a = "",
      i = t.destinationURL;
     i = i.replace("http://www.yteviec.com", "//www.yteviec.com"), i = i.replace("http://yteviec.com", "//www.yteviec.com"), i = i.replace("https://yteviec.com", "//www.yteviec.com"), a += "<a " + n + ' class="cusLogo" target="_blank" href="' + i + '">', a += '<img class="salesLogoImage img-responsive" src="' + t.imageURL + '" width="234" height="234">', a += "</a>", C += a
    }
    C += "</div>", g.html(C)
   }
  }
 };
 A.default = C
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  rotateSquareBanner: function(g, A) {
   g.each(function() {
    var g = $(this),
     I = $(this).find("a:first");
    setInterval(function() {
     var A = g.find("a:visible"),
      C = A.next("a");
     A.hide().promise().done(function() {
      C.length > 0 ? C.css("display", "block") : I.css("display", "block")
     })
    }, A)
   })
  },
  exec_request: function() {
   var g = $("#ads_ADV_HOME_3");
   C.display_animation(g, !0), console.log("Loading Square Banner 3..."), $.ajax({
    url: "vclick/index.php?group=common&zone=7",
    success: function(A) {
     if (C.display_animation(g, !1), 200 != A.code) return void g.remove();
     C.render_ads(g, A.data.result), C.rotateSquareBanner(g, A.data.rotate_time)
    }
   })
  },
  display_animation: function(g, A) {
   if (!A) return void g.empty();
   g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = '<div class="animated fadeIn" id="adc_ADV_HOME_3" pan_timer="15" align="center" border="0" cellpadding="0" cellspacing="0">', e = 0; e < I; e++) {
     var n = 0 == e ? "" : "hidden",
      t = A[e],
      a = "",
      i = t.destinationURL;
     i = i.replace("http://www.yteviec.com", "//www.yteviec.com"), i = i.replace("http://yteviec.com", "//www.yteviec.com"), i = i.replace("https://yteviec.com", "//www.yteviec.com"), a += "<a " + n + ' class="cusLogo" target="_blank" href="' + i + '">', a += '<img class="salesLogoImage img-responsive" src="' + t.imageURL + '" width="234" height="234">', a += "</a>", C += a
    }
    C += "</div>", g.html(C)
   }
  }
 };
 A.default = C
}, function(g, A, I) {
 "use strict";
 Object.defineProperty(A, "__esModule", {
  value: !0
 });
 var C = {
  rotateSquareBanner: function(g, A) {
   g.each(function() {
    var g = $(this),
     I = $(this).find("a:first");
    setInterval(function() {
     var A = g.find("a:visible"),
      C = A.next("a");
     A.hide().promise().done(function() {
      C.length > 0 ? C.css("display", "block") : I.css("display", "block")
     })
    }, A)
   })
  },
  exec_request: function() {
   var g = $("#ads_ADV_HOME_4");
   C.display_animation(g, !0), console.log("Loading Square Banner 4..."), $.ajax({
    url: "vclick/index.php?group=common&zone=8",
    success: function(A) {
     if (C.display_animation(g, !1), 200 != A.code) return void g.remove();
     C.render_ads(g, A.data.result), C.rotateSquareBanner(g, A.data.rotate_time)
    }
   })
  },
  display_animation: function(g, A) {
   if (!A) return void g.empty();
   g.html('<div class="text-center m-t-md m-b-md"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>')
  },
  render_ads: function(g, A) {
   var I = A.length;
   if (!(I <= 0)) {
    for (var C = '<div class="animated fadeIn" id="adc_ADV_HOME_4" pan_timer="15" align="center" border="0" cellpadding="0" cellspacing="0">', e = 0; e < I; e++) {
     var n = 0 == e ? "" : "hidden",
      t = A[e],
      a = "",
      i = t.destinationURL;
     i = i.replace("http://www.yteviec.com", "//www.yteviec.com"), i = i.replace("http://yteviec.com", "//www.yteviec.com"), i = i.replace("https://yteviec.com", "//www.yteviec.com"), a += "<a " + n + ' class="cusLogo" target="_blank" href="' + i + '">', a += '<img class="salesLogoImage img-responsive" src="' + t.imageURL + '" width="234" height="234">', a += "</a>", C += a
    }
    C += "</div>", g.html(C)
   }
  }
 };
 A.default = C
}]).default;
//# sourceMappingURL=bnr.js.map