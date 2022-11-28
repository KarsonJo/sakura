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
  // library.add(faFacebook, faTwitter);
  // dom.watch();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
