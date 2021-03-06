function selectFileWithCKFinder(elementname) {
    var element = $('[name="' + elementname + '"]');
    var image = $('.image' + elementname);
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                element.val(file.getUrl());
                image.html('<img src="' + file.getUrl() + '" alt="Avatar" style="width:100px;" />');
            });

            finder.on('file:choose:resizedImage', function (evt) {
                element.val(evt.data.resizedUrl);
                image.html('<img src="' + evt.data.resizedUrl + '" alt="Avatar" style="width:100px;" />');
            });
        }
    });
}

function AjaxData(url, data, success) {
    $.ajax({
        dataType: "json",
        url: url,
        data: data,
        success: eval(success)
    });
}

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};



Date.prototype.formatDate = function () {
    var n = this,
            day = n.getDay() > 10 ? n.getDay() : '0' + n.getDay(), month = n.getMonth() > 10 ? n.getMonth() : '0' + n.getMonth(), year = n.getFullYear();
    return day + '/' + month + '/' + year;
}



$('#InfoUpdate').show().delay(1000).slideUp(500);
function ResultUpdate(rs) {
    $('#InfoUpdate').html('<div class="row"><div class="alert alert-' + rs.status + '">' + rs.message + '</div></div>');
    $('#InfoUpdate').show().delay(1000).slideUp(500);
}

function togglecheckboxes(pt) {
    var cb = $('.CheckAll');
    for (var i = 0; i < cb.length; i++) {
        cb[i].checked = pt.checked;
    }
}
function XoaCheckAll(url, message) {
    if (confirm(message)) {
        var pt = $('input.CheckAll');
        var check = pt.size(), arr = [], j = 0;
        if (check == 0) {
            return;
        }
        for (var i = 0; i < check; i++) {
            if (pt[i].checked) {
                arr[j] = pt.eq(i).attr('rel');
                j++;
            }
        }
        $.get(url, {deleteAll: arr}, function (o) {
            if (o > 0) {
                location.reload();
            }
        });
    }
}