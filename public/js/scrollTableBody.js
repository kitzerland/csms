/*plugin created by Kitz : kitz.kitzerland@gmail.com*/
(function ($) {

    $.fn.scrollTableBody = function (options) {
        var settings = $.extend({
            height: '200px'
        }, options);
        $.fn.scrollTableBody.gOptions = settings;
        $(this).each(function () {
            var _this = $(this);
            var theadStyle = {'display': 'block', 'position': 'relative'};
            var tbodyStyle = {'display': 'block', 'overflow-y': 'auto', 'height': settings.height};
            var tfootStyle = {'display': 'block', 'position': 'relative'};

            var tHeadCellWidths = {};
            $('thead tr th', this).each(function (i) {
                tHeadCellWidths[i] = $(this).width();
            });

            var columnWidths = {};
            $('thead tr:last th', this).each(function (i) {
                columnWidths[i] = $(this).width();
            });

            var tFootCellWidths = {};
            $('tfoot tr td', this).each(function (i) {
                tFootCellWidths[i] = $(this).width();
            });

            var columnCount = Object.keys(columnWidths).length;

            $('thead', _this).css(theadStyle);
            $('tbody', _this).css(tbodyStyle);
            $('tfoot', _this).css(tfootStyle);


//            $(this).css(tableStyle);

            $('thead tr th', _this).each(function (i) {
                $(this).width(tHeadCellWidths[i]);
//                $(this).css({width: tHeadCellWidths[i]});
            });
            $('tbody tr td', _this).each(function (i) {
                $(this).width(columnWidths[i % columnCount]);
//                $(this).css({width: columnWidths[i % columnCount]});
            });
            $('tfoot tr td', _this).each(function (i) {
                $(this).width(tFootCellWidths[i]);
//                $(this).css({width: tFootCellWidths[i]});
            });

            if ($(this).find('tbody').get(0).scrollHeight > $(this).find('tbody').get(0).clientHeight) {
                //if tbody have a scroll bar. we need to add padding to thead and tfoot
                $('thead', this).css({'padding-right': '16px'});
                $('tfoot', this).css({'padding-right': '16px'});
            }
        });
    };
}(jQuery));
