import Alpine from "alpinejs";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import Plyr from 'plyr';


window.Plyr = Plyr;

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);

Alpine.start()

import initUnocssRuntime from '@unocss/runtime'
import config from './uno.config'

initUnocssRuntime({ defaults: config })
import '@unocss/reset/tailwind.css'
