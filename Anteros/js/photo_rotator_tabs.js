jQuery(document).ready(function ($) {
    "use strict";
    $("#photo-rotator").tabs({
        fx: {
            opacity: "toggle"
        }
    }).tabs("rotate", 4000);
});