/**
 * @author jesus
 */

$(document).ready(function(){
    
        $("#destacados li img").css( {
            position: "0 250px"
        } )
        .mouseover(function(){
            $(this).stop().animate(
            {
                
                position:"(0 -=250px)"
            },

            {
                duration:500
            })
        })
        .mouseout(function(){
            $(this).stop().animate(
            {
                position:"(0 +=250px)"
            },

            {
                duration:500
            })
        });
    
    
});