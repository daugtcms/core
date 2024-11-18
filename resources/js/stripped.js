import Alpine from "alpinejs";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import Plyr from 'plyr';

import './pdf';

window.Plyr = Plyr;

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);
Alpine.plugin(Focus);

Alpine.start()

import './unocss.js';
import Focus from "@alpinejs/focus";
