/* 
 * created by kitz
 * kitz.kitzerland@gmail.com
 * date : 20-04-2016
 * allowed  : $.notify(), $.notify.default(), $.notify.success(), $.notify.error().
 * parameters : all of the above allowed take two parameters :- message to be displayed, and the duration
 * usage      : $.notify("hello");
 *              $.notify("world",2000);
 *              $.notify.success("hello success");
 */
$(function ($) {
    $.notify = function (message, duration) {
        duration = duration || 1000;
        message = message || 'Notify Default Message';

        var domHtml = '<div class="notify-message-dom" style="z-index:999; left: 100%; opacity:0.9; padding:5px 10px 10px 5px; margin-bottom:10px; color: #FFF; background-color: #1F1F1F; position:fixed; min-width:300px; height:80px;">' + message + '</div>';
        $('body').append(domHtml);
        var dom = $('.notify-message-dom');
        animateNotification(duration);
    };
    $.notify.default = function (message, duration) {
        duration = duration || 1000;
        message = message || 'Notify Default Message';

        var domHtml = '<div class="notify-message-dom" style="z-index:999; left: 100%; opacity:0.9; padding:5px 10px 10px 5px; margin-bottom:10px; color: #FFF; background-color: #1F1F1F; position:fixed; min-width:300px; height:80px;">' + message + '</div>';
        $('body').append(domHtml);
        var dom = $('.notify-message-dom');
        animateNotification(duration);
    };
    $.notify.success = function (message, duration) {
        duration = duration || 1000;
        message = message || 'Notify Success Message';

        var domHtml = '<div class="notify-message-dom" style="z-index:999; left: 100%; opacity:0.9; padding:5px 10px 10px 5px; margin-bottom:10px; color: #FFF; background-color: #5CB811; position:fixed; min-width:300px; height:80px;">' + message + '</div>';
        $('body').append(domHtml);
        var dom = $('.notify-message-dom');
        animateNotification(duration);
    };
    $.notify.error = function (message, duration) {
        duration = duration || 1000;
        message = message || 'Notify Error Message';

        var domHtml = '<div class="notify-message-dom" style="z-index:999; left: 100%; opacity:0.9; padding:5px 10px 10px 5px; margin-bottom:10px; color: #FFF; background-color: #FE1A00; position:fixed; min-width:300px; height:80px;">' + message + '</div>';
        $('body').append(domHtml);
        var dom = $('.notify-message-dom');
        animateNotification(duration);
    };


    function animateNotification(duration) {
        $('.notify-message-dom').each(function (i) {
            $(this).css({top: $(window).height() - (($(this).outerHeight() * (i + 1)) + (i + 1) * 10)});
            $(this).animate({
                left: $(window).width() - ($(this).outerWidth() + 60)
            }, 250).animate({
                left: $(window).width() - ($(this).outerWidth() + 20)
            }, 100).delay(duration).animate({
                left: $(window).width() - ($(this).outerWidth() + 60)
            }, 100).animate({
                left: $(window).width()
            }, 250, function () {
                $(this).remove();
            });
        });
    }
}(jQuery));

