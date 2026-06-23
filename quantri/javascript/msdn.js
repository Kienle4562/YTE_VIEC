if (typeof MTPS === "undefined") MTPS = {};
MTPS.Utility = {
    addListener: function (obj, eventName, listener) {
        if (obj.addEventListener) obj.addEventListener(eventName, listener, false);
        else obj.attachEvent("on" + eventName, listener)
    },
    removeListener: function (obj, eventName, listener) {
        if (obj.addEventListener) obj.removeEventListener(eventName, listener, false);
        else obj.detachEvent("on" + eventName, listener)
    },
    addOnloadEvent: function (func) {
        MTPS.Utility.addListener(window, "load", func)
    },
    getThisElement: function (elem, e) {
        if (elem.getAttribute) return elem;
        else return e.srcElement
    },
    cancelAnchorNavigation: function (anchor) {
        anchor.setAttribute("href", "javascript:void(0)")
    },
    replaceAnchorNavWithClick: function (anchor, func) {
        MTPS.Utility.addListener(anchor, "click", func);
        MTPS.Utility.cancelAnchorNavigation(anchor)
    },
    limitText: function (e) {
        var currentField = MTPS.Utility.getThisElement(this, e),
            maxlength = currentField.getAttribute("data-maxlength");
        if (currentField.value.length > maxlength) currentField.value = currentField.value.substring(0, maxlength)
    },
    isCurrentPage: function (pathname) {
        if (pathname.substring(1, 0) !== "/") pathname = "/" + pathname;
        return pathname === window.location.pathname
    },
    loadJS: function (url, callback) {
        var script = document.createElement("script");
        script.src = url;
        document.body.appendChild(script);
        script.onload = script.onreadystatechange = script.onerror = function () {
            if (script && script.readyState && /^(?!(?:loaded|complete)$)/.test(script.readyState)) return;
            if (callback) callback()
        }
    },
    isHighContrast: function () {
        var elem = document.getElementById("HCColorTest");
        if (elem) {
            elem.style.color = "#ff00ff";
            if (window.getComputedStyle) {
                var textcolor = window.getComputedStyle(elem, null).color;
                if (textcolor != "rgb(255, 0, 255)" && textcolor != "#ff00ff") return true
            } else if (elem.currentStyle) if (elem.currentStyle.color != "#ff00ff") return true
        }
        return false
    },
    SupportsHTML5: function () {
        return !(typeof localStorage === "undefined" || typeof JSON === "undefined")
    },
    SetCookie: function (name, value, expires, path, domain, secure) {
        var today = new Date;
        today.setTime(today.getTime());
        if (expires) expires = expires * 1000 * 60 * 60 * 24;
        var expires_date = new Date(today.getTime() + expires);
        document.cookie = name + "=" + escape(value) + (expires ? ";expires=" + expires_date.toGMTString() : "") + (path ? ";path=" + path : "") + (domain ? ";domain=" + domain : "") + (secure ? ";secure" : "")
    },
    GetCookie: function (sName, defaultValue) {
        var i, aCookie = document.cookie.split("; ");
        for (i = 0; i < aCookie.length; i++) {
            var aCrumb = aCookie[i].split("=");
            if (sName === aCrumb[0]) return unescape(aCrumb[1])
        }
        return defaultValue
    }
};
MTPS.Utility.addOnloadEvent(function () {
    if (MTPS.Watermarks) {
        var wm = MTPS.Watermarks;
        for (var ct in wm) if (wm.hasOwnProperty(ct)) {
            var ob = wm[ct],
                tb = document.getElementById(ob.control);
            if (tb) {
                tb.WaterMarkText = ob.defaultValue;
                tb.focusCSS = ob.focusCSS;
                tb.defaultCSS = ob.defaultCSS;
                MTPS.WaterMark.blur.call(tb);
                MTPS.Utility.addListener(tb, "focus", function (e) {
                    MTPS.WaterMark.focus.call(tb, e)
                });
                MTPS.Utility.addListener(tb, "drop", function (e) {
                    MTPS.WaterMark.focus.call(tb, e)
                });
                MTPS.Utility.addListener(tb, "keydown", function (e) {
                    if (!e) e = window.event;
                    e.cancelBubble = true;
                    if (e.stopPropagation) e.stopPropagation()
                });
                MTPS.Utility.addListener(tb, "blur", function (e) {
                    MTPS.WaterMark.blur.call(tb, e)
                })
            }
        }
    }
});
MTPS.Utility.addOnloadEvent(function () {
    var feedbackText = document.getElementById("feedbackText");
    if (feedbackText) MTPS.Utility.addListener(feedbackText, "keydown", function (e) {
        if (!e) e = window.event;
        e.cancelBubble = true;
        if (e.stopPropagation) e.stopPropagation()
    })
});
MTPS.ResizeAbleToc = {
    tocPositionWidth: [0, 280, 380, 480],
    tocPosition: 1,
    toc: null,
    TocResize: null,
    ResizeImageIncrease: null,
    ResizeImageReset: null,
    init: function () {
        if (document.getElementById("Navigation")) {
            this.tocPosition = MTPS.Utility.GetCookie("TocPosition", 1);
            this.toc = document.getElementById("Navigation").style;
            this.TocResize = document.getElementById("TocResize").style;
            this.ResizeImageIncrease = document.getElementById("ResizeImageIncrease").style;
            this.ResizeImageReset = document.getElementById("ResizeImageReset").style;
            if (this.toc.width != this.tocPositionWidth[this.tocPosition] + "px") this.resizeToc(this.tocPositionWidth[this.tocPosition])
        }
    },
    getNextPosition: function () {
        this.tocPosition++;
        if (this.tocPosition > this.tocPositionWidth.length - 1) this.tocPosition = 0;
        MTPS.Utility.SetCookie("TocPosition", this.tocPosition, 365, "/", ".microsoft.com", null);
        return this.tocPositionWidth[this.tocPosition]
    },
    checkForTPressed: function (evt) {
        evt = evt ? evt : event ? event : null;
        if (evt) if (evt.keyCode === 84) {
            var target = evt.srcElement != null ? evt.srcElement : evt.target;
            if (target.tagName.toLowerCase() == "input" || target.tagName.toLowerCase() == "textarea" || evt.ctrlKey || evt.altKey) return;
            MTPS.ResizeAbleToc.onIncreaseToc.apply(MTPS.ResizeAbleToc)
        }
    },
    onIncreaseToc: function () {
        if (this.toc === null) this.init();
        var pos = this.getNextPosition();
        this.resizeToc(pos)
    },
    resizeToc: function (tocWidth) {
        if (this.toc) {
            var tocelementstyle = this.toc;
            tocelementstyle.width = tocWidth + "px";
            if (tocWidth === 0) window.setTimeout(function () {
                tocelementstyle.display = "none"
            }, 0);
            else tocelementstyle.display = "block";
            this.TocResize.left = tocWidth + "px";
            this.ResizeImageIncrease.display = this.tocPosition == this.tocPositionWidth.length - 1 ? "none" : "";
            this.ResizeImageReset.display = this.tocPosition != this.tocPositionWidth.length - 1 ? "none" : ""
        }
    }
};
MTPS.Utility.addOnloadEvent(function () {
    var tocResize = document.getElementById("TocResize");
    if (tocResize) {
        MTPS.ResizeAbleToc.init();
        var resizeContainer = document.getElementById("tocResizeContainer");
        if (resizeContainer) {
            resizeContainer.style.visibility = "visible";
            MTPS.Utility.replaceAnchorNavWithClick(tocResize, function (e) {
                MTPS.ResizeAbleToc.onIncreaseToc(e)
            });
            MTPS.Utility.addListener(document, "keydown", function (e) {
                MTPS.ResizeAbleToc.checkForTPressed(e)
            })
        }
    }
});