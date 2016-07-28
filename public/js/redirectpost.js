$(function ($) {
    $.extend({
        redirectpost: function (location, args)
        {
            var form = '';
            $.each(args, function (key, value) {
                value = value.toString().split('"').join('\"');
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });
            $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
        }
    });
}(jQuery));
