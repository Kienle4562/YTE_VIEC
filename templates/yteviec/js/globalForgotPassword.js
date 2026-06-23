window.globalForgotPassword = function(t) {
 function e(o) {
  if (i[o]) return i[o].exports;
  var a = i[o] = {
   i: o,
   l: !1,
   exports: {}
  };
  return t[o].call(a.exports, a, a.exports, e), a.l = !0, a.exports
 }
 var i = {};
 return e.m = t, e.c = i, e.d = function(t, i, o) {
  e.o(t, i) || Object.defineProperty(t, i, {
   configurable: !1,
   enumerable: !0,
   get: o
  })
 }, e.n = function(t) {
  var i = t && t.__esModule ? function() {
   return t.default
  } : function() {
   return t
  };
  return e.d(i, "a", i), i
 }, e.o = function(t, e) {
  return Object.prototype.hasOwnProperty.call(t, e)
 }, e.p = "", e(e.s = 13)
}([function(t, e, i) {
 "use strict";

 function o(t, e, i) {
  var o = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
   a = o.test(t);
  return a && e ? e.hide() : e.show(), !a && i && i.focus(), a
 }

 function a(t, e, i) {
  var o = t.indexOf("@") > -1,
   a = !o;
  return a && e ? e.hide() : e.show(), !a && i && i.focus(), a
 }

 function n(t, e, i) {
  var o = /([+-\/(\/)]*\d){7,}/,
   a = -1 != t.search(o),
   n = !a;
  return n && e ? e.hide() : e.show(), !n && i && i.focus(), n
 }

 function r(t, e, i) {
  var o = !!t.trim();
  return o && e ? e.hide() : e.show(), !o && i && i.focus(), o
 }

 function s(t, e, i, o, a) {
  var n = 2 == o ? "/sign-up" : "/dang-ky",
   r = !0;
  $.ajax({
   data: {
    txtEmail: t,
    chkEmail: 1
   },
   url: n,
   method: "post",
   success: function(t) {
    return "false" == t && (r = !1, i = !1), r && e ? e.hide() : e.show(), !r && a && a.focus(), r
   }
  })
 }

 function l(t, e, i, o, a) {
  var n = 2 == o ? "/sign-up" : "/dang-ky",
   r = !0;
  return $.ajax({
   data: {
    txtEmail: t,
    chkEmail: 1
   },
   url: n,
   method: "post",
   success: function(t) {
    return t && "false" != t && "true" != t && (r = !1, i = !1), r && e ? e.hide() : e.show(), !r && a && a.focus(), r
   }
  })
 }

 function u(t, e, i) {
  var o = t.trim(),
   a = /[-0-9#@!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/,
   n = a.test(o);
  return !n && e ? e.hide() : e.show(), n && i && i.focus(), !n
 }

 function d(t, e, i, o) {
  var a = t.trim(),
   n = o.trim();
  try {
   h(a), m(a, n), c(a), f(a)
  } catch (t) {
   return e.html(t), e.show(), i.focus(), !1
  }
  return e.hide(), !0
 }

 function h(t) {
  if (!t) throw (0, v.default)("Password can not be empty.")
 }

 function c(t) {
  var e = t.length;
  if (e < 6 || e > 50) throw (0, v.default)("Passwords with : 6 to 50 characters, 1 uppercase, 1 number.")
 }

 function f(t) {
  var e = new RegExp("[A-Z]"),
   i = new RegExp("[0-9]");
  if (!t.match(e)) throw (0, v.default)("Passwords with : 6 to 50 characters, 1 uppercase, 1 number.");
  if (!t.match(i)) throw (0, v.default)("Passwords with : 6 to 50 characters, 1 uppercase, 1 number.")
 }

 function m(t, e) {
  var i = e.split("@");
  if (t.toLowerCase() == i[0].toLowerCase()) throw (0, v.default)("Password should not be the same with email address.");
  if (t.toLowerCase() == e.toLowerCase()) throw (0, v.default)("Password should not be the same with email address.")
 }

 function w(t, e, i) {
  return t == e ? (i.hide(), !0) : (i.show(), !1)
 }
 Object.defineProperty(e, "__esModule", {
  value: !0
 }), e.validateEmailAddress = o, e.validateNOTEmailAddress = a, e.validateNOTPhoneNumber = n, e.validateRequiredField = r, e.validateEmailExisted = s, e.validateEmailDisposable = l, e.validateName = u, e.validatePassword = d, e.validatePasswordContainEmail = m, e.validatePasswordMatch = w;
 var g = i(1),
  v = function(t) {
   return t && t.__esModule ? t : {
    default: t
   }
  }(g)
}, function(t, e, i) {
 "use strict";
 Object.defineProperty(e, "__esModule", {
  value: !0
 });
 var o = function(t) {
  var e = {
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
  return t = t.trim(), 2 === i ? t : e[t]
 };
 e.default = o
}, , , function(t, e, i) {
 "use strict";

 function o(t, e) {
  if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(e, "__esModule", {
  value: !0
 });
 var a = function() {
   function t(t, e) {
    for (var i = 0; i < e.length; i++) {
     var o = e[i];
     o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
    }
   }
   return function(e, i, o) {
    return i && t(e.prototype, i), o && t(e, o), e
   }
  }(),
  n = i(0),
  r = function(t) {
   if (t && t.__esModule) return t;
   var e = {};
   if (null != t)
    for (var i in t) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
   return e.default = t, e
  }(n),
  s = function() {
   function t() {
    var e = this;
    o(this, t), this.$modal = jQuery(".global__forgot-password-modal"), this.$form = this.$modal.find("form"), this.form = this.$form[0], this.$email = this.$modal.find(".email"), this.$submitBtn = this.$modal.find(".btn-forgot-password"), this.urlAjax = "forgot", this.$bottomLinks = this.$modal.find(".bottom-links"), this.$loginLink = this.$bottomLinks.find(".login a"), this.$registerLink = this.$bottomLinks.find(".register a"), this.$errorToken = this.$modal.find(".token-expired-error"), this.initLinkAction = function() {
     var t = e.$loginLink,
      i = e.$registerLink;
     t.click(function(t) {
      globalLogInModal.showModal()
     }), i.click(function(t) {
      globalRegistrationModal.showModal()
     })
    }, this.showModal = function() {
     jQuery(".modal").on("show.bs.modal", function() {
      jQuery(".modal").not(jQuery(this)).each(function() {
       jQuery(this).modal("hide")
      })
     }), customEvent("OnBoarding", "Login", "Header"), e.$modal.modal("show")
    }, this.hideModal = function() {
     e.$modal.modal("hide")
    }, this.serializeForm = function() {
     return e.$form.serialize()
    }, this.validateEmail = function() {
     var t = e.$email;
     e.clearErrorMessage();
     var i = t.siblings(".error__required-field"),
      o = r.validateRequiredField(t.val().toString(), i),
      a = !0;
     if (o) {
      var n = t.siblings(".error__invalid-email");
      a = r.validateEmailAddress(t.val().toString(), n, t)
     }
     return o && a
    }, this.showLoading = function() {
     var t = e.$submitBtn;
     t.addClass("disabled"), t.find("i").show(), t.find("span").hide()
    }, this.disableLoading = function() {
     var t = e.$submitBtn;
     t.removeClass("disabled"), t.find("i").hide(), t.find("span").show()
    }, this.validate = function() {
     return e.validateEmail()
    }, this.clearErrorMessage = function() {
     jQuery(".text-danger").removeAttr("style")
    }, this.handleForgotPass = function(t) {
     var i = e.$email,
      o = e.$errorToken;
     t.preventDefault();
     var a = e.serializeForm(),
      n = e.urlAjax,
      r = e;
     e.validate() && (r.showLoading(), $.ajax({
      data: a,
      url: n,
      method: "post",
      type: "post",
      success: function(t) {
       if (t = JSON.parse(t), r.disableLoading(), t.status && 200 == t.status) r.clearErrorMessage(), r.hideModal(), $(r).trigger("requestEmailForgotPassword", [t.data]);
       else switch (t.status) {
        case 1001:
         i.siblings(".error__not-exist-email").show();
         break;
        case 1002:
         o.show();
         break;
        case 1010:
         i.siblings(".error__employer-email").show()
       }
      }
     }))
    }, this.initLinkAction(), this.initForgotPasswordEvent(), this.initAutoFocusOnFirstField()
   }
   return a(t, [{
    key: "initForgotPasswordEvent",
    value: function() {
     var t = this;
     this.$submitBtn.click(function(e) {
      t.handleForgotPass(e)
     })
    }
   }, {
    key: "initAutoFocusOnFirstField",
    value: function() {
     var t = this;
     this.$modal.on("shown.bs.modal", function() {
      var e = $(document).width() >= 992;
      setTimeout(function() {
       e && t.$form.find("input:first").focus()
      }, 500)
     })
    }
   }]), t
  }();
 e.default = new s
}, , , , , , , , , function(t, e, i) {
 "use strict";

 function o(t) {
  return t && t.__esModule ? t : {
   default: t
  }
 }
 var a = Object.assign || function(t) {
   for (var e = 1; e < arguments.length; e++) {
    var i = arguments[e];
    for (var o in i) Object.prototype.hasOwnProperty.call(i, o) && (t[o] = i[o])
   }
   return t
  },
  n = i(4),
  r = o(n),
  s = i(14),
  l = o(s),
  u = {
   globalForgotPasswordModal: r.default,
   globalAfterForgotPassModal: l.default
  };
 a(window, u)
}, function(t, e, i) {
 "use strict";

 function o(t, e) {
  if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
 }
 Object.defineProperty(e, "__esModule", {
  value: !0
 });
 var a = i(4),
  n = function(t) {
   return t && t.__esModule ? t : {
    default: t
   }
  }(a),
  r = function t() {
   var e = this;
   o(this, t), this.$modal = jQuery(".global__after-forgot-pass-modal"), this.$bottomLinks = this.$modal.find(".bottom-links"), this.$loginLink = this.$bottomLinks.find(".login a"), this.$registerLink = this.$bottomLinks.find(".register a"), this.$emailUser = this.$modal.find("h3 strong"), this.initLinkAction = function() {
    var t = e.$loginLink,
     i = e.$registerLink;
    t.click(function(t) {
     globalLogInModal.showModal()
    }), i.click(function(t) {
     globalRegistrationModal.showModal()
    })
   }, this.showModal = function() {
    jQuery(".modal").on("show.bs.modal", function() {
     jQuery(".modal").not(jQuery(this)).each(function() {
      jQuery(this).modal("hide")
     })
    }), customEvent("OnBoarding", "Login", "Header"), e.$modal.modal("show")
   }, this.hideModal = function() {
    e.$modal.modal("hide")
   }, this.showAfterForgotPassModal = function() {
    var t = e;
    void 0 !== n.default ? $(n.default).on("requestEmailForgotPassword", function(e, i) {
     t.$emailUser.html(i.email), t.showModal()
    }) : console.warn('"globalForgotPasswordModal" does not exist, therefore, \n            AfterForgotPassModal will not show after registration is completed')
   }, this.initLinkAction(), this.showAfterForgotPassModal()
  };
 e.default = new r
}]).default;
//# sourceMappingURL=globalForgotPassword.js.map