require('@assets/styles/menu.scss')

const $currentAncestor = $('.current_ancestor');
$('.sidemenu-item.active').children('.nav-link').addClass('active');
$currentAncestor.children('.nav-link').attr('aria-expanded', true);
$currentAncestor.children('.sidemenu-submenu').addClass('show');

$(function() {
    $('.sidemenu-item').find('.nav-link').click(function() {
        $('#side-menu').find('.nav-link.active').removeClass('active');
        $(this).addClass('active');
        $('#side-menu').find('.current_ancestor').removeClass('current_ancestor');
        $(this).parent('.sidemenu-item').parent('.sidemenu-submenu').parent().addClass('current_ancestor');
    });
});


