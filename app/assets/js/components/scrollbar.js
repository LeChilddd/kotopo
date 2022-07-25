const Scrollbar = require("@assets/argon/js/plugins/smooth-scrollbar.min");

$(function() {
    const config = {
        damping: '0.5',
    };

    $('.scrollbar').each(function(index, element) {
        Scrollbar.init(element, config);
    });
});
