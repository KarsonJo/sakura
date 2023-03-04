// @fortawesome/free-solid-svg-icons
// @fortawesome/free-regular-svg-icons
// @fortawesome/free-brands-svg-icons
// @fortawesome/pro-solid-svg-icons
// @fortawesome/pro-regular-svg-icons
// @fortawesome/pro-light-svg-icons
// @fortawesome/pro-thin-svg-icons
// @fortawesome/pro-duotone-svg-icons
// @fortawesome/sharp-solid-svg-icons

import { domReady } from '@roots/sage/client';
import 'lazyload';
// import { library, dom } from '@fortawesome/fontawesome-svg-core';
// import {
//   faFacebook,
//   faTwitter,
// } from "@fortawesome/free-brands-svg-icons";
// import {
//   magnifyingGlass,
// } from "@fortawesome/free-brands-svg-icons";

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code

  const getCookie = (name) => document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '';

  // active power mode
  (function () {
    const $elem = $("textarea, .powermode"); //select all textarea and powermode class

    var io = new IntersectionObserver(init, { root: null, threshold: [0] })

    function init(entries) {
      if (entries.some((x) => x.intersectionRatio > 0)) {
        jsLoader(themeNova.cdn.powermode)
          .then(() => {
            POWERMODE.colorful = true; // make power mode colorful
            POWERMODE.shake = false; // turn off shake
            $elem.each((_, x) => x.addEventListener('input', POWERMODE));
          })
        io.disconnect();
      }
    }

    $elem.each((_, x) => io.observe(x));
  })();

  //table of content
  (function () {
    if ($("#have-toc").length) {
      $(".toc-container").addClass("visible");
      $(".entry-content , .links").children("h1,h2,h3,h4,h5").each(function (i) {
        this.id = "toc-head-" + i;
      });
      tocbot.init({
        tocSelector: '.toc',
        contentSelector: ['.entry-content', '.links'],
        headingSelector: 'h1, h2, h3, h4, h5'
      });
    }
  })();

  // switch cover image
  (function () {
    var bgn = 1;

    function loadBG(idx) {
      $("#centerbg").attr("src", mashiro_option.cover_api + "?" + idx);
    }

    function nextBG() {
      loadBG(++bgn);
    }

    function preBG() {
      loadBG(--bgn);
    }

    $(document).ready(function () {
      $("#bg-next").click(function () {
        nextBG();
      });
      $("#bg-pre").click(function () {
        preBG();
      });
    });
  })();

  // theme style control (background and font)
  (function () {
    // karson_todo
    // separate dark mode and theme
    const $menuList = $(".menu-list");
    const $fontList = $(".font-family-controls");
    const fontClassPrefix = "font-";
    const fontClassRegex = new RegExp(`(^|\\s)${fontClassPrefix}\\S+`, "g");

    function skinValid(skin) {
      return skin != "none";
    }

    function isNight() {
      var hour = new Date().getHours();
      return hour > 22 || hour < 7;
    }

    function initClickEvent() {
      $menuList.on("click", "li", function () {
        setSkin($(this));
        // closeSkinMenu();
        return false;
      })
      $fontList.on("click", "li", function () {
        setFont($(this));
        return false;
      })
      $("#mobileDark").on("click", function () {
        setSkin($(this));
        return false;
      })
    }

    function readTheme() {
      if (isNight()) {
        setDarkMode(true);
      }
      simulateClick(getCookie("bgImgSetting"));
      simulateClick(getCookie("fontFamily"));
    }

    function simulateClick(id) {
      if (id) {
        $("#" + id).click();
      }
    }

    function setSkin($elem) {
      // toggle dark mode?
      if ($elem.hasClass('dark-toggle')) {
        toggleDarkMode();
        return;
      }
      // switch skin!
      var src = $elem.data("src");

      $("body").css("background-image", skinValid(src) ? "url(" + src + ")" : "none");
      setCookie("bgImgSetting", $elem[0].id, 30);

      updateSelect($menuList, $elem);
    }

    function updateSelect($ctn, $elem) {
      $ctn.find(".selected").removeClass("selected");
      $elem.addClass("selected");
    }

    function toggleDarkMode() {
      $("body").toggleClass("dark");
    }

    function setDarkMode(enabled) {
      enabled ? $("body").addClass("dark") : $("body").removeClass("dark");
    }

    function closeSkinMenu() {
      $(".skin-menu").removeClass('show');
    }

    function setFont($elem) {
      $("body").removeClass((_, name) => (name.match(fontClassRegex) || []).join(' ')).addClass(fontClassPrefix + $elem.data("tag"));
      setCookie("fontFamily", $elem[0].id, 30);
    }

    //click events
    $(".changeSkin-gear").click(() => {
      // if (e.target !== e.currentTarget) return;
      $(".skin-menu").toggleClass('show');
    })

    $(document).ready(() => {
      initClickEvent();
      readTheme();
    });

    $(window).scroll(() => {
      $(".skin-menu").removeClass('show');
    });
  })();

  // scroll down check
  (function () {
    var $bar = $("#bar");

    // const scrollProgress = () => $(window).scrollTop() / ($(document).height() - $(window).height()) * 100

    function updateScroll() {
      var p = $(window).scrollTop() / ($(document).height() - $(window).height()) * 100;
      p > 0 ? $("body").addClass('scroll') : $("body").removeClass('scroll');
      if ($bar.length) $bar.css("width", p + "%");
    }

    updateScroll();

    $(window).scroll(updateScroll);
  })();

  // ajax load main post
  (function () {
    initPost("#pagination", "#main .post");

    function initPost(pagination_selector, post_selector) {
      elemPeekInAnim($(post_selector));
      $('body').on('click', pagination_selector + ' a', function () {
        clearTimeout();
        loadPost(pagination_selector, post_selector);
        return false;
      });
    }

    function elemPeekInAnim(articles) {
      var options = {
        root: null,
        threshold: [0.66]
      }

      var io = new IntersectionObserver(peek_in, options);

      articles.each(function () {
        // hide if first time in viewbox
        // cannot just set in css because we don't want the content invisible if js crashes
        var article = $(this);
        article.addClass('transparent');
        io.observe(article[0])
      })

      function peek_in(entries) {
        entries.forEach((entry) => {
          $(entry.target).removeClass('transparent').addClass("peek-in");
          io.unobserve(entry.target);
        })
      }
    }

    function loadPost(pagination_selector, post_selector) {
      var $pagi_link = $(pagination_selector + " a"); //pagiation link

      $pagi_link.addClass("loading").text("");
      $.ajax({
        type: "POST",
        url: $pagi_link.attr("href")
      })
        .done(function (data) {
          var posts = $(data).find(post_selector);
          lazyload(posts.find('.lazyload'));

          $(post_selector).first().parent().append(posts); //append to the container relatively
          $(pagination_selector).replaceWith($(data).find(pagination_selector)) //replace pagination object

          elemPeekInAnim(posts);
        })
        .fail(function () {
          $pagi_link.removeClass("loading").text("请重试");
        });
    }
  })();

  //go top
  // (function () {
  //   var pc_to_top = document.querySelector(".cd-top"),
  //     mb_to_top = document.querySelector("#mobileGoTop");

  //   pc_to_top.onclick = topFunction;
  //   mb_to_top.onclick = topFunction;

  //   function topFunction() {
  //     $('body,html').animate({
  //       scrollTop: 0
  //     })
  //   }
  // })();

  // ===== scattered initialize here =====
  //eg. click events
  (function () {
    //mobile navigation
    $('.iconflat').on('click', () => {
      $('body').toggleClass('navOpen');
      $('#main-container,#mo-nav,.openNav').toggleClass('open');
    });

    //search
    $('.searchbox').on('click', () => {
      $('.search-panel').addClass('show');
      $('html').addClass('overflow-hidden');
    });
    $('.search-close').on('click', () => {
      $('.search-panel').removeClass('show');
      $('html').removeClass('overflow-hidden');
    });
  })();

  (function(){
    lazyload();
  })();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
