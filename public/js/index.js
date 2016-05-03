$(function(){
    $('#dsdasdasdas').css('height','600px').css('top','-297px').css('background-color','#fff');
    $('[data-toggle=tooltip]').tooltip();
    $('[data-toggle="popover"]').popover('show');
    slajdovanje()
})

function slajdovanje(){
    $(".scrol a,.scrol").on('click', function(event) {
        if($(this.hash).offset())
            event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 900, function(){
            window.location.hash = hash;
        });
    });
    $(window).scroll(function() {
        $(".slideanim").each(function(){
            var pos = $(this).offset().top;
            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
}

/*MAPA START::*/
var myCenter = new google.maps.LatLng("44.798831","20.4465872");
function initialize() {
    var mapProp = {
        center:myCenter,
        zoom:11,
        scrollwheel:false,
        draggable:false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker=new google.maps.Marker({position:myCenter,});marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);
/*mapa end::*/

/*SCROL-FUNCTION START::*/
(function() {
    var ie = (function(){
        var undef,rv = -1;
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf('MSIE ');
        var trident = ua.indexOf('Trident/');

        if (msie > 0) {
            rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        } else if (trident > 0) {
            var rvNum = ua.indexOf('rv:');
            rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
        }
        return ((rv > -1) ? rv : undef);
    }());
    // left: 37, up: 38, right: 39, down: 40,
    // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
    var keys = [32, 37, 38, 39, 40], wheelIter = 0;
    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;
    }
    function keydown(e) {
        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                preventDefault(e);
                return;
            }
        }
    }
    function touchmove(e) {
        preventDefault(e);
    }
    function wheel(e) {
        // for IE
        //if( ie ) {
        //preventDefault(e);
        //}
    }
    function disable_scroll() {
        window.onmousewheel = document.onmousewheel = wheel;
        document.onkeydown = keydown;
        document.body.ontouchmove = touchmove;
    }
    function enable_scroll() {
        window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
    }
    var docElem = window.document.documentElement,
        scrollVal,
        isRevealed,
        noscroll,
        isAnimating,
        container = document.getElementById( 'container-scroll' ),
        trigger = container.querySelector( 'button.trigger' );
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    function scrollPage() {
        scrollVal = scrollY();
        if( noscroll && !ie ) {
            if( scrollVal < 0 ) return false;
            window.scrollTo( 0, 0 );
        }
        if( classie.has( container, 'notrans' ) ) {
            classie.remove( container, 'notrans' );
            return false;
        }
        if( isAnimating ) {
            return false;
        }
        if( scrollVal <= 0 && isRevealed ) {
            toggle(0);
        }
        else if( scrollVal > 0 && !isRevealed ){
            toggle(1);
        }
    }
    function toggle( reveal ) {
        isAnimating = true;
        if( reveal ){
            classie.add( container, 'modify' );
            $('#spin-dalje').hide();
            $('.logo').show();
            $('.header').slideDown();
            $('.trigger').fadeOut();
            $('.first-look-hide').slideUp();
            $('#moj-meni ul li:first-child').slideDown();
        }
        else {
            $('.header').slideUp();
            $('#spin-dalje').show();
            $('.logo').hide();
            noscroll = true;
            disable_scroll();
            classie.remove( container, 'modify' );
            $('.trigger').fadeIn();
            $('.first-look-hide').slideDown();
            $('#moj-meni>ul>li:first-child').fadeOut();
        }
        setTimeout( function(){
            isRevealed = !isRevealed;
            isAnimating = false;
            if( reveal ) {
                noscroll = false;
                enable_scroll();
            }
        }, 1000 );
    }
    var pageScroll = scrollY();
    noscroll = pageScroll === 0;
    disable_scroll();
    if( pageScroll ) {
        isRevealed = true;
        classie.add( container, 'notrans' );
        classie.add( container, 'modify' );
        $(trigger).hide();
        /* KONFIGURACIJA */
        $('#spin-dalje').hide();
        $('.logo').show();
        $('.header').slideDown();
        $('.trigger').fadeOut();
        $('.first-look-hide').slideUp();
        $('#moj-meni ul li:first-child').slideDown();
    }
    window.addEventListener('scroll',scrollPage);
    trigger.addEventListener('click', function() { toggle( 'reveal' ); } );
    document.getElementById('spin-dalje').addEventListener('click', function() { toggle( 'reveal' ); } );
})();
/*scrol-function end::*/