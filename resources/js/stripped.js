import Alpine from "alpinejs";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import Plyr from 'plyr';


window.Plyr = Plyr;

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);

Alpine.start()

import './unocss.js';