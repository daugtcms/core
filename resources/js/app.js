import {Livewire} from '/vendor/livewire/livewire/dist/livewire.esm';
import Mousetrap from '@danharrin/alpine-mousetrap'
import '@nextapps-be/livewire-sortablejs';
import Focus from "@alpinejs/focus";
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
import Intersect from "@alpinejs/intersect";
import mask from "@alpinejs/mask";

import * as FilePond from 'filepond';
import {registerPlugin} from "filepond";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import de_de from 'filepond/locale/de-de';

import Plyr from 'plyr';

import '/vendor/wire-elements/pro/resources/js/overlay-component.js'


registerPlugin(FilePondPluginImagePreview);
FilePond.setOptions(de_de);
window.FilePond = FilePond;
window.Plyr = Plyr;

import './tiptap';
import './block-editor'
import './tooltip'

Alpine.plugin(Mousetrap)
Alpine.plugin(Focus);
Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);
Alpine.plugin(mask);

Livewire.start()