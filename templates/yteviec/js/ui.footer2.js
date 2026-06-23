var $jscomp = {
    scope: {},
    findInternal: function(a, c, b) {
        a instanceof String && (a = String(a));
        for (var d = a.length, e = 0; e < d; e++) {
            var f = a[e];
            if (c.call(b, f, e, a)) return {
                i: e,
                v: f
            }
        }
        return {
            i: -1,
            v: void 0
        }
    }
};
$jscomp.defineProperty = "function" == typeof Object.defineProperties ? Object.defineProperty : function(a, c, b) {
    if (b.get || b.set) throw new TypeError("ES3 does not support getters and setters.");
    a != Array.prototype && a != Object.prototype && (a[c] = b.value)
};
$jscomp.getGlobal = function(a) {
    return "undefined" != typeof window && window === a ? a : "undefined" != typeof global && null != global ? global : a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(a, c, b, d) {
    if (c) {
        b = $jscomp.global;
        a = a.split(".");
        for (d = 0; d < a.length - 1; d++) {
            var e = a[d];
            e in b || (b[e] = {});
            b = b[e]
        }
        a = a[a.length - 1];
        d = b[a];
        c = c(d);
        c != d && null != c && $jscomp.defineProperty(b, a, {
            configurable: !0,
            writable: !0,
            value: c
        })
    }
};
$jscomp.polyfill("Array.prototype.find", function(a) {
    return a ? a : function(a, b) {
        return $jscomp.findInternal(this, a, b).v
    }
}, "es6-impl", "es3");
$(function() {
    ({
        initSelect2: function() {
            $(".select-location-2, .benhvien, .phongkham, .congtyyte, .timtruongyvacosoytekhac, .select-category").each(function() {
                var a = $(this),
                    c = 768 > $("body").outerWidth();
                $(this).select2({
                    width: "100%",
                    adaptContainerCssClass: function(a) {
                        return null
                    },
                    maximumSelectionSize: 2,
                    doNotFocusInput: c,
                    dropdownCssClass: "select2-drop_full-screen",
                    searchInputPlaceholder: a.data("search-input-placeholder")
                }).select2FullScreen()
            })
        },
        initClearKeywordBtn: function() {
            var a = $(".clear-keyword"),
                c = $("#keywordMainSearch"),
                b = function() {
                    $.trim(c.val()) ? a.show() :
                        a.hide()
                };
            b();
            $(".search-form").on("change keyup", "#keywordMainSearch", function() {
                b()
            }).on("click", ".clear-keyword", function() {
                var a = c.data("ttTypeahead");
                a.input.query = "";
                c.data(a);
                c.val("");
                $(this).hide()
            })
        },
        makeKeywordDropdownFullScreen: function() {
            if (768 > $("body").width()) $("#keywordMainSearch").on("typeahead:opened", function() {
                $(".keyword-search").addClass("opened");
                $("html,body").css({
                    overflow: "hidden"
                });
                $(".twitter-typeahead").prepend('<span class="keywordMainSearch__background"><span>');
                $("#search-widget").find(".tt-dropdown-menu").css({
                    width: $("body").width(),
                    height: $(window).height()
                });
                $(window).resize(function() {
                    $("#search-widget").find(".tt-dropdown-menu").height($(window).height())
                });
                var a = $(".search-tabs").offset().top - 15;
                $("body,html").animate({
                    scrollTop: a
                }, 200)
            }).on("typeahead:closed", function() {
                $(".keyword-search").removeClass("opened");
                $("html,body").css({
                    overflow: "auto"
                });
                $(".keywordMainSearch__background").remove()
            })
        },
        initToggleMoreJobsOnLogOutPage: function() {
            var a = $(".page-logged-out__loving-jobs");
            a.find(".view-more").click(function() {
                a.find(".hidden-xs").fadeIn("fast").removeClass("hidden-xs");
                a.find(".view-more").closest(".row").fadeOut("fast").removeClass("visible-xs")
            })
        },
        init: function() {
            this.initSelect2();
            this.initClearKeywordBtn();
            this.makeKeywordDropdownFullScreen();
            this.initToggleMoreJobsOnLogOutPage()
        }
    }).init()
}); //# sourceMappingURL=./ui.footer.min.js.map