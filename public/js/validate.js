/* 
 * Created by kitz
 * kitz.kitzerland@gmail.com
 * date : 19-04-2016
 * conditions : important, name, date, address, alphabatical, double, positive
 * usage : v = {node_name : 'important|alphabatical', another_node_name : 'important'};
 *         $('.form').validate(v);
 */
$(function ($) {
    $.fn.validate = function (options) {
        var settings = $.extend({}, options);
        var results = {errors: 0, errorElements: {}};
        if (options === undefined) {
            return false;
        }
        $(this).each(function () {
            var _this = $(this);
            $.each(options, function (k, v) {
                var element = $('[name="' + k + '"]');
                element.css({'box-shadow': '', 'border-color': ''});
                $(element).unbind('mouseover');
                var nodeName = element.prop('nodeName').toLowerCase();

                switch (nodeName) {
                    case 'select' :
                        if (validator(element.val(), v).errors > 0) {
                            results.errors = 1;
                            results.errorElements[k] = validator(element.val(), v).message;
                        }
                        break;
                    case 'input' :
                        var inputType = $(element).attr('type');
                        switch (inputType) {
                            case 'text' :
                                if (validator(element.val(), v).errors > 0) {
                                    results.errors = 1;
                                    results.errorElements[k] = validator(element.val(), v).message;
                                }
                                break;
                            case 'radio' :
                                if ($(element).is(':checked')) {
                                    if (validator(element.val(), v).errors > 0) {
                                        results.errors = 1;
                                        results.errorElements[k] = validator(element.val(), v).message;
                                    }
                                } else {
                                    if (validator(element.val(), v).errors > 0) {
                                        results.errors = 1;
                                        results.errorElements[k] = validator(element.val(), v).message;
                                    }
                                }
                                break;
                            case 'checkbox' :
                                if ($(element).is(':checked')) {
                                    if (validator(element.val(), v).errors > 0) {
                                        results.errors = 1;
                                        results.errorElements[k] = validator(element.val(), v).message;
                                    }
                                } else {
                                    if (validator(element.val(), v).errors > 0) {
                                        results.errors = 1;
                                        results.errorElements[k] = validator(element.val(), v).message;
                                    }
                                }
                                break;
                        }
                        break;
                    case 'textarea' :
                        if (validator(element.val(), v).errors > 0) {
                            results.errors = 1;
                            results.errorElements[k] = validator(element.val(), v).message;
                        }
                        break;
                }

            });

        });
        function validator(s, c) {
            var cArr = c.split('|');
            var results = {errors: 0, failedCondition: '', message: ''};
            $.each(cArr, function (i, v) {
                var condition = $.trim(v);
                switch ($.trim(v)) {
                    case 'important' :
                        if (s.length > 0) {

                        } else {
                            results.errors = 1;
                            results.failedCondition = 'important';
                            results.message = 'This field is important.';
                            return false;
                        }
                        break;
                    case 'name' :
                        if (s.length > 0) {

                            if (s === stringify(s.match(/[A-Za-z\s\.]{2,}/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'name';
                                results.message = 'Enter valid information.';
                                return false;
                            }
                        }
                        break;
                    case 'date' :
                        if (new RegExp('^0[1-9]|[12][0-9]|3[01][- \/\.]0[1-9]|1[012][- \/\.]19|20\d\d$').test($.trim(s))
                                || new RegExp('^19|20\d\d[- \/\.]0[1-9]|1[012][- \/\.]0[1-9]|[12][0-9]|3[01]$').test(s)
                                || new RegExp('^0[1-9]|1[012][- \/\.]0[1-9]|[12][0-9]|3[01][- \/\.]19|20\d\d$').test(s)) {

                        } else {
                            results.errors = 1;
                            results.failedCondition = 'date';
                            results.message = 'Enter a valid date.';
                            return false;
                        }
                        break;
                    case 'address' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/[0-9A-Za-z\, \.\s]+/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'address';
                                results.message = 'Address seems to be incorrect.';
                                return false;
                            }
                        }
                        break;
                    case 'alphabatical' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/[A-Za-z\s]+/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'alphabatical';
                                results.message = 'Enter valid information.';
                                return false;
                            }
                        }
                        break;
                    case 'double' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/^-{0,1}[0-9]*\.{0,1}[0-9]*$/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'double';
                                results.message = 'This information seems to be incorrect.';
                                return false;
                            }
                        }
                        break;
                    case 'positive' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/^[0-9]*\.{0,1}[0-9]*$/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'positive';
                                results.message = 'This information seems to be incorrect.';
                                return false;
                            }
                        }
                        break;
                    case 'telephone' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/^0[0-9]{9}/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'telephone';
                                results.message = 'Enter a Valid Telephone Number.';
                                return false;
                            }
                        }
                        break;
                    case 'nic' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/^[0-9]{9}[a-zA-Z]{1}$/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'nic';
                                results.message = 'Enter a Valid NIC Number.';
                                return false;
                            }
                        }
                        break;
                    case 'username' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/[0-9a-zA-Z\_]+/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'nic';
                                results.message = 'Only alphabats, numbers, underscores accepted';
                                return false;
                            }
                        }
                        break;
                    case 'email' :
                        if (s.length > 0) {
                            if (s === stringify(s.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/g))) {

                            } else {
                                results.errors = 1;
                                results.failedCondition = 'email';
                                results.message = 'Email address seems to be invalid';
                                return false;
                            }
                        }
                        break;
                }
            });
            return results;
        }

        function stringify(array) {
            var s = '';
            if (array !== null) {
                $.each(array, function (i, v) {
                    s += v;
                });
            }
            return s;
        }
        if (results.errors > 0) {
            highlight(results);
            return false;
        } else {
            return true;
        }
        function highlight(results) {
            var trackedElements = '';
            $.each(results.errorElements, function (e, c) {
                var element = $('[name="' + e + '"]');
                element.css({'box-shadow': 'inset 0px 0px 3px #ff6400', 'border-color': '#ff8a3f'});
                if (e === Object.keys(results.errorElements)[Object.keys(results.errorElements).length - 1]) {
                    trackedElements += '[name="' + e + '"]';
                } else {
                    trackedElements += '[name="' + e + '"],';
                }
            });
            $(trackedElements).mouseover(function (e) {
                var elementName = $(this).attr('name');
                var message = '';
                message = results.errorElements[elementName];
                var div = '<div class="custom-validation-message" style="display: none; position:absolute; background-color:#333333; color: #999999; padding: 5px 10px 5px 10px; border-radius : 3px; box-shadow: 1px 1px 1px 1px #333333;">' + message + '</div>';
                $('.custom-validation-message').remove();
                $('body').append(div);



//                var scrollBottom = $(window).scrollTop() + $(window).height();
//                var scb = $(document).height() - $(window).height() - $(window).scrollTop();
//                var gap = Math.abs($(document).scrollTop() - scb);
//                
//                var logic = $(this).offset().top - $('.custom-validation-message').outerHeight() - 3 - $(window).scrollTop();
//                console.log(this.getBoundingClientRect().top, $(window).scrollTop(), $(this).offset().top);
                
                // $('.custom-validation-message').offset({top: $(this).offset().top - $('.custom-validation-message').outerHeight() - 3 - $(window).scrollTop(), left: $(this).offset().left});
                $('.custom-validation-message').offset({top: $(this).offset().top - $('.custom-validation-message').outerHeight() - 3 , left: $(this).offset().left});
                $('.custom-validation-message').fadeIn(300).delay(1000).fadeOut(500);
            });
            $(trackedElements).mouseleave(function (e) {
                $('.custom-validation-message').remove();
            });
        }
    };
}(jQuery));

