!function(e){var n={};function a(o){if(n[o])return n[o].exports;var t=n[o]={i:o,l:!1,exports:{}};return e[o].call(t.exports,t,t.exports,a),t.l=!0,t.exports}a.m=e,a.c=n,a.d=function(e,n,o){a.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:o})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,n){if(1&n&&(e=a(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(a.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var t in e)a.d(o,t,function(n){return e[n]}.bind(null,t));return o},a.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(n,"a",n),n},a.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},a.p="/",a(a.s=0)}([function(e,n,a){a(1),a(2),e.exports=a(8)},function(e,n,a){"use strict";!function(e){var n=e(window),a=e("body");feather.replace({"stroke-width":1}),e(".btn-check-m, .btn-check-d").click((function(){e("input:checkbox").not(this).prop("checked",this.checked)})),e(document).on("click",'[data-toggle="fullscreen"]',(function(){return e(this).toggleClass("active-fullscreen"),document.fullscreenEnabled?e(this).hasClass("active-fullscreen")?document.documentElement.requestFullscreen():document.exitFullscreen():alert("Your browser does not support fullscreen."),!1})),e(document).on("click",".overlay",(function(){e.removeOverlay(),a.hasClass("hidden-navigation")&&e(".navigation .navigation-menu-body").niceScroll().remove(),a.removeClass("navigation-show")})),e.createOverlay=function(){e(".overlay").length<1&&(a.addClass("no-scroll").append('<div class="overlay"></div>'),e(".overlay").addClass("show"))},e.removeOverlay=function(){a.removeClass("no-scroll"),e(".overlay").remove()},e("[data-backround-image]").each((function(n){e(this).css("background","url("+e(this).data("backround-image")+")")})),n.on("load",(function(){e(".preloader").fadeOut(400,(function(){setTimeout((function(){toastr.options={timeOut:2e3,progressBar:!0,showMethod:"slideDown",hideMethod:"slideUp",showDuration:200,hideDuration:200,positionClass:"toast-top-center"},toastr.success("Welcome Roxana Roussell."),e(".theme-switcher").removeClass("open")}),500)}))})),n.on("load",(function(){setTimeout((function(){e(".navigation .navigation-menu-body ul li a").each((function(){var n=e(this);n.next("ul").length&&n.append('<i class="sub-menu-arrow fa fa-chevron-down"></i>')})),e(".navigation .navigation-menu-body ul li.open>a>.sub-menu-arrow").removeClass("fa-chevron-down").addClass("fa-minus").addClass("rotate-in")}),200)})),e(document).on("click","[data-nav-target]",(function(){var n=e(this),o=n.data("nav-target");a.hasClass("navigation-toggle-one")&&a.addClass("navigation-show"),e(".navigation .navigation-menu-body .navigation-menu-group > div").removeClass("open"),e(".navigation .navigation-menu-body .navigation-menu-group "+o).addClass("open"),e("[data-nav-target]").removeClass("active"),n.addClass("active"),n.tooltip("hide")})),e(document).on("click",".navigation-toggler a",(function(){return n.width()<1200?(e.createOverlay(),a.addClass("navigation-show")):a.hasClass("navigation-toggle-one")||a.hasClass("navigation-toggle-two")?a.hasClass("navigation-toggle-one")&&!a.hasClass("navigation-toggle-two")?(a.addClass("navigation-toggle-two"),a.removeClass("navigation-toggle-one")):!a.hasClass("navigation-toggle-one")&&a.hasClass("navigation-toggle-two")&&(a.removeClass("navigation-toggle-two"),a.removeClass("navigation-toggle-one")):a.addClass("navigation-toggle-one"),!1})),e(document).on("click",".header-toggler a",(function(){return e(".header ul.navbar-nav").toggleClass("open"),!1})),e(document).on("click","*",(function(n){!e(n.target).is(e(".navigation, .navigation *, .navigation-toggler *"))&&a.hasClass("navigation-toggle-one")&&a.removeClass("navigation-show")})),e(document).on("click","*",(function(n){e(n.target).is(".header ul.navbar-nav, .header ul.navbar-nav *, .header-toggler, .header-toggler *")||e(".header ul.navbar-nav").removeClass("open")}));var o=e(".table-responsive");function t(){n.width()<768?e(".table-responsive").each((function(n){e(this).find(".table-responsive-thead").show(),e(this).find("thead").hide()})):e(".table-responsive").each((function(n){e(this).find(".table-responsive-thead").hide(),e(this).find("thead").show()}))}o.find("th").each((function(n){e(".table-responsive td:nth-child("+(n+1)+")").prepend('<span class="table-responsive-thead">'+e(this).text()+":</span> "),e(".table-responsive-thead").hide()})),o.each((function(){var n=100/e(this).find("th").length+"%";e(this).find("th, td").css("flex-basis",n)})),t(),window.onresize=function(e){t()},e(document).on("click",'[data-toggle="search"], [data-toggle="search"] *',(function(){return e(".header .header-body .header-search").show().find(".form-control").focus(),!1})),e(document).on("click",".close-header-search, .close-header-search svg",(function(){return e(".header .header-body .header-search").hide(),!1})),e(document).on("click","*",(function(n){e(n.target).is(e('.header, .header *, [data-toggle="search"], [data-toggle="search"] *'))||e(".header .header-body .header-search").hide()})),e(document).on("click",".accordion.custom-accordion .accordion-row a.accordion-header",(function(){var n=e(this);return n.closest(".accordion.custom-accordion").find(".accordion-row").not(n.parent()).removeClass("open"),n.parent(".accordion-row").toggleClass("open"),!1}));var i,r=e(".table-responsive");if(r.on("show.bs.dropdown",(function(n){i=e(n.target).find(".dropdown-menu"),a.append(i.detach());var o=e(n.target).offset();i.css({display:"block",top:o.top+e(n.target).outerHeight(),left:o.left,width:"184px","font-size":"14px"}),i.addClass("mobPosDropdown")})),r.on("hide.bs.dropdown",(function(n){e(n.target).append(i.detach()),i.hide()})),e(document).on("click",".chat-app-wrapper .btn-chat-sidebar-open",(function(){return e(".chat-app-wrapper .chat-sidebar").addClass("chat-sidebar-opened"),!1})),e(document).on("click","*",(function(n){e(n.target).is(".chat-app-wrapper .chat-sidebar, .chat-app-wrapper .chat-sidebar *, .chat-app-wrapper .btn-chat-sidebar-open, .chat-app-wrapper .btn-chat-sidebar-open *")||e(".chat-app-wrapper .chat-sidebar").removeClass("chat-sidebar-opened")})),e(document).on("click",".navigation ul li a",(function(){var o=e(this);if(o.next("ul").length){var t=o.find(".sub-menu-arrow");return t.toggleClass("rotate-in"),o.next("ul").toggle(200),o.parent("li").siblings().find("ul").not(o.parent("li").find("ul")).slideUp(200),o.next("ul").find("li ul").slideUp(200),o.next("ul").find("li>a").find(".sub-menu-arrow").removeClass("fa-minus").addClass("fa-chevron-down"),o.next("ul").find("li>a").find(".sub-menu-arrow").removeClass("rotate-in"),o.parent("li").siblings().not(o.parent("li").find("ul")).find(">a").find(".sub-menu-arrow").removeClass("fa-minus").addClass("fa-chevron-down"),o.parent("li").siblings().not(o.parent("li").find("ul")).find(">a").find(".sub-menu-arrow").removeClass("rotate-in"),t.hasClass("rotate-in")?setTimeout((function(){t.removeClass("fa-chevron-down").addClass("fa-minus")}),200):t.removeClass("fa-minus").addClass("fa-chevron-down"),!a.hasClass("horizontal-side-menu")&&n.width()>=1200&&setTimeout((function(n){e(".navigation .navigation-menu-body").getNiceScroll().resize()}),300),!1}})),e("body.small-navigation .navigation").hover((function(o){a.hasClass("small-navigation")&&!a.hasClass("horizontal-navigation")&&!a.hasClass("hidden-navigation")&&n.width()>=992&&e(".navigation .navigation-menu-body").niceScroll()}),(function(){e(".navigation .navigation-menu-body").getNiceScroll().remove(),e(".navigation ul").attr("style",null)})),e(document).on("click",".dropdown-menu",(function(e){e.stopPropagation()})),e("#exampleModal").on("show.bs.modal",(function(n){var a=e(n.relatedTarget).data("whatever"),o=e(this);o.find(".modal-title").text("New message to "+a),o.find(".modal-body input").val(a)})),e('[data-toggle="tooltip"]').tooltip({container:"body"}),e('[data-toggle="popover"]').popover(),e(".carousel").carousel(),n.width()>=992){e(".card-scroll").niceScroll(),e(".table-responsive").niceScroll(),e(".app-block .app-content .app-lists").niceScroll(),e(".app-block .app-sidebar .app-sidebar-menu").niceScroll(),e(".chat-block .chat-sidebar .chat-sidebar-content").niceScroll();var s=e(".chat-block .chat-content .messages");s.length&&(s.niceScroll({horizrailenabled:!1}),s.getNiceScroll(0).doScrollTop(s.get(0).scrollHeight,-1))}!a.hasClass("small-navigation")&&!a.hasClass("horizontal-navigation")&&!a.hasClass("hidden-navigation")&&n.width()>=992&&e(".navigation .navigation-menu-body").niceScroll(),e(".dropdown-menu ul.list-group").niceScroll(),e(document).on("click",".chat-block .chat-content .mobile-chat-close-btn a",(function(){return e(".chat-block .chat-content").removeClass("mobile-open"),!1}))}(jQuery)},function(e,n){},,,,,,function(e,n){}]);