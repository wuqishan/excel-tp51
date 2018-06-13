/************************************************/
/********************   Tool   ******************/
/************************************************/

/**
 * 获取表单数据
 *
 * @returns {{}}
 */
function get_form_data()
{
    var data = {};
    $('.item_sel').each(function (index) {
        var key = $(this).find('input:eq(0)').attr('name');
        if ($(this).find('input:eq(0)').attr('type') === 'checkbox') {
            var temp = [];
            $('.item_sel:eq('+index+') input').each(function(){
                if ($(this).prop('checked')) {
                    data[key] = $(this).val();
                    return true;
                }
            });
        } else {
            data[key] = $(this).find('input:eq(0)').val();
        }
    });

    return data;
}

/**
 * 显示图片
 */
function show_image()
{
    var row = parseInt(window.currentRow);
    var imageStr = '<img style="width: 100%;position: relative;transform:rotate(0deg)" src="' + window.images[row - 1]+'">';

    $('#main > .left').html(imageStr);
}

/**
 * 给当前form选项的当前input获取焦点
 */
function set_focus_on()
{
    $('.item_sel:eq('+window.showIndex+')').find('input:eq('+window.inputIndex+')').focus();
}

/**
 * 所有checkbox都为单选
 */
function set_single_option_at_checkbox()
{
    var multi_selected = [];

    $('.item_sel input[type=checkbox]').change(function(){
        if ($.inArray($(this).attr('name'), multi_selected) < 0) {
            return false;
        }
        var input = $(this).parents('.item_sel').find('input');
        var value = $(this).val();
        if ($(this).prop('checked')) {
            input.each(function () {
                if ($(this).val() !== value) {
                    $(this).prop({'checked': false});
                }
            });
        }
    });
}

/**
 * 解析matrix矩阵，0°-360°，返回旋转角度
 *
 * @param a
 * @param b
 * @param c
 * @param d
 * @param e
 * @param f
 * @returns {number}
 */
function get_matrix(a, b, c, d, e, f)
{
    var aa=Math.round(180 * Math.asin(a) / Math.PI);
    var bb=Math.round(180 * Math.acos(b) / Math.PI);
    var cc=Math.round(180 * Math.asin(c) / Math.PI);
    var dd=Math.round(180 * Math.acos(d) / Math.PI);
    var deg = 0;
    if(aa === bb || -aa === bb){
        deg = dd;
    }else if(-aa + bb === 180){
        deg = 180 + cc;
    }else if(aa + bb === 180){
        deg = 360 - cc || 360 - dd;
    }

    return deg >= 360 ? 0 : deg;
}

/**
 * loading 显示影藏
 *
 * @param type
 */
function loading(type)
{
    if (type === 1) {
        $('.loading').show();
    } else {
        $('.loading').hide();
    }
}

/**
 * 初始化重置工作区高度
 */
function reset_work_area_size()
{
    var viewHeight = $(window).height();
    $('#main .left, #main .right').css({'height': (viewHeight - 100) + 'px'});
    $('.question').css({'height': (viewHeight - 250) + 'px'});
}

/**
 * resize 初始化工作区高度
 */
function resize_reset_work_area_size ()
{
    $(window).resize (function() {
        reset_work_area_size();
    });
}

/**
 * 计算滚动的距离
 *
 * @returns {string}
 */
function calc_margin_top()
{
    return -(window.perSelHeight * window.showIndex) + 'px';
}

/**
 * 透明
 */
function show_opacity()
{
    $('.item_sel').css({'opacity': 0.3});
    $('.item_sel:eq(' + window.showIndex + ')').css({'opacity': 1});
}

/**
 * 字体样式
 */
function show_font_style()
{
    $('.item_sel span').css({'fontSize': '14px', 'fontWeight': 'normal'});  // 字体设置
    $('.item_sel:eq(' + window.showIndex + ') span').css({'fontSize': '16px', 'fontWeight': 'bold'});
}

/**
 * 仅读
 */
function show_readonly()
{
    $('.item_sel input').attr({'readonly': true});
    $('.item_sel:eq(' + window.showIndex + ') input').removeAttr('readonly');
}

/**
 * 滚动
 */
function show_animate()
{
    $(".item_sel:eq(0)").animate({'marginTop':calc_margin_top()}, 50);
}