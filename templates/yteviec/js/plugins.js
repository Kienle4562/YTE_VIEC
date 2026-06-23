function ltrim(t) {
 return t.replace(/^\s */, "")
}

function rtrim(t) {
 return t.replace(/\s *$/, "")
}

function trim(t) {
 return ltrim(rtrim(t))
}

function errorAlert(t, e) {
 return objErr = document.getElementById("err_top"), null != objErr && (objErr.style.display = ""), null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "", !1
}

function errorAlertOff(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none"
}

function checkRequired(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return "" != trim(t.value) || errorAlert(t, e)
}

function jqCheckRequired(t, e) {
 return null == e && (e = "err_" + t.attr("id")), "" == trim(t.val()) ? ($("#" + e).removeClass("hide"), !1) : ($("#" + e).addClass("hide"), !0)
}

function showFieldError(t) {
 document.getElementById(t).style.display = "";
 var e = document.getElementById("err_top");
 null != e && (e.style.display = "")
}

function hideFieldError(t) {
 document.getElementById(t).style.display = "none"
}

function _checkTime(t) {
 var e = trim(t),
  n = e.indexOf(":");
 if (n < 0) return !1;
 var i = e.substr(0, n),
  r = e.substr(n + 1);
 return !!_checkInt(i) && (!!_checkInt(r) && (h = i.valueOf(), m = r.valueOf(), !(h < 0 || h > 23) && !(m < 0 || m > 59)))
}

function checkTime(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkTime(trim(t.value)) || errorAlert(t, e)
}

function _checkDate(t) {
 var e = trim(t),
  n = e.indexOf("/");
 if (n < 0) return !1;
 var i = e.indexOf("/", n + 1);
 if (i < 0) return !1;
 var r = e.substr(0, n),
  s = e.substr(n + 1, i - (n + 1)),
  o = e.substr(i + 1);
 if (!_checkInt(s)) return !1;
 if (!_checkInt(r)) return !1;
 if (!_checkInt(o)) return !1;
 if (d = s.valueOf(), m = r.valueOf(), y = o.valueOf(), m < 1 || m > 12) return !1;
 if (y < 1) return !1;
 var a = y % 4 == 0 && y % 100 != 0 || y % 400 == 0,
  l = 0;
 return l = 31, 4 != m && 6 != m && 9 != m && 11 != m || (l = 30), 2 == m && (l = a ? 29 : 28), !(s.valueOf() < 1 || s.valueOf() > l)
}

function checkDate(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkDate(trim(t.value)) || errorAlert(t, e)
}

function dateUTC(t) {
 s = trim(t);
 var e = s.indexOf("/"),
  n = s.indexOf("/", e + 1),
  i = s.substr(0, e),
  r = s.substr(e + 1, n - (e + 1)),
  o = s.substr(n + 1);
 return Date.UTC(o, i - 1, r)
}

function lessDate(t, e) {
 return dateUTC(t) < dateUTC(e)
}

function _checkInt(t) {
 var e = trim(t);
 if (e.length < 1 || "" == e) return !1;
 for (i = 0; i < e.length; i++)
  if (ch = e.charAt(i), "0123456789".indexOf(ch) < 0) return !1;
 return !(e.valueOf() <= 0)
}

function checkInt(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkInt(trim(t.value)) || errorAlert(t, e)
}

function _checkIntHaveZero(t) {
 var e = trim(t);
 if (e.length < 1 || "" == e) return !1;
 for (i = 0; i < e.length; i++)
  if (ch = e.charAt(i), "0123456789".indexOf(ch) < 0) return !1;
 return !(e.valueOf() < 0)
}

function checkIntHaveZero(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return 0 != _checkIntHaveZero(trim(t.value)) || errorAlert(t, e)
}

function _checkRange(t, e, n) {
 var i = trim(t);
 if (!_checkInt(i)) return !1;
 var r = i.valueOf();
 return r >= e && r <= n
}

function checkRange(t, e, n, i) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkRange(trim(t.value), n, i) || errorAlert(t, e)
}

function _checkDouble(t) {
 var e = trim(t);
 if (e.length < 1) return !1;
 for (i = 0; i < e.length; i++)
  if (ch = e.charAt(i), "0123456789.".indexOf(ch) < 0) return !1;
 return e.indexOf(".") == e.lastIndexOf(".")
}

function checkDouble(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkDouble(trim(t.value)) || errorAlert(t, e)
}

function _checkPhone(t) {
 var e = trim(t);
 if (e.length < 1) return !1;
 for (i = 0; i < e.length; i++)
  if (ch = e.charAt(i), "0123456789-+() ".indexOf(ch) < 0) return !1;
 return !0
}

function checkPhone(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkPhone(trim(t.value)) || errorAlert(t, e)
}

function _checkMultiPhone(t) {
 var e = trim(t);
 if (e.length < 1) return !1;
 for (i = 0; i < e.length; i++)
  if (ch = e.charAt(i), "0123456789-+()/ ".indexOf(ch) < 0) return !1;
 return !0
}

function checkMultiPhone(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkMultiPhone(trim(t.value)) || errorAlert(t, e)
}

function checkHaveEmailEditor(t, e) {
 objErr = document.getElementById("err_" + e), objErr.style.display = "none", t = t.replace(/[\s|\||\,|\;|\:]+/gi, " "), arr = t.split(" ");
 for (var n = 0; n < arr.length; n++)
  if (s1 = trim(arr[n]), _checkAtsign(s1)) return !0
}

function _checkAtsign(t) {
 return new RegExp("@").exec(t)
}

function _checkEmail(t) {
 return new RegExp("^[_a-zA-Z0-9-]+(\\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\\.[a-zA-Z0-9-]+)*(\\.[a-zA-Z]{2,8})$").exec(t)
}

function checkEmail(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkEmail(trim(t.value)) || errorAlert(t, e)
}

function _checkEmailArray(t) {
 var e = trim(t);
 if (e.indexOf(";") < 0 && e.indexOf(",") < 0) return _checkEmail(e);
 var n, i = "";
 n = e.indexOf(";") > -1 ? e.split(";") : e.split(",");
 for (var r = 0; r < n.length; r++)
  if (i = trim(n[r]), !_checkEmailArray(i)) return !1;
 return !0
}

function checkEmailArray(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 var n = trim(t.value),
  i = n.charAt(n.length - 1);
 return ";" != i && "," != i || (n = n.substr(0, n.length - 1)), !!_checkEmailArray(n) || errorAlert(t, e)
}

function _checkUpFile(t) {
 var e = new Array("doc", "html", "htm", "pdf", "txt", "ppt", "dat", "avi", "mp3"),
  n = t.value.substr(t.value.lastIndexOf(".") + 1, t.value.length),
  r = !1;
 for (i = 0; i < e.length; i++)
  if (n.toUpperCase() == e[i].toUpperCase()) r = !0;
 return 0 != r || (alert("Invalid file extension ." + n + "!"), !1)
}

function checkUpFile(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkUpFile(trim(t.value)) || errorAlert(t, e)
}

function getCheckBoxIDs(t, e) {
 var n = "";
 for (i = 0; i < t.elements.length; i++) t.elements[i].name == e && t.elements[i].checked && (n += "," + t.elements[i].value);
 return n.length > 0 && (n = n.substr(1)), n
}

function getListBoxIDs(t) {
 var e = "";
 for (i = 0; i < t.length; i++) t.options[i].selected && (e += "," + t.options[i].value);
 return e.length > 0 && (e = e.substr(1)), e
}

function setListBoxIDs(t, e) {
 var n, r = "," + e + ",";
 for (i = 0; i < t.length; i++) n = "," + t.options[i].value + ",", r.indexOf(n) > -1 && (t.options[i].selected = !0)
}

function AddTo(t, e) {
 for (k = 0; k < t.length; k++)
  if (IsExisted = !1, 1 == t.options[k].selected) {
   for (stext = t.options[k].text, svalue = t.options[k].value, i = 0; i < e.length; i++)
    if (svalue == e.options[i].value) {
     IsExisted = !0;
     break
    }
   if (0 == IsExisted) {
    var n = new Option(stext, svalue);
    j = e.length, e.options[j] = n
   }
  }
}

function RemoveFrom(t) {
 for (k = t.length - 1; k > -1; k--) t.options[k].selected && (t.options[k] = null)
}

function maxLength(t, e) {
 t.value.length > e && (t.value = t.value.substr(0, e))
}

function selectAll(t) {
 for (i = 0; i < t.length; i++) t.options[i].selected = !0
}

function inputFloat(t, e) {
 if ("" == t.value) return !0;
 var n, i, r, s;
 for (r = "H", s = "", n = 0; n < t.value.length; n++) "-" == (i = t.value.charAt(n)) ? 0 == n && 1 == e && (s += i) : "." == i ? "H" == r && (s += i, r = "T") : i >= "0" && i <= "9" && (s += i);
 s.length > 0 && "." == s.charAt(0) && (s = "0" + s), t.value != s && (t.value = s)
}

function inputInt(t, e) {
 if ("" == t.value) return !0;
 var n, i, r;
 for (r = "", n = 0; n < t.value.length; n++) "-" == (i = t.value.charAt(n)) ? 0 == n && 1 == e && (r += i) : i >= "0" && i <= "9" && (r += i);
 t.value != r && (t.value = r)
}

function openWin(t, e, n, i) {
 window.open(t, e, "width=" + n + ",height=" + i + ",scrollbars=yes,toolbar=no,menubar=no,status=no,resizable=no")
}

function _checkText(t) {
 return new RegExp("[^0-9]+$").exec(t)
}

function checkText(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 return !!_checkText(trim(t.value)) || errorAlert(t, e)
}

function checkAllBoxes(t, e, n) {
 if (1 == document.getElementById(t).checked)
  for (i = 0; i < n; i++) {
   0 == (r = document.getElementById(e + i)).disabled && (r.checked = !0)
  } else
   for (i = 0; i < n; i++) {
    var r;
    0 == (r = document.getElementById(e + i)).disabled && (r.checked = !1)
   }
}

function checkBoxes(t, e, n) {
 var r = 0;
 for (i = 0; i < n; i++) {
  1 == document.getElementById(e + i).checked && r++
 }
 var s = document.getElementById(t);
 s.checked = r == n
}

function _checkTextSpecial(t) {
 return new RegExp("[0-9@%#~^*$.]+").exec(t)
}

function checkTextSpecial(t, e) {
 null == e && (e = "err_" + t.name), objErr = document.getElementById(e), objErr.style.display = "none";
 var n = trim(t.value);
 return "" == n ? errorAlert(t, e) : !_checkTextSpecial(n) || errorAlert(t, e)
}

function limiter(t, e, n, i) {
 var r = document.getElementById(t).value,
  s = r.length;
 if (s > i) return r = r.substring(0, i), document.getElementById(t).value = r, !1;
 1 == n ? (dTextPre = "Bạn có thể nhập thêm ", dTextSuf = " ký tự") : (dTextPre = "You have ", dTextSuf = " characters remaining"), $("#" + e).css("display", ""), $("#" + e).removeClass("hide");
 var o = i - s;
 document.getElementById(e).innerHTML = dTextPre + o + dTextSuf
}

function removeHTMLTags(t) {
 return (t = t.replace(/&(lt|gt);/g, function(t, e) {
  return "lt" == e ? "<" : ">"
 })).replace(/<\/?[^>]+(>|$)/g, "")
}

function emailExistsInString(t) {
 var e = (t = (t = removeHTMLTags(t)).replace(/\s+|-|\./g, "")).match(/([a-z0-9_\.\-])+\@\w+[\.\w+]+\b/gi);
 return null != e && e
}

function validateUrl(t) {
 return null != new RegExp("^http(s)*://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&?/.=]+$").exec(t)
}

function phoneExistsInString(t) {
 t = (t = removeHTMLTags(t)).replace(/\s+|-|\./g, "");
 return null != new RegExp("[0-9]{8,12}").exec(t)
}

function phoneExistsInStringSpecialChar(t) {
 t = (t = removeHTMLTags(t)).replace(/\s|\./g, "");
 return null != new RegExp("[0-9]{8,12}").exec(t)
}



function getLogoForJobs(t) {

}! function(t, e) {
 function n(t) {
  var e = t.length,
   n = rt.type(t);
  return !rt.isWindow(t) && (!(1 !== t.nodeType || !e) || ("array" === n || "function" !== n && (0 === e || "number" == typeof e && e > 0 && e - 1 in t)))
 }

 function i(t, n, i, r) {
  if (rt.acceptData(t)) {
   var s, o, a = rt.expando,
    l = t.nodeType,
    c = l ? rt.cache : t,
    u = l ? t[a] : t[a] && a;
   if (u && c[u] && (r || c[u].data) || i !== e || "string" != typeof n) return u || (u = l ? t[a] = J.pop() || rt.guid++ : a), c[u] || (c[u] = l ? {} : {
    toJSON: rt.noop
   }), ("object" == typeof n || "function" == typeof n) && (r ? c[u] = rt.extend(c[u], n) : c[u].data = rt.extend(c[u].data, n)), o = c[u], r || (o.data || (o.data = {}), o = o.data), i !== e && (o[rt.camelCase(n)] = i), "string" == typeof n ? null == (s = o[n]) && (s = o[rt.camelCase(n)]) : s = o, s
  }
 }

 function r(t, e, n) {
  if (rt.acceptData(t)) {
   var i, r, s = t.nodeType,
    a = s ? rt.cache : t,
    l = s ? t[rt.expando] : rt.expando;
   if (a[l]) {
    if (e && (i = n ? a[l] : a[l].data)) {
     rt.isArray(e) ? e = e.concat(rt.map(e, rt.camelCase)) : e in i ? e = [e] : (e = rt.camelCase(e), e = e in i ? [e] : e.split(" ")), r = e.length;
     for (; r--;) delete i[e[r]];
     if (n ? !o(i) : !rt.isEmptyObject(i)) return
    }(n || (delete a[l].data, o(a[l]))) && (s ? rt.cleanData([t], !0) : rt.support.deleteExpando || a != a.window ? delete a[l] : a[l] = null)
   }
  }
 }

 function s(t, n, i) {
  if (i === e && 1 === t.nodeType) {
   var r = "data-" + n.replace(wt, "-$1").toLowerCase();
   if ("string" == typeof(i = t.getAttribute(r))) {
    try {
     i = "true" === i || "false" !== i && ("null" === i ? null : +i + "" === i ? +i : xt.test(i) ? rt.parseJSON(i) : i)
    } catch (t) {}
    rt.data(t, n, i)
   } else i = e
  }
  return i
 }

 function o(t) {
  var e;
  for (e in t)
   if (("data" !== e || !rt.isEmptyObject(t[e])) && "toJSON" !== e) return !1;
  return !0
 }

 function a() {
  return !0
 }

 function l() {
  return !1
 }

 function c() {
  try {
   return z.activeElement
  } catch (t) {}
 }

 function u(t, e) {
  do {
   t = t[e]
  } while (t && 1 !== t.nodeType);
  return t
 }

 function h(t, e, n) {
  if (rt.isFunction(e)) return rt.grep(t, function(t, i) {
   return !!e.call(t, i, t) !== n
  });
  if (e.nodeType) return rt.grep(t, function(t) {
   return t === e !== n
  });
  if ("string" == typeof e) {
   if ($t.test(e)) return rt.filter(e, t, n);
   e = rt.filter(e, t)
  }
  return rt.grep(t, function(t) {
   return rt.inArray(t, e) >= 0 !== n
  })
 }

 function p(t) {
  var e = Ft.split("|"),
   n = t.createDocumentFragment();
  if (n.createElement)
   for (; e.length;) n.createElement(e.pop());
  return n
 }

 function d(t, e) {
  return rt.nodeName(t, "table") && rt.nodeName(1 === e.nodeType ? e : e.firstChild, "tr") ? t.getElementsByTagName("tbody")[0] || t.appendChild(t.ownerDocument.createElement("tbody")) : t
 }

 function f(t) {
  return t.type = (null !== rt.find.attr(t, "type")) + "/" + t.type, t
 }

 function m(t) {
  var e = Yt.exec(t.type);
  return e ? t.type = e[1] : t.removeAttribute("type"), t
 }

 function g(t, e) {
  for (var n, i = 0; null != (n = t[i]); i++) rt._data(n, "globalEval", !e || rt._data(e[i], "globalEval"))
 }

 function v(t, e) {
  if (1 === e.nodeType && rt.hasData(t)) {
   var n, i, r, s = rt._data(t),
    o = rt._data(e, s),
    a = s.events;
   if (a) {
    delete o.handle, o.events = {};
    for (n in a)
     for (i = 0, r = a[n].length; r > i; i++) rt.event.add(e, n, a[n][i])
   }
   o.data && (o.data = rt.extend({}, o.data))
  }
 }

 function y(t, e) {
  var n, i, r;
  if (1 === e.nodeType) {
   if (n = e.nodeName.toLowerCase(), !rt.support.noCloneEvent && e[rt.expando]) {
    r = rt._data(e);
    for (i in r.events) rt.removeEvent(e, i, r.handle);
    e.removeAttribute(rt.expando)
   }
   "script" === n && e.text !== t.text ? (f(e).text = t.text, m(e)) : "object" === n ? (e.parentNode && (e.outerHTML = t.outerHTML), rt.support.html5Clone && t.innerHTML && !rt.trim(e.innerHTML) && (e.innerHTML = t.innerHTML)) : "input" === n && Jt.test(t.type) ? (e.defaultChecked = e.checked = t.checked, e.value !== t.value && (e.value = t.value)) : "option" === n ? e.defaultSelected = e.selected = t.defaultSelected : ("input" === n || "textarea" === n) && (e.defaultValue = t.defaultValue)
  }
 }

 function b(t, n) {
  var i, r, s = 0,
   o = typeof t.getElementsByTagName !== q ? t.getElementsByTagName(n || "*") : typeof t.querySelectorAll !== q ? t.querySelectorAll(n || "*") : e;
  if (!o)
   for (o = [], i = t.childNodes || t; null != (r = i[s]); s++) !n || rt.nodeName(r, n) ? o.push(r) : rt.merge(o, b(r, n));
  return n === e || n && rt.nodeName(t, n) ? rt.merge([t], o) : o
 }

 function x(t) {
  Jt.test(t.type) && (t.defaultChecked = t.checked)
 }

 function w(t, e) {
  if (e in t) return e;
  for (var n = e.charAt(0).toUpperCase() + e.slice(1), i = e, r = ve.length; r--;)
   if ((e = ve[r] + n) in t) return e;
  return i
 }

 function k(t, e) {
  return t = e || t, "none" === rt.css(t, "display") || !rt.contains(t.ownerDocument, t)
 }

 function S(t, e) {
  for (var n, i, r, s = [], o = 0, a = t.length; a > o; o++)(i = t[o]).style && (s[o] = rt._data(i, "olddisplay"), n = i.style.display, e ? (s[o] || "none" !== n || (i.style.display = ""), "" === i.style.display && k(i) && (s[o] = rt._data(i, "olddisplay", T(i.nodeName)))) : s[o] || (r = k(i), (n && "none" !== n || !r) && rt._data(i, "olddisplay", r ? n : rt.css(i, "display"))));
  for (o = 0; a > o; o++)(i = t[o]).style && (e && "none" !== i.style.display && "" !== i.style.display || (i.style.display = e ? s[o] || "" : "none"));
  return t
 }

 function _(t, e, n) {
  var i = ue.exec(e);
  return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : e
 }

 function C(t, e, n, i, r) {
  for (var s = n === (i ? "border" : "content") ? 4 : "width" === e ? 1 : 0, o = 0; 4 > s; s += 2) "margin" === n && (o += rt.css(t, n + ge[s], !0, r)), i ? ("content" === n && (o -= rt.css(t, "padding" + ge[s], !0, r)), "margin" !== n && (o -= rt.css(t, "border" + ge[s] + "Width", !0, r))) : (o += rt.css(t, "padding" + ge[s], !0, r), "padding" !== n && (o += rt.css(t, "border" + ge[s] + "Width", !0, r)));
  return o
 }

 function E(t, e, n) {
  var i = !0,
   r = "width" === e ? t.offsetWidth : t.offsetHeight,
   s = ie(t),
   o = rt.support.boxSizing && "border-box" === rt.css(t, "boxSizing", !1, s);
  if (0 >= r || null == r) {
   if ((0 > (r = re(t, e, s)) || null == r) && (r = t.style[e]), he.test(r)) return r;
   i = o && (rt.support.boxSizingReliable || r === t.style[e]), r = parseFloat(r) || 0
  }
  return r + C(t, e, n || (o ? "border" : "content"), i, s) + "px"
 }

 function T(t) {
  var e = z,
   n = de[t];
  return n || ("none" !== (n = A(t, e)) && n || (ne = (ne || rt("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(e.documentElement), (e = (ne[0].contentWindow || ne[0].contentDocument).document).write("<!doctype html><html><body>"), e.close(), n = A(t, e), ne.detach()), de[t] = n), n
 }

 function A(t, e) {
  var n = rt(e.createElement(t)).appendTo(e.body),
   i = rt.css(n[0], "display");
  return n.remove(), i
 }

 function P(t, e, n, i) {
  var r;
  if (rt.isArray(e)) rt.each(e, function(e, r) {
   n || be.test(t) ? i(t, r) : P(t + "[" + ("object" == typeof r ? e : "") + "]", r, n, i)
  });
  else if (n || "object" !== rt.type(e)) i(t, e);
  else
   for (r in e) P(t + "[" + r + "]", e[r], n, i)
 }

 function N(t) {
  return function(e, n) {
   "string" != typeof e && (n = e, e = "*");
   var i, r = 0,
    s = e.toLowerCase().match(ot) || [];
   if (rt.isFunction(n))
    for (; i = s[r++];) "+" === i[0] ? (i = i.slice(1) || "*", (t[i] = t[i] || []).unshift(n)) : (t[i] = t[i] || []).push(n)
  }
 }

 function D(t, n, i, r) {
  function s(l) {
   var c;
   return o[l] = !0, rt.each(t[l] || [], function(t, l) {
    var u = l(n, i, r);
    return "string" != typeof u || a || o[u] ? a ? !(c = u) : e : (n.dataTypes.unshift(u), s(u), !1)
   }), c
  }
  var o = {},
   a = t === Le;
  return s(n.dataTypes[0]) || !o["*"] && s("*")
 }

 function I(t, n) {
  var i, r, s = rt.ajaxSettings.flatOptions || {};
  for (r in n) n[r] !== e && ((s[r] ? t : i || (i = {}))[r] = n[r]);
  return i && rt.extend(!0, t, i), t
 }

 function j() {
  try {
   return new t.XMLHttpRequest
  } catch (t) {}
 }

 function O() {
  return setTimeout(function() {
   Ve = e
  }), Ve = rt.now()
 }

 function L(t, e, n) {
  for (var i, r = (Je[e] || []).concat(Je["*"]), s = 0, o = r.length; o > s; s++)
   if (i = r[s].call(n, e, t)) return i
 }

 function $(t, e, n) {
  var i, r, s = 0,
   o = Xe.length,
   a = rt.Deferred().always(function() {
    delete l.elem
   }),
   l = function() {
    if (r) return !1;
    for (var e = Ve || O(), n = Math.max(0, c.startTime + c.duration - e), i = 1 - (n / c.duration || 0), s = 0, o = c.tweens.length; o > s; s++) c.tweens[s].run(i);
    return a.notifyWith(t, [c, i, n]), 1 > i && o ? n : (a.resolveWith(t, [c]), !1)
   },
   c = a.promise({
    elem: t,
    props: rt.extend({}, e),
    opts: rt.extend(!0, {
     specialEasing: {}
    }, n),
    originalProperties: e,
    originalOptions: n,
    startTime: Ve || O(),
    duration: n.duration,
    tweens: [],
    createTween: function(e, n) {
     var i = rt.Tween(t, c.opts, e, n, c.opts.specialEasing[e] || c.opts.easing);
     return c.tweens.push(i), i
    },
    stop: function(e) {
     var n = 0,
      i = e ? c.tweens.length : 0;
     if (r) return this;
     for (r = !0; i > n; n++) c.tweens[n].run(1);
     return e ? a.resolveWith(t, [c, e]) : a.rejectWith(t, [c, e]), this
    }
   }),
   u = c.props;
  for (function(t, e) {
    var n, i, r, s, o;
    for (n in t)
     if (i = rt.camelCase(n), r = e[i], s = t[n], rt.isArray(s) && (r = s[1], s = t[n] = s[0]), n !== i && (t[i] = s, delete t[n]), (o = rt.cssHooks[i]) && "expand" in o) {
      s = o.expand(s), delete t[i];
      for (n in s) n in t || (t[n] = s[n], e[n] = r)
     } else e[i] = r
   }(u, c.opts.specialEasing); o > s; s++)
   if (i = Xe[s].call(c, t, u, c.opts)) return i;
  return rt.map(u, L, c), rt.isFunction(c.opts.start) && c.opts.start.call(t, c), rt.fx.timer(rt.extend(l, {
   elem: t,
   anim: c,
   queue: c.opts.queue
  })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
 }

 function R(t, e, n, i, r) {
  return new R.prototype.init(t, e, n, i, r)
 }

 function H(t, e) {
  var n, i = {
    height: t
   },
   r = 0;
  for (e = e ? 1 : 0; 4 > r; r += 2 - e) n = ge[r], i["margin" + n] = i["padding" + n] = t;
  return e && (i.opacity = i.width = t), i
 }

 function M(t) {
  return rt.isWindow(t) ? t : 9 === t.nodeType && (t.defaultView || t.parentWindow)
 }
 var F, B, q = typeof e,
  V = t.location,
  z = t.document,
  W = z.documentElement,
  U = t.jQuery,
  K = t.$,
  X = {},
  J = [],
  G = "1.10.2",
  Q = J.concat,
  Y = J.push,
  Z = J.slice,
  tt = J.indexOf,
  et = X.toString,
  nt = X.hasOwnProperty,
  it = G.trim,
  rt = function(t, e) {
   return new rt.fn.init(t, e, B)
  },
  st = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
  ot = /\S+/g,
  at = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
  lt = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
  ct = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
  ut = /^[\],:{}\s]*$/,
  ht = /(?:^|:|,)(?:\s*\[)+/g,
  pt = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
  dt = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
  ft = /^-ms-/,
  mt = /-([\da-z])/gi,
  gt = function(t, e) {
   return e.toUpperCase()
  },
  vt = function(t) {
   (z.addEventListener || "load" === t.type || "complete" === z.readyState) && (yt(), rt.ready())
  },
  yt = function() {
   z.addEventListener ? (z.removeEventListener("DOMContentLoaded", vt, !1), t.removeEventListener("load", vt, !1)) : (z.detachEvent("onreadystatechange", vt), t.detachEvent("onload", vt))
  };
 rt.fn = rt.prototype = {
   jquery: G,
   constructor: rt,
   init: function(t, n, i) {
    var r, s;
    if (!t) return this;
    if ("string" == typeof t) {
     if (!(r = "<" === t.charAt(0) && ">" === t.charAt(t.length - 1) && t.length >= 3 ? [null, t, null] : lt.exec(t)) || !r[1] && n) return !n || n.jquery ? (n || i).find(t) : this.constructor(n).find(t);
     if (r[1]) {
      if (n = n instanceof rt ? n[0] : n, rt.merge(this, rt.parseHTML(r[1], n && n.nodeType ? n.ownerDocument || n : z, !0)), ct.test(r[1]) && rt.isPlainObject(n))
       for (r in n) rt.isFunction(this[r]) ? this[r](n[r]) : this.attr(r, n[r]);
      return this
     }
     if ((s = z.getElementById(r[2])) && s.parentNode) {
      if (s.id !== r[2]) return i.find(t);
      this.length = 1, this[0] = s
     }
     return this.context = z, this.selector = t, this
    }
    return t.nodeType ? (this.context = this[0] = t, this.length = 1, this) : rt.isFunction(t) ? i.ready(t) : (t.selector !== e && (this.selector = t.selector, this.context = t.context), rt.makeArray(t, this))
   },
   selector: "",
   length: 0,
   toArray: function() {
    return Z.call(this)
   },
   get: function(t) {
    return null == t ? this.toArray() : 0 > t ? this[this.length + t] : this[t]
   },
   pushStack: function(t) {
    var e = rt.merge(this.constructor(), t);
    return e.prevObject = this, e.context = this.context, e
   },
   each: function(t, e) {
    return rt.each(this, t, e)
   },
   ready: function(t) {
    return rt.ready.promise().done(t), this
   },
   slice: function() {
    return this.pushStack(Z.apply(this, arguments))
   },
   first: function() {
    return this.eq(0)
   },
   last: function() {
    return this.eq(-1)
   },
   eq: function(t) {
    var e = this.length,
     n = +t + (0 > t ? e : 0);
    return this.pushStack(n >= 0 && e > n ? [this[n]] : [])
   },
   map: function(t) {
    return this.pushStack(rt.map(this, function(e, n) {
     return t.call(e, n, e)
    }))
   },
   end: function() {
    return this.prevObject || this.constructor(null)
   },
   push: Y,
   sort: [].sort,
   splice: [].splice
  }, rt.fn.init.prototype = rt.fn, rt.extend = rt.fn.extend = function() {
   var t, n, i, r, s, o, a = arguments[0] || {},
    l = 1,
    c = arguments.length,
    u = !1;
   for ("boolean" == typeof a && (u = a, a = arguments[1] || {}, l = 2), "object" == typeof a || rt.isFunction(a) || (a = {}), c === l && (a = this, --l); c > l; l++)
    if (null != (s = arguments[l]))
     for (r in s) t = a[r], i = s[r], a !== i && (u && i && (rt.isPlainObject(i) || (n = rt.isArray(i))) ? (n ? (n = !1, o = t && rt.isArray(t) ? t : []) : o = t && rt.isPlainObject(t) ? t : {}, a[r] = rt.extend(u, o, i)) : i !== e && (a[r] = i));
   return a
  }, rt.extend({
   expando: "jQuery" + (G + Math.random()).replace(/\D/g, ""),
   noConflict: function(e) {
    return t.$ === rt && (t.$ = K), e && t.jQuery === rt && (t.jQuery = U), rt
   },
   isReady: !1,
   readyWait: 1,
   holdReady: function(t) {
    t ? rt.readyWait++ : rt.ready(!0)
   },
   ready: function(t) {
    if (!0 === t ? !--rt.readyWait : !rt.isReady) {
     if (!z.body) return setTimeout(rt.ready);
     rt.isReady = !0, !0 !== t && --rt.readyWait > 0 || (F.resolveWith(z, [rt]), rt.fn.trigger && rt(z).trigger("ready").off("ready"))
    }
   },
   isFunction: function(t) {
    return "function" === rt.type(t)
   },
   isArray: Array.isArray || function(t) {
    return "array" === rt.type(t)
   },
   isWindow: function(t) {
    return null != t && t == t.window
   },
   isNumeric: function(t) {
    return !isNaN(parseFloat(t)) && isFinite(t)
   },
   type: function(t) {
    return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? X[et.call(t)] || "object" : typeof t
   },
   isPlainObject: function(t) {
    var n;
    if (!t || "object" !== rt.type(t) || t.nodeType || rt.isWindow(t)) return !1;
    try {
     if (t.constructor && !nt.call(t, "constructor") && !nt.call(t.constructor.prototype, "isPrototypeOf")) return !1
    } catch (t) {
     return !1
    }
    if (rt.support.ownLast)
     for (n in t) return nt.call(t, n);
    for (n in t);
    return n === e || nt.call(t, n)
   },
   isEmptyObject: function(t) {
    var e;
    for (e in t) return !1;
    return !0
   },
   error: function(t) {
    throw Error(t)
   },
   parseHTML: function(t, e, n) {
    if (!t || "string" != typeof t) return null;
    "boolean" == typeof e && (n = e, e = !1), e = e || z;
    var i = ct.exec(t),
     r = !n && [];
    return i ? [e.createElement(i[1])] : (i = rt.buildFragment([t], e, r), r && rt(r).remove(), rt.merge([], i.childNodes))
   },
   parseJSON: function(n) {
    return t.JSON && t.JSON.parse ? t.JSON.parse(n) : null === n ? n : "string" == typeof n && (n = rt.trim(n)) && ut.test(n.replace(pt, "@").replace(dt, "]").replace(ht, "")) ? Function("return " + n)() : (rt.error("Invalid JSON: " + n), e)
   },
   parseXML: function(n) {
    var i, r;
    if (!n || "string" != typeof n) return null;
    try {
     t.DOMParser ? (r = new DOMParser, i = r.parseFromString(n, "text/xml")) : (i = new ActiveXObject("Microsoft.XMLDOM"), i.async = "false", i.loadXML(n))
    } catch (t) {
     i = e
    }
    return i && i.documentElement && !i.getElementsByTagName("parsererror").length || rt.error("Invalid XML: " + n), i
   },
   noop: function() {},
   globalEval: function(e) {
    e && rt.trim(e) && (t.execScript || function(e) {
     t.eval.call(t, e)
    })(e)
   },
   camelCase: function(t) {
    return t.replace(ft, "ms-").replace(mt, gt)
   },
   nodeName: function(t, e) {
    return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
   },
   each: function(t, e, i) {
    var r = 0,
     s = t.length,
     o = n(t);
    if (i) {
     if (o)
      for (; s > r && !1 !== e.apply(t[r], i); r++);
     else
      for (r in t)
       if (!1 === e.apply(t[r], i)) break
    } else if (o)
     for (; s > r && !1 !== e.call(t[r], r, t[r]); r++);
    else
     for (r in t)
      if (!1 === e.call(t[r], r, t[r])) break; return t
   },
   trim: it && !it.call("\ufeff ") ? function(t) {
    return null == t ? "" : it.call(t)
   } : function(t) {
    return null == t ? "" : (t + "").replace(at, "")
   },
   makeArray: function(t, e) {
    var i = e || [];
    return null != t && (n(Object(t)) ? rt.merge(i, "string" == typeof t ? [t] : t) : Y.call(i, t)), i
   },
   inArray: function(t, e, n) {
    var i;
    if (e) {
     if (tt) return tt.call(e, t, n);
     for (i = e.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)
      if (n in e && e[n] === t) return n
    }
    return -1
   },
   merge: function(t, n) {
    var i = n.length,
     r = t.length,
     s = 0;
    if ("number" == typeof i)
     for (; i > s; s++) t[r++] = n[s];
    else
     for (; n[s] !== e;) t[r++] = n[s++];
    return t.length = r, t
   },
   grep: function(t, e, n) {
    var i, r = [],
     s = 0,
     o = t.length;
    for (n = !!n; o > s; s++) i = !!e(t[s], s), n !== i && r.push(t[s]);
    return r
   },
   map: function(t, e, i) {
    var r, s = 0,
     o = t.length,
     a = [];
    if (n(t))
     for (; o > s; s++) null != (r = e(t[s], s, i)) && (a[a.length] = r);
    else
     for (s in t) null != (r = e(t[s], s, i)) && (a[a.length] = r);
    return Q.apply([], a)
   },
   guid: 1,
   proxy: function(t, n) {
    var i, r, s;
    return "string" == typeof n && (s = t[n], n = t, t = s), rt.isFunction(t) ? (i = Z.call(arguments, 2), r = function() {
     return t.apply(n || this, i.concat(Z.call(arguments)))
    }, r.guid = t.guid = t.guid || rt.guid++, r) : e
   },
   access: function(t, n, i, r, s, o, a) {
    var l = 0,
     c = t.length,
     u = null == i;
    if ("object" === rt.type(i)) {
     s = !0;
     for (l in i) rt.access(t, n, l, i[l], !0, o, a)
    } else if (r !== e && (s = !0, rt.isFunction(r) || (a = !0), u && (a ? (n.call(t, r), n = null) : (u = n, n = function(t, e, n) {
      return u.call(rt(t), n)
     })), n))
     for (; c > l; l++) n(t[l], i, a ? r : r.call(t[l], l, n(t[l], i)));
    return s ? t : u ? n.call(t) : c ? n(t[0], i) : o
   },
   now: function() {
    return (new Date).getTime()
   },
   swap: function(t, e, n, i) {
    var r, s, o = {};
    for (s in e) o[s] = t.style[s], t.style[s] = e[s];
    r = n.apply(t, i || []);
    for (s in e) t.style[s] = o[s];
    return r
   }
  }), rt.ready.promise = function(e) {
   if (!F)
    if (F = rt.Deferred(), "complete" === z.readyState) setTimeout(rt.ready);
    else if (z.addEventListener) z.addEventListener("DOMContentLoaded", vt, !1), t.addEventListener("load", vt, !1);
   else {
    z.attachEvent("onreadystatechange", vt), t.attachEvent("onload", vt);
    var n = !1;
    try {
     n = null == t.frameElement && z.documentElement
    } catch (t) {}
    n && n.doScroll && function t() {
     if (!rt.isReady) {
      try {
       n.doScroll("left")
      } catch (e) {
       return setTimeout(t, 50)
      }
      yt(), rt.ready()
     }
    }()
   }
   return F.promise(e)
  }, rt.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(t, e) {
   X["[object " + e + "]"] = e.toLowerCase()
  }), B = rt(z),
  function(t, e) {
   function n(t, e, n, i) {
    var r, s, o, a, l, c, u, h, f, m;
    if ((e ? e.ownerDocument || e : R) !== P && A(e), e = e || P, n = n || [], !t || "string" != typeof t) return n;
    if (1 !== (a = e.nodeType) && 9 !== a) return [];
    if (D && !i) {
     if (r = gt.exec(t))
      if (o = r[1]) {
       if (9 === a) {
        if (!(s = e.getElementById(o)) || !s.parentNode) return n;
        if (s.id === o) return n.push(s), n
       } else if (e.ownerDocument && (s = e.ownerDocument.getElementById(o)) && L(e, s) && s.id === o) return n.push(s), n
      } else {
       if (r[2]) return Q.apply(n, e.getElementsByTagName(t)), n;
       if ((o = r[3]) && x.getElementsByClassName && e.getElementsByClassName) return Q.apply(n, e.getElementsByClassName(o)), n
      }
     if (x.qsa && (!I || !I.test(t))) {
      if (h = u = $, f = e, m = 9 === a && t, 1 === a && "object" !== e.nodeName.toLowerCase()) {
       for (c = p(t), (u = e.getAttribute("id")) ? h = u.replace(bt, "\\$&") : e.setAttribute("id", h), h = "[id='" + h + "'] ", l = c.length; l--;) c[l] = h + d(c[l]);
       f = ut.test(t) && e.parentNode || e, m = c.join(",")
      }
      if (m) try {
       return Q.apply(n, f.querySelectorAll(m)), n
      } catch (t) {} finally {
       u || e.removeAttribute("id")
      }
     }
    }
    return function(t, e, n, i) {
     var r, s, o, a, l, c = p(t);
     if (!i && 1 === c.length) {
      if ((s = c[0] = c[0].slice(0)).length > 2 && "ID" === (o = s[0]).type && x.getById && 9 === e.nodeType && D && k.relative[s[1].type]) {
       if (!(e = (k.find.ID(o.matches[0].replace(xt, wt), e) || [])[0])) return n;
       t = t.slice(s.shift().value.length)
      }
      for (r = ft.needsContext.test(t) ? 0 : s.length; r-- && (o = s[r], !k.relative[a = o.type]);)
       if ((l = k.find[a]) && (i = l(o.matches[0].replace(xt, wt), ut.test(s[0].type) && e.parentNode || e))) {
        if (s.splice(r, 1), !(t = i.length && d(s))) return Q.apply(n, i), n;
        break
       }
     }
     return C(t, c)(i, e, !D, n, ut.test(t)), n
    }(t.replace(at, "$1"), e, n, i)
   }

   function i() {
    function t(n, i) {
     return e.push(n += " ") > k.cacheLength && delete t[e.shift()], t[n] = i
    }
    var e = [];
    return t
   }

   function r(t) {
    return t[$] = !0, t
   }

   function s(t) {
    var e = P.createElement("div");
    try {
     return !!t(e)
    } catch (t) {
     return !1
    } finally {
     e.parentNode && e.parentNode.removeChild(e), e = null
    }
   }

   function o(t, e) {
    for (var n = t.split("|"), i = t.length; i--;) k.attrHandle[n[i]] = e
   }

   function a(t, e) {
    var n = e && t,
     i = n && 1 === t.nodeType && 1 === e.nodeType && (~e.sourceIndex || U) - (~t.sourceIndex || U);
    if (i) return i;
    if (n)
     for (; n = n.nextSibling;)
      if (n === e) return -1;
    return t ? 1 : -1
   }

   function l(t) {
    return function(e) {
     return "input" === e.nodeName.toLowerCase() && e.type === t
    }
   }

   function c(t) {
    return function(e) {
     var n = e.nodeName.toLowerCase();
     return ("input" === n || "button" === n) && e.type === t
    }
   }

   function u(t) {
    return r(function(e) {
     return e = +e, r(function(n, i) {
      for (var r, s = t([], n.length, e), o = s.length; o--;) n[r = s[o]] && (n[r] = !(i[r] = n[r]))
     })
    })
   }

   function h() {}

   function p(t, e) {
    var i, r, s, o, a, l, c, u = B[t + " "];
    if (u) return e ? 0 : u.slice(0);
    for (a = t, l = [], c = k.preFilter; a;) {
     (!i || (r = lt.exec(a))) && (r && (a = a.slice(r[0].length) || a), l.push(s = [])), i = !1, (r = ct.exec(a)) && (i = r.shift(), s.push({
      value: i,
      type: r[0].replace(at, " ")
     }), a = a.slice(i.length));
     for (o in k.filter) !(r = ft[o].exec(a)) || c[o] && !(r = c[o](r)) || (i = r.shift(), s.push({
      value: i,
      type: o,
      matches: r
     }), a = a.slice(i.length));
     if (!i) break
    }
    return e ? a.length : a ? n.error(t) : B(t, l).slice(0)
   }

   function d(t) {
    for (var e = 0, n = t.length, i = ""; n > e; e++) i += t[e].value;
    return i
   }

   function f(t, e, n) {
    var i = e.dir,
     r = n && "parentNode" === i,
     s = M++;
    return e.first ? function(e, n, s) {
     for (; e = e[i];)
      if (1 === e.nodeType || r) return t(e, n, s)
    } : function(e, n, o) {
     var a, l, c, u = H + " " + s;
     if (o) {
      for (; e = e[i];)
       if ((1 === e.nodeType || r) && t(e, n, o)) return !0
     } else
      for (; e = e[i];)
       if (1 === e.nodeType || r)
        if (c = e[$] || (e[$] = {}), (l = c[i]) && l[0] === u) {
         if (!0 === (a = l[1]) || a === w) return !0 === a
        } else if (l = c[i] = [u], l[1] = t(e, n, o) || w, !0 === l[1]) return !0
    }
   }

   function m(t) {
    return t.length > 1 ? function(e, n, i) {
     for (var r = t.length; r--;)
      if (!t[r](e, n, i)) return !1;
     return !0
    } : t[0]
   }

   function g(t, e, n, i, r) {
    for (var s, o = [], a = 0, l = t.length, c = null != e; l > a; a++)(s = t[a]) && (!n || n(s, i, r)) && (o.push(s), c && e.push(a));
    return o
   }

   function v(t, e, i, s, o, a) {
    return s && !s[$] && (s = v(s)), o && !o[$] && (o = v(o, a)), r(function(r, a, l, c) {
     var u, h, p, d = [],
      f = [],
      m = a.length,
      v = r || function(t, e, i) {
       for (var r = 0, s = e.length; s > r; r++) n(t, e[r], i);
       return i
      }(e || "*", l.nodeType ? [l] : l, []),
      y = !t || !r && e ? v : g(v, d, t, l, c),
      b = i ? o || (r ? t : m || s) ? [] : a : y;
     if (i && i(y, b, l, c), s)
      for (u = g(b, f), s(u, [], l, c), h = u.length; h--;)(p = u[h]) && (b[f[h]] = !(y[f[h]] = p));
     if (r) {
      if (o || t) {
       if (o) {
        for (u = [], h = b.length; h--;)(p = b[h]) && u.push(y[h] = p);
        o(null, b = [], u, c)
       }
       for (h = b.length; h--;)(p = b[h]) && (u = o ? Z.call(r, p) : d[h]) > -1 && (r[u] = !(a[u] = p))
      }
     } else b = g(b === a ? b.splice(m, b.length) : b), o ? o(null, a, b, c) : Q.apply(a, b)
    })
   }

   function y(t) {
    for (var e, n, i, r = t.length, s = k.relative[t[0].type], o = s || k.relative[" "], a = s ? 1 : 0, l = f(function(t) {
      return t === e
     }, o, !0), c = f(function(t) {
      return Z.call(e, t) > -1
     }, o, !0), u = [function(t, n, i) {
      return !s && (i || n !== E) || ((e = n).nodeType ? l(t, n, i) : c(t, n, i))
     }]; r > a; a++)
     if (n = k.relative[t[a].type]) u = [f(m(u), n)];
     else {
      if ((n = k.filter[t[a].type].apply(null, t[a].matches))[$]) {
       for (i = ++a; r > i && !k.relative[t[i].type]; i++);
       return v(a > 1 && m(u), a > 1 && d(t.slice(0, a - 1).concat({
        value: " " === t[a - 2].type ? "*" : ""
       })).replace(at, "$1"), n, i > a && y(t.slice(a, i)), r > i && y(t = t.slice(i)), r > i && d(t))
      }
      u.push(n)
     }
    return m(u)
   }
   var b, x, w, k, S, _, C, E, T, A, P, N, D, I, j, O, L, $ = "sizzle" + -new Date,
    R = t.document,
    H = 0,
    M = 0,
    F = i(),
    B = i(),
    q = i(),
    V = !1,
    z = function(t, e) {
     return t === e ? (V = !0, 0) : 0
    },
    W = "undefined",
    U = 1 << 31,
    K = {}.hasOwnProperty,
    X = [],
    J = X.pop,
    G = X.push,
    Q = X.push,
    Y = X.slice,
    Z = X.indexOf || function(t) {
     for (var e = 0, n = this.length; n > e; e++)
      if (this[e] === t) return e;
     return -1
    },
    tt = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
    et = "[\\x20\\t\\r\\n\\f]",
    nt = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
    it = nt.replace("w", "w#"),
    st = "\\[" + et + "*(" + nt + ")" + et + "*(?:([*^$|!~]?=)" + et + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + it + ")|)|)" + et + "*\\]",
    ot = ":(" + nt + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + st.replace(3, 8) + ")*)|.*)\\)|)",
    at = RegExp("^" + et + "+|((?:^|[^\\\\])(?:\\\\.)*)" + et + "+$", "g"),
    lt = RegExp("^" + et + "*," + et + "*"),
    ct = RegExp("^" + et + "*([>+~]|" + et + ")" + et + "*"),
    ut = RegExp(et + "*[+~]"),
    ht = RegExp("=" + et + "*([^\\]'\"]*)" + et + "*\\]", "g"),
    pt = RegExp(ot),
    dt = RegExp("^" + it + "$"),
    ft = {
     ID: RegExp("^#(" + nt + ")"),
     CLASS: RegExp("^\\.(" + nt + ")"),
     TAG: RegExp("^(" + nt.replace("w", "w*") + ")"),
     ATTR: RegExp("^" + st),
     PSEUDO: RegExp("^" + ot),
     CHILD: RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + et + "*(even|odd|(([+-]|)(\\d*)n|)" + et + "*(?:([+-]|)" + et + "*(\\d+)|))" + et + "*\\)|)", "i"),
     bool: RegExp("^(?:" + tt + ")$", "i"),
     needsContext: RegExp("^" + et + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + et + "*((?:-\\d)?\\d*)" + et + "*\\)|)(?=[^-]|$)", "i")
    },
    mt = /^[^{]+\{\s*\[native \w/,
    gt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
    vt = /^(?:input|select|textarea|button)$/i,
    yt = /^h\d$/i,
    bt = /'|\\/g,
    xt = RegExp("\\\\([\\da-f]{1,6}" + et + "?|(" + et + ")|.)", "ig"),
    wt = function(t, e, n) {
     var i = "0x" + e - 65536;
     return i != i || n ? e : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(55296 | i >> 10, 56320 | 1023 & i)
    };
   try {
    Q.apply(X = Y.call(R.childNodes), R.childNodes), X[R.childNodes.length].nodeType
   } catch (t) {
    Q = {
     apply: X.length ? function(t, e) {
      G.apply(t, Y.call(e))
     } : function(t, e) {
      for (var n = t.length, i = 0; t[n++] = e[i++];);
      t.length = n - 1
     }
    }
   }
   _ = n.isXML = function(t) {
    var e = t && (t.ownerDocument || t).documentElement;
    return !!e && "HTML" !== e.nodeName
   }, x = n.support = {}, A = n.setDocument = function(t) {
    var n = t ? t.ownerDocument || t : R,
     i = n.defaultView;
    return n !== P && 9 === n.nodeType && n.documentElement ? (P = n, N = n.documentElement, D = !_(n), i && i.attachEvent && i !== i.top && i.attachEvent("onbeforeunload", function() {
     A()
    }), x.attributes = s(function(t) {
     return t.className = "i", !t.getAttribute("className")
    }), x.getElementsByTagName = s(function(t) {
     return t.appendChild(n.createComment("")), !t.getElementsByTagName("*").length
    }), x.getElementsByClassName = s(function(t) {
     return t.innerHTML = "<div class='a'></div><div class='a i'></div>", t.firstChild.className = "i", 2 === t.getElementsByClassName("i").length
    }), x.getById = s(function(t) {
     return N.appendChild(t).id = $, !n.getElementsByName || !n.getElementsByName($).length
    }), x.getById ? (k.find.ID = function(t, e) {
     if (typeof e.getElementById !== W && D) {
      var n = e.getElementById(t);
      return n && n.parentNode ? [n] : []
     }
    }, k.filter.ID = function(t) {
     var e = t.replace(xt, wt);
     return function(t) {
      return t.getAttribute("id") === e
     }
    }) : (delete k.find.ID, k.filter.ID = function(t) {
     var e = t.replace(xt, wt);
     return function(t) {
      var n = typeof t.getAttributeNode !== W && t.getAttributeNode("id");
      return n && n.value === e
     }
    }), k.find.TAG = x.getElementsByTagName ? function(t, n) {
     return typeof n.getElementsByTagName !== W ? n.getElementsByTagName(t) : e
    } : function(t, e) {
     var n, i = [],
      r = 0,
      s = e.getElementsByTagName(t);
     if ("*" === t) {
      for (; n = s[r++];) 1 === n.nodeType && i.push(n);
      return i
     }
     return s
    }, k.find.CLASS = x.getElementsByClassName && function(t, n) {
     return typeof n.getElementsByClassName !== W && D ? n.getElementsByClassName(t) : e
    }, j = [], I = [], (x.qsa = mt.test(n.querySelectorAll)) && (s(function(t) {
     t.innerHTML = "<select><option selected=''></option></select>", t.querySelectorAll("[selected]").length || I.push("\\[" + et + "*(?:value|" + tt + ")"), t.querySelectorAll(":checked").length || I.push(":checked")
    }), s(function(t) {
     var e = n.createElement("input");
     e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("t", ""), t.querySelectorAll("[t^='']").length && I.push("[*^$]=" + et + "*(?:''|\"\")"), t.querySelectorAll(":enabled").length || I.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), I.push(",.*:")
    })), (x.matchesSelector = mt.test(O = N.webkitMatchesSelector || N.mozMatchesSelector || N.oMatchesSelector || N.msMatchesSelector)) && s(function(t) {
     x.disconnectedMatch = O.call(t, "div"), O.call(t, "[s!='']:x"), j.push("!=", ot)
    }), I = I.length && RegExp(I.join("|")), j = j.length && RegExp(j.join("|")), L = mt.test(N.contains) || N.compareDocumentPosition ? function(t, e) {
     var n = 9 === t.nodeType ? t.documentElement : t,
      i = e && e.parentNode;
     return t === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(i)))
    } : function(t, e) {
     if (e)
      for (; e = e.parentNode;)
       if (e === t) return !0;
     return !1
    }, z = N.compareDocumentPosition ? function(t, e) {
     if (t === e) return V = !0, 0;
     var i = e.compareDocumentPosition && t.compareDocumentPosition && t.compareDocumentPosition(e);
     return i ? 1 & i || !x.sortDetached && e.compareDocumentPosition(t) === i ? t === n || L(R, t) ? -1 : e === n || L(R, e) ? 1 : T ? Z.call(T, t) - Z.call(T, e) : 0 : 4 & i ? -1 : 1 : t.compareDocumentPosition ? -1 : 1
    } : function(t, e) {
     var i, r = 0,
      s = t.parentNode,
      o = e.parentNode,
      l = [t],
      c = [e];
     if (t === e) return V = !0, 0;
     if (!s || !o) return t === n ? -1 : e === n ? 1 : s ? -1 : o ? 1 : T ? Z.call(T, t) - Z.call(T, e) : 0;
     if (s === o) return a(t, e);
     for (i = t; i = i.parentNode;) l.unshift(i);
     for (i = e; i = i.parentNode;) c.unshift(i);
     for (; l[r] === c[r];) r++;
     return r ? a(l[r], c[r]) : l[r] === R ? -1 : c[r] === R ? 1 : 0
    }, n) : P
   }, n.matches = function(t, e) {
    return n(t, null, null, e)
   }, n.matchesSelector = function(t, e) {
    if ((t.ownerDocument || t) !== P && A(t), e = e.replace(ht, "='$1']"), !(!x.matchesSelector || !D || j && j.test(e) || I && I.test(e))) try {
     var i = O.call(t, e);
     if (i || x.disconnectedMatch || t.document && 11 !== t.document.nodeType) return i
    } catch (t) {}
    return n(e, P, null, [t]).length > 0
   }, n.contains = function(t, e) {
    return (t.ownerDocument || t) !== P && A(t), L(t, e)
   }, n.attr = function(t, n) {
    (t.ownerDocument || t) !== P && A(t);
    var i = k.attrHandle[n.toLowerCase()],
     r = i && K.call(k.attrHandle, n.toLowerCase()) ? i(t, n, !D) : e;
    return r === e ? x.attributes || !D ? t.getAttribute(n) : (r = t.getAttributeNode(n)) && r.specified ? r.value : null : r
   }, n.error = function(t) {
    throw Error("Syntax error, unrecognized expression: " + t)
   }, n.uniqueSort = function(t) {
    var e, n = [],
     i = 0,
     r = 0;
    if (V = !x.detectDuplicates, T = !x.sortStable && t.slice(0), t.sort(z), V) {
     for (; e = t[r++];) e === t[r] && (i = n.push(r));
     for (; i--;) t.splice(n[i], 1)
    }
    return t
   }, S = n.getText = function(t) {
    var e, n = "",
     i = 0,
     r = t.nodeType;
    if (r) {
     if (1 === r || 9 === r || 11 === r) {
      if ("string" == typeof t.textContent) return t.textContent;
      for (t = t.firstChild; t; t = t.nextSibling) n += S(t)
     } else if (3 === r || 4 === r) return t.nodeValue
    } else
     for (; e = t[i]; i++) n += S(e);
    return n
   }, (k = n.selectors = {
    cacheLength: 50,
    createPseudo: r,
    match: ft,
    attrHandle: {},
    find: {},
    relative: {
     ">": {
      dir: "parentNode",
      first: !0
     },
     " ": {
      dir: "parentNode"
     },
     "+": {
      dir: "previousSibling",
      first: !0
     },
     "~": {
      dir: "previousSibling"
     }
    },
    preFilter: {
     ATTR: function(t) {
      return t[1] = t[1].replace(xt, wt), t[3] = (t[4] || t[5] || "").replace(xt, wt), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
     },
     CHILD: function(t) {
      return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || n.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && n.error(t[0]), t
     },
     PSEUDO: function(t) {
      var n, i = !t[5] && t[2];
      return ft.CHILD.test(t[0]) ? null : (t[3] && t[4] !== e ? t[2] = t[4] : i && pt.test(i) && (n = p(i, !0)) && (n = i.indexOf(")", i.length - n) - i.length) && (t[0] = t[0].slice(0, n), t[2] = i.slice(0, n)), t.slice(0, 3))
     }
    },
    filter: {
     TAG: function(t) {
      var e = t.replace(xt, wt).toLowerCase();
      return "*" === t ? function() {
       return !0
      } : function(t) {
       return t.nodeName && t.nodeName.toLowerCase() === e
      }
     },
     CLASS: function(t) {
      var e = F[t + " "];
      return e || (e = RegExp("(^|" + et + ")" + t + "(" + et + "|$)")) && F(t, function(t) {
       return e.test("string" == typeof t.className && t.className || typeof t.getAttribute !== W && t.getAttribute("class") || "")
      })
     },
     ATTR: function(t, e, i) {
      return function(r) {
       var s = n.attr(r, t);
       return null == s ? "!=" === e : !e || (s += "", "=" === e ? s === i : "!=" === e ? s !== i : "^=" === e ? i && 0 === s.indexOf(i) : "*=" === e ? i && s.indexOf(i) > -1 : "$=" === e ? i && s.slice(-i.length) === i : "~=" === e ? (" " + s + " ").indexOf(i) > -1 : "|=" === e && (s === i || s.slice(0, i.length + 1) === i + "-"))
      }
     },
     CHILD: function(t, e, n, i, r) {
      var s = "nth" !== t.slice(0, 3),
       o = "last" !== t.slice(-4),
       a = "of-type" === e;
      return 1 === i && 0 === r ? function(t) {
       return !!t.parentNode
      } : function(e, n, l) {
       var c, u, h, p, d, f, m = s !== o ? "nextSibling" : "previousSibling",
        g = e.parentNode,
        v = a && e.nodeName.toLowerCase(),
        y = !l && !a;
       if (g) {
        if (s) {
         for (; m;) {
          for (h = e; h = h[m];)
           if (a ? h.nodeName.toLowerCase() === v : 1 === h.nodeType) return !1;
          f = m = "only" === t && !f && "nextSibling"
         }
         return !0
        }
        if (f = [o ? g.firstChild : g.lastChild], o && y) {
         for (d = (c = (u = g[$] || (g[$] = {}))[t] || [])[0] === H && c[1], p = c[0] === H && c[2], h = d && g.childNodes[d]; h = ++d && h && h[m] || (p = d = 0) || f.pop();)
          if (1 === h.nodeType && ++p && h === e) {
           u[t] = [H, d, p];
           break
          }
        } else if (y && (c = (e[$] || (e[$] = {}))[t]) && c[0] === H) p = c[1];
        else
         for (;
          (h = ++d && h && h[m] || (p = d = 0) || f.pop()) && ((a ? h.nodeName.toLowerCase() !== v : 1 !== h.nodeType) || !++p || (y && ((h[$] || (h[$] = {}))[t] = [H, p]), h !== e)););
        return (p -= r) === i || 0 == p % i && p / i >= 0
       }
      }
     },
     PSEUDO: function(t, e) {
      var i, s = k.pseudos[t] || k.setFilters[t.toLowerCase()] || n.error("unsupported pseudo: " + t);
      return s[$] ? s(e) : s.length > 1 ? (i = [t, t, "", e], k.setFilters.hasOwnProperty(t.toLowerCase()) ? r(function(t, n) {
       for (var i, r = s(t, e), o = r.length; o--;) i = Z.call(t, r[o]), t[i] = !(n[i] = r[o])
      }) : function(t) {
       return s(t, 0, i)
      }) : s
     }
    },
    pseudos: {
     not: r(function(t) {
      var e = [],
       n = [],
       i = C(t.replace(at, "$1"));
      return i[$] ? r(function(t, e, n, r) {
       for (var s, o = i(t, null, r, []), a = t.length; a--;)(s = o[a]) && (t[a] = !(e[a] = s))
      }) : function(t, r, s) {
       return e[0] = t, i(e, null, s, n), !n.pop()
      }
     }),
     has: r(function(t) {
      return function(e) {
       return n(t, e).length > 0
      }
     }),
     contains: r(function(t) {
      return function(e) {
       return (e.textContent || e.innerText || S(e)).indexOf(t) > -1
      }
     }),
     lang: r(function(t) {
      return dt.test(t || "") || n.error("unsupported lang: " + t), t = t.replace(xt, wt).toLowerCase(),
       function(e) {
        var n;
        do {
         if (n = D ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (n = n.toLowerCase()) === t || 0 === n.indexOf(t + "-")
        } while ((e = e.parentNode) && 1 === e.nodeType);
        return !1
       }
     }),
     target: function(e) {
      var n = t.location && t.location.hash;
      return n && n.slice(1) === e.id
     },
     root: function(t) {
      return t === N
     },
     focus: function(t) {
      return t === P.activeElement && (!P.hasFocus || P.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
     },
     enabled: function(t) {
      return !1 === t.disabled
     },
     disabled: function(t) {
      return !0 === t.disabled
     },
     checked: function(t) {
      var e = t.nodeName.toLowerCase();
      return "input" === e && !!t.checked || "option" === e && !!t.selected
     },
     selected: function(t) {
      return t.parentNode && t.parentNode.selectedIndex, !0 === t.selected
     },
     empty: function(t) {
      for (t = t.firstChild; t; t = t.nextSibling)
       if (t.nodeName > "@" || 3 === t.nodeType || 4 === t.nodeType) return !1;
      return !0
     },
     parent: function(t) {
      return !k.pseudos.empty(t)
     },
     header: function(t) {
      return yt.test(t.nodeName)
     },
     input: function(t) {
      return vt.test(t.nodeName)
     },
     button: function(t) {
      var e = t.nodeName.toLowerCase();
      return "input" === e && "button" === t.type || "button" === e
     },
     text: function(t) {
      var e;
      return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || e.toLowerCase() === t.type)
     },
     first: u(function() {
      return [0]
     }),
     last: u(function(t, e) {
      return [e - 1]
     }),
     eq: u(function(t, e, n) {
      return [0 > n ? n + e : n]
     }),
     even: u(function(t, e) {
      for (var n = 0; e > n; n += 2) t.push(n);
      return t
     }),
     odd: u(function(t, e) {
      for (var n = 1; e > n; n += 2) t.push(n);
      return t
     }),
     lt: u(function(t, e, n) {
      for (var i = 0 > n ? n + e : n; --i >= 0;) t.push(i);
      return t
     }),
     gt: u(function(t, e, n) {
      for (var i = 0 > n ? n + e : n; e > ++i;) t.push(i);
      return t
     })
    }
   }).pseudos.nth = k.pseudos.eq;
   for (b in {
     radio: !0,
     checkbox: !0,
     file: !0,
     password: !0,
     image: !0
    }) k.pseudos[b] = l(b);
   for (b in {
     submit: !0,
     reset: !0
    }) k.pseudos[b] = c(b);
   h.prototype = k.filters = k.pseudos, k.setFilters = new h, C = n.compile = function(t, e) {
    var i, s = [],
     o = [],
     a = q[t + " "];
    if (!a) {
     for (e || (e = p(t)), i = e.length; i--;)(a = y(e[i]))[$] ? s.push(a) : o.push(a);
     a = q(t, function(t, e) {
      var i = 0,
       s = e.length > 0,
       o = t.length > 0,
       a = function(r, a, l, c, u) {
        var h, p, d, f = [],
         m = 0,
         v = "0",
         y = r && [],
         b = null != u,
         x = E,
         S = r || o && k.find.TAG("*", u && a.parentNode || a),
         _ = H += null == x ? 1 : Math.random() || .1;
        for (b && (E = a !== P && a, w = i); null != (h = S[v]); v++) {
         if (o && h) {
          for (p = 0; d = t[p++];)
           if (d(h, a, l)) {
            c.push(h);
            break
           }
          b && (H = _, w = ++i)
         }
         s && ((h = !d && h) && m--, r && y.push(h))
        }
        if (m += v, s && v !== m) {
         for (p = 0; d = e[p++];) d(y, f, a, l);
         if (r) {
          if (m > 0)
           for (; v--;) y[v] || f[v] || (f[v] = J.call(c));
          f = g(f)
         }
         Q.apply(c, f), b && !r && f.length > 0 && m + e.length > 1 && n.uniqueSort(c)
        }
        return b && (H = _, E = x), y
       };
      return s ? r(a) : a
     }(o, s))
    }
    return a
   }, x.sortStable = $.split("").sort(z).join("") === $, x.detectDuplicates = V, A(), x.sortDetached = s(function(t) {
    return 1 & t.compareDocumentPosition(P.createElement("div"))
   }), s(function(t) {
    return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
   }) || o("type|href|height|width", function(t, n, i) {
    return i ? e : t.getAttribute(n, "type" === n.toLowerCase() ? 1 : 2)
   }), x.attributes && s(function(t) {
    return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
   }) || o("value", function(t, n, i) {
    return i || "input" !== t.nodeName.toLowerCase() ? e : t.defaultValue
   }), s(function(t) {
    return null == t.getAttribute("disabled")
   }) || o(tt, function(t, n, i) {
    var r;
    return i ? e : (r = t.getAttributeNode(n)) && r.specified ? r.value : !0 === t[n] ? n.toLowerCase() : null
   }), rt.find = n, rt.expr = n.selectors, rt.expr[":"] = rt.expr.pseudos, rt.unique = n.uniqueSort, rt.text = n.getText, rt.isXMLDoc = n.isXML, rt.contains = n.contains
  }(t);
 var bt = {};
 rt.Callbacks = function(t) {
  var n, i, r, s, o, a, l = [],
   c = !(t = "string" == typeof t ? bt[t] || function(t) {
    var e = bt[t] = {};
    return rt.each(t.match(ot) || [], function(t, n) {
     e[n] = !0
    }), e
   }(t) : rt.extend({}, t)).once && [],
   u = function(e) {
    for (i = t.memory && e, r = !0, o = a || 0, a = 0, s = l.length, n = !0; l && s > o; o++)
     if (!1 === l[o].apply(e[0], e[1]) && t.stopOnFalse) {
      i = !1;
      break
     }
    n = !1, l && (c ? c.length && u(c.shift()) : i ? l = [] : h.disable())
   },
   h = {
    add: function() {
     if (l) {
      var e = l.length;
      (function e(n) {
       rt.each(n, function(n, i) {
        var r = rt.type(i);
        "function" === r ? t.unique && h.has(i) || l.push(i) : i && i.length && "string" !== r && e(i)
       })
      })(arguments), n ? s = l.length : i && (a = e, u(i))
     }
     return this
    },
    remove: function() {
     return l && rt.each(arguments, function(t, e) {
      for (var i;
       (i = rt.inArray(e, l, i)) > -1;) l.splice(i, 1), n && (s >= i && s--, o >= i && o--)
     }), this
    },
    has: function(t) {
     return t ? rt.inArray(t, l) > -1 : !(!l || !l.length)
    },
    empty: function() {
     return l = [], s = 0, this
    },
    disable: function() {
     return l = c = i = e, this
    },
    disabled: function() {
     return !l
    },
    lock: function() {
     return c = e, i || h.disable(), this
    },
    locked: function() {
     return !c
    },
    fireWith: function(t, e) {
     return !l || r && !c || (e = e || [], e = [t, e.slice ? e.slice() : e], n ? c.push(e) : u(e)), this
    },
    fire: function() {
     return h.fireWith(this, arguments), this
    },
    fired: function() {
     return !!r
    }
   };
  return h
 }, rt.extend({
  Deferred: function(t) {
   var e = [
     ["resolve", "done", rt.Callbacks("once memory"), "resolved"],
     ["reject", "fail", rt.Callbacks("once memory"), "rejected"],
     ["notify", "progress", rt.Callbacks("memory")]
    ],
    n = "pending",
    i = {
     state: function() {
      return n
     },
     always: function() {
      return r.done(arguments).fail(arguments), this
     },
     then: function() {
      var t = arguments;
      return rt.Deferred(function(n) {
       rt.each(e, function(e, s) {
        var o = s[0],
         a = rt.isFunction(t[e]) && t[e];
        r[s[1]](function() {
         var t = a && a.apply(this, arguments);
         t && rt.isFunction(t.promise) ? t.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[o + "With"](this === i ? n.promise() : this, a ? [t] : arguments)
        })
       }), t = null
      }).promise()
     },
     promise: function(t) {
      return null != t ? rt.extend(t, i) : i
     }
    },
    r = {};
   return i.pipe = i.then, rt.each(e, function(t, s) {
    var o = s[2],
     a = s[3];
    i[s[1]] = o.add, a && o.add(function() {
     n = a
    }, e[1 ^ t][2].disable, e[2][2].lock), r[s[0]] = function() {
     return r[s[0] + "With"](this === r ? i : this, arguments), this
    }, r[s[0] + "With"] = o.fireWith
   }), i.promise(r), t && t.call(r, r), r
  },
  when: function(t) {
   var e, n, i, r = 0,
    s = Z.call(arguments),
    o = s.length,
    a = 1 !== o || t && rt.isFunction(t.promise) ? o : 0,
    l = 1 === a ? t : rt.Deferred(),
    c = function(t, n, i) {
     return function(r) {
      n[t] = this, i[t] = arguments.length > 1 ? Z.call(arguments) : r, i === e ? l.notifyWith(n, i) : --a || l.resolveWith(n, i)
     }
    };
   if (o > 1)
    for (e = Array(o), n = Array(o), i = Array(o); o > r; r++) s[r] && rt.isFunction(s[r].promise) ? s[r].promise().done(c(r, i, s)).fail(l.reject).progress(c(r, n, e)) : --a;
   return a || l.resolveWith(i, s), l.promise()
  }
 }), rt.support = function(e) {
  var n, i, r, s, o, a, l, c, u, h = z.createElement("div");
  if (h.setAttribute("className", "t"), h.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = h.getElementsByTagName("*") || [], !(i = h.getElementsByTagName("a")[0]) || !i.style || !n.length) return e;
  a = (s = z.createElement("select")).appendChild(z.createElement("option")), r = h.getElementsByTagName("input")[0], i.style.cssText = "top:1px;float:left;opacity:.5", e.getSetAttribute = "t" !== h.className, e.leadingWhitespace = 3 === h.firstChild.nodeType, e.tbody = !h.getElementsByTagName("tbody").length, e.htmlSerialize = !!h.getElementsByTagName("link").length, e.style = /top/.test(i.getAttribute("style")), e.hrefNormalized = "/a" === i.getAttribute("href"), e.opacity = /^0.5/.test(i.style.opacity), e.cssFloat = !!i.style.cssFloat, e.checkOn = !!r.value, e.optSelected = a.selected, e.enctype = !!z.createElement("form").enctype, e.html5Clone = "<:nav></:nav>" !== z.createElement("nav").cloneNode(!0).outerHTML, e.inlineBlockNeedsLayout = !1, e.shrinkWrapBlocks = !1, e.pixelPosition = !1, e.deleteExpando = !0, e.noCloneEvent = !0, e.reliableMarginRight = !0, e.boxSizingReliable = !0, r.checked = !0, e.noCloneChecked = r.cloneNode(!0).checked, s.disabled = !0, e.optDisabled = !a.disabled;
  try {
   delete h.test
  } catch (t) {
   e.deleteExpando = !1
  }(r = z.createElement("input")).setAttribute("value", ""), e.input = "" === r.getAttribute("value"), r.value = "t", r.setAttribute("type", "radio"), e.radioValue = "t" === r.value, r.setAttribute("checked", "t"), r.setAttribute("name", "t"), (o = z.createDocumentFragment()).appendChild(r), e.appendChecked = r.checked, e.checkClone = o.cloneNode(!0).cloneNode(!0).lastChild.checked, h.attachEvent && (h.attachEvent("onclick", function() {
   e.noCloneEvent = !1
  }), h.cloneNode(!0).click());
  for (u in {
    submit: !0,
    change: !0,
    focusin: !0
   }) h.setAttribute(l = "on" + u, "t"), e[u + "Bubbles"] = l in t || !1 === h.attributes[l].expando;
  h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", e.clearCloneStyle = "content-box" === h.style.backgroundClip;
  for (u in rt(e)) break;
  return e.ownLast = "0" !== u, rt(function() {
   var n, i, r, s = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
    o = z.getElementsByTagName("body")[0];
   o && (n = z.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", o.appendChild(n).appendChild(h), h.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", r = h.getElementsByTagName("td"), r[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = 0 === r[0].offsetHeight, r[0].style.display = "", r[1].style.display = "none", e.reliableHiddenOffsets = c && 0 === r[0].offsetHeight, h.innerHTML = "", h.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", rt.swap(o, null != o.style.zoom ? {
    zoom: 1
   } : {}, function() {
    e.boxSizing = 4 === h.offsetWidth
   }), t.getComputedStyle && (e.pixelPosition = "1%" !== (t.getComputedStyle(h, null) || {}).top, e.boxSizingReliable = "4px" === (t.getComputedStyle(h, null) || {
    width: "4px"
   }).width, i = h.appendChild(z.createElement("div")), i.style.cssText = h.style.cssText = s, i.style.marginRight = i.style.width = "0", h.style.width = "1px", e.reliableMarginRight = !parseFloat((t.getComputedStyle(i, null) || {}).marginRight)), typeof h.style.zoom !== q && (h.innerHTML = "", h.style.cssText = s + "width:1px;padding:1px;display:inline;zoom:1", e.inlineBlockNeedsLayout = 3 === h.offsetWidth, h.style.display = "block", h.innerHTML = "<div></div>", h.firstChild.style.width = "5px", e.shrinkWrapBlocks = 3 !== h.offsetWidth, e.inlineBlockNeedsLayout && (o.style.zoom = 1)), o.removeChild(n), n = h = r = i = null)
  }), n = s = o = a = i = r = null, e
 }({});
 var xt = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
  wt = /([A-Z])/g;
 rt.extend({
  cache: {},
  noData: {
   applet: !0,
   embed: !0,
   object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  },
  hasData: function(t) {
   return !!(t = t.nodeType ? rt.cache[t[rt.expando]] : t[rt.expando]) && !o(t)
  },
  data: function(t, e, n) {
   return i(t, e, n)
  },
  removeData: function(t, e) {
   return r(t, e)
  },
  _data: function(t, e, n) {
   return i(t, e, n, !0)
  },
  _removeData: function(t, e) {
   return r(t, e, !0)
  },
  acceptData: function(t) {
   if (t.nodeType && 1 !== t.nodeType && 9 !== t.nodeType) return !1;
   var e = t.nodeName && rt.noData[t.nodeName.toLowerCase()];
   return !e || !0 !== e && t.getAttribute("classid") === e
  }
 }), rt.fn.extend({
  data: function(t, n) {
   var i, r, o = null,
    a = 0,
    l = this[0];
   if (t === e) {
    if (this.length && (o = rt.data(l), 1 === l.nodeType && !rt._data(l, "parsedAttrs"))) {
     for (i = l.attributes; i.length > a; a++) 0 === (r = i[a].name).indexOf("data-") && (r = rt.camelCase(r.slice(5)), s(l, r, o[r]));
     rt._data(l, "parsedAttrs", !0)
    }
    return o
   }
   return "object" == typeof t ? this.each(function() {
    rt.data(this, t)
   }) : arguments.length > 1 ? this.each(function() {
    rt.data(this, t, n)
   }) : l ? s(l, t, rt.data(l, t)) : null
  },
  removeData: function(t) {
   return this.each(function() {
    rt.removeData(this, t)
   })
  }
 }), rt.extend({
  queue: function(t, n, i) {
   var r;
   return t ? (n = (n || "fx") + "queue", r = rt._data(t, n), i && (!r || rt.isArray(i) ? r = rt._data(t, n, rt.makeArray(i)) : r.push(i)), r || []) : e
  },
  dequeue: function(t, e) {
   e = e || "fx";
   var n = rt.queue(t, e),
    i = n.length,
    r = n.shift(),
    s = rt._queueHooks(t, e);
   "inprogress" === r && (r = n.shift(), i--), r && ("fx" === e && n.unshift("inprogress"), delete s.stop, r.call(t, function() {
    rt.dequeue(t, e)
   }, s)), !i && s && s.empty.fire()
  },
  _queueHooks: function(t, e) {
   var n = e + "queueHooks";
   return rt._data(t, n) || rt._data(t, n, {
    empty: rt.Callbacks("once memory").add(function() {
     rt._removeData(t, e + "queue"), rt._removeData(t, n)
    })
   })
  }
 }), rt.fn.extend({
  queue: function(t, n) {
   var i = 2;
   return "string" != typeof t && (n = t, t = "fx", i--), i > arguments.length ? rt.queue(this[0], t) : n === e ? this : this.each(function() {
    var e = rt.queue(this, t, n);
    rt._queueHooks(this, t), "fx" === t && "inprogress" !== e[0] && rt.dequeue(this, t)
   })
  },
  dequeue: function(t) {
   return this.each(function() {
    rt.dequeue(this, t)
   })
  },
  delay: function(t, e) {
   return t = rt.fx ? rt.fx.speeds[t] || t : t, e = e || "fx", this.queue(e, function(e, n) {
    var i = setTimeout(e, t);
    n.stop = function() {
     clearTimeout(i)
    }
   })
  },
  clearQueue: function(t) {
   return this.queue(t || "fx", [])
  },
  promise: function(t, n) {
   var i, r = 1,
    s = rt.Deferred(),
    o = this,
    a = this.length,
    l = function() {
     --r || s.resolveWith(o, [o])
    };
   for ("string" != typeof t && (n = t, t = e), t = t || "fx"; a--;)(i = rt._data(o[a], t + "queueHooks")) && i.empty && (r++, i.empty.add(l));
   return l(), s.promise(n)
  }
 });
 var kt, St, _t = /[\t\r\n\f]/g,
  Ct = /\r/g,
  Et = /^(?:input|select|textarea|button|object)$/i,
  Tt = /^(?:a|area)$/i,
  At = /^(?:checked|selected)$/i,
  Pt = rt.support.getSetAttribute,
  Nt = rt.support.input;
 rt.fn.extend({
  attr: function(t, e) {
   return rt.access(this, rt.attr, t, e, arguments.length > 1)
  },
  removeAttr: function(t) {
   return this.each(function() {
    rt.removeAttr(this, t)
   })
  },
  prop: function(t, e) {
   return rt.access(this, rt.prop, t, e, arguments.length > 1)
  },
  removeProp: function(t) {
   return t = rt.propFix[t] || t, this.each(function() {
    try {
     this[t] = e, delete this[t]
    } catch (t) {}
   })
  },
  addClass: function(t) {
   var e, n, i, r, s, o = 0,
    a = this.length,
    l = "string" == typeof t && t;
   if (rt.isFunction(t)) return this.each(function(e) {
    rt(this).addClass(t.call(this, e, this.className))
   });
   if (l)
    for (e = (t || "").match(ot) || []; a > o; o++)
     if (n = this[o], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(_t, " ") : " ")) {
      for (s = 0; r = e[s++];) 0 > i.indexOf(" " + r + " ") && (i += r + " ");
      n.className = rt.trim(i)
     }
   return this
  },
  removeClass: function(t) {
   var e, n, i, r, s, o = 0,
    a = this.length,
    l = 0 === arguments.length || "string" == typeof t && t;
   if (rt.isFunction(t)) return this.each(function(e) {
    rt(this).removeClass(t.call(this, e, this.className))
   });
   if (l)
    for (e = (t || "").match(ot) || []; a > o; o++)
     if (n = this[o], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(_t, " ") : "")) {
      for (s = 0; r = e[s++];)
       for (; i.indexOf(" " + r + " ") >= 0;) i = i.replace(" " + r + " ", " ");
      n.className = t ? rt.trim(i) : ""
     }
   return this
  },
  toggleClass: function(t, e) {
   var n = typeof t;
   return "boolean" == typeof e && "string" === n ? e ? this.addClass(t) : this.removeClass(t) : rt.isFunction(t) ? this.each(function(n) {
    rt(this).toggleClass(t.call(this, n, this.className, e), e)
   }) : this.each(function() {
    if ("string" === n)
     for (var e, i = 0, r = rt(this), s = t.match(ot) || []; e = s[i++];) r.hasClass(e) ? r.removeClass(e) : r.addClass(e);
    else(n === q || "boolean" === n) && (this.className && rt._data(this, "__className__", this.className), this.className = this.className || !1 === t ? "" : rt._data(this, "__className__") || "")
   })
  },
  hasClass: function(t) {
   for (var e = " " + t + " ", n = 0, i = this.length; i > n; n++)
    if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(_t, " ").indexOf(e) >= 0) return !0;
   return !1
  },
  val: function(t) {
   var n, i, r, s = this[0];
   return arguments.length ? (r = rt.isFunction(t), this.each(function(n) {
    var s;
    1 === this.nodeType && (null == (s = r ? t.call(this, n, rt(this).val()) : t) ? s = "" : "number" == typeof s ? s += "" : rt.isArray(s) && (s = rt.map(s, function(t) {
     return null == t ? "" : t + ""
    })), (i = rt.valHooks[this.type] || rt.valHooks[this.nodeName.toLowerCase()]) && "set" in i && i.set(this, s, "value") !== e || (this.value = s))
   })) : s ? (i = rt.valHooks[s.type] || rt.valHooks[s.nodeName.toLowerCase()]) && "get" in i && (n = i.get(s, "value")) !== e ? n : "string" == typeof(n = s.value) ? n.replace(Ct, "") : null == n ? "" : n : void 0
  }
 }), rt.extend({
  valHooks: {
   option: {
    get: function(t) {
     var e = rt.find.attr(t, "value");
     return null != e ? e : t.text
    }
   },
   select: {
    get: function(t) {
     for (var e, n, i = t.options, r = t.selectedIndex, s = "select-one" === t.type || 0 > r, o = s ? null : [], a = s ? r + 1 : i.length, l = 0 > r ? a : s ? r : 0; a > l; l++)
      if (!(!(n = i[l]).selected && l !== r || (rt.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && rt.nodeName(n.parentNode, "optgroup"))) {
       if (e = rt(n).val(), s) return e;
       o.push(e)
      }
     return o
    },
    set: function(t, e) {
     for (var n, i, r = t.options, s = rt.makeArray(e), o = r.length; o--;) i = r[o], (i.selected = rt.inArray(rt(i).val(), s) >= 0) && (n = !0);
     return n || (t.selectedIndex = -1), s
    }
   }
  },
  attr: function(t, n, i) {
   var r, s, o = t.nodeType;
   if (t && 3 !== o && 8 !== o && 2 !== o) return typeof t.getAttribute === q ? rt.prop(t, n, i) : (1 === o && rt.isXMLDoc(t) || (n = n.toLowerCase(), r = rt.attrHooks[n] || (rt.expr.match.bool.test(n) ? St : kt)), i === e ? r && "get" in r && null !== (s = r.get(t, n)) ? s : null == (s = rt.find.attr(t, n)) ? e : s : null !== i ? r && "set" in r && (s = r.set(t, i, n)) !== e ? s : (t.setAttribute(n, i + ""), i) : (rt.removeAttr(t, n), e))
  },
  removeAttr: function(t, e) {
   var n, i, r = 0,
    s = e && e.match(ot);
   if (s && 1 === t.nodeType)
    for (; n = s[r++];) i = rt.propFix[n] || n, rt.expr.match.bool.test(n) ? Nt && Pt || !At.test(n) ? t[i] = !1 : t[rt.camelCase("default-" + n)] = t[i] = !1 : rt.attr(t, n, ""), t.removeAttribute(Pt ? n : i)
  },
  attrHooks: {
   type: {
    set: function(t, e) {
     if (!rt.support.radioValue && "radio" === e && rt.nodeName(t, "input")) {
      var n = t.value;
      return t.setAttribute("type", e), n && (t.value = n), e
     }
    }
   }
  },
  propFix: {
   for: "htmlFor",
   class: "className"
  },
  prop: function(t, n, i) {
   var r, s, o = t.nodeType;
   if (t && 3 !== o && 8 !== o && 2 !== o) return (1 !== o || !rt.isXMLDoc(t)) && (n = rt.propFix[n] || n, s = rt.propHooks[n]), i !== e ? s && "set" in s && (r = s.set(t, i, n)) !== e ? r : t[n] = i : s && "get" in s && null !== (r = s.get(t, n)) ? r : t[n]
  },
  propHooks: {
   tabIndex: {
    get: function(t) {
     var e = rt.find.attr(t, "tabindex");
     return e ? parseInt(e, 10) : Et.test(t.nodeName) || Tt.test(t.nodeName) && t.href ? 0 : -1
    }
   }
  }
 }), St = {
  set: function(t, e, n) {
   return !1 === e ? rt.removeAttr(t, n) : Nt && Pt || !At.test(n) ? t.setAttribute(!Pt && rt.propFix[n] || n, n) : t[rt.camelCase("default-" + n)] = t[n] = !0, n
  }
 }, rt.each(rt.expr.match.bool.source.match(/\w+/g), function(t, n) {
  var i = rt.expr.attrHandle[n] || rt.find.attr;
  rt.expr.attrHandle[n] = Nt && Pt || !At.test(n) ? function(t, n, r) {
   var s = rt.expr.attrHandle[n],
    o = r ? e : (rt.expr.attrHandle[n] = e) != i(t, n, r) ? n.toLowerCase() : null;
   return rt.expr.attrHandle[n] = s, o
  } : function(t, n, i) {
   return i ? e : t[rt.camelCase("default-" + n)] ? n.toLowerCase() : null
  }
 }), Nt && Pt || (rt.attrHooks.value = {
  set: function(t, n, i) {
   return rt.nodeName(t, "input") ? (t.defaultValue = n, e) : kt && kt.set(t, n, i)
  }
 }), Pt || (kt = {
  set: function(t, n, i) {
   var r = t.getAttributeNode(i);
   return r || t.setAttributeNode(r = t.ownerDocument.createAttribute(i)), r.value = n += "", "value" === i || n === t.getAttribute(i) ? n : e
  }
 }, rt.expr.attrHandle.id = rt.expr.attrHandle.name = rt.expr.attrHandle.coords = function(t, n, i) {
  var r;
  return i ? e : (r = t.getAttributeNode(n)) && "" !== r.value ? r.value : null
 }, rt.valHooks.button = {
  get: function(t, n) {
   var i = t.getAttributeNode(n);
   return i && i.specified ? i.value : e
  },
  set: kt.set
 }, rt.attrHooks.contenteditable = {
  set: function(t, e, n) {
   kt.set(t, "" !== e && e, n)
  }
 }, rt.each(["width", "height"], function(t, n) {
  rt.attrHooks[n] = {
   set: function(t, i) {
    return "" === i ? (t.setAttribute(n, "auto"), i) : e
   }
  }
 })), rt.support.hrefNormalized || rt.each(["href", "src"], function(t, e) {
  rt.propHooks[e] = {
   get: function(t) {
    return t.getAttribute(e, 4)
   }
  }
 }), rt.support.style || (rt.attrHooks.style = {
  get: function(t) {
   return t.style.cssText || e
  },
  set: function(t, e) {
   return t.style.cssText = e + ""
  }
 }), rt.support.optSelected || (rt.propHooks.selected = {
  get: function(t) {
   var e = t.parentNode;
   return e && (e.selectedIndex, e.parentNode && e.parentNode.selectedIndex), null
  }
 }), rt.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
  rt.propFix[this.toLowerCase()] = this
 }), rt.support.enctype || (rt.propFix.enctype = "encoding"), rt.each(["radio", "checkbox"], function() {
  rt.valHooks[this] = {
   set: function(t, n) {
    return rt.isArray(n) ? t.checked = rt.inArray(rt(t).val(), n) >= 0 : e
   }
  }, rt.support.checkOn || (rt.valHooks[this].get = function(t) {
   return null === t.getAttribute("value") ? "on" : t.value
  })
 });
 var Dt = /^(?:input|select|textarea)$/i,
  It = /^key/,
  jt = /^(?:mouse|contextmenu)|click/,
  Ot = /^(?:focusinfocus|focusoutblur)$/,
  Lt = /^([^.]*)(?:\.(.+)|)$/;
 rt.event = {
  global: {},
  add: function(t, n, i, r, s) {
   var o, a, l, c, u, h, p, d, f, m, g, v = rt._data(t);
   if (v) {
    for (i.handler && (c = i, i = c.handler, s = c.selector), i.guid || (i.guid = rt.guid++), (a = v.events) || (a = v.events = {}), (h = v.handle) || (h = v.handle = function(t) {
      return typeof rt === q || t && rt.event.triggered === t.type ? e : rt.event.dispatch.apply(h.elem, arguments)
     }, h.elem = t), l = (n = (n || "").match(ot) || [""]).length; l--;) o = Lt.exec(n[l]) || [], f = g = o[1], m = (o[2] || "").split(".").sort(), f && (u = rt.event.special[f] || {}, f = (s ? u.delegateType : u.bindType) || f, u = rt.event.special[f] || {}, p = rt.extend({
     type: f,
     origType: g,
     data: r,
     handler: i,
     guid: i.guid,
     selector: s,
     needsContext: s && rt.expr.match.needsContext.test(s),
     namespace: m.join(".")
    }, c), (d = a[f]) || (d = a[f] = [], d.delegateCount = 0, u.setup && !1 !== u.setup.call(t, r, m, h) || (t.addEventListener ? t.addEventListener(f, h, !1) : t.attachEvent && t.attachEvent("on" + f, h))), u.add && (u.add.call(t, p), p.handler.guid || (p.handler.guid = i.guid)), s ? d.splice(d.delegateCount++, 0, p) : d.push(p), rt.event.global[f] = !0);
    t = null
   }
  },
  remove: function(t, e, n, i, r) {
   var s, o, a, l, c, u, h, p, d, f, m, g = rt.hasData(t) && rt._data(t);
   if (g && (u = g.events)) {
    for (c = (e = (e || "").match(ot) || [""]).length; c--;)
     if (a = Lt.exec(e[c]) || [], d = m = a[1], f = (a[2] || "").split(".").sort(), d) {
      for (h = rt.event.special[d] || {}, p = u[d = (i ? h.delegateType : h.bindType) || d] || [], a = a[2] && RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = s = p.length; s--;) o = p[s], !r && m !== o.origType || n && n.guid !== o.guid || a && !a.test(o.namespace) || i && i !== o.selector && ("**" !== i || !o.selector) || (p.splice(s, 1), o.selector && p.delegateCount--, h.remove && h.remove.call(t, o));
      l && !p.length && (h.teardown && !1 !== h.teardown.call(t, f, g.handle) || rt.removeEvent(t, d, g.handle), delete u[d])
     } else
      for (d in u) rt.event.remove(t, d + e[c], n, i, !0);
    rt.isEmptyObject(u) && (delete g.handle, rt._removeData(t, "events"))
   }
  },
  trigger: function(n, i, r, s) {
   var o, a, l, c, u, h, p, d = [r || z],
    f = nt.call(n, "type") ? n.type : n,
    m = nt.call(n, "namespace") ? n.namespace.split(".") : [];
   if (l = h = r = r || z, 3 !== r.nodeType && 8 !== r.nodeType && !Ot.test(f + rt.event.triggered) && (f.indexOf(".") >= 0 && (m = f.split("."), f = m.shift(), m.sort()), a = 0 > f.indexOf(":") && "on" + f, n = n[rt.expando] ? n : new rt.Event(f, "object" == typeof n && n), n.isTrigger = s ? 2 : 3, n.namespace = m.join("."), n.namespace_re = n.namespace ? RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = e, n.target || (n.target = r), i = null == i ? [n] : rt.makeArray(i, [n]), u = rt.event.special[f] || {}, s || !u.trigger || !1 !== u.trigger.apply(r, i))) {
    if (!s && !u.noBubble && !rt.isWindow(r)) {
     for (c = u.delegateType || f, Ot.test(c + f) || (l = l.parentNode); l; l = l.parentNode) d.push(l), h = l;
     h === (r.ownerDocument || z) && d.push(h.defaultView || h.parentWindow || t)
    }
    for (p = 0;
     (l = d[p++]) && !n.isPropagationStopped();) n.type = p > 1 ? c : u.bindType || f, (o = (rt._data(l, "events") || {})[n.type] && rt._data(l, "handle")) && o.apply(l, i), (o = a && l[a]) && rt.acceptData(l) && o.apply && !1 === o.apply(l, i) && n.preventDefault();
    if (n.type = f, !s && !n.isDefaultPrevented() && (!u._default || !1 === u._default.apply(d.pop(), i)) && rt.acceptData(r) && a && r[f] && !rt.isWindow(r)) {
     (h = r[a]) && (r[a] = null), rt.event.triggered = f;
     try {
      r[f]()
     } catch (t) {}
     rt.event.triggered = e, h && (r[a] = h)
    }
    return n.result
   }
  },
  dispatch: function(t) {
   t = rt.event.fix(t);
   var n, i, r, s, o, a = [],
    l = Z.call(arguments),
    c = (rt._data(this, "events") || {})[t.type] || [],
    u = rt.event.special[t.type] || {};
   if (l[0] = t, t.delegateTarget = this, !u.preDispatch || !1 !== u.preDispatch.call(this, t)) {
    for (a = rt.event.handlers.call(this, t, c), n = 0;
     (s = a[n++]) && !t.isPropagationStopped();)
     for (t.currentTarget = s.elem, o = 0;
      (r = s.handlers[o++]) && !t.isImmediatePropagationStopped();)(!t.namespace_re || t.namespace_re.test(r.namespace)) && (t.handleObj = r, t.data = r.data, (i = ((rt.event.special[r.origType] || {}).handle || r.handler).apply(s.elem, l)) !== e && !1 === (t.result = i) && (t.preventDefault(), t.stopPropagation()));
    return u.postDispatch && u.postDispatch.call(this, t), t.result
   }
  },
  handlers: function(t, n) {
   var i, r, s, o, a = [],
    l = n.delegateCount,
    c = t.target;
   if (l && c.nodeType && (!t.button || "click" !== t.type))
    for (; c != this; c = c.parentNode || this)
     if (1 === c.nodeType && (!0 !== c.disabled || "click" !== t.type)) {
      for (s = [], o = 0; l > o; o++) r = n[o], i = r.selector + " ", s[i] === e && (s[i] = r.needsContext ? rt(i, this).index(c) >= 0 : rt.find(i, this, null, [c]).length), s[i] && s.push(r);
      s.length && a.push({
       elem: c,
       handlers: s
      })
     }
   return n.length > l && a.push({
    elem: this,
    handlers: n.slice(l)
   }), a
  },
  fix: function(t) {
   if (t[rt.expando]) return t;
   var e, n, i, r = t.type,
    s = t,
    o = this.fixHooks[r];
   for (o || (this.fixHooks[r] = o = jt.test(r) ? this.mouseHooks : It.test(r) ? this.keyHooks : {}), i = o.props ? this.props.concat(o.props) : this.props, t = new rt.Event(s), e = i.length; e--;) n = i[e], t[n] = s[n];
   return t.target || (t.target = s.srcElement || z), 3 === t.target.nodeType && (t.target = t.target.parentNode), t.metaKey = !!t.metaKey, o.filter ? o.filter(t, s) : t
  },
  props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
  fixHooks: {},
  keyHooks: {
   props: "char charCode key keyCode".split(" "),
   filter: function(t, e) {
    return null == t.which && (t.which = null != e.charCode ? e.charCode : e.keyCode), t
   }
  },
  mouseHooks: {
   props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
   filter: function(t, n) {
    var i, r, s, o = n.button,
     a = n.fromElement;
    return null == t.pageX && null != n.clientX && (r = t.target.ownerDocument || z, s = r.documentElement, i = r.body, t.pageX = n.clientX + (s && s.scrollLeft || i && i.scrollLeft || 0) - (s && s.clientLeft || i && i.clientLeft || 0), t.pageY = n.clientY + (s && s.scrollTop || i && i.scrollTop || 0) - (s && s.clientTop || i && i.clientTop || 0)), !t.relatedTarget && a && (t.relatedTarget = a === t.target ? n.toElement : a), t.which || o === e || (t.which = 1 & o ? 1 : 2 & o ? 3 : 4 & o ? 2 : 0), t
   }
  },
  special: {
   load: {
    noBubble: !0
   },
   focus: {
    trigger: function() {
     if (this !== c() && this.focus) try {
      return this.focus(), !1
     } catch (t) {}
    },
    delegateType: "focusin"
   },
   blur: {
    trigger: function() {
     return this === c() && this.blur ? (this.blur(), !1) : e
    },
    delegateType: "focusout"
   },
   click: {
    trigger: function() {
     return rt.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : e
    },
    _default: function(t) {
     return rt.nodeName(t.target, "a")
    }
   },
   beforeunload: {
    postDispatch: function(t) {
     t.result !== e && (t.originalEvent.returnValue = t.result)
    }
   }
  },
  simulate: function(t, e, n, i) {
   var r = rt.extend(new rt.Event, n, {
    type: t,
    isSimulated: !0,
    originalEvent: {}
   });
   i ? rt.event.trigger(r, null, e) : rt.event.dispatch.call(e, r), r.isDefaultPrevented() && n.preventDefault()
  }
 }, rt.removeEvent = z.removeEventListener ? function(t, e, n) {
  t.removeEventListener && t.removeEventListener(e, n, !1)
 } : function(t, e, n) {
  var i = "on" + e;
  t.detachEvent && (typeof t[i] === q && (t[i] = null), t.detachEvent(i, n))
 }, rt.Event = function(t, n) {
  return this instanceof rt.Event ? (t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || !1 === t.returnValue || t.getPreventDefault && t.getPreventDefault() ? a : l) : this.type = t, n && rt.extend(this, n), this.timeStamp = t && t.timeStamp || rt.now(), this[rt.expando] = !0, e) : new rt.Event(t, n)
 }, rt.Event.prototype = {
  isDefaultPrevented: l,
  isPropagationStopped: l,
  isImmediatePropagationStopped: l,
  preventDefault: function() {
   var t = this.originalEvent;
   this.isDefaultPrevented = a, t && (t.preventDefault ? t.preventDefault() : t.returnValue = !1)
  },
  stopPropagation: function() {
   var t = this.originalEvent;
   this.isPropagationStopped = a, t && (t.stopPropagation && t.stopPropagation(), t.cancelBubble = !0)
  },
  stopImmediatePropagation: function() {
   this.isImmediatePropagationStopped = a, this.stopPropagation()
  }
 }, rt.each({
  mouseenter: "mouseover",
  mouseleave: "mouseout"
 }, function(t, e) {
  rt.event.special[t] = {
   delegateType: e,
   bindType: e,
   handle: function(t) {
    var n, i = t.relatedTarget,
     r = t.handleObj;
    return (!i || i !== this && !rt.contains(this, i)) && (t.type = r.origType, n = r.handler.apply(this, arguments), t.type = e), n
   }
  }
 }), rt.support.submitBubbles || (rt.event.special.submit = {
  setup: function() {
   return !rt.nodeName(this, "form") && (rt.event.add(this, "click._submit keypress._submit", function(t) {
    var n = t.target,
     i = rt.nodeName(n, "input") || rt.nodeName(n, "button") ? n.form : e;
    i && !rt._data(i, "submitBubbles") && (rt.event.add(i, "submit._submit", function(t) {
     t._submit_bubble = !0
    }), rt._data(i, "submitBubbles", !0))
   }), e)
  },
  postDispatch: function(t) {
   t._submit_bubble && (delete t._submit_bubble, this.parentNode && !t.isTrigger && rt.event.simulate("submit", this.parentNode, t, !0))
  },
  teardown: function() {
   return !rt.nodeName(this, "form") && (rt.event.remove(this, "._submit"), e)
  }
 }), rt.support.changeBubbles || (rt.event.special.change = {
  setup: function() {
   return Dt.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (rt.event.add(this, "propertychange._change", function(t) {
    "checked" === t.originalEvent.propertyName && (this._just_changed = !0)
   }), rt.event.add(this, "click._change", function(t) {
    this._just_changed && !t.isTrigger && (this._just_changed = !1), rt.event.simulate("change", this, t, !0)
   })), !1) : (rt.event.add(this, "beforeactivate._change", function(t) {
    var e = t.target;
    Dt.test(e.nodeName) && !rt._data(e, "changeBubbles") && (rt.event.add(e, "change._change", function(t) {
     !this.parentNode || t.isSimulated || t.isTrigger || rt.event.simulate("change", this.parentNode, t, !0)
    }), rt._data(e, "changeBubbles", !0))
   }), e)
  },
  handle: function(t) {
   var n = t.target;
   return this !== n || t.isSimulated || t.isTrigger || "radio" !== n.type && "checkbox" !== n.type ? t.handleObj.handler.apply(this, arguments) : e
  },
  teardown: function() {
   return rt.event.remove(this, "._change"), !Dt.test(this.nodeName)
  }
 }), rt.support.focusinBubbles || rt.each({
  focus: "focusin",
  blur: "focusout"
 }, function(t, e) {
  var n = 0,
   i = function(t) {
    rt.event.simulate(e, t.target, rt.event.fix(t), !0)
   };
  rt.event.special[e] = {
   setup: function() {
    0 == n++ && z.addEventListener(t, i, !0)
   },
   teardown: function() {
    0 == --n && z.removeEventListener(t, i, !0)
   }
  }
 }), rt.fn.extend({
  on: function(t, n, i, r, s) {
   var o, a;
   if ("object" == typeof t) {
    "string" != typeof n && (i = i || n, n = e);
    for (o in t) this.on(o, n, i, t[o], s);
    return this
   }
   if (null == i && null == r ? (r = n, i = n = e) : null == r && ("string" == typeof n ? (r = i, i = e) : (r = i, i = n, n = e)), !1 === r) r = l;
   else if (!r) return this;
   return 1 === s && (a = r, r = function(t) {
    return rt().off(t), a.apply(this, arguments)
   }, r.guid = a.guid || (a.guid = rt.guid++)), this.each(function() {
    rt.event.add(this, t, r, i, n)
   })
  },
  one: function(t, e, n, i) {
   return this.on(t, e, n, i, 1)
  },
  off: function(t, n, i) {
   var r, s;
   if (t && t.preventDefault && t.handleObj) return r = t.handleObj, rt(t.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
   if ("object" == typeof t) {
    for (s in t) this.off(s, n, t[s]);
    return this
   }
   return (!1 === n || "function" == typeof n) && (i = n, n = e), !1 === i && (i = l), this.each(function() {
    rt.event.remove(this, t, i, n)
   })
  },
  trigger: function(t, e) {
   return this.each(function() {
    rt.event.trigger(t, e, this)
   })
  },
  triggerHandler: function(t, n) {
   var i = this[0];
   return i ? rt.event.trigger(t, n, i, !0) : e
  }
 });
 var $t = /^.[^:#\[\.,]*$/,
  Rt = /^(?:parents|prev(?:Until|All))/,
  Ht = rt.expr.match.needsContext,
  Mt = {
   children: !0,
   contents: !0,
   next: !0,
   prev: !0
  };
 rt.fn.extend({
  find: function(t) {
   var e, n = [],
    i = this,
    r = i.length;
   if ("string" != typeof t) return this.pushStack(rt(t).filter(function() {
    for (e = 0; r > e; e++)
     if (rt.contains(i[e], this)) return !0
   }));
   for (e = 0; r > e; e++) rt.find(t, i[e], n);
   return n = this.pushStack(r > 1 ? rt.unique(n) : n), n.selector = this.selector ? this.selector + " " + t : t, n
  },
  has: function(t) {
   var e, n = rt(t, this),
    i = n.length;
   return this.filter(function() {
    for (e = 0; i > e; e++)
     if (rt.contains(this, n[e])) return !0
   })
  },
  not: function(t) {
   return this.pushStack(h(this, t || [], !0))
  },
  filter: function(t) {
   return this.pushStack(h(this, t || [], !1))
  },
  is: function(t) {
   return !!h(this, "string" == typeof t && Ht.test(t) ? rt(t) : t || [], !1).length
  },
  closest: function(t, e) {
   for (var n, i = 0, r = this.length, s = [], o = Ht.test(t) || "string" != typeof t ? rt(t, e || this.context) : 0; r > i; i++)
    for (n = this[i]; n && n !== e; n = n.parentNode)
     if (11 > n.nodeType && (o ? o.index(n) > -1 : 1 === n.nodeType && rt.find.matchesSelector(n, t))) {
      n = s.push(n);
      break
     }
   return this.pushStack(s.length > 1 ? rt.unique(s) : s)
  },
  index: function(t) {
   return t ? "string" == typeof t ? rt.inArray(this[0], rt(t)) : rt.inArray(t.jquery ? t[0] : t, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
  },
  add: function(t, e) {
   var n = "string" == typeof t ? rt(t, e) : rt.makeArray(t && t.nodeType ? [t] : t),
    i = rt.merge(this.get(), n);
   return this.pushStack(rt.unique(i))
  },
  addBack: function(t) {
   return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
  }
 }), rt.each({
  parent: function(t) {
   var e = t.parentNode;
   return e && 11 !== e.nodeType ? e : null
  },
  parents: function(t) {
   return rt.dir(t, "parentNode")
  },
  parentsUntil: function(t, e, n) {
   return rt.dir(t, "parentNode", n)
  },
  next: function(t) {
   return u(t, "nextSibling")
  },
  prev: function(t) {
   return u(t, "previousSibling")
  },
  nextAll: function(t) {
   return rt.dir(t, "nextSibling")
  },
  prevAll: function(t) {
   return rt.dir(t, "previousSibling")
  },
  nextUntil: function(t, e, n) {
   return rt.dir(t, "nextSibling", n)
  },
  prevUntil: function(t, e, n) {
   return rt.dir(t, "previousSibling", n)
  },
  siblings: function(t) {
   return rt.sibling((t.parentNode || {}).firstChild, t)
  },
  children: function(t) {
   return rt.sibling(t.firstChild)
  },
  contents: function(t) {
   return rt.nodeName(t, "iframe") ? t.contentDocument || t.contentWindow.document : rt.merge([], t.childNodes)
  }
 }, function(t, e) {
  rt.fn[t] = function(n, i) {
   var r = rt.map(this, e, n);
   return "Until" !== t.slice(-5) && (i = n), i && "string" == typeof i && (r = rt.filter(i, r)), this.length > 1 && (Mt[t] || (r = rt.unique(r)), Rt.test(t) && (r = r.reverse())), this.pushStack(r)
  }
 }), rt.extend({
  filter: function(t, e, n) {
   var i = e[0];
   return n && (t = ":not(" + t + ")"), 1 === e.length && 1 === i.nodeType ? rt.find.matchesSelector(i, t) ? [i] : [] : rt.find.matches(t, rt.grep(e, function(t) {
    return 1 === t.nodeType
   }))
  },
  dir: function(t, n, i) {
   for (var r = [], s = t[n]; s && 9 !== s.nodeType && (i === e || 1 !== s.nodeType || !rt(s).is(i));) 1 === s.nodeType && r.push(s), s = s[n];
   return r
  },
  sibling: function(t, e) {
   for (var n = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && n.push(t);
   return n
  }
 });
 var Ft = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
  Bt = / jQuery\d+="(?:null|\d+)"/g,
  qt = RegExp("<(?:" + Ft + ")[\\s/>]", "i"),
  Vt = /^\s+/,
  zt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
  Wt = /<([\w:]+)/,
  Ut = /<tbody/i,
  Kt = /<|&#?\w+;/,
  Xt = /<(?:script|style|link)/i,
  Jt = /^(?:checkbox|radio)$/i,
  Gt = /checked\s*(?:[^=]|=\s*.checked.)/i,
  Qt = /^$|\/(?:java|ecma)script/i,
  Yt = /^true\/(.*)/,
  Zt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
  te = {
   option: [1, "<select multiple='multiple'>", "</select>"],
   legend: [1, "<fieldset>", "</fieldset>"],
   area: [1, "<map>", "</map>"],
   param: [1, "<object>", "</object>"],
   thead: [1, "<table>", "</table>"],
   tr: [2, "<table><tbody>", "</tbody></table>"],
   col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
   td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
   _default: rt.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
  },
  ee = p(z).appendChild(z.createElement("div"));
 te.optgroup = te.option, te.tbody = te.tfoot = te.colgroup = te.caption = te.thead, te.th = te.td, rt.fn.extend({
  text: function(t) {
   return rt.access(this, function(t) {
    return t === e ? rt.text(this) : this.empty().append((this[0] && this[0].ownerDocument || z).createTextNode(t))
   }, null, t, arguments.length)
  },
  append: function() {
   return this.domManip(arguments, function(t) {
    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
     d(this, t).appendChild(t)
    }
   })
  },
  prepend: function() {
   return this.domManip(arguments, function(t) {
    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
     var e = d(this, t);
     e.insertBefore(t, e.firstChild)
    }
   })
  },
  before: function() {
   return this.domManip(arguments, function(t) {
    this.parentNode && this.parentNode.insertBefore(t, this)
   })
  },
  after: function() {
   return this.domManip(arguments, function(t) {
    this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
   })
  },
  remove: function(t, e) {
   for (var n, i = t ? rt.filter(t, this) : this, r = 0; null != (n = i[r]); r++) e || 1 !== n.nodeType || rt.cleanData(b(n)), n.parentNode && (e && rt.contains(n.ownerDocument, n) && g(b(n, "script")), n.parentNode.removeChild(n));
   return this
  },
  empty: function() {
   for (var t, e = 0; null != (t = this[e]); e++) {
    for (1 === t.nodeType && rt.cleanData(b(t, !1)); t.firstChild;) t.removeChild(t.firstChild);
    t.options && rt.nodeName(t, "select") && (t.options.length = 0)
   }
   return this
  },
  clone: function(t, e) {
   return t = null != t && t, e = null == e ? t : e, this.map(function() {
    return rt.clone(this, t, e)
   })
  },
  html: function(t) {
   return rt.access(this, function(t) {
    var n = this[0] || {},
     i = 0,
     r = this.length;
    if (t === e) return 1 === n.nodeType ? n.innerHTML.replace(Bt, "") : e;
    if (!("string" != typeof t || Xt.test(t) || !rt.support.htmlSerialize && qt.test(t) || !rt.support.leadingWhitespace && Vt.test(t) || te[(Wt.exec(t) || ["", ""])[1].toLowerCase()])) {
     t = t.replace(zt, "<$1></$2>");
     try {
      for (; r > i; i++) 1 === (n = this[i] || {}).nodeType && (rt.cleanData(b(n, !1)), n.innerHTML = t);
      n = 0
     } catch (t) {}
    }
    n && this.empty().append(t)
   }, null, t, arguments.length)
  },
  replaceWith: function() {
   var t = rt.map(this, function(t) {
     return [t.nextSibling, t.parentNode]
    }),
    e = 0;
   return this.domManip(arguments, function(n) {
    var i = t[e++],
     r = t[e++];
    r && (i && i.parentNode !== r && (i = this.nextSibling), rt(this).remove(), r.insertBefore(n, i))
   }, !0), e ? this : this.remove()
  },
  detach: function(t) {
   return this.remove(t, !0)
  },
  domManip: function(t, e, n) {
   t = Q.apply([], t);
   var i, r, s, o, a, l, c = 0,
    u = this.length,
    h = this,
    p = u - 1,
    d = t[0],
    g = rt.isFunction(d);
   if (g || !(1 >= u || "string" != typeof d || rt.support.checkClone) && Gt.test(d)) return this.each(function(i) {
    var r = h.eq(i);
    g && (t[0] = d.call(this, i, r.html())), r.domManip(t, e, n)
   });
   if (u && (l = rt.buildFragment(t, this[0].ownerDocument, !1, !n && this), i = l.firstChild, 1 === l.childNodes.length && (l = i), i)) {
    for (s = (o = rt.map(b(l, "script"), f)).length; u > c; c++) r = l, c !== p && (r = rt.clone(r, !0, !0), s && rt.merge(o, b(r, "script"))), e.call(this[c], r, c);
    if (s)
     for (a = o[o.length - 1].ownerDocument, rt.map(o, m), c = 0; s > c; c++) r = o[c], Qt.test(r.type || "") && !rt._data(r, "globalEval") && rt.contains(a, r) && (r.src ? rt._evalUrl(r.src) : rt.globalEval((r.text || r.textContent || r.innerHTML || "").replace(Zt, "")));
    l = i = null
   }
   return this
  }
 }), rt.each({
  appendTo: "append",
  prependTo: "prepend",
  insertBefore: "before",
  insertAfter: "after",
  replaceAll: "replaceWith"
 }, function(t, e) {
  rt.fn[t] = function(t) {
   for (var n, i = 0, r = [], s = rt(t), o = s.length - 1; o >= i; i++) n = i === o ? this : this.clone(!0), rt(s[i])[e](n), Y.apply(r, n.get());
   return this.pushStack(r)
  }
 }), rt.extend({
  clone: function(t, e, n) {
   var i, r, s, o, a, l = rt.contains(t.ownerDocument, t);
   if (rt.support.html5Clone || rt.isXMLDoc(t) || !qt.test("<" + t.nodeName + ">") ? s = t.cloneNode(!0) : (ee.innerHTML = t.outerHTML, ee.removeChild(s = ee.firstChild)), !(rt.support.noCloneEvent && rt.support.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || rt.isXMLDoc(t)))
    for (i = b(s), a = b(t), o = 0; null != (r = a[o]); ++o) i[o] && y(r, i[o]);
   if (e)
    if (n)
     for (a = a || b(t), i = i || b(s), o = 0; null != (r = a[o]); o++) v(r, i[o]);
    else v(t, s);
   return (i = b(s, "script")).length > 0 && g(i, !l && b(t, "script")), i = a = r = null, s
  },
  buildFragment: function(t, e, n, i) {
   for (var r, s, o, a, l, c, u, h = t.length, d = p(e), f = [], m = 0; h > m; m++)
    if ((s = t[m]) || 0 === s)
     if ("object" === rt.type(s)) rt.merge(f, s.nodeType ? [s] : s);
     else if (Kt.test(s)) {
    for (a = a || d.appendChild(e.createElement("div")), l = (Wt.exec(s) || ["", ""])[1].toLowerCase(), u = te[l] || te._default, a.innerHTML = u[1] + s.replace(zt, "<$1></$2>") + u[2], r = u[0]; r--;) a = a.lastChild;
    if (!rt.support.leadingWhitespace && Vt.test(s) && f.push(e.createTextNode(Vt.exec(s)[0])), !rt.support.tbody)
     for (r = (s = "table" !== l || Ut.test(s) ? "<table>" !== u[1] || Ut.test(s) ? 0 : a : a.firstChild) && s.childNodes.length; r--;) rt.nodeName(c = s.childNodes[r], "tbody") && !c.childNodes.length && s.removeChild(c);
    for (rt.merge(f, a.childNodes), a.textContent = ""; a.firstChild;) a.removeChild(a.firstChild);
    a = d.lastChild
   } else f.push(e.createTextNode(s));
   for (a && d.removeChild(a), rt.support.appendChecked || rt.grep(b(f, "input"), x), m = 0; s = f[m++];)
    if ((!i || -1 === rt.inArray(s, i)) && (o = rt.contains(s.ownerDocument, s), a = b(d.appendChild(s), "script"), o && g(a), n))
     for (r = 0; s = a[r++];) Qt.test(s.type || "") && n.push(s);
   return a = null, d
  },
  cleanData: function(t, e) {
   for (var n, i, r, s, o = 0, a = rt.expando, l = rt.cache, c = rt.support.deleteExpando, u = rt.event.special; null != (n = t[o]); o++)
    if ((e || rt.acceptData(n)) && (r = n[a], s = r && l[r])) {
     if (s.events)
      for (i in s.events) u[i] ? rt.event.remove(n, i) : rt.removeEvent(n, i, s.handle);
     l[r] && (delete l[r], c ? delete n[a] : typeof n.removeAttribute !== q ? n.removeAttribute(a) : n[a] = null, J.push(r))
    }
  },
  _evalUrl: function(t) {
   return rt.ajax({
    url: t,
    type: "GET",
    dataType: "script",
    async: !1,
    global: !1,
    throws: !0
   })
  }
 }), rt.fn.extend({
  wrapAll: function(t) {
   if (rt.isFunction(t)) return this.each(function(e) {
    rt(this).wrapAll(t.call(this, e))
   });
   if (this[0]) {
    var e = rt(t, this[0].ownerDocument).eq(0).clone(!0);
    this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
     for (var t = this; t.firstChild && 1 === t.firstChild.nodeType;) t = t.firstChild;
     return t
    }).append(this)
   }
   return this
  },
  wrapInner: function(t) {
   return rt.isFunction(t) ? this.each(function(e) {
    rt(this).wrapInner(t.call(this, e))
   }) : this.each(function() {
    var e = rt(this),
     n = e.contents();
    n.length ? n.wrapAll(t) : e.append(t)
   })
  },
  wrap: function(t) {
   var e = rt.isFunction(t);
   return this.each(function(n) {
    rt(this).wrapAll(e ? t.call(this, n) : t)
   })
  },
  unwrap: function() {
   return this.parent().each(function() {
    rt.nodeName(this, "body") || rt(this).replaceWith(this.childNodes)
   }).end()
  }
 });
 var ne, ie, re, se = /alpha\([^)]*\)/i,
  oe = /opacity\s*=\s*([^)]*)/,
  ae = /^(top|right|bottom|left)$/,
  le = /^(none|table(?!-c[ea]).+)/,
  ce = /^margin/,
  ue = RegExp("^(" + st + ")(.*)$", "i"),
  he = RegExp("^(" + st + ")(?!px)[a-z%]+$", "i"),
  pe = RegExp("^([+-])=(" + st + ")", "i"),
  de = {
   BODY: "block"
  },
  fe = {
   position: "absolute",
   visibility: "hidden",
   display: "block"
  },
  me = {
   letterSpacing: 0,
   fontWeight: 400
  },
  ge = ["Top", "Right", "Bottom", "Left"],
  ve = ["Webkit", "O", "Moz", "ms"];
 rt.fn.extend({
  css: function(t, n) {
   return rt.access(this, function(t, n, i) {
    var r, s, o = {},
     a = 0;
    if (rt.isArray(n)) {
     for (s = ie(t), r = n.length; r > a; a++) o[n[a]] = rt.css(t, n[a], !1, s);
     return o
    }
    return i !== e ? rt.style(t, n, i) : rt.css(t, n)
   }, t, n, arguments.length > 1)
  },
  show: function() {
   return S(this, !0)
  },
  hide: function() {
   return S(this)
  },
  toggle: function(t) {
   return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
    k(this) ? rt(this).show() : rt(this).hide()
   })
  }
 }), rt.extend({
  cssHooks: {
   opacity: {
    get: function(t, e) {
     if (e) {
      var n = re(t, "opacity");
      return "" === n ? "1" : n
     }
    }
   }
  },
  cssNumber: {
   columnCount: !0,
   fillOpacity: !0,
   fontWeight: !0,
   lineHeight: !0,
   opacity: !0,
   order: !0,
   orphans: !0,
   widows: !0,
   zIndex: !0,
   zoom: !0
  },
  cssProps: {
   float: rt.support.cssFloat ? "cssFloat" : "styleFloat"
  },
  style: function(t, n, i, r) {
   if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
    var s, o, a, l = rt.camelCase(n),
     c = t.style;
    if (n = rt.cssProps[l] || (rt.cssProps[l] = w(c, l)), a = rt.cssHooks[n] || rt.cssHooks[l], i === e) return a && "get" in a && (s = a.get(t, !1, r)) !== e ? s : c[n];
    if ("string" === (o = typeof i) && (s = pe.exec(i)) && (i = (s[1] + 1) * s[2] + parseFloat(rt.css(t, n)), o = "number"), !(null == i || "number" === o && isNaN(i) || ("number" !== o || rt.cssNumber[l] || (i += "px"), rt.support.clearCloneStyle || "" !== i || 0 !== n.indexOf("background") || (c[n] = "inherit"), a && "set" in a && (i = a.set(t, i, r)) === e))) try {
     c[n] = i
    } catch (t) {}
   }
  },
  css: function(t, n, i, r) {
   var s, o, a, l = rt.camelCase(n);
   return n = rt.cssProps[l] || (rt.cssProps[l] = w(t.style, l)), (a = rt.cssHooks[n] || rt.cssHooks[l]) && "get" in a && (o = a.get(t, !0, i)), o === e && (o = re(t, n, r)), "normal" === o && n in me && (o = me[n]), "" === i || i ? (s = parseFloat(o), !0 === i || rt.isNumeric(s) ? s || 0 : o) : o
  }
 }), t.getComputedStyle ? (ie = function(e) {
  return t.getComputedStyle(e, null)
 }, re = function(t, n, i) {
  var r, s, o, a = i || ie(t),
   l = a ? a.getPropertyValue(n) || a[n] : e,
   c = t.style;
  return a && ("" !== l || rt.contains(t.ownerDocument, t) || (l = rt.style(t, n)), he.test(l) && ce.test(n) && (r = c.width, s = c.minWidth, o = c.maxWidth, c.minWidth = c.maxWidth = c.width = l, l = a.width, c.width = r, c.minWidth = s, c.maxWidth = o)), l
 }) : z.documentElement.currentStyle && (ie = function(t) {
  return t.currentStyle
 }, re = function(t, n, i) {
  var r, s, o, a = i || ie(t),
   l = a ? a[n] : e,
   c = t.style;
  return null == l && c && c[n] && (l = c[n]), he.test(l) && !ae.test(n) && (r = c.left, s = t.runtimeStyle, (o = s && s.left) && (s.left = t.currentStyle.left), c.left = "fontSize" === n ? "1em" : l, l = c.pixelLeft + "px", c.left = r, o && (s.left = o)), "" === l ? "auto" : l
 }), rt.each(["height", "width"], function(t, n) {
  rt.cssHooks[n] = {
   get: function(t, i, r) {
    return i ? 0 === t.offsetWidth && le.test(rt.css(t, "display")) ? rt.swap(t, fe, function() {
     return E(t, n, r)
    }) : E(t, n, r) : e
   },
   set: function(t, e, i) {
    var r = i && ie(t);
    return _(0, e, i ? C(t, n, i, rt.support.boxSizing && "border-box" === rt.css(t, "boxSizing", !1, r), r) : 0)
   }
  }
 }), rt.support.opacity || (rt.cssHooks.opacity = {
  get: function(t, e) {
   return oe.test((e && t.currentStyle ? t.currentStyle.filter : t.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : e ? "1" : ""
  },
  set: function(t, e) {
   var n = t.style,
    i = t.currentStyle,
    r = rt.isNumeric(e) ? "alpha(opacity=" + 100 * e + ")" : "",
    s = i && i.filter || n.filter || "";
   n.zoom = 1, (e >= 1 || "" === e) && "" === rt.trim(s.replace(se, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === e || i && !i.filter) || (n.filter = se.test(s) ? s.replace(se, r) : s + " " + r)
  }
 }), rt(function() {
  rt.support.reliableMarginRight || (rt.cssHooks.marginRight = {
   get: function(t, n) {
    return n ? rt.swap(t, {
     display: "inline-block"
    }, re, [t, "marginRight"]) : e
   }
  }), !rt.support.pixelPosition && rt.fn.position && rt.each(["top", "left"], function(t, n) {
   rt.cssHooks[n] = {
    get: function(t, i) {
     return i ? (i = re(t, n), he.test(i) ? rt(t).position()[n] + "px" : i) : e
    }
   }
  })
 }), rt.expr && rt.expr.filters && (rt.expr.filters.hidden = function(t) {
  return 0 >= t.offsetWidth && 0 >= t.offsetHeight || !rt.support.reliableHiddenOffsets && "none" === (t.style && t.style.display || rt.css(t, "display"))
 }, rt.expr.filters.visible = function(t) {
  return !rt.expr.filters.hidden(t)
 }), rt.each({
  margin: "",
  padding: "",
  border: "Width"
 }, function(t, e) {
  rt.cssHooks[t + e] = {
   expand: function(n) {
    for (var i = 0, r = {}, s = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) r[t + ge[i] + e] = s[i] || s[i - 2] || s[0];
    return r
   }
  }, ce.test(t) || (rt.cssHooks[t + e].set = _)
 });
 var ye = /%20/g,
  be = /\[\]$/,
  xe = /\r?\n/g,
  we = /^(?:submit|button|image|reset|file)$/i,
  ke = /^(?:input|select|textarea|keygen)/i;
 rt.fn.extend({
  serialize: function() {
   return rt.param(this.serializeArray())
  },
  serializeArray: function() {
   return this.map(function() {
    var t = rt.prop(this, "elements");
    return t ? rt.makeArray(t) : this
   }).filter(function() {
    var t = this.type;
    return this.name && !rt(this).is(":disabled") && ke.test(this.nodeName) && !we.test(t) && (this.checked || !Jt.test(t))
   }).map(function(t, e) {
    var n = rt(this).val();
    return null == n ? null : rt.isArray(n) ? rt.map(n, function(t) {
     return {
      name: e.name,
      value: t.replace(xe, "\r\n")
     }
    }) : {
     name: e.name,
     value: n.replace(xe, "\r\n")
    }
   }).get()
  }
 }), rt.param = function(t, n) {
  var i, r = [],
   s = function(t, e) {
    e = rt.isFunction(e) ? e() : null == e ? "" : e, r[r.length] = encodeURIComponent(t) + "=" + encodeURIComponent(e)
   };
  if (n === e && (n = rt.ajaxSettings && rt.ajaxSettings.traditional), rt.isArray(t) || t.jquery && !rt.isPlainObject(t)) rt.each(t, function() {
   s(this.name, this.value)
  });
  else
   for (i in t) P(i, t[i], n, s);
  return r.join("&").replace(ye, "+")
 }, rt.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(t, e) {
  rt.fn[e] = function(t, n) {
   return arguments.length > 0 ? this.on(e, null, t, n) : this.trigger(e)
  }
 }), rt.fn.extend({
  hover: function(t, e) {
   return this.mouseenter(t).mouseleave(e || t)
  },
  bind: function(t, e, n) {
   return this.on(t, null, e, n)
  },
  unbind: function(t, e) {
   return this.off(t, null, e)
  },
  delegate: function(t, e, n, i) {
   return this.on(e, t, n, i)
  },
  undelegate: function(t, e, n) {
   return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", n)
  }
 });
 var Se, _e, Ce = rt.now(),
  Ee = /\?/,
  Te = /#.*$/,
  Ae = /([?&])_=[^&]*/,
  Pe = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
  Ne = /^(?:GET|HEAD)$/,
  De = /^\/\//,
  Ie = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
  je = rt.fn.load,
  Oe = {},
  Le = {},
  $e = "*/".concat("*");
 try {
  _e = V.href
 } catch (t) {
  (_e = z.createElement("a")).href = "", _e = _e.href
 }
 Se = Ie.exec(_e.toLowerCase()) || [], rt.fn.load = function(t, n, i) {
  if ("string" != typeof t && je) return je.apply(this, arguments);
  var r, s, o, a = this,
   l = t.indexOf(" ");
  return l >= 0 && (r = t.slice(l, t.length), t = t.slice(0, l)), rt.isFunction(n) ? (i = n, n = e) : n && "object" == typeof n && (o = "POST"), a.length > 0 && rt.ajax({
   url: t,
   type: o,
   dataType: "html",
   data: n
  }).done(function(t) {
   s = arguments, a.html(r ? rt("<div>").append(rt.parseHTML(t)).find(r) : t)
  }).complete(i && function(t, e) {
   a.each(i, s || [t.responseText, e, t])
  }), this
 }, rt.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
  rt.fn[e] = function(t) {
   return this.on(e, t)
  }
 }), rt.extend({
  active: 0,
  lastModified: {},
  etag: {},
  ajaxSettings: {
   url: _e,
   type: "GET",
   isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Se[1]),
   global: !0,
   processData: !0,
   async: !0,
   contentType: "application/x-www-form-urlencoded; charset=UTF-8",
   accepts: {
    "*": $e,
    text: "text/plain",
    html: "text/html",
    xml: "application/xml, text/xml",
    json: "application/json, text/javascript"
   },
   contents: {
    xml: /xml/,
    html: /html/,
    json: /json/
   },
   responseFields: {
    xml: "responseXML",
    text: "responseText",
    json: "responseJSON"
   },
   converters: {
    "* text": String,
    "text html": !0,
    "text json": rt.parseJSON,
    "text xml": rt.parseXML
   },
   flatOptions: {
    url: !0,
    context: !0
   }
  },
  ajaxSetup: function(t, e) {
   return e ? I(I(t, rt.ajaxSettings), e) : I(rt.ajaxSettings, t)
  },
  ajaxPrefilter: N(Oe),
  ajaxTransport: N(Le),
  ajax: function(t, n) {
   function i(t, n, i, r) {
    var s, h, y, b, w, S = n;
    2 !== x && (x = 2, l && clearTimeout(l), u = e, a = r || "", k.readyState = t > 0 ? 4 : 0, s = t >= 200 && 300 > t || 304 === t, i && (b = function(t, n, i) {
     for (var r, s, o, a, l = t.contents, c = t.dataTypes;
      "*" === c[0];) c.shift(), s === e && (s = t.mimeType || n.getResponseHeader("Content-Type"));
     if (s)
      for (a in l)
       if (l[a] && l[a].test(s)) {
        c.unshift(a);
        break
       }
     if (c[0] in i) o = c[0];
     else {
      for (a in i) {
       if (!c[0] || t.converters[a + " " + c[0]]) {
        o = a;
        break
       }
       r || (r = a)
      }
      o = o || r
     }
     return o ? (o !== c[0] && c.unshift(o), i[o]) : e
    }(p, k, i)), b = function(t, e, n, i) {
     var r, s, o, a, l, c = {},
      u = t.dataTypes.slice();
     if (u[1])
      for (o in t.converters) c[o.toLowerCase()] = t.converters[o];
     for (s = u.shift(); s;)
      if (t.responseFields[s] && (n[t.responseFields[s]] = e), !l && i && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = s, s = u.shift())
       if ("*" === s) s = l;
       else if ("*" !== l && l !== s) {
      if (!(o = c[l + " " + s] || c["* " + s]))
       for (r in c)
        if ((a = r.split(" "))[1] === s && (o = c[l + " " + a[0]] || c["* " + a[0]])) {
         !0 === o ? o = c[r] : !0 !== c[r] && (s = a[0], u.unshift(a[1]));
         break
        }
      if (!0 !== o)
       if (o && t.throws) e = o(e);
       else try {
        e = o(e)
       } catch (t) {
        return {
         state: "parsererror",
         error: o ? t : "No conversion from " + l + " to " + s
        }
       }
     }
     return {
      state: "success",
      data: e
     }
    }(p, b, k, s), s ? (p.ifModified && ((w = k.getResponseHeader("Last-Modified")) && (rt.lastModified[o] = w), (w = k.getResponseHeader("etag")) && (rt.etag[o] = w)), 204 === t || "HEAD" === p.type ? S = "nocontent" : 304 === t ? S = "notmodified" : (S = b.state, h = b.data, y = b.error, s = !y)) : (y = S, (t || !S) && (S = "error", 0 > t && (t = 0))), k.status = t, k.statusText = (n || S) + "", s ? m.resolveWith(d, [h, S, k]) : m.rejectWith(d, [k, S, y]), k.statusCode(v), v = e, c && f.trigger(s ? "ajaxSuccess" : "ajaxError", [k, p, s ? h : y]), g.fireWith(d, [k, S]), c && (f.trigger("ajaxComplete", [k, p]), --rt.active || rt.event.trigger("ajaxStop")))
   }
   "object" == typeof t && (n = t, t = e), n = n || {};
   var r, s, o, a, l, c, u, h, p = rt.ajaxSetup({}, n),
    d = p.context || p,
    f = p.context && (d.nodeType || d.jquery) ? rt(d) : rt.event,
    m = rt.Deferred(),
    g = rt.Callbacks("once memory"),
    v = p.statusCode || {},
    y = {},
    b = {},
    x = 0,
    w = "canceled",
    k = {
     readyState: 0,
     getResponseHeader: function(t) {
      var e;
      if (2 === x) {
       if (!h)
        for (h = {}; e = Pe.exec(a);) h[e[1].toLowerCase()] = e[2];
       e = h[t.toLowerCase()]
      }
      return null == e ? null : e
     },
     getAllResponseHeaders: function() {
      return 2 === x ? a : null
     },
     setRequestHeader: function(t, e) {
      var n = t.toLowerCase();
      return x || (t = b[n] = b[n] || t, y[t] = e), this
     },
     overrideMimeType: function(t) {
      return x || (p.mimeType = t), this
     },
     statusCode: function(t) {
      var e;
      if (t)
       if (2 > x)
        for (e in t) v[e] = [v[e], t[e]];
       else k.always(t[k.status]);
      return this
     },
     abort: function(t) {
      var e = t || w;
      return u && u.abort(e), i(0, e), this
     }
    };
   if (m.promise(k).complete = g.add, k.success = k.done, k.error = k.fail, p.url = ((t || p.url || _e) + "").replace(Te, "").replace(De, Se[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = rt.trim(p.dataType || "*").toLowerCase().match(ot) || [""], null == p.crossDomain && (r = Ie.exec(p.url.toLowerCase()), p.crossDomain = !(!r || r[1] === Se[1] && r[2] === Se[2] && (r[3] || ("http:" === r[1] ? "80" : "443")) === (Se[3] || ("http:" === Se[1] ? "80" : "443")))), p.data && p.processData && "string" != typeof p.data && (p.data = rt.param(p.data, p.traditional)), D(Oe, p, n, k), 2 === x) return k;
   (c = p.global) && 0 == rt.active++ && rt.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Ne.test(p.type), o = p.url, p.hasContent || (p.data && (o = p.url += (Ee.test(o) ? "&" : "?") + p.data, delete p.data), !1 === p.cache && (p.url = Ae.test(o) ? o.replace(Ae, "$1_=" + Ce++) : o + (Ee.test(o) ? "&" : "?") + "_=" + Ce++)), p.ifModified && (rt.lastModified[o] && k.setRequestHeader("If-Modified-Since", rt.lastModified[o]), rt.etag[o] && k.setRequestHeader("If-None-Match", rt.etag[o])), (p.data && p.hasContent && !1 !== p.contentType || n.contentType) && k.setRequestHeader("Content-Type", p.contentType), k.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + $e + "; q=0.01" : "") : p.accepts["*"]);
   for (s in p.headers) k.setRequestHeader(s, p.headers[s]);
   if (p.beforeSend && (!1 === p.beforeSend.call(d, k, p) || 2 === x)) return k.abort();
   w = "abort";
   for (s in {
     success: 1,
     error: 1,
     complete: 1
    }) k[s](p[s]);
   if (u = D(Le, p, n, k)) {
    k.readyState = 1, c && f.trigger("ajaxSend", [k, p]), p.async && p.timeout > 0 && (l = setTimeout(function() {
     k.abort("timeout")
    }, p.timeout));
    try {
     x = 1, u.send(y, i)
    } catch (t) {
     if (!(2 > x)) throw t;
     i(-1, t)
    }
   } else i(-1, "No Transport");
   return k
  },
  getJSON: function(t, e, n) {
   return rt.get(t, e, n, "json")
  },
  getScript: function(t, n) {
   return rt.get(t, e, n, "script")
  }
 }), rt.each(["get", "post"], function(t, n) {
  rt[n] = function(t, i, r, s) {
   return rt.isFunction(i) && (s = s || r, r = i, i = e), rt.ajax({
    url: t,
    type: n,
    dataType: s,
    data: i,
    success: r
   })
  }
 }), rt.ajaxSetup({
  accepts: {
   script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
  },
  contents: {
   script: /(?:java|ecma)script/
  },
  converters: {
   "text script": function(t) {
    return rt.globalEval(t), t
   }
  }
 }), rt.ajaxPrefilter("script", function(t) {
  t.cache === e && (t.cache = !1), t.crossDomain && (t.type = "GET", t.global = !1)
 }), rt.ajaxTransport("script", function(t) {
  if (t.crossDomain) {
   var n, i = z.head || rt("head")[0] || z.documentElement;
   return {
    send: function(e, r) {
     (n = z.createElement("script")).async = !0, t.scriptCharset && (n.charset = t.scriptCharset), n.src = t.url, n.onload = n.onreadystatechange = function(t, e) {
      (e || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, e || r(200, "success"))
     }, i.insertBefore(n, i.firstChild)
    },
    abort: function() {
     n && n.onload(e, !0)
    }
   }
  }
 });
 var Re = [],
  He = /(=)\?(?=&|$)|\?\?/;
 rt.ajaxSetup({
  jsonp: "callback",
  jsonpCallback: function() {
   var t = Re.pop() || rt.expando + "_" + Ce++;
   return this[t] = !0, t
  }
 }), rt.ajaxPrefilter("json jsonp", function(n, i, r) {
  var s, o, a, l = !1 !== n.jsonp && (He.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && He.test(n.data) && "data");
  return l || "jsonp" === n.dataTypes[0] ? (s = n.jsonpCallback = rt.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, l ? n[l] = n[l].replace(He, "$1" + s) : !1 !== n.jsonp && (n.url += (Ee.test(n.url) ? "&" : "?") + n.jsonp + "=" + s), n.converters["script json"] = function() {
   return a || rt.error(s + " was not called"), a[0]
  }, n.dataTypes[0] = "json", o = t[s], t[s] = function() {
   a = arguments
  }, r.always(function() {
   t[s] = o, n[s] && (n.jsonpCallback = i.jsonpCallback, Re.push(s)), a && rt.isFunction(o) && o(a[0]), a = o = e
  }), "script") : e
 });
 var Me, Fe, Be = 0,
  qe = t.ActiveXObject && function() {
   var t;
   for (t in Me) Me[t](e, !0)
  };
 rt.ajaxSettings.xhr = t.ActiveXObject ? function() {
  return !this.isLocal && j() || function() {
   try {
    return new t.ActiveXObject("Microsoft.XMLHTTP")
   } catch (t) {}
  }()
 } : j, Fe = rt.ajaxSettings.xhr(), rt.support.cors = !!Fe && "withCredentials" in Fe, (Fe = rt.support.ajax = !!Fe) && rt.ajaxTransport(function(n) {
  if (!n.crossDomain || rt.support.cors) {
   var i;
   return {
    send: function(r, s) {
     var o, a, l = n.xhr();
     if (n.username ? l.open(n.type, n.url, n.async, n.username, n.password) : l.open(n.type, n.url, n.async), n.xhrFields)
      for (a in n.xhrFields) l[a] = n.xhrFields[a];
     n.mimeType && l.overrideMimeType && l.overrideMimeType(n.mimeType), n.crossDomain || r["X-Requested-With"] || (r["X-Requested-With"] = "XMLHttpRequest");
     try {
      for (a in r) l.setRequestHeader(a, r[a])
     } catch (t) {}
     l.send(n.hasContent && n.data || null), i = function(t, r) {
      var a, c, u, h;
      try {
       if (i && (r || 4 === l.readyState))
        if (i = e, o && (l.onreadystatechange = rt.noop, qe && delete Me[o]), r) 4 !== l.readyState && l.abort();
        else {
         h = {}, a = l.status, c = l.getAllResponseHeaders(), "string" == typeof l.responseText && (h.text = l.responseText);
         try {
          u = l.statusText
         } catch (t) {
          u = ""
         }
         a || !n.isLocal || n.crossDomain ? 1223 === a && (a = 204) : a = h.text ? 200 : 404
        }
      } catch (t) {
       r || s(-1, t)
      }
      h && s(a, u, h, c)
     }, n.async ? 4 === l.readyState ? setTimeout(i) : (o = ++Be, qe && (Me || (Me = {}, rt(t).unload(qe)), Me[o] = i), l.onreadystatechange = i) : i()
    },
    abort: function() {
     i && i(e, !0)
    }
   }
  }
 });
 var Ve, ze, We = /^(?:toggle|show|hide)$/,
  Ue = RegExp("^(?:([+-])=|)(" + st + ")([a-z%]*)$", "i"),
  Ke = /queueHooks$/,
  Xe = [function(t, e, n) {
   var i, r, s, o, a, l, c = this,
    u = {},
    h = t.style,
    p = t.nodeType && k(t),
    d = rt._data(t, "fxshow");
   n.queue || (null == (a = rt._queueHooks(t, "fx")).unqueued && (a.unqueued = 0, l = a.empty.fire, a.empty.fire = function() {
    a.unqueued || l()
   }), a.unqueued++, c.always(function() {
    c.always(function() {
     a.unqueued--, rt.queue(t, "fx").length || a.empty.fire()
    })
   })), 1 === t.nodeType && ("height" in e || "width" in e) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], "inline" === rt.css(t, "display") && "none" === rt.css(t, "float") && (rt.support.inlineBlockNeedsLayout && "inline" !== T(t.nodeName) ? h.zoom = 1 : h.display = "inline-block")), n.overflow && (h.overflow = "hidden", rt.support.shrinkWrapBlocks || c.always(function() {
    h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
   }));
   for (i in e)
    if (r = e[i], We.exec(r)) {
     if (delete e[i], s = s || "toggle" === r, r === (p ? "hide" : "show")) continue;
     u[i] = d && d[i] || rt.style(t, i)
    }
   if (!rt.isEmptyObject(u)) {
    d ? "hidden" in d && (p = d.hidden) : d = rt._data(t, "fxshow", {}), s && (d.hidden = !p), p ? rt(t).show() : c.done(function() {
     rt(t).hide()
    }), c.done(function() {
     var e;
     rt._removeData(t, "fxshow");
     for (e in u) rt.style(t, e, u[e])
    });
    for (i in u) o = L(p ? d[i] : 0, i, c), i in d || (d[i] = o.start, p && (o.end = o.start, o.start = "width" === i || "height" === i ? 1 : 0))
   }
  }],
  Je = {
   "*": [function(t, e) {
    var n = this.createTween(t, e),
     i = n.cur(),
     r = Ue.exec(e),
     s = r && r[3] || (rt.cssNumber[t] ? "" : "px"),
     o = (rt.cssNumber[t] || "px" !== s && +i) && Ue.exec(rt.css(n.elem, t)),
     a = 1,
     l = 20;
    if (o && o[3] !== s) {
     s = s || o[3], r = r || [], o = +i || 1;
     do {
      a = a || ".5", o /= a, rt.style(n.elem, t, o + s)
     } while (a !== (a = n.cur() / i) && 1 !== a && --l)
    }
    return r && (o = n.start = +o || +i || 0, n.unit = s, n.end = r[1] ? o + (r[1] + 1) * r[2] : +r[2]), n
   }]
  };
 rt.Animation = rt.extend($, {
  tweener: function(t, e) {
   rt.isFunction(t) ? (e = t, t = ["*"]) : t = t.split(" ");
   for (var n, i = 0, r = t.length; r > i; i++) n = t[i], Je[n] = Je[n] || [], Je[n].unshift(e)
  },
  prefilter: function(t, e) {
   e ? Xe.unshift(t) : Xe.push(t)
  }
 }), rt.Tween = R, (R.prototype = {
  constructor: R,
  init: function(t, e, n, i, r, s) {
   this.elem = t, this.prop = n, this.easing = r || "swing", this.options = e, this.start = this.now = this.cur(), this.end = i, this.unit = s || (rt.cssNumber[n] ? "" : "px")
  },
  cur: function() {
   var t = R.propHooks[this.prop];
   return t && t.get ? t.get(this) : R.propHooks._default.get(this)
  },
  run: function(t) {
   var e, n = R.propHooks[this.prop];
   return this.pos = e = this.options.duration ? rt.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : R.propHooks._default.set(this), this
  }
 }).init.prototype = R.prototype, (R.propHooks = {
  _default: {
   get: function(t) {
    var e;
    return null == t.elem[t.prop] || t.elem.style && null != t.elem.style[t.prop] ? (e = rt.css(t.elem, t.prop, "")) && "auto" !== e ? e : 0 : t.elem[t.prop]
   },
   set: function(t) {
    rt.fx.step[t.prop] ? rt.fx.step[t.prop](t) : t.elem.style && (null != t.elem.style[rt.cssProps[t.prop]] || rt.cssHooks[t.prop]) ? rt.style(t.elem, t.prop, t.now + t.unit) : t.elem[t.prop] = t.now
   }
  }
 }).scrollTop = R.propHooks.scrollLeft = {
  set: function(t) {
   t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
  }
 }, rt.each(["toggle", "show", "hide"], function(t, e) {
  var n = rt.fn[e];
  rt.fn[e] = function(t, i, r) {
   return null == t || "boolean" == typeof t ? n.apply(this, arguments) : this.animate(H(e, !0), t, i, r)
  }
 }), rt.fn.extend({
  fadeTo: function(t, e, n, i) {
   return this.filter(k).css("opacity", 0).show().end().animate({
    opacity: e
   }, t, n, i)
  },
  animate: function(t, e, n, i) {
   var r = rt.isEmptyObject(t),
    s = rt.speed(e, n, i),
    o = function() {
     var e = $(this, rt.extend({}, t), s);
     (r || rt._data(this, "finish")) && e.stop(!0)
    };
   return o.finish = o, r || !1 === s.queue ? this.each(o) : this.queue(s.queue, o)
  },
  stop: function(t, n, i) {
   var r = function(t) {
    var e = t.stop;
    delete t.stop, e(i)
   };
   return "string" != typeof t && (i = n, n = t, t = e), n && !1 !== t && this.queue(t || "fx", []), this.each(function() {
    var e = !0,
     n = null != t && t + "queueHooks",
     s = rt.timers,
     o = rt._data(this);
    if (n) o[n] && o[n].stop && r(o[n]);
    else
     for (n in o) o[n] && o[n].stop && Ke.test(n) && r(o[n]);
    for (n = s.length; n--;) s[n].elem !== this || null != t && s[n].queue !== t || (s[n].anim.stop(i), e = !1, s.splice(n, 1));
    (e || !i) && rt.dequeue(this, t)
   })
  },
  finish: function(t) {
   return !1 !== t && (t = t || "fx"), this.each(function() {
    var e, n = rt._data(this),
     i = n[t + "queue"],
     r = n[t + "queueHooks"],
     s = rt.timers,
     o = i ? i.length : 0;
    for (n.finish = !0, rt.queue(this, t, []), r && r.stop && r.stop.call(this, !0), e = s.length; e--;) s[e].elem === this && s[e].queue === t && (s[e].anim.stop(!0), s.splice(e, 1));
    for (e = 0; o > e; e++) i[e] && i[e].finish && i[e].finish.call(this);
    delete n.finish
   })
  }
 }), rt.each({
  slideDown: H("show"),
  slideUp: H("hide"),
  slideToggle: H("toggle"),
  fadeIn: {
   opacity: "show"
  },
  fadeOut: {
   opacity: "hide"
  },
  fadeToggle: {
   opacity: "toggle"
  }
 }, function(t, e) {
  rt.fn[t] = function(t, n, i) {
   return this.animate(e, t, n, i)
  }
 }), rt.speed = function(t, e, n) {
  var i = t && "object" == typeof t ? rt.extend({}, t) : {
   complete: n || !n && e || rt.isFunction(t) && t,
   duration: t,
   easing: n && e || e && !rt.isFunction(e) && e
  };
  return i.duration = rt.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in rt.fx.speeds ? rt.fx.speeds[i.duration] : rt.fx.speeds._default, (null == i.queue || !0 === i.queue) && (i.queue = "fx"), i.old = i.complete, i.complete = function() {
   rt.isFunction(i.old) && i.old.call(this), i.queue && rt.dequeue(this, i.queue)
  }, i
 }, rt.easing = {
  linear: function(t) {
   return t
  },
  swing: function(t) {
   return .5 - Math.cos(t * Math.PI) / 2
  }
 }, rt.timers = [], rt.fx = R.prototype.init, rt.fx.tick = function() {
  var t, n = rt.timers,
   i = 0;
  for (Ve = rt.now(); n.length > i; i++)(t = n[i])() || n[i] !== t || n.splice(i--, 1);
  n.length || rt.fx.stop(), Ve = e
 }, rt.fx.timer = function(t) {
  t() && rt.timers.push(t) && rt.fx.start()
 }, rt.fx.interval = 13, rt.fx.start = function() {
  ze || (ze = setInterval(rt.fx.tick, rt.fx.interval))
 }, rt.fx.stop = function() {
  clearInterval(ze), ze = null
 }, rt.fx.speeds = {
  slow: 600,
  fast: 200,
  _default: 400
 }, rt.fx.step = {}, rt.expr && rt.expr.filters && (rt.expr.filters.animated = function(t) {
  return rt.grep(rt.timers, function(e) {
   return t === e.elem
  }).length
 }), rt.fn.offset = function(t) {
  if (arguments.length) return t === e ? this : this.each(function(e) {
   rt.offset.setOffset(this, t, e)
  });
  var n, i, r = {
    top: 0,
    left: 0
   },
   s = this[0],
   o = s && s.ownerDocument;
  return o ? (n = o.documentElement, rt.contains(n, s) ? (typeof s.getBoundingClientRect !== q && (r = s.getBoundingClientRect()), i = M(o), {
   top: r.top + (i.pageYOffset || n.scrollTop) - (n.clientTop || 0),
   left: r.left + (i.pageXOffset || n.scrollLeft) - (n.clientLeft || 0)
  }) : r) : void 0
 }, rt.offset = {
  setOffset: function(t, e, n) {
   var i = rt.css(t, "position");
   "static" === i && (t.style.position = "relative");
   var r, s, o = rt(t),
    a = o.offset(),
    l = rt.css(t, "top"),
    c = rt.css(t, "left"),
    u = {},
    h = {};
   ("absolute" === i || "fixed" === i) && rt.inArray("auto", [l, c]) > -1 ? (h = o.position(), r = h.top, s = h.left) : (r = parseFloat(l) || 0, s = parseFloat(c) || 0), rt.isFunction(e) && (e = e.call(t, n, a)), null != e.top && (u.top = e.top - a.top + r), null != e.left && (u.left = e.left - a.left + s), "using" in e ? e.using.call(t, u) : o.css(u)
  }
 }, rt.fn.extend({
  position: function() {
   if (this[0]) {
    var t, e, n = {
      top: 0,
      left: 0
     },
     i = this[0];
    return "fixed" === rt.css(i, "position") ? e = i.getBoundingClientRect() : (t = this.offsetParent(), e = this.offset(), rt.nodeName(t[0], "html") || (n = t.offset()), n.top += rt.css(t[0], "borderTopWidth", !0), n.left += rt.css(t[0], "borderLeftWidth", !0)), {
     top: e.top - n.top - rt.css(i, "marginTop", !0),
     left: e.left - n.left - rt.css(i, "marginLeft", !0)
    }
   }
  },
  offsetParent: function() {
   return this.map(function() {
    for (var t = this.offsetParent || W; t && !rt.nodeName(t, "html") && "static" === rt.css(t, "position");) t = t.offsetParent;
    return t || W
   })
  }
 }), rt.each({
  scrollLeft: "pageXOffset",
  scrollTop: "pageYOffset"
 }, function(t, n) {
  var i = /Y/.test(n);
  rt.fn[t] = function(r) {
   return rt.access(this, function(t, r, s) {
    var o = M(t);
    return s === e ? o ? n in o ? o[n] : o.document.documentElement[r] : t[r] : (o ? o.scrollTo(i ? rt(o).scrollLeft() : s, i ? s : rt(o).scrollTop()) : t[r] = s, e)
   }, t, r, arguments.length, null)
  }
 }), rt.each({
  Height: "height",
  Width: "width"
 }, function(t, n) {
  rt.each({
   padding: "inner" + t,
   content: n,
   "": "outer" + t
  }, function(i, r) {
   rt.fn[r] = function(r, s) {
    var o = arguments.length && (i || "boolean" != typeof r),
     a = i || (!0 === r || !0 === s ? "margin" : "border");
    return rt.access(this, function(n, i, r) {
     var s;
     return rt.isWindow(n) ? n.document.documentElement["client" + t] : 9 === n.nodeType ? (s = n.documentElement, Math.max(n.body["scroll" + t], s["scroll" + t], n.body["offset" + t], s["offset" + t], s["client" + t])) : r === e ? rt.css(n, i, a) : rt.style(n, i, r, a)
    }, n, o ? r : e, o, null)
   }
  })
 }), rt.fn.size = function() {
  return this.length
 }, rt.fn.andSelf = rt.fn.addBack, "object" == typeof module && module && "object" == typeof module.exports ? module.exports = rt : (t.jQuery = t.$ = rt, "function" == typeof define && define.amd && define("jquery", [], function() {
  return rt
 }))
}(window),
function(t) {
 "use strict";
 "function" == typeof define && define.amd ? define(["jquery"], t) : t("undefined" != typeof jQuery ? jQuery : window.Zepto)
}(function(t) {
 "use strict";

 function e(e) {
  var n = e.data;
  e.isDefaultPrevented() || (e.preventDefault(), t(e.target).ajaxSubmit(n))
 }

 function n(e) {
  var n = e.target,
   i = t(n);
  if (!i.is("[type=submit],[type=image]")) {
   var r = i.closest("[type=submit]");
   if (0 === r.length) return;
   n = r[0]
  }
  var s = this;
  if (s.clk = n, "image" == n.type)
   if (void 0 !== e.offsetX) s.clk_x = e.offsetX, s.clk_y = e.offsetY;
   else if ("function" == typeof t.fn.offset) {
   var o = i.offset();
   s.clk_x = e.pageX - o.left, s.clk_y = e.pageY - o.top
  } else s.clk_x = e.pageX - n.offsetLeft, s.clk_y = e.pageY - n.offsetTop;
  setTimeout(function() {
   s.clk = s.clk_x = s.clk_y = null
  }, 100)
 }

 function i() {
  if (t.fn.ajaxSubmit.debug) {
   var e = "[jquery.form] " + Array.prototype.join.call(arguments, "");
   window.console && window.console.log ? window.console.log(e) : window.opera && window.opera.postError && window.opera.postError(e)
  }
 }
 var r = {};
 r.fileapi = void 0 !== t("<input type='file'/>").get(0).files, r.formdata = void 0 !== window.FormData;
 var s = !!t.fn.prop;
 t.fn.attr2 = function() {
  if (!s) return this.attr.apply(this, arguments);
  var t = this.prop.apply(this, arguments);
  return t && t.jquery || "string" == typeof t ? t : this.attr.apply(this, arguments)
 }, t.fn.ajaxSubmit = function(e) {
  function n(n) {
   function r(t) {
    var e = null;
    try {
     t.contentWindow && (e = t.contentWindow.document)
    } catch (t) {
     i("cannot get iframe.contentWindow document: " + t)
    }
    if (e) return e;
    try {
     e = t.contentDocument ? t.contentDocument : t.document
    } catch (n) {
     i("cannot get iframe.contentDocument: " + n), e = t.document
    }
    return e
   }

   function a() {
    function e() {
     try {
      var t = r(v).readyState;
      i("state = " + t), t && "uninitialized" == t.toLowerCase() && setTimeout(e, 50)
     } catch (t) {
      i("Server abort: ", t, " (", t.name, ")"), l(E), k && clearTimeout(k), k = void 0
     }
    }
    var n = c.attr2("target"),
     s = c.attr2("action"),
     a = c.attr("enctype") || c.attr("encoding") || "multipart/form-data";
    S.setAttribute("target", m), o && !/post/i.test(o) || S.setAttribute("method", "POST"), s != p.url && S.setAttribute("action", p.url), p.skipEncodingOverride || o && !/post/i.test(o) || c.attr({
     encoding: "multipart/form-data",
     enctype: "multipart/form-data"
    }), p.timeout && (k = setTimeout(function() {
     w = !0, l(C)
    }, p.timeout));
    var u = [];
    try {
     if (p.extraData)
      for (var h in p.extraData) p.extraData.hasOwnProperty(h) && (t.isPlainObject(p.extraData[h]) && p.extraData[h].hasOwnProperty("name") && p.extraData[h].hasOwnProperty("value") ? u.push(t('<input type="hidden" name="' + p.extraData[h].name + '">').val(p.extraData[h].value).appendTo(S)[0]) : u.push(t('<input type="hidden" name="' + h + '">').val(p.extraData[h]).appendTo(S)[0]));
     p.iframeTarget || g.appendTo("body"), v.attachEvent ? v.attachEvent("onload", l) : v.addEventListener("load", l, !1), setTimeout(e, 15);
     try {
      S.submit()
     } catch (t) {
      document.createElement("form").submit.apply(S)
     }
    } finally {
     S.setAttribute("action", s), S.setAttribute("enctype", a), n ? S.setAttribute("target", n) : c.removeAttr("target"), t(u).remove()
    }
   }

   function l(e) {
    if (!y.aborted && !D) {
     if ((N = r(v)) || (i("cannot access response document"), e = E), e === C && y) return y.abort("timeout"), void _.reject(y, "timeout");
     if (e == E && y) return y.abort("server abort"), void _.reject(y, "error", "server abort");
     if (N && N.location.href != p.iframeSrc || w) {
      v.detachEvent ? v.detachEvent("onload", l) : v.removeEventListener("load", l, !1);
      var n, s = "success";
      try {
       if (w) throw "timeout";
       var o = "xml" == p.dataType || N.XMLDocument || t.isXMLDoc(N);
       if (i("isXml=" + o), !o && window.opera && (null === N.body || !N.body.innerHTML) && --I) return i("requeing onLoad callback, DOM not available"), void setTimeout(l, 250);
       var a = N.body ? N.body : N.documentElement;
       y.responseText = a ? a.innerHTML : null, y.responseXML = N.XMLDocument ? N.XMLDocument : N, o && (p.dataType = "xml"), y.getResponseHeader = function(t) {
        return {
         "content-type": p.dataType
        }[t.toLowerCase()]
       }, a && (y.status = Number(a.getAttribute("status")) || y.status, y.statusText = a.getAttribute("statusText") || y.statusText);
       var c = (p.dataType || "").toLowerCase(),
        u = /(json|script|text)/.test(c);
       if (u || p.textarea) {
        var h = N.getElementsByTagName("textarea")[0];
        if (h) y.responseText = h.value, y.status = Number(h.getAttribute("status")) || y.status, y.statusText = h.getAttribute("statusText") || y.statusText;
        else if (u) {
         var d = N.getElementsByTagName("pre")[0],
          m = N.getElementsByTagName("body")[0];
         d ? y.responseText = d.textContent ? d.textContent : d.innerText : m && (y.responseText = m.textContent ? m.textContent : m.innerText)
        }
       } else "xml" == c && !y.responseXML && y.responseText && (y.responseXML = j(y.responseText));
       try {
        P = L(y, c, p)
       } catch (t) {
        s = "parsererror", y.error = n = t || s
       }
      } catch (t) {
       i("error caught: ", t), s = "error", y.error = n = t || s
      }
      y.aborted && (i("upload aborted"), s = null), y.status && (s = y.status >= 200 && y.status < 300 || 304 === y.status ? "success" : "error"), "success" === s ? (p.success && p.success.call(p.context, P, "success", y), _.resolve(y.responseText, "success", y), f && t.event.trigger("ajaxSuccess", [y, p])) : s && (void 0 === n && (n = y.statusText), p.error && p.error.call(p.context, y, s, n), _.reject(y, "error", n), f && t.event.trigger("ajaxError", [y, p, n])), f && t.event.trigger("ajaxComplete", [y, p]), f && !--t.active && t.event.trigger("ajaxStop"), p.complete && p.complete.call(p.context, y, s), D = !0, p.timeout && clearTimeout(k), setTimeout(function() {
       p.iframeTarget ? g.attr("src", p.iframeSrc) : g.remove(), y.responseXML = null
      }, 100)
     }
    }
   }
   var u, h, p, f, m, g, v, y, b, x, w, k, S = c[0],
    _ = t.Deferred();
   if (_.abort = function(t) {
     y.abort(t)
    }, n)
    for (h = 0; h < d.length; h++) u = t(d[h]), s ? u.prop("disabled", !1) : u.removeAttr("disabled");
   if (p = t.extend(!0, {}, t.ajaxSettings, e), p.context = p.context || p, m = "jqFormIO" + (new Date).getTime(), p.iframeTarget ? (x = (g = t(p.iframeTarget)).attr2("name")) ? m = x : g.attr2("name", m) : (g = t('<iframe name="' + m + '" src="' + p.iframeSrc + '" />')).css({
     position: "absolute",
     top: "-1000px",
     left: "-1000px"
    }), v = g[0], y = {
     aborted: 0,
     responseText: null,
     responseXML: null,
     status: 0,
     statusText: "n/a",
     getAllResponseHeaders: function() {},
     getResponseHeader: function() {},
     setRequestHeader: function() {},
     abort: function(e) {
      var n = "timeout" === e ? "timeout" : "aborted";
      i("aborting upload... " + n), this.aborted = 1;
      try {
       v.contentWindow.document.execCommand && v.contentWindow.document.execCommand("Stop")
      } catch (t) {}
      g.attr("src", p.iframeSrc), y.error = n, p.error && p.error.call(p.context, y, n, e), f && t.event.trigger("ajaxError", [y, p, n]), p.complete && p.complete.call(p.context, y, n)
     }
    }, (f = p.global) && 0 == t.active++ && t.event.trigger("ajaxStart"), f && t.event.trigger("ajaxSend", [y, p]), p.beforeSend && !1 === p.beforeSend.call(p.context, y, p)) return p.global && t.active--, _.reject(), _;
   if (y.aborted) return _.reject(), _;
   (b = S.clk) && (x = b.name) && !b.disabled && (p.extraData = p.extraData || {}, p.extraData[x] = b.value, "image" == b.type && (p.extraData[x + ".x"] = S.clk_x, p.extraData[x + ".y"] = S.clk_y));
   var C = 1,
    E = 2,
    T = t("meta[name=csrf-token]").attr("content"),
    A = t("meta[name=csrf-param]").attr("content");
   A && T && (p.extraData = p.extraData || {}, p.extraData[A] = T), p.forceSync ? a() : setTimeout(a, 10);
   var P, N, D, I = 50,
    j = t.parseXML || function(t, e) {
     return window.ActiveXObject ? ((e = new ActiveXObject("Microsoft.XMLDOM")).async = "false", e.loadXML(t)) : e = (new DOMParser).parseFromString(t, "text/xml"), e && e.documentElement && "parsererror" != e.documentElement.nodeName ? e : null
    },
    O = t.parseJSON || function(t) {
     return window.eval("(" + t + ")")
    },
    L = function(e, n, i) {
     var r = e.getResponseHeader("content-type") || "",
      s = "xml" === n || !n && r.indexOf("xml") >= 0,
      o = s ? e.responseXML : e.responseText;
     return s && "parsererror" === o.documentElement.nodeName && t.error && t.error("parsererror"), i && i.dataFilter && (o = i.dataFilter(o, n)), "string" == typeof o && ("json" === n || !n && r.indexOf("json") >= 0 ? o = O(o) : ("script" === n || !n && r.indexOf("javascript") >= 0) && t.globalEval(o)), o
    };
   return _
  }
  if (!this.length) return i("ajaxSubmit: skipping submit process - no element selected"), this;
  var o, a, l, c = this;
  "function" == typeof e ? e = {
   success: e
  } : void 0 === e && (e = {}), o = e.type || this.attr2("method"), (l = (l = "string" == typeof(a = e.url || this.attr2("action")) ? t.trim(a) : "") || window.location.href || "") && (l = (l.match(/^([^#]+)/) || [])[1]), e = t.extend(!0, {
   url: l,
   success: t.ajaxSettings.success,
   type: o || t.ajaxSettings.type,
   iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
  }, e);
  var u = {};
  if (this.trigger("form-pre-serialize", [this, e, u]), u.veto) return i("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
  if (e.beforeSerialize && !1 === e.beforeSerialize(this, e)) return i("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
  var h = e.traditional;
  void 0 === h && (h = t.ajaxSettings.traditional);
  var p, d = [],
   f = this.formToArray(e.semantic, d);
  if (e.data && (e.extraData = e.data, p = t.param(e.data, h)), e.beforeSubmit && !1 === e.beforeSubmit(f, this, e)) return i("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
  if (this.trigger("form-submit-validate", [f, this, e, u]), u.veto) return i("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
  var m = t.param(f, h);
  p && (m = m ? m + "&" + p : p), "GET" == e.type.toUpperCase() ? (e.url += (e.url.indexOf("?") >= 0 ? "&" : "?") + m, e.data = null) : e.data = m;
  var g = [];
  if (e.resetForm && g.push(function() {
    c.resetForm()
   }), e.clearForm && g.push(function() {
    c.clearForm(e.includeHidden)
   }), !e.dataType && e.target) {
   var v = e.success || function() {};
   g.push(function(n) {
    var i = e.replaceTarget ? "replaceWith" : "html";
    t(e.target)[i](n).each(v, arguments)
   })
  } else e.success && g.push(e.success);
  if (e.success = function(t, n, i) {
    for (var r = e.context || this, s = 0, o = g.length; s < o; s++) g[s].apply(r, [t, n, i || c, c])
   }, e.error) {
   var y = e.error;
   e.error = function(t, n, i) {
    var r = e.context || this;
    y.apply(r, [t, n, i, c])
   }
  }
  if (e.complete) {
   var b = e.complete;
   e.complete = function(t, n) {
    var i = e.context || this;
    b.apply(i, [t, n, c])
   }
  }
  var x = t("input[type=file]:enabled", this).filter(function() {
    return "" !== t(this).val()
   }).length > 0,
   w = "multipart/form-data",
   k = c.attr("enctype") == w || c.attr("encoding") == w,
   S = r.fileapi && r.formdata;
  i("fileAPI :" + S);
  var _, C = (x || k) && !S;
  !1 !== e.iframe && (e.iframe || C) ? e.closeKeepAlive ? t.get(e.closeKeepAlive, function() {
   _ = n(f)
  }) : _ = n(f) : _ = (x || k) && S ? function(n) {
   for (var i = new FormData, r = 0; r < n.length; r++) i.append(n[r].name, n[r].value);
   if (e.extraData) {
    var s = function(n) {
     var i, r, s = t.param(n, e.traditional).split("&"),
      o = s.length,
      a = [];
     for (i = 0; i < o; i++) s[i] = s[i].replace(/\+/g, " "), r = s[i].split("="), a.push([decodeURIComponent(r[0]), decodeURIComponent(r[1])]);
     return a
    }(e.extraData);
    for (r = 0; r < s.length; r++) s[r] && i.append(s[r][0], s[r][1])
   }
   e.data = null;
   var a = t.extend(!0, {}, t.ajaxSettings, e, {
    contentType: !1,
    processData: !1,
    cache: !1,
    type: o || "POST"
   });
   e.uploadProgress && (a.xhr = function() {
    var n = t.ajaxSettings.xhr();
    return n.upload && n.upload.addEventListener("progress", function(t) {
     var n = 0,
      i = t.loaded || t.position,
      r = t.total;
     t.lengthComputable && (n = Math.ceil(i / r * 100)), e.uploadProgress(t, i, r, n)
    }, !1), n
   }), a.data = null;
   var l = a.beforeSend;
   return a.beforeSend = function(t, n) {
    e.formData ? n.data = e.formData : n.data = i, l && l.call(this, t, n)
   }, t.ajax(a)
  }(f) : t.ajax(e), c.removeData("jqxhr").data("jqxhr", _);
  for (var E = 0; E < d.length; E++) d[E] = null;
  return this.trigger("form-submit-notify", [this, e]), this
 }, t.fn.ajaxForm = function(r) {
  if (r = r || {}, r.delegation = r.delegation && t.isFunction(t.fn.on), !r.delegation && 0 === this.length) {
   var s = {
    s: this.selector,
    c: this.context
   };
   return !t.isReady && s.s ? (i("DOM not ready, queuing ajaxForm"), t(function() {
    t(s.s, s.c).ajaxForm(r)
   }), this) : (i("terminating; zero elements found by selector" + (t.isReady ? "" : " (DOM not ready)")), this)
  }
  return r.delegation ? (t(document).off("submit.form-plugin", this.selector, e).off("click.form-plugin", this.selector, n).on("submit.form-plugin", this.selector, r, e).on("click.form-plugin", this.selector, r, n), this) : this.ajaxFormUnbind().bind("submit.form-plugin", r, e).bind("click.form-plugin", r, n)
 }, t.fn.ajaxFormUnbind = function() {
  return this.unbind("submit.form-plugin click.form-plugin")
 }, t.fn.formToArray = function(e, n) {
  var i = [];
  if (0 === this.length) return i;
  var s, o = this[0],
   a = this.attr("id"),
   l = e ? o.getElementsByTagName("*") : o.elements;
  if (l && !/MSIE [678]/.test(navigator.userAgent) && (l = t(l).get()), a && (s = t(':input[form="' + a + '"]').get()).length && (l = (l || []).concat(s)), !l || !l.length) return i;
  var c, u, h, p, d, f, m;
  for (c = 0, f = l.length; c < f; c++)
   if (d = l[c], (h = d.name) && !d.disabled)
    if (e && o.clk && "image" == d.type) o.clk == d && (i.push({
     name: h,
     value: t(d).val(),
     type: d.type
    }), i.push({
     name: h + ".x",
     value: o.clk_x
    }, {
     name: h + ".y",
     value: o.clk_y
    }));
    else if ((p = t.fieldValue(d, !0)) && p.constructor == Array)
   for (n && n.push(d), u = 0, m = p.length; u < m; u++) i.push({
    name: h,
    value: p[u]
   });
  else if (r.fileapi && "file" == d.type) {
   n && n.push(d);
   var g = d.files;
   if (g.length)
    for (u = 0; u < g.length; u++) i.push({
     name: h,
     value: g[u],
     type: d.type
    });
   else i.push({
    name: h,
    value: "",
    type: d.type
   })
  } else null !== p && void 0 !== p && (n && n.push(d), i.push({
   name: h,
   value: p,
   type: d.type,
   required: d.required
  }));
  if (!e && o.clk) {
   var v = t(o.clk),
    y = v[0];
   (h = y.name) && !y.disabled && "image" == y.type && (i.push({
    name: h,
    value: v.val()
   }), i.push({
    name: h + ".x",
    value: o.clk_x
   }, {
    name: h + ".y",
    value: o.clk_y
   }))
  }
  return i
 }, t.fn.formSerialize = function(e) {
  return t.param(this.formToArray(e))
 }, t.fn.fieldSerialize = function(e) {
  var n = [];
  return this.each(function() {
   var i = this.name;
   if (i) {
    var r = t.fieldValue(this, e);
    if (r && r.constructor == Array)
     for (var s = 0, o = r.length; s < o; s++) n.push({
      name: i,
      value: r[s]
     });
    else null !== r && void 0 !== r && n.push({
     name: this.name,
     value: r
    })
   }
  }), t.param(n)
 }, t.fn.fieldValue = function(e) {
  for (var n = [], i = 0, r = this.length; i < r; i++) {
   var s = this[i],
    o = t.fieldValue(s, e);
   null === o || void 0 === o || o.constructor == Array && !o.length || (o.constructor == Array ? t.merge(n, o) : n.push(o))
  }
  return n
 }, t.fieldValue = function(e, n) {
  var i = e.name,
   r = e.type,
   s = e.tagName.toLowerCase();
  if (void 0 === n && (n = !0), n && (!i || e.disabled || "reset" == r || "button" == r || ("checkbox" == r || "radio" == r) && !e.checked || ("submit" == r || "image" == r) && e.form && e.form.clk != e || "select" == s && -1 == e.selectedIndex)) return null;
  if ("select" == s) {
   var o = e.selectedIndex;
   if (o < 0) return null;
   for (var a = [], l = e.options, c = "select-one" == r, u = c ? o + 1 : l.length, h = c ? o : 0; h < u; h++) {
    var p = l[h];
    if (p.selected) {
     var d = p.value;
     if (d || (d = p.attributes && p.attributes.value && !p.attributes.value.specified ? p.text : p.value), c) return d;
     a.push(d)
    }
   }
   return a
  }
  return t(e).val()
 }, t.fn.clearForm = function(e) {
  return this.each(function() {
   t("input,select,textarea", this).clearFields(e)
  })
 }, t.fn.clearFields = t.fn.clearInputs = function(e) {
  var n = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
  return this.each(function() {
   var i = this.type,
    r = this.tagName.toLowerCase();
   n.test(i) || "textarea" == r ? this.value = "" : "checkbox" == i || "radio" == i ? this.checked = !1 : "select" == r ? this.selectedIndex = -1 : "file" == i ? /MSIE/.test(navigator.userAgent) ? t(this).replaceWith(t(this).clone(!0)) : t(this).val("") : e && (!0 === e && /hidden/.test(i) || "string" == typeof e && t(this).is(e)) && (this.value = "")
  })
 }, t.fn.resetForm = function() {
  return this.each(function() {
   ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
  })
 }, t.fn.enable = function(t) {
  return void 0 === t && (t = !0), this.each(function() {
   this.disabled = !t
  })
 }, t.fn.selected = function(e) {
  return void 0 === e && (e = !0), this.each(function() {
   var n = this.type;
   if ("checkbox" == n || "radio" == n) this.checked = e;
   else if ("option" == this.tagName.toLowerCase()) {
    var i = t(this).parent("select");
    e && i[0] && "select-one" == i[0].type && i.find("option").selected(!1), this.selected = e
   }
  })
 }, t.fn.ajaxSubmit.debug = !1
}),
function(t) {
 "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof exports ? require("jquery") : jQuery)
}(function(t) {
 function e(t) {
  return s.raw ? t : encodeURIComponent(t)
 }

 function n(t) {
  return s.raw ? t : decodeURIComponent(t)
 }

 function i(e, n) {
  var i = s.raw ? e : function(t) {
   0 === t.indexOf('"') && (t = t.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
   try {
    return t = decodeURIComponent(t.replace(r, " ")), s.json ? JSON.parse(t) : t
   } catch (t) {}
  }(e);
  return t.isFunction(n) ? n(i) : i
 }
 var r = /\+/g,
  s = t.cookie = function(r, o, a) {
   if (void 0 !== o && !t.isFunction(o)) {
    if ("number" == typeof(a = t.extend({}, s.defaults, a)).expires) {
     var l = a.expires,
      c = a.expires = new Date;
     c.setTime(+c + 864e5 * l)
    }
    return document.cookie = [e(r), "=", function(t) {
     return e(s.json ? JSON.stringify(t) : String(t))
    }(o), a.expires ? "; expires=" + a.expires.toUTCString() : "", a.path ? "; path=" + a.path : "", a.domain ? "; domain=" + a.domain : "", a.secure ? "; secure" : ""].join("")
   }
   for (var u = r ? void 0 : {}, h = document.cookie ? document.cookie.split("; ") : [], p = 0, d = h.length; p < d; p++) {
    var f = h[p].split("="),
     m = n(f.shift()),
     g = f.join("=");
    if (r && r === m) {
     u = i(g, o);
     break
    }
    r || void 0 === (g = i(g)) || (u[m] = g)
   }
   return u
  };
 s.defaults = {}, t.removeCookie = function(e, n) {
  return void 0 !== t.cookie(e) && (t.cookie(e, "", t.extend({}, n, {
   expires: -1
  })), !t.cookie(e))
 }
}),
function(t) {
 "use strict";

 function e(e) {
  var n = e.attr("data-target");
  n || (n = (n = e.attr("href")) && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
  var i = n && t(n);
  return i && i.length ? i : e.parent()
 }

 function n(n) {
  n && 3 === n.which || (t(i).remove(), t(r).each(function() {
   var i = t(this),
    r = e(i),
    s = {
     relatedTarget: this
    };
   r.hasClass("open") && (n && "click" == n.type && /input|textarea/i.test(n.target.tagName) && t.contains(r[0], n.target) || (r.trigger(n = t.Event("hide.bs.dropdown", s)), n.isDefaultPrevented() || (i.attr("aria-expanded", "false"), r.removeClass("open").trigger(t.Event("hidden.bs.dropdown", s)))))
  }))
 }
 var i = ".dropdown-backdrop",
  r = '[data-toggle="dropdown"]',
  s = function(e) {
   t(e).on("click.bs.dropdown", this.toggle)
  };
 s.VERSION = "3.3.7", s.prototype.toggle = function(i) {
  var r = t(this);
  if (!r.is(".disabled, :disabled")) {
   var s = e(r),
    o = s.hasClass("open");
   if (n(), !o) {
    "ontouchstart" in document.documentElement && !s.closest(".navbar-nav").length && t(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(t(this)).on("click", n);
    var a = {
     relatedTarget: this
    };
    if (s.trigger(i = t.Event("show.bs.dropdown", a)), i.isDefaultPrevented()) return;
    r.trigger("focus").attr("aria-expanded", "true"), s.toggleClass("open").trigger(t.Event("shown.bs.dropdown", a))
   }
   return !1
  }
 }, s.prototype.keydown = function(n) {
  if (/(38|40|27|32)/.test(n.which) && !/input|textarea/i.test(n.target.tagName)) {
   var i = t(this);
   if (n.preventDefault(), n.stopPropagation(), !i.is(".disabled, :disabled")) {
    var s = e(i),
     o = s.hasClass("open");
    if (!o && 27 != n.which || o && 27 == n.which) return 27 == n.which && s.find(r).trigger("focus"), i.trigger("click");
    var a = s.find(".dropdown-menu li:not(.disabled):visible a");
    if (a.length) {
     var l = a.index(n.target);
     38 == n.which && l > 0 && l--, 40 == n.which && l < a.length - 1 && l++, ~l || (l = 0), a.eq(l).trigger("focus")
    }
   }
  }
 };
 var o = t.fn.dropdown;
 t.fn.dropdown = function(e) {
  return this.each(function() {
   var n = t(this),
    i = n.data("bs.dropdown");
   i || n.data("bs.dropdown", i = new s(this)), "string" == typeof e && i[e].call(n)
  })
 }, t.fn.dropdown.Constructor = s, t.fn.dropdown.noConflict = function() {
  return t.fn.dropdown = o, this
 }, t(document).on("click.bs.dropdown.data-api", n).on("click.bs.dropdown.data-api", ".dropdown form", function(t) {
  t.stopPropagation()
 }).on("click.bs.dropdown.data-api", r, s.prototype.toggle).on("keydown.bs.dropdown.data-api", r, s.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", s.prototype.keydown)
}(jQuery),
function(t) {
 "use strict";

 function e(e) {
  return this.each(function() {
   var i = t(this),
    r = i.data("bs.tab");
   r || i.data("bs.tab", r = new n(this)), "string" == typeof e && r[e]()
  })
 }
 var n = function(e) {
  this.element = t(e)
 };
 n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.prototype.show = function() {
  var e = this.element,
   n = e.closest("ul:not(.dropdown-menu)"),
   i = e.data("target");
  if (i || (i = (i = e.attr("href")) && i.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
   var r = n.find(".active:last a"),
    s = t.Event("hide.bs.tab", {
     relatedTarget: e[0]
    }),
    o = t.Event("show.bs.tab", {
     relatedTarget: r[0]
    });
   if (r.trigger(s), e.trigger(o), !o.isDefaultPrevented() && !s.isDefaultPrevented()) {
    var a = t(i);
    this.activate(e.closest("li"), n), this.activate(a, a.parent(), function() {
     r.trigger({
      type: "hidden.bs.tab",
      relatedTarget: e[0]
     }), e.trigger({
      type: "shown.bs.tab",
      relatedTarget: r[0]
     })
    })
   }
  }
 }, n.prototype.activate = function(e, i, r) {
  function s() {
   o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), a ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu").length && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), r && r()
  }
  var o = i.find("> .active"),
   a = r && t.support.transition && (o.length && o.hasClass("fade") || !!i.find("> .fade").length);
  o.length && a ? o.one("bsTransitionEnd", s).emulateTransitionEnd(n.TRANSITION_DURATION) : s(), o.removeClass("in")
 };
 var i = t.fn.tab;
 t.fn.tab = e, t.fn.tab.Constructor = n, t.fn.tab.noConflict = function() {
  return t.fn.tab = i, this
 };
 var r = function(n) {
  n.preventDefault(), e.call(t(this), "show")
 };
 t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', r).on("click.bs.tab.data-api", '[data-toggle="pill"]', r)
}(jQuery),
function(t) {
 "use strict";
 var e = function(t, e) {
  this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", t, e)
 };
 e.VERSION = "3.3.7", e.TRANSITION_DURATION = 150, e.DEFAULTS = {
  animation: !0,
  placement: "top",
  selector: !1,
  template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
  trigger: "hover focus",
  title: "",
  delay: 0,
  html: !1,
  container: !1,
  viewport: {
   selector: "body",
   padding: 0
  }
 }, e.prototype.init = function(e, n, i) {
  if (this.enabled = !0, this.type = e, this.$element = t(n), this.options = this.getOptions(i), this.$viewport = this.options.viewport && t(t.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
    click: !1,
    hover: !1,
    focus: !1
   }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
  for (var r = this.options.trigger.split(" "), s = r.length; s--;) {
   var o = r[s];
   if ("click" == o) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
   else if ("manual" != o) {
    var a = "hover" == o ? "mouseenter" : "focusin",
     l = "hover" == o ? "mouseleave" : "focusout";
    this.$element.on(a + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
   }
  }
  this.options.selector ? this._options = t.extend({}, this.options, {
   trigger: "manual",
   selector: ""
  }) : this.fixTitle()
 }, e.prototype.getDefaults = function() {
  return e.DEFAULTS
 }, e.prototype.getOptions = function(e) {
  return (e = t.extend({}, this.getDefaults(), this.$element.data(), e)).delay && "number" == typeof e.delay && (e.delay = {
   show: e.delay,
   hide: e.delay
  }), e
 }, e.prototype.getDelegateOptions = function() {
  var e = {},
   n = this.getDefaults();
  return this._options && t.each(this._options, function(t, i) {
   n[t] != i && (e[t] = i)
  }), e
 }, e.prototype.enter = function(e) {
  var n = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
  if (n || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n)), e instanceof t.Event && (n.inState["focusin" == e.type ? "focus" : "hover"] = !0), n.tip().hasClass("in") || "in" == n.hoverState) n.hoverState = "in";
  else {
   if (clearTimeout(n.timeout), n.hoverState = "in", !n.options.delay || !n.options.delay.show) return n.show();
   n.timeout = setTimeout(function() {
    "in" == n.hoverState && n.show()
   }, n.options.delay.show)
  }
 }, e.prototype.isInStateTrue = function() {
  for (var t in this.inState)
   if (this.inState[t]) return !0;
  return !1
 }, e.prototype.leave = function(e) {
  var n = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
  if (n || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n)), e instanceof t.Event && (n.inState["focusout" == e.type ? "focus" : "hover"] = !1), !n.isInStateTrue()) {
   if (clearTimeout(n.timeout), n.hoverState = "out", !n.options.delay || !n.options.delay.hide) return n.hide();
   n.timeout = setTimeout(function() {
    "out" == n.hoverState && n.hide()
   }, n.options.delay.hide)
  }
 }, e.prototype.show = function() {
  var n = t.Event("show.bs." + this.type);
  if (this.hasContent() && this.enabled) {
   this.$element.trigger(n);
   var i = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
   if (n.isDefaultPrevented() || !i) return;
   var r = this,
    s = this.tip(),
    o = this.getUID(this.type);
   this.setContent(), s.attr("id", o), this.$element.attr("aria-describedby", o), this.options.animation && s.addClass("fade");
   var a = "function" == typeof this.options.placement ? this.options.placement.call(this, s[0], this.$element[0]) : this.options.placement,
    l = /\s?auto?\s?/i,
    c = l.test(a);
   c && (a = a.replace(l, "") || "top"), s.detach().css({
    top: 0,
    left: 0,
    display: "block"
   }).addClass(a).data("bs." + this.type, this), this.options.container ? s.appendTo(this.options.container) : s.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
   var u = this.getPosition(),
    h = s[0].offsetWidth,
    p = s[0].offsetHeight;
   if (c) {
    var d = a,
     f = this.getPosition(this.$viewport);
    a = "bottom" == a && u.bottom + p > f.bottom ? "top" : "top" == a && u.top - p < f.top ? "bottom" : "right" == a && u.right + h > f.width ? "left" : "left" == a && u.left - h < f.left ? "right" : a, s.removeClass(d).addClass(a)
   }
   var m = this.getCalculatedOffset(a, u, h, p);
   this.applyPlacement(m, a);
   var g = function() {
    var t = r.hoverState;
    r.$element.trigger("shown.bs." + r.type), r.hoverState = null, "out" == t && r.leave(r)
   };
   t.support.transition && this.$tip.hasClass("fade") ? s.one("bsTransitionEnd", g).emulateTransitionEnd(e.TRANSITION_DURATION) : g()
  }
 }, e.prototype.applyPlacement = function(e, n) {
  var i = this.tip(),
   r = i[0].offsetWidth,
   s = i[0].offsetHeight,
   o = parseInt(i.css("margin-top"), 10),
   a = parseInt(i.css("margin-left"), 10);
  isNaN(o) && (o = 0), isNaN(a) && (a = 0), e.top += o, e.left += a, t.offset.setOffset(i[0], t.extend({
   using: function(t) {
    i.css({
     top: Math.round(t.top),
     left: Math.round(t.left)
    })
   }
  }, e), 0), i.addClass("in");
  var l = i[0].offsetWidth,
   c = i[0].offsetHeight;
  "top" == n && c != s && (e.top = e.top + s - c);
  var u = this.getViewportAdjustedDelta(n, e, l, c);
  u.left ? e.left += u.left : e.top += u.top;
  var h = /top|bottom/.test(n),
   p = h ? 2 * u.left - r + l : 2 * u.top - s + c,
   d = h ? "offsetWidth" : "offsetHeight";
  i.offset(e), this.replaceArrow(p, i[0][d], h)
 }, e.prototype.replaceArrow = function(t, e, n) {
  this.arrow().css(n ? "left" : "top", 50 * (1 - t / e) + "%").css(n ? "top" : "left", "")
 }, e.prototype.setContent = function() {
  var t = this.tip(),
   e = this.getTitle();
  t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
 }, e.prototype.hide = function(n) {
  function i() {
   "in" != r.hoverState && s.detach(), r.$element && r.$element.removeAttr("aria-describedby").trigger("hidden.bs." + r.type), n && n()
  }
  var r = this,
   s = t(this.$tip),
   o = t.Event("hide.bs." + this.type);
  if (this.$element.trigger(o), !o.isDefaultPrevented()) return s.removeClass("in"), t.support.transition && s.hasClass("fade") ? s.one("bsTransitionEnd", i).emulateTransitionEnd(e.TRANSITION_DURATION) : i(), this.hoverState = null, this
 }, e.prototype.fixTitle = function() {
  var t = this.$element;
  (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
 }, e.prototype.hasContent = function() {
  return this.getTitle()
 }, e.prototype.getPosition = function(e) {
  var n = (e = e || this.$element)[0],
   i = "BODY" == n.tagName,
   r = n.getBoundingClientRect();
  null == r.width && (r = t.extend({}, r, {
   width: r.right - r.left,
   height: r.bottom - r.top
  }));
  var s = window.SVGElement && n instanceof window.SVGElement,
   o = i ? {
    top: 0,
    left: 0
   } : s ? null : e.offset(),
   a = {
    scroll: i ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()
   },
   l = i ? {
    width: t(window).width(),
    height: t(window).height()
   } : null;
  return t.extend({}, r, a, l, o)
 }, e.prototype.getCalculatedOffset = function(t, e, n, i) {
  return "bottom" == t ? {
   top: e.top + e.height,
   left: e.left + e.width / 2 - n / 2
  } : "top" == t ? {
   top: e.top - i,
   left: e.left + e.width / 2 - n / 2
  } : "left" == t ? {
   top: e.top + e.height / 2 - i / 2,
   left: e.left - n
  } : {
   top: e.top + e.height / 2 - i / 2,
   left: e.left + e.width
  }
 }, e.prototype.getViewportAdjustedDelta = function(t, e, n, i) {
  var r = {
   top: 0,
   left: 0
  };
  if (!this.$viewport) return r;
  var s = this.options.viewport && this.options.viewport.padding || 0,
   o = this.getPosition(this.$viewport);
  if (/right|left/.test(t)) {
   var a = e.top - s - o.scroll,
    l = e.top + s - o.scroll + i;
   a < o.top ? r.top = o.top - a : l > o.top + o.height && (r.top = o.top + o.height - l)
  } else {
   var c = e.left - s,
    u = e.left + s + n;
   c < o.left ? r.left = o.left - c : u > o.right && (r.left = o.left + o.width - u)
  }
  return r
 }, e.prototype.getTitle = function() {
  var t = this.$element,
   e = this.options;
  return t.attr("data-original-title") || ("function" == typeof e.title ? e.title.call(t[0]) : e.title)
 }, e.prototype.getUID = function(t) {
  do {
   t += ~~(1e6 * Math.random())
  } while (document.getElementById(t));
  return t
 }, e.prototype.tip = function() {
  if (!this.$tip && (this.$tip = t(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
  return this.$tip
 }, e.prototype.arrow = function() {
  return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
 }, e.prototype.enable = function() {
  this.enabled = !0
 }, e.prototype.disable = function() {
  this.enabled = !1
 }, e.prototype.toggleEnabled = function() {
  this.enabled = !this.enabled
 }, e.prototype.toggle = function(e) {
  var n = this;
  e && ((n = t(e.currentTarget).data("bs." + this.type)) || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n))), e ? (n.inState.click = !n.inState.click, n.isInStateTrue() ? n.enter(n) : n.leave(n)) : n.tip().hasClass("in") ? n.leave(n) : n.enter(n)
 }, e.prototype.destroy = function() {
  var t = this;
  clearTimeout(this.timeout), this.hide(function() {
   t.$element.off("." + t.type).removeData("bs." + t.type), t.$tip && t.$tip.detach(), t.$tip = null, t.$arrow = null, t.$viewport = null, t.$element = null
  })
 };
 var n = t.fn.tooltip;
 t.fn.tooltip = function(n) {
  return this.each(function() {
   var i = t(this),
    r = i.data("bs.tooltip"),
    s = "object" == typeof n && n;
   !r && /destroy|hide/.test(n) || (r || i.data("bs.tooltip", r = new e(this, s)), "string" == typeof n && r[n]())
  })
 }, t.fn.tooltip.Constructor = e, t.fn.tooltip.noConflict = function() {
  return t.fn.tooltip = n, this
 }
}(jQuery),
function(t) {
 "use strict";
 var e = function(t, e) {
  this.init("popover", t, e)
 };
 if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
 e.VERSION = "3.3.7", e.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
  placement: "right",
  trigger: "click",
  content: "",
  template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
 }), e.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype), e.prototype.constructor = e, e.prototype.getDefaults = function() {
  return e.DEFAULTS
 }, e.prototype.setContent = function() {
  var t = this.tip(),
   e = this.getTitle(),
   n = this.getContent();
  t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof n ? "html" : "append" : "text"](n), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
 }, e.prototype.hasContent = function() {
  return this.getTitle() || this.getContent()
 }, e.prototype.getContent = function() {
  var t = this.$element,
   e = this.options;
  return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
 }, e.prototype.arrow = function() {
  return this.$arrow = this.$arrow || this.tip().find(".arrow")
 };
 var n = t.fn.popover;
 t.fn.popover = function(n) {
  return this.each(function() {
   var i = t(this),
    r = i.data("bs.popover"),
    s = "object" == typeof n && n;
   !r && /destroy|hide/.test(n) || (r || i.data("bs.popover", r = new e(this, s)), "string" == typeof n && r[n]())
  })
 }, t.fn.popover.Constructor = e, t.fn.popover.noConflict = function() {
  return t.fn.popover = n, this
 }
}(jQuery),
function(t) {
 "use strict";

 function e(e, i) {
  return this.each(function() {
   var r = t(this),
    s = r.data("bs.modal"),
    o = t.extend({}, n.DEFAULTS, r.data(), "object" == typeof e && e);
   s || r.data("bs.modal", s = new n(this, o)), "string" == typeof e ? s[e](i) : o.show && s.show(i)
  })
 }
 var n = function(e, n) {
  this.options = n, this.$body = t(document.body), this.$element = t(e), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, t.proxy(function() {
   this.$element.trigger("loaded.bs.modal")
  }, this))
 };
 n.VERSION = "3.3.7", n.TRANSITION_DURATION = 300, n.BACKDROP_TRANSITION_DURATION = 150, n.DEFAULTS = {
  backdrop: !0,
  keyboard: !0,
  show: !0
 }, n.prototype.toggle = function(t) {
  return this.isShown ? this.hide() : this.show(t)
 }, n.prototype.show = function(e) {
  var i = this,
   r = t.Event("show.bs.modal", {
    relatedTarget: e
   });
  this.$element.trigger(r), this.isShown || r.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function() {
   i.$element.one("mouseup.dismiss.bs.modal", function(e) {
    t(e.target).is(i.$element) && (i.ignoreBackdropClick = !0)
   })
  }), this.backdrop(function() {
   var r = t.support.transition && i.$element.hasClass("fade");
   i.$element.parent().length || i.$element.appendTo(i.$body), i.$element.show().scrollTop(0), i.adjustDialog(), r && i.$element[0].offsetWidth, i.$element.addClass("in"), i.enforceFocus();
   var s = t.Event("shown.bs.modal", {
    relatedTarget: e
   });
   r ? i.$dialog.one("bsTransitionEnd", function() {
    i.$element.trigger("focus").trigger(s)
   }).emulateTransitionEnd(n.TRANSITION_DURATION) : i.$element.trigger("focus").trigger(s)
  }))
 }, n.prototype.hide = function(e) {
  e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", t.proxy(this.hideModal, this)).emulateTransitionEnd(n.TRANSITION_DURATION) : this.hideModal())
 }, n.prototype.enforceFocus = function() {
  t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy(function(t) {
   document === t.target || this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.trigger("focus")
  }, this))
 }, n.prototype.escape = function() {
  this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", t.proxy(function(t) {
   27 == t.which && this.hide()
  }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
 }, n.prototype.resize = function() {
  this.isShown ? t(window).on("resize.bs.modal", t.proxy(this.handleUpdate, this)) : t(window).off("resize.bs.modal")
 }, n.prototype.hideModal = function() {
  var t = this;
  this.$element.hide(), this.backdrop(function() {
   t.$body.removeClass("modal-open"), t.resetAdjustments(), t.resetScrollbar(), t.$element.trigger("hidden.bs.modal")
  })
 }, n.prototype.removeBackdrop = function() {
  this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
 }, n.prototype.backdrop = function(e) {
  var i = this,
   r = this.$element.hasClass("fade") ? "fade" : "";
  if (this.isShown && this.options.backdrop) {
   var s = t.support.transition && r;
   if (this.$backdrop = t(document.createElement("div")).addClass("modal-backdrop " + r).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", t.proxy(function(t) {
     this.ignoreBackdropClick ? this.ignoreBackdropClick = !1 : t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide())
    }, this)), s && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e) return;
   s ? this.$backdrop.one("bsTransitionEnd", e).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : e()
  } else if (!this.isShown && this.$backdrop) {
   this.$backdrop.removeClass("in");
   var o = function() {
    i.removeBackdrop(), e && e()
   };
   t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", o).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : o()
  } else e && e()
 }, n.prototype.handleUpdate = function() {
  this.adjustDialog()
 }, n.prototype.adjustDialog = function() {
  var t = this.$element[0].scrollHeight > document.documentElement.clientHeight;
  this.$element.css({
   paddingLeft: !this.bodyIsOverflowing && t ? this.scrollbarWidth : "",
   paddingRight: this.bodyIsOverflowing && !t ? this.scrollbarWidth : ""
  })
 }, n.prototype.resetAdjustments = function() {
  this.$element.css({
   paddingLeft: "",
   paddingRight: ""
  })
 }, n.prototype.checkScrollbar = function() {
  var t = window.innerWidth;
  if (!t) {
   var e = document.documentElement.getBoundingClientRect();
   t = e.right - Math.abs(e.left)
  }
  this.bodyIsOverflowing = document.body.clientWidth < t, this.scrollbarWidth = this.measureScrollbar()
 }, n.prototype.setScrollbar = function() {
  var t = parseInt(this.$body.css("padding-right") || 0, 10);
  this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", t + this.scrollbarWidth)
 }, n.prototype.resetScrollbar = function() {
  this.$body.css("padding-right", this.originalBodyPad)
 }, n.prototype.measureScrollbar = function() {
  var t = document.createElement("div");
  t.className = "modal-scrollbar-measure", this.$body.append(t);
  var e = t.offsetWidth - t.clientWidth;
  return this.$body[0].removeChild(t), e
 };
 var i = t.fn.modal;
 t.fn.modal = e, t.fn.modal.Constructor = n, t.fn.modal.noConflict = function() {
  return t.fn.modal = i, this
 }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(n) {
  var i = t(this),
   r = i.attr("href"),
   s = t(i.attr("data-target") || r && r.replace(/.*(?=#[^\s]+$)/, "")),
   o = s.data("bs.modal") ? "toggle" : t.extend({
    remote: !/#/.test(r) && r
   }, s.data(), i.data());
  i.is("a") && n.preventDefault(), s.one("show.bs.modal", function(t) {
   t.isDefaultPrevented() || s.one("hidden.bs.modal", function() {
    i.is(":visible") && i.trigger("focus")
   })
  }), e.call(s, o, this)
 })
}(jQuery),
function(t, e) {
 function n(e, s, l, u, h) {
  var p = !1;
  return e.contents().detach().each(function() {
   var d = t(this);
   if (void 0 === this || 3 == this.nodeType && 0 == t.trim(this.data).length) return !0;
   if (d.is("script")) e.append(d);
   else {
    if (p) return !0;
    e.append(d), h && e[e.is("table, thead, tbody, tfoot, tr, col, colgroup, object, embed, param, ol, ul, dl, blockquote, select, optgroup, option, textarea, script, style") ? "after" : "append"](h), i(l, u) && ((p = 3 == this.nodeType ? function(e, n, s, l, u) {
     var h = e[0];
     if (!h) return !1;
     var p = a(h),
      d = -1 !== p.indexOf(" ") ? " " : "　",
      f = "letter" == l.wrap ? "" : d,
      m = p.split(f),
      g = -1,
      v = -1,
      y = 0,
      b = m.length - 1;
     l.fallbackToLetter && 0 == y && 0 == b && (f = "", m = p.split(f), b = m.length - 1);
     for (; y <= b && (0 != y || 0 != b);) {
      var x = Math.floor((y + b) / 2);
      if (x == v) break;
      v = x, o(h, m.slice(0, v + 1).join(f) + l.ellipsis), i(s, l) ? (b = v, l.fallbackToLetter && 0 == y && 0 == b && (f = "", m = m[0].split(f), g = -1, v = -1, y = 0, b = m.length - 1)) : (g = v, y = v)
     }
     if (-1 == g || 1 == m.length && 0 == m[0].length) {
      var w = e.parent();
      e.detach();
      var k = u && u.closest(w).length ? u.length : 0;
      w.contents().length > k ? h = c(w.contents().eq(-1 - k), n) : (h = c(w, n, !0), k || w.detach()), h && (p = r(a(h), l), o(h, p), k && u && t(h).parent().append(u))
     } else p = r(m.slice(0, g + 1).join(f), l), o(h, p);
     return !0
    }(d, s, l, u, h) : n(d, s, l, u, h)) || (d.detach(), p = !0)), p || h && h.detach()
   }
  }), p
 }

 function i(t, e) {
  return t.innerHeight() > e.maxHeight
 }

 function r(e, n) {
  for (; t.inArray(e.slice(-1), n.lastCharacter.remove) > -1;) e = e.slice(0, -1);
  return t.inArray(e.slice(-1), n.lastCharacter.noEllipsis) < 0 && (e += n.ellipsis), e
 }

 function s(t) {
  return {
   width: t.innerWidth(),
   height: t.innerHeight()
  }
 }

 function o(t, e) {
  t.innerText ? t.innerText = e : t.nodeValue ? t.nodeValue = e : t.textContent && (t.textContent = e)
 }

 function a(t) {
  return t.innerText ? t.innerText : t.nodeValue ? t.nodeValue : t.textContent ? t.textContent : ""
 }

 function l(t) {
  do {
   t = t.previousSibling
  } while (t && 1 !== t.nodeType && 3 !== t.nodeType);
  return t
 }

 function c(e, n, i) {
  var r, s = e && e[0];
  if (s) {
   if (!i) {
    if (3 === s.nodeType) return s;
    if (t.trim(e.text())) return c(e.contents().last(), n)
   }
   for (r = l(s); !r;) {
    if ((e = e.parent()).is(n) || !e.length) return !1;
    r = l(e[0])
   }
   if (r) return c(t(r), n)
  }
  return !1
 }
 if (!t.fn.dotdotdot) {
  t.fn.dotdotdot = function(e) {
   if (0 == this.length) return t.fn.dotdotdot.debug('No element found for "' + this.selector + '".'), this;
   if (this.length > 1) return this.each(function() {
    t(this).dotdotdot(e)
   });
   var r = this;
   r.data("dotdotdot") && r.trigger("destroy.dot"), r.data("dotdotdot-style", r.attr("style") || ""), r.css("word-wrap", "break-word"), "nowrap" === r.css("white-space") && r.css("white-space", "normal"), r.bind_events = function() {
    return r.bind("update.dot", function(e, s) {
     e.preventDefault(), e.stopPropagation(), a.maxHeight = "number" == typeof a.height ? a.height : function(t) {
      for (var e = t.innerHeight(), n = ["paddingTop", "paddingBottom"], i = 0, r = n.length; i < r; i++) {
       var s = parseInt(t.css(n[i]), 10);
       isNaN(s) && (s = 0), e -= s
      }
      return e
     }(r), a.maxHeight += a.tolerance, void 0 !== s && (("string" == typeof s || s instanceof HTMLElement) && (s = t("<div />").append(s).contents()), s instanceof t && (o = s)), (p = r.wrapInner('<div class="dotdotdot" />').children()).contents().detach().end().append(o.clone(!0)).find("br").replaceWith("  <br />  ").end().css({
      height: "auto",
      width: "auto",
      border: "none",
      padding: 0,
      margin: 0
     });
     var c = !1,
      u = !1;
     return l.afterElement && ((c = l.afterElement.clone(!0)).show(), l.afterElement.detach()), i(p, a) && (u = "children" == a.wrap ? function(t, e, n) {
      var r = t.children(),
       s = !1;
      t.empty();
      for (var o = 0, a = r.length; o < a; o++) {
       var l = r.eq(o);
       if (t.append(l), n && t.append(n), i(t, e)) {
        l.remove(), s = !0;
        break
       }
       n && n.detach()
      }
      return s
     }(p, a, c) : n(p, r, p, a, c)), p.replaceWith(p.contents()), p = null, t.isFunction(a.callback) && a.callback.call(r[0], u, o), l.isTruncated = u, u
    }).bind("isTruncated.dot", function(t, e) {
     return t.preventDefault(), t.stopPropagation(), "function" == typeof e && e.call(r[0], l.isTruncated), l.isTruncated
    }).bind("originalContent.dot", function(t, e) {
     return t.preventDefault(), t.stopPropagation(), "function" == typeof e && e.call(r[0], o), o
    }).bind("destroy.dot", function(t) {
     t.preventDefault(), t.stopPropagation(), r.unwatch().unbind_events().contents().detach().end().append(o).attr("style", r.data("dotdotdot-style") || "").data("dotdotdot", !1)
    }), r
   }, r.unbind_events = function() {
    return r.unbind(".dot"), r
   }, r.watch = function() {
    if (r.unwatch(), "window" == a.watch) {
     var e = t(window),
      n = e.width(),
      i = e.height();
     e.bind("resize.dot" + l.dotId, function() {
      n == e.width() && i == e.height() && a.windowResizeFix || (n = e.width(), i = e.height(), h && clearInterval(h), h = setTimeout(function() {
       r.trigger("update.dot")
      }, 100))
     })
    } else c = s(r), h = setInterval(function() {
     if (r.is(":visible")) {
      var t = s(r);
      c.width == t.width && c.height == t.height || (r.trigger("update.dot"), c = t)
     }
    }, 500);
    return r
   }, r.unwatch = function() {
    return t(window).unbind("resize.dot" + l.dotId), h && clearInterval(h), r
   };
   var o = r.contents(),
    a = t.extend(!0, {}, t.fn.dotdotdot.defaults, e),
    l = {},
    c = {},
    h = null,
    p = null;
   return a.lastCharacter.remove instanceof Array || (a.lastCharacter.remove = t.fn.dotdotdot.defaultArrays.lastCharacter.remove), a.lastCharacter.noEllipsis instanceof Array || (a.lastCharacter.noEllipsis = t.fn.dotdotdot.defaultArrays.lastCharacter.noEllipsis), l.afterElement = function(e, n) {
    return !!e && ("string" == typeof e ? !!(e = t(e, n)).length && e : !!e.jquery && e)
   }(a.after, r), l.isTruncated = !1, l.dotId = u++, r.data("dotdotdot", !0).bind_events().trigger("update.dot"), a.watch && r.watch(), r
  }, t.fn.dotdotdot.defaults = {
   ellipsis: "... ",
   wrap: "word",
   fallbackToLetter: !0,
   lastCharacter: {},
   tolerance: 0,
   callback: null,
   after: null,
   height: null,
   watch: !1,
   windowResizeFix: !0
  }, t.fn.dotdotdot.defaultArrays = {
   lastCharacter: {
    remove: [" ", "　", ",", ";", ".", "!", "?"],
    noEllipsis: []
   }
  }, t.fn.dotdotdot.debug = function(t) {};
  var u = 1,
   h = t.fn.html;
  t.fn.html = function(e) {
   return void 0 != e && !t.isFunction(e) && this.data("dotdotdot") ? this.trigger("update", [e]) : h.apply(this, arguments)
  };
  var p = t.fn.text;
  t.fn.text = function(e) {
   return void 0 != e && !t.isFunction(e) && this.data("dotdotdot") ? (e = t("<div />").text(e).html(), this.trigger("update", [e])) : p.apply(this, arguments)
  }
 }
}(jQuery), window.setCookie = function(t, e, n) {
  if (n) {
   var i = new Date;
   i.setTime(i.getTime() + 24 * n * 60 * 60 * 1e3);
   var r = "; expires=" + i.toGMTString()
  } else r = "";
  document.cookie = t + "=" + e + r + "; path=/"
 }, window.getCookie = function(t) {
  for (var e = t + "=", n = document.cookie.split(";"), i = 0; i < n.length; i++) {
   for (var r = n[i];
    " " == r.charAt(0);) r = r.substring(1, r.length);
   if (0 == r.indexOf(e)) return r.substring(e.length, r.length)
  }
  return null
 },
 function(t, e) {
  function n(t) {
   t.hasOwnProperty("data-simple-scrollbar") || Object.defineProperty(t, "data-simple-scrollbar", new SimpleScrollbar(t))
  }

  function i(t) {
   for (this.target = t, this.bar = '<div class="ss-scroll">', this.wrapper = e.createElement("div"), this.wrapper.setAttribute("class", "ss-wrapper"), this.el = e.createElement("div"), this.el.setAttribute("class", "ss-content"), this.wrapper.appendChild(this.el); this.target.firstChild;) this.el.appendChild(this.target.firstChild);
   this.target.appendChild(this.wrapper), this.target.insertAdjacentHTML("beforeend", this.bar), this.bar = this.target.lastChild,
    function(t, n) {
     function i(t) {
      var e = t.pageY - o;
      o = t.pageY, s(function() {
       n.el.scrollTop += e / n.scrollRatio
      })
     }

     function r() {
      t.classList.remove("ss-grabbed"), e.body.classList.remove("ss-grabbed"), e.removeEventListener("mousemove", i), e.removeEventListener("mouseup", r)
     }
     var o;
     t.addEventListener("mousedown", function(n) {
      return o = n.pageY, t.classList.add("ss-grabbed"), e.body.classList.add("ss-grabbed"), e.addEventListener("mousemove", i), e.addEventListener("mouseup", r), !1
     })
    }(this.bar, this), this.moveBar(), this.el.addEventListener("scroll", this.moveBar.bind(this)), this.el.addEventListener("mouseenter", this.moveBar.bind(this)), this.target.classList.add("ss-container");
   var n = window.getComputedStyle(t);
   "0px" === n.height && "0px" !== n["max-height"] && (t.style.height = n["max-height"])
  }

  function r() {
   for (var t = e.querySelectorAll("*[ss-container]"), i = 0; i < t.length; i++) n(t[i])
  }
  var s = t.requestAnimationFrame || t.setImmediate || function(t) {
   return setTimeout(t, 0)
  };
  i.prototype = {
   moveBar: function(t) {
    var e = this.el.scrollHeight,
     n = this.el.clientHeight,
     i = this;
    this.scrollRatio = n / e, s(function() {
     i.scrollRatio >= 1 ? i.bar.classList.add("ss-hidden") : (i.bar.classList.remove("ss-hidden"), i.bar.style.cssText = "height:" + 100 * i.scrollRatio + "%; top:" + i.el.scrollTop / e * 100 + "%;right:-" + (i.target.clientWidth - i.bar.clientWidth) + "px;")
    })
   }
  }, e.addEventListener("DOMContentLoaded", r), i.initEl = n, i.initAll = r, t.SimpleScrollbar = i
 }(window, document),
 function(t) {
  void 0 === t.fn.each2 && t.extend(t.fn, {
   each2: function(e) {
    for (var n = t([0]), i = -1, r = this.length; ++i < r && (n.context = n[0] = this[i]) && !1 !== e.call(n[0], i, n););
    return this
   }
  })
 }(jQuery),
 function(t, e) {
  "use strict";

  function n(e) {
   var n = t(document.createTextNode(""));
   e.before(n), n.before(e), n.remove()
  }

  function i(t) {
   return t.replace(/[^\u0000-\u007E]/g, function(t) {
    return I[t] || t
   })
  }

  function r(t, e) {
   for (var n = 0, i = e.length; n < i; n += 1)
    if (s(t, e[n])) return n;
   return -1
  }

  function s(t, n) {
   return t === n || t !== e && n !== e && (null !== t && null !== n && (t.constructor === String ? t + "" == n + "" : n.constructor === String && n + "" == t + ""))
  }

  function o(t, e, n) {
   var i, r, s;
   if (null === t || t.length < 1) return [];
   for (r = 0, s = (i = t.split(e)).length; r < s; r += 1) i[r] = n(i[r]);
   return i
  }

  function a(t) {
   return t.outerWidth(!1) - t.width()
  }

  function l(n) {
   var i = "keyup-change-value";
   n.on("keydown", function() {
    t.data(n, i) === e && t.data(n, i, n.val())
   }), n.on("keyup", function() {
    var r = t.data(n, i);
    r !== e && n.val() !== r && (t.removeData(n, i), n.trigger("keyup-change"))
   })
  }

  function c(t, n, i) {
   i = i || e;
   var r;
   return function() {
    var e = arguments;
    window.clearTimeout(r), r = window.setTimeout(function() {
     n.apply(i, e)
    }, t)
   }
  }

  function u(t) {
   t.preventDefault(), t.stopPropagation()
  }

  function h(e, n, i) {
   var r, s, o = [];
   (r = t.trim(e.attr("class"))) && t((r = "" + r).split(/\s+/)).each2(function() {
    0 === this.indexOf("select2-") && o.push(this)
   }), (r = t.trim(n.attr("class"))) && t((r = "" + r).split(/\s+/)).each2(function() {
    0 !== this.indexOf("select2-") && (s = i(this)) && o.push(s)
   }), e.attr("class", o.join(" "))
  }

  function p(t, e, n, r) {
   var s = i(t.toUpperCase()).indexOf(i(e.toUpperCase())),
    o = e.length;
   s < 0 ? n.push(r(t)) : (n.push(r(t.substring(0, s))), n.push("<span class='select2-match'>"), n.push(r(t.substring(s, s + o))), n.push("</span>"), n.push(r(t.substring(s + o, t.length))))
  }

  function d(t) {
   var e = {
    "\\": "&#92;",
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#47;"
   };
   return String(t).replace(/[&<>"'\/\\]/g, function(t) {
    return e[t]
   })
  }

  function f(n) {
   var i, r = null,
    s = n.quietMillis || 100,
    o = n.url,
    a = this;
   return function(l) {
    window.clearTimeout(i), i = window.setTimeout(function() {
     var i = n.data,
      s = o,
      c = n.transport || t.fn.select2.ajaxDefaults.transport,
      u = {
       type: n.type || "GET",
       cache: n.cache || !1,
       jsonpCallback: n.jsonpCallback || e,
       dataType: n.dataType || "json"
      },
      h = t.extend({}, t.fn.select2.ajaxDefaults.params, u);
     i = i ? i.call(a, l.term, l.page, l.context) : null, s = "function" == typeof s ? s.call(a, l.term, l.page, l.context) : s, r && "function" == typeof r.abort && r.abort(), n.params && (t.isFunction(n.params) ? t.extend(h, n.params.call(a)) : t.extend(h, n.params)), t.extend(h, {
      url: s,
      dataType: n.dataType,
      data: i,
      success: function(t) {
       var e = n.results(t, l.page, l);
       l.callback(e)
      },
      error: function(t, e, n) {
       var i = {
        hasError: !0,
        jqXHR: t,
        textStatus: e,
        errorThrown: n
       };
       l.callback(i)
      }
     }), r = c.call(a, h)
    }, s)
   }
  }

  function m(e) {
   var n, i, r = e,
    s = function(t) {
     return "" + t.text
    };
   t.isArray(r) && (r = {
    results: i = r
   }), !1 === t.isFunction(r) && (i = r, r = function() {
    return i
   });
   var o = r();
   return o.text && (s = o.text, t.isFunction(s) || (n = o.text, s = function(t) {
     return t[n]
    })),
    function(e) {
     var n, i = e.term,
      o = {
       results: []
      };
     "" !== i ? (n = function(r, o) {
      var a, l;
      if ((r = r[0]).children) {
       a = {};
       for (l in r) r.hasOwnProperty(l) && (a[l] = r[l]);
       a.children = [], t(r.children).each2(function(t, e) {
        n(e, a.children)
       }), (a.children.length || e.matcher(i, s(a), r)) && o.push(a)
      } else e.matcher(i, s(r), r) && o.push(r)
     }, t(r().results).each2(function(t, e) {
      n(e, o.results)
     }), e.callback(o)) : e.callback(r())
    }
  }

  function g(n) {
   var i = t.isFunction(n);
   return function(r) {
    var s = r.term,
     o = {
      results: []
     },
     a = i ? n(r) : n;
    t.isArray(a) && (t(a).each(function() {
     var t = this.text !== e,
      n = t ? this.text : this;
     ("" === s || r.matcher(s, n)) && o.results.push(t ? this : {
      id: this,
      text: this
     })
    }), r.callback(o))
   }
  }

  function v(e, n) {
   if (t.isFunction(e)) return !0;
   if (!e) return !1;
   if ("string" == typeof e) return !0;
   throw new Error(n + " must be a string, function, or falsy value")
  }

  function y(e, n) {
   if (t.isFunction(e)) {
    var i = Array.prototype.slice.call(arguments, 2);
    return e.apply(n, i)
   }
   return e
  }

  function b(e) {
   var n = 0;
   return t.each(e, function(t, e) {
    e.children ? n += b(e.children) : n++
   }), n
  }

  function x() {
   var e = this;
   t.each(arguments, function(t, n) {
    e[n].remove(), e[n] = null
   })
  }

  function w(e, n) {
   var i = function() {};
   return i.prototype = new e, i.prototype.constructor = i, i.prototype.parent = e.prototype, i.prototype = t.extend(i.prototype, n), i
  }
  if (window.Select2 === e) {
   var k, S, _, C, E, T, A, P = {
     x: 0,
     y: 0
    },
    N = {
     TAB: 9,
     ENTER: 13,
     ESC: 27,
     SPACE: 32,
     LEFT: 37,
     UP: 38,
     RIGHT: 39,
     DOWN: 40,
     SHIFT: 16,
     CTRL: 17,
     ALT: 18,
     PAGE_UP: 33,
     PAGE_DOWN: 34,
     HOME: 36,
     END: 35,
     BACKSPACE: 8,
     DELETE: 46,
     isArrow: function(t) {
      switch (t = t.which ? t.which : t) {
       case N.LEFT:
       case N.RIGHT:
       case N.UP:
       case N.DOWN:
        return !0
      }
      return !1
     },
     isControl: function(t) {
      switch (t.which) {
       case N.SHIFT:
       case N.CTRL:
       case N.ALT:
        return !0
      }
      return !!t.metaKey
     },
     isFunctionKey: function(t) {
      return (t = t.which ? t.which : t) >= 112 && t <= 123
     }
    },
    D = "<div class='select2-measure-scrollbar'></div>",
    I = {
     "Ⓐ": "A",
     "Ａ": "A",
     "À": "A",
     "Á": "A",
     "Â": "A",
     "Ầ": "A",
     "Ấ": "A",
     "Ẫ": "A",
     "Ẩ": "A",
     "Ã": "A",
     "Ā": "A",
     "Ă": "A",
     "Ằ": "A",
     "Ắ": "A",
     "Ẵ": "A",
     "Ẳ": "A",
     "Ȧ": "A",
     "Ǡ": "A",
     "Ä": "A",
     "Ǟ": "A",
     "Ả": "A",
     "Å": "A",
     "Ǻ": "A",
     "Ǎ": "A",
     "Ȁ": "A",
     "Ȃ": "A",
     "Ạ": "A",
     "Ậ": "A",
     "Ặ": "A",
     "Ḁ": "A",
     "Ą": "A",
     "Ⱥ": "A",
     "Ɐ": "A",
     "Ꜳ": "AA",
     "Æ": "AE",
     "Ǽ": "AE",
     "Ǣ": "AE",
     "Ꜵ": "AO",
     "Ꜷ": "AU",
     "Ꜹ": "AV",
     "Ꜻ": "AV",
     "Ꜽ": "AY",
     "Ⓑ": "B",
     "Ｂ": "B",
     "Ḃ": "B",
     "Ḅ": "B",
     "Ḇ": "B",
     "Ƀ": "B",
     "Ƃ": "B",
     "Ɓ": "B",
     "Ⓒ": "C",
     "Ｃ": "C",
     "Ć": "C",
     "Ĉ": "C",
     "Ċ": "C",
     "Č": "C",
     "Ç": "C",
     "Ḉ": "C",
     "Ƈ": "C",
     "Ȼ": "C",
     "Ꜿ": "C",
     "Ⓓ": "D",
     "Ｄ": "D",
     "Ḋ": "D",
     "Ď": "D",
     "Ḍ": "D",
     "Ḑ": "D",
     "Ḓ": "D",
     "Ḏ": "D",
     "Đ": "D",
     "Ƌ": "D",
     "Ɗ": "D",
     "Ɖ": "D",
     "Ꝺ": "D",
     "Ǳ": "DZ",
     "Ǆ": "DZ",
     "ǲ": "Dz",
     "ǅ": "Dz",
     "Ⓔ": "E",
     "Ｅ": "E",
     "È": "E",
     "É": "E",
     "Ê": "E",
     "Ề": "E",
     "Ế": "E",
     "Ễ": "E",
     "Ể": "E",
     "Ẽ": "E",
     "Ē": "E",
     "Ḕ": "E",
     "Ḗ": "E",
     "Ĕ": "E",
     "Ė": "E",
     "Ë": "E",
     "Ẻ": "E",
     "Ě": "E",
     "Ȅ": "E",
     "Ȇ": "E",
     "Ẹ": "E",
     "Ệ": "E",
     "Ȩ": "E",
     "Ḝ": "E",
     "Ę": "E",
     "Ḙ": "E",
     "Ḛ": "E",
     "Ɛ": "E",
     "Ǝ": "E",
     "Ⓕ": "F",
     "Ｆ": "F",
     "Ḟ": "F",
     "Ƒ": "F",
     "Ꝼ": "F",
     "Ⓖ": "G",
     "Ｇ": "G",
     "Ǵ": "G",
     "Ĝ": "G",
     "Ḡ": "G",
     "Ğ": "G",
     "Ġ": "G",
     "Ǧ": "G",
     "Ģ": "G",
     "Ǥ": "G",
     "Ɠ": "G",
     "Ꞡ": "G",
     "Ᵹ": "G",
     "Ꝿ": "G",
     "Ⓗ": "H",
     "Ｈ": "H",
     "Ĥ": "H",
     "Ḣ": "H",
     "Ḧ": "H",
     "Ȟ": "H",
     "Ḥ": "H",
     "Ḩ": "H",
     "Ḫ": "H",
     "Ħ": "H",
     "Ⱨ": "H",
     "Ⱶ": "H",
     "Ɥ": "H",
     "Ⓘ": "I",
     "Ｉ": "I",
     "Ì": "I",
     "Í": "I",
     "Î": "I",
     "Ĩ": "I",
     "Ī": "I",
     "Ĭ": "I",
     "İ": "I",
     "Ï": "I",
     "Ḯ": "I",
     "Ỉ": "I",
     "Ǐ": "I",
     "Ȉ": "I",
     "Ȋ": "I",
     "Ị": "I",
     "Į": "I",
     "Ḭ": "I",
     "Ɨ": "I",
     "Ⓙ": "J",
     "Ｊ": "J",
     "Ĵ": "J",
     "Ɉ": "J",
     "Ⓚ": "K",
     "Ｋ": "K",
     "Ḱ": "K",
     "Ǩ": "K",
     "Ḳ": "K",
     "Ķ": "K",
     "Ḵ": "K",
     "Ƙ": "K",
     "Ⱪ": "K",
     "Ꝁ": "K",
     "Ꝃ": "K",
     "Ꝅ": "K",
     "Ꞣ": "K",
     "Ⓛ": "L",
     "Ｌ": "L",
     "Ŀ": "L",
     "Ĺ": "L",
     "Ľ": "L",
     "Ḷ": "L",
     "Ḹ": "L",
     "Ļ": "L",
     "Ḽ": "L",
     "Ḻ": "L",
     "Ł": "L",
     "Ƚ": "L",
     "Ɫ": "L",
     "Ⱡ": "L",
     "Ꝉ": "L",
     "Ꝇ": "L",
     "Ꞁ": "L",
     "Ǉ": "LJ",
     "ǈ": "Lj",
     "Ⓜ": "M",
     "Ｍ": "M",
     "Ḿ": "M",
     "Ṁ": "M",
     "Ṃ": "M",
     "Ɱ": "M",
     "Ɯ": "M",
     "Ⓝ": "N",
     "Ｎ": "N",
     "Ǹ": "N",
     "Ń": "N",
     "Ñ": "N",
     "Ṅ": "N",
     "Ň": "N",
     "Ṇ": "N",
     "Ņ": "N",
     "Ṋ": "N",
     "Ṉ": "N",
     "Ƞ": "N",
     "Ɲ": "N",
     "Ꞑ": "N",
     "Ꞥ": "N",
     "Ǌ": "NJ",
     "ǋ": "Nj",
     "Ⓞ": "O",
     "Ｏ": "O",
     "Ò": "O",
     "Ó": "O",
     "Ô": "O",
     "Ồ": "O",
     "Ố": "O",
     "Ỗ": "O",
     "Ổ": "O",
     "Õ": "O",
     "Ṍ": "O",
     "Ȭ": "O",
     "Ṏ": "O",
     "Ō": "O",
     "Ṑ": "O",
     "Ṓ": "O",
     "Ŏ": "O",
     "Ȯ": "O",
     "Ȱ": "O",
     "Ö": "O",
     "Ȫ": "O",
     "Ỏ": "O",
     "Ő": "O",
     "Ǒ": "O",
     "Ȍ": "O",
     "Ȏ": "O",
     "Ơ": "O",
     "Ờ": "O",
     "Ớ": "O",
     "Ỡ": "O",
     "Ở": "O",
     "Ợ": "O",
     "Ọ": "O",
     "Ộ": "O",
     "Ǫ": "O",
     "Ǭ": "O",
     "Ø": "O",
     "Ǿ": "O",
     "Ɔ": "O",
     "Ɵ": "O",
     "Ꝋ": "O",
     "Ꝍ": "O",
     "Ƣ": "OI",
     "Ꝏ": "OO",
     "Ȣ": "OU",
     "Ⓟ": "P",
     "Ｐ": "P",
     "Ṕ": "P",
     "Ṗ": "P",
     "Ƥ": "P",
     "Ᵽ": "P",
     "Ꝑ": "P",
     "Ꝓ": "P",
     "Ꝕ": "P",
     "Ⓠ": "Q",
     "Ｑ": "Q",
     "Ꝗ": "Q",
     "Ꝙ": "Q",
     "Ɋ": "Q",
     "Ⓡ": "R",
     "Ｒ": "R",
     "Ŕ": "R",
     "Ṙ": "R",
     "Ř": "R",
     "Ȑ": "R",
     "Ȓ": "R",
     "Ṛ": "R",
     "Ṝ": "R",
     "Ŗ": "R",
     "Ṟ": "R",
     "Ɍ": "R",
     "Ɽ": "R",
     "Ꝛ": "R",
     "Ꞧ": "R",
     "Ꞃ": "R",
     "Ⓢ": "S",
     "Ｓ": "S",
     "ẞ": "S",
     "Ś": "S",
     "Ṥ": "S",
     "Ŝ": "S",
     "Ṡ": "S",
     "Š": "S",
     "Ṧ": "S",
     "Ṣ": "S",
     "Ṩ": "S",
     "Ș": "S",
     "Ş": "S",
     "Ȿ": "S",
     "Ꞩ": "S",
     "Ꞅ": "S",
     "Ⓣ": "T",
     "Ｔ": "T",
     "Ṫ": "T",
     "Ť": "T",
     "Ṭ": "T",
     "Ț": "T",
     "Ţ": "T",
     "Ṱ": "T",
     "Ṯ": "T",
     "Ŧ": "T",
     "Ƭ": "T",
     "Ʈ": "T",
     "Ⱦ": "T",
     "Ꞇ": "T",
     "Ꜩ": "TZ",
     "Ⓤ": "U",
     "Ｕ": "U",
     "Ù": "U",
     "Ú": "U",
     "Û": "U",
     "Ũ": "U",
     "Ṹ": "U",
     "Ū": "U",
     "Ṻ": "U",
     "Ŭ": "U",
     "Ü": "U",
     "Ǜ": "U",
     "Ǘ": "U",
     "Ǖ": "U",
     "Ǚ": "U",
     "Ủ": "U",
     "Ů": "U",
     "Ű": "U",
     "Ǔ": "U",
     "Ȕ": "U",
     "Ȗ": "U",
     "Ư": "U",
     "Ừ": "U",
     "Ứ": "U",
     "Ữ": "U",
     "Ử": "U",
     "Ự": "U",
     "Ụ": "U",
     "Ṳ": "U",
     "Ų": "U",
     "Ṷ": "U",
     "Ṵ": "U",
     "Ʉ": "U",
     "Ⓥ": "V",
     "Ｖ": "V",
     "Ṽ": "V",
     "Ṿ": "V",
     "Ʋ": "V",
     "Ꝟ": "V",
     "Ʌ": "V",
     "Ꝡ": "VY",
     "Ⓦ": "W",
     "Ｗ": "W",
     "Ẁ": "W",
     "Ẃ": "W",
     "Ŵ": "W",
     "Ẇ": "W",
     "Ẅ": "W",
     "Ẉ": "W",
     "Ⱳ": "W",
     "Ⓧ": "X",
     "Ｘ": "X",
     "Ẋ": "X",
     "Ẍ": "X",
     "Ⓨ": "Y",
     "Ｙ": "Y",
     "Ỳ": "Y",
     "Ý": "Y",
     "Ŷ": "Y",
     "Ỹ": "Y",
     "Ȳ": "Y",
     "Ẏ": "Y",
     "Ÿ": "Y",
     "Ỷ": "Y",
     "Ỵ": "Y",
     "Ƴ": "Y",
     "Ɏ": "Y",
     "Ỿ": "Y",
     "Ⓩ": "Z",
     "Ｚ": "Z",
     "Ź": "Z",
     "Ẑ": "Z",
     "Ż": "Z",
     "Ž": "Z",
     "Ẓ": "Z",
     "Ẕ": "Z",
     "Ƶ": "Z",
     "Ȥ": "Z",
     "Ɀ": "Z",
     "Ⱬ": "Z",
     "Ꝣ": "Z",
     "ⓐ": "a",
     "ａ": "a",
     "ẚ": "a",
     "à": "a",
     "á": "a",
     "â": "a",
     "ầ": "a",
     "ấ": "a",
     "ẫ": "a",
     "ẩ": "a",
     "ã": "a",
     "ā": "a",
     "ă": "a",
     "ằ": "a",
     "ắ": "a",
     "ẵ": "a",
     "ẳ": "a",
     "ȧ": "a",
     "ǡ": "a",
     "ä": "a",
     "ǟ": "a",
     "ả": "a",
     "å": "a",
     "ǻ": "a",
     "ǎ": "a",
     "ȁ": "a",
     "ȃ": "a",
     "ạ": "a",
     "ậ": "a",
     "ặ": "a",
     "ḁ": "a",
     "ą": "a",
     "ⱥ": "a",
     "ɐ": "a",
     "ꜳ": "aa",
     "æ": "ae",
     "ǽ": "ae",
     "ǣ": "ae",
     "ꜵ": "ao",
     "ꜷ": "au",
     "ꜹ": "av",
     "ꜻ": "av",
     "ꜽ": "ay",
     "ⓑ": "b",
     "ｂ": "b",
     "ḃ": "b",
     "ḅ": "b",
     "ḇ": "b",
     "ƀ": "b",
     "ƃ": "b",
     "ɓ": "b",
     "ⓒ": "c",
     "ｃ": "c",
     "ć": "c",
     "ĉ": "c",
     "ċ": "c",
     "č": "c",
     "ç": "c",
     "ḉ": "c",
     "ƈ": "c",
     "ȼ": "c",
     "ꜿ": "c",
     "ↄ": "c",
     "ⓓ": "d",
     "ｄ": "d",
     "ḋ": "d",
     "ď": "d",
     "ḍ": "d",
     "ḑ": "d",
     "ḓ": "d",
     "ḏ": "d",
     "đ": "d",
     "ƌ": "d",
     "ɖ": "d",
     "ɗ": "d",
     "ꝺ": "d",
     "ǳ": "dz",
     "ǆ": "dz",
     "ⓔ": "e",
     "ｅ": "e",
     "è": "e",
     "é": "e",
     "ê": "e",
     "ề": "e",
     "ế": "e",
     "ễ": "e",
     "ể": "e",
     "ẽ": "e",
     "ē": "e",
     "ḕ": "e",
     "ḗ": "e",
     "ĕ": "e",
     "ė": "e",
     "ë": "e",
     "ẻ": "e",
     "ě": "e",
     "ȅ": "e",
     "ȇ": "e",
     "ẹ": "e",
     "ệ": "e",
     "ȩ": "e",
     "ḝ": "e",
     "ę": "e",
     "ḙ": "e",
     "ḛ": "e",
     "ɇ": "e",
     "ɛ": "e",
     "ǝ": "e",
     "ⓕ": "f",
     "ｆ": "f",
     "ḟ": "f",
     "ƒ": "f",
     "ꝼ": "f",
     "ⓖ": "g",
     "ｇ": "g",
     "ǵ": "g",
     "ĝ": "g",
     "ḡ": "g",
     "ğ": "g",
     "ġ": "g",
     "ǧ": "g",
     "ģ": "g",
     "ǥ": "g",
     "ɠ": "g",
     "ꞡ": "g",
     "ᵹ": "g",
     "ꝿ": "g",
     "ⓗ": "h",
     "ｈ": "h",
     "ĥ": "h",
     "ḣ": "h",
     "ḧ": "h",
     "ȟ": "h",
     "ḥ": "h",
     "ḩ": "h",
     "ḫ": "h",
     "ẖ": "h",
     "ħ": "h",
     "ⱨ": "h",
     "ⱶ": "h",
     "ɥ": "h",
     "ƕ": "hv",
     "ⓘ": "i",
     "ｉ": "i",
     "ì": "i",
     "í": "i",
     "î": "i",
     "ĩ": "i",
     "ī": "i",
     "ĭ": "i",
     "ï": "i",
     "ḯ": "i",
     "ỉ": "i",
     "ǐ": "i",
     "ȉ": "i",
     "ȋ": "i",
     "ị": "i",
     "į": "i",
     "ḭ": "i",
     "ɨ": "i",
     "ı": "i",
     "ⓙ": "j",
     "ｊ": "j",
     "ĵ": "j",
     "ǰ": "j",
     "ɉ": "j",
     "ⓚ": "k",
     "ｋ": "k",
     "ḱ": "k",
     "ǩ": "k",
     "ḳ": "k",
     "ķ": "k",
     "ḵ": "k",
     "ƙ": "k",
     "ⱪ": "k",
     "ꝁ": "k",
     "ꝃ": "k",
     "ꝅ": "k",
     "ꞣ": "k",
     "ⓛ": "l",
     "ｌ": "l",
     "ŀ": "l",
     "ĺ": "l",
     "ľ": "l",
     "ḷ": "l",
     "ḹ": "l",
     "ļ": "l",
     "ḽ": "l",
     "ḻ": "l",
     "ſ": "l",
     "ł": "l",
     "ƚ": "l",
     "ɫ": "l",
     "ⱡ": "l",
     "ꝉ": "l",
     "ꞁ": "l",
     "ꝇ": "l",
     "ǉ": "lj",
     "ⓜ": "m",
     "ｍ": "m",
     "ḿ": "m",
     "ṁ": "m",
     "ṃ": "m",
     "ɱ": "m",
     "ɯ": "m",
     "ⓝ": "n",
     "ｎ": "n",
     "ǹ": "n",
     "ń": "n",
     "ñ": "n",
     "ṅ": "n",
     "ň": "n",
     "ṇ": "n",
     "ņ": "n",
     "ṋ": "n",
     "ṉ": "n",
     "ƞ": "n",
     "ɲ": "n",
     "ŉ": "n",
     "ꞑ": "n",
     "ꞥ": "n",
     "ǌ": "nj",
     "ⓞ": "o",
     "ｏ": "o",
     "ò": "o",
     "ó": "o",
     "ô": "o",
     "ồ": "o",
     "ố": "o",
     "ỗ": "o",
     "ổ": "o",
     "õ": "o",
     "ṍ": "o",
     "ȭ": "o",
     "ṏ": "o",
     "ō": "o",
     "ṑ": "o",
     "ṓ": "o",
     "ŏ": "o",
     "ȯ": "o",
     "ȱ": "o",
     "ö": "o",
     "ȫ": "o",
     "ỏ": "o",
     "ő": "o",
     "ǒ": "o",
     "ȍ": "o",
     "ȏ": "o",
     "ơ": "o",
     "ờ": "o",
     "ớ": "o",
     "ỡ": "o",
     "ở": "o",
     "ợ": "o",
     "ọ": "o",
     "ộ": "o",
     "ǫ": "o",
     "ǭ": "o",
     "ø": "o",
     "ǿ": "o",
     "ɔ": "o",
     "ꝋ": "o",
     "ꝍ": "o",
     "ɵ": "o",
     "ƣ": "oi",
     "ȣ": "ou",
     "ꝏ": "oo",
     "ⓟ": "p",
     "ｐ": "p",
     "ṕ": "p",
     "ṗ": "p",
     "ƥ": "p",
     "ᵽ": "p",
     "ꝑ": "p",
     "ꝓ": "p",
     "ꝕ": "p",
     "ⓠ": "q",
     "ｑ": "q",
     "ɋ": "q",
     "ꝗ": "q",
     "ꝙ": "q",
     "ⓡ": "r",
     "ｒ": "r",
     "ŕ": "r",
     "ṙ": "r",
     "ř": "r",
     "ȑ": "r",
     "ȓ": "r",
     "ṛ": "r",
     "ṝ": "r",
     "ŗ": "r",
     "ṟ": "r",
     "ɍ": "r",
     "ɽ": "r",
     "ꝛ": "r",
     "ꞧ": "r",
     "ꞃ": "r",
     "ⓢ": "s",
     "ｓ": "s",
     "ß": "s",
     "ś": "s",
     "ṥ": "s",
     "ŝ": "s",
     "ṡ": "s",
     "š": "s",
     "ṧ": "s",
     "ṣ": "s",
     "ṩ": "s",
     "ș": "s",
     "ş": "s",
     "ȿ": "s",
     "ꞩ": "s",
     "ꞅ": "s",
     "ẛ": "s",
     "ⓣ": "t",
     "ｔ": "t",
     "ṫ": "t",
     "ẗ": "t",
     "ť": "t",
     "ṭ": "t",
     "ț": "t",
     "ţ": "t",
     "ṱ": "t",
     "ṯ": "t",
     "ŧ": "t",
     "ƭ": "t",
     "ʈ": "t",
     "ⱦ": "t",
     "ꞇ": "t",
     "ꜩ": "tz",
     "ⓤ": "u",
     "ｕ": "u",
     "ù": "u",
     "ú": "u",
     "û": "u",
     "ũ": "u",
     "ṹ": "u",
     "ū": "u",
     "ṻ": "u",
     "ŭ": "u",
     "ü": "u",
     "ǜ": "u",
     "ǘ": "u",
     "ǖ": "u",
     "ǚ": "u",
     "ủ": "u",
     "ů": "u",
     "ű": "u",
     "ǔ": "u",
     "ȕ": "u",
     "ȗ": "u",
     "ư": "u",
     "ừ": "u",
     "ứ": "u",
     "ữ": "u",
     "ử": "u",
     "ự": "u",
     "ụ": "u",
     "ṳ": "u",
     "ų": "u",
     "ṷ": "u",
     "ṵ": "u",
     "ʉ": "u",
     "ⓥ": "v",
     "ｖ": "v",
     "ṽ": "v",
     "ṿ": "v",
     "ʋ": "v",
     "ꝟ": "v",
     "ʌ": "v",
     "ꝡ": "vy",
     "ⓦ": "w",
     "ｗ": "w",
     "ẁ": "w",
     "ẃ": "w",
     "ŵ": "w",
     "ẇ": "w",
     "ẅ": "w",
     "ẘ": "w",
     "ẉ": "w",
     "ⱳ": "w",
     "ⓧ": "x",
     "ｘ": "x",
     "ẋ": "x",
     "ẍ": "x",
     "ⓨ": "y",
     "ｙ": "y",
     "ỳ": "y",
     "ý": "y",
     "ŷ": "y",
     "ỹ": "y",
     "ȳ": "y",
     "ẏ": "y",
     "ÿ": "y",
     "ỷ": "y",
     "ẙ": "y",
     "ỵ": "y",
     "ƴ": "y",
     "ɏ": "y",
     "ỿ": "y",
     "ⓩ": "z",
     "ｚ": "z",
     "ź": "z",
     "ẑ": "z",
     "ż": "z",
     "ž": "z",
     "ẓ": "z",
     "ẕ": "z",
     "ƶ": "z",
     "ȥ": "z",
     "ɀ": "z",
     "ⱬ": "z",
     "ꝣ": "z",
     "Ά": "Α",
     "Έ": "Ε",
     "Ή": "Η",
     "Ί": "Ι",
     "Ϊ": "Ι",
     "Ό": "Ο",
     "Ύ": "Υ",
     "Ϋ": "Υ",
     "Ώ": "Ω",
     "ά": "α",
     "έ": "ε",
     "ή": "η",
     "ί": "ι",
     "ϊ": "ι",
     "ΐ": "ι",
     "ό": "ο",
     "ύ": "υ",
     "ϋ": "υ",
     "ΰ": "υ",
     "ω": "ω",
     "ς": "σ"
    };
   T = t(document), C = function() {
    var t = 1;
    return function() {
     return t++
    }
   }(), S = w(k = w(Object, {
    bind: function(t) {
     var e = this;
     return function() {
      t.apply(e, arguments)
     }
    },
    init: function(n) {
     var i, s, o = ".select2-results";
     this.opts = n = this.prepareOpts(n), this.id = n.id, n.element.data("select2") !== e && null !== n.element.data("select2") && n.element.data("select2").destroy(), this.container = this.createContainer(), this.liveRegion = t(".select2-hidden-accessible"), 0 == this.liveRegion.length && (this.liveRegion = t("<span>", {
       role: "status",
       "aria-live": "polite"
      }).addClass("select2-hidden-accessible").appendTo(document.body)), this.containerId = "s2id_" + (n.element.attr("id") || "autogen" + C()), this.containerEventName = this.containerId.replace(/([.])/g, "_").replace(/([;&,\-\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1"), this.container.attr("id", this.containerId), this.container.attr("title", n.element.attr("title")), this.body = t(document.body), h(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.attr("style", n.element.attr("style")), this.container.css(y(n.containerCss, this.opts.element)), this.container.addClass(y(n.containerCssClass, this.opts.element)), this.elementTabIndex = this.opts.element.attr("tabindex"), this.opts.element.data("select2", this).attr("tabindex", "-1").before(this.container).on("click.select2", u), this.container.data("select2", this), this.dropdown = this.container.find(".select2-drop"), h(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(y(n.dropdownCssClass, this.opts.element)), this.dropdown.data("select2", this), this.dropdown.on("click", u), this.results = i = this.container.find(o), this.search = s = this.container.find("input.select2-input"), this.queryCount = 0, this.resultsPage = 0, this.context = null, this.initContainer(), this.container.on("click", u),
      function(n) {
       n.on("mousemove", function(n) {
        var i = P;
        i !== e && i.x === n.pageX && i.y === n.pageY || t(n.target).trigger("mousemove-filtered", n)
       })
      }(this.results), this.dropdown.on("mousemove-filtered", o, this.bind(this.highlightUnderEvent)), this.dropdown.on("touchstart touchmove touchend", o, this.bind(function(t) {
       this._touchEvent = !0, this.highlightUnderEvent(t)
      })), this.dropdown.on("touchmove", o, this.bind(this.touchMoved)), this.dropdown.on("touchstart touchend", o, this.bind(this.clearTouchMoved)), this.dropdown.on("click", this.bind(function(t) {
       this._touchEvent && (this._touchEvent = !1, this.selectHighlighted())
      })),
      function(t, e) {
       var n = c(t, function(t) {
        e.trigger("scroll-debounced", t)
       });
       e.on("scroll", function(t) {
        r(t.target, e.get()) >= 0 && n(t)
       })
      }(80, this.results), this.dropdown.on("scroll-debounced", o, this.bind(this.loadMoreIfNeeded)), t(this.container).on("change", ".select2-input", function(t) {
       t.stopPropagation()
      }), t(this.dropdown).on("change", ".select2-input", function(t) {
       t.stopPropagation()
      }), t.fn.mousewheel && i.mousewheel(function(t, e, n, r) {
       var s = i.scrollTop();
       r > 0 && s - r <= 0 ? (i.scrollTop(0), u(t)) : r < 0 && i.get(0).scrollHeight - i.scrollTop() + r <= i.height() && (i.scrollTop(i.get(0).scrollHeight - i.height()), u(t))
      }), l(s), s.on("keyup-change input paste", this.bind(this.updateResults)), s.on("focus", function() {
       s.addClass("select2-focused")
      }), s.on("blur", function() {
       s.removeClass("select2-focused")
      }), this.dropdown.on("click", o, this.bind(function(e) {
       t(e.target).closest(".select2-result-selectable").length > 0 && (this.highlightUnderEvent(e), this.selectHighlighted(e))
      })), this.dropdown.on("click mouseup mousedown touchstart touchend focusin", function(t) {
       t.stopPropagation()
      }), this.nextSearchTerm = e, t.isFunction(this.opts.initSelection) && (this.initSelection(), this.monitorSource()), null !== n.maximumInputLength && this.search.attr("maxlength", n.maximumInputLength);
     var a = n.element.prop("disabled");
     a === e && (a = !1), this.enable(!a);
     var p = n.element.prop("readonly");
     p === e && (p = !1), this.readonly(p), A = A || function() {
      var e = t(D);
      e.appendTo(document.body);
      var n = {
       width: e.width() - e[0].clientWidth,
       height: e.height() - e[0].clientHeight
      };
      return e.remove(), n
     }(), this.autofocus = n.element.prop("autofocus"), n.element.prop("autofocus", !1), this.autofocus && this.focus(), this.search.attr("placeholder", n.searchInputPlaceholder)
    },
    destroy: function() {
     var t = this.opts.element,
      n = t.data("select2"),
      i = this;
     this.close(), t.length && t[0].detachEvent && i._sync && t.each(function() {
      i._sync && this.detachEvent("onpropertychange", i._sync)
     }), this.propertyObserver && (this.propertyObserver.disconnect(), this.propertyObserver = null), this._sync = null, n !== e && (n.container.remove(), n.liveRegion.remove(), n.dropdown.remove(), t.show().removeData("select2").off(".select2").prop("autofocus", this.autofocus || !1), this.elementTabIndex ? t.attr({
      tabindex: this.elementTabIndex
     }) : t.removeAttr("tabindex"), t.show()), x.call(this, "container", "liveRegion", "dropdown", "results", "search")
    },
    optionToData: function(t) {
     return t.is("option") ? {
      id: t.prop("value"),
      text: t.text(),
      element: t.get(),
      css: t.attr("class"),
      disabled: t.prop("disabled"),
      locked: s(t.attr("locked"), "locked") || s(t.data("locked"), !0)
     } : t.is("optgroup") ? {
      text: t.attr("label"),
      children: [],
      element: t.get(),
      css: t.attr("class")
     } : void 0
    },
    prepareOpts: function(n) {
     var i, r, a, l, c = this;
     if ("select" === (i = n.element).get(0).tagName.toLowerCase() && (this.select = r = n.element), r && t.each(["id", "multiple", "ajax", "query", "createSearchChoice", "initSelection", "data", "tags"], function() {
       if (this in n) throw new Error("Option '" + this + "' is not allowed for Select2 when attached to a <select> element.")
      }), "function" != typeof(n = t.extend({}, {
       populateResults: function(i, r, s) {
        var o, a = this.opts.id,
         l = this.liveRegion;
        (o = function(i, r, u) {
         var h, p, d, f, m, g, v, y, b, x, w = [];
         for (h = 0, p = (i = n.sortResults(i, r, s)).length; h < p; h += 1) f = !(m = !0 === (d = i[h]).disabled) && a(d) !== e, g = d.children && d.children.length > 0, (v = t("<li></li>")).addClass("select2-results-dept-" + u), v.addClass("select2-result"), v.addClass(f ? "select2-result-selectable" : "select2-result-unselectable"), m && v.addClass("select2-disabled"), g && v.addClass("select2-result-with-children"), v.addClass(c.opts.formatResultCssClass(d)), v.attr("role", "presentation"), (y = t(document.createElement("div"))).addClass("select2-result-label"), y.attr("id", "select2-result-label-" + C()), y.attr("role", "option"), (x = n.formatResult(d, y, s, c.opts.escapeMarkup)) !== e && (y.html(x), v.append(y)), g && ((b = t("<ul></ul>")).addClass("select2-result-sub"), o(d.children, b, u + 1), v.append(b)), v.data("select2-data", d), w.push(v[0]);
         r.append(w), l.text(n.formatMatches(i.length))
        })(r, i, 0)
       }
      }, t.fn.select2.defaults, n)).id && (a = n.id, n.id = function(t) {
       return t[a]
      }), t.isArray(n.element.data("select2Tags"))) {
      if ("tags" in n) throw "tags specified as both an attribute 'data-select2-tags' and in options of Select2 " + n.element.attr("id");
      n.tags = n.element.data("select2Tags")
     }
     if (r ? (n.query = this.bind(function(t) {
       var n, r, s, o = {
         results: [],
         more: !1
        },
        a = t.term;
       s = function(e, n) {
        var i;
        e.is("option") ? t.matcher(a, e.text(), e) && n.push(c.optionToData(e)) : e.is("optgroup") && (i = c.optionToData(e), e.children().each2(function(t, e) {
         s(e, i.children)
        }), i.children.length > 0 && n.push(i))
       }, n = i.children(), this.getPlaceholder() !== e && n.length > 0 && (r = this.getPlaceholderOption()) && (n = n.not(r)), n.each2(function(t, e) {
        s(e, o.results)
       }), t.callback(o)
      }), n.id = function(t) {
       return t.id
      }) : "query" in n || ("ajax" in n ? ((l = n.element.data("ajax-url")) && l.length > 0 && (n.ajax.url = l), n.query = f.call(n.element, n.ajax)) : "data" in n ? n.query = m(n.data) : "tags" in n && (n.query = g(n.tags), n.createSearchChoice === e && (n.createSearchChoice = function(e) {
       return {
        id: t.trim(e),
        text: t.trim(e)
       }
      }), n.initSelection === e && (n.initSelection = function(e, i) {
       var r = [];
       t(o(e.val(), n.separator, n.transformVal)).each(function() {
        var e = {
          id: this,
          text: this
         },
         i = n.tags;
        t.isFunction(i) && (i = i()), t(i).each(function() {
         if (s(this.id, e.id)) return e = this, !1
        }), r.push(e)
       }), i(r)
      }))), "function" != typeof n.query) throw "query function not defined for Select2 " + n.element.attr("id");
     if ("top" === n.createSearchChoicePosition) n.createSearchChoicePosition = function(t, e) {
      t.unshift(e)
     };
     else if ("bottom" === n.createSearchChoicePosition) n.createSearchChoicePosition = function(t, e) {
      t.push(e)
     };
     else if ("function" != typeof n.createSearchChoicePosition) throw "invalid createSearchChoicePosition option must be 'top', 'bottom' or a custom function";
     return n
    },
    monitorSource: function() {
     var n, i = this.opts.element,
      r = this;
     i.on("change.select2", this.bind(function(t) {
      !0 !== this.opts.element.data("select2-change-triggered") && this.initSelection()
     })), this._sync = this.bind(function() {
      var t = i.prop("disabled");
      t === e && (t = !1), this.enable(!t);
      var n = i.prop("readonly");
      n === e && (n = !1), this.readonly(n), this.container && (h(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.addClass(y(this.opts.containerCssClass, this.opts.element))), this.dropdown && (h(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(y(this.opts.dropdownCssClass, this.opts.element)))
     }), i.length && i[0].attachEvent && i.each(function() {
      this.attachEvent("onpropertychange", r._sync)
     }), (n = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver) !== e && (this.propertyObserver && (delete this.propertyObserver, this.propertyObserver = null), this.propertyObserver = new n(function(e) {
      t.each(e, r._sync)
     }), this.propertyObserver.observe(i.get(0), {
      attributes: !0,
      subtree: !1
     }))
    },
    triggerSelect: function(e) {
     var n = t.Event("select2-selecting", {
      val: this.id(e),
      object: e,
      choice: e
     });
     return this.opts.element.trigger(n), !n.isDefaultPrevented()
    },
    triggerChange: function(e) {
     e = e || {}, e = t.extend({}, e, {
      type: "change",
      val: this.val()
     }), this.opts.element.data("select2-change-triggered", !0), this.opts.element.trigger(e), this.opts.element.data("select2-change-triggered", !1), this.opts.element.click(), this.opts.blurOnChange && this.opts.element.blur()
    },
    isInterfaceEnabled: function() {
     return !0 === this.enabledInterface
    },
    enableInterface: function() {
     var t = this._enabled && !this._readonly,
      e = !t;
     return t !== this.enabledInterface && (this.container.toggleClass("select2-container-disabled", e), this.close(), this.enabledInterface = t, !0)
    },
    enable: function(t) {
     t === e && (t = !0), this._enabled !== t && (this._enabled = t, this.opts.element.prop("disabled", !t), this.enableInterface())
    },
    disable: function() {
     this.enable(!1)
    },
    readonly: function(t) {
     t === e && (t = !1), this._readonly !== t && (this._readonly = t, this.opts.element.prop("readonly", t), this.enableInterface())
    },
    opened: function() {
     return !!this.container && this.container.hasClass("select2-dropdown-open")
    },
    positionDropdown: function() {
     var e, n, i, r, s, o = this.dropdown,
      a = this.container,
      l = a.offset(),
      c = a.outerHeight(!1),
      u = a.outerWidth(!1),
      h = o.outerHeight(!1),
      p = t(window),
      d = p.width(),
      f = p.height(),
      m = p.scrollLeft() + d,
      g = p.scrollTop() + f,
      v = l.top + c,
      b = l.left,
      x = v + h <= g,
      w = l.top - h >= p.scrollTop(),
      k = o.outerWidth(!1);
     o.hasClass("select2-drop-above") ? (n = !0, !w && x && (i = !0, n = !1)) : (n = !1, !x && w && (i = !0, n = !0)), i && (o.hide(), l = this.container.offset(), c = this.container.outerHeight(!1), u = this.container.outerWidth(!1), h = o.outerHeight(!1), m = p.scrollLeft() + d, g = p.scrollTop() + f, v = l.top + c, b = l.left, k = o.outerWidth(!1), o.show(), this.focusSearch()), this.opts.dropdownAutoWidth ? (s = t(".select2-results", o)[0], o.addClass("select2-drop-auto-width"), o.css("width", ""), (k = o.outerWidth(!1) + (s.scrollHeight === s.clientHeight ? 0 : A.width)) > u ? u = k : k = u, h = o.outerHeight(!1)) : this.container.removeClass("select2-drop-auto-width"), "static" !== this.body.css("position") && (v -= (e = this.body.offset()).top, b -= e.left), !(b + k <= m) && l.left + m + a.outerWidth(!1) > k && (b = l.left + this.container.outerWidth(!1) - k), r = {
      left: b,
      width: u
     }, n ? (r.top = l.top - h, r.bottom = "auto", this.container.addClass("select2-drop-above"), o.addClass("select2-drop-above")) : (r.top = v, r.bottom = "auto", this.container.removeClass("select2-drop-above"), o.removeClass("select2-drop-above")), r = t.extend(r, y(this.opts.dropdownCss, this.opts.element)), o.css(r)
    },
    shouldOpen: function() {
     var e;
     return !this.opened() && (!1 !== this._enabled && !0 !== this._readonly && (e = t.Event("select2-opening"), this.opts.element.trigger(e), !e.isDefaultPrevented()))
    },
    clearDropdownAlignmentPreference: function() {
     this.container.removeClass("select2-drop-above"), this.dropdown.removeClass("select2-drop-above")
    },
    open: function() {
     return !!this.shouldOpen() && (this.opening(), T.on("mousemove.select2Event", function(t) {
      P.x = t.pageX, P.y = t.pageY
     }), !0)
    },
    opening: function() {
     var e, i = this.containerEventName,
      r = "scroll." + i,
      s = "resize." + i,
      o = "orientationchange." + i;
     this.container.addClass("select2-dropdown-open").addClass("select2-container-active"), this.clearDropdownAlignmentPreference(), this.dropdown[0] !== this.body.children().last()[0] && this.dropdown.detach().appendTo(this.body), 0 === (e = t("#select2-drop-mask")).length && ((e = t(document.createElement("div"))).attr("id", "select2-drop-mask").attr("class", "select2-drop-mask"), e.hide(), e.appendTo(this.body), e.on("mousedown touchstart click", function(i) {
      n(e);
      var r, s = t("#select2-drop");
      s.length > 0 && ((r = s.data("select2")).opts.selectOnBlur && r.selectHighlighted({
       noFocus: !0
      }), r.close(), i.preventDefault(), i.stopPropagation())
     })), this.dropdown.prev()[0] !== e[0] && this.dropdown.before(e), t("#select2-drop").removeAttr("id"), this.dropdown.attr("id", "select2-drop"), e.show(), this.positionDropdown(), this.dropdown.show(), this.positionDropdown(), this.dropdown.addClass("select2-drop-active");
     var a = this;
     this.container.parents().add(window).each(function() {
      t(this).on(s + " " + r + " " + o, function(t) {
       a.opened() && a.positionDropdown()
      })
     })
    },
    close: function() {
     if (this.opened()) {
      var e = this.containerEventName,
       n = "scroll." + e,
       i = "resize." + e,
       r = "orientationchange." + e;
      this.container.parents().add(window).each(function() {
       t(this).off(n).off(i).off(r)
      }), this.clearDropdownAlignmentPreference(), t("#select2-drop-mask").hide(), this.dropdown.removeAttr("id"), this.dropdown.hide(), this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active"), this.results.empty(), T.off("mousemove.select2Event"), this.clearSearch(), this.search.removeClass("select2-active"), this.opts.element.trigger(t.Event("select2-close"))
     }
    },
    externalSearch: function(t) {
     this.open(), this.search.val(t), this.updateResults(!1)
    },
    clearSearch: function() {},
    getMaximumSelectionSize: function() {
     return y(this.opts.maximumSelectionSize, this.opts.element)
    },
    ensureHighlightVisible: function() {
     var e, n, i, r, s, o, a, l, c = this.results;
     (n = this.highlight()) < 0 || (0 != n ? (e = this.findHighlightableChoices().find(".select2-result-label"), r = (l = ((i = t(e[n])).offset() || {}).top || 0) + i.outerHeight(!0), n === e.length - 1 && (a = c.find("li.select2-more-results")).length > 0 && (r = a.offset().top + a.outerHeight(!0)), r > (s = c.offset().top + c.outerHeight(!1)) && c.scrollTop(c.scrollTop() + (r - s)), (o = l - c.offset().top) < 0 && "none" != i.css("display") && c.scrollTop(c.scrollTop() + o)) : c.scrollTop(0))
    },
    findHighlightableChoices: function() {
     return this.results.find(".select2-result-selectable:not(.select2-disabled):not(.select2-selected)")
    },
    moveHighlight: function(e) {
     for (var n = this.findHighlightableChoices(), i = this.highlight(); i > -1 && i < n.length;) {
      var r = t(n[i += e]);
      if (r.hasClass("select2-result-selectable") && !r.hasClass("select2-disabled") && !r.hasClass("select2-selected")) {
       this.highlight(i);
       break
      }
     }
    },
    highlight: function(e) {
     var n, i, s = this.findHighlightableChoices();
     if (0 === arguments.length) return r(s.filter(".select2-highlighted")[0], s.get());
     e >= s.length && (e = s.length - 1), e < 0 && (e = 0), this.removeHighlight(), (n = t(s[e])).addClass("select2-highlighted"), this.search.attr("aria-activedescendant", n.find(".select2-result-label").attr("id")), this.ensureHighlightVisible(), this.liveRegion.text(n.text()), (i = n.data("select2-data")) && this.opts.element.trigger({
      type: "select2-highlight",
      val: this.id(i),
      choice: i
     })
    },
    removeHighlight: function() {
     this.results.find(".select2-highlighted").removeClass("select2-highlighted")
    },
    touchMoved: function() {
     this._touchMoved = !0
    },
    clearTouchMoved: function() {
     this._touchMoved = !1
    },
    countSelectableResults: function() {
     return this.findHighlightableChoices().length
    },
    highlightUnderEvent: function(e) {
     var n = t(e.target).closest(".select2-result-selectable");
     if (n.length > 0 && !n.is(".select2-highlighted")) {
      var i = this.findHighlightableChoices();
      this.highlight(i.index(n))
     } else 0 == n.length && this.removeHighlight()
    },
    loadMoreIfNeeded: function() {
     var t = this.results,
      e = t.find("li.select2-more-results"),
      n = this.resultsPage + 1,
      i = this,
      r = this.search.val(),
      s = this.context;
     0 !== e.length && e.offset().top - t.offset().top - t.height() <= this.opts.loadMorePadding && (e.addClass("select2-active"), this.opts.query({
      element: this.opts.element,
      term: r,
      page: n,
      context: s,
      matcher: this.opts.matcher,
      callback: this.bind(function(o) {
       i.opened() && (i.opts.populateResults.call(this, t, o.results, {
        term: r,
        page: n,
        context: s
       }), i.postprocessResults(o, !1, !1), !0 === o.more ? (e.detach().appendTo(t).html(i.opts.escapeMarkup(y(i.opts.formatLoadMore, i.opts.element, n + 1))), window.setTimeout(function() {
        i.loadMoreIfNeeded()
       }, 10)) : e.remove(), i.positionDropdown(), i.resultsPage = n, i.context = o.context, this.opts.element.trigger({
        type: "select2-loaded",
        items: o
       }))
      })
     }))
    },
    tokenize: function() {},
    updateResults: function(n) {
     function i() {
      c.removeClass("select2-active"), p.positionDropdown(), u.find(".select2-no-results,.select2-selection-limit,.select2-searching").length ? p.liveRegion.text(u.text()) : p.liveRegion.text(p.opts.formatMatches(u.find('.select2-result-selectable:not(".select2-selected")').length))
     }

     function r(t) {
      u.html(t), i()
     }
     var o, a, l, c = this.search,
      u = this.results,
      h = this.opts,
      p = this,
      d = c.val(),
      f = t.data(this.container, "select2-last-term");
     if ((!0 === n || !f || !s(d, f)) && (t.data(this.container, "select2-last-term", d), !0 === n || !1 !== this.showSearchInput && this.opened())) {
      l = ++this.queryCount;
      var m = this.getMaximumSelectionSize();
      if (!(m >= 1 && (o = this.data(), t.isArray(o) && o.length >= m && v(h.formatSelectionTooBig, "formatSelectionTooBig")))) return c.val().length < h.minimumInputLength ? (r(v(h.formatInputTooShort, "formatInputTooShort") ? "<li class='select2-no-results'>" + y(h.formatInputTooShort, h.element, c.val(), h.minimumInputLength) + "</li>" : ""), void(n && this.showSearch && this.showSearch(!0))) : void(h.maximumInputLength && c.val().length > h.maximumInputLength ? r(v(h.formatInputTooLong, "formatInputTooLong") ? "<li class='select2-no-results'>" + y(h.formatInputTooLong, h.element, c.val(), h.maximumInputLength) + "</li>" : "") : (h.formatSearching && 0 === this.findHighlightableChoices().length && r("<li class='select2-searching'>" + y(h.formatSearching, h.element) + "</li>"), c.addClass("select2-active"), this.removeHighlight(), (a = this.tokenize()) != e && null != a && c.val(a), this.resultsPage = 1, h.query({
       element: h.element,
       term: c.val(),
       page: this.resultsPage,
       context: null,
       matcher: h.matcher,
       callback: this.bind(function(o) {
        var a;
        l == this.queryCount && (this.opened() ? o.hasError !== e && v(h.formatAjaxError, "formatAjaxError") ? r("<li class='select2-ajax-error'>" + y(h.formatAjaxError, h.element, o.jqXHR, o.textStatus, o.errorThrown) + "</li>") : (this.context = o.context === e ? null : o.context, this.opts.createSearchChoice && "" !== c.val() && (a = this.opts.createSearchChoice.call(p, c.val(), o.results)) !== e && null !== a && p.id(a) !== e && null !== p.id(a) && 0 === t(o.results).filter(function() {
         return s(p.id(this), p.id(a))
        }).length && this.opts.createSearchChoicePosition(o.results, a), 0 === o.results.length && v(h.formatNoMatches, "formatNoMatches") ? r("<li class='select2-no-results'>" + y(h.formatNoMatches, h.element, c.val()) + "</li>") : (u.empty(), p.opts.populateResults.call(this, u, o.results, {
         term: c.val(),
         page: this.resultsPage,
         context: null
        }), !0 === o.more && v(h.formatLoadMore, "formatLoadMore") && (u.append("<li class='select2-more-results'>" + h.escapeMarkup(y(h.formatLoadMore, h.element, this.resultsPage)) + "</li>"), window.setTimeout(function() {
         p.loadMoreIfNeeded()
        }, 10)), this.postprocessResults(o, n), i(), this.opts.element.trigger({
         type: "select2-loaded",
         items: o
        }))) : this.search.removeClass("select2-active"))
       })
      })));
      r("<li class='select2-selection-limit'>" + y(h.formatSelectionTooBig, h.element, m) + "</li>")
     }
    },
    cancel: function() {
     this.close()
    },
    blur: function() {
     this.opts.selectOnBlur && this.selectHighlighted({
      noFocus: !0
     }), this.close(), this.container.removeClass("select2-container-active"), this.search[0] === document.activeElement && this.search.blur(), this.clearSearch(), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")
    },
    focusSearch: function() {
     ! function(t) {
      t[0] !== document.activeElement && window.setTimeout(function() {
       var e, n = t[0],
        i = t.val().length;
       t.focus(), (n.offsetWidth > 0 || n.offsetHeight > 0) && n === document.activeElement && (n.setSelectionRange ? n.setSelectionRange(i, i) : n.createTextRange && ((e = n.createTextRange()).collapse(!1), e.select()))
      }, 0)
     }(this.search)
    },
    selectHighlighted: function(t) {
     if (this._touchMoved) this.clearTouchMoved();
     else {
      var e = this.highlight(),
       n = this.results.find(".select2-highlighted").closest(".select2-result").data("select2-data");
      n ? (this.highlight(e), this.onSelect(n, t)) : t && t.noFocus && this.close()
     }
    },
    getPlaceholder: function() {
     var t;
     return this.opts.element.attr("placeholder") || this.opts.element.attr("data-placeholder") || this.opts.element.data("placeholder") || this.opts.placeholder || ((t = this.getPlaceholderOption()) !== e ? t.text() : e)
    },
    getPlaceholderOption: function() {
     if (this.select) {
      var n = this.select.children("option").first();
      if (this.opts.placeholderOption !== e) return "first" === this.opts.placeholderOption && n || "function" == typeof this.opts.placeholderOption && this.opts.placeholderOption(this.select);
      if ("" === t.trim(n.text()) && "" === n.val()) return n
     }
    },
    initContainerWidth: function() {
     var n = function() {
      var n, i, r, s, o, a;
      if ("off" === this.opts.width) return null;
      if ("element" === this.opts.width) return 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px";
      if ("copy" === this.opts.width || "resolve" === this.opts.width) {
       if ((n = this.opts.element.attr("style")) !== e)
        for (s = 0, o = (i = n.split(";")).length; s < o; s += 1)
         if (a = i[s].replace(/\s/g, ""), null !== (r = a.match(/^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i)) && r.length >= 1) return r[1];
       return "resolve" === this.opts.width ? (n = this.opts.element.css("width")).indexOf("%") > 0 ? n : 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px" : null
      }
      return t.isFunction(this.opts.width) ? this.opts.width() : this.opts.width
     }.call(this);
     null !== n && this.container.css("width", n)
    }
   }), {
    createContainer: function() {
     return t(document.createElement("div")).attr({
      class: "select2-container"
     }).html(["<a href='javascript:void(0)' class='select2-choice' tabindex='-1'>", "   <span class='select2-chosen'>&#160;</span><abbr class='select2-search-choice-close'></abbr>", "   <span class='select2-arrow' role='presentation'><b role='presentation'></b></span>", "</a>", "<label for='' class='select2-offscreen'></label>", "<input class='select2-focusser select2-offscreen' type='text' aria-haspopup='true' role='button' />", "<div class='select2-drop select2-display-none'>", "   <div class='select2-search'>", "       <label for='' class='select2-offscreen'></label>", "       <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input' role='combobox' aria-expanded='true'", "       aria-autocomplete='list' />", "   </div>", "   <ul class='select2-results' role='listbox'>", "   </ul>", "</div>"].join(""))
    },
    enableInterface: function() {
     this.parent.enableInterface.apply(this, arguments) && this.focusser.prop("disabled", !this.isInterfaceEnabled())
    },
    opening: function() {
     var n, i, r;
     this.opts.minimumResultsForSearch >= 0 && this.showSearch(!0), this.parent.opening.apply(this, arguments), !1 !== this.showSearchInput && this.search.val(this.focusser.val()), this.opts.shouldFocusInput(this) && (this.search.focus(), (n = this.search.get(0)).createTextRange ? ((i = n.createTextRange()).collapse(!1), i.select()) : n.setSelectionRange && (r = this.search.val().length, n.setSelectionRange(r, r))), "" === this.search.val() && this.nextSearchTerm != e && (this.search.val(this.nextSearchTerm), this.search.select()), this.focusser.prop("disabled", !0).val(""), this.updateResults(!0), this.opts.element.trigger(t.Event("select2-open"))
    },
    close: function() {
     this.opened() && (this.parent.close.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
    },
    focus: function() {
     this.opened() ? this.close() : (this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
    },
    isFocused: function() {
     return this.container.hasClass("select2-container-active")
    },
    cancel: function() {
     this.parent.cancel.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus()
    },
    destroy: function() {
     t("label[for='" + this.focusser.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), x.call(this, "selection", "focusser")
    },
    initContainer: function() {
     var e, i, r = this.container,
      s = this.dropdown,
      o = C();
     this.opts.minimumResultsForSearch < 0 ? this.showSearch(!1) : this.showSearch(!0), this.selection = e = r.find(".select2-choice"), this.focusser = r.find(".select2-focusser"), e.find(".select2-chosen").attr("id", "select2-chosen-" + o), this.focusser.attr("aria-labelledby", "select2-chosen-" + o), this.results.attr("id", "select2-results-" + o), this.search.attr("aria-owns", "select2-results-" + o), this.focusser.attr("id", "s2id_autogen" + o), i = t("label[for='" + this.opts.element.attr("id") + "']"), this.opts.element.focus(this.bind(function() {
      this.focus()
     })), this.focusser.prev().text(i.text()).attr("for", this.focusser.attr("id"));
     var a = this.opts.element.attr("title");
     this.opts.element.attr("title", a || i.text()), this.focusser.attr("tabindex", this.elementTabIndex), this.search.attr("id", this.focusser.attr("id") + "_search"), this.search.prev().text(t("label[for='" + this.focusser.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.search.on("keydown", this.bind(function(t) {
      if (this.isInterfaceEnabled() && 229 != t.keyCode)
       if (t.which !== N.PAGE_UP && t.which !== N.PAGE_DOWN) switch (t.which) {
        case N.UP:
        case N.DOWN:
         return this.moveHighlight(t.which === N.UP ? -1 : 1), void u(t);
        case N.ENTER:
         return this.selectHighlighted(), void u(t);
        case N.TAB:
         return void this.selectHighlighted({
          noFocus: !0
         });
        case N.ESC:
         return this.cancel(t), void u(t)
       } else u(t)
     })), this.search.on("blur", this.bind(function(t) {
      document.activeElement === this.body.get(0) && window.setTimeout(this.bind(function() {
       this.opened() && this.search.focus()
      }), 0)
     })), this.focusser.on("keydown", this.bind(function(t) {
      if (this.isInterfaceEnabled() && t.which !== N.TAB && !N.isControl(t) && !N.isFunctionKey(t) && t.which !== N.ESC) {
       if (!1 !== this.opts.openOnEnter || t.which !== N.ENTER) {
        if (t.which == N.DOWN || t.which == N.UP || t.which == N.ENTER && this.opts.openOnEnter) {
         if (t.altKey || t.ctrlKey || t.shiftKey || t.metaKey) return;
         return this.open(), void u(t)
        }
        return t.which == N.DELETE || t.which == N.BACKSPACE ? (this.opts.allowClear && this.clear(), void u(t)) : void 0
       }
       u(t)
      }
     })), l(this.focusser), this.focusser.on("keyup-change input", this.bind(function(t) {
      if (this.opts.minimumResultsForSearch >= 0) {
       if (t.stopPropagation(), this.opened()) return;
       this.open()
      }
     })), e.on("click", "abbr", this.bind(function(t) {
      this.isInterfaceEnabled() && (this.clear(), function(t) {
       t.preventDefault(), t.stopImmediatePropagation()
      }(t), this.close(), this.selection && this.selection.focus())
     })), e.on("click", this.bind(function(i) {
      n(e), this.container.hasClass("select2-container-active") || this.opts.element.trigger(t.Event("select2-focus")), this.opened() ? this.close() : this.isInterfaceEnabled() && this.open(), u(i)
     })), s.on("click touchstart", this.bind(function() {
      this.opts.shouldFocusInput(this) && this.search.focus()
     })), e.on("focus", this.bind(function(t) {
      u(t)
     })), this.focusser.on("focus", this.bind(function() {
      this.container.hasClass("select2-container-active") || this.opts.element.trigger(t.Event("select2-focus")), this.container.addClass("select2-container-active")
     })).on("blur", this.bind(function() {
      this.opened() || (this.container.removeClass("select2-container-active"), this.opts.element.trigger(t.Event("select2-blur")))
     })), this.search.on("focus", this.bind(function() {
      this.container.hasClass("select2-container-active") || this.opts.element.trigger(t.Event("select2-focus")), this.container.addClass("select2-container-active")
     })), this.initContainerWidth(), this.opts.element.hide(), this.setPlaceholder()
    },
    clear: function(e) {
     var n = this.selection.data("select2-data");
     if (n) {
      var i = t.Event("select2-clearing");
      if (this.opts.element.trigger(i), i.isDefaultPrevented()) return;
      var r = this.getPlaceholderOption();
      this.opts.element.val(r ? r.val() : ""), this.selection.find(".select2-chosen").empty(), this.selection.removeData("select2-data"), this.setPlaceholder(), !1 !== e && (this.opts.element.trigger({
       type: "select2-removed",
       val: this.id(n),
       choice: n
      }), this.triggerChange({
       removed: n
      }))
     }
    },
    initSelection: function() {
     if (this.isPlaceholderOptionSelected()) this.updateSelection(null), this.close(), this.setPlaceholder();
     else {
      var t = this;
      this.opts.initSelection.call(null, this.opts.element, function(n) {
       n !== e && null !== n && (t.updateSelection(n), t.close(), t.setPlaceholder(), t.nextSearchTerm = t.opts.nextSearchTerm(n, t.search.val()))
      })
     }
    },
    isPlaceholderOptionSelected: function() {
     var t;
     return this.getPlaceholder() !== e && ((t = this.getPlaceholderOption()) !== e && t.prop("selected") || "" === this.opts.element.val() || this.opts.element.val() === e || null === this.opts.element.val())
    },
    prepareOpts: function() {
     var e = this.parent.prepareOpts.apply(this, arguments),
      n = this;
     return "select" === e.element.get(0).tagName.toLowerCase() ? e.initSelection = function(t, e) {
      var i = t.find("option").filter(function() {
       return this.selected && !this.disabled
      });
      e(n.optionToData(i))
     } : "data" in e && (e.initSelection = e.initSelection || function(n, i) {
      var r = n.val(),
       o = null;
      e.query({
       matcher: function(t, n, i) {
        var a = s(r, e.id(i));
        return a && (o = i), a
       },
       callback: t.isFunction(i) ? function() {
        i(o)
       } : t.noop
      })
     }), e
    },
    getPlaceholder: function() {
     return this.select && this.getPlaceholderOption() === e ? e : this.parent.getPlaceholder.apply(this, arguments)
    },
    setPlaceholder: function() {
     var t = this.getPlaceholder();
     if (this.isPlaceholderOptionSelected() && t !== e) {
      if (this.select && this.getPlaceholderOption() === e) return;
      this.selection.find(".select2-chosen").html(this.opts.escapeMarkup(t)), this.selection.addClass("select2-default"), this.container.removeClass("select2-allowclear")
     }
    },
    postprocessResults: function(t, e, n) {
     var i = 0,
      r = this;
     if (this.findHighlightableChoices().each2(function(t, e) {
       if (s(r.id(e.data("select2-data")), r.opts.element.val())) return i = t, !1
      }), !1 !== n && (!0 === e && i >= 0 ? this.highlight(i) : this.highlight(0)), !0 === e) {
      var o = this.opts.minimumResultsForSearch;
      o >= 0 && this.showSearch(b(t.results) >= o)
     }
    },
    showSearch: function(e) {
     this.showSearchInput !== e && (this.showSearchInput = e, this.dropdown.find(".select2-search").toggleClass("select2-search-hidden", !e), this.dropdown.find(".select2-search").toggleClass("select2-offscreen", !e), t(this.dropdown, this.container).toggleClass("select2-with-searchbox", e))
    },
    onSelect: function(t, e) {
     if (this.triggerSelect(t)) {
      var n = this.opts.element.val(),
       i = this.data();
      this.opts.element.val(this.id(t)), this.updateSelection(t), this.opts.element.trigger({
       type: "select2-selected",
       val: this.id(t),
       choice: t
      }), this.nextSearchTerm = this.opts.nextSearchTerm(t, this.search.val()), this.close(), e && e.noFocus || !this.opts.shouldFocusInput(this) || this.focusser.focus(), s(n, this.id(t)) || this.triggerChange({
       added: t,
       removed: i
      })
     }
    },
    updateSelection: function(t) {
     var n, i, r = this.selection.find(".select2-chosen");
     this.selection.data("select2-data", t), r.empty(), null !== t && (n = this.opts.formatSelection(t, r, this.opts.escapeMarkup)), n !== e && r.append(n), (i = this.opts.formatSelectionCssClass(t, r)) !== e && r.addClass(i), this.selection.removeClass("select2-default"), this.opts.allowClear && this.getPlaceholder() !== e && this.container.addClass("select2-allowclear")
    },
    val: function() {
     var t, n = !1,
      i = null,
      r = this,
      s = this.data();
     if (0 === arguments.length) return this.opts.element.val();
     if (t = arguments[0], arguments.length > 1 && (n = arguments[1]), this.select) this.select.val(t).find("option").filter(function() {
      return this.selected
     }).each2(function(t, e) {
      return i = r.optionToData(e), !1
     }), this.updateSelection(i), this.setPlaceholder(), n && this.triggerChange({
      added: i,
      removed: s
     });
     else {
      if (!t && 0 !== t) return void this.clear(n);
      if (this.opts.initSelection === e) throw new Error("cannot call val() if initSelection() is not defined");
      this.opts.element.val(t), this.opts.initSelection(this.opts.element, function(t) {
       r.opts.element.val(t ? r.id(t) : ""), r.updateSelection(t), r.setPlaceholder(), n && r.triggerChange({
        added: t,
        removed: s
       })
      })
     }
    },
    clearSearch: function() {
     this.search.val(""), this.focusser.val("")
    },
    data: function(t) {
     var n, i = !1;
     if (0 === arguments.length) return (n = this.selection.data("select2-data")) == e && (n = null), n;
     arguments.length > 1 && (i = arguments[1]), t ? (n = this.data(), this.opts.element.val(t ? this.id(t) : ""), this.updateSelection(t), i && this.triggerChange({
      added: t,
      removed: n
     })) : this.clear(i)
    }
   }), _ = w(k, {
    createContainer: function() {
     return t(document.createElement("div")).attr({
      class: "select2-container select2-container-multi"
     }).html(["<ul class='select2-choices'>", "  <li class='select2-search-field'>", "    <label for='' class='select2-offscreen'></label>", "    <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'>", "  </li>", "</ul>", "<div class='select2-drop select2-drop-multi select2-display-none'>", "   <ul class='select2-results'>", "   </ul>", "</div>"].join(""))
    },
    prepareOpts: function() {
     var e = this.parent.prepareOpts.apply(this, arguments),
      n = this;
     return "select" === e.element.get(0).tagName.toLowerCase() ? e.initSelection = function(t, e) {
      var i = [];
      t.find("option").filter(function() {
       return this.selected && !this.disabled
      }).each2(function(t, e) {
       i.push(n.optionToData(e))
      }), e(i)
     } : "data" in e && (e.initSelection = e.initSelection || function(n, i) {
      var r = o(n.val(), e.separator, e.transformVal),
       a = [];
      e.query({
       matcher: function(n, i, o) {
        var l = t.grep(r, function(t) {
         return s(t, e.id(o))
        }).length;
        return l && a.push(o), l
       },
       callback: t.isFunction(i) ? function() {
        for (var t = [], n = 0; n < r.length; n++)
         for (var o = r[n], l = 0; l < a.length; l++) {
          var c = a[l];
          if (s(o, e.id(c))) {
           t.push(c), a.splice(l, 1);
           break
          }
         }
        i(t)
       } : t.noop
      })
     }), e
    },
    selectChoice: function(t) {
     var e = this.container.find(".select2-search-choice-focus");
     e.length && t && t[0] == e[0] || (e.length && this.opts.element.trigger("choice-deselected", e), e.removeClass("select2-search-choice-focus"), t && t.length && (this.close(), t.addClass("select2-search-choice-focus"), this.opts.element.trigger("choice-selected", t)))
    },
    destroy: function() {
     t("label[for='" + this.search.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), x.call(this, "searchContainer", "selection")
    },
    initContainer: function() {
     var e, n = ".select2-choices";
     this.searchContainer = this.container.find(".select2-search-field"), this.selection = e = this.container.find(n);
     var i = this;
     this.selection.on("click", ".select2-container:not(.select2-container-disabled) .select2-search-choice:not(.select2-locked)", function(e) {
      i.search[0].focus(), i.selectChoice(t(this))
     }), this.search.attr("id", "s2id_autogen" + C()), this.search.prev().text(t("label[for='" + this.opts.element.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.opts.element.focus(this.bind(function() {
      this.focus()
     })), this.search.on("input paste", this.bind(function() {
      this.search.attr("placeholder") && 0 == this.search.val().length || this.isInterfaceEnabled() && (this.opened() || this.open())
     })), this.search.attr("tabindex", this.elementTabIndex), this.keydowns = 0, this.search.on("keydown", this.bind(function(n) {
      if (this.isInterfaceEnabled()) {
       ++this.keydowns;
       var i = e.find(".select2-search-choice-focus"),
        r = i.prev(".select2-search-choice:not(.select2-locked)"),
        s = i.next(".select2-search-choice:not(.select2-locked)"),
        o = function(e) {
         var n = 0,
          i = 0;
         if ("selectionStart" in (e = t(e)[0])) n = e.selectionStart, i = e.selectionEnd - n;
         else if ("selection" in document) {
          e.focus();
          var r = document.selection.createRange();
          i = document.selection.createRange().text.length, r.moveStart("character", -e.value.length), n = r.text.length - i
         }
         return {
          offset: n,
          length: i
         }
        }(this.search);
       if (i.length && (n.which == N.LEFT || n.which == N.RIGHT || n.which == N.BACKSPACE || n.which == N.DELETE || n.which == N.ENTER)) {
        var a = i;
        return n.which == N.LEFT && r.length ? a = r : n.which == N.RIGHT ? a = s.length ? s : null : n.which === N.BACKSPACE ? this.unselect(i.first()) && (this.search.width(10), a = r.length ? r : s) : n.which == N.DELETE ? this.unselect(i.first()) && (this.search.width(10), a = s.length ? s : null) : n.which == N.ENTER && (a = null), this.selectChoice(a), u(n), void(a && a.length || this.open())
       }
       if ((n.which === N.BACKSPACE && 1 == this.keydowns || n.which == N.LEFT) && 0 == o.offset && !o.length) return this.selectChoice(e.find(".select2-search-choice:not(.select2-locked)").last()), void u(n);
       if (this.selectChoice(null), this.opened()) switch (n.which) {
        case N.UP:
        case N.DOWN:
         return this.moveHighlight(n.which === N.UP ? -1 : 1), void u(n);
        case N.ENTER:
         return this.selectHighlighted(), void u(n);
        case N.TAB:
         return this.selectHighlighted({
          noFocus: !0
         }), void this.close();
        case N.ESC:
         return this.cancel(n), void u(n)
       }
       if (n.which !== N.TAB && !N.isControl(n) && !N.isFunctionKey(n) && n.which !== N.BACKSPACE && n.which !== N.ESC) {
        if (n.which === N.ENTER) {
         if (!1 === this.opts.openOnEnter) return;
         if (n.altKey || n.ctrlKey || n.shiftKey || n.metaKey) return
        }
        this.open(), n.which !== N.PAGE_UP && n.which !== N.PAGE_DOWN || u(n), n.which === N.ENTER && u(n)
       }
      }
     })), this.search.on("keyup", this.bind(function(t) {
      this.keydowns = 0, this.resizeSearch()
     })), this.search.on("blur", this.bind(function(e) {
      this.container.removeClass("select2-container-active"), this.search.removeClass("select2-focused"), this.selectChoice(null), this.opened() || this.clearSearch(), e.stopImmediatePropagation(), this.opts.element.trigger(t.Event("select2-blur"))
     })), this.container.on("click", n, this.bind(function(e) {
      this.isInterfaceEnabled() && (t(e.target).closest(".select2-search-choice").length > 0 || (this.selectChoice(null), this.clearPlaceholder(), this.container.hasClass("select2-container-active") || this.opts.element.trigger(t.Event("select2-focus")), this.open(), this.focusSearch(), e.preventDefault()))
     })), this.container.on("focus", n, this.bind(function() {
      this.isInterfaceEnabled() && (this.container.hasClass("select2-container-active") || this.opts.element.trigger(t.Event("select2-focus")), this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"), this.clearPlaceholder())
     })), this.initContainerWidth(), this.opts.element.hide(), this.clearSearch()
    },
    enableInterface: function() {
     this.parent.enableInterface.apply(this, arguments) && this.search.prop("disabled", !this.isInterfaceEnabled())
    },
    initSelection: function() {
     if ("" === this.opts.element.val() && "" === this.opts.element.text() && (this.updateSelection([]), this.close(), this.clearSearch()), this.select || "" !== this.opts.element.val()) {
      var t = this;
      this.opts.initSelection.call(null, this.opts.element, function(n) {
       n !== e && null !== n && (t.updateSelection(n), t.close(), t.clearSearch())
      })
     }
    },
    clearSearch: function() {
     var t = this.getPlaceholder(),
      n = this.getMaxSearchWidth();
     t !== e && 0 === this.getVal().length && !1 === this.search.hasClass("select2-focused") ? (this.search.val(t).addClass("select2-default"), this.search.width(n > 0 ? n : this.container.css("width"))) : this.search.val("").width(10)
    },
    clearPlaceholder: function() {
     this.search.hasClass("select2-default") && this.search.val("").removeClass("select2-default")
    },
    opening: function() {
     this.clearPlaceholder(), this.resizeSearch(), this.parent.opening.apply(this, arguments), this.focusSearch(), "" === this.search.val() && this.nextSearchTerm != e && (this.search.val(this.nextSearchTerm), this.search.select()), this.updateResults(!0), this.opts.shouldFocusInput(this) && this.search.focus(), this.opts.element.trigger(t.Event("select2-open"))
    },
    close: function() {
     this.opened() && this.parent.close.apply(this, arguments)
    },
    focus: function() {
     this.close(), this.search.focus()
    },
    isFocused: function() {
     return this.search.hasClass("select2-focused")
    },
    updateSelection: function(e) {
     var n = [],
      i = [],
      s = this;
     t(e).each(function() {
      r(s.id(this), n) < 0 && (n.push(s.id(this)), i.push(this))
     }), e = i, this.selection.find(".select2-search-choice").remove(), t(e).each(function() {
      s.addSelectedChoice(this)
     }), s.postprocessResults()
    },
    tokenize: function() {
     var t = this.search.val();
     null != (t = this.opts.tokenizer.call(this, t, this.data(), this.bind(this.onSelect), this.opts)) && t != e && (this.search.val(t), t.length > 0 && this.open())
    },
    onSelect: function(t, n) {
     this.triggerSelect(t) && "" !== t.text && (this.addSelectedChoice(t), this.opts.element.trigger({
      type: "selected",
      val: this.id(t),
      choice: t
     }), this.nextSearchTerm = this.opts.nextSearchTerm(t, this.search.val()), this.clearSearch(), this.updateResults(), !this.select && this.opts.closeOnSelect || this.postprocessResults(t, !1, !0 === this.opts.closeOnSelect), this.opts.closeOnSelect ? (this.close(), this.search.width(10)) : this.countSelectableResults() > 0 ? (this.search.width(10), this.resizeSearch(), this.getMaximumSelectionSize() > 0 && this.val().length >= this.getMaximumSelectionSize() ? this.updateResults(!0) : this.nextSearchTerm != e && (this.search.val(this.nextSearchTerm), this.updateResults(), this.search.select()), this.positionDropdown()) : (this.close(), this.search.width(10)), this.triggerChange({
      added: t
     }), n && n.noFocus || this.focusSearch())
    },
    cancel: function() {
     this.close(), this.focusSearch()
    },
    addSelectedChoice: function(n) {
     var i, r, s = !n.locked,
      o = t("<li class='select2-search-choice'>    <div></div>    <a href='#' class='select2-search-choice-close' tabindex='-1'></a></li>"),
      a = t("<li class='select2-search-choice select2-locked'><div></div></li>"),
      l = s ? o : a,
      c = this.id(n),
      h = this.getVal();
     (i = this.opts.formatSelection(n, l.find("div"), this.opts.escapeMarkup)) != e && l.find("div").replaceWith(t("<div></div>").html(i)), (r = this.opts.formatSelectionCssClass(n, l.find("div"))) != e && l.addClass(r), s && l.find(".select2-search-choice-close").on("mousedown", u).on("click dblclick", this.bind(function(e) {
      this.isInterfaceEnabled() && (this.unselect(t(e.target)), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus"), u(e), this.close(), this.focusSearch())
     })).on("focus", this.bind(function() {
      this.isInterfaceEnabled() && (this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"))
     })), l.data("select2-data", n), l.insertBefore(this.searchContainer), h.push(c), this.setVal(h)
    },
    unselect: function(e) {
     var n, i, s = this.getVal();
     if (0 === (e = e.closest(".select2-search-choice")).length) throw "Invalid argument: " + e + ". Must be .select2-search-choice";
     if (n = e.data("select2-data")) {
      var o = t.Event("select2-removing");
      if (o.val = this.id(n), o.choice = n, this.opts.element.trigger(o), o.isDefaultPrevented()) return !1;
      for (;
       (i = r(this.id(n), s)) >= 0;) s.splice(i, 1), this.setVal(s), this.select && this.postprocessResults();
      return e.remove(), this.opts.element.trigger({
       type: "select2-removed",
       val: this.id(n),
       choice: n
      }), this.triggerChange({
       removed: n
      }), !0
     }
    },
    postprocessResults: function(t, e, n) {
     var i = this.getVal(),
      s = this.results.find(".select2-result"),
      o = this.results.find(".select2-result-with-children"),
      a = this;
     s.each2(function(t, e) {
      r(a.id(e.data("select2-data")), i) >= 0 && (e.addClass("select2-selected"), e.find(".select2-result-selectable").addClass("select2-selected"))
     }), o.each2(function(t, e) {
      e.is(".select2-result-selectable") || 0 !== e.find(".select2-result-selectable:not(.select2-selected)").length || e.addClass("select2-selected")
     }), -1 == this.highlight() && !1 !== n && !0 === this.opts.closeOnSelect && a.highlight(0), !this.opts.createSearchChoice && !s.filter(".select2-result:not(.select2-selected)").length > 0 && (!t || t && !t.more && 0 === this.results.find(".select2-no-results").length) && v(a.opts.formatNoMatches, "formatNoMatches") && this.results.append("<li class='select2-no-results'>" + y(a.opts.formatNoMatches, a.opts.element, a.search.val()) + "</li>")
    },
    getMaxSearchWidth: function() {
     return this.selection.width() - a(this.search)
    },
    resizeSearch: function() {
     var e, n, i, r, s = a(this.search);
     e = function(e) {
      if (!E) {
       var n = e[0].currentStyle || window.getComputedStyle(e[0], null);
       (E = t(document.createElement("div")).css({
        position: "absolute",
        left: "-10000px",
        top: "-10000px",
        display: "none",
        fontSize: n.fontSize,
        fontFamily: n.fontFamily,
        fontStyle: n.fontStyle,
        fontWeight: n.fontWeight,
        letterSpacing: n.letterSpacing,
        textTransform: n.textTransform,
        whiteSpace: "nowrap"
       })).attr("class", "select2-sizer"), t(document.body).append(E)
      }
      return E.text(e.val()), E.width()
     }(this.search) + 10, n = this.search.offset().left, (r = (i = this.selection.width()) - (n - this.selection.offset().left) - s) < e && (r = i - s), r < 40 && (r = i - s), r <= 0 && (r = e), this.search.width(Math.floor(r))
    },
    getVal: function() {
     var t;
     return this.select ? null === (t = this.select.val()) ? [] : t : (t = this.opts.element.val(), o(t, this.opts.separator, this.opts.transformVal))
    },
    setVal: function(e) {
     var n;
     this.select ? this.select.val(e) : (n = [], t(e).each(function() {
      r(this, n) < 0 && n.push(this)
     }), this.opts.element.val(0 === n.length ? "" : n.join(this.opts.separator)))
    },
    buildChangeDetails: function(t, e) {
     e = e.slice(0), t = t.slice(0);
     for (var n = 0; n < e.length; n++)
      for (var i = 0; i < t.length; i++) s(this.opts.id(e[n]), this.opts.id(t[i])) && (e.splice(n, 1), n > 0 && n--, t.splice(i, 1), i--);
     return {
      added: e,
      removed: t
     }
    },
    val: function(n, i) {
     var r, s = this;
     if (0 === arguments.length) return this.getVal();
     if ((r = this.data()).length || (r = []), !n && 0 !== n) return this.opts.element.val(""), this.updateSelection([]), this.clearSearch(), void(i && this.triggerChange({
      added: this.data(),
      removed: r
     }));
     if (this.setVal(n), this.select) this.opts.initSelection(this.select, this.bind(this.updateSelection)), i && this.triggerChange(this.buildChangeDetails(r, this.data()));
     else {
      if (this.opts.initSelection === e) throw new Error("val() cannot be called if initSelection() is not defined");
      this.opts.initSelection(this.opts.element, function(e) {
       var n = t.map(e, s.id);
       s.setVal(n), s.updateSelection(e), s.clearSearch(), i && s.triggerChange(s.buildChangeDetails(r, s.data()))
      })
     }
     this.clearSearch()
    },
    onSortStart: function() {
     if (this.select) throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");
     this.search.width(0), this.searchContainer.hide()
    },
    onSortEnd: function() {
     var e = [],
      n = this;
     this.searchContainer.show(), this.searchContainer.appendTo(this.searchContainer.parent()), this.resizeSearch(), this.selection.find(".select2-search-choice").each(function() {
      e.push(n.opts.id(t(this).data("select2-data")))
     }), this.setVal(e), this.triggerChange()
    },
    data: function(e, n) {
     var i, r, s = this;
     if (0 === arguments.length) return this.selection.children(".select2-search-choice").map(function() {
      return t(this).data("select2-data")
     }).get();
     r = this.data(), e || (e = []), i = t.map(e, function(t) {
      return s.opts.id(t)
     }), this.setVal(i), this.updateSelection(e), this.clearSearch(), n && this.triggerChange(this.buildChangeDetails(r, this.data()))
    }
   }), t.fn.select2 = function() {
    var n, i, s, o, a, l = Array.prototype.slice.call(arguments, 0),
     c = ["val", "destroy", "opened", "open", "close", "focus", "isFocused", "container", "dropdown", "onSortStart", "onSortEnd", "enable", "disable", "readonly", "positionDropdown", "data", "search"],
     u = ["opened", "isFocused", "container", "dropdown"],
     h = ["val", "data"],
     p = {
      search: "externalSearch"
     };
    return this.each(function() {
     if (0 === l.length || "object" == typeof l[0])(n = 0 === l.length ? {} : t.extend({}, l[0])).element = t(this), "select" === n.element.get(0).tagName.toLowerCase() ? a = n.element.prop("multiple") : (a = n.multiple || !1, "tags" in n && (n.multiple = a = !0)), (i = a ? new window.Select2.class.multi : new window.Select2.class.single).init(n);
     else {
      if ("string" != typeof l[0]) throw "Invalid arguments to select2 plugin: " + l;
      if (r(l[0], c) < 0) throw "Unknown method: " + l[0];
      if (o = e, (i = t(this).data("select2")) === e) return;
      if ("container" === (s = l[0]) ? o = i.container : "dropdown" === s ? o = i.dropdown : (p[s] && (s = p[s]), o = i[s].apply(i, l.slice(1))), r(l[0], u) >= 0 || r(l[0], h) >= 0 && 1 == l.length) return !1
     }
    }), o === e ? this : o
   }, t.fn.select2.defaults = {
    width: "copy",
    loadMorePadding: 0,
    closeOnSelect: !0,
    doNotFocusInput: !1,
    openOnEnter: !0,
    containerCss: {},
    dropdownCss: {},
    containerCssClass: "",
    dropdownCssClass: "",
    formatResult: function(t, e, n, i) {
     var r = [];
     return p(this.text(t), n.term, r, i), r.join("")
    },
    transformVal: function(e) {
     return t.trim(e)
    },
    formatSelection: function(t, n, i) {
     return t ? i(this.text(t)) : e
    },
    sortResults: function(t, e, n) {
     return t
    },
    formatResultCssClass: function(t) {
     return t.css
    },
    formatSelectionCssClass: function(t, n) {
     return e
    },
    minimumResultsForSearch: 0,
    minimumInputLength: 0,
    maximumInputLength: null,
    maximumSelectionSize: 0,
    id: function(t) {
     return t == e ? null : t.id
    },
    text: function(e) {
     return e && this.data && this.data.text ? t.isFunction(this.data.text) ? this.data.text(e) : e[this.data.text] : e.text
    },
    matcher: function(t, e) {
     return i("" + e).toUpperCase().indexOf(i("" + t).toUpperCase()) >= 0
    },
    separator: ",",
    tokenSeparators: [],
    tokenizer: function(t, n, i, r) {
     var o, a, l, c, u, h = t,
      p = !1;
     if (!r.createSearchChoice || !r.tokenSeparators || r.tokenSeparators.length < 1) return e;
     for (;;) {
      for (a = -1, l = 0, c = r.tokenSeparators.length; l < c && (u = r.tokenSeparators[l], !((a = t.indexOf(u)) >= 0)); l++);
      if (a < 0) break;
      if (o = t.substring(0, a), t = t.substring(a + u.length), o.length > 0 && (o = r.createSearchChoice.call(this, o, n)) !== e && null !== o && r.id(o) !== e && null !== r.id(o)) {
       for (p = !1, l = 0, c = n.length; l < c; l++)
        if (s(r.id(o), r.id(n[l]))) {
         p = !0;
         break
        }
       p || i(o)
      }
     }
     return h !== t ? t : void 0
    },
    escapeMarkup: d,
    blurOnChange: !1,
    selectOnBlur: !1,
    adaptContainerCssClass: function(t) {
     return t
    },
    adaptDropdownCssClass: function(t) {
     return null
    },
    nextSearchTerm: function(t, n) {
     return e
    },
    searchInputPlaceholder: "",
    createSearchChoicePosition: "top",
    shouldFocusInput: function(t) {
     if (t.opts.doNotFocusInput) return !1;
     return !("ontouchstart" in window || navigator.msMaxTouchPoints > 0) || !(t.opts.minimumResultsForSearch < 0)
    }
   }, t.fn.select2.locales = [], t.fn.select2.locales.en = {
    formatMatches: function(t) {
     return 1 === t ? "One result is available, press enter to select it." : t + " results are available, use up and down arrow keys to navigate."
    },
    formatNoMatches: function() {
     return "No matches found"
    },
    formatAjaxError: function(t, e, n) {
     return "Loading failed"
    },
    formatInputTooShort: function(t, e) {
     var n = e - t.length;
     return "Please enter " + n + " or more character" + (1 == n ? "" : "s")
    },
    formatInputTooLong: function(t, e) {
     var n = t.length - e;
     return "Please delete " + n + " character" + (1 == n ? "" : "s")
    },
    formatSelectionTooBig: function(t) {
     return "You can only select " + t + " item" + (1 == t ? "" : "s")
    },
    formatLoadMore: function(t) {
     return "Loading more results…"
    },
    formatSearching: function() {
     return "Searching…"
    }
   }, t.extend(t.fn.select2.defaults, t.fn.select2.locales.en), t.fn.select2.ajaxDefaults = {
    transport: t.ajax,
    params: {
     type: "GET",
     cache: !1,
     dataType: "json"
    }
   }, window.Select2 = {
    query: {
     ajax: f,
     local: m,
     tags: g
    },
    util: {
     debounce: c,
     markMatch: p,
     escapeMarkup: d,
     stripDiacritics: i
    },
    class: {
     abstract: k, single: S, multi: _
    }
   }
  }
 }(jQuery), $.fn.select2FullScreen = function() {
  var t = $(this);
  if (t.siblings(".select2-container").find(".select2-search-field input").attr("autocomplete", "new-password"), t.on("change", function(e) {
    void 0 !== e.added && t.select2("val", e.added.id), setTimeout(function() {
     t.siblings(".select2-container").find(":focus").blur()
    }, 10)
   }), $("body, html").on("touchmove", ".select2-drop", function(t) {
    $("body").hasClass("touchmove-locked") && t.preventDefault()
   }), $("body, html").on("touchmove", ".tt-dropdown-menu", function(t) {
    t.stopPropagation()
   }), $("body, html").on("touchmove", ".select2-results", function(t) {
    $("body").hasClass("touchmove-locked") && t.stopPropagation()
   }), $("body").width() < 768) {
   var e = $(this).closest(".form-group").offset().top - 7,
    n = $("#search-widget-wrapper").offset().top;
   t.on("select2-opening", function() {
    $("body").addClass("touchmove-locked "), $("body,html").animate({
     scrollTop: e
    }, 300), setTimeout(function() {
     $(".close-search-dropdown").fadeIn("fast")
    }, 300), $("html,body").css({
     overflow: "hidden"
    })
   }), t.on("select2-close", function() {
    $("html,body").css({
     overflow: "auto"
    }), $("body").removeClass("touchmove-locked"), $("body,html").animate({
     scrollTop: n
    }, 300), $(".close-search-dropdown").hide(), $(".select2-drop__close").length > 0 && $(".select2-drop__close").remove()
   }), t.on("select2-open", function(e) {
    var n = t.select2("data").id,
     i = $(".select2-result"),
     r = $(".select2-drop");
    i.each(function() {
     var t = $(this);
     t.data("select2Data").id === n ? t.addClass("selected") : t.removeClass("selected")
    }), r.append('<i class="fa fa-long-arrow-left select2-drop__close"></i>'), $(".select2-drop__close").click(function() {
     t.select2("close")
    })
   }), $(".select2-search").click(function() {
    $(this).find(".select2-input").focus()
   });
   var i = $(window).outerHeight(),
    r = i - 60;
   $(".select2-drop-multi").css({
    height: i,
    marginTop: -52
   }), $(".select2-drop-multi .select2-results").css({
    maxHeight: r
   })
  }
 },
 function(t) {
  "use strict";
  var e = t.jCarousel = {};
  e.version = "0.3.4";
  var n = /^([+\-]=)?(.+)$/;
  e.parseTarget = function(t) {
   var e = !1,
    i = "object" != typeof t ? n.exec(t) : null;
   return i ? (t = parseInt(i[2], 10) || 0, i[1] && (e = !0, "-=" === i[1] && (t *= -1))) : "object" != typeof t && (t = parseInt(t, 10) || 0), {
    target: t,
    relative: e
   }
  }, e.detectCarousel = function(t) {
   for (var e; t.length > 0;) {
    if ((e = t.filter("[data-jcarousel]")).length > 0) return e;
    if ((e = t.find("[data-jcarousel]")).length > 0) return e;
    t = t.parent()
   }
   return null
  }, e.base = function(n) {
   return {
    version: e.version,
    _options: {},
    _element: null,
    _carousel: null,
    _init: t.noop,
    _create: t.noop,
    _destroy: t.noop,
    _reload: t.noop,
    create: function() {
     return this._element.attr("data-" + n.toLowerCase(), !0).data(n, this), !1 === this._trigger("create") ? this : (this._create(), this._trigger("createend"), this)
    },
    destroy: function() {
     return !1 === this._trigger("destroy") ? this : (this._destroy(), this._trigger("destroyend"), this._element.removeData(n).removeAttr("data-" + n.toLowerCase()), this)
    },
    reload: function(t) {
     return !1 === this._trigger("reload") ? this : (t && this.options(t), this._reload(), this._trigger("reloadend"), this)
    },
    element: function() {
     return this._element
    },
    options: function(e, n) {
     if (0 === arguments.length) return t.extend({}, this._options);
     if ("string" == typeof e) {
      if (void 0 === n) return void 0 === this._options[e] ? null : this._options[e];
      this._options[e] = n
     } else this._options = t.extend({}, this._options, e);
     return this
    },
    carousel: function() {
     return this._carousel || (this._carousel = e.detectCarousel(this.options("carousel") || this._element), this._carousel || t.error('Could not detect carousel for plugin "' + n + '"')), this._carousel
    },
    _trigger: function(e, i, r) {
     var s, o = !1;
     return r = [this].concat(r || []), (i || this._element).each(function() {
      s = t.Event((n + ":" + e).toLowerCase()), t(this).trigger(s, r), s.isDefaultPrevented() && (o = !0)
     }), !o
    }
   }
  }, e.plugin = function(n, i) {
   var r = t[n] = function(e, n) {
    this._element = t(e), this.options(n), this._init(), this.create()
   };
   return r.fn = r.prototype = t.extend({}, e.base(n), i), t.fn[n] = function(e) {
    var i = Array.prototype.slice.call(arguments, 1),
     s = this;
    return "string" == typeof e ? this.each(function() {
     var r = t(this).data(n);
     if (!r) return t.error("Cannot call methods on " + n + ' prior to initialization; attempted to call method "' + e + '"');
     if (!t.isFunction(r[e]) || "_" === e.charAt(0)) return t.error('No such method "' + e + '" for ' + n + " instance");
     var o = r[e].apply(r, i);
     return o !== r && void 0 !== o ? (s = o, !1) : void 0
    }) : this.each(function() {
     var i = t(this).data(n);
     i instanceof r ? i.reload(e) : new r(this, e)
    }), s
   }, r
  }
 }(jQuery),
 function(t, e) {
  "use strict";
  var n = function(t) {
   return parseFloat(t) || 0
  };
  t.jCarousel.plugin("jcarousel", {
   animating: !1,
   tail: 0,
   inTail: !1,
   resizeTimer: null,
   lt: null,
   vertical: !1,
   rtl: !1,
   circular: !1,
   underflow: !1,
   relative: !1,
   _options: {
    list: function() {
     return this.element().children().eq(0)
    },
    items: function() {
     return this.list().children()
    },
    animation: 400,
    transitions: !1,
    wrap: null,
    vertical: null,
    rtl: null,
    center: !1
   },
   _list: null,
   _items: null,
   _target: t(),
   _first: t(),
   _last: t(),
   _visible: t(),
   _fullyvisible: t(),
   _init: function() {
    var t = this;
    return this.onWindowResize = function() {
     t.resizeTimer && clearTimeout(t.resizeTimer), t.resizeTimer = setTimeout(function() {
      t.reload()
     }, 100)
    }, this
   },
   _create: function() {
    this._reload(), t(e).on("resize.jcarousel", this.onWindowResize)
   },
   _destroy: function() {
    t(e).off("resize.jcarousel", this.onWindowResize)
   },
   _reload: function() {
    this.vertical = this.options("vertical"), null == this.vertical && (this.vertical = this.list().height() > this.list().width()), this.rtl = this.options("rtl"), null == this.rtl && (this.rtl = function(e) {
     if ("rtl" === ("" + e.attr("dir")).toLowerCase()) return !0;
     var n = !1;
     return e.parents("[dir]").each(function() {
      if (/rtl/i.test(t(this).attr("dir"))) return n = !0, !1
     }), n
    }(this._element)), this.lt = this.vertical ? "top" : "left", this.relative = "relative" === this.list().css("position"), this._list = null, this._items = null;
    var e = this.index(this._target) >= 0 ? this._target : this.closest();
    this.circular = "circular" === this.options("wrap"), this.underflow = !1;
    var n = {
     left: 0,
     top: 0
    };
    return e.length > 0 && (this._prepare(e), this.list().find("[data-jcarousel-clone]").remove(), this._items = null, this.underflow = this._fullyvisible.length >= this.items().length, this.circular = this.circular && !this.underflow, n[this.lt] = this._position(e) + "px"), this.move(n), this
   },
   list: function() {
    if (null === this._list) {
     var e = this.options("list");
     this._list = t.isFunction(e) ? e.call(this) : this._element.find(e)
    }
    return this._list
   },
   items: function() {
    if (null === this._items) {
     var e = this.options("items");
     this._items = (t.isFunction(e) ? e.call(this) : this.list().find(e)).not("[data-jcarousel-clone]")
    }
    return this._items
   },
   index: function(t) {
    return this.items().index(t)
   },
   closest: function() {
    var e, i = this,
     r = this.list().position()[this.lt],
     s = t(),
     o = !1,
     a = this.vertical ? "bottom" : this.rtl && !this.relative ? "left" : "right";
    return this.rtl && this.relative && !this.vertical && (r += this.list().width() - this.clipping()), this.items().each(function() {
     if (s = t(this), o) return !1;
     var l = i.dimension(s);
     if ((r += l) >= 0) {
      if (e = l - n(s.css("margin-" + a)), !(Math.abs(r) - l + e / 2 <= 0)) return !1;
      o = !0
     }
    }), s
   },
   target: function() {
    return this._target
   },
   first: function() {
    return this._first
   },
   last: function() {
    return this._last
   },
   visible: function() {
    return this._visible
   },
   fullyvisible: function() {
    return this._fullyvisible
   },
   hasNext: function() {
    if (!1 === this._trigger("hasnext")) return !0;
    var t = this.options("wrap"),
     e = this.items().length - 1,
     n = this.options("center") ? this._target : this._last;
    return !!(e >= 0 && !this.underflow && (t && "first" !== t || this.index(n) < e || this.tail && !this.inTail))
   },
   hasPrev: function() {
    if (!1 === this._trigger("hasprev")) return !0;
    var t = this.options("wrap");
    return !!(this.items().length > 0 && !this.underflow && (t && "last" !== t || this.index(this._first) > 0 || this.tail && this.inTail))
   },
   clipping: function() {
    return this._element["inner" + (this.vertical ? "Height" : "Width")]()
   },
   dimension: function(t) {
    return t["outer" + (this.vertical ? "Height" : "Width")](!0)
   },
   scroll: function(e, n, i) {
    if (this.animating) return this;
    if (!1 === this._trigger("scroll", null, [e, n])) return this;
    t.isFunction(n) && (i = n, n = !0);
    var r = t.jCarousel.parseTarget(e);
    if (r.relative) {
     var s, o, a, l, c, u, h, p, d = this.items().length - 1,
      f = Math.abs(r.target),
      m = this.options("wrap");
     if (r.target > 0) {
      var g = this.index(this._last);
      if (g >= d && this.tail) this.inTail ? "both" === m || "last" === m ? this._scroll(0, n, i) : t.isFunction(i) && i.call(this, !1) : this._scrollTail(n, i);
      else if (s = this.index(this._target), this.underflow && s === d && ("circular" === m || "both" === m || "last" === m) || !this.underflow && g === d && ("both" === m || "last" === m)) this._scroll(0, n, i);
      else if (a = s + f, this.circular && a > d) {
       for (p = d, c = this.items().get(-1); p++ < a;) c = this.items().eq(0), (u = this._visible.index(c) >= 0) && c.after(c.clone(!0).attr("data-jcarousel-clone", !0)), this.list().append(c), u || ((h = {})[this.lt] = this.dimension(c), this.moveBy(h)), this._items = null;
       this._scroll(c, n, i)
      } else this._scroll(Math.min(a, d), n, i)
     } else if (this.inTail) this._scroll(Math.max(this.index(this._first) - f + 1, 0), n, i);
     else if (o = this.index(this._first), s = this.index(this._target), l = this.underflow ? s : o, a = l - f, l <= 0 && (this.underflow && "circular" === m || "both" === m || "first" === m)) this._scroll(d, n, i);
     else if (this.circular && a < 0) {
      for (p = a, c = this.items().get(0); p++ < 0;) {
       c = this.items().eq(-1), (u = this._visible.index(c) >= 0) && c.after(c.clone(!0).attr("data-jcarousel-clone", !0)), this.list().prepend(c), this._items = null;
       var v = this.dimension(c);
       (h = {})[this.lt] = -v, this.moveBy(h)
      }
      this._scroll(c, n, i)
     } else this._scroll(Math.max(a, 0), n, i)
    } else this._scroll(r.target, n, i);
    return this._trigger("scrollend"), this
   },
   moveBy: function(t, e) {
    var i = this.list().position(),
     r = 1,
     s = 0;
    return this.rtl && !this.vertical && (r = -1, this.relative && (s = this.list().width() - this.clipping())), t.left && (t.left = i.left + s + n(t.left) * r + "px"), t.top && (t.top = i.top + s + n(t.top) * r + "px"), this.move(t, e)
   },
   move: function(e, n) {
    n = n || {};
    var i = this.options("transitions"),
     r = !!i,
     s = !!i.transforms,
     o = !!i.transforms3d,
     a = n.duration || 0,
     l = this.list();
    if (!r && a > 0) l.animate(e, n);
    else {
     var c = n.complete || t.noop,
      u = {};
     if (r) {
      var h = {
        transitionDuration: l.css("transitionDuration"),
        transitionTimingFunction: l.css("transitionTimingFunction"),
        transitionProperty: l.css("transitionProperty")
       },
       p = c;
      c = function() {
       t(this).css(h), p.call(this)
      }, u = {
       transitionDuration: (a > 0 ? a / 1e3 : 0) + "s",
       transitionTimingFunction: i.easing || n.easing,
       transitionProperty: a > 0 ? s || o ? "all" : e.left ? "left" : "top" : "none",
       transform: "none"
      }
     }
     o ? u.transform = "translate3d(" + (e.left || 0) + "," + (e.top || 0) + ",0)" : s ? u.transform = "translate(" + (e.left || 0) + "," + (e.top || 0) + ")" : t.extend(u, e), r && a > 0 && l.one("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", c), l.css(u), a <= 0 && l.each(function() {
      c.call(this)
     })
    }
   },
   _scroll: function(e, n, i) {
    if (this.animating) return t.isFunction(i) && i.call(this, !1), this;
    if ("object" != typeof e ? e = this.items().eq(e) : void 0 === e.jquery && (e = t(e)), 0 === e.length) return t.isFunction(i) && i.call(this, !1), this;
    this.inTail = !1, this._prepare(e);
    var r = this._position(e);
    if (r === this.list().position()[this.lt]) return t.isFunction(i) && i.call(this, !1), this;
    var s = {};
    return s[this.lt] = r + "px", this._animate(s, n, i), this
   },
   _scrollTail: function(e, n) {
    if (this.animating || !this.tail) return t.isFunction(n) && n.call(this, !1), this;
    var i = this.list().position()[this.lt];
    this.rtl && this.relative && !this.vertical && (i += this.list().width() - this.clipping()), this.rtl && !this.vertical ? i += this.tail : i -= this.tail, this.inTail = !0;
    var r = {};
    return r[this.lt] = i + "px", this._update({
     target: this._target.next(),
     fullyvisible: this._fullyvisible.slice(1).add(this._visible.last())
    }), this._animate(r, e, n), this
   },
   _animate: function(e, n, i) {
    if (i = i || t.noop, !1 === this._trigger("animate")) return i.call(this, !1), this;
    this.animating = !0;
    var r = this.options("animation"),
     s = t.proxy(function() {
      this.animating = !1;
      var t = this.list().find("[data-jcarousel-clone]");
      t.length > 0 && (t.remove(), this._reload()), this._trigger("animateend"), i.call(this, !0)
     }, this),
     o = "object" == typeof r ? t.extend({}, r) : {
      duration: r
     },
     a = o.complete || t.noop;
    return !1 === n ? o.duration = 0 : void 0 !== t.fx.speeds[o.duration] && (o.duration = t.fx.speeds[o.duration]), o.complete = function() {
     s(), a.call(this)
    }, this.move(e, o), this
   },
   _prepare: function(e) {
    var i, r, s, o, a = this.index(e),
     l = a,
     c = this.dimension(e),
     u = this.clipping(),
     h = this.vertical ? "bottom" : this.rtl ? "left" : "right",
     p = this.options("center"),
     d = {
      target: e,
      first: e,
      last: e,
      visible: e,
      fullyvisible: c <= u ? e : t()
     };
    if (p && (c /= 2, u /= 2), c < u)
     for (;;) {
      if (0 === (i = this.items().eq(++l)).length) {
       if (!this.circular) break;
       if (i = this.items().eq(0), e.get(0) === i.get(0)) break;
       if ((r = this._visible.index(i) >= 0) && i.after(i.clone(!0).attr("data-jcarousel-clone", !0)), this.list().append(i), !r) {
        var f = {};
        f[this.lt] = this.dimension(i), this.moveBy(f)
       }
       this._items = null
      }
      if (0 === (o = this.dimension(i))) break;
      if (c += o, d.last = i, d.visible = d.visible.add(i), s = n(i.css("margin-" + h)), c - s <= u && (d.fullyvisible = d.fullyvisible.add(i)), c >= u) break
     }
    if (!this.circular && !p && c < u)
     for (l = a; !(--l < 0 || 0 === (i = this.items().eq(l)).length || 0 === (o = this.dimension(i)) || (c += o, d.first = i, d.visible = d.visible.add(i), s = n(i.css("margin-" + h)), c - s <= u && (d.fullyvisible = d.fullyvisible.add(i)), c >= u)););
    return this._update(d), this.tail = 0, p || "circular" === this.options("wrap") || "custom" === this.options("wrap") || this.index(d.last) !== this.items().length - 1 || (c -= n(d.last.css("margin-" + h))) > u && (this.tail = c - u), this
   },
   _position: function(t) {
    var e = this._first,
     n = e.position()[this.lt],
     i = this.options("center"),
     r = i ? this.clipping() / 2 - this.dimension(e) / 2 : 0;
    return this.rtl && !this.vertical ? (this.relative ? n -= this.list().width() - this.dimension(e) : n -= this.clipping() - this.dimension(e), n += r) : n -= r, !i && (this.index(t) > this.index(e) || this.inTail) && this.tail ? (n = this.rtl && !this.vertical ? n - this.tail : n + this.tail, this.inTail = !0) : this.inTail = !1, -n
   },
   _update: function(e) {
    var n, i = this,
     r = {
      target: this._target,
      first: this._first,
      last: this._last,
      visible: this._visible,
      fullyvisible: this._fullyvisible
     },
     s = this.index(e.first || r.first) < this.index(r.first),
     o = function(n) {
      var o = [],
       a = [];
      e[n].each(function() {
       r[n].index(this) < 0 && o.push(this)
      }), r[n].each(function() {
       e[n].index(this) < 0 && a.push(this)
      }), s ? o = o.reverse() : a = a.reverse(), i._trigger(n + "in", t(o)), i._trigger(n + "out", t(a)), i["_" + n] = e[n]
     };
    for (n in e) o(n);
    return this
   }
  })
 }(jQuery, window),
 function(t) {
  "use strict";
  t.jcarousel.fn.scrollIntoView = function(e, n, i) {
   var r, s = t.jCarousel.parseTarget(e),
    o = this.index(this._fullyvisible.first()),
    a = this.index(this._fullyvisible.last());
   if ((r = s.relative ? s.target < 0 ? Math.max(0, o + s.target) : a + s.target : "object" != typeof s.target ? s.target : this.index(s.target)) < o) return this.scroll(r, n, i);
   if (r >= o && r <= a) return t.isFunction(i) && i.call(this, !1), this;
   for (var l, c = this.items(), u = this.clipping(), h = this.vertical ? "bottom" : this.rtl ? "left" : "right", p = 0; 0 !== (l = c.eq(r)).length;) {
    if ((p += this.dimension(l)) >= u) {
     p - (parseFloat(l.css("margin-" + h)) || 0) !== u && r++;
     break
    }
    if (r <= 0) break;
    r--
   }
   return this.scroll(r, n, i)
  }
 }(jQuery),
 function(t) {
  "use strict";
  t.jCarousel.plugin("jcarouselControl", {
   _options: {
    target: "+=1",
    event: "click",
    method: "scroll"
   },
   _active: null,
   _init: function() {
    this.onDestroy = t.proxy(function() {
     this._destroy(), this.carousel().one("jcarousel:createend", t.proxy(this._create, this))
    }, this), this.onReload = t.proxy(this._reload, this), this.onEvent = t.proxy(function(e) {
     e.preventDefault();
     var n = this.options("method");
     t.isFunction(n) ? n.call(this) : this.carousel().jcarousel(this.options("method"), this.options("target"))
    }, this)
   },
   _create: function() {
    this.carousel().one("jcarousel:destroy", this.onDestroy).on("jcarousel:reloadend jcarousel:scrollend", this.onReload), this._element.on(this.options("event") + ".jcarouselcontrol", this.onEvent), this._reload()
   },
   _destroy: function() {
    this._element.off(".jcarouselcontrol", this.onEvent), this.carousel().off("jcarousel:destroy", this.onDestroy).off("jcarousel:reloadend jcarousel:scrollend", this.onReload)
   },
   _reload: function() {
    var e, n = t.jCarousel.parseTarget(this.options("target")),
     i = this.carousel();
    if (n.relative) e = i.jcarousel(n.target > 0 ? "hasNext" : "hasPrev");
    else {
     var r = "object" != typeof n.target ? i.jcarousel("items").eq(n.target) : n.target;
     e = i.jcarousel("target").index(r) >= 0
    }
    return this._active !== e && (this._trigger(e ? "active" : "inactive"), this._active = e), this
   }
  })
 }(jQuery),
 function(t) {
  "use strict";
  t.jCarousel.plugin("jcarouselPagination", {
   _options: {
    perPage: null,
    item: function(t) {
     return '<a href="#' + t + '">' + t + "</a>"
    },
    event: "click",
    method: "scroll"
   },
   _carouselItems: null,
   _pages: {},
   _items: {},
   _currentPage: null,
   _init: function() {
    this.onDestroy = t.proxy(function() {
     this._destroy(), this.carousel().one("jcarousel:createend", t.proxy(this._create, this))
    }, this), this.onReload = t.proxy(this._reload, this), this.onScroll = t.proxy(this._update, this)
   },
   _create: function() {
    this.carousel().one("jcarousel:destroy", this.onDestroy).on("jcarousel:reloadend", this.onReload).on("jcarousel:scrollend", this.onScroll), this._reload()
   },
   _destroy: function() {
    this._clear(), this.carousel().off("jcarousel:destroy", this.onDestroy).off("jcarousel:reloadend", this.onReload).off("jcarousel:scrollend", this.onScroll), this._carouselItems = null
   },
   _reload: function() {
    var e = this.options("perPage");
    if (this._pages = {}, this._items = {}, t.isFunction(e) && (e = e.call(this)), null == e) this._pages = this._calculatePages();
    else
     for (var n, i = parseInt(e, 10) || 0, r = this._getCarouselItems(), s = 1, o = 0; 0 !== (n = r.eq(o++)).length;) this._pages[s] ? this._pages[s] = this._pages[s].add(n) : this._pages[s] = n, o % i == 0 && s++;
    this._clear();
    var a = this,
     l = this.carousel().data("jcarousel"),
     c = this._element,
     u = this.options("item"),
     h = this._getCarouselItems().length;
    t.each(this._pages, function(e, n) {
     var i = a._items[e] = t(u.call(a, e, n));
     i.on(a.options("event") + ".jcarouselpagination", t.proxy(function() {
      var t = n.eq(0);
      if (l.circular) {
       var i = l.index(l.target()),
        r = l.index(t);
       parseFloat(e) > parseFloat(a._currentPage) ? r < i && (t = "+=" + (h - i + r)) : r > i && (t = "-=" + (i + (h - r)))
      }
      l[this.options("method")](t)
     }, a)), c.append(i)
    }), this._update()
   },
   _update: function() {
    var e, n = this.carousel().jcarousel("target");
    t.each(this._pages, function(t, i) {
     if (i.each(function() {
       if (n.is(this)) return e = t, !1
      }), e) return !1
    }), this._currentPage !== e && (this._trigger("inactive", this._items[this._currentPage]), this._trigger("active", this._items[e])), this._currentPage = e
   },
   items: function() {
    return this._items
   },
   reloadCarouselItems: function() {
    return this._carouselItems = null, this
   },
   _clear: function() {
    this._element.empty(), this._currentPage = null
   },
   _calculatePages: function() {
    for (var t, e, n = this.carousel().data("jcarousel"), i = this._getCarouselItems(), r = n.clipping(), s = 0, o = 0, a = 1, l = {}; 0 !== (t = i.eq(o++)).length;) s + (e = n.dimension(t)) > r && (a++, s = 0), s += e, l[a] ? l[a] = l[a].add(t) : l[a] = t;
    return l
   },
   _getCarouselItems: function() {
    return this._carouselItems || (this._carouselItems = this.carousel().jcarousel("items")), this._carouselItems
   }
  })
 }(jQuery),
 function(t, e) {
  "use strict";
  var n, i;
  t.each({
   hidden: "visibilitychange",
   mozHidden: "mozvisibilitychange",
   msHidden: "msvisibilitychange",
   webkitHidden: "webkitvisibilitychange"
  }, function(t, r) {
   if (void 0 !== e[t]) return n = t, i = r, !1
  }), t.jCarousel.plugin("jcarouselAutoscroll", {
   _options: {
    target: "+=1",
    interval: 3e3,
    autostart: !0
   },
   _timer: null,
   _started: !1,
   _init: function() {
    this.onDestroy = t.proxy(function() {
     this._destroy(), this.carousel().one("jcarousel:createend", t.proxy(this._create, this))
    }, this), this.onAnimateEnd = t.proxy(this._start, this), this.onVisibilityChange = t.proxy(function() {
     e[n] ? this._stop() : this._start()
    }, this)
   },
   _create: function() {
    this.carousel().one("jcarousel:destroy", this.onDestroy), t(e).on(i, this.onVisibilityChange), this.options("autostart") && this.start()
   },
   _destroy: function() {
    this._stop(), this.carousel().off("jcarousel:destroy", this.onDestroy), t(e).off(i, this.onVisibilityChange)
   },
   _start: function() {
    if (this._stop(), this._started) return this.carousel().one("jcarousel:animateend", this.onAnimateEnd), this._timer = setTimeout(t.proxy(function() {
     this.carousel().jcarousel("scroll", this.options("target"))
    }, this), this.options("interval")), this
   },
   _stop: function() {
    return this._timer && (this._timer = clearTimeout(this._timer)), this.carousel().off("jcarousel:animateend", this.onAnimateEnd), this
   },
   start: function() {
    return this._started = !0, this._start(), this
   },
   stop: function() {
    return this._started = !1, this._stop(), this
   }
  })
 }(jQuery, document),
 function(t) {
  var e = function() {
    "use strict";
    return {
     isMsie: function() {
      return !!/(msie|trident)/i.test(navigator.userAgent) && navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2]
     },
     isBlankString: function(t) {
      return !t || /^\s*$/.test(t)
     },
     escapeRegExChars: function(t) {
      return t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
     },
     isString: function(t) {
      return "string" == typeof t
     },
     isNumber: function(t) {
      return "number" == typeof t
     },
     isArray: t.isArray,
     isFunction: t.isFunction,
     isObject: t.isPlainObject,
     isUndefined: function(t) {
      return void 0 === t
     },
     toStr: function(t) {
      return e.isUndefined(t) || null === t ? "" : t + ""
     },
     bind: t.proxy,
     each: function(e, n) {
      t.each(e, function(t, e) {
       return n(e, t)
      })
     },
     map: t.map,
     filter: t.grep,
     every: function(e, n) {
      var i = !0;
      return e ? (t.each(e, function(t, r) {
       if (!(i = n.call(null, r, t, e))) return !1
      }), !!i) : i
     },
     some: function(e, n) {
      var i = !1;
      return e ? (t.each(e, function(t, r) {
       if (i = n.call(null, r, t, e)) return !1
      }), !!i) : i
     },
     mixin: t.extend,
     getUniqueId: function() {
      var t = 0;
      return function() {
       return t++
      }
     }(),
     templatify: function(e) {
      return t.isFunction(e) ? e : function() {
       return String(e)
      }
     },
     defer: function(t) {
      setTimeout(t, 0)
     },
     debounce: function(t, e, n) {
      var i, r;
      return function() {
       var s, o, a = this,
        l = arguments;
       return s = function() {
        i = null, n || (r = t.apply(a, l))
       }, o = n && !i, clearTimeout(i), i = setTimeout(s, e), o && (r = t.apply(a, l)), r
      }
     },
     throttle: function(t, e) {
      var n, i, r, s, o, a;
      return o = 0, a = function() {
        o = new Date, r = null, s = t.apply(n, i)
       },
       function() {
        var l = new Date,
         c = e - (l - o);
        return n = this, i = arguments, c <= 0 ? (clearTimeout(r), r = null, o = l, s = t.apply(n, i)) : r || (r = setTimeout(a, c)), s
       }
     },
     noop: function() {}
    }
   }(),
   n = "0.10.5",
   i = function() {
    "use strict";

    function t(t) {
     return (t = e.toStr(t)) ? t.split(/\s+/) : []
    }

    function n(t) {
     return (t = e.toStr(t)) ? t.split(/\W+/) : []
    }

    function i(t) {
     return function() {
      var n = [].slice.call(arguments, 0);
      return function(i) {
       var r = [];
       return e.each(n, function(n) {
        r = r.concat(t(e.toStr(i[n])))
       }), r
      }
     }
    }
    return {
     nonword: n,
     whitespace: t,
     obj: {
      nonword: i(n),
      whitespace: i(t)
     }
    }
   }(),
   r = function() {
    "use strict";

    function n(n) {
     this.maxSize = e.isNumber(n) ? n : 100, this.reset(), this.maxSize <= 0 && (this.set = this.get = t.noop)
    }

    function i() {
     this.head = this.tail = null
    }
    return e.mixin(n.prototype, {
     set: function(t, e) {
      var n, i = this.list.tail;
      this.size >= this.maxSize && (this.list.remove(i), delete this.hash[i.key]), (n = this.hash[t]) ? (n.val = e, this.list.moveToFront(n)) : (n = new function(t, e) {
       this.key = t, this.val = e, this.prev = this.next = null
      }(t, e), this.list.add(n), this.hash[t] = n, this.size++)
     },
     get: function(t) {
      var e = this.hash[t];
      if (e) return this.list.moveToFront(e), e.val
     },
     reset: function() {
      this.size = 0, this.hash = {}, this.list = new i
     }
    }), e.mixin(i.prototype, {
     add: function(t) {
      this.head && (t.next = this.head, this.head.prev = t), this.head = t, this.tail = this.tail || t
     },
     remove: function(t) {
      t.prev ? t.prev.next = t.next : this.head = t.next, t.next ? t.next.prev = t.prev : this.tail = t.prev
     },
     moveToFront: function(t) {
      this.remove(t), this.add(t)
     }
    }), n
   }(),
   s = function() {
    "use strict";

    function t(t) {
     this.prefix = ["__", t, "__"].join(""), this.ttlKey = "__ttl__", this.keyMatcher = new RegExp("^" + e.escapeRegExChars(this.prefix))
    }

    function n() {
     return (new Date).getTime()
    }

    function i(t) {
     return JSON.stringify(e.isUndefined(t) ? null : t)
    }

    function r(t) {
     return JSON.parse(t)
    }
    var s, o;
    try {
     (s = window.localStorage).setItem("~~~", "!"), s.removeItem("~~~")
    } catch (t) {
     s = null
    }
    return o = s && window.JSON ? {
     _prefix: function(t) {
      return this.prefix + t
     },
     _ttlKey: function(t) {
      return this._prefix(t) + this.ttlKey
     },
     get: function(t) {
      return this.isExpired(t) && this.remove(t), r(s.getItem(this._prefix(t)))
     },
     set: function(t, r, o) {
      return e.isNumber(o) ? s.setItem(this._ttlKey(t), i(n() + o)) : s.removeItem(this._ttlKey(t)), s.setItem(this._prefix(t), i(r))
     },
     remove: function(t) {
      return s.removeItem(this._ttlKey(t)), s.removeItem(this._prefix(t)), this
     },
     clear: function() {
      var t, e, n = [],
       i = s.length;
      for (t = 0; t < i; t++)(e = s.key(t)).match(this.keyMatcher) && n.push(e.replace(this.keyMatcher, ""));
      for (t = n.length; t--;) this.remove(n[t]);
      return this
     },
     isExpired: function(t) {
      var i = r(s.getItem(this._ttlKey(t)));
      return !!(e.isNumber(i) && n() > i)
     }
    } : {
     get: e.noop,
     set: e.noop,
     remove: e.noop,
     clear: e.noop,
     isExpired: e.noop
    }, e.mixin(t.prototype, o), t
   }(),
   o = function() {
    "use strict";

    function n(n) {
     n = n || {}, this.cancelled = !1, this.lastUrl = null, this._send = n.transport ? function(n) {
      return function(i, r) {
       var s = t.Deferred();
       return n(i, r, function(t) {
        e.defer(function() {
         s.resolve(t)
        })
       }, function(t) {
        e.defer(function() {
         s.reject(t)
        })
       }), s
      }
     }(n.transport) : t.ajax, this._get = n.rateLimiter ? n.rateLimiter(this._get) : this._get, this._cache = !1 === n.cache ? new r(0) : a
    }
    var i = 0,
     s = {},
     o = 6,
     a = new r(10);
    return n.setMaxPendingRequests = function(t) {
     o = t
    }, n.resetCache = function() {
     a.reset()
    }, e.mixin(n.prototype, {
     _get: function(t, e, n) {
      function r(e) {
       n && n(null, e), c._cache.set(t, e)
      }

      function a() {
       n && n(!0)
      }
      var l, c = this;
      this.cancelled || t !== this.lastUrl || ((l = s[t]) ? l.done(r).fail(a) : i < o ? (i++, s[t] = this._send(t, e).done(r).fail(a).always(function() {
       i--, delete s[t], c.onDeckRequestArgs && (c._get.apply(c, c.onDeckRequestArgs), c.onDeckRequestArgs = null)
      })) : this.onDeckRequestArgs = [].slice.call(arguments, 0))
     },
     get: function(t, n, i) {
      var r;
      return e.isFunction(n) && (i = n, n = {}), this.cancelled = !1, this.lastUrl = t, (r = this._cache.get(t)) ? e.defer(function() {
       i && i(null, r)
      }) : this._get(t, n, i), !!r
     },
     cancel: function() {
      this.cancelled = !0
     }
    }), n
   }(),
   a = function() {
    "use strict";

    function n(e) {
     (e = e || {}).datumTokenizer && e.queryTokenizer || t.error("datumTokenizer and queryTokenizer are both required"), this.datumTokenizer = e.datumTokenizer, this.queryTokenizer = e.queryTokenizer, this.reset()
    }

    function i(t) {
     return t = e.filter(t, function(t) {
      return !!t
     }), t = e.map(t, function(t) {
      return t.toLowerCase()
     })
    }
    return e.mixin(n.prototype, {
     bootstrap: function(t) {
      this.datums = t.datums, this.trie = t.trie
     },
     add: function(t) {
      var n = this;
      t = e.isArray(t) ? t : [t], e.each(t, function(t) {
       var r, s;
       r = n.datums.push(t) - 1, s = i(n.datumTokenizer(t)), e.each(s, function(t) {
        var e, i, s;
        for (e = n.trie, i = t.split(""); s = i.shift();)(e = e.children[s] || (e.children[s] = {
         ids: [],
         children: {}
        })).ids.push(r)
       })
      })
     },
     get: function(t) {
      var n, r, s = this;
      return n = i(this.queryTokenizer(t)), e.each(n, function(t) {
       var e, n, i, o;
       if (r && 0 === r.length) return !1;
       for (e = s.trie, n = t.split(""); e && (i = n.shift());) e = e.children[i];
       if (!e || 0 !== n.length) return r = [], !1;
       o = e.ids.slice(0), r = r ? function(t, e) {
        function n(t, e) {
         return t - e
        }
        var i = 0,
         r = 0,
         s = [];
        t = t.sort(n), e = e.sort(n);
        for (var o = t.length, a = e.length; i < o && r < a;) t[i] < e[r] ? i++ : t[i] > e[r] ? r++ : (s.push(t[i]), i++, r++);
        return s
       }(r, o) : o
      }), r ? e.map(function(t) {
       for (var e = {}, n = [], i = 0, r = t.length; i < r; i++) e[t[i]] || (e[t[i]] = !0, n.push(t[i]));
       return n
      }(r), function(t) {
       return s.datums[t]
      }) : []
     },
     reset: function() {
      this.datums = [], this.trie = {
       ids: [],
       children: {}
      }
     },
     serialize: function() {
      return {
       datums: this.datums,
       trie: this.trie
      }
     }
    }), n
   }(),
   l = function() {
    "use strict";
    return {
     local: function(t) {
      return t.local || null
     },
     prefetch: function(i) {
      var r, s;
      return s = {
       url: null,
       thumbprint: "",
       ttl: 864e5,
       filter: null,
       ajax: {}
      }, (r = i.prefetch || null) && (r = e.isString(r) ? {
       url: r
      } : r, (r = e.mixin(s, r)).thumbprint = n + r.thumbprint, r.ajax.type = r.ajax.type || "GET", r.ajax.dataType = r.ajax.dataType || "json", !r.url && t.error("prefetch requires url to be set")), r
     },
     remote: function(n) {
      var i, r;
      return r = {
       url: null,
       cache: !0,
       wildcard: "%QUERY",
       replace: null,
       rateLimitBy: "debounce",
       rateLimitWait: 300,
       send: null,
       filter: null,
       ajax: {}
      }, (i = n.remote || null) && (i = e.isString(i) ? {
       url: i
      } : i, (i = e.mixin(r, i)).rateLimiter = /^throttle$/i.test(i.rateLimitBy) ? function(t) {
       return function(n) {
        return e.throttle(n, t)
       }
      }(i.rateLimitWait) : function(t) {
       return function(n) {
        return e.debounce(n, t)
       }
      }(i.rateLimitWait), i.ajax.type = i.ajax.type || "GET", i.ajax.dataType = i.ajax.dataType || "json", delete i.rateLimitBy, delete i.rateLimitWait, !i.url && t.error("remote requires url to be set")), i
     }
    }
   }();
  ! function(n) {
   "use strict";

   function r(n) {
    n && (n.local || n.prefetch || n.remote) || t.error("one of local, prefetch, or remote is required"), this.limit = n.limit || 5, this.sorter = function(t) {
     return e.isFunction(t) ? function(e) {
      return e.sort(t)
     } : function(t) {
      return t
     }
    }(n.sorter), this.dupDetector = n.dupDetector || function() {
     return !1
    }, this.local = l.local(n), this.prefetch = l.prefetch(n), this.remote = l.remote(n), this.cacheKey = this.prefetch ? this.prefetch.cacheKey || this.prefetch.url : null, this.index = new a({
     datumTokenizer: n.datumTokenizer,
     queryTokenizer: n.queryTokenizer
    }), this.storage = this.cacheKey ? new s(this.cacheKey) : null
   }
   var c, u;
   c = n.Bloodhound, u = {
    data: "data",
    protocol: "protocol",
    thumbprint: "thumbprint"
   }, n.Bloodhound = r, r.noConflict = function() {
    return n.Bloodhound = c, r
   }, r.tokenizers = i, e.mixin(r.prototype, {
    _loadPrefetch: function(e) {
     var n, i, r = this;
     return (n = this._readFromStorage(e.thumbprint)) ? (this.index.bootstrap(n), i = t.Deferred().resolve()) : i = t.ajax(e.url, e.ajax).done(function(t) {
      r.clear(), r.add(e.filter ? e.filter(t) : t), r._saveToStorage(r.index.serialize(), e.thumbprint, e.ttl)
     }), i
    },
    _getFromRemote: function(t, e) {
     var n, i, r = this;
     if (this.transport) return t = t || "", i = encodeURIComponent(t), n = this.remote.replace ? this.remote.replace(this.remote.url, t) : this.remote.url.replace(this.remote.wildcard, i), this.transport.get(n, this.remote.ajax, function(t, n) {
      e(t ? [] : r.remote.filter ? r.remote.filter(n) : n)
     })
    },
    _cancelLastRemoteRequest: function() {
     this.transport && this.transport.cancel()
    },
    _saveToStorage: function(t, e, n) {
     this.storage && (this.storage.set(u.data, t, n), this.storage.set(u.protocol, location.protocol, n), this.storage.set(u.thumbprint, e, n))
    },
    _readFromStorage: function(t) {
     var e, n = {};
     return this.storage && (n.data = this.storage.get(u.data), n.protocol = this.storage.get(u.protocol), n.thumbprint = this.storage.get(u.thumbprint)), e = n.thumbprint !== t || n.protocol !== location.protocol, n.data && !e ? n.data : null
    },
    _initialize: function() {
     var n, i = this,
      r = this.local;
     return n = this.prefetch ? this._loadPrefetch(this.prefetch) : t.Deferred().resolve(), r && n.done(function() {
      i.add(e.isFunction(r) ? r() : r)
     }), this.transport = this.remote ? new o(this.remote) : null, this.initPromise = n.promise()
    },
    initialize: function(t) {
     return !this.initPromise || t ? this._initialize() : this.initPromise
    },
    add: function(t) {
     this.index.add(t)
    },
    get: function(t, n) {
     var i = this,
      r = [],
      s = !1;
     r = this.index.get(t), (r = this.sorter(r).slice(0, this.limit)).length < this.limit ? s = this._getFromRemote(t, function(t) {
      var s = r.slice(0);
      e.each(t, function(t) {
       return !e.some(s, function(e) {
        return i.dupDetector(t, e)
       }) && s.push(t), s.length < i.limit
      }), n && n(i.sorter(s))
     }) : this._cancelLastRemoteRequest(), s || (r.length > 0 || !this.transport) && n && n(r)
    },
    clear: function() {
     this.index.reset()
    },
    clearPrefetchCache: function() {
     this.storage && this.storage.clear()
    },
    clearRemoteCache: function() {
     this.transport && o.resetCache()
    },
    ttAdapter: function() {
     return e.bind(this.get, this)
    }
   })
  }(this);
  var c = {
    wrapper: '<span class="twitter-typeahead"></span>',
    dropdown: '<span class="tt-dropdown-menu"></span>',
    dataset: '<div class="tt-dataset-%CLASS%"></div>',
    suggestions: '<span class="tt-suggestions"></span>',
    suggestion: '<div class="tt-suggestion"></div>'
   },
   u = function() {
    "use strict";
    var t = {
     wrapper: {
      position: "relative",
      display: "block"
     },
     hint: {
      position: "absolute",
      top: "0",
      left: "0",
      borderColor: "transparent",
      boxShadow: "none",
      opacity: "1"
     },
     input: {
      position: "relative",
      verticalAlign: "top",
      backgroundColor: "transparent"
     },
     inputWithNoHint: {
      position: "relative",
      verticalAlign: "top"
     },
     dropdown: {
      position: "absolute",
      top: "100%",
      left: "0",
      zIndex: "100",
      display: "none"
     },
     suggestions: {
      display: "block"
     },
     suggestion: {
      whiteSpace: "nowrap",
      cursor: "pointer"
     },
     suggestionChild: {
      whiteSpace: "normal"
     },
     ltr: {
      left: "0",
      right: "auto"
     },
     rtl: {
      left: "auto",
      right: " 0"
     }
    };
    return e.isMsie() && e.mixin(t.input, {
     backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"
    }), e.isMsie() && e.isMsie() <= 7 && e.mixin(t.input, {
     marginTop: "-1px"
    }), t
   }(),
   h = function() {
    "use strict";

    function n(e) {
     e && e.el || t.error("EventBus initialized without el"), this.$el = t(e.el)
    }
    return e.mixin(n.prototype, {
     trigger: function(t) {
      var e = [].slice.call(arguments, 1);
      this.$el.trigger("typeahead:" + t, e)
     }
    }), n
   }(),
   p = function() {
    "use strict";

    function t(t, e, i, r) {
     var s;
     if (!i) return this;
     for (e = e.split(n), i = r ? function(t, e) {
       return t.bind ? t.bind(e) : function() {
        t.apply(e, [].slice.call(arguments, 0))
       }
      }(i, r) : i, this._callbacks = this._callbacks || {}; s = e.shift();) this._callbacks[s] = this._callbacks[s] || {
      sync: [],
      async: []
     }, this._callbacks[s][t].push(i);
     return this
    }

    function e(t, e, n) {
     return function() {
      for (var i, r = 0, s = t.length; !i && r < s; r += 1) i = !1 === t[r].apply(e, n);
      return !i
     }
    }
    var n = /\s+/,
     i = window.setImmediate ? function(t) {
      setImmediate(function() {
       t()
      })
     } : function(t) {
      setTimeout(function() {
       t()
      }, 0)
     };
    return {
     onSync: function(e, n, i) {
      return t.call(this, "sync", e, n, i)
     },
     onAsync: function(e, n, i) {
      return t.call(this, "async", e, n, i)
     },
     off: function(t) {
      var e;
      if (!this._callbacks) return this;
      for (t = t.split(n); e = t.shift();) delete this._callbacks[e];
      return this
     },
     trigger: function(t) {
      var r, s, o, a, l;
      if (!this._callbacks) return this;
      for (t = t.split(n), o = [].slice.call(arguments, 1);
       (r = t.shift()) && (s = this._callbacks[r]);) a = e(s.sync, this, [r].concat(o)), l = e(s.async, this, [r].concat(o)), a() && i(l);
      return this
     }
    }
   }(),
   d = function(t) {
    "use strict";
    var n = {
     node: null,
     pattern: null,
     tagName: "strong",
     className: null,
     wordsOnly: !1,
     caseSensitive: !1
    };
    return function(i) {
     function r(t, e) {
      for (var n, i = 0; i < t.childNodes.length; i++) 3 === (n = t.childNodes[i]).nodeType ? i += e(n) ? 1 : 0 : r(n, e)
     }
     var s;
     (i = e.mixin({}, n, i)).node && i.pattern && (i.pattern = e.isArray(i.pattern) ? i.pattern : [i.pattern], s = function(t, n, i) {
      for (var r, s = [], o = 0, a = t.length; o < a; o++) s.push(e.escapeRegExChars(t[o]));
      return r = i ? "\\b(" + s.join("|") + ")\\b" : "(" + s.join("|") + ")", n ? new RegExp(r) : new RegExp(r, "i")
     }(i.pattern, i.caseSensitive, i.wordsOnly), r(i.node, function(e) {
      var n, r, o;
      return (n = s.exec(e.data)) && (o = t.createElement(i.tagName), i.className && (o.className = i.className), (r = e.splitText(n.index)).splitText(n[0].length), o.appendChild(r.cloneNode(!0)), e.parentNode.replaceChild(o, r)), !!n
     }))
    }
   }(window.document),
   f = function() {
    "use strict";

    function n(n) {
     var i, s, o, a, l = this;
     (n = n || {}).input || t.error("input is missing"), i = e.bind(this._onBlur, this), s = e.bind(this._onFocus, this), o = e.bind(this._onKeydown, this), a = e.bind(this._onInput, this), this.$hint = t(n.hint), this.$input = t(n.input).on("blur.tt", i).on("focus.tt", s).on("keydown.tt", o), 0 === this.$hint.length && (this.setHint = this.getHint = this.clearHint = this.clearHintIfInvalid = e.noop), e.isMsie() ? this.$input.on("keydown.tt keypress.tt cut.tt paste.tt", function(t) {
      r[t.which || t.keyCode] || e.defer(e.bind(l._onInput, l, t))
     }) : this.$input.on("input.tt", a), this.query = this.$input.val(), this.$overflowHelper = function(e) {
      return t('<pre aria-hidden="true"></pre>').css({
       position: "absolute",
       visibility: "hidden",
       whiteSpace: "pre",
       fontFamily: e.css("font-family"),
       fontSize: e.css("font-size"),
       fontStyle: e.css("font-style"),
       fontVariant: e.css("font-variant"),
       fontWeight: e.css("font-weight"),
       wordSpacing: e.css("word-spacing"),
       letterSpacing: e.css("letter-spacing"),
       textIndent: e.css("text-indent"),
       textRendering: e.css("text-rendering"),
       textTransform: e.css("text-transform")
      }).insertAfter(e)
     }(this.$input)
    }

    function i(t) {
     return t.altKey || t.ctrlKey || t.metaKey || t.shiftKey
    }
    var r;
    return r = {
     9: "tab",
     27: "esc",
     37: "left",
     39: "right",
     13: "enter",
     38: "up",
     40: "down"
    }, n.normalizeQuery = function(t) {
     return (t || "").replace(/^\s*/g, "").replace(/\s{2,}/g, " ")
    }, e.mixin(n.prototype, p, {
     _onBlur: function() {
      this.resetInputValue(), this.trigger("blurred")
     },
     _onFocus: function() {
      this.trigger("focused")
     },
     _onKeydown: function(t) {
      var e = r[t.which || t.keyCode];
      this._managePreventDefault(e, t), e && this._shouldTrigger(e, t) && this.trigger(e + "Keyed", t)
     },
     _onInput: function() {
      this._checkInputValue()
     },
     _managePreventDefault: function(t, e) {
      var n, r, s;
      switch (t) {
       case "tab":
        r = this.getHint(), s = this.getInputValue(), n = r && r !== s && !i(e);
        break;
       case "up":
       case "down":
        n = !i(e);
        break;
       default:
        n = !1
      }
      n && e.preventDefault()
     },
     _shouldTrigger: function(t, e) {
      var n;
      switch (t) {
       case "tab":
        n = !i(e);
        break;
       default:
        n = !0
      }
      return n
     },
     _checkInputValue: function() {
      var t, e, i;
      i = !!(e = function(t, e) {
       return n.normalizeQuery(t) === n.normalizeQuery(e)
      }(t = this.getInputValue(), this.query)) && this.query.length !== t.length, this.query = t, e ? i && this.trigger("whitespaceChanged", this.query) : this.trigger("queryChanged", this.query)
     },
     focus: function() {
      this.$input.focus()
     },
     blur: function() {
      this.$input.blur()
     },
     getQuery: function() {
      return this.query
     },
     setQuery: function(t) {
      this.query = t
     },
     getInputValue: function() {
      return this.$input.val()
     },
     setInputValue: function(t, e) {
      this.$input.val(t), e ? this.clearHint() : this._checkInputValue()
     },
     resetInputValue: function() {
      this.setInputValue(this.query, !0)
     },
     getHint: function() {
      return this.$hint.val()
     },
     setHint: function(t) {
      this.$hint.val(t)
     },
     clearHint: function() {
      this.setHint("")
     },
     clearHintIfInvalid: function() {
      var t, e, n;
      n = (t = this.getInputValue()) !== (e = this.getHint()) && 0 === e.indexOf(t), !("" !== t && n && !this.hasOverflow()) && this.clearHint()
     },
     getLanguageDirection: function() {
      return (this.$input.css("direction") || "ltr").toLowerCase()
     },
     hasOverflow: function() {
      var t = this.$input.width() - 2;
      return this.$overflowHelper.text(this.getInputValue()), this.$overflowHelper.width() >= t
     },
     isCursorAtEnd: function() {
      var t, n, i;
      return t = this.$input.val().length, n = this.$input[0].selectionStart, e.isNumber(n) ? n === t : !document.selection || ((i = document.selection.createRange()).moveStart("character", -t), t === i.text.length)
     },
     destroy: function() {
      this.$hint.off(".tt"), this.$input.off(".tt"), this.$hint = this.$input = this.$overflowHelper = null
     }
    }), n
   }(),
   m = function() {
    "use strict";

    function n(n) {
     (n = n || {}).templates = n.templates || {}, n.source || t.error("missing source"), n.name && ! function(t) {
      return /^[_a-zA-Z0-9-]+$/.test(t)
     }(n.name) && t.error("invalid dataset name: " + n.name), this.query = null, this.highlight = !!n.highlight, this.name = n.name || e.getUniqueId(), this.source = n.source, this.displayFn = function(t) {
      return t = t || "value", e.isFunction(t) ? t : function(e) {
       return e[t]
      }
     }(n.display || n.displayKey), this.templates = function(t, n) {
      return {
       empty: t.empty && e.templatify(t.empty),
       header: t.header && e.templatify(t.header),
       footer: t.footer && e.templatify(t.footer),
       suggestion: t.suggestion || function(t) {
        return "<p>" + n(t) + "</p>"
       }
      }
     }(n.templates, this.displayFn), this.$el = t(c.dataset.replace("%CLASS%", this.name))
    }
    var i = "ttDataset",
     r = "ttValue",
     s = "ttDatum";
    return n.extractDatasetName = function(e) {
     return t(e).data(i)
    }, n.extractValue = function(e) {
     return t(e).data(r)
    }, n.extractDatum = function(e) {
     return t(e).data(s)
    }, e.mixin(n.prototype, p, {
     _render: function(n, o) {
      function a() {
       return p.templates.header({
        query: n,
        isEmpty: !h
       })
      }

      function l() {
       return p.templates.footer({
        query: n,
        isEmpty: !h
       })
      }
      if (this.$el) {
       var h, p = this;
       this.$el.empty(), !(h = o && o.length) && this.templates.empty ? this.$el.html(p.templates.empty({
        query: n,
        isEmpty: !0
       })).prepend(p.templates.header ? a() : null).append(p.templates.footer ? l() : null) : h && this.$el.html(function() {
        var a, l;
        return a = t(c.suggestions).css(u.suggestions), l = e.map(o, function(e) {
         var n;
         return (n = t(c.suggestion).append(p.templates.suggestion(e)).data(i, p.name).data(r, p.displayFn(e)).data(s, e)).children().each(function() {
          t(this).css(u.suggestionChild)
         }), n
        }), a.append.apply(a, l), p.highlight && d({
         className: "tt-highlight",
         node: a[0],
         pattern: n
        }), a
       }()).prepend(p.templates.header ? a() : null).append(p.templates.footer ? l() : null), this.trigger("rendered")
      }
     },
     getRoot: function() {
      return this.$el
     },
     update: function(t) {
      var e = this;
      this.query = t, this.canceled = !1, this.source(t, function(n) {
       e.canceled || t !== e.query || e._render(t, n)
      })
     },
     cancel: function() {
      this.canceled = !0
     },
     clear: function() {
      this.cancel(), this.$el.empty(), this.trigger("rendered")
     },
     isEmpty: function() {
      return this.$el.is(":empty")
     },
     destroy: function() {
      this.$el = null
     }
    }), n
   }(),
   g = function() {
    "use strict";

    function n(n) {
     var r, s, o, a = this;
     (n = n || {}).menu || t.error("menu is required"), this.isOpen = !1, this.isEmpty = !0, this.datasets = e.map(n.datasets, i), r = e.bind(this._onSuggestionClick, this), s = e.bind(this._onSuggestionMouseEnter, this), o = e.bind(this._onSuggestionMouseLeave, this), this.$menu = t(n.menu).on("click.tt", ".tt-suggestion", r).on("mouseenter.tt", ".tt-suggestion", s).on("mouseleave.tt", ".tt-suggestion", o), e.each(this.datasets, function(t) {
      a.$menu.append(t.getRoot()), t.onSync("rendered", a._onRendered, a)
     })
    }

    function i(t) {
     return new m(t)
    }
    return e.mixin(n.prototype, p, {
     _onSuggestionClick: function(e) {
      this.trigger("suggestionClicked", t(e.currentTarget))
     },
     _onSuggestionMouseEnter: function(e) {
      this._removeCursor(), this._setCursor(t(e.currentTarget), !0)
     },
     _onSuggestionMouseLeave: function() {
      this._removeCursor()
     },
     _onRendered: function() {
      this.isEmpty = e.every(this.datasets, function(t) {
       return t.isEmpty()
      }), this.isEmpty ? this._hide() : this.isOpen && this._show(), this.trigger("datasetRendered")
     },
     _hide: function() {
      this.$menu.hide()
     },
     _show: function() {
      this.$menu.css("display", "block")
     },
     _getSuggestions: function() {
      return this.$menu.find(".tt-suggestion")
     },
     _getCursor: function() {
      return this.$menu.find(".tt-cursor").first()
     },
     _setCursor: function(t, e) {
      t.first().addClass("tt-cursor"), !e && this.trigger("cursorMoved")
     },
     _removeCursor: function() {
      this._getCursor().removeClass("tt-cursor")
     },
     _moveCursor: function(t) {
      var e, n, i, r;
      this.isOpen && (n = this._getCursor(), e = this._getSuggestions(), this._removeCursor(), -1 !== (i = ((i = e.index(n) + t) + 1) % (e.length + 1) - 1) ? (i < -1 && (i = e.length - 1), this._setCursor(r = e.eq(i)), this._ensureVisible(r)) : this.trigger("cursorRemoved"))
     },
     _ensureVisible: function(t) {
      var e, n, i, r;
      n = (e = t.position().top) + t.outerHeight(!0), i = this.$menu.scrollTop(), r = this.$menu.height() + parseInt(this.$menu.css("paddingTop"), 10) + parseInt(this.$menu.css("paddingBottom"), 10), e < 0 ? this.$menu.scrollTop(i + e) : r < n && this.$menu.scrollTop(i + (n - r))
     },
     close: function() {
      this.isOpen && (this.isOpen = !1, this._removeCursor(), this._hide(), this.trigger("closed"))
     },
     open: function() {
      this.isOpen || (this.isOpen = !0, !this.isEmpty && this._show(), this.trigger("opened"))
     },
     setLanguageDirection: function(t) {
      this.$menu.css("ltr" === t ? u.ltr : u.rtl)
     },
     moveCursorUp: function() {
      this._moveCursor(-1)
     },
     moveCursorDown: function() {
      this._moveCursor(1)
     },
     getDatumForSuggestion: function(t) {
      var e = null;
      return t.length && (e = {
       raw: m.extractDatum(t),
       value: m.extractValue(t),
       datasetName: m.extractDatasetName(t)
      }), e
     },
     getDatumForCursor: function() {
      return this.getDatumForSuggestion(this._getCursor().first())
     },
     getDatumForTopSuggestion: function() {
      return this.getDatumForSuggestion(this._getSuggestions().first())
     },
     update: function(t) {
      e.each(this.datasets, function(e) {
       e.update(t)
      })
     },
     empty: function() {
      e.each(this.datasets, function(t) {
       t.clear()
      }), this.isEmpty = !0
     },
     isVisible: function() {
      return this.isOpen && !this.isEmpty
     },
     destroy: function() {
      this.$menu.off(".tt"), this.$menu = null, e.each(this.datasets, function(t) {
       t.destroy()
      })
     }
    }), n
   }(),
   v = function() {
    "use strict";

    function n(n) {
     var r, s, o;
     (n = n || {}).input || t.error("missing input"), this.isActivated = !1, this.autoselect = !!n.autoselect, this.minLength = e.isNumber(n.minLength) ? n.minLength : 1, this.$node = function(e, n) {
      var r, s, o, a;
      r = t(e), s = t(c.wrapper).css(u.wrapper), o = t(c.dropdown).css(u.dropdown), (a = r.clone().css(u.hint).css(function(t) {
       return {
        backgroundAttachment: t.css("background-attachment"),
        backgroundClip: t.css("background-clip"),
        backgroundColor: t.css("background-color"),
        backgroundImage: t.css("background-image"),
        backgroundOrigin: t.css("background-origin"),
        backgroundPosition: t.css("background-position"),
        backgroundRepeat: t.css("background-repeat"),
        backgroundSize: t.css("background-size")
       }
      }(r))).val("").removeData().addClass("tt-hint").removeAttr("id name placeholder required").prop("readonly", !0).attr({
       autocomplete: "off",
       spellcheck: "false",
       tabindex: -1
      }), r.data(i, {
       dir: r.attr("dir"),
       autocomplete: r.attr("autocomplete"),
       spellcheck: r.attr("spellcheck"),
       style: r.attr("style")
      }), r.addClass("tt-input").attr({
       autocomplete: "off",
       spellcheck: !1
      }).css(n ? u.input : u.inputWithNoHint);
      try {
       !r.attr("dir") && r.attr("dir", "auto")
      } catch (t) {}
      return r.wrap(s).parent().prepend(n ? a : null).append(o)
     }(n.input, n.withHint), r = this.$node.find(".tt-dropdown-menu"), s = this.$node.find(".tt-input"), o = this.$node.find(".tt-hint"), s.on("blur.tt", function(t) {
      var n, i, o;
      n = document.activeElement, i = r.is(n), o = r.has(n).length > 0, e.isMsie() && (i || o) && (t.preventDefault(), t.stopImmediatePropagation(), e.defer(function() {
       s.focus()
      }))
     }), r.on("mousedown.tt", function(t) {
      t.preventDefault()
     }), this.eventBus = n.eventBus || new h({
      el: s
     }), this.dropdown = new g({
      menu: r,
      datasets: n.datasets
     }).onSync("suggestionClicked", this._onSuggestionClicked, this).onSync("cursorMoved", this._onCursorMoved, this).onSync("cursorRemoved", this._onCursorRemoved, this).onSync("opened", this._onOpened, this).onSync("closed", this._onClosed, this).onAsync("datasetRendered", this._onDatasetRendered, this), this.input = new f({
      input: s,
      hint: o
     }).onSync("focused", this._onFocused, this).onSync("blurred", this._onBlurred, this).onSync("enterKeyed", this._onEnterKeyed, this).onSync("tabKeyed", this._onTabKeyed, this).onSync("escKeyed", this._onEscKeyed, this).onSync("upKeyed", this._onUpKeyed, this).onSync("downKeyed", this._onDownKeyed, this).onSync("leftKeyed", this._onLeftKeyed, this).onSync("rightKeyed", this._onRightKeyed, this).onSync("queryChanged", this._onQueryChanged, this).onSync("whitespaceChanged", this._onWhitespaceChanged, this), this._setLanguageDirection()
    }
    var i = "ttAttrs";
    return e.mixin(n.prototype, {
     _onSuggestionClicked: function(t, e) {
      var n;
      (n = this.dropdown.getDatumForSuggestion(e)) && this._select(n)
     },
     _onCursorMoved: function() {
      var t = this.dropdown.getDatumForCursor();
      this.input.setInputValue(t.value, !0), this.eventBus.trigger("cursorchanged", t.raw, t.datasetName)
     },
     _onCursorRemoved: function() {
      this.input.resetInputValue(), this._updateHint()
     },
     _onDatasetRendered: function() {
      this._updateHint()
     },
     _onOpened: function() {
      this._updateHint(), this.eventBus.trigger("opened")
     },
     _onClosed: function() {
      this.input.clearHint(), this.eventBus.trigger("closed")
     },
     _onFocused: function() {
      this.isActivated = !0, this.dropdown.open()
     },
     _onBlurred: function() {
      this.isActivated = !1, this.dropdown.empty(), this.dropdown.close()
     },
     _onEnterKeyed: function(t, e) {
      var n, i;
      n = this.dropdown.getDatumForCursor(), i = this.dropdown.getDatumForTopSuggestion(), n ? (this._select(n), e.preventDefault()) : this.autoselect && i && (this._select(i), e.preventDefault())
     },
     _onTabKeyed: function(t, e) {
      var n;
      (n = this.dropdown.getDatumForCursor()) ? (this._select(n), e.preventDefault()) : this._autocomplete(!0)
     },
     _onEscKeyed: function() {
      this.dropdown.close(), this.input.resetInputValue()
     },
     _onUpKeyed: function() {
      var t = this.input.getQuery();
      this.dropdown.isEmpty && t.length >= this.minLength ? this.dropdown.update(t) : this.dropdown.moveCursorUp(), this.dropdown.open()
     },
     _onDownKeyed: function() {
      var t = this.input.getQuery();
      this.dropdown.isEmpty && t.length >= this.minLength ? this.dropdown.update(t) : this.dropdown.moveCursorDown(), this.dropdown.open()
     },
     _onLeftKeyed: function() {
      "rtl" === this.dir && this._autocomplete()
     },
     _onRightKeyed: function() {
      "ltr" === this.dir && this._autocomplete()
     },
     _onQueryChanged: function(t, e) {
      this.input.clearHintIfInvalid(), e.length >= this.minLength ? this.dropdown.update(e) : this.dropdown.empty(), this.dropdown.open(), this._setLanguageDirection()
     },
     _onWhitespaceChanged: function() {
      this._updateHint(), this.dropdown.open()
     },
     _setLanguageDirection: function() {
      var t;
      this.dir !== (t = this.input.getLanguageDirection()) && (this.dir = t, this.$node.css("direction", t), this.dropdown.setLanguageDirection(t))
     },
     _updateHint: function() {
      var t, n, i, r, s;
      (t = this.dropdown.getDatumForTopSuggestion()) && this.dropdown.isVisible() && !this.input.hasOverflow() ? (n = this.input.getInputValue(), i = f.normalizeQuery(n), r = e.escapeRegExChars(i), (s = new RegExp("^(?:" + r + ")(.+$)", "i").exec(t.value)) ? this.input.setHint(n + s[1]) : this.input.clearHint()) : this.input.clearHint()
     },
     _autocomplete: function(t) {
      var e, n, i, r;
      e = this.input.getHint(), n = this.input.getQuery(), i = t || this.input.isCursorAtEnd(), e && n !== e && i && ((r = this.dropdown.getDatumForTopSuggestion()) && this.input.setInputValue(r.value), this.eventBus.trigger("autocompleted", r.raw, r.datasetName))
     },
     _select: function(t) {
      this.input.setQuery(t.value), this.input.setInputValue(t.value, !0), this._setLanguageDirection(), this.eventBus.trigger("selected", t.raw, t.datasetName), this.dropdown.close(), e.defer(e.bind(this.dropdown.empty, this.dropdown))
     },
     open: function() {
      this.dropdown.open()
     },
     close: function() {
      this.dropdown.close()
     },
     setVal: function(t) {
      t = e.toStr(t), this.isActivated ? this.input.setInputValue(t) : (this.input.setQuery(t), this.input.setInputValue(t, !0)), this._setLanguageDirection()
     },
     getVal: function() {
      return this.input.getQuery()
     },
     destroy: function() {
      this.input.destroy(), this.dropdown.destroy(),
       function(t) {
        var n = t.find(".tt-input");
        e.each(n.data(i), function(t, i) {
         e.isUndefined(t) ? n.removeAttr(i) : n.attr(i, t)
        }), n.detach().removeData(i).removeClass("tt-input").insertAfter(t), t.remove()
       }(this.$node), this.$node = null
     }
    }), n
   }();
  ! function() {
   "use strict";
   var n, i, r;
   n = t.fn.typeahead, i = "ttTypeahead", r = {
    initialize: function(n, r) {
     return r = e.isArray(r) ? r : [].slice.call(arguments, 1), n = n || {}, this.each(function() {
      var s, o = t(this);
      e.each(r, function(t) {
       t.highlight = !!n.highlight
      }), s = new v({
       input: o,
       eventBus: new h({
        el: o
       }),
       withHint: !!e.isUndefined(n.hint) || !!n.hint,
       minLength: n.minLength,
       autoselect: n.autoselect,
       datasets: r
      }), o.data(i, s)
     })
    },
    open: function() {
     return this.each(function() {
      var e;
      (e = t(this).data(i)) && e.open()
     })
    },
    close: function() {
     return this.each(function() {
      var e;
      (e = t(this).data(i)) && e.close()
     })
    },
    val: function(e) {
     return arguments.length ? this.each(function() {
      var n;
      (n = t(this).data(i)) && n.setVal(e)
     }) : function(t) {
      var e, n;
      return (e = t.data(i)) && (n = e.getVal()), n
     }(this.first())
    },
    destroy: function() {
     return this.each(function() {
      var e, n = t(this);
      (e = n.data(i)) && (e.destroy(), n.removeData(i))
     })
    }
   }, t.fn.typeahead = function(e) {
    var n;
    return r[e] && "initialize" !== e ? (n = this.filter(function() {
     return !!t(this).data(i)
    }), r[e].apply(n, [].slice.call(arguments, 1))) : r.initialize.apply(this, arguments)
   }, t.fn.typeahead.noConflict = function() {
    return t.fn.typeahead = n, this
   }
  }()
 }(window.jQuery),
 function(t, e) {
  "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? exports.Handlebars = e() : t.Handlebars = e()
 }(this, function() {
  return function(t) {
   function e(i) {
    if (n[i]) return n[i].exports;
    var r = n[i] = {
     exports: {},
     id: i,
     loaded: !1
    };
    return t[i].call(r.exports, r, r.exports, e), r.loaded = !0, r.exports
   }
   var n = {};
   return e.m = t, e.c = n, e.p = "", e(0)
  }([function(t, e, n) {
   "use strict";

   function i() {
    var t = p();
    return t.compile = function(e, n) {
     return l.compile(e, n, t)
    }, t.precompile = function(e, n) {
     return l.precompile(e, n, t)
    }, t.AST = o.default, t.Compiler = l.Compiler, t.JavaScriptCompiler = c.default, t.Parser = a.parser, t.parse = a.parse, t
   }
   var r = n(1).default;
   e.__esModule = !0;
   var s = r(n(2)),
    o = r(n(35)),
    a = n(36),
    l = n(41),
    c = r(n(42)),
    u = r(n(39)),
    h = r(n(34)),
    p = s.default.create,
    d = i();
   d.create = i, h.default(d), d.Visitor = u.default, d.default = d, e.default = d, t.exports = e.default
  }, function(t, e) {
   "use strict";
   e.default = function(t) {
    return t && t.__esModule ? t : {
     default: t
    }
   }, e.__esModule = !0
  }, function(t, e, n) {
   "use strict";

   function i() {
    var t = new o.HandlebarsEnvironment;
    return c.extend(t, o), t.SafeString = a.default, t.Exception = l.default, t.Utils = c, t.escapeExpression = c.escapeExpression, t.VM = u, t.template = function(e) {
     return u.template(e, t)
    }, t
   }
   var r = n(3).default,
    s = n(1).default;
   e.__esModule = !0;
   var o = r(n(4)),
    a = s(n(21)),
    l = s(n(6)),
    c = r(n(5)),
    u = r(n(22)),
    h = s(n(34)),
    p = i();
   p.create = i, h.default(p), p.default = p, e.default = p, t.exports = e.default
  }, function(t, e) {
   "use strict";
   e.default = function(t) {
    if (t && t.__esModule) return t;
    var e = {};
    if (null != t)
     for (var n in t) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n]);
    return e.default = t, e
   }, e.__esModule = !0
  }, function(t, e, n) {
   "use strict";

   function i(t, e, n) {
    this.helpers = t || {}, this.partials = e || {}, this.decorators = n || {}, a.registerDefaultHelpers(this), l.registerDefaultDecorators(this)
   }
   var r = n(1).default;
   e.__esModule = !0, e.HandlebarsEnvironment = i;
   var s = n(5),
    o = r(n(6)),
    a = n(10),
    l = n(18),
    c = r(n(20));
   e.VERSION = "4.0.10";
   e.COMPILER_REVISION = 7;
   e.REVISION_CHANGES = {
    1: "<= 1.0.rc.2",
    2: "== 1.0.0-rc.3",
    3: "== 1.0.0-rc.4",
    4: "== 1.x.x",
    5: "== 2.0.0-alpha.x",
    6: ">= 2.0.0-beta.1",
    7: ">= 4.0.0"
   };
   var u = "[object Object]";
   i.prototype = {
    constructor: i,
    logger: c.default,
    log: c.default.log,
    registerHelper: function(t, e) {
     if (s.toString.call(t) === u) {
      if (e) throw new o.default("Arg not supported with multiple helpers");
      s.extend(this.helpers, t)
     } else this.helpers[t] = e
    },
    unregisterHelper: function(t) {
     delete this.helpers[t]
    },
    registerPartial: function(t, e) {
     if (s.toString.call(t) === u) s.extend(this.partials, t);
     else {
      if (void 0 === e) throw new o.default('Attempting to register a partial called "' + t + '" as undefined');
      this.partials[t] = e
     }
    },
    unregisterPartial: function(t) {
     delete this.partials[t]
    },
    registerDecorator: function(t, e) {
     if (s.toString.call(t) === u) {
      if (e) throw new o.default("Arg not supported with multiple decorators");
      s.extend(this.decorators, t)
     } else this.decorators[t] = e
    },
    unregisterDecorator: function(t) {
     delete this.decorators[t]
    }
   };
   var h = c.default.log;
   e.log = h, e.createFrame = s.createFrame, e.logger = c.default
  }, function(t, e) {
   "use strict";

   function n(t) {
    return r[t]
   }

   function i(t) {
    for (var e = 1; e < arguments.length; e++)
     for (var n in arguments[e]) Object.prototype.hasOwnProperty.call(arguments[e], n) && (t[n] = arguments[e][n]);
    return t
   }
   e.__esModule = !0, e.extend = i, e.indexOf = function(t, e) {
    for (var n = 0, i = t.length; n < i; n++)
     if (t[n] === e) return n;
    return -1
   }, e.escapeExpression = function(t) {
    if ("string" != typeof t) {
     if (t && t.toHTML) return t.toHTML();
     if (null == t) return "";
     if (!t) return t + "";
     t = "" + t
    }
    return o.test(t) ? t.replace(s, n) : t
   }, e.isEmpty = function(t) {
    return !t && 0 !== t || !(!c(t) || 0 !== t.length)
   }, e.createFrame = function(t) {
    var e = i({}, t);
    return e._parent = t, e
   }, e.blockParams = function(t, e) {
    return t.path = e, t
   }, e.appendContextPath = function(t, e) {
    return (t ? t + "." : "") + e
   };
   var r = {
     "&": "&amp;",
     "<": "&lt;",
     ">": "&gt;",
     '"': "&quot;",
     "'": "&#x27;",
     "`": "&#x60;",
     "=": "&#x3D;"
    },
    s = /[&<>"'`=]/g,
    o = /[&<>"'`=]/,
    a = Object.prototype.toString;
   e.toString = a;
   var l = function(t) {
    return "function" == typeof t
   };
   l(/x/) && (e.isFunction = l = function(t) {
    return "function" == typeof t && "[object Function]" === a.call(t)
   }), e.isFunction = l;
   var c = Array.isArray || function(t) {
    return !(!t || "object" != typeof t) && "[object Array]" === a.call(t)
   };
   e.isArray = c
  }, function(t, e, n) {
   "use strict";

   function i(t, e) {
    var n = e && e.loc,
     o = void 0,
     a = void 0;
    n && (t += " - " + (o = n.start.line) + ":" + (a = n.start.column));
    for (var l = Error.prototype.constructor.call(this, t), c = 0; c < s.length; c++) this[s[c]] = l[s[c]];
    Error.captureStackTrace && Error.captureStackTrace(this, i);
    try {
     n && (this.lineNumber = o, r ? Object.defineProperty(this, "column", {
      value: a,
      enumerable: !0
     }) : this.column = a)
    } catch (t) {}
   }
   var r = n(7).default;
   e.__esModule = !0;
   var s = ["description", "fileName", "lineNumber", "message", "name", "number", "stack"];
   i.prototype = new Error, e.default = i, t.exports = e.default
  }, function(t, e, n) {
   t.exports = {
    default: n(8),
    __esModule: !0
   }
  }, function(t, e, n) {
   var i = n(9);
   t.exports = function(t, e, n) {
    return i.setDesc(t, e, n)
   }
  }, function(t, e) {
   var n = Object;
   t.exports = {
    create: n.create,
    getProto: n.getPrototypeOf,
    isEnum: {}.propertyIsEnumerable,
    getDesc: n.getOwnPropertyDescriptor,
    setDesc: n.defineProperty,
    setDescs: n.defineProperties,
    getKeys: n.keys,
    getNames: n.getOwnPropertyNames,
    getSymbols: n.getOwnPropertySymbols,
    each: [].forEach
   }
  }, function(t, e, n) {
   "use strict";
   var i = n(1).default;
   e.__esModule = !0, e.registerDefaultHelpers = function(t) {
    r.default(t), s.default(t), o.default(t), a.default(t), l.default(t), c.default(t), u.default(t)
   };
   var r = i(n(11)),
    s = i(n(12)),
    o = i(n(13)),
    a = i(n(14)),
    l = i(n(15)),
    c = i(n(16)),
    u = i(n(17))
  }, function(t, e, n) {
   "use strict";
   e.__esModule = !0;
   var i = n(5);
   e.default = function(t) {
    t.registerHelper("blockHelperMissing", function(e, n) {
     var r = n.inverse,
      s = n.fn;
     if (!0 === e) return s(this);
     if (!1 === e || null == e) return r(this);
     if (i.isArray(e)) return e.length > 0 ? (n.ids && (n.ids = [n.name]), t.helpers.each(e, n)) : r(this);
     if (n.data && n.ids) {
      var o = i.createFrame(n.data);
      o.contextPath = i.appendContextPath(n.data.contextPath, n.name), n = {
       data: o
      }
     }
     return s(e, n)
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   var i = n(1).default;
   e.__esModule = !0;
   var r = n(5),
    s = i(n(6));
   e.default = function(t) {
    t.registerHelper("each", function(t, e) {
     function n(e, n, s) {
      c && (c.key = e, c.index = n, c.first = 0 === n, c.last = !!s, u && (c.contextPath = u + e)), l += i(t[e], {
       data: c,
       blockParams: r.blockParams([t[e], e], [u + e, null])
      })
     }
     if (!e) throw new s.default("Must pass iterator to #each");
     var i = e.fn,
      o = e.inverse,
      a = 0,
      l = "",
      c = void 0,
      u = void 0;
     if (e.data && e.ids && (u = r.appendContextPath(e.data.contextPath, e.ids[0]) + "."), r.isFunction(t) && (t = t.call(this)), e.data && (c = r.createFrame(e.data)), t && "object" == typeof t)
      if (r.isArray(t))
       for (var h = t.length; a < h; a++) a in t && n(a, a, a === t.length - 1);
      else {
       var p = void 0;
       for (var d in t) t.hasOwnProperty(d) && (void 0 !== p && n(p, a - 1), p = d, a++);
       void 0 !== p && n(p, a - 1, !0)
      }
     return 0 === a && (l = o(this)), l
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   var i = n(1).default;
   e.__esModule = !0;
   var r = i(n(6));
   e.default = function(t) {
    t.registerHelper("helperMissing", function() {
     if (1 !== arguments.length) throw new r.default('Missing helper: "' + arguments[arguments.length - 1].name + '"')
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   e.__esModule = !0;
   var i = n(5);
   e.default = function(t) {
    t.registerHelper("if", function(t, e) {
     return i.isFunction(t) && (t = t.call(this)), !e.hash.includeZero && !t || i.isEmpty(t) ? e.inverse(this) : e.fn(this)
    }), t.registerHelper("unless", function(e, n) {
     return t.helpers.if.call(this, e, {
      fn: n.inverse,
      inverse: n.fn,
      hash: n.hash
     })
    })
   }, t.exports = e.default
  }, function(t, e) {
   "use strict";
   e.__esModule = !0, e.default = function(t) {
    t.registerHelper("log", function() {
     for (var e = [void 0], n = arguments[arguments.length - 1], i = 0; i < arguments.length - 1; i++) e.push(arguments[i]);
     var r = 1;
     null != n.hash.level ? r = n.hash.level : n.data && null != n.data.level && (r = n.data.level), e[0] = r, t.log.apply(t, e)
    })
   }, t.exports = e.default
  }, function(t, e) {
   "use strict";
   e.__esModule = !0, e.default = function(t) {
    t.registerHelper("lookup", function(t, e) {
     return t && t[e]
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   e.__esModule = !0;
   var i = n(5);
   e.default = function(t) {
    t.registerHelper("with", function(t, e) {
     i.isFunction(t) && (t = t.call(this));
     var n = e.fn;
     if (i.isEmpty(t)) return e.inverse(this);
     var r = e.data;
     return e.data && e.ids && ((r = i.createFrame(e.data)).contextPath = i.appendContextPath(e.data.contextPath, e.ids[0])), n(t, {
      data: r,
      blockParams: i.blockParams([t], [r && r.contextPath])
     })
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   var i = n(1).default;
   e.__esModule = !0, e.registerDefaultDecorators = function(t) {
    r.default(t)
   };
   var r = i(n(19))
  }, function(t, e, n) {
   "use strict";
   e.__esModule = !0;
   var i = n(5);
   e.default = function(t) {
    t.registerDecorator("inline", function(t, e, n, r) {
     var s = t;
     return e.partials || (e.partials = {}, s = function(r, s) {
      var o = n.partials;
      n.partials = i.extend({}, o, e.partials);
      var a = t(r, s);
      return n.partials = o, a
     }), e.partials[r.args[0]] = r.fn, s
    })
   }, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   e.__esModule = !0;
   var i = n(5),
    r = {
     methodMap: ["debug", "info", "warn", "error"],
     level: "info",
     lookupLevel: function(t) {
      if ("string" == typeof t) {
       var e = i.indexOf(r.methodMap, t.toLowerCase());
       t = e >= 0 ? e : parseInt(t, 10)
      }
      return t
     },
     log: function(t) {
      if (t = r.lookupLevel(t), "undefined" != typeof console && r.lookupLevel(r.level) <= t) {
       var e = r.methodMap[t];
       console[e] || (e = "log");
       for (var n = arguments.length, i = Array(n > 1 ? n - 1 : 0), s = 1; s < n; s++) i[s - 1] = arguments[s];
       console[e].apply(console, i)
      }
     }
    };
   e.default = r, t.exports = e.default
  }, function(t, e) {
   "use strict";

   function n(t) {
    this.string = t
   }
   e.__esModule = !0, n.prototype.toString = n.prototype.toHTML = function() {
    return "" + this.string
   }, e.default = n, t.exports = e.default
  }, function(t, e, n) {
   "use strict";

   function i(t, e, n, i, r, o, a) {
    function l(e) {
     var r = arguments.length <= 1 || void 0 === arguments[1] ? {} : arguments[1],
      s = a;
     return !a || e == a[0] || e === t.nullContext && null === a[0] || (s = [e].concat(a)), n(t, e, t.helpers, t.partials, r.data || i, o && [r.blockParams].concat(o), s)
    }
    return l = s(n, l, t, a, i, o), l.program = e, l.depth = a ? a.length : 0, l.blockParams = r || 0, l
   }

   function r() {
    return ""
   }

   function s(t, e, n, i, r, s) {
    if (t.decorator) {
     var o = {};
     e = t.decorator(e, o, n, i && i[0], r, s, i), c.extend(e, o)
    }
    return e
   }
   var o = n(23).default,
    a = n(3).default,
    l = n(1).default;
   e.__esModule = !0, e.checkRevision = function(t) {
    var e = t && t[0] || 1,
     n = h.COMPILER_REVISION;
    if (e !== n) {
     if (e < n) {
      var i = h.REVISION_CHANGES[n],
       r = h.REVISION_CHANGES[e];
      throw new u.default("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version (" + i + ") or downgrade your runtime to an older version (" + r + ").")
     }
     throw new u.default("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version (" + t[1] + ").")
    }
   }, e.template = function(t, e) {
    function n(e) {
     function i(e) {
      return "" + t.main(r, e, r.helpers, r.partials, a, c, l)
     }
     var o = arguments.length <= 1 || void 0 === arguments[1] ? {} : arguments[1],
      a = o.data;
     n._setup(o), !o.partial && t.useData && (a = function(t, e) {
      return e && "root" in e || ((e = e ? h.createFrame(e) : {}).root = t), e
     }(e, a));
     var l = void 0,
      c = t.useBlockParams ? [] : void 0;
     return t.useDepths && (l = o.depths ? e != o.depths[0] ? [e].concat(o.depths) : o.depths : [e]), (i = s(t.main, i, r, o.depths || [], a, c))(e, o)
    }
    if (!e) throw new u.default("No environment passed to template");
    if (!t || !t.main) throw new u.default("Unknown template object: " + typeof t);
    t.main.decorator = t.main_d, e.VM.checkRevision(t.compiler);
    var r = {
     strict: function(t, e) {
      if (!(e in t)) throw new u.default('"' + e + '" not defined in ' + t);
      return t[e]
     },
     lookup: function(t, e) {
      for (var n = t.length, i = 0; i < n; i++)
       if (t[i] && null != t[i][e]) return t[i][e]
     },
     lambda: function(t, e) {
      return "function" == typeof t ? t.call(e) : t
     },
     escapeExpression: c.escapeExpression,
     invokePartial: function(n, i, r) {
      r.hash && (i = c.extend({}, i, r.hash), r.ids && (r.ids[0] = !0)), n = e.VM.resolvePartial.call(this, n, i, r);
      var s = e.VM.invokePartial.call(this, n, i, r);
      if (null == s && e.compile && (r.partials[r.name] = e.compile(n, t.compilerOptions, e), s = r.partials[r.name](i, r)), null != s) {
       if (r.indent) {
        for (var o = s.split("\n"), a = 0, l = o.length; a < l && (o[a] || a + 1 !== l); a++) o[a] = r.indent + o[a];
        s = o.join("\n")
       }
       return s
      }
      throw new u.default("The partial " + r.name + " could not be compiled when running in runtime-only mode")
     },
     fn: function(e) {
      var n = t[e];
      return n.decorator = t[e + "_d"], n
     },
     programs: [],
     program: function(t, e, n, r, s) {
      var o = this.programs[t],
       a = this.fn(t);
      return e || s || r || n ? o = i(this, t, a, e, n, r, s) : o || (o = this.programs[t] = i(this, t, a)), o
     },
     data: function(t, e) {
      for (; t && e--;) t = t._parent;
      return t
     },
     merge: function(t, e) {
      var n = t || e;
      return t && e && t !== e && (n = c.extend({}, e, t)), n
     },
     nullContext: o({}),
     noop: e.VM.noop,
     compilerInfo: t.compiler
    };
    return n.isTop = !0, n._setup = function(n) {
     n.partial ? (r.helpers = n.helpers, r.partials = n.partials, r.decorators = n.decorators) : (r.helpers = r.merge(n.helpers, e.helpers), t.usePartial && (r.partials = r.merge(n.partials, e.partials)), (t.usePartial || t.useDecorators) && (r.decorators = r.merge(n.decorators, e.decorators)))
    }, n._child = function(e, n, s, o) {
     if (t.useBlockParams && !s) throw new u.default("must pass block params");
     if (t.useDepths && !o) throw new u.default("must pass parent depths");
     return i(r, e, t[e], n, 0, s, o)
    }, n
   }, e.wrapProgram = i, e.resolvePartial = function(t, e, n) {
    return t ? t.call || n.name || (n.name = t, t = n.partials[t]) : t = "@partial-block" === n.name ? n.data["partial-block"] : n.partials[n.name], t
   }, e.invokePartial = function(t, e, n) {
    var i = n.data && n.data["partial-block"];
    n.partial = !0, n.ids && (n.data.contextPath = n.ids[0] || n.data.contextPath);
    var s = void 0;
    if (n.fn && n.fn !== r && function() {
      n.data = h.createFrame(n.data);
      var t = n.fn;
      s = n.data["partial-block"] = function(e) {
       var n = arguments.length <= 1 || void 0 === arguments[1] ? {} : arguments[1];
       return n.data = h.createFrame(n.data), n.data["partial-block"] = i, t(e, n)
      }, t.partials && (n.partials = c.extend({}, n.partials, t.partials))
     }(), void 0 === t && s && (t = s), void 0 === t) throw new u.default("The partial " + n.name + " could not be found");
    if (t instanceof Function) return t(e, n)
   }, e.noop = r;
   var c = a(n(5)),
    u = l(n(6)),
    h = n(4)
  }, function(t, e, n) {
   t.exports = {
    default: n(24),
    __esModule: !0
   }
  }, function(t, e, n) {
   n(25), t.exports = n(30).Object.seal
  }, function(t, e, n) {
   var i = n(26);
   n(27)("seal", function(t) {
    return function(e) {
     return t && i(e) ? t(e) : e
    }
   })
  }, function(t, e) {
   t.exports = function(t) {
    return "object" == typeof t ? null !== t : "function" == typeof t
   }
  }, function(t, e, n) {
   var i = n(28),
    r = n(30),
    s = n(33);
   t.exports = function(t, e) {
    var n = (r.Object || {})[t] || Object[t],
     o = {};
    o[t] = e(n), i(i.S + i.F * s(function() {
     n(1)
    }), "Object", o)
   }
  }, function(t, e, n) {
   var i = n(29),
    r = n(30),
    s = n(31),
    o = "prototype",
    a = function(t, e, n) {
     var l, c, u, h = t & a.F,
      p = t & a.G,
      d = t & a.S,
      f = t & a.P,
      m = t & a.B,
      g = t & a.W,
      v = p ? r : r[e] || (r[e] = {}),
      y = p ? i : d ? i[e] : (i[e] || {})[o];
     p && (n = e);
     for (l in n)(c = !h && y && l in y) && l in v || (u = c ? y[l] : n[l], v[l] = p && "function" != typeof y[l] ? n[l] : m && c ? s(u, i) : g && y[l] == u ? function(t) {
      var e = function(e) {
       return this instanceof t ? new t(e) : t(e)
      };
      return e[o] = t[o], e
     }(u) : f && "function" == typeof u ? s(Function.call, u) : u, f && ((v[o] || (v[o] = {}))[l] = u))
    };
   a.F = 1, a.G = 2, a.S = 4, a.P = 8, a.B = 16, a.W = 32, t.exports = a
  }, function(t, e) {
   var n = t.exports = "undefined" != typeof window && window.Math == Math ? window : "undefined" != typeof self && self.Math == Math ? self : Function("return this")();
   "number" == typeof __g && (__g = n)
  }, function(t, e) {
   var n = t.exports = {
    version: "1.2.6"
   };
   "number" == typeof __e && (__e = n)
  }, function(t, e, n) {
   var i = n(32);
   t.exports = function(t, e, n) {
    if (i(t), void 0 === e) return t;
    switch (n) {
     case 1:
      return function(n) {
       return t.call(e, n)
      };
     case 2:
      return function(n, i) {
       return t.call(e, n, i)
      };
     case 3:
      return function(n, i, r) {
       return t.call(e, n, i, r)
      }
    }
    return function() {
     return t.apply(e, arguments)
    }
   }
  }, function(t, e) {
   t.exports = function(t) {
    if ("function" != typeof t) throw TypeError(t + " is not a function!");
    return t
   }
  }, function(t, e) {
   t.exports = function(t) {
    try {
     return !!t()
    } catch (t) {
     return !0
    }
   }
  }, function(t, e) {
   (function(n) {
    "use strict";
    e.__esModule = !0, e.default = function(t) {
     var e = void 0 !== n ? n : window,
      i = e.Handlebars;
     t.noConflict = function() {
      return e.Handlebars === t && (e.Handlebars = i), t
     }
    }, t.exports = e.default
   }).call(e, function() {
    return this
   }())
  }, function(t, e) {
   "use strict";
   e.__esModule = !0;
   var n = {
    helpers: {
     helperExpression: function(t) {
      return "SubExpression" === t.type || ("MustacheStatement" === t.type || "BlockStatement" === t.type) && !!(t.params && t.params.length || t.hash)
     },
     scopedId: function(t) {
      return /^\.|this\b/.test(t.original)
     },
     simpleId: function(t) {
      return 1 === t.parts.length && !n.helpers.scopedId(t) && !t.depth
     }
    }
   };
   e.default = n, t.exports = e.default
  }, function(t, e, n) {
   "use strict";
   var i = n(1).default,
    r = n(3).default;
   e.__esModule = !0, e.parse = function(t, e) {
    return "Program" === t.type ? t : (s.default.yy = c, c.locInfo = function(t) {
     return new c.SourceLocation(e && e.srcName, t)
    }, new o.default(e).accept(s.default.parse(t)))
   };
   var s = i(n(37)),
    o = i(n(38)),
    a = r(n(40)),
    l = n(5);
   e.parser = s.default;
   var c = {};
   l.extend(c, a)
  }, function(t, e) {
   "use strict";
   e.__esModule = !0;
   var n = function() {
    function t() {
     this.yy = {}
    }
    var e = {
      trace: function() {},
      yy: {},
      symbols_: {
       error: 2,
       root: 3,
       program: 4,
       EOF: 5,
       program_repetition0: 6,
       statement: 7,
       mustache: 8,
       block: 9,
       rawBlock: 10,
       partial: 11,
       partialBlock: 12,
       content: 13,
       COMMENT: 14,
       CONTENT: 15,
       openRawBlock: 16,
       rawBlock_repetition_plus0: 17,
       END_RAW_BLOCK: 18,
       OPEN_RAW_BLOCK: 19,
       helperName: 20,
       openRawBlock_repetition0: 21,
       openRawBlock_option0: 22,
       CLOSE_RAW_BLOCK: 23,
       openBlock: 24,
       block_option0: 25,
       closeBlock: 26,
       openInverse: 27,
       block_option1: 28,
       OPEN_BLOCK: 29,
       openBlock_repetition0: 30,
       openBlock_option0: 31,
       openBlock_option1: 32,
       CLOSE: 33,
       OPEN_INVERSE: 34,
       openInverse_repetition0: 35,
       openInverse_option0: 36,
       openInverse_option1: 37,
       openInverseChain: 38,
       OPEN_INVERSE_CHAIN: 39,
       openInverseChain_repetition0: 40,
       openInverseChain_option0: 41,
       openInverseChain_option1: 42,
       inverseAndProgram: 43,
       INVERSE: 44,
       inverseChain: 45,
       inverseChain_option0: 46,
       OPEN_ENDBLOCK: 47,
       OPEN: 48,
       mustache_repetition0: 49,
       mustache_option0: 50,
       OPEN_UNESCAPED: 51,
       mustache_repetition1: 52,
       mustache_option1: 53,
       CLOSE_UNESCAPED: 54,
       OPEN_PARTIAL: 55,
       partialName: 56,
       partial_repetition0: 57,
       partial_option0: 58,
       openPartialBlock: 59,
       OPEN_PARTIAL_BLOCK: 60,
       openPartialBlock_repetition0: 61,
       openPartialBlock_option0: 62,
       param: 63,
       sexpr: 64,
       OPEN_SEXPR: 65,
       sexpr_repetition0: 66,
       sexpr_option0: 67,
       CLOSE_SEXPR: 68,
       hash: 69,
       hash_repetition_plus0: 70,
       hashSegment: 71,
       ID: 72,
       EQUALS: 73,
       blockParams: 74,
       OPEN_BLOCK_PARAMS: 75,
       blockParams_repetition_plus0: 76,
       CLOSE_BLOCK_PARAMS: 77,
       path: 78,
       dataName: 79,
       STRING: 80,
       NUMBER: 81,
       BOOLEAN: 82,
       UNDEFINED: 83,
       NULL: 84,
       DATA: 85,
       pathSegments: 86,
       SEP: 87,
       $accept: 0,
       $end: 1
      },
      terminals_: {
       2: "error",
       5: "EOF",
       14: "COMMENT",
       15: "CONTENT",
       18: "END_RAW_BLOCK",
       19: "OPEN_RAW_BLOCK",
       23: "CLOSE_RAW_BLOCK",
       29: "OPEN_BLOCK",
       33: "CLOSE",
       34: "OPEN_INVERSE",
       39: "OPEN_INVERSE_CHAIN",
       44: "INVERSE",
       47: "OPEN_ENDBLOCK",
       48: "OPEN",
       51: "OPEN_UNESCAPED",
       54: "CLOSE_UNESCAPED",
       55: "OPEN_PARTIAL",
       60: "OPEN_PARTIAL_BLOCK",
       65: "OPEN_SEXPR",
       68: "CLOSE_SEXPR",
       72: "ID",
       73: "EQUALS",
       75: "OPEN_BLOCK_PARAMS",
       77: "CLOSE_BLOCK_PARAMS",
       80: "STRING",
       81: "NUMBER",
       82: "BOOLEAN",
       83: "UNDEFINED",
       84: "NULL",
       85: "DATA",
       87: "SEP"
      },
      productions_: [0, [3, 2],
       [4, 1],
       [7, 1],
       [7, 1],
       [7, 1],
       [7, 1],
       [7, 1],
       [7, 1],
       [7, 1],
       [13, 1],
       [10, 3],
       [16, 5],
       [9, 4],
       [9, 4],
       [24, 6],
       [27, 6],
       [38, 6],
       [43, 2],
       [45, 3],
       [45, 1],
       [26, 3],
       [8, 5],
       [8, 5],
       [11, 5],
       [12, 3],
       [59, 5],
       [63, 1],
       [63, 1],
       [64, 5],
       [69, 1],
       [71, 3],
       [74, 3],
       [20, 1],
       [20, 1],
       [20, 1],
       [20, 1],
       [20, 1],
       [20, 1],
       [20, 1],
       [56, 1],
       [56, 1],
       [79, 2],
       [78, 1],
       [86, 3],
       [86, 1],
       [6, 0],
       [6, 2],
       [17, 1],
       [17, 2],
       [21, 0],
       [21, 2],
       [22, 0],
       [22, 1],
       [25, 0],
       [25, 1],
       [28, 0],
       [28, 1],
       [30, 0],
       [30, 2],
       [31, 0],
       [31, 1],
       [32, 0],
       [32, 1],
       [35, 0],
       [35, 2],
       [36, 0],
       [36, 1],
       [37, 0],
       [37, 1],
       [40, 0],
       [40, 2],
       [41, 0],
       [41, 1],
       [42, 0],
       [42, 1],
       [46, 0],
       [46, 1],
       [49, 0],
       [49, 2],
       [50, 0],
       [50, 1],
       [52, 0],
       [52, 2],
       [53, 0],
       [53, 1],
       [57, 0],
       [57, 2],
       [58, 0],
       [58, 1],
       [61, 0],
       [61, 2],
       [62, 0],
       [62, 1],
       [66, 0],
       [66, 2],
       [67, 0],
       [67, 1],
       [70, 1],
       [70, 2],
       [76, 1],
       [76, 2]
      ],
      performAction: function(t, e, n, i, r, s, o) {
       var a = s.length - 1;
       switch (r) {
        case 1:
         return s[a - 1];
        case 2:
         this.$ = i.prepareProgram(s[a]);
         break;
        case 3:
        case 4:
        case 5:
        case 6:
        case 7:
        case 8:
         this.$ = s[a];
         break;
        case 9:
         this.$ = {
          type: "CommentStatement",
          value: i.stripComment(s[a]),
          strip: i.stripFlags(s[a], s[a]),
          loc: i.locInfo(this._$)
         };
         break;
        case 10:
         this.$ = {
          type: "ContentStatement",
          original: s[a],
          value: s[a],
          loc: i.locInfo(this._$)
         };
         break;
        case 11:
         this.$ = i.prepareRawBlock(s[a - 2], s[a - 1], s[a], this._$);
         break;
        case 12:
         this.$ = {
          path: s[a - 3],
          params: s[a - 2],
          hash: s[a - 1]
         };
         break;
        case 13:
         this.$ = i.prepareBlock(s[a - 3], s[a - 2], s[a - 1], s[a], !1, this._$);
         break;
        case 14:
         this.$ = i.prepareBlock(s[a - 3], s[a - 2], s[a - 1], s[a], !0, this._$);
         break;
        case 15:
         this.$ = {
          open: s[a - 5],
          path: s[a - 4],
          params: s[a - 3],
          hash: s[a - 2],
          blockParams: s[a - 1],
          strip: i.stripFlags(s[a - 5], s[a])
         };
         break;
        case 16:
        case 17:
         this.$ = {
          path: s[a - 4],
          params: s[a - 3],
          hash: s[a - 2],
          blockParams: s[a - 1],
          strip: i.stripFlags(s[a - 5], s[a])
         };
         break;
        case 18:
         this.$ = {
          strip: i.stripFlags(s[a - 1], s[a - 1]),
          program: s[a]
         };
         break;
        case 19:
         var l = i.prepareBlock(s[a - 2], s[a - 1], s[a], s[a], !1, this._$),
          c = i.prepareProgram([l], s[a - 1].loc);
         c.chained = !0, this.$ = {
          strip: s[a - 2].strip,
          program: c,
          chain: !0
         };
         break;
        case 20:
         this.$ = s[a];
         break;
        case 21:
         this.$ = {
          path: s[a - 1],
          strip: i.stripFlags(s[a - 2], s[a])
         };
         break;
        case 22:
        case 23:
         this.$ = i.prepareMustache(s[a - 3], s[a - 2], s[a - 1], s[a - 4], i.stripFlags(s[a - 4], s[a]), this._$);
         break;
        case 24:
         this.$ = {
          type: "PartialStatement",
          name: s[a - 3],
          params: s[a - 2],
          hash: s[a - 1],
          indent: "",
          strip: i.stripFlags(s[a - 4], s[a]),
          loc: i.locInfo(this._$)
         };
         break;
        case 25:
         this.$ = i.preparePartialBlock(s[a - 2], s[a - 1], s[a], this._$);
         break;
        case 26:
         this.$ = {
          path: s[a - 3],
          params: s[a - 2],
          hash: s[a - 1],
          strip: i.stripFlags(s[a - 4], s[a])
         };
         break;
        case 27:
        case 28:
         this.$ = s[a];
         break;
        case 29:
         this.$ = {
          type: "SubExpression",
          path: s[a - 3],
          params: s[a - 2],
          hash: s[a - 1],
          loc: i.locInfo(this._$)
         };
         break;
        case 30:
         this.$ = {
          type: "Hash",
          pairs: s[a],
          loc: i.locInfo(this._$)
         };
         break;
        case 31:
         this.$ = {
          type: "HashPair",
          key: i.id(s[a - 2]),
          value: s[a],
          loc: i.locInfo(this._$)
         };
         break;
        case 32:
         this.$ = i.id(s[a - 1]);
         break;
        case 33:
        case 34:
         this.$ = s[a];
         break;
        case 35:
         this.$ = {
          type: "StringLiteral",
          value: s[a],
          original: s[a],
          loc: i.locInfo(this._$)
         };
         break;
        case 36:
         this.$ = {
          type: "NumberLiteral",
          value: Number(s[a]),
          original: Number(s[a]),
          loc: i.locInfo(this._$)
         };
         break;
        case 37:
         this.$ = {
          type: "BooleanLiteral",
          value: "true" === s[a],
          original: "true" === s[a],
          loc: i.locInfo(this._$)
         };
         break;
        case 38:
         this.$ = {
          type: "UndefinedLiteral",
          original: void 0,
          value: void 0,
          loc: i.locInfo(this._$)
         };
         break;
        case 39:
         this.$ = {
          type: "NullLiteral",
          original: null,
          value: null,
          loc: i.locInfo(this._$)
         };
         break;
        case 40:
        case 41:
         this.$ = s[a];
         break;
        case 42:
         this.$ = i.preparePath(!0, s[a], this._$);
         break;
        case 43:
         this.$ = i.preparePath(!1, s[a], this._$);
         break;
        case 44:
         s[a - 2].push({
          part: i.id(s[a]),
          original: s[a],
          separator: s[a - 1]
         }), this.$ = s[a - 2];
         break;
        case 45:
         this.$ = [{
          part: i.id(s[a]),
          original: s[a]
         }];
         break;
        case 46:
         this.$ = [];
         break;
        case 47:
         s[a - 1].push(s[a]);
         break;
        case 48:
         this.$ = [s[a]];
         break;
        case 49:
         s[a - 1].push(s[a]);
         break;
        case 50:
         this.$ = [];
         break;
        case 51:
         s[a - 1].push(s[a]);
         break;
        case 58:
         this.$ = [];
         break;
        case 59:
         s[a - 1].push(s[a]);
         break;
        case 64:
         this.$ = [];
         break;
        case 65:
         s[a - 1].push(s[a]);
         break;
        case 70:
         this.$ = [];
         break;
        case 71:
         s[a - 1].push(s[a]);
         break;
        case 78:
         this.$ = [];
         break;
        case 79:
         s[a - 1].push(s[a]);
         break;
        case 82:
         this.$ = [];
         break;
        case 83:
         s[a - 1].push(s[a]);
         break;
        case 86:
         this.$ = [];
         break;
        case 87:
         s[a - 1].push(s[a]);
         break;
        case 90:
         this.$ = [];
         break;
        case 91:
         s[a - 1].push(s[a]);
         break;
        case 94:
         this.$ = [];
         break;
        case 95:
         s[a - 1].push(s[a]);
         break;
        case 98:
         this.$ = [s[a]];
         break;
        case 99:
         s[a - 1].push(s[a]);
         break;
        case 100:
         this.$ = [s[a]];
         break;
        case 101:
         s[a - 1].push(s[a])
       }
      },
      table: [{
       3: 1,
       4: 2,
       5: [2, 46],
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       1: [3]
      }, {
       5: [1, 4]
      }, {
       5: [2, 2],
       7: 5,
       8: 6,
       9: 7,
       10: 8,
       11: 9,
       12: 10,
       13: 11,
       14: [1, 12],
       15: [1, 20],
       16: 17,
       19: [1, 23],
       24: 15,
       27: 16,
       29: [1, 21],
       34: [1, 22],
       39: [2, 2],
       44: [2, 2],
       47: [2, 2],
       48: [1, 13],
       51: [1, 14],
       55: [1, 18],
       59: 19,
       60: [1, 24]
      }, {
       1: [2, 1]
      }, {
       5: [2, 47],
       14: [2, 47],
       15: [2, 47],
       19: [2, 47],
       29: [2, 47],
       34: [2, 47],
       39: [2, 47],
       44: [2, 47],
       47: [2, 47],
       48: [2, 47],
       51: [2, 47],
       55: [2, 47],
       60: [2, 47]
      }, {
       5: [2, 3],
       14: [2, 3],
       15: [2, 3],
       19: [2, 3],
       29: [2, 3],
       34: [2, 3],
       39: [2, 3],
       44: [2, 3],
       47: [2, 3],
       48: [2, 3],
       51: [2, 3],
       55: [2, 3],
       60: [2, 3]
      }, {
       5: [2, 4],
       14: [2, 4],
       15: [2, 4],
       19: [2, 4],
       29: [2, 4],
       34: [2, 4],
       39: [2, 4],
       44: [2, 4],
       47: [2, 4],
       48: [2, 4],
       51: [2, 4],
       55: [2, 4],
       60: [2, 4]
      }, {
       5: [2, 5],
       14: [2, 5],
       15: [2, 5],
       19: [2, 5],
       29: [2, 5],
       34: [2, 5],
       39: [2, 5],
       44: [2, 5],
       47: [2, 5],
       48: [2, 5],
       51: [2, 5],
       55: [2, 5],
       60: [2, 5]
      }, {
       5: [2, 6],
       14: [2, 6],
       15: [2, 6],
       19: [2, 6],
       29: [2, 6],
       34: [2, 6],
       39: [2, 6],
       44: [2, 6],
       47: [2, 6],
       48: [2, 6],
       51: [2, 6],
       55: [2, 6],
       60: [2, 6]
      }, {
       5: [2, 7],
       14: [2, 7],
       15: [2, 7],
       19: [2, 7],
       29: [2, 7],
       34: [2, 7],
       39: [2, 7],
       44: [2, 7],
       47: [2, 7],
       48: [2, 7],
       51: [2, 7],
       55: [2, 7],
       60: [2, 7]
      }, {
       5: [2, 8],
       14: [2, 8],
       15: [2, 8],
       19: [2, 8],
       29: [2, 8],
       34: [2, 8],
       39: [2, 8],
       44: [2, 8],
       47: [2, 8],
       48: [2, 8],
       51: [2, 8],
       55: [2, 8],
       60: [2, 8]
      }, {
       5: [2, 9],
       14: [2, 9],
       15: [2, 9],
       19: [2, 9],
       29: [2, 9],
       34: [2, 9],
       39: [2, 9],
       44: [2, 9],
       47: [2, 9],
       48: [2, 9],
       51: [2, 9],
       55: [2, 9],
       60: [2, 9]
      }, {
       20: 25,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 36,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       4: 37,
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       39: [2, 46],
       44: [2, 46],
       47: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       4: 38,
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       44: [2, 46],
       47: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       13: 40,
       15: [1, 20],
       17: 39
      }, {
       20: 42,
       56: 41,
       64: 43,
       65: [1, 44],
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       4: 45,
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       47: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       5: [2, 10],
       14: [2, 10],
       15: [2, 10],
       18: [2, 10],
       19: [2, 10],
       29: [2, 10],
       34: [2, 10],
       39: [2, 10],
       44: [2, 10],
       47: [2, 10],
       48: [2, 10],
       51: [2, 10],
       55: [2, 10],
       60: [2, 10]
      }, {
       20: 46,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 47,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 48,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 42,
       56: 49,
       64: 43,
       65: [1, 44],
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       33: [2, 78],
       49: 50,
       65: [2, 78],
       72: [2, 78],
       80: [2, 78],
       81: [2, 78],
       82: [2, 78],
       83: [2, 78],
       84: [2, 78],
       85: [2, 78]
      }, {
       23: [2, 33],
       33: [2, 33],
       54: [2, 33],
       65: [2, 33],
       68: [2, 33],
       72: [2, 33],
       75: [2, 33],
       80: [2, 33],
       81: [2, 33],
       82: [2, 33],
       83: [2, 33],
       84: [2, 33],
       85: [2, 33]
      }, {
       23: [2, 34],
       33: [2, 34],
       54: [2, 34],
       65: [2, 34],
       68: [2, 34],
       72: [2, 34],
       75: [2, 34],
       80: [2, 34],
       81: [2, 34],
       82: [2, 34],
       83: [2, 34],
       84: [2, 34],
       85: [2, 34]
      }, {
       23: [2, 35],
       33: [2, 35],
       54: [2, 35],
       65: [2, 35],
       68: [2, 35],
       72: [2, 35],
       75: [2, 35],
       80: [2, 35],
       81: [2, 35],
       82: [2, 35],
       83: [2, 35],
       84: [2, 35],
       85: [2, 35]
      }, {
       23: [2, 36],
       33: [2, 36],
       54: [2, 36],
       65: [2, 36],
       68: [2, 36],
       72: [2, 36],
       75: [2, 36],
       80: [2, 36],
       81: [2, 36],
       82: [2, 36],
       83: [2, 36],
       84: [2, 36],
       85: [2, 36]
      }, {
       23: [2, 37],
       33: [2, 37],
       54: [2, 37],
       65: [2, 37],
       68: [2, 37],
       72: [2, 37],
       75: [2, 37],
       80: [2, 37],
       81: [2, 37],
       82: [2, 37],
       83: [2, 37],
       84: [2, 37],
       85: [2, 37]
      }, {
       23: [2, 38],
       33: [2, 38],
       54: [2, 38],
       65: [2, 38],
       68: [2, 38],
       72: [2, 38],
       75: [2, 38],
       80: [2, 38],
       81: [2, 38],
       82: [2, 38],
       83: [2, 38],
       84: [2, 38],
       85: [2, 38]
      }, {
       23: [2, 39],
       33: [2, 39],
       54: [2, 39],
       65: [2, 39],
       68: [2, 39],
       72: [2, 39],
       75: [2, 39],
       80: [2, 39],
       81: [2, 39],
       82: [2, 39],
       83: [2, 39],
       84: [2, 39],
       85: [2, 39]
      }, {
       23: [2, 43],
       33: [2, 43],
       54: [2, 43],
       65: [2, 43],
       68: [2, 43],
       72: [2, 43],
       75: [2, 43],
       80: [2, 43],
       81: [2, 43],
       82: [2, 43],
       83: [2, 43],
       84: [2, 43],
       85: [2, 43],
       87: [1, 51]
      }, {
       72: [1, 35],
       86: 52
      }, {
       23: [2, 45],
       33: [2, 45],
       54: [2, 45],
       65: [2, 45],
       68: [2, 45],
       72: [2, 45],
       75: [2, 45],
       80: [2, 45],
       81: [2, 45],
       82: [2, 45],
       83: [2, 45],
       84: [2, 45],
       85: [2, 45],
       87: [2, 45]
      }, {
       52: 53,
       54: [2, 82],
       65: [2, 82],
       72: [2, 82],
       80: [2, 82],
       81: [2, 82],
       82: [2, 82],
       83: [2, 82],
       84: [2, 82],
       85: [2, 82]
      }, {
       25: 54,
       38: 56,
       39: [1, 58],
       43: 57,
       44: [1, 59],
       45: 55,
       47: [2, 54]
      }, {
       28: 60,
       43: 61,
       44: [1, 59],
       47: [2, 56]
      }, {
       13: 63,
       15: [1, 20],
       18: [1, 62]
      }, {
       15: [2, 48],
       18: [2, 48]
      }, {
       33: [2, 86],
       57: 64,
       65: [2, 86],
       72: [2, 86],
       80: [2, 86],
       81: [2, 86],
       82: [2, 86],
       83: [2, 86],
       84: [2, 86],
       85: [2, 86]
      }, {
       33: [2, 40],
       65: [2, 40],
       72: [2, 40],
       80: [2, 40],
       81: [2, 40],
       82: [2, 40],
       83: [2, 40],
       84: [2, 40],
       85: [2, 40]
      }, {
       33: [2, 41],
       65: [2, 41],
       72: [2, 41],
       80: [2, 41],
       81: [2, 41],
       82: [2, 41],
       83: [2, 41],
       84: [2, 41],
       85: [2, 41]
      }, {
       20: 65,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       26: 66,
       47: [1, 67]
      }, {
       30: 68,
       33: [2, 58],
       65: [2, 58],
       72: [2, 58],
       75: [2, 58],
       80: [2, 58],
       81: [2, 58],
       82: [2, 58],
       83: [2, 58],
       84: [2, 58],
       85: [2, 58]
      }, {
       33: [2, 64],
       35: 69,
       65: [2, 64],
       72: [2, 64],
       75: [2, 64],
       80: [2, 64],
       81: [2, 64],
       82: [2, 64],
       83: [2, 64],
       84: [2, 64],
       85: [2, 64]
      }, {
       21: 70,
       23: [2, 50],
       65: [2, 50],
       72: [2, 50],
       80: [2, 50],
       81: [2, 50],
       82: [2, 50],
       83: [2, 50],
       84: [2, 50],
       85: [2, 50]
      }, {
       33: [2, 90],
       61: 71,
       65: [2, 90],
       72: [2, 90],
       80: [2, 90],
       81: [2, 90],
       82: [2, 90],
       83: [2, 90],
       84: [2, 90],
       85: [2, 90]
      }, {
       20: 75,
       33: [2, 80],
       50: 72,
       63: 73,
       64: 76,
       65: [1, 44],
       69: 74,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       72: [1, 80]
      }, {
       23: [2, 42],
       33: [2, 42],
       54: [2, 42],
       65: [2, 42],
       68: [2, 42],
       72: [2, 42],
       75: [2, 42],
       80: [2, 42],
       81: [2, 42],
       82: [2, 42],
       83: [2, 42],
       84: [2, 42],
       85: [2, 42],
       87: [1, 51]
      }, {
       20: 75,
       53: 81,
       54: [2, 84],
       63: 82,
       64: 76,
       65: [1, 44],
       69: 83,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       26: 84,
       47: [1, 67]
      }, {
       47: [2, 55]
      }, {
       4: 85,
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       39: [2, 46],
       44: [2, 46],
       47: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       47: [2, 20]
      }, {
       20: 86,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       4: 87,
       6: 3,
       14: [2, 46],
       15: [2, 46],
       19: [2, 46],
       29: [2, 46],
       34: [2, 46],
       47: [2, 46],
       48: [2, 46],
       51: [2, 46],
       55: [2, 46],
       60: [2, 46]
      }, {
       26: 88,
       47: [1, 67]
      }, {
       47: [2, 57]
      }, {
       5: [2, 11],
       14: [2, 11],
       15: [2, 11],
       19: [2, 11],
       29: [2, 11],
       34: [2, 11],
       39: [2, 11],
       44: [2, 11],
       47: [2, 11],
       48: [2, 11],
       51: [2, 11],
       55: [2, 11],
       60: [2, 11]
      }, {
       15: [2, 49],
       18: [2, 49]
      }, {
       20: 75,
       33: [2, 88],
       58: 89,
       63: 90,
       64: 76,
       65: [1, 44],
       69: 91,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       65: [2, 94],
       66: 92,
       68: [2, 94],
       72: [2, 94],
       80: [2, 94],
       81: [2, 94],
       82: [2, 94],
       83: [2, 94],
       84: [2, 94],
       85: [2, 94]
      }, {
       5: [2, 25],
       14: [2, 25],
       15: [2, 25],
       19: [2, 25],
       29: [2, 25],
       34: [2, 25],
       39: [2, 25],
       44: [2, 25],
       47: [2, 25],
       48: [2, 25],
       51: [2, 25],
       55: [2, 25],
       60: [2, 25]
      }, {
       20: 93,
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 75,
       31: 94,
       33: [2, 60],
       63: 95,
       64: 76,
       65: [1, 44],
       69: 96,
       70: 77,
       71: 78,
       72: [1, 79],
       75: [2, 60],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 75,
       33: [2, 66],
       36: 97,
       63: 98,
       64: 76,
       65: [1, 44],
       69: 99,
       70: 77,
       71: 78,
       72: [1, 79],
       75: [2, 66],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 75,
       22: 100,
       23: [2, 52],
       63: 101,
       64: 76,
       65: [1, 44],
       69: 102,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       20: 75,
       33: [2, 92],
       62: 103,
       63: 104,
       64: 76,
       65: [1, 44],
       69: 105,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       33: [1, 106]
      }, {
       33: [2, 79],
       65: [2, 79],
       72: [2, 79],
       80: [2, 79],
       81: [2, 79],
       82: [2, 79],
       83: [2, 79],
       84: [2, 79],
       85: [2, 79]
      }, {
       33: [2, 81]
      }, {
       23: [2, 27],
       33: [2, 27],
       54: [2, 27],
       65: [2, 27],
       68: [2, 27],
       72: [2, 27],
       75: [2, 27],
       80: [2, 27],
       81: [2, 27],
       82: [2, 27],
       83: [2, 27],
       84: [2, 27],
       85: [2, 27]
      }, {
       23: [2, 28],
       33: [2, 28],
       54: [2, 28],
       65: [2, 28],
       68: [2, 28],
       72: [2, 28],
       75: [2, 28],
       80: [2, 28],
       81: [2, 28],
       82: [2, 28],
       83: [2, 28],
       84: [2, 28],
       85: [2, 28]
      }, {
       23: [2, 30],
       33: [2, 30],
       54: [2, 30],
       68: [2, 30],
       71: 107,
       72: [1, 108],
       75: [2, 30]
      }, {
       23: [2, 98],
       33: [2, 98],
       54: [2, 98],
       68: [2, 98],
       72: [2, 98],
       75: [2, 98]
      }, {
       23: [2, 45],
       33: [2, 45],
       54: [2, 45],
       65: [2, 45],
       68: [2, 45],
       72: [2, 45],
       73: [1, 109],
       75: [2, 45],
       80: [2, 45],
       81: [2, 45],
       82: [2, 45],
       83: [2, 45],
       84: [2, 45],
       85: [2, 45],
       87: [2, 45]
      }, {
       23: [2, 44],
       33: [2, 44],
       54: [2, 44],
       65: [2, 44],
       68: [2, 44],
       72: [2, 44],
       75: [2, 44],
       80: [2, 44],
       81: [2, 44],
       82: [2, 44],
       83: [2, 44],
       84: [2, 44],
       85: [2, 44],
       87: [2, 44]
      }, {
       54: [1, 110]
      }, {
       54: [2, 83],
       65: [2, 83],
       72: [2, 83],
       80: [2, 83],
       81: [2, 83],
       82: [2, 83],
       83: [2, 83],
       84: [2, 83],
       85: [2, 83]
      }, {
       54: [2, 85]
      }, {
       5: [2, 13],
       14: [2, 13],
       15: [2, 13],
       19: [2, 13],
       29: [2, 13],
       34: [2, 13],
       39: [2, 13],
       44: [2, 13],
       47: [2, 13],
       48: [2, 13],
       51: [2, 13],
       55: [2, 13],
       60: [2, 13]
      }, {
       38: 56,
       39: [1, 58],
       43: 57,
       44: [1, 59],
       45: 112,
       46: 111,
       47: [2, 76]
      }, {
       33: [2, 70],
       40: 113,
       65: [2, 70],
       72: [2, 70],
       75: [2, 70],
       80: [2, 70],
       81: [2, 70],
       82: [2, 70],
       83: [2, 70],
       84: [2, 70],
       85: [2, 70]
      }, {
       47: [2, 18]
      }, {
       5: [2, 14],
       14: [2, 14],
       15: [2, 14],
       19: [2, 14],
       29: [2, 14],
       34: [2, 14],
       39: [2, 14],
       44: [2, 14],
       47: [2, 14],
       48: [2, 14],
       51: [2, 14],
       55: [2, 14],
       60: [2, 14]
      }, {
       33: [1, 114]
      }, {
       33: [2, 87],
       65: [2, 87],
       72: [2, 87],
       80: [2, 87],
       81: [2, 87],
       82: [2, 87],
       83: [2, 87],
       84: [2, 87],
       85: [2, 87]
      }, {
       33: [2, 89]
      }, {
       20: 75,
       63: 116,
       64: 76,
       65: [1, 44],
       67: 115,
       68: [2, 96],
       69: 117,
       70: 77,
       71: 78,
       72: [1, 79],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       33: [1, 118]
      }, {
       32: 119,
       33: [2, 62],
       74: 120,
       75: [1, 121]
      }, {
       33: [2, 59],
       65: [2, 59],
       72: [2, 59],
       75: [2, 59],
       80: [2, 59],
       81: [2, 59],
       82: [2, 59],
       83: [2, 59],
       84: [2, 59],
       85: [2, 59]
      }, {
       33: [2, 61],
       75: [2, 61]
      }, {
       33: [2, 68],
       37: 122,
       74: 123,
       75: [1, 121]
      }, {
       33: [2, 65],
       65: [2, 65],
       72: [2, 65],
       75: [2, 65],
       80: [2, 65],
       81: [2, 65],
       82: [2, 65],
       83: [2, 65],
       84: [2, 65],
       85: [2, 65]
      }, {
       33: [2, 67],
       75: [2, 67]
      }, {
       23: [1, 124]
      }, {
       23: [2, 51],
       65: [2, 51],
       72: [2, 51],
       80: [2, 51],
       81: [2, 51],
       82: [2, 51],
       83: [2, 51],
       84: [2, 51],
       85: [2, 51]
      }, {
       23: [2, 53]
      }, {
       33: [1, 125]
      }, {
       33: [2, 91],
       65: [2, 91],
       72: [2, 91],
       80: [2, 91],
       81: [2, 91],
       82: [2, 91],
       83: [2, 91],
       84: [2, 91],
       85: [2, 91]
      }, {
       33: [2, 93]
      }, {
       5: [2, 22],
       14: [2, 22],
       15: [2, 22],
       19: [2, 22],
       29: [2, 22],
       34: [2, 22],
       39: [2, 22],
       44: [2, 22],
       47: [2, 22],
       48: [2, 22],
       51: [2, 22],
       55: [2, 22],
       60: [2, 22]
      }, {
       23: [2, 99],
       33: [2, 99],
       54: [2, 99],
       68: [2, 99],
       72: [2, 99],
       75: [2, 99]
      }, {
       73: [1, 109]
      }, {
       20: 75,
       63: 126,
       64: 76,
       65: [1, 44],
       72: [1, 35],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       5: [2, 23],
       14: [2, 23],
       15: [2, 23],
       19: [2, 23],
       29: [2, 23],
       34: [2, 23],
       39: [2, 23],
       44: [2, 23],
       47: [2, 23],
       48: [2, 23],
       51: [2, 23],
       55: [2, 23],
       60: [2, 23]
      }, {
       47: [2, 19]
      }, {
       47: [2, 77]
      }, {
       20: 75,
       33: [2, 72],
       41: 127,
       63: 128,
       64: 76,
       65: [1, 44],
       69: 129,
       70: 77,
       71: 78,
       72: [1, 79],
       75: [2, 72],
       78: 26,
       79: 27,
       80: [1, 28],
       81: [1, 29],
       82: [1, 30],
       83: [1, 31],
       84: [1, 32],
       85: [1, 34],
       86: 33
      }, {
       5: [2, 24],
       14: [2, 24],
       15: [2, 24],
       19: [2, 24],
       29: [2, 24],
       34: [2, 24],
       39: [2, 24],
       44: [2, 24],
       47: [2, 24],
       48: [2, 24],
       51: [2, 24],
       55: [2, 24],
       60: [2, 24]
      }, {
       68: [1, 130]
      }, {
       65: [2, 95],
       68: [2, 95],
       72: [2, 95],
       80: [2, 95],
       81: [2, 95],
       82: [2, 95],
       83: [2, 95],
       84: [2, 95],
       85: [2, 95]
      }, {
       68: [2, 97]
      }, {
       5: [2, 21],
       14: [2, 21],
       15: [2, 21],
       19: [2, 21],
       29: [2, 21],
       34: [2, 21],
       39: [2, 21],
       44: [2, 21],
       47: [2, 21],
       48: [2, 21],
       51: [2, 21],
       55: [2, 21],
       60: [2, 21]
      }, {
       33: [1, 131]
      }, {
       33: [2, 63]
      }, {
       72: [1, 133],
       76: 132
      }, {
       33: [1, 134]
      }, {
       33: [2, 69]
      }, {
       15: [2, 12]
      }, {
       14: [2, 26],
       15: [2, 26],
       19: [2, 26],
       29: [2, 26],
       34: [2, 26],
       47: [2, 26],
       48: [2, 26],
       51: [2, 26],
       55: [2, 26],
       60: [2, 26]
      }, {
       23: [2, 31],
       33: [2, 31],
       54: [2, 31],
       68: [2, 31],
       72: [2, 31],
       75: [2, 31]
      }, {
       33: [2, 74],
       42: 135,
       74: 136,
       75: [1, 121]
      }, {
       33: [2, 71],
       65: [2, 71],
       72: [2, 71],
       75: [2, 71],
       80: [2, 71],
       81: [2, 71],
       82: [2, 71],
       83: [2, 71],
       84: [2, 71],
       85: [2, 71]
      }, {
       33: [2, 73],
       75: [2, 73]
      }, {
       23: [2, 29],
       33: [2, 29],
       54: [2, 29],
       65: [2, 29],
       68: [2, 29],
       72: [2, 29],
       75: [2, 29],
       80: [2, 29],
       81: [2, 29],
       82: [2, 29],
       83: [2, 29],
       84: [2, 29],
       85: [2, 29]
      }, {
       14: [2, 15],
       15: [2, 15],
       19: [2, 15],
       29: [2, 15],
       34: [2, 15],
       39: [2, 15],
       44: [2, 15],
       47: [2, 15],
       48: [2, 15],
       51: [2, 15],
       55: [2, 15],
       60: [2, 15]
      }, {
       72: [1, 138],
       77: [1, 137]
      }, {
       72: [2, 100],
       77: [2, 100]
      }, {
       14: [2, 16],
       15: [2, 16],
       19: [2, 16],
       29: [2, 16],
       34: [2, 16],
       44: [2, 16],
       47: [2, 16],
       48: [2, 16],
       51: [2, 16],
       55: [2, 16],
       60: [2, 16]
      }, {
       33: [1, 139]
      }, {
       33: [2, 75]
      }, {
       33: [2, 32]
      }, {
       72: [2, 101],
       77: [2, 101]
      }, {
       14: [2, 17],
       15: [2, 17],
       19: [2, 17],
       29: [2, 17],
       34: [2, 17],
       39: [2, 17],
       44: [2, 17],
       47: [2, 17],
       48: [2, 17],
       51: [2, 17],
       55: [2, 17],
       60: [2, 17]
      }],
      defaultActions: {
       4: [2, 1],
       55: [2, 55],
       57: [2, 20],
       61: [2, 57],
       74: [2, 81],
       83: [2, 85],
       87: [2, 18],
       91: [2, 89],
       102: [2, 53],
       105: [2, 93],
       111: [2, 19],
       112: [2, 77],
       117: [2, 97],
       120: [2, 63],
       123: [2, 69],
       124: [2, 12],
       136: [2, 75],
       137: [2, 32]
      },
      parseError: function(t, e) {
       throw new Error(t)
      },
      parse: function(t) {
       function e() {
        var t;
        return "number" != typeof(t = n.lexer.lex() || 1) && (t = n.symbols_[t] || t), t
       }
       var n = this,
        i = [0],
        r = [null],
        s = [],
        o = this.table,
        a = "",
        l = 0,
        c = 0,
        u = 0;
       this.lexer.setInput(t), this.lexer.yy = this.yy, this.yy.lexer = this.lexer, this.yy.parser = this, void 0 === this.lexer.yylloc && (this.lexer.yylloc = {});
       var h = this.lexer.yylloc;
       s.push(h);
       var p = this.lexer.options && this.lexer.options.ranges;
       "function" == typeof this.yy.parseError && (this.parseError = this.yy.parseError);
       for (var d, f, m, g, v, y, b, x, w, k = {};;) {
        if (m = i[i.length - 1], this.defaultActions[m] ? g = this.defaultActions[m] : (null !== d && void 0 !== d || (d = e()), g = o[m] && o[m][d]), void 0 === g || !g.length || !g[0]) {
         var S = "";
         if (!u) {
          w = [];
          for (y in o[m]) this.terminals_[y] && y > 2 && w.push("'" + this.terminals_[y] + "'");
          S = this.lexer.showPosition ? "Parse error on line " + (l + 1) + ":\n" + this.lexer.showPosition() + "\nExpecting " + w.join(", ") + ", got '" + (this.terminals_[d] || d) + "'" : "Parse error on line " + (l + 1) + ": Unexpected " + (1 == d ? "end of input" : "'" + (this.terminals_[d] || d) + "'"), this.parseError(S, {
           text: this.lexer.match,
           token: this.terminals_[d] || d,
           line: this.lexer.yylineno,
           loc: h,
           expected: w
          })
         }
        }
        if (g[0] instanceof Array && g.length > 1) throw new Error("Parse Error: multiple actions possible at state: " + m + ", token: " + d);
        switch (g[0]) {
         case 1:
          i.push(d), r.push(this.lexer.yytext), s.push(this.lexer.yylloc), i.push(g[1]), d = null, f ? (d = f, f = null) : (c = this.lexer.yyleng, a = this.lexer.yytext, l = this.lexer.yylineno, h = this.lexer.yylloc, u > 0 && u--);
          break;
         case 2:
          if (b = this.productions_[g[1]][1], k.$ = r[r.length - b], k._$ = {
            first_line: s[s.length - (b || 1)].first_line,
            last_line: s[s.length - 1].last_line,
            first_column: s[s.length - (b || 1)].first_column,
            last_column: s[s.length - 1].last_column
           }, p && (k._$.range = [s[s.length - (b || 1)].range[0], s[s.length - 1].range[1]]), void 0 !== (v = this.performAction.call(k, a, c, l, this.yy, g[1], r, s))) return v;
          b && (i = i.slice(0, -1 * b * 2), r = r.slice(0, -1 * b), s = s.slice(0, -1 * b)), i.push(this.productions_[g[1]][0]), r.push(k.$), s.push(k._$), x = o[i[i.length - 2]][i[i.length - 1]], i.push(x);
          break;
         case 3:
          return !0
        }
       }
       return !0
      }
     },
     n = function() {
      var t = {
       EOF: 1,
       parseError: function(t, e) {
        if (!this.yy.parser) throw new Error(t);
        this.yy.parser.parseError(t, e)
       },
       setInput: function(t) {
        return this._input = t, this._more = this._less = this.done = !1, this.yylineno = this.yyleng = 0, this.yytext = this.matched = this.match = "", this.conditionStack = ["INITIAL"], this.yylloc = {
         first_line: 1,
         first_column: 0,
         last_line: 1,
         last_column: 0
        }, this.options.ranges && (this.yylloc.range = [0, 0]), this.offset = 0, this
       },
       input: function() {
        var t = this._input[0];
        this.yytext += t, this.yyleng++, this.offset++, this.match += t, this.matched += t;
        return t.match(/(?:\r\n?|\n).*/g) ? (this.yylineno++, this.yylloc.last_line++) : this.yylloc.last_column++, this.options.ranges && this.yylloc.range[1]++, this._input = this._input.slice(1), t
       },
       unput: function(t) {
        var e = t.length,
         n = t.split(/(?:\r\n?|\n)/g);
        this._input = t + this._input, this.yytext = this.yytext.substr(0, this.yytext.length - e - 1), this.offset -= e;
        var i = this.match.split(/(?:\r\n?|\n)/g);
        this.match = this.match.substr(0, this.match.length - 1), this.matched = this.matched.substr(0, this.matched.length - 1), n.length - 1 && (this.yylineno -= n.length - 1);
        var r = this.yylloc.range;
        return this.yylloc = {
         first_line: this.yylloc.first_line,
         last_line: this.yylineno + 1,
         first_column: this.yylloc.first_column,
         last_column: n ? (n.length === i.length ? this.yylloc.first_column : 0) + i[i.length - n.length].length - n[0].length : this.yylloc.first_column - e
        }, this.options.ranges && (this.yylloc.range = [r[0], r[0] + this.yyleng - e]), this
       },
       more: function() {
        return this._more = !0, this
       },
       less: function(t) {
        this.unput(this.match.slice(t))
       },
       pastInput: function() {
        var t = this.matched.substr(0, this.matched.length - this.match.length);
        return (t.length > 20 ? "..." : "") + t.substr(-20).replace(/\n/g, "")
       },
       upcomingInput: function() {
        var t = this.match;
        return t.length < 20 && (t += this._input.substr(0, 20 - t.length)), (t.substr(0, 20) + (t.length > 20 ? "..." : "")).replace(/\n/g, "")
       },
       showPosition: function() {
        var t = this.pastInput(),
         e = new Array(t.length + 1).join("-");
        return t + this.upcomingInput() + "\n" + e + "^"
       },
       next: function() {
        if (this.done) return this.EOF;
        this._input || (this.done = !0);
        var t, e, n, i, r;
        this._more || (this.yytext = "", this.match = "");
        for (var s = this._currentRules(), o = 0; o < s.length && (!(n = this._input.match(this.rules[s[o]])) || e && !(n[0].length > e[0].length) || (e = n, i = o, this.options.flex)); o++);
        return e ? ((r = e[0].match(/(?:\r\n?|\n).*/g)) && (this.yylineno += r.length), this.yylloc = {
         first_line: this.yylloc.last_line,
         last_line: this.yylineno + 1,
         first_column: this.yylloc.last_column,
         last_column: r ? r[r.length - 1].length - r[r.length - 1].match(/\r?\n?/)[0].length : this.yylloc.last_column + e[0].length
        }, this.yytext += e[0], this.match += e[0], this.matches = e, this.yyleng = this.yytext.length, this.options.ranges && (this.yylloc.range = [this.offset, this.offset += this.yyleng]), this._more = !1, this._input = this._input.slice(e[0].length), this.matched += e[0], t = this.performAction.call(this, this.yy, this, s[i], this.conditionStack[this.conditionStack.length - 1]), this.done && this._input && (this.done = !1), t || void 0) : "" === this._input ? this.EOF : this.parseError("Lexical error on line " + (this.yylineno + 1) + ". Unrecognized text.\n" + this.showPosition(), {
         text: "",
         token: null,
         line: this.yylineno
        })
       },
       lex: function() {
        var t = this.next();
        return void 0 !== t ? t : this.lex()
       },
       begin: function(t) {
        this.conditionStack.push(t)
       },
       popState: function() {
        return this.conditionStack.pop()
       },
       _currentRules: function() {
        return this.conditions[this.conditionStack[this.conditionStack.length - 1]].rules
       },
       topState: function() {
        return this.conditionStack[this.conditionStack.length - 2]
       },
       pushState: function(t) {
        this.begin(t)
       }
      };
      return t.options = {}, t.performAction = function(t, e, n, i) {
       function r(t, n) {
        return e.yytext = e.yytext.substr(t, e.yyleng - n)
       }
       switch (n) {
        case 0:
         if ("\\\\" === e.yytext.slice(-2) ? (r(0, 1), this.begin("mu")) : "\\" === e.yytext.slice(-1) ? (r(0, 1), this.begin("emu")) : this.begin("mu"), e.yytext) return 15;
         break;
        case 1:
         return 15;
        case 2:
         return this.popState(), 15;
        case 3:
         return this.begin("raw"), 15;
        case 4:
         return this.popState(), "raw" === this.conditionStack[this.conditionStack.length - 1] ? 15 : (e.yytext = e.yytext.substr(5, e.yyleng - 9), "END_RAW_BLOCK");
        case 5:
         return 15;
        case 6:
         return this.popState(), 14;
        case 7:
         return 65;
        case 8:
         return 68;
        case 9:
         return 19;
        case 10:
         return this.popState(), this.begin("raw"), 23;
        case 11:
         return 55;
        case 12:
         return 60;
        case 13:
         return 29;
        case 14:
         return 47;
        case 15:
        case 16:
         return this.popState(), 44;
        case 17:
         return 34;
        case 18:
         return 39;
        case 19:
         return 51;
        case 20:
         return 48;
        case 21:
         this.unput(e.yytext), this.popState(), this.begin("com");
         break;
        case 22:
         return this.popState(), 14;
        case 23:
         return 48;
        case 24:
         return 73;
        case 25:
        case 26:
         return 72;
        case 27:
         return 87;
        case 28:
         break;
        case 29:
         return this.popState(), 54;
        case 30:
         return this.popState(), 33;
        case 31:
         return e.yytext = r(1, 2).replace(/\\"/g, '"'), 80;
        case 32:
         return e.yytext = r(1, 2).replace(/\\'/g, "'"), 80;
        case 33:
         return 85;
        case 34:
        case 35:
         return 82;
        case 36:
         return 83;
        case 37:
         return 84;
        case 38:
         return 81;
        case 39:
         return 75;
        case 40:
         return 77;
        case 41:
         return 72;
        case 42:
         return e.yytext = e.yytext.replace(/\\([\\\]])/g, "$1"), 72;
        case 43:
         return "INVALID";
        case 44:
         return 5
       }
      }, t.rules = [/^(?:[^\x00]*?(?=(\{\{)))/, /^(?:[^\x00]+)/, /^(?:[^\x00]{2,}?(?=(\{\{|\\\{\{|\\\\\{\{|$)))/, /^(?:\{\{\{\{(?=[^\/]))/, /^(?:\{\{\{\{\/[^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=[=}\s\/.])\}\}\}\})/, /^(?:[^\x00]*?(?=(\{\{\{\{)))/, /^(?:[\s\S]*?--(~)?\}\})/, /^(?:\()/, /^(?:\))/, /^(?:\{\{\{\{)/, /^(?:\}\}\}\})/, /^(?:\{\{(~)?>)/, /^(?:\{\{(~)?#>)/, /^(?:\{\{(~)?#\*?)/, /^(?:\{\{(~)?\/)/, /^(?:\{\{(~)?\^\s*(~)?\}\})/, /^(?:\{\{(~)?\s*else\s*(~)?\}\})/, /^(?:\{\{(~)?\^)/, /^(?:\{\{(~)?\s*else\b)/, /^(?:\{\{(~)?\{)/, /^(?:\{\{(~)?&)/, /^(?:\{\{(~)?!--)/, /^(?:\{\{(~)?![\s\S]*?\}\})/, /^(?:\{\{(~)?\*?)/, /^(?:=)/, /^(?:\.\.)/, /^(?:\.(?=([=~}\s\/.)|])))/, /^(?:[\/.])/, /^(?:\s+)/, /^(?:\}(~)?\}\})/, /^(?:(~)?\}\})/, /^(?:"(\\["]|[^"])*")/, /^(?:'(\\[']|[^'])*')/, /^(?:@)/, /^(?:true(?=([~}\s)])))/, /^(?:false(?=([~}\s)])))/, /^(?:undefined(?=([~}\s)])))/, /^(?:null(?=([~}\s)])))/, /^(?:-?[0-9]+(?:\.[0-9]+)?(?=([~}\s)])))/, /^(?:as\s+\|)/, /^(?:\|)/, /^(?:([^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=([=~}\s\/.)|]))))/, /^(?:\[(\\\]|[^\]])*\])/, /^(?:.)/, /^(?:$)/], t.conditions = {
       mu: {
        rules: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44],
        inclusive: !1
       },
       emu: {
        rules: [2],
        inclusive: !1
       },
       com: {
        rules: [6],
        inclusive: !1
       },
       raw: {
        rules: [3, 4, 5],
        inclusive: !1
       },
       INITIAL: {
        rules: [0, 1, 44],
        inclusive: !0
       }
      }, t
     }();
    return e.lexer = n, t.prototype = e, e.Parser = t, new t
   }();
   e.default = n, t.exports = e.default
  }, function(t, e, n) {
   "use strict";

   function i() {
    var t = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0];
    this.options = t
   }

   function r(t, e, n) {
    void 0 === e && (e = t.length);
    var i = t[e - 1],
     r = t[e - 2];
    return i ? "ContentStatement" === i.type ? (r || !n ? /\r?\n\s*?$/ : /(^|\r?\n)\s*?$/).test(i.original) : void 0 : n
   }

   function s(t, e, n) {
    void 0 === e && (e = -1);
    var i = t[e + 1],
     r = t[e + 2];
    return i ? "ContentStatement" === i.type ? (r || !n ? /^\s*?\r?\n/ : /^\s*?(\r?\n|$)/).test(i.original) : void 0 : n
   }

   function o(t, e, n) {
    var i = t[null == e ? 0 : e + 1];
    if (i && "ContentStatement" === i.type && (n || !i.rightStripped)) {
     var r = i.value;
     i.value = i.value.replace(n ? /^\s+/ : /^[ \t]*\r?\n?/, ""), i.rightStripped = i.value !== r
    }
   }

   function a(t, e, n) {
    var i = t[null == e ? t.length - 1 : e - 1];
    if (i && "ContentStatement" === i.type && (n || !i.leftStripped)) {
     var r = i.value;
     return i.value = i.value.replace(n ? /\s+$/ : /[ \t]+$/, ""), i.leftStripped = i.value !== r, i.leftStripped
    }
   }
   var l = n(1).default;
   e.__esModule = !0;
   var c = l(n(39));
   (i.prototype = new c.default).Program = function(t) {
    var e = !this.options.ignoreStandalone,
     n = !this.isRootSeen;
    this.isRootSeen = !0;
    for (var i = t.body, l = 0, c = i.length; l < c; l++) {
     var u = i[l],
      h = this.accept(u);
     if (h) {
      var p = r(i, l, n),
       d = s(i, l, n),
       f = h.openStandalone && p,
       m = h.closeStandalone && d,
       g = h.inlineStandalone && p && d;
      h.close && o(i, l, !0), h.open && a(i, l, !0), e && g && (o(i, l), a(i, l) && "PartialStatement" === u.type && (u.indent = /([ \t]+$)/.exec(i[l - 1].original)[1])), e && f && (o((u.program || u.inverse).body), a(i, l)), e && m && (o(i, l), a((u.inverse || u.program).body))
     }
    }
    return t
   }, i.prototype.BlockStatement = i.prototype.DecoratorBlock = i.prototype.PartialBlockStatement = function(t) {
    this.accept(t.program), this.accept(t.inverse);
    var e = t.program || t.inverse,
     n = t.program && t.inverse,
     i = n,
     l = n;
    if (n && n.chained)
     for (i = n.body[0].program; l.chained;) l = l.body[l.body.length - 1].program;
    var c = {
     open: t.openStrip.open,
     close: t.closeStrip.close,
     openStandalone: s(e.body),
     closeStandalone: r((i || e).body)
    };
    if (t.openStrip.close && o(e.body, null, !0), n) {
     var u = t.inverseStrip;
     u.open && a(e.body, null, !0), u.close && o(i.body, null, !0), t.closeStrip.open && a(l.body, null, !0), !this.options.ignoreStandalone && r(e.body) && s(i.body) && (a(e.body), o(i.body))
    } else t.closeStrip.open && a(e.body, null, !0);
    return c
   }, i.prototype.Decorator = i.prototype.MustacheStatement = function(t) {
    return t.strip
   }, i.prototype.PartialStatement = i.prototype.CommentStatement = function(t) {
    var e = t.strip || {};
    return {
     inlineStandalone: !0,
     open: e.open,
     close: e.close
    }
   }, e.default = i, t.exports = e.default
  }, function(t, e, n) {
   "use strict";

   function i() {
    this.parents = []
   }

   function r(t) {
    this.acceptRequired(t, "path"), this.acceptArray(t.params), this.acceptKey(t, "hash")
   }

   function s(t) {
    r.call(this, t), this.acceptKey(t, "program"), this.acceptKey(t, "inverse")
   }

   function o(t) {
    this.acceptRequired(t, "name"), this.acceptArray(t.params), this.acceptKey(t, "hash")
   }
   var a = n(1).default;
   e.__esModule = !0;
   var l = a(n(6));
   i.prototype = {
    constructor: i,
    mutating: !1,
    acceptKey: function(t, e) {
     var n = this.accept(t[e]);
     if (this.mutating) {
      if (n && !i.prototype[n.type]) throw new l.default('Unexpected node type "' + n.type + '" found when accepting ' + e + " on " + t.type);
      t[e] = n
     }
    },
    acceptRequired: function(t, e) {
     if (this.acceptKey(t, e), !t[e]) throw new l.default(t.type + " requires " + e)
    },
    acceptArray: function(t) {
     for (var e = 0, n = t.length; e < n; e++) this.acceptKey(t, e), t[e] || (t.splice(e, 1), e--, n--)
    },
    accept: function(t) {
     if (t) {
      if (!this[t.type]) throw new l.default("Unknown type: " + t.type, t);
      this.current && this.parents.unshift(this.current), this.current = t;
      var e = this[t.type](t);
      return this.current = this.parents.shift(), !this.mutating || e ? e : !1 !== e ? t : void 0
     }
    },
    Program: function(t) {
     this.acceptArray(t.body)
    },
    MustacheStatement: r,
    Decorator: r,
    BlockStatement: s,
    DecoratorBlock: s,
    PartialStatement: o,
    PartialBlockStatement: function(t) {
     o.call(this, t), this.acceptKey(t, "program")
    },
    ContentStatement: function() {},
    CommentStatement: function() {},
    SubExpression: r,
    PathExpression: function() {},
    StringLiteral: function() {},
    NumberLiteral: function() {},
    BooleanLiteral: function() {},
    UndefinedLiteral: function() {},
    NullLiteral: function() {},
    Hash: function(t) {
     this.acceptArray(t.pairs)
    },
    HashPair: function(t) {
     this.acceptRequired(t, "value")
    }
   }, e.default = i, t.exports = e.default
  }, function(t, e, n) {
   "use strict";

   function i(t, e) {
    if (e = e.path ? e.path.original : e, t.path.original !== e) {
     var n = {
      loc: t.path.loc
     };
     throw new s.default(t.path.original + " doesn't match " + e, n)
    }
   }
   var r = n(1).default;
   e.__esModule = !0, e.SourceLocation = function(t, e) {
    this.source = t, this.start = {
     line: e.first_line,
     column: e.first_column
    }, this.end = {
     line: e.last_line,
     column: e.last_column
    }
   }, e.id = function(t) {
    return /^\[.*\]$/.test(t) ? t.substr(1, t.length - 2) : t
   }, e.stripFlags = function(t, e) {
    return {
     open: "~" === t.charAt(2),
     close: "~" === e.charAt(e.length - 3)
    }
   }, e.stripComment = function(t) {
    return t.replace(/^\{\{~?\!-?-?/, "").replace(/-?-?~?\}\}$/, "")
   }, e.preparePath = function(t, e, n) {
    n = this.locInfo(n);
    for (var i = t ? "@" : "", r = [], o = 0, a = 0, l = e.length; a < l; a++) {
     var c = e[a].part,
      u = e[a].original !== c;
     if (i += (e[a].separator || "") + c, u || ".." !== c && "." !== c && "this" !== c) r.push(c);
     else {
      if (r.length > 0) throw new s.default("Invalid path: " + i, {
       loc: n
      });
      ".." === c && o++
     }
    }
    return {
     type: "PathExpression",
     data: t,
     depth: o,
     parts: r,
     original: i,
     loc: n
    }
   }, e.prepareMustache = function(t, e, n, i, r, s) {
    var o = i.charAt(3) || i.charAt(2),
     a = "{" !== o && "&" !== o;
    return {
     type: /\*/.test(i) ? "Decorator" : "MustacheStatement",
     path: t,
     params: e,
     hash: n,
     escaped: a,
     strip: r,
     loc: this.locInfo(s)
    }
   }, e.prepareRawBlock = function(t, e, n, r) {
    i(t, n);
    var s = {
     type: "Program",
     body: e,
     strip: {},
     loc: r = this.locInfo(r)
    };
    return {
     type: "BlockStatement",
     path: t.path,
     params: t.params,
     hash: t.hash,
     program: s,
     openStrip: {},
     inverseStrip: {},
     closeStrip: {},
     loc: r
    }
   }, e.prepareBlock = function(t, e, n, r, o, a) {
    r && r.path && i(t, r);
    var l = /\*/.test(t.open);
    e.blockParams = t.blockParams;
    var c = void 0,
     u = void 0;
    if (n) {
     if (l) throw new s.default("Unexpected inverse block on decorator", n);
     n.chain && (n.program.body[0].closeStrip = r.strip), u = n.strip, c = n.program
    }
    return o && (o = c, c = e, e = o), {
     type: l ? "DecoratorBlock" : "BlockStatement",
     path: t.path,
     params: t.params,
     hash: t.hash,
     program: e,
     inverse: c,
     openStrip: t.strip,
     inverseStrip: u,
     closeStrip: r && r.strip,
     loc: this.locInfo(a)
    }
   }, e.prepareProgram = function(t, e) {
    if (!e && t.length) {
     var n = t[0].loc,
      i = t[t.length - 1].loc;
     n && i && (e = {
      source: n.source,
      start: {
       line: n.start.line,
       column: n.start.column
      },
      end: {
       line: i.end.line,
       column: i.end.column
      }
     })
    }
    return {
     type: "Program",
     body: t,
     strip: {},
     loc: e
    }
   }, e.preparePartialBlock = function(t, e, n, r) {
    return i(t, n), {
     type: "PartialBlockStatement",
     name: t.path,
     params: t.params,
     hash: t.hash,
     program: e,
     openStrip: t.strip,
     closeStrip: n && n.strip,
     loc: this.locInfo(r)
    }
   };
   var s = r(n(6))
  }, function(t, e, n) {
   "use strict";

   function i() {}

   function r(t, e) {
    if (t === e) return !0;
    if (l.isArray(t) && l.isArray(e) && t.length === e.length) {
     for (var n = 0; n < t.length; n++)
      if (!r(t[n], e[n])) return !1;
     return !0
    }
   }

   function s(t) {
    if (!t.path.parts) {
     var e = t.path;
     t.path = {
      type: "PathExpression",
      data: !1,
      depth: 0,
      parts: [e.original + ""],
      original: e.original + "",
      loc: e.loc
     }
    }
   }
   var o = n(1).default;
   e.__esModule = !0, e.Compiler = i, e.precompile = function(t, e, n) {
    if (null == t || "string" != typeof t && "Program" !== t.type) throw new a.default("You must pass a string or Handlebars AST to Handlebars.precompile. You passed " + t);
    "data" in (e = e || {}) || (e.data = !0), e.compat && (e.useDepths = !0);
    var i = n.parse(t, e),
     r = (new n.Compiler).compile(i, e);
    return (new n.JavaScriptCompiler).compile(r, e)
   }, e.compile = function(t, e, n) {
    function i() {
     var i = n.parse(t, e),
      r = (new n.Compiler).compile(i, e),
      s = (new n.JavaScriptCompiler).compile(r, e, void 0, !0);
     return n.template(s)
    }

    function r(t, e) {
     return s || (s = i()), s.call(this, t, e)
    }
    if (void 0 === e && (e = {}), null == t || "string" != typeof t && "Program" !== t.type) throw new a.default("You must pass a string or Handlebars AST to Handlebars.compile. You passed " + t);
    "data" in (e = l.extend({}, e)) || (e.data = !0), e.compat && (e.useDepths = !0);
    var s = void 0;
    return r._setup = function(t) {
     return s || (s = i()), s._setup(t)
    }, r._child = function(t, e, n, r) {
     return s || (s = i()), s._child(t, e, n, r)
    }, r
   };
   var a = o(n(6)),
    l = n(5),
    c = o(n(35)),
    u = [].slice;
   i.prototype = {
    compiler: i,
    equals: function(t) {
     var e = this.opcodes.length;
     if (t.opcodes.length !== e) return !1;
     for (var n = 0; n < e; n++) {
      var i = this.opcodes[n],
       s = t.opcodes[n];
      if (i.opcode !== s.opcode || !r(i.args, s.args)) return !1
     }
     e = this.children.length;
     for (n = 0; n < e; n++)
      if (!this.children[n].equals(t.children[n])) return !1;
     return !0
    },
    guid: 0,
    compile: function(t, e) {
     this.sourceNode = [], this.opcodes = [], this.children = [], this.options = e, this.stringParams = e.stringParams, this.trackIds = e.trackIds, e.blockParams = e.blockParams || [];
     var n = e.knownHelpers;
     if (e.knownHelpers = {
       helperMissing: !0,
       blockHelperMissing: !0,
       each: !0,
       if: !0,
       unless: !0,
       with: !0,
       log: !0,
       lookup: !0
      }, n)
      for (var i in n) i in n && (this.options.knownHelpers[i] = n[i]);
     return this.accept(t)
    },
    compileProgram: function(t) {
     var e = (new this.compiler).compile(t, this.options),
      n = this.guid++;
     return this.usePartial = this.usePartial || e.usePartial, this.children[n] = e, this.useDepths = this.useDepths || e.useDepths, n
    },
    accept: function(t) {
     if (!this[t.type]) throw new a.default("Unknown type: " + t.type, t);
     this.sourceNode.unshift(t);
     var e = this[t.type](t);
     return this.sourceNode.shift(), e
    },
    Program: function(t) {
     this.options.blockParams.unshift(t.blockParams);
     for (var e = t.body, n = e.length, i = 0; i < n; i++) this.accept(e[i]);
     return this.options.blockParams.shift(), this.isSimple = 1 === n, this.blockParams = t.blockParams ? t.blockParams.length : 0, this
    },
    BlockStatement: function(t) {
     s(t);
     var e = t.program,
      n = t.inverse;
     e = e && this.compileProgram(e), n = n && this.compileProgram(n);
     var i = this.classifySexpr(t);
     "helper" === i ? this.helperSexpr(t, e, n) : "simple" === i ? (this.simpleSexpr(t), this.opcode("pushProgram", e), this.opcode("pushProgram", n), this.opcode("emptyHash"), this.opcode("blockValue", t.path.original)) : (this.ambiguousSexpr(t, e, n), this.opcode("pushProgram", e), this.opcode("pushProgram", n), this.opcode("emptyHash"), this.opcode("ambiguousBlockValue")), this.opcode("append")
    },
    DecoratorBlock: function(t) {
     var e = t.program && this.compileProgram(t.program),
      n = this.setupFullMustacheParams(t, e, void 0),
      i = t.path;
     this.useDecorators = !0, this.opcode("registerDecorator", n.length, i.original)
    },
    PartialStatement: function(t) {
     this.usePartial = !0;
     var e = t.program;
     e && (e = this.compileProgram(t.program));
     var n = t.params;
     if (n.length > 1) throw new a.default("Unsupported number of partial arguments: " + n.length, t);
     n.length || (this.options.explicitPartialContext ? this.opcode("pushLiteral", "undefined") : n.push({
      type: "PathExpression",
      parts: [],
      depth: 0
     }));
     var i = t.name.original,
      r = "SubExpression" === t.name.type;
     r && this.accept(t.name), this.setupFullMustacheParams(t, e, void 0, !0);
     var s = t.indent || "";
     this.options.preventIndent && s && (this.opcode("appendContent", s), s = ""), this.opcode("invokePartial", r, i, s), this.opcode("append")
    },
    PartialBlockStatement: function(t) {
     this.PartialStatement(t)
    },
    MustacheStatement: function(t) {
     this.SubExpression(t), t.escaped && !this.options.noEscape ? this.opcode("appendEscaped") : this.opcode("append")
    },
    Decorator: function(t) {
     this.DecoratorBlock(t)
    },
    ContentStatement: function(t) {
     t.value && this.opcode("appendContent", t.value)
    },
    CommentStatement: function() {},
    SubExpression: function(t) {
     s(t);
     var e = this.classifySexpr(t);
     "simple" === e ? this.simpleSexpr(t) : "helper" === e ? this.helperSexpr(t) : this.ambiguousSexpr(t)
    },
    ambiguousSexpr: function(t, e, n) {
     var i = t.path,
      r = i.parts[0],
      s = null != e || null != n;
     this.opcode("getContext", i.depth), this.opcode("pushProgram", e), this.opcode("pushProgram", n), i.strict = !0, this.accept(i), this.opcode("invokeAmbiguous", r, s)
    },
    simpleSexpr: function(t) {
     var e = t.path;
     e.strict = !0, this.accept(e), this.opcode("resolvePossibleLambda")
    },
    helperSexpr: function(t, e, n) {
     var i = this.setupFullMustacheParams(t, e, n),
      r = t.path,
      s = r.parts[0];
     if (this.options.knownHelpers[s]) this.opcode("invokeKnownHelper", i.length, s);
     else {
      if (this.options.knownHelpersOnly) throw new a.default("You specified knownHelpersOnly, but used the unknown helper " + s, t);
      r.strict = !0, r.falsy = !0, this.accept(r), this.opcode("invokeHelper", i.length, r.original, c.default.helpers.simpleId(r))
     }
    },
    PathExpression: function(t) {
     this.addDepth(t.depth), this.opcode("getContext", t.depth);
     var e = t.parts[0],
      n = c.default.helpers.scopedId(t),
      i = !t.depth && !n && this.blockParamIndex(e);
     i ? this.opcode("lookupBlockParam", i, t.parts) : e ? t.data ? (this.options.data = !0, this.opcode("lookupData", t.depth, t.parts, t.strict)) : this.opcode("lookupOnContext", t.parts, t.falsy, t.strict, n) : this.opcode("pushContext")
    },
    StringLiteral: function(t) {
     this.opcode("pushString", t.value)
    },
    NumberLiteral: function(t) {
     this.opcode("pushLiteral", t.value)
    },
    BooleanLiteral: function(t) {
     this.opcode("pushLiteral", t.value)
    },
    UndefinedLiteral: function() {
     this.opcode("pushLiteral", "undefined")
    },
    NullLiteral: function() {
     this.opcode("pushLiteral", "null")
    },
    Hash: function(t) {
     var e = t.pairs,
      n = 0,
      i = e.length;
     for (this.opcode("pushHash"); n < i; n++) this.pushParam(e[n].value);
     for (; n--;) this.opcode("assignToHash", e[n].key);
     this.opcode("popHash")
    },
    opcode: function(t) {
     this.opcodes.push({
      opcode: t,
      args: u.call(arguments, 1),
      loc: this.sourceNode[0].loc
     })
    },
    addDepth: function(t) {
     t && (this.useDepths = !0)
    },
    classifySexpr: function(t) {
     var e = c.default.helpers.simpleId(t.path),
      n = e && !!this.blockParamIndex(t.path.parts[0]),
      i = !n && c.default.helpers.helperExpression(t),
      r = !n && (i || e);
     if (r && !i) {
      var s = t.path.parts[0],
       o = this.options;
      o.knownHelpers[s] ? i = !0 : o.knownHelpersOnly && (r = !1)
     }
     return i ? "helper" : r ? "ambiguous" : "simple"
    },
    pushParams: function(t) {
     for (var e = 0, n = t.length; e < n; e++) this.pushParam(t[e])
    },
    pushParam: function(t) {
     var e = null != t.value ? t.value : t.original || "";
     if (this.stringParams) e.replace && (e = e.replace(/^(\.?\.\/)*/g, "").replace(/\//g, ".")), t.depth && this.addDepth(t.depth), this.opcode("getContext", t.depth || 0), this.opcode("pushStringParam", e, t.type), "SubExpression" === t.type && this.accept(t);
     else {
      if (this.trackIds) {
       var n = void 0;
       if (!t.parts || c.default.helpers.scopedId(t) || t.depth || (n = this.blockParamIndex(t.parts[0])), n) {
        var i = t.parts.slice(1).join(".");
        this.opcode("pushId", "BlockParam", n, i)
       } else(e = t.original || e).replace && (e = e.replace(/^this(?:\.|$)/, "").replace(/^\.\//, "").replace(/^\.$/, "")), this.opcode("pushId", t.type, e)
      }
      this.accept(t)
     }
    },
    setupFullMustacheParams: function(t, e, n, i) {
     var r = t.params;
     return this.pushParams(r), this.opcode("pushProgram", e), this.opcode("pushProgram", n), t.hash ? this.accept(t.hash) : this.opcode("emptyHash", i), r
    },
    blockParamIndex: function(t) {
     for (var e = 0, n = this.options.blockParams.length; e < n; e++) {
      var i = this.options.blockParams[e],
       r = i && l.indexOf(i, t);
      if (i && r >= 0) return [e, r]
     }
    }
   }
  }, function(t, e, n) {
   "use strict";

   function i(t) {
    this.value = t
   }

   function r() {}
   var s = n(1).default;
   e.__esModule = !0;
   var o = n(4),
    a = s(n(6)),
    l = n(5),
    c = s(n(43));
   r.prototype = {
     nameLookup: function(t, e) {
      return r.isValidJavaScriptVariableName(e) ? [t, ".", e] : [t, "[", JSON.stringify(e), "]"]
     },
     depthedLookup: function(t) {
      return [this.aliasable("container.lookup"), '(depths, "', t, '")']
     },
     compilerInfo: function() {
      var t = o.COMPILER_REVISION;
      return [t, o.REVISION_CHANGES[t]]
     },
     appendToBuffer: function(t, e, n) {
      return l.isArray(t) || (t = [t]), t = this.source.wrap(t, e), this.environment.isSimple ? ["return ", t, ";"] : n ? ["buffer += ", t, ";"] : (t.appendToBuffer = !0, t)
     },
     initializeBuffer: function() {
      return this.quotedString("")
     },
     compile: function(t, e, n, i) {
      this.environment = t, this.options = e, this.stringParams = this.options.stringParams, this.trackIds = this.options.trackIds, this.precompile = !i, this.name = this.environment.name, this.isChild = !!n, this.context = n || {
       decorators: [],
       programs: [],
       environments: []
      }, this.preamble(), this.stackSlot = 0, this.stackVars = [], this.aliases = {}, this.registers = {
       list: []
      }, this.hashes = [], this.compileStack = [], this.inlineStack = [], this.blockParams = [], this.compileChildren(t, e), this.useDepths = this.useDepths || t.useDepths || t.useDecorators || this.options.compat, this.useBlockParams = this.useBlockParams || t.useBlockParams;
      var r = t.opcodes,
       s = void 0,
       o = void 0,
       l = void 0,
       c = void 0;
      for (l = 0, c = r.length; l < c; l++) s = r[l], this.source.currentLocation = s.loc, o = o || s.loc, this[s.opcode].apply(this, s.args);
      if (this.source.currentLocation = o, this.pushSource(""), this.stackSlot || this.inlineStack.length || this.compileStack.length) throw new a.default("Compile completed with content left on stack");
      this.decorators.isEmpty() ? this.decorators = void 0 : (this.useDecorators = !0, this.decorators.prepend("var decorators = container.decorators;\n"), this.decorators.push("return fn;"), i ? this.decorators = Function.apply(this, ["fn", "props", "container", "depth0", "data", "blockParams", "depths", this.decorators.merge()]) : (this.decorators.prepend("function(fn, props, container, depth0, data, blockParams, depths) {\n"), this.decorators.push("}\n"), this.decorators = this.decorators.merge()));
      var u = this.createFunctionContext(i);
      if (this.isChild) return u;
      var h = {
       compiler: this.compilerInfo(),
       main: u
      };
      this.decorators && (h.main_d = this.decorators, h.useDecorators = !0);
      var p = this.context,
       d = p.programs,
       f = p.decorators;
      for (l = 0, c = d.length; l < c; l++) d[l] && (h[l] = d[l], f[l] && (h[l + "_d"] = f[l], h.useDecorators = !0));
      return this.environment.usePartial && (h.usePartial = !0), this.options.data && (h.useData = !0), this.useDepths && (h.useDepths = !0), this.useBlockParams && (h.useBlockParams = !0), this.options.compat && (h.compat = !0), i ? h.compilerOptions = this.options : (h.compiler = JSON.stringify(h.compiler), this.source.currentLocation = {
       start: {
        line: 1,
        column: 0
       }
      }, h = this.objectLiteral(h), e.srcName ? (h = h.toStringWithSourceMap({
       file: e.destName
      })).map = h.map && h.map.toString() : h = h.toString()), h
     },
     preamble: function() {
      this.lastContext = 0, this.source = new c.default(this.options.srcName), this.decorators = new c.default(this.options.srcName)
     },
     createFunctionContext: function(t) {
      var e = "",
       n = this.stackVars.concat(this.registers.list);
      n.length > 0 && (e += ", " + n.join(", "));
      var i = 0;
      for (var r in this.aliases) {
       var s = this.aliases[r];
       this.aliases.hasOwnProperty(r) && s.children && s.referenceCount > 1 && (e += ", alias" + ++i + "=" + r, s.children[0] = "alias" + i)
      }
      var o = ["container", "depth0", "helpers", "partials", "data"];
      (this.useBlockParams || this.useDepths) && o.push("blockParams"), this.useDepths && o.push("depths");
      var a = this.mergeSource(e);
      return t ? (o.push(a), Function.apply(this, o)) : this.source.wrap(["function(", o.join(","), ") {\n  ", a, "}"])
     },
     mergeSource: function(t) {
      var e = this.environment.isSimple,
       n = !this.forceBuffer,
       i = void 0,
       r = void 0,
       s = void 0,
       o = void 0;
      return this.source.each(function(t) {
       t.appendToBuffer ? (s ? t.prepend("  + ") : s = t, o = t) : (s && (r ? s.prepend("buffer += ") : i = !0, o.add(";"), s = o = void 0), r = !0, e || (n = !1))
      }), n ? s ? (s.prepend("return "), o.add(";")) : r || this.source.push('return "";') : (t += ", buffer = " + (i ? "" : this.initializeBuffer()), s ? (s.prepend("return buffer + "), o.add(";")) : this.source.push("return buffer;")), t && this.source.prepend("var " + t.substring(2) + (i ? "" : ";\n")), this.source.merge()
     },
     blockValue: function(t) {
      var e = this.aliasable("helpers.blockHelperMissing"),
       n = [this.contextName(0)];
      this.setupHelperArgs(t, 0, n);
      var i = this.popStack();
      n.splice(1, 0, i), this.push(this.source.functionCall(e, "call", n))
     },
     ambiguousBlockValue: function() {
      var t = this.aliasable("helpers.blockHelperMissing"),
       e = [this.contextName(0)];
      this.setupHelperArgs("", 0, e, !0), this.flushInline();
      var n = this.topStack();
      e.splice(1, 0, n), this.pushSource(["if (!", this.lastHelper, ") { ", n, " = ", this.source.functionCall(t, "call", e), "}"])
     },
     appendContent: function(t) {
      this.pendingContent ? t = this.pendingContent + t : this.pendingLocation = this.source.currentLocation, this.pendingContent = t
     },
     append: function() {
      if (this.isInline()) this.replaceStack(function(t) {
       return [" != null ? ", t, ' : ""']
      }), this.pushSource(this.appendToBuffer(this.popStack()));
      else {
       var t = this.popStack();
       this.pushSource(["if (", t, " != null) { ", this.appendToBuffer(t, void 0, !0), " }"]), this.environment.isSimple && this.pushSource(["else { ", this.appendToBuffer("''", void 0, !0), " }"])
      }
     },
     appendEscaped: function() {
      this.pushSource(this.appendToBuffer([this.aliasable("container.escapeExpression"), "(", this.popStack(), ")"]))
     },
     getContext: function(t) {
      this.lastContext = t
     },
     pushContext: function() {
      this.pushStackLiteral(this.contextName(this.lastContext))
     },
     lookupOnContext: function(t, e, n, i) {
      var r = 0;
      i || !this.options.compat || this.lastContext ? this.pushContext() : this.push(this.depthedLookup(t[r++])), this.resolvePath("context", t, r, e, n)
     },
     lookupBlockParam: function(t, e) {
      this.useBlockParams = !0, this.push(["blockParams[", t[0], "][", t[1], "]"]), this.resolvePath("context", e, 1)
     },
     lookupData: function(t, e, n) {
      t ? this.pushStackLiteral("container.data(data, " + t + ")") : this.pushStackLiteral("data"), this.resolvePath("data", e, 0, !0, n)
     },
     resolvePath: function(t, e, n, i, r) {
      var s = this;
      if (this.options.strict || this.options.assumeObjects) this.push(function(t, e, n, i) {
       var r = e.popStack(),
        s = 0,
        o = n.length;
       for (t && o--; s < o; s++) r = e.nameLookup(r, n[s], i);
       return t ? [e.aliasable("container.strict"), "(", r, ", ", e.quotedString(n[s]), ")"] : r
      }(this.options.strict && r, this, e, t));
      else
       for (var o = e.length; n < o; n++) this.replaceStack(function(r) {
        var o = s.nameLookup(r, e[n], t);
        return i ? [" && ", o] : [" != null ? ", o, " : ", r]
       })
     },
     resolvePossibleLambda: function() {
      this.push([this.aliasable("container.lambda"), "(", this.popStack(), ", ", this.contextName(0), ")"])
     },
     pushStringParam: function(t, e) {
      this.pushContext(), this.pushString(e), "SubExpression" !== e && ("string" == typeof t ? this.pushString(t) : this.pushStackLiteral(t))
     },
     emptyHash: function(t) {
      this.trackIds && this.push("{}"), this.stringParams && (this.push("{}"), this.push("{}")), this.pushStackLiteral(t ? "undefined" : "{}")
     },
     pushHash: function() {
      this.hash && this.hashes.push(this.hash), this.hash = {
       values: [],
       types: [],
       contexts: [],
       ids: []
      }
     },
     popHash: function() {
      var t = this.hash;
      this.hash = this.hashes.pop(), this.trackIds && this.push(this.objectLiteral(t.ids)), this.stringParams && (this.push(this.objectLiteral(t.contexts)), this.push(this.objectLiteral(t.types))), this.push(this.objectLiteral(t.values))
     },
     pushString: function(t) {
      this.pushStackLiteral(this.quotedString(t))
     },
     pushLiteral: function(t) {
      this.pushStackLiteral(t)
     },
     pushProgram: function(t) {
      null != t ? this.pushStackLiteral(this.programExpression(t)) : this.pushStackLiteral(null)
     },
     registerDecorator: function(t, e) {
      var n = this.nameLookup("decorators", e, "decorator"),
       i = this.setupHelperArgs(e, t);
      this.decorators.push(["fn = ", this.decorators.functionCall(n, "", ["fn", "props", "container", i]), " || fn;"])
     },
     invokeHelper: function(t, e, n) {
      var i = this.popStack(),
       r = this.setupHelper(t, e),
       s = n ? [r.name, " || "] : "",
       o = ["("].concat(s, i);
      this.options.strict || o.push(" || ", this.aliasable("helpers.helperMissing")), o.push(")"), this.push(this.source.functionCall(o, "call", r.callParams))
     },
     invokeKnownHelper: function(t, e) {
      var n = this.setupHelper(t, e);
      this.push(this.source.functionCall(n.name, "call", n.callParams))
     },
     invokeAmbiguous: function(t, e) {
      this.useRegister("helper");
      var n = this.popStack();
      this.emptyHash();
      var i = this.setupHelper(0, t, e),
       r = ["(", "(helper = ", this.lastHelper = this.nameLookup("helpers", t, "helper"), " || ", n, ")"];
      this.options.strict || (r[0] = "(helper = ", r.push(" != null ? helper : ", this.aliasable("helpers.helperMissing"))), this.push(["(", r, i.paramsInit ? ["),(", i.paramsInit] : [], "),", "(typeof helper === ", this.aliasable('"function"'), " ? ", this.source.functionCall("helper", "call", i.callParams), " : helper))"])
     },
     invokePartial: function(t, e, n) {
      var i = [],
       r = this.setupParams(e, 1, i);
      t && (e = this.popStack(), delete r.name), n && (r.indent = JSON.stringify(n)), r.helpers = "helpers", r.partials = "partials", r.decorators = "container.decorators", t ? i.unshift(e) : i.unshift(this.nameLookup("partials", e, "partial")), this.options.compat && (r.depths = "depths"), r = this.objectLiteral(r), i.push(r), this.push(this.source.functionCall("container.invokePartial", "", i))
     },
     assignToHash: function(t) {
      var e = this.popStack(),
       n = void 0,
       i = void 0,
       r = void 0;
      this.trackIds && (r = this.popStack()), this.stringParams && (i = this.popStack(), n = this.popStack());
      var s = this.hash;
      n && (s.contexts[t] = n), i && (s.types[t] = i), r && (s.ids[t] = r), s.values[t] = e
     },
     pushId: function(t, e, n) {
      "BlockParam" === t ? this.pushStackLiteral("blockParams[" + e[0] + "].path[" + e[1] + "]" + (n ? " + " + JSON.stringify("." + n) : "")) : "PathExpression" === t ? this.pushString(e) : "SubExpression" === t ? this.pushStackLiteral("true") : this.pushStackLiteral("null")
     },
     compiler: r,
     compileChildren: function(t, e) {
      for (var n = t.children, i = void 0, r = void 0, s = 0, o = n.length; s < o; s++) {
       i = n[s], r = new this.compiler;
       var a = this.matchExistingProgram(i);
       if (null == a) {
        this.context.programs.push("");
        var l = this.context.programs.length;
        i.index = l, i.name = "program" + l, this.context.programs[l] = r.compile(i, e, this.context, !this.precompile), this.context.decorators[l] = r.decorators, this.context.environments[l] = i, this.useDepths = this.useDepths || r.useDepths, this.useBlockParams = this.useBlockParams || r.useBlockParams, i.useDepths = this.useDepths, i.useBlockParams = this.useBlockParams
       } else i.index = a.index, i.name = "program" + a.index, this.useDepths = this.useDepths || a.useDepths, this.useBlockParams = this.useBlockParams || a.useBlockParams
      }
     },
     matchExistingProgram: function(t) {
      for (var e = 0, n = this.context.environments.length; e < n; e++) {
       var i = this.context.environments[e];
       if (i && i.equals(t)) return i
      }
     },
     programExpression: function(t) {
      var e = this.environment.children[t],
       n = [e.index, "data", e.blockParams];
      return (this.useBlockParams || this.useDepths) && n.push("blockParams"), this.useDepths && n.push("depths"), "container.program(" + n.join(", ") + ")"
     },
     useRegister: function(t) {
      this.registers[t] || (this.registers[t] = !0, this.registers.list.push(t))
     },
     push: function(t) {
      return t instanceof i || (t = this.source.wrap(t)), this.inlineStack.push(t), t
     },
     pushStackLiteral: function(t) {
      this.push(new i(t))
     },
     pushSource: function(t) {
      this.pendingContent && (this.source.push(this.appendToBuffer(this.source.quotedString(this.pendingContent), this.pendingLocation)), this.pendingContent = void 0), t && this.source.push(t)
     },
     replaceStack: function(t) {
      var e = ["("],
       n = void 0,
       r = void 0,
       s = void 0;
      if (!this.isInline()) throw new a.default("replaceStack on non-inline");
      var o = this.popStack(!0);
      if (o instanceof i) e = ["(", n = [o.value]], s = !0;
      else {
       r = !0;
       var l = this.incrStack();
       e = ["((", this.push(l), " = ", o, ")"], n = this.topStack()
      }
      var c = t.call(this, n);
      s || this.popStack(), r && this.stackSlot--, this.push(e.concat(c, ")"))
     },
     incrStack: function() {
      return this.stackSlot++, this.stackSlot > this.stackVars.length && this.stackVars.push("stack" + this.stackSlot), this.topStackName()
     },
     topStackName: function() {
      return "stack" + this.stackSlot
     },
     flushInline: function() {
      var t = this.inlineStack;
      this.inlineStack = [];
      for (var e = 0, n = t.length; e < n; e++) {
       var r = t[e];
       if (r instanceof i) this.compileStack.push(r);
       else {
        var s = this.incrStack();
        this.pushSource([s, " = ", r, ";"]), this.compileStack.push(s)
       }
      }
     },
     isInline: function() {
      return this.inlineStack.length
     },
     popStack: function(t) {
      var e = this.isInline(),
       n = (e ? this.inlineStack : this.compileStack).pop();
      if (!t && n instanceof i) return n.value;
      if (!e) {
       if (!this.stackSlot) throw new a.default("Invalid stack pop");
       this.stackSlot--
      }
      return n
     },
     topStack: function() {
      var t = this.isInline() ? this.inlineStack : this.compileStack,
       e = t[t.length - 1];
      return e instanceof i ? e.value : e
     },
     contextName: function(t) {
      return this.useDepths && t ? "depths[" + t + "]" : "depth" + t
     },
     quotedString: function(t) {
      return this.source.quotedString(t)
     },
     objectLiteral: function(t) {
      return this.source.objectLiteral(t)
     },
     aliasable: function(t) {
      var e = this.aliases[t];
      return e ? (e.referenceCount++, e) : (e = this.aliases[t] = this.source.wrap(t), e.aliasable = !0, e.referenceCount = 1, e)
     },
     setupHelper: function(t, e, n) {
      var i = [];
      return {
       params: i,
       paramsInit: this.setupHelperArgs(e, t, i, n),
       name: this.nameLookup("helpers", e, "helper"),
       callParams: [this.aliasable(this.contextName(0) + " != null ? " + this.contextName(0) + " : (container.nullContext || {})")].concat(i)
      }
     },
     setupParams: function(t, e, n) {
      var i = {},
       r = [],
       s = [],
       o = [],
       a = !n,
       l = void 0;
      a && (n = []), i.name = this.quotedString(t), i.hash = this.popStack(), this.trackIds && (i.hashIds = this.popStack()), this.stringParams && (i.hashTypes = this.popStack(), i.hashContexts = this.popStack());
      var c = this.popStack(),
       u = this.popStack();
      (u || c) && (i.fn = u || "container.noop", i.inverse = c || "container.noop");
      for (var h = e; h--;) l = this.popStack(), n[h] = l, this.trackIds && (o[h] = this.popStack()), this.stringParams && (s[h] = this.popStack(), r[h] = this.popStack());
      return a && (i.args = this.source.generateArray(n)), this.trackIds && (i.ids = this.source.generateArray(o)), this.stringParams && (i.types = this.source.generateArray(s), i.contexts = this.source.generateArray(r)), this.options.data && (i.data = "data"), this.useBlockParams && (i.blockParams = "blockParams"), i
     },
     setupHelperArgs: function(t, e, n, i) {
      var r = this.setupParams(t, e, n);
      return r = this.objectLiteral(r), i ? (this.useRegister("options"), n.push("options"), ["options=", r]) : n ? (n.push(r), "") : r
     }
    },
    function() {
     for (var t = "break else new var case finally return void catch for switch while continue function this with default if throw delete in try do instanceof typeof abstract enum int short boolean export interface static byte extends long super char final native synchronized class float package throws const goto private transient debugger implements protected volatile double import public let yield await null true false".split(" "), e = r.RESERVED_WORDS = {}, n = 0, i = t.length; n < i; n++) e[t[n]] = !0
    }(), r.isValidJavaScriptVariableName = function(t) {
     return !r.RESERVED_WORDS[t] && /^[a-zA-Z_$][0-9a-zA-Z_$]*$/.test(t)
    }, e.default = r, t.exports = e.default
  }, function(t, e, n) {
   "use strict";

   function i(t, e, n) {
    if (s.isArray(t)) {
     for (var i = [], r = 0, o = t.length; r < o; r++) i.push(e.wrap(t[r], n));
     return i
    }
    return "boolean" == typeof t || "number" == typeof t ? t + "" : t
   }

   function r(t) {
    this.srcFile = t, this.source = []
   }
   e.__esModule = !0;
   var s = n(5),
    o = void 0;
   try {} catch (t) {}
   o || ((o = function(t, e, n, i) {
    this.src = "", i && this.add(i)
   }).prototype = {
    add: function(t) {
     s.isArray(t) && (t = t.join("")), this.src += t
    },
    prepend: function(t) {
     s.isArray(t) && (t = t.join("")), this.src = t + this.src
    },
    toStringWithSourceMap: function() {
     return {
      code: this.toString()
     }
    },
    toString: function() {
     return this.src
    }
   }), r.prototype = {
    isEmpty: function() {
     return !this.source.length
    },
    prepend: function(t, e) {
     this.source.unshift(this.wrap(t, e))
    },
    push: function(t, e) {
     this.source.push(this.wrap(t, e))
    },
    merge: function() {
     var t = this.empty();
     return this.each(function(e) {
      t.add(["  ", e, "\n"])
     }), t
    },
    each: function(t) {
     for (var e = 0, n = this.source.length; e < n; e++) t(this.source[e])
    },
    empty: function() {
     var t = this.currentLocation || {
      start: {}
     };
     return new o(t.start.line, t.start.column, this.srcFile)
    },
    wrap: function(t) {
     var e = arguments.length <= 1 || void 0 === arguments[1] ? this.currentLocation || {
      start: {}
     } : arguments[1];
     return t instanceof o ? t : (t = i(t, this, e), new o(e.start.line, e.start.column, this.srcFile, t))
    },
    functionCall: function(t, e, n) {
     return n = this.generateList(n), this.wrap([t, e ? "." + e + "(" : "(", n, ")"])
    },
    quotedString: function(t) {
     return '"' + (t + "").replace(/\\/g, "\\\\").replace(/"/g, '\\"').replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\u2028/g, "\\u2028").replace(/\u2029/g, "\\u2029") + '"'
    },
    objectLiteral: function(t) {
     var e = [];
     for (var n in t)
      if (t.hasOwnProperty(n)) {
       var r = i(t[n], this);
       "undefined" !== r && e.push([this.quotedString(n), ":", r])
      }
     var s = this.generateList(e);
     return s.prepend("{"), s.add("}"), s
    },
    generateList: function(t) {
     for (var e = this.empty(), n = 0, r = t.length; n < r; n++) n && e.add(","), e.add(i(t[n], this));
     return e
    },
    generateArray: function(t) {
     var e = this.generateList(t);
     return e.prepend("["), e.add("]"), e
    }
   }, e.default = r, t.exports = e.default
  }])
 });
var _gravity = _gravity || [],
 vnwGravityRecommendation = (vnwGravityRecommendation = {
  init: function(t) {
   _gravity.push(t)
  },
  push: function(t) {
   _gravity.push(t)
  }
 }) || [];
var vnw_GA = function() {
 var t = null,
  e = null,
  n = function(t, e, n, i) {
   _gaq.push(["_trackEvent", t, e, n], i || 1)
  },
  i = function() {
   _gaq.push(["_setCustomVar", 1, "Job Detail Display", "V" + e, 1]), $(".track-event").on("click", function() {
    switch ($(this).data("evt-type")) {
     case "apply":
      n("Apply", "Click", "V" + e);
      break;
     case "cancel-apply":
      n("CancelApplication", "Click", "V" + e);
      break;
     case "save-job":
      n("Save", "Click", "V" + e), _gravity.push({
       type: "event",
       eventType: "ADD_TO_WISHLIST",
       itemId: jobid,
       userid: userId
      });
      break;
     case "view-tab-cominfo":
      n("SeeCpnIngo", "Click", "V" + e);
      break;
     case "visit-com-profile":
      n("SeeCpnProfile", "Click", "V" + e);
      break;
     case "view-other-jobs":
      n("OtherJobs", "Click", "V" + e);
      break;
     case "create-job-alert":
      n("JobAlertInJobDetails", "Create", "V" + e)
    }
   }), $(".company_profile_link").on("click", function() {
    n("SeeCpnProfile", "Click", "V" + e)
   })
  },
  r = function(t) {
   _gaq.push(["_setCustomVar", 2, "After Apply Display", "V" + t, 1])
  },
  s = function(t) {
   _gaq.push(["_setCustomVar", 3, "Resume View Display", "V" + t, 1])
  },
  o = function(t) {
   _gaq.push(["_setCustomVar", 4, "My Jobs Display", "V" + t, 1])
  },
  a = function(t) {
   _gaq.push(["_setCustomVar", 5, "My Job Alert Display", "V" + t, 1])
  },
  l = function(t) {
   _gaq.push(["_setCustomVar", 5, "New Home Page Display", "V" + t, 1])
  },
  c = function(t) {
   _gaq.push(["_setCustomVar", 5, "Search Result Page Display", "V" + t, 1])
  };
 return {
  init: function(e) {
   t = e.selector, $(t).on("click", function(t) {
    var e = $(this),
     i = e.data("evt-name"),
     r = e.data("evt-action"),
     s = e.data("evt-label") || null,
     o = e.data("evt-value") || 1;
    n(i, r, s, o)
   })
  },
  initForJobDetail: function(t) {
   e = t, i()
  },
  initAfterApply: function(t) {
   r(t)
  },
  initResumeView: function(t) {
   s(t)
  },
  initMyJobs: function(t) {
   o(t)
  },
  initMyJobAlert: function(t) {
   a(t)
  },
  initHomePage: function(t) {
   l(t)
  },
  initSearchPage: function(t) {
   c(t), $(".job-search__save-job").click(function() {
    customEvent("SavedJobs", "Click", "SaveJobIconListViewV" + t)
   }), $(".job-search__btn-create-job-alert").click(function() {
    customEvent("CreateJobAlert", "Create", "BoxRightSearchV" + t)
   }), $("#job-search__ja-pill").click(function() {
    customEvent("CreateJobAlert", "Create", "ButtonTopSearchV" + t)
   }), $("#jobalert_open").click(function() {
    customEvent("CreateJobAlert", "Create", "BottomBoxV" + t)
   }), $(".job-search__saved-jobs").click(function() {
    customEvent("SavedJobs", "Click", "OpenSavedJobsV" + t)
   }), $("#job-search__floating-save-job-box .modal-title").click(function() {
    customEvent("SavedJobs", "Click", "OpenSavedJobsV" + t)
   })
  }
 }
}();
$(function() {
 vnw_GA.init({
  selector: ".ga-tracking"
 })
});