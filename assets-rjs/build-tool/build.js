{
    optimize: "none",
    mainConfigFile: "../req-config.js",
    appDir: "../../assets-dev",
    baseUrl: ".",
    dir: "../../assets",
    removeCombined: true,
    modules: [
        {
            name: "require/req-list",
        },
        {
            name: "require/page-post/req-list",
            exclude: ["require/req-list"],
        },
    ]
}