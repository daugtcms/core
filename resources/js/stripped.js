import Alpine from "alpinejs";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import Plyr from 'plyr';
import Focus from "@alpinejs/focus";

import './pdf';

window.Plyr = Plyr;

import './tiptap.js';

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);
Alpine.plugin(Focus);

window.Alpine = Alpine;

Alpine.start()

import './unocss.js';
