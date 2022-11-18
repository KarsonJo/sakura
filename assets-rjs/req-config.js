require.config({
    baseUrl: typeof themeUri !== 'undefined' ? themeUri :  "/wp-content/themes/sakura/assets",
    paths: {
        hljs: "components/code-block/highlight.pack",
        clipboard: "components/code-block/clipboard.min",
        hljsnum: "components/code-block/highlightjs-line-numbers.min",
        powermode: "components/activate-power-mode",
        lazyload: "components/lazyload.min",
        socialshare: "components/social-share.min",
        loadCSS: "components/loadCSS",
        tocbot: "components/tocbot/tocbot.min",
        sakura: "js/sakura-app",
        "jquery-pjax": "components/jquery.pjax.min"
    },
    shim: {
        socialshare: {
            exports: 'social_share'
        },
        loadCSS: {
            exports: 'loadCSS'
        },
        tocbot: {
            exports: 'tocbot'
        }, 
        hljsnum: {
            deps: ['hljs']
        }
    },
    waitSeconds: 60
});