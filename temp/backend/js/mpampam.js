

$("#form-crud-generator").submit(function (e) {
    e.preventDefault();
    var me = $(this);
    $("#submit").prop('disabled', true)
        .text('Memproses...');
    $.ajax({
        url: me.attr('action'),
        type: 'post',
        data: new FormData(this),
        contentType: false,
        cache: false,
        dataType: 'JSON',
        processData: false,
        success: function (json) {
            if (json.success == true) {

                var text = "<ul style='padding-left:20px;'>";

                $.each(json.notif, function(key,value){
                  text+="<li>"+value+"</li>";
                });

                text+="</ul>"

                $("#load-field").hide().fadeIn(1000).html(text);
                $('#alert').hide().fadeIn(1000).html(`<div id="alert" class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <i class="fa fa-check"></i> `+ json.alert + `
                                                    <div>`);
                $('.form-group').removeClass('.has-error')
                    .removeClass('.has-success');

                $('.alert-success').delay(9000).show(10, function () {
                    $('.alert-success').fadeOut(1000, function () {
                        $('.alert-success').remove();
                    });
                })
            } else {
                $.each(json.alert, function (key, value) {
                    var element = $('#' + key);
                    $("#submit").prop('disabled', false)
                        .text('Crud Generator');
                    $(element)
                        .closest('.form-group')
                        .find('.text-danger').remove();
                    $(element).after(value);
                });
            }
        }
    });
});





// var a = ['each', 'Crud\x20Generator', 'closest', 'find', '.text-danger', 'after', '#form-crud-generator', 'submit', '#submit', 'prop', 'disabled', 'text', 'Memproses...', 'ajax', 'attr', 'action', 'post', 'JSON', 'success', '#load-field', 'fadeIn', '#alert', 'html', '<div\x20id=\x22alert\x22\x20class=\x22alert\x20alert-success\x22>\x0a\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20<button\x20type=\x22button\x22\x20class=\x22close\x22\x20data-dismiss=\x22alert\x22\x20aria-label=\x22Close\x22><span\x20aria-hidden=\x22true\x22>×</span></button>\x0a\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20<i\x20class=\x22fa\x20fa-check\x22></i>\x20', 'alert', '\x0a\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20<div>', '.form-group', 'removeClass', '.has-success', 'delay', 'show', 'fadeOut', '.alert-success', 'remove']; (function (c, d) { var e = function (f) { while (--f) { c['push'](c['shift']()); } }; e(++d); }(a, 0x1e2)); var b = function (c, d) { c = c - 0x0; var e = a[c]; return e; }; $(b('0x0'))[b('0x1')](function (c) { c['preventDefault'](); var d = $(this); $(b('0x2'))[b('0x3')](b('0x4'), !![])[b('0x5')](b('0x6')); $[b('0x7')]({ 'url': d[b('0x8')](b('0x9')), 'type': b('0xa'), 'data': new FormData(this), 'contentType': ![], 'cache': ![], 'dataType': b('0xb'), 'processData': ![], 'success': function (e) { if (e[b('0xc')] == !![]) { $(b('0xd'))['hide']()[b('0xe')](0x3e8)['html']('Berhasil\x20Membuat'); $(b('0xf'))['hide']()[b('0xe')](0x3e8)[b('0x10')](b('0x11') + e[b('0x12')] + b('0x13')); $(b('0x14'))['removeClass']('.has-error')[b('0x15')](b('0x16')); $('.alert-success')[b('0x17')](0x2328)[b('0x18')](0xa, function () { $('.alert-success')[b('0x19')](0x3e8, function () { $(b('0x1a'))[b('0x1b')](); }); }); } else { $[b('0x1c')](e[b('0x12')], function (f, g) { var h = $('#' + f); $('#submit')[b('0x3')]('disabled', ![])[b('0x5')](b('0x1d')); $(h)[b('0x1e')](b('0x14'))[b('0x1f')](b('0x20'))[b('0x1b')](); $(h)[b('0x21')](g); }); } } }); });
