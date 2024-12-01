import {Livewire} from '/vendor/livewire/livewire/dist/livewire.esm';
import Plyr from 'plyr';
import Mousetrap from "@danharrin/alpine-mousetrap";
import Focus from "@alpinejs/focus";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import mask from "@alpinejs/mask";

window.Plyr = Plyr;

import '/vendor/wire-elements/modal/resources/js/modal.js';
import './tiptap';

Alpine.plugin(Mousetrap)
Alpine.plugin(Focus);
Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);
Alpine.plugin(mask);

window.Alpine = Alpine;

Livewire.start()

import './unocss.js';
