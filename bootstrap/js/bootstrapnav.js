/* ===================================================
 * bootstrapwp.demo.js v1.0
 * ===================================================

// NOTICE!! This JS file is included for reference.
// This code is used to power all the JavaScript
// demos and examples for BootstrapWP
// ++++++++++++++++++++++++++++++++++++++++++*/

!function($) {

    $(function(){
        var $window = $(window);

        // Adding the needed html to WordPress navigation menus //
        $("ul.dropdown-menu").parent().addClass("dropdown");
        $("ul.dropdown-menu ul").parent().addClass("dropdown-submenu");
        $("ul.nav li.dropdown a").addClass("dropdown-toggle");
        $("ul.dropdown-menu li a").removeClass("dropdown-toggle");
        $('a.dropdown-toggle').attr('data-toggle', 'dropdown');

        // Adding dropdown caret for dropdown menus, if it does not already exist
        setTimeout(function() {

            $('.dropdown-toggle:not(:has(b.caret))').append('<b class="caret"></b>');

        }, 300); // 1000 = 1 second
        
        // alert('Drop down nav working!');

 });
}(window.jQuery);