import 'bootstrap';
import "./styles/main.scss";

import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'


$(function() {
    $(document).scroll(function() {
        var $nav = $(".site-header");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});
