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


