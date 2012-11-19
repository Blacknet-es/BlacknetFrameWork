$(function () {
    $('.tipcontent').each(function () {
        var distance = 0;
        var time = 200;
        var hideDelay = 50;

        var hideDelayTimer = null;

        var beingShown = false;
        var shown = false;
        var trigger = $('.tipobject', this);
        var info = $('.tippopup', this).css('opacity', 0);


        $([trigger.get(0), info.get(0)]).mouseover(function () {
            if (hideDelayTimer) clearTimeout(hideDelayTimer);
            if (beingShown || shown) {
                // don't trigger the animation again
                
                return;
            } else {
                // reset position of info box
                beingShown = true;
                //Calcular top y left para que no haya overflow
                $ancho = $(window).width();

                $alto = $(window).height();

                //alert($ancho - trigger.offset().left);
                $left = 33;
                if ($ancho - trigger.offset().left < 580){
                    $left = -480;
                }

                $top = 90;
                if ($alto - trigger.offset().top < info.height() + 100){
                    $top = -(info.height());
                }

                info.css({
                    top: $top,
                    left: $left,
                    display: 'block',
                    position: 'absolute',
                    overflow: 'visible'
                }).animate({
                    top: '-=' + distance + 'px',
                    opacity: 1
                }, time, 'swing', function() {
                    beingShown = false;
                    shown = true;
                });
            }

            return false;
        }).mouseout(function () {
            if (hideDelayTimer) clearTimeout(hideDelayTimer);
            hideDelayTimer = setTimeout(function () {
                hideDelayTimer = null;
                
                info.animate({
                    top: '-=' + distance + 'px',
                    opacity: 0
                }, time, 'swing', function () {
                    shown = false;
                    info.css('display', 'none');
                });

            }, hideDelay);

            return false;
        });
    });
});