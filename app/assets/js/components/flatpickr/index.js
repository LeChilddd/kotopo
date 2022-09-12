require("flatpickr/dist/flatpickr.min")
require("@assets/js/components/flatpickr/fr");

$(function() {
    $(".flatpickr").flatpickr({
        locale: "fr",
        dateFormat: "d/m/Y",
        allowInput: true,
    });

    $(".flatpickr_hour").flatpickr({
        locale: "fr",
        dateFormat: "d/m/Y - H:i",
        enableTime: true,
        allowInput: true
    });
});
