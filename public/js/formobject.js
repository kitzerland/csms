/* 
 * created by kitz
 * kitz.kitzerland@gmail.com
 * date : 16-04-2016
 */
$(function ($) {
    $.fn.formobject = function (options) {
        var dataObject = {};
        var settings = $.extend({}, options);
        $(this).each(function () {
            var _this = $(this);
            $('.form-data', _this).each(function (i) {
                var nodeName = $(this).prop('nodeName').toLowerCase();
                var name = $(this).attr('name');

                switch (nodeName) {
                    case 'select' :
                        dataObject[name] = $(this).val();
                        break;
                    case 'input' :
                        var inputType = $(this).attr('type');
                        switch (inputType) {
                            case 'text' :
                                dataObject[name] = $(this).val();
                                break;
                            case 'radio' :
                                if ($(this).is(':checked')) {
                                    dataObject[name] = $(this).val();
                                }
                                break;
                            case 'checkbox' :
                                if ($(this).is(':checked')) {
                                    dataObject[name] = $(this).val();
                                }
                                break;
                        }
                        break;
                    case 'textarea' :
                        dataObject[name] = $(this).val();
                        break;
                }
            });
        });
        return dataObject;
    };


    $.fn.formobject.fillForm = function (dataObject) {
        $(this).each(function () {
            var _this = $(this);
            $('.form-data', _this).each(function (i) {
                var nodeName = $(this).prop('nodeName').toLowerCase();
                var name = $(this).attr('name');

                switch (nodeName) {
                    case 'select' :
                        $('select[name="' + name + '"]').removeAttr('selected');
                        $('select[name="' + name + '"] option[value="' + dataObject[name] + '"]').prop('selected', 'selected');
                        break;
                    case 'input' :
                        var inputType = $(this).attr('type');
                        switch (inputType) {
                            case 'text' :
                                $(this).val(dataObject[name]);
                                break;
                            case 'radio' :
                                $('input[name="' + name + '"]').removeAttr('checked');
                                $('input[name="' + name + '"][value="' + dataObject[name] + '"]').prop('checked', true);
                                break;
                            case 'checkbox' :
                                $('input[name="' + name + '"]').removeAttr('checked');
                                $('input[name="' + name + '"][value="' + dataObject[name] + '"]').prop('checked', true);
                                break;
                        }
                        break;
                    case 'textarea' :
                        $(this).val(dataObject[name]);
                        break;
                }
            });
        });
        $('.chosen-select').trigger("chosen:updated");
    };
}(jQuery));

