import {Livewire} from '/vendor/livewire/livewire/dist/livewire.esm';
import Mousetrap from '@danharrin/alpine-mousetrap'
import '@nextapps-be/livewire-sortablejs';
import Focus from "@alpinejs/focus";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";

import './tiptap';
import './block-editor'
import './tooltip'

Alpine.plugin(Mousetrap)
Alpine.plugin(Focus);
Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);

Livewire.start()