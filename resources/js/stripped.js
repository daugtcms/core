import Alpine from "alpinejs";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import Plyr from 'plyr';
import initUnocssRuntime from '@unocss/runtime'
import config from '../../uno.config'
import 'uno.css'

window.Plyr = Plyr;

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);

Alpine.start()

initUnocssRuntime({ config })


