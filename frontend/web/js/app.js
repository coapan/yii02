/**
 * Created by admin on 2017/1/30.
 */
jQuery(document).ready(function ($) {
    $('[data-toggle="tooltip"]').tooltip();

    if (window.location.href == "http://www.phpzhi.com") {
        $(".wmhomw").addClass("active");
    }

    /*关注文章*/
    $(".collect").click(function () {
        var press = $(this);
        var id = press.children('i').html();
        $.ajax({
            url: collect_url,// 跳转到 action
            data: {
                id: id
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == 1) {
                    console.log(data);
                    press.children('span').removeClass('glyphicon-heart').addClass('glyphicon-heart-empty').css('color', '#4a4a4a');
                    press.children('em').html("收藏").css('color', '#4a4a4a');
                } else if (data.status == 0) {
                    console.log(data);
                    press.children('span').removeClass('glyphicon-heart-empty').addClass('glyphicon-heart').css('color', 'red');
                    press.children('em').html("已收藏").css('color', 'red');
                } else if (data.status == -1) {
                    $('#myModal').modal('show');
                }
            },
            error: function () {
                console.log("关注异常！");
            }
        });
    });

    /*Ajax 评论*/
    jQuery("#comment-btn").click(function () {

        jQuery.ajax({
            cache: false,
            type: "post",
            url: comment_url,
            //serialize()序列表表格内容为字符串，用于Ajax请求，比如：$("form").serialze().
            data: jQuery('#comment-form').serialize(),// 你的formid
            dataType: 'json',
            async: false,
            //请求成功后返回的数据
                success: function (data) {
                    if (data.status == 1) {
                        //提交完以后进行重新加载
                        document.location.reload();
                    } else if (data.status == -1) {
                        //手动打开一个模态对话框，在modal.php里？
                        $('#anonymous-dialog').modal('show');
                    } else if (data.status == -2) {
                        alert(data.msg);
                    }
            },
            error: function () {
                console.log("comment error！please try again later.");
            }
        });
    });

    /*折叠*/
    $("[class = zhedie]").click(function () {
        var parent = $(this).parent().parent().parent();
        //举报回复的div
        parent.find(".comment-bottom").toggleClass("hide");
        //评论正文
        parent.find(".content").toggleClass("hide");
        //点赞双箭头
        parent.find(".media-left0").toggleClass("hide");

        var child = parent.children(".comment_box");
        if (child) {
            child.toggleClass("hide");
        }
    });

    /*举报评论*/
    $("[id = report-comment]").click(function () {
        //.modal('toggle')手动打开或隐藏一个模态对话框
        $('#reportCommentModal').modal('toggle');
        /*设置隐藏域value*/
        var press = $(this);
        var id = press.children('i').html();
        $(".comment_report_id").val(id);
        /*点击举报按钮时触发*/
        $(".report-btn").click(function () {
            $.ajax({
                url: comment_report_url,
                data: $('#report-comment-form').serialize(),
                type: 'post',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    console.log(data);
                    if (data.status == 1) {
                        //手动隐藏模态对话框
                        $('#reportCommentModal').modal('hide');
                        alert(data.msg);
                    } else if (data.status == 0) {
                        $('#reportCommentModal').modal('hide');
                        alert(data.msg);
                    }
                },
                error: function () {
                    console.log("举报异常！");
                }
            });
        });
    });

    /**
     * 签到的Ajax
     */
    $(".signin").click(function () {
        var press = $(this);
        $.ajax({
            url: signin_url,
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == 1) {
                    //  console.log(data);
                    press.removeClass("btn-info").removeClass("signin").addClass("btn-danger");
                    press.children('span').html("今 日 已 签 到");
                    //document.location.reload(); //刷新一下
                } else if (data.status == -1) {
                    //  console.log(data);
                }
            },
            error: function () {
                console.log("签到异常！");
            }
        });
    });

    /**
     * 回复评论
     */
    function replay() {
        /*回复评论*/
        //这里的id是框起来的，为的就是可以使用定义id属性下面所有定义的属性，比如 data-form
        jQuery("[id = replay-comment]").click(function () {
            var replay = $(this);
            //attr(name)取得第一个匹配元素的属性值。通过这个方法可以方便地从第一个匹配元素获取一个属性的值。如果元素没有相应的属性，返回undefined
            var form_name = replay.attr("data-form");
            //实际是这样的，data-form="form-1,2,3,4，拥有一个特定的属性值
            //.css(name,value)在所有匹配的元素中，设置一个样式属性的值，数字将自动转化为像素值
            jQuery("#" + form_name).css("display", "block");
        });

        /*确定按钮*/
        jQuery("[id = submit-replay]").click(function () {
            var replay = $(this);
            var form_name = replay.attr("data-form");
            var pid = replay.attr("data-pid");
            var post_id = replay.attr("data-post");
            var reply_to = replay.attr("data-reply");
            var content = jQuery("#" + form_name + " textarea").val();
            jQuery.ajax({
                type: "post",
                data: {
                    pid: pid,
                    content: content,
                    post_id: post_id,
                    reply_to: reply_to
                },
                url: replay_url,
                dataType: 'json',
                success: function (data) {
                    if (data.status == 1) {
                        document.location.reload();
                    } else if (data.status == -1) {
                        $('#anonymous-dialog').modal('show');
                    } else if (data.status == -2) {
                        alert(data.msg);
                    }
                },
                error: function () {
                    console.log("replay error！");
                }
            });
        });

        jQuery("[id = cancel-replay]").click(function () {
            var replay = $(this);
            var form_name = replay.attr("data-form");
            jQuery("#" + form_name).css("display", "none")
        });
    }

    replay();
});

/*读消息的ajax*/
jQuery(".mymsg").click(function () {
    var id = $(this).attr('data-id');
    jQuery.ajax({
        type: "post",
        data: {
            id: id,
        },
        url: read_url,
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error:function () {
            console.log("read message error!");
        }
    });
});

jQuery('.dropdown').hover(function () {
    jQuery(this).addClass('open');
}, function () {
    jQuery(this).removeClass('open');
});