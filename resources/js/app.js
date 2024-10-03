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
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import de_de from 'filepond/locale/de-de';

import Plyr from 'plyr';

registerPlugin(FilePondPluginImagePreview);
registerPlugin(FilePondPluginImageExifOrientation);
FilePond.setOptions(de_de);
window.FilePond = FilePond;
window.Plyr = Plyr;

import '/vendor/wire-elements/modal/resources/js/modal.js';

import './tiptap';
import './content-editor/index.js';
import './tooltip'

Alpine.plugin(Mousetrap)
Alpine.plugin(Focus);
Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(Intersect);
Alpine.plugin(mask);

Livewire.start()

import './unocss.js';