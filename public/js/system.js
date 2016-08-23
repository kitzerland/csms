$.fn.loadyear = function (from, to) {
    from = from || 2010;
    to = to || 2050;
    $(this).each(function () {
        for (var i = from; i <= to; i++) {
            if (i === new Date().getFullYear()) {
                $(this).append($("<option></option>")
                        .attr("value", i)
                        .attr("selected", true)
                        .text(i));
            } else {
                $(this).append($("<option></option>")
                        .attr("value", i)
                        .text(i));
            }

        }
        $(this).trigger("chosen:updated");
    });
};

function stringify(array) {
    var s = '';
    if (array !== null) {
        $.each(array, function (i, v) {
            s += v;
        });
    }
    return s;
}

$.fn.keyupvalidate = function (regex, onAccept, onReject) {
    regex = regex || /^.*$/g;
    $(this).each(function () {
        $(this).keyup(function () {
            var $this = $(this);
            var s = $this.val();
            if (s === "") {
                $this.css({'box-shadow': 'none', 'border-color': ''});
            } else {
                if (s === stringify(s.match(regex))) {
                    $this.css({'box-shadow': 'inset 0px 0px 3px #5CB811', 'border-color': '#5CB811'});
                    if (onAccept !== undefined && typeof (onAccept) === 'function') {
                        onAccept();
                    }
                } else {
                    $this.css({'box-shadow': 'inset 0px 0px 3px #ff6400', 'border-color': '#ff8a3f'});
                    if (onReject !== undefined && typeof (onReject) === 'function') {
                        onReject();
                    }
                }
            }
        });
    });
};

function typeahead($this, text, key, callbackOnExit) {

    var x = $this.offset().top + $this.outerHeight() + 1;
    var y = $this.offset().left;
    var width = $this.outerWidth();

    //typeahead dom start
    var dom = '';
    dom += '<div class="typeahead" style="position:absolute; top:' + x + 'px; left:' + y + 'px; min-width: ' + width + 'px; height:300px;">';
    dom += '<table class="table table-bordered table-responsive table-condensed typeaheadResults">';
    dom += '<thead>';
    dom += '<tr>';
    dom += '<th colspan="4"><span></span><button class="btn btn-xs btn-primary pull-right selectResult"><i class="fa fa-check"></i></button></th>';
    dom += '</tr>';
    dom += '<tr>';
    dom += '<th style="width:35px;"><i class="fa fa-circle"></i></th>';
    dom += '<th style="width:80px;">ID</th>';
    dom += '<th style="width:80px;">Index</th>';
    dom += '<th>Name</th>';
    dom += '</tr>';
    dom += '</thead>';
    dom += '<tbody>';
    dom += '</tbody>';
    dom += '</table>';
    dom += '</div>';//typeahead dom end

    $('.typeahead').remove();
    $('body').append(dom);
    var $table = '.typeaheadResults';

    $('.typeahead').css({
        'z-index': '999',
        padding: '1px 1px 1px 1px',
        backgroundColor: 'white',
        border: '1px solid grey',
        'box-shadow': '0px 0px 2px 2px grey'
    });

    if ($this.val() === "" || key.keyCode === 27) {
        key.preventDefault();
        $('.typeahead').remove();
        $this.css({'box-shadow': 'none', 'border-color': ''});
        $('.search').val('');
    }



    //end of typeahead core

    if (text === "") {
        $this.css({'box-shadow': 'none', 'border-color': ''});
    } else {
        var searchMethod = '';
        if (text === stringify(text.match(/^[1-9]+[0-9]*$/g))) {
            $this.css({'box-shadow': 'inset 0px 0px 3px #5CB811', 'border-color': '#5CB811'});
            //searching for id
            searchMethod = 'id';
        } else if (text === stringify(text.match(/^[a-zA-Z \.]+[a-zA-Z]*$/g))) {
            $this.css({'box-shadow': 'inset 0px 0px 3px #5CB811', 'border-color': '#5CB811'});
            //searching for name
            searchMethod = 'name';
        } else if (text === stringify(text.match(/^[a-zA-Z0-9]*$/g))) {
            //searching for index
            searchMethod = 'index';
        } else {
            $this.css({'box-shadow': 'inset 0px 0px 3px #ff6400', 'border-color': '#ff8a3f'});
            searchMethod = '';
        }

        if (searchMethod.length > 0) {
            $.post('/student/search', {method: searchMethod, text: text}, function (e) {
                var tbody = '';
                if (Object.keys(e).length > 0) {
                    $.each(e, function (k, v) {
                        tbody += '<tr>';
                        if (k === 0) {
                            tbody += '<td><input class="checkradio" value="' + v.ID + '" name="typeaheadR" type="radio" checked="checked"></td>';
                        } else {
                            tbody += '<td><input class="checkradio" value="' + v.ID + '" name="typeaheadR" type="radio"></td>';
                        }
                        tbody += '<td>' + v.ID + '</td>';
                        tbody += '<td>' + v.Index + '</td>';
                        tbody += '<td>' + v.FirstName + ' ' + v.LastName + '</td>';
                        tbody += '</tr>';
                    });
                }
                $('tbody', $table).html(tbody);
                $($table).scrollTableBody({height: '213px'});

                $(document).mouseup(function (e) {
                    var container = $('.typeahead, .search');
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        $('.search').val('');
                        $this.css({'box-shadow': 'none', 'border-color': ''});
                        $('.typeahead').remove();
                    }
                });

                if (key.keyCode === 13) {
                    key.preventDefault();
                    $('.search').val('');
                    $this.css({'box-shadow': 'none', 'border-color': ''});
                    $('.selectedID').val($('input[name=typeaheadR]:checked', '.typeaheadResults tbody').val());
                    $('.typeahead').remove();
                    if (callbackOnExit !== undefined && typeof (callbackOnExit) === 'function') {
                        if ($('.selectedID').val() !== "") {
                            callbackOnExit();
                        }
                    }
                }

                $('.typeaheadResults thead .selectResult').click(function () {
                    $('.search').val('');
                    $this.css({'box-shadow': 'none', 'border-color': ''});
                    $('.selectedID').val($('input[name=typeaheadR]:checked', '.typeaheadResults tbody').val());
                    $('.typeahead').remove();
                    if (callbackOnExit !== undefined && typeof (callbackOnExit) === 'function') {
                        if ($('.selectedID').val() !== "") {
                            callbackOnExit();
                        }
                    }
                });
            }, 'json');
        }
    }
}

var getYearMonth = function (dateObject) {
    if(dateObject === null){
        return '';
    }
    var y = dateObject.getFullYear();
    var m = (dateObject.getMonth() + 1) < 10 ? '0' + (dateObject.getMonth() + 1) : (dateObject.getMonth() + 1);
    return y + '-' + m;
};

Date.isLeapYear = function (year) { 
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)); 
};

Date.getDaysInMonth = function (year, month) {
    return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
};

Date.prototype.isLeapYear = function () { 
    return Date.isLeapYear(this.getFullYear()); 
};

Date.prototype.getDaysInMonth = function () { 
    return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
};

Date.prototype.addMonths = function (value) {
    var n = this.getDate();
    this.setDate(1);
    this.setMonth(this.getMonth() + value);
    this.setDate(Math.min(n, this.getDaysInMonth()));
    return this;
};

