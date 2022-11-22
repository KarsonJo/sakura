/*！
 * Sakura theme application bundle
 * @author Mashiro
 * @url https://2heng.xin
 * @date 2019.8.3
 */

mashiro_global.ini = new function () {
    this.normalize = function () { // initial functions when page first load (首次加载页面时的初始化函数)
        lazyload();
        social_share();
        // post_list_show_animation();
        // copy_code_block();
        // coverVideoIni();
        // checkskinSecter();
        // scrollBar();
    }
}

// ===== utility functions =====
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + mashiro_option.cookie_version_control + "=" + (value || "") + expires + "; path=/";
}

const getCookie = (name) => document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '';

function removeCookie(name) {
    document.cookie = name + mashiro_option.cookie_version_control + '=; Max-Age=-99999999;';
}

function imgError(ele, type) {
    switch (type) {
        case 1:
            ele.src = 'https://view.moezx.cc/images/2017/12/30/Transparent_Akkarin.th.jpg';
            break;
        case 2:
            ele.src = 'https://gravatar.shino.cc/avatar/?s=80&d=mm&r=g';
            break;
        default:
            ele.src = 'https://view.moezx.cc/images/2018/05/13/image-404.png';
    }
}

// https://www.educative.io/answers/how-to-dynamically-load-a-js-file-in-javascript
// https://stackoverflow.com/questions/27424109/iterate-over-array-of-winjs-promises-and-break-if-one-completed-successful?rq=1
/**
 * dynamically load javascript.
 * fallback if former one fails.
 * promise supported.
 * @param {*} urls source array in priority
 * @param {boolean} async
 * @param {string} type 
 * @returns Promise object
 */
function jsLoader(urls, async = true, type = "text/javascript") {
    var load = (url) => {
        return () => new Promise((resolve, reject) => {
            const scriptEle = document.createElement("script");
            try {
                scriptEle.type = type;
                scriptEle.async = async;
                scriptEle.src = url;

                scriptEle.addEventListener("load", () => resolve());
                scriptEle.addEventListener("error", () => { console.log("fallback to next src..."); rejectHandler(); });

                document.body.appendChild(scriptEle);
            } catch (error) {
                rejectHandler(error);
            }

            var rejectHandler = (e) => {
                document.body.removeChild(scriptEle);
                reject(e);
            }
        });
    };

    return urls.reduce((p, url) => p.catch(load(url)), Promise.reject()).catch((e) => { console.log("oops, all src failed"); throw e; });
}

function post_list_show_animation() {
    console.log("obsolete");
}

function code_highlight_style() {
    console.log("obsolete");
}

if (Poi.reply_link_version == 'new') {
    $('body').on('click', '.comment-reply-link', function () {
        addComment.moveForm("comment-" + $(this).attr('data-commentid'), $(this).attr('data-commentid'), "respond", $(this).attr('data-postid'));
        return false;
    });
}

function attach_image() {
    var cached = $('.insert-image-tips');
    $('#upload-img-file').change(function () {
        if (this.files.length > 10) {
            addComment.createButterbar("每次上传上限为10张.<br>10 files max per request.");
            return 0;
        }
        for (i = 0; i < this.files.length; i++) {
            if (this.files[i].size >= 5242880) {
                alert('图片上传大小限制为5 MB.\n5 MB max per file.\n\n「' + this.files[i].name + '」\n\n这张图太大啦~\nThis image is too large~');
            }
        }
        for (var i = 0; i < this.files.length; i++) {
            var f = this.files[i];
            var formData = new FormData();
            formData.append('cmt_img_file', f);
            $.ajax({
                url: Poi.api + 'sakura/v1/image/upload?_wpnonce=' + Poi.nonce,
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function (xhr) {
                    cached.html('<i class="fa fa-spinner rotating" aria-hidden="true"></i>');
                    addComment.createButterbar("上传中...<br>Uploading...");
                },
                success: function (res) {
                    cached.html('<i class="fa fa-check" aria-hidden="true"></i>');
                    setTimeout(function () {
                        cached.html('<i class="fa fa-picture-o" aria-hidden="true"></i>');
                    }, 1000);
                    if (res.status == 200) {
                        var get_the_url = res.proxy;
                        $('#upload-img-show').append('<img class="lazyload upload-image-preview" src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.0.2/img/svg/loader/trans.ajax-spinner-preloader.svg" data-src="' + get_the_url + '" onclick="window.open(\'' + get_the_url + '\')" onerror="imgError(this)" />');
                        lazyload();
                        addComment.createButterbar("图片上传成功~<br>Uploaded successfully~");
                        grin(get_the_url, type = 'Img');
                    } else {
                        addComment.createButterbar("上传失败！<br>Uploaded failed!<br> 文件名/Filename: " + f.name + "<br>code: " + res.status + "<br>" + res.message, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    cached.html('<i class="fa fa-times" aria-hidden="true" style="color:red"></i>');
                    alert("上传失败，请重试.\nUpload failed, please try again.");
                    setTimeout(function () {
                        cached.html('<i class="fa fa-picture-o" aria-hidden="true"></i>');
                    }, 1000);
                    // console.info(jqXHR.responseText);
                    // console.info(jqXHR.status);
                    // console.info(jqXHR.readyState);
                    // console.info(jqXHR.statusText);
                    // console.info(textStatus);
                    // console.info(errorThrown);
                }
            })
        }
    });
}

function clean_upload_images() {
    $('#upload-img-show').html('');
}

function add_upload_tips() {
    $('<div class="insert-image-tips popup"><i class="fa fa-picture-o" aria-hidden="true"></i><span class="insert-img-popuptext" id="uploadTipPopup">上传图片</span></div><input id="upload-img-file" type="file" accept="image/*" multiple="multiple" class="insert-image-button">').insertAfter($(".form-submit #submit"));
    attach_image();
    $("#upload-img-file").hover(function () {
        $(".insert-image-tips").addClass("insert-image-tips-hover");
        $("#uploadTipPopup").addClass("show");
    }, function () {
        $(".insert-image-tips").removeClass("insert-image-tips-hover");
        $("#uploadTipPopup").removeClass("show");
    });
}

function click_to_view_image() {
    $(".comment_inline_img").click(function () {
        var temp_url = this.src;
        window.open(temp_url);
    });
}
click_to_view_image();

function original_emoji_click() {
    $(".emoji-item").click(function () {
        grin($(this).text(), type = "custom", before = "`", after = "` ");
    });
}
original_emoji_click();

function showPopup(ele) {
    var popup = ele.querySelector("#thePopup");
    popup.classList.toggle("show");
}

// function cmt_showPopup(ele) {
//     var popup = $(ele).find("#thePopup");
//     popup.addClass("show");
//     $(ele).find("input").blur(function () {
//         popup.removeClass("show");
//     });
// }

function no_right_click() {
    $('.post-thumb img').bind('contextmenu', function (e) {
        return false;
    });
}
no_right_click();
$(document).ready(function () {

    add_upload_tips();
});

function timeSeriesReload(flag) {
    var cached = $('#archives');
    if (flag == true) {
        cached.find('span.al_mon').click(function () {
            $(this).next().slideToggle(400);
            return false;
        });
        lazyload();
    } else {
        (function () {
            $('#al_expand_collapse,#archives span.al_mon').css({
                cursor: "s-resize"
            });
            cached.find('span.al_mon').each(function () {
                var num = $(this).next().children('li').length;
                $(this).children('#post-num').text(num);
            });
            var $al_post_list = cached.find('ul.al_post_list'),
                $al_post_list_f = cached.find('ul.al_post_list:first');
            $al_post_list.hide(1, function () {
                $al_post_list_f.show();
            });
            cached.find('span.al_mon').click(function () {
                $(this).next().slideToggle(400);
                return false;
            });
            if (document.body.clientWidth > 860) {
                cached.find('li.al_li').mouseover(function () {
                    $(this).children('.al_post_list').show(400);
                    return false;
                });
                if (false) {
                    cached.find('li.al_li').mouseout(function () {
                        $(this).children('.al_post_list').hide(400);
                        return false;
                    });
                }
            }
            var al_expand_collapse_click = 0;
            $('#al_expand_collapse').click(function () {
                if (al_expand_collapse_click == 0) {
                    $al_post_list.each(function (index) {
                        var $this = $(this),
                            s = setTimeout(function () {
                                $this.show(400);
                            }, 50 * index);
                    });
                    al_expand_collapse_click++;
                } else if (al_expand_collapse_click == 1) {
                    $al_post_list.each(function (index) {
                        var $this = $(this),
                            h = setTimeout(function () {
                                $this.hide(400);
                            }, 50 * index);
                    });
                    al_expand_collapse_click--;
                }
            });
        })();
    }
}
timeSeriesReload();

// karson_fin_todo
// change the awkward toc remove functionality
function tableOfContentScroll() {
    console.log("obsolete");
}

$(document).on("click", ".sm", function () {
    var msg = "您真的要设为私密吗？";
    if (confirm(msg) == true) {
        $(this).commentPrivate();
    } else {
        alert("已取消");
    }
});
$.fn.commentPrivate = function () {
    if ($(this).hasClass('private_now')) {
        alert('您之前已设过私密评论');
        return false;
    } else {
        $(this).addClass('private_now');
        var idp = $(this).data('idp'),
            actionp = $(this).data('actionp'),
            rateHolderp = $(this).children('.has_set_private');
        var ajax_data = {
            action: "siren_private",
            p_id: idp,
            p_action: actionp
        };
        $.post("/wp-admin/admin-ajax.php", ajax_data, function (data) {
            $(rateHolderp).html(data);
        });
        return false;
    }
};

function motionSwitch(ele) {
    var motionEles = [".bili", ".menhera", ".tieba"];
    for (var i in motionEles) {
        $(motionEles[i] + '-bar').removeClass("on-hover");
        $(motionEles[i] + '-container').css("display", "none");
    }
    $(ele + '-bar').addClass("on-hover");
    $(ele + '-container').css("display", "block");
}
$('.comt-addsmilies').click(function () {
    $('.comt-smilies').toggle();
})
$('.comt-smilies a').click(function () {
    $(this).parent().hide();
})

function smileBoxToggle() {
    $(document).ready(function () {
        $("#emotion-toggle").click(function () {
            $(".emotion-toggle-off").toggle(0);
            $(".emotion-toggle-on").toggle(0);
            $(".emotion-box").toggle(160);
        });
    });
}
smileBoxToggle();

function grin(tag, type, before, after) {
    var myField;
    if (type == "custom") {
        tag = before + tag + after;
    } else if (type == "Img") {
        tag = '[img]' + tag + '[/img]';
    } else if (type == "Math") {
        tag = ' {{' + tag + '}} ';
    } else {
        tag = ' :' + tag + ': ';
    }
    if (addComment.I('comment') && addComment.I('comment').type == 'textarea') {
        myField = addComment.I('comment');
    } else {
        return false;
    }
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
    } else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = endPos;
        myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
    } else {
        myField.value += tag;
        myField.focus();
    }
}

function add_copyright() {
    document.body.addEventListener("copy", function (e) {
        if (window.getSelection().toString().length > 30 && mashiro_option.clipboardCopyright) {
            setClipboardText(e);
        }
        addComment.createButterbar("复制成功！<br>Copied to clipboard successfully!", 1000);
    });

    function setClipboardText(event) {
        event.preventDefault();
        var htmlData = "# 商业转载请联系作者获得授权，非商业转载请注明出处。<br>" + "# For commercial use, please contact the author for authorization. For non-commercial use, please indicate the source.<br>" + "# 协议(License)：署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)<br>" + "# 作者(Author)：" + mashiro_option.author_name + "<br>" + "# 链接(URL)：" + window.location.href + "<br>" + "# 来源(Source)：" + mashiro_option.site_name + "<br><br>" + window.getSelection().toString().replace(/\r\n/g, "<br>");;
        var textData = "# 商业转载请联系作者获得授权，非商业转载请注明出处。\n" + "# For commercial use, please contact the author for authorization. For non-commercial use, please indicate the source.\n" + "# 协议(License)：署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)\n" + "# 作者(Author)：" + mashiro_option.author_name + "\n" + "# 链接(URL)：" + window.location.href + "\n" + "# 来源(Source)：" + mashiro_option.site_name + "\n\n" + window.getSelection().toString().replace(/\r\n/g, "\n");
        if (event.clipboardData) {
            event.clipboardData.setData("text/html", htmlData);
            event.clipboardData.setData("text/plain", textData);
        } else if (window.clipboardData) {
            return window.clipboardData.setData("text", textData);
        }
    }
}
add_copyright();
$(function () {
    getqqinfo();
});

if (mashiro_option.float_player_on) {
    function aplayerF() {
        'use strict';
        var aplayers = [],
            loadMeting = function () {
                function a(a, b) {
                    var c = {
                        container: a,
                        audio: b,
                        mini: null,
                        fixed: null,
                        autoplay: !1,
                        mutex: !0,
                        lrcType: 3,
                        listFolded: 1,
                        preload: 'auto',
                        theme: '#2980b9',
                        loop: 'all',
                        order: 'list',
                        volume: null,
                        listMaxHeight: null,
                        customAudioType: null,
                        storageName: 'metingjs'
                    };
                    if (b.length) {
                        b[0].lrc || (c.lrcType = 0);
                        var d = {};
                        for (var e in c) {
                            var f = e.toLowerCase();
                            (a.dataset.hasOwnProperty(f) || a.dataset.hasOwnProperty(e) || null !== c[e]) && (d[e] = a.dataset[f] || a.dataset[e] || c[e], ('true' === d[e] || 'false' === d[e]) && (d[e] = 'true' == d[e]))
                        }
                        aplayers.push(new APlayer(d))
                    }
                    for (var f = 0; f < aplayers.length; f++) try {
                        aplayers[f].lrc.hide();
                    } catch (a) {
                        console.log(a)
                    }
                    var lrcTag = 1;
                    $(".aplayer.aplayer-fixed").click(function () {
                        if (lrcTag == 1) {
                            for (var f = 0; f < aplayers.length; f++) try {
                                aplayers[f].lrc.show();
                            } catch (a) {
                                console.log(a)
                            }
                        }
                        lrcTag = 2;
                    });
                    var apSwitchTag = 0;
                    $(".aplayer.aplayer-fixed .aplayer-body").addClass("ap-hover");
                    $(".aplayer-miniswitcher").click(function () {
                        if (apSwitchTag == 0) {
                            $(".aplayer.aplayer-fixed .aplayer-body").removeClass("ap-hover");
                            $("#secondary").addClass("active");
                            apSwitchTag = 1;
                        } else {
                            $(".aplayer.aplayer-fixed .aplayer-body").addClass("ap-hover");
                            $("#secondary").removeClass("active");
                            apSwitchTag = 0;
                        }
                    });
                }
                var b = mashiro_option.meting_api_url + '?server=:server&type=:type&id=:id&_wpnonce=' + Poi.nonce;
                'undefined' != typeof meting_api && (b = meting_api);
                for (var f = 0; f < aplayers.length; f++) try {
                    aplayers[f].destroy()
                } catch (a) {
                    console.log(a)
                }
                aplayers = [];
                for (var c = document.querySelectorAll('.aplayer'), d = function () {
                    var d = c[e],
                        f = d.dataset.id;
                    if (f) {
                        var g = d.dataset.api || b;
                        g = g.replace(':server', d.dataset.server), g = g.replace(':type', d.dataset.type), g = g.replace(':id', d.dataset.id);
                        var h = new XMLHttpRequest;
                        h.onreadystatechange = function () {
                            if (4 === h.readyState && (200 <= h.status && 300 > h.status || 304 === h.status)) {
                                var b = JSON.parse(h.responseText);
                                a(d, b)
                            }
                        }, h.open('get', g, !0), h.send(null)
                    } else if (d.dataset.url) {
                        var i = [{
                            name: d.dataset.name || d.dataset.title || 'Audio name',
                            artist: d.dataset.artist || d.dataset.author || 'Audio artist',
                            url: d.dataset.url,
                            cover: d.dataset.cover || d.dataset.pic,
                            lrc: d.dataset.lrc,
                            type: d.dataset.type || 'auto'
                        }];
                        a(d, i)
                    }
                }, e = 0; e < c.length; e++) d()
            };
        document.addEventListener('DOMContentLoaded', loadMeting, !1);
    }
    if (document.body.clientWidth > 860) {
        aplayerF();
    }
}

function getqqinfo() {
    var is_get_by_qq = false,
        cached = $('input');
    if (!getCookie('user_qq') && !getCookie('user_qq_email') && !getCookie('user_author')) {
        cached.filter('#qq,#author,#email,#url').val('');
    }
    if (getCookie('user_avatar') && getCookie('user_qq') && getCookie('user_qq_email')) {
        $('div.comment-user-avatar img').attr('src', getCookie('user_avatar'));
        cached.filter('#author').val(getCookie('user_author'));
        cached.filter('#email').val(getCookie('user_qq') + '@qq.com');
        cached.filter('#qq').val(getCookie('user_qq'));
        if (mashiro_option.qzone_autocomplete) {
            cached.filter('#url').val('https://user.qzone.qq.com/' + getCookie('user_qq'));
        }
        if (cached.filter('#qq').val()) {
            $('.qq-check').css('display', 'block');
            $('.gravatar-check').css('display', 'none');
        }
    }
    var emailAddressFlag = cached.filter('#email').val();
    cached.filter('#author').on('blur', function () {
        var qq = cached.filter('#author').val(),
            $reg = /^[1-9]\d{4,9}$/;
        if ($reg.test(qq)) {
            $.ajax({
                type: 'get',
                url: mashiro_option.qq_api_url + '?qq=' + qq + '&_wpnonce=' + Poi.nonce,
                dataType: 'json',
                success: function (data) {
                    cached.filter('#author').val(data.name);
                    cached.filter('#email').val($.trim(qq) + '@qq.com');
                    if (mashiro_option.qzone_autocomplete) {
                        cached.filter('#url').val('https://user.qzone.qq.com/' + $.trim(qq));
                    }
                    $('div.comment-user-avatar img').attr('src', 'https://q2.qlogo.cn/headimg_dl?dst_uin=' + qq + '&spec=100');
                    is_get_by_qq = true;
                    cached.filter('#qq').val($.trim(qq));
                    if (cached.filter('#qq').val()) {
                        $('.qq-check').css('display', 'block');
                        $('.gravatar-check').css('display', 'none');
                    }
                    setCookie('user_author', data.name, 30);
                    setCookie('user_qq', qq, 30);
                    setCookie('is_user_qq', 'yes', 30);
                    setCookie('user_qq_email', qq + '@qq.com', 30);
                    setCookie('user_email', qq + '@qq.com', 30);
                    emailAddressFlag = cached.filter('#email').val();
                    /***/
                    $('div.comment-user-avatar img').attr('src', data.avatar);
                    setCookie('user_avatar', data.avatar, 30);
                },
                error: function () {
                    cached.filter('#qq').val('');
                    $('.qq-check').css('display', 'none');
                    $('.gravatar-check').css('display', 'block');
                    $('div.comment-user-avatar img').attr('src', get_gravatar(cached.filter('#email').val(), 80));
                    setCookie('user_qq', '', 30);
                    setCookie('user_email', cached.filter('#email').val(), 30);
                    setCookie('user_avatar', get_gravatar(cached.filter('#email').val(), 80), 30);
                    /***/
                    cached.filter('#qq,#email,#url').val('');
                    if (!cached.filter('#qq').val()) {
                        $('.qq-check').css('display', 'none');
                        $('.gravatar-check').css('display', 'block');
                        setCookie('user_qq', '', 30);
                        $('div.comment-user-avatar img').attr('src', get_gravatar(cached.filter('#email').val(), 80));
                        setCookie('user_avatar', get_gravatar(cached.filter('#email').val(), 80), 30);
                    }
                }
            });
        }
    });
    if (getCookie('user_avatar') && getCookie('user_email') && getCookie('is_user_qq') == 'no' && !getCookie('user_qq_email')) {
        $('div.comment-user-avatar img').attr('src', getCookie('user_avatar'));
        cached.filter('#email').val(getCookie('user_email'));
        cached.filter('#qq').val('');
        if (!cached.filter('#qq').val()) {
            $('.qq-check').css('display', 'none');
            $('.gravatar-check').css('display', 'block');
        }
    }
    cached.filter('#email').on('blur', function () {
        var emailAddress = cached.filter('#email').val();
        if (is_get_by_qq == false || emailAddressFlag != emailAddress) {
            $('div.comment-user-avatar img').attr('src', get_gravatar(emailAddress, 80));
            setCookie('user_avatar', get_gravatar(emailAddress, 80), 30);
            setCookie('user_email', emailAddress, 30);
            setCookie('user_qq_email', '', 30);
            setCookie('is_user_qq', 'no', 30);
            cached.filter('#qq').val('');
            if (!cached.filter('#qq').val()) {
                $('.qq-check').css('display', 'none');
                $('.gravatar-check').css('display', 'block');
            }
        }
    });
    if (getCookie('user_url')) {
        cached.filter('#url').val(getCookie('user_url'));
    }
    cached.filter('#url').on('blur', function () {
        var URL_Address = cached.filter('#url').val();
        cached.filter('#url').val(URL_Address);
        setCookie('user_url', URL_Address, 30);
    });
    if (getCookie('user_author')) {
        cached.filter('#author').val(getCookie('user_author'));
    }
    cached.filter('#author').on('blur', function () {
        var user_name = cached.filter('#author').val();
        cached.filter('#author').val(user_name);
        setCookie('user_author', user_name, 30);
    });
}

function mail_me() {
    var mail = "mailto:" + mashiro_option.email_name + "@" + mashiro_option.email_domain;
    window.open(mail);
}

function activate_widget() {
    if (document.body.clientWidth > 860) {
        $('.show-hide').on('click', function () {
            $("#secondary").toggleClass("active")
        });
    } else {
        $("#secondary").remove();
    }
}
setTimeout(function () {
    activate_widget();
}, 100);

mashiro_global.ini.normalize();

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

// header cover mode
(function () {
    if (Poi.windowheight == 'auto' && mashiro_option.windowheight == 'auto') {
        $('.headertop').addClass('height-full');
    } else {
        $('.headertop').addClass('headertop-bar');
    }
})();

// scroll down check
(function () {
    var $bar = $("#bar");

    // const scrollProgress = () => $(window).scrollTop() / ($(document).height() - $(window).height()) * 100

    function updateScroll() {
        var p = $(window).scrollTop() / ($(document).height() - $(window).height()) * 100;
        p > 0 ? $("body").addClass('scroll-down') : $("body").removeClass('scroll-down');
        if ($bar.length) $bar.css("width", p + "%");
    }

    updateScroll();

    $(window).scroll(updateScroll);
})();

// simple video controller
(function () {
    var videoSelect = $('#bgvideo');
    var videoElem = videoSelect[0];
    if (typeof videoElem === 'undefined') {
        return;
    }

    (function init() {
        $('#video-btn').on('click', toggleVideoBtn);
        $('#video-add').on('click', switchVideo);
        videoElem.oncanplay = onCanplay;
        videoElem.onended = onEnded;
    })();

    function onCanplay() {
        playVideo();
        videoSelect.addClass('focus');
        $('#video-add').show();
    }

    function onEnded() {
        unloadVideo();
        videoSelect.removeClass('focus');
        $('#video-add').hide();
    }

    function playVideo() {
        $('#video-btn').addClass('video-playing');
        $('.focusinfo').addClass('video-playing');
        HideStatus();
        videoElem.play();
    }

    function pauseVideo(showMsg) {
        $('#video-btn').removeClass('video-playing');
        $('.focusinfo').removeClass('video-playing');
        if (showMsg) {
            ShowStatus('已暂停 ...');
        }
        videoElem.pause();
    }

    function switchVideo() {
        if (!videoElem.paused) {
            pauseVideo(false);
        }
        loadVideo();
    }

    function loadVideo() {
        ShowStatus('正在载入视频 ...');
        var media = legacyChoose();
        videoSelect.attr('src', media.videoElem).attr('video-name', media.videoName);
    }

    function unloadVideo() {
        pauseVideo(false);
        HideStatus();
        videoSelect.removeAttr('src');
        videoElem.load(); /* update */
    }

    function toggleVideoBtn() {
        if (videoElem.paused) {
            if (videoElem.readyState === 0) {
                loadVideo();
            }
            else {
                playVideo();
            }
        } else {
            pauseVideo(true);
        }
    }

    // karson_todo
    // legacy function that choosing a media: remove
    function legacyChoose() {
        var t = Poi.movies.name.split(","),
            _t = t[Math.floor(Math.random() * t.length)],
            videoElem = Poi.movies.url + '/' + _t + '.mp4',
            videoName = _t;
        return { videoElem, videoName };
    }

    function ShowStatus(msg) { $('.video-stu').html(msg).addClass('show'); }

    function HideStatus() { $('.video-stu').removeClass('show'); }
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
(function () {
    var pc_to_top = document.querySelector(".cd-top"),
        mb_to_top = document.querySelector("#mobileGoTop");

    pc_to_top.onclick = topFunction;
    mb_to_top.onclick = topFunction;

    function topFunction() {
        $('body,html').animate({
            scrollTop: 0
        })
    }
})();

// ===== scattered initialize here =====
//eg. click events
(function () {
    //mobile navigation
    $('.iconflat').on('click', () => {
        $('body').toggleClass('navOpen');
        $('#main-container,#mo-nav,.openNav').toggleClass('open');
    });

    //search
    $('.search-btn').on('click', () => {
        $('.search-panel').addClass('visible');
        $('html').addClass('no-overflow');
    });
    $('.search-close').on('click', ()=> {
        $('.search-panel').removeClass('visible');
        $('html').removeClass('no-overflow');
    });
})();

var home = location.href,
    Siren = {
        CE: function () {
            $('.archives').hide();
            $('.archives:first').show();
            $('#archives-temp h3').click(function () {
                $(this).next().slideToggle('fast');
                return false;
            });
            if (mashiro_option.baguetteBoxON) {
                baguetteBox.run('.entry-content', {
                    captions: function (element) {
                        return element.getElementsByTagName('img')[0].alt;
                    },
                    ignoreClass: 'fancybox',
                });
            }
        },
        XCS: function () {
            var __cancel = jQuery('#cancel-comment-reply-link'),
                __cancel_text = __cancel.text(),
                __list = 'commentwrap';
            jQuery(document).on("submit", "#commentform", function () {
                jQuery.ajax({
                    url: Poi.ajaxurl,
                    data: jQuery(this).serialize() + "&action=ajax_comment",
                    type: jQuery(this).attr('method'),
                    beforeSend: addComment.createButterbar("提交中(Commiting)...."),
                    error: function (request) {
                        var t = addComment;
                        t.createButterbar(request.responseText);
                    },
                    success: function (data) {
                        jQuery('textarea').each(function () {
                            this.value = ''
                        });
                        var t = addComment,
                            cancel = t.I('cancel-comment-reply-link'),
                            temp = t.I('wp-temp-form-div'),
                            respond = t.I(t.respondId),
                            post = t.I('comment_post_ID').value,
                            parent = t.I('comment_parent').value;
                        if (parent != '0') {
                            jQuery('#respond').before('<ol class="children">' + data + '</ol>');
                        } else if (!jQuery('.' + __list).length) {
                            if (Poi.formpostion == 'bottom') {
                                jQuery('#respond').before('<ol class="' + __list + '">' + data + '</ol>');
                            } else {
                                jQuery('#respond').after('<ol class="' + __list + '">' + data + '</ol>');
                            }
                        } else {
                            if (Poi.order == 'asc') {
                                jQuery('.' + __list).append(data);
                            } else {
                                jQuery('.' + __list).prepend(data);
                            }
                        }
                        t.createButterbar("提交成功(Succeed)");
                        lazyload();
                        code_highlight_style();
                        click_to_view_image();
                        clean_upload_images();
                        cancel.style.display = 'none';
                        cancel.onclick = null;
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp)
                        }
                    }
                });
                return false;
            });
            //karson_todo
            //holy... wtf is this usage?
            addComment = {
                moveForm: function (commId, parentId, respondId) {
                    var t = this,
                        div, comm = t.I(commId),
                        respond = t.I(respondId),
                        cancel = t.I('cancel-comment-reply-link'),
                        parent = t.I('comment_parent'),
                        post = t.I('comment_post_ID');
                    __cancel.text(__cancel_text);
                    t.respondId = respondId;
                    if (!t.I('wp-temp-form-div')) {
                        div = document.createElement('div');
                        div.id = 'wp-temp-form-div';
                        div.style.display = 'none';
                        respond.parentNode.insertBefore(div, respond)
                    } !comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
                    jQuery("body").animate({
                        scrollTop: jQuery('#respond').offset().top - 180
                    }, 400);
                    parent.value = parentId;
                    cancel.style.display = '';
                    cancel.onclick = function () {
                        var t = addComment,
                            temp = t.I('wp-temp-form-div'),
                            respond = t.I(t.respondId);
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp);
                        }
                        this.style.display = 'none';
                        this.onclick = null;
                        return false;
                    };
                    try {
                        t.I('comment').focus();
                    } catch (e) { }
                    return false;
                },
                I: function (e) {
                    return document.getElementById(e);
                },
                clearButterbar: function (e) {
                    if (jQuery(".butterBar").length > 0) {
                        jQuery(".butterBar").remove();
                    }
                },
                createButterbar: function (message, showtime) {
                    var t = this;
                    t.clearButterbar();
                    jQuery("body").append('<div class="butterBar butterBar--center"><p class="butterBar-message">' + message + '</p></div>');
                    if (showtime > 0) {
                        setTimeout("jQuery('.butterBar').remove()", showtime);
                    } else {
                        setTimeout("jQuery('.butterBar').remove()", 6000);
                    }
                }
            };
        },
        XCP: function () {
            $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
            $('body').on('click', '#comments-navi a', function (e) {
                e.preventDefault();
                var path = $(this)[0].pathname;
                $.ajax({
                    type: "GET",
                    url: $(this).attr('href'),
                    beforeSend: function () {
                        $('#comments-navi').remove();
                        $('ul.commentwrap').remove();
                        $('#loading-comments').slideDown();
                        $body.animate({
                            scrollTop: $('#comments-list-title').offset().top - 65
                        }, 800);
                    },
                    dataType: "html",
                    success: function (out) {
                        result = $(out).find('ul.commentwrap');
                        nextlink = $(out).find('#comments-navi');
                        $('#loading-comments').slideUp('fast');
                        $('#loading-comments').after(result.fadeIn(500));
                        $('ul.commentwrap').after(nextlink);
                        lazyload();
                        if (window.gtag) {
                            gtag('config', Poi.google_analytics_id, {
                                'page_path': path
                            });
                        }
                        code_highlight_style();
                        click_to_view_image();
                    }
                });
            });
        },

    }
$(function () {
    Siren.XCS();
    Siren.XCP();
    Siren.CE();
    $.fn.postLike = function () {
        if ($(this).hasClass('done')) {
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
                action = $(this).data('action'),
                rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "specs_zan",
                um_id: id,
                um_action: action
            };
            $.post(Poi.ajaxurl, ajax_data, function (data) {
                $(rateHolder).html(data);
            });
            return false;
        }
    };
    $(document).on("click", ".specsZan", function () {
        $(this).postLike();
    });
    console.log("%c Mashiro %c", "background:#24272A; color:#ffffff", "", "https://2heng.xin/");
    console.log("%c Github %c", "background:#24272A; color:#ffffff", "", "https://github.com/mashirozx");
});