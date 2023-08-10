import $ from "jquery";
window.$ = window.jQuery = $;
import { Fancybox } from "@fancyapps/ui";

import header from "./components/c-header";
import modal from "./components/c-modal";

/* Fancybox.bind('[data-fancybox="gallery2"]', {
    // Your custom options
}); */
Fancybox.bind('[data-fancybox="gallery1"]', {
    // Your custom options
});
Fancybox.bind('[data-fancybox]', {
    // Your custom options
});

(function($) {
    header();
    modal();

}(jQuery))
