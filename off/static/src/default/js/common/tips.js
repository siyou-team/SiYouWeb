(function ($) {

    window.Layer = function () {
        var html = '<div id="[Id]" class="modal fade" role="dialog" aria-labelledby="modalLabel" style="z-index:10001;">' +
                              '<div class="modal-dialog modal-md">' +
                                  '<div class="modal-content">' +
                                      '<div class="modal-header">' +
                                          '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
                                          '<h4 class="modal-title" id="modalLabel">[Title]</h4>' +
                                      '</div>' +
                                      '<div class="modal-body" style="overflow:hidden;">' +
                                      '<div class="text-center font14 m-t-40" id="delTitle">[Message]</div>' +
                                      '<div class="clearfix m-t-40"></div>' +
                                      '</div>' +
                                       '<div class="modal-footer">' +
        '<button type="button" class="btn btn-warning ok m-r-10" data-dismiss="modal">[BtnOk]</button>' +
         '<button type="button" class="btn btn-default cancel" data-dismiss="modal">[BtnCancel]</button>' +
    '</div>' +
                                  '</div>' +
                              '</div>' +
                          '</div>';


        var dialogdHtml = '<div id="[Id]" class="modal fade" role="dialog" aria-labelledby="modalLabel">' +
                              '<div class="modal-dialog">' +
                                  '<div class="modal-content">' +
                                      '<div class="modal-header">' +
                                          '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
                                          '<h4 class="modal-title" id="modalLabel">[Title]</h4>' +
                                      '</div>' +
                                      '<div class="modal-body">' +
                                      '</div>' +
                                  '</div>' +
                              '</div>' +
                          '</div>';

        var successHtml = '<div class="mask-layer"></div>' +
            '<div class="layer-success" id="[Id]"><p><span>√</span>[Message](<i class="count-down"></i>'+__('秒')+')</p></div>';

        var errorHtml = '<div class="mask-layer"></div>' +
    '<div class="layer-error" id="[Id]"><p><span>×</span>[Message](<i class="count-down"></i>'+__('秒')+')</p></div>';

        var reg = new RegExp("\\[([^\\[\\]]*?)\\]", 'igm');
        var generateId = function () {
            var date = new Date();
            return 'mdl' + date.valueOf();
        }
        var after = function (i) {
            $(".count-down").empty().append(i);
            i = i - 1;
            if (i > 0) {
                setTimeout(function () {
                    after(i);
                }, 1000);
            }
        }
        var init = function (options) {
            options = $.extend({}, {
                title: __("信息"),
                message: __("提示内容"),
                btnok: __("确定"),
                btncl: __("取消"),
                width: 200,
                type:1,
                auto: false
            }, options || {});
            var modalId = generateId();
            var content = html.replace(reg, function (node, key) {
                return {
                    Id: modalId,
                    Title: options.title,
                    Message: options.message,
                    BtnOk: options.btnok,
                    BtnCancel: options.btncl
                }[key];
            });
            $('body').append(content);
            $('#' + modalId).modal({
                width: options.width,
                backdrop: 'static'
            });
            if (options.type == 2) {
                $('#' + modalId).next().css('z-index', 10000);
            }
            $('#' + modalId).on('hide.bs.modal', function (e) {
                $('body').find('#' + modalId).remove();
                $('body').removeClass("modal-open");
            });
            return modalId;
        }
        return {
            alert: function (options) {
                if (typeof options == 'string') {
                    options = {
                        message: options
                    };
                }
                var id = init(options);
                var modal = $('#' + id);
                modal.find('.ok').removeClass('btn-success').addClass('btn-primary');
                modal.find('.cancel').hide();

                return {
                    id: id,
                    on: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.find('.ok').click(function () { callback(true); });
                        }
                    },
                    hide: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.on('hide.bs.modal', function (e) {
                                callback(e);
                            });
                        }
                    }
                };
            },
            success: function (options) {
                options = $.extend({}, {
                    message: __("提示内容"),
                    time: 3,
                    width: 200,
                    auto: false
                }, options || {});
                var modalId = generateId();
                var content = successHtml.replace(reg, function (node, key) {
                    return {
                        Id: modalId,
                        Message: options.message,
                    }[key];
                });
                $('body').append(content);
                $('.mask-layer').css({
                    "height": function () { return $(document).height(); },
                    "width": function () { return $(document).width(); },
                    "opacity": '0.3'
                });
                $('.mask-layer').show();
                $('#' + modalId).show(200);
                setTimeout(function () {
                    $('#' + modalId).hide(200);
                    $('.mask-layer').remove();
                }, options.time * 1000);//3秒后销消失
                after(options.time);
            },
            error: function (options) {
                options = $.extend({}, {
                    message: __("提示内容"),
                    time: 3,
                    width: 200,
                    auto: false
                }, options || {});
                var modalId = generateId();
                var content = errorHtml.replace(reg, function (node, key) {
                    return {
                        Id: modalId,
                        Message: options.message,
                    }[key];
                });
                $('body').append(content);
                $('.mask-layer').css({
                    "height": function () { return $(document).height(); },
                    "width": function () { return $(document).width(); },
                    "opacity": '0.3'
                });
                $('.mask-layer').show();
                $('#' + modalId).show(200);
                setTimeout(function () {
                    $('#' + modalId).hide(200);
                    $('.mask-layer').remove();
                }, options.time * 1000);//3秒后销消失
                after(options.time);
            },
            confirm: function (options) {
                var id = init(options);
                var modal = $('#' + id);
                //modal.find('.ok').removeClass('btn-primary').addClass('btn-success');
                modal.find('.cancel').show();
                return {
                    id: id,
                    on: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.find('.ok').click(function () {
                                callback(true);
                            });
                            modal.find('.cancel').click(function () { callback(false); });
                        }
                    },
                    hide: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.on('hide.bs.modal', function (e) {
                                callback(e);
                            });
                        }
                    }
                };
            },
            warning: function (options) {
                var id = init(options);
                var modal = $('#' + id);
                modal.find('.cancel').hide();
                modal.find('.close').hide();
                return {
                    id: id,
                    on: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.find('.ok').click(function () { callback(true); });
                        }
                    },
                    hide: function (callback) {
                        if (callback && callback instanceof Function) {
                            modal.on('hide.bs.modal', function (e) {
                                callback(e);
                            });
                        }
                    }
                };
            },
            dialog: function (options) {
                options = $.extend({}, {
                    title: 'title',
                    url: '',
                    width: 800,
                    height: 550,
                    onReady: function () { },
                    onShown: function (e) { }
                }, options || {});
                var modalId = generateId();

                var content = dialogdHtml.replace(reg, function (node, key) {
                    return {
                        Id: modalId,
                        Title: options.title
                    }[key];
                });
                $('body').append(content);
                var target = $('#' + modalId);
                target.find('.modal-body').load(options.url);
                if (options.onReady())
                    options.onReady.call(target);
                target.modal();
                target.on('shown.bs.modal', function (e) {
                    if (options.onReady(e))
                        options.onReady.call(target, e);
                });
                target.on('hide.bs.modal', function (e) {
                    $('body').find(target).remove();
                });
            }
        }
    }();
})(jQuery);