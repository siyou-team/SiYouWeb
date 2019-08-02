
var upload_opt = {
    runtimes: 'gears,html5,html4,silverlight,flash',
    //url: BASE_URL + "/index.php?ctl=Media&met=uploadImage&typ=json",
    url: SYS.URL.upload,
    flash_swf_url: SYS.CONFIG.static_url  + '/../common/js/plugins/plupload/Moxie.swf',
    silverlight_xap_url: SYS.CONFIG.static_url + '/../common/js/plugins/plupload/Moxie.xap',
    file_data_name: 'upfile',
    filters: {
        max_file_size: '25mb',
        mime_types: [
            {title: "files", extensions: "jpg,png,gif,jpeg"}
        ]
    },
    multi_selection: true
}


function init_upload_event($dom)
{

    $(".picture_upload_add", $dom).each(function ()
    {
        var browse_button_id = $(this).attr('id');
        var browse_button_target_id = $(this).data('target');

        var init_flag =  $(this).data('hasInit');
        if (init_flag)
        {
        }
        else
        {

            var uploader = new plupload.Uploader(
                $.extend(upload_opt, {

                    browse_button: browse_button_id,
                    init: {
                        FilesAdded: function (up, files)
                        {
                            $("#btn_submit").attr("disabled", "disabled").addClass("disabled").val(__('正在上传...'));
                            var item = '';
                            plupload.each(files, function (file)
                            { //遍历文件
                                item += "<span class='item' id='" + file['id'] + "'><span class='progress_bar'><span class='p_bar'></span><span class='percent'>0%</span></span></span>";
                            });
                            $("#photos_area").prepend(item);
                            uploader.start();
                        },
                        UploadProgress: function (up, file)
                        { //上传中，显示进度条
                            var percent = file.percent;
                            $("#" + file.id).find('.p_bar').css({"width": percent + "%"});
                            $("#" + file.id).find(".percent").text(percent + "%");
                        },
                        FileUploaded: function (up, file, info)
                        {
                            var data = eval("(" + info.response + ")");
                            if (data.status != 200)
                            {
                                alert(data.msg);
                            }
                            else
                            {

                            }

                            $("#" + file.id).html("<a class='picture_delete'>×</a><input type=hidden name='pics[]' value='" + data.data.url + "'><img src='" + data.data.url + "' alt='" + data.data.title + "'>")

                            $("#btn_submit").removeAttr("disabled").removeClass("disabled").val(__('提 交'));

                        },
                        Error: function (up, err)
                        {
                            if (err.code == -601)
                            {
                                alert("请上传jpg,png,gif,jpeg,zip或rar！");
                                $("#btn_submit").removeAttr("disabled").removeClass("disabled").val(__('提 交'));
                            }
                        }
                    }
                }));

            uploader.init();

            $(this).data('hasInit', true);
        }
    });


    $(".picture_upload_replace", $dom).each(function ()
    {
        var that = $(this);
        var browse_button_id = $(this).attr('id');
        var browse_button_target_id = $(this).data('target');


        var init_flag =  $(this).data('hasInit');
        if (init_flag)
        {
        }
        else
        {


            //修正位置

            $(this).prepend($('<em class="pur-edit"></em>'));

            if ($(this).find('.pur-edit').length > 0)
            {
                $(this).find('.pur-edit').css({"top": ($(this).find('img').actual('height') - 30)/2 + "px", left:($(this).find('img').actual('width') - 43)/2 + "px"});

            }


            var uploader = new plupload.Uploader(        $.extend(upload_opt, {

                browse_button: browse_button_id,
                init: {
                    FilesAdded: function (up, files)
                    {
                        /*
                         $("#btn_submit").attr("disabled", "disabled").addClass("disabled").val("正在上传...");
                         var item = '';
                         plupload.each(files, function (file)
                         { //遍历文件
                         item += "<span class='item' id='" + file['id'] + "'><span class='progress_bar'><span class='p_bar'></span><span class='percent'>0%</span></span></span>";
                         });
                         $("#photos_area").prepend(item);
                         */
                        uploader.start();
                    },
                    UploadProgress: function (up, file)
                    {
                        //上传中，显示进度条
                        var percent = file.percent;
                        $("#" + file.id).find('.p_bar').css({"width": percent + "%"});
                        $("#" + file.id).find(".percent").text(percent + "%");
                    },
                    FileUploaded: function (up, file, info)
                    {
                        var data = eval("(" + info.response + ")");
                        if (data.status != 200)
                        {
                            alert(data.msg);
                        }
                        else
                        {

                        }

                        that.find('img').prop('src', data.data.url);
                        that.find('input').val(data.data.url);
                        that.find('input').change();
                        that.find('input').click();
                        that.find('input').trigger('input');

                        //$("#" + browse_button_id).html("<input type=hidden id='" + browse_button_target_id + "' name='" + browse_button_target_id + "' value='" + data.data.url + "'><img src='" + data.data.url + "' alt='" + data.data.title + "'  width='" + $("#" + browse_button_id).width() + "'  height='" + $("#" + browse_button_id).height() + "'>")
                        //$("#" + browse_button_id).attr("src", data.data.url)

                        //$("#btn_submit").removeAttr("disabled").removeClass("disabled").val("提 交");

                    },
                    Error: function (up, err)
                    {
                        if (err.code == -601)
                        {
                            alert("请上传jpg,png,gif,jpeg,zip或rar！");
                            $("#btn_submit").removeAttr("disabled").removeClass("disabled").val(__('提 交'));
                        }
                    }
                }
            }));

            //上传用户头像
            if (browse_button_id == 'user_avatar_link')
            {
                var uid, arr,reg=new RegExp("(^| )uid=([^;]*)(;|$)");

                if(arr = document.cookie.match(reg))
                    uid = unescape(arr[2]);


                uploader.bind('BeforeUpload', function(uploader, filters) {
                        uploader.settings.url =  uploader.settings.url + '&user_avatar=1&user_id=' + uid;
                    }
                );

                //新增动态改变url地址end

            }
            else
            {
            }



            uploader.init();

            $(this).data('hasInit', true);
        }
    })


}

var picture_upload_id = '';
var picture_upload_box = null;

//删除图片
$(function ()
{
    $("body").on("click", ".picture_delete", function ()
    {
        var spec_item_id = $(this).parents('#ul_pics').data('id')
        var index = $(this).data('index')

        function removeByValue(arr, val) {
            for(var i=0; i<arr.length; i++) {
                if(arr[i] == val) {
                    arr.splice(i, 1);
                    break;
                }
            }
        }

        removeByValue(product.spec_img[spec_item_id].item_image_other, $(this).data('img'));

        $(this).parent(".item").remove();
    });


    $("body").on("click", ".picture_upload_dialog", function (e)
    {
        $("#modal_upload").modal();

        picture_upload_box = $(this).parents('#ul_pics')
        console.info('picture_upload_box');
        console.info(picture_upload_box);
        picture_upload_id = picture_upload_box.data('group-id')
    });

    init_upload_event($("body"));

})

function upload_complete()
{
    var rand_id = picture_upload_box.data('group-id');
    var spec_item_id = picture_upload_box.data('id');


    var item = "";
    $("#photos_area").find(".item").each(function ()
    {
        var src = $(this).find("img").attr("src");

        item += "<li class='item'><a href='" + src + "' target='_blank' data-fancybox='group-" + rand_id + "' ><img src='" + src + "'/><a class='picture_delete' data-img=" + src + ">×</a></a></li>";

        /*
        if (!product.spec_img[spec_item_id].item_image_default)
        {
            product.spec_img[spec_item_id].item_image_default = src;
        }
        else
        {
            product.spec_img[spec_item_id].item_image_other.push(src);
        }
        */

        product.spec_img[spec_item_id].item_image_other.push(src);
    })

    picture_upload_box.prepend(item);


    //修正数据


    $("#modal_upload").modal('hide');
    $("#photos_area").find(".item").remove();
    $("#pic_url").val('');
}

function getPicUrl()
{
    var pic_url = $('#pic_url').val();
    if (pic_url == '')
    {
        alert(__('请输入图片地址'));
        return false;
    }
    if (!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(pic_url))
    {
        alert(__('图片类型必须是.gif,jpeg,jpg,png中的一种'))
        return false;
    }
    $.post(/*BASE_URL + "/index.php?ctl=Media&met=catchImage&typ=json"*/ "https://dev.43390.com/index.php?ctl=Media&met=catchImage&typ=json", {pic_url: pic_url}, function (data)
    {
        if (data.status == 200)
        {
            var src = data.data.url;
            var item = "<li class='item'><a href='" + src + "' target='_blank'><img src='" + src + "'/><a class='picture_delete'>×</a></a></li>";
            $("#ul_pics").prepend(item);
            $("#modal_upload").modal('hide');
            $("#photos_area").find(".item").remove();
            $("#pic_url").val('');
        }
        else
        {
            alert(data.msg);
        }
    }, "json")
}

function getPicsUrl()
{
    var item = "";
    if ($("#ul_pics").children(".item").length > 1)
    {
        $("#ul_pics").children(".item").each(function ()
        {
            var src = $(this).find("img").attr("src");
            if (src != undefined)
            {
                item += src;
            }

        })
    }

    alert(item);
}
