import {domReady} from '@roots/sage/client';
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faFacebook, faTwitter } from "@fortawesome/free-brands-svg-icons";

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // application code
  library.add(faFacebook, faTwitter);
  dom.watch();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
