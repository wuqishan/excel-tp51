/*************************************************************/
/*************************    渲染    ************************/
/*************************************************************/

/**
 * 上
 */
function up_press()
{
    var length = $('.item_sel:eq(' + window.showIndex + ') input').length;
    if (length > 1 && window.inputIndex > 0) {
        window.inputIndex--;
        set_focus_on('');
    }
}

/**
 * 下
 */
function down_press()
{
    var length = $('.item_sel:eq(' + window.showIndex + ') input').length;
    if (length > 1 && window.inputIndex < length - 1) {
        window.inputIndex++;
        set_focus_on('');
    }
}

/**
 * 左
 */
function left_press()
{
    window.inputIndex = 0;
    if (parseInt(window.showIndex) > 0) {
        --window.showIndex;
    }
    set_focus_on('-');     // 获取焦点
    show_animate('-');     // 滚动
    show_opacity();     // 透明
    show_font_style();  // 字体样式
    show_readonly();    // readonly
}

/**
 * 右
 */
function right_press()
{
    window.inputIndex = 0;
    if (parseInt(window.showIndex) < $('.item_sel').length - 1) {
        ++window.showIndex;
    }
    set_focus_on('+');     // 获取焦点
    show_animate('+');     // 滚动
    show_opacity();     // 透明
    show_font_style();  // 字体样式
    show_readonly();    // readonly
}

/**
 * 初始化
 */
function init()
{
    // 初始化到表单开始
    window.showIndex = 0;

    // 表单初始化值为空
    $('.item_sel').each(function (i) {
        if ($(this).find('input:eq(0)').attr('type') === 'checkbox') {
            $('.item_sel:eq(' + i + ') input').each(function(){
                $(this).prop({'checked': false});
            });
        } else {
            $(this).find('input:eq(0)').val('');
        }
    });

    show_animate('');                   // 返回表单第一项
    show_opacity();                     // 透明
    show_font_style();                  // 字体样式
    show_readonly();                    // readonly
    set_focus_on('');                     // 聚焦第一项的第一个input
    set_single_option_at_checkbox();    // 设置所有的checkbox都为单选
}

/**
 * 图片移动
 *
 * @param type 1: 向上，2: 向下
 */
function move_image(type)
{
    var imgTop = parseInt($(".left img").css('top'));
    var imgHeight = $(".left img").height();
    if (type === 1) {
        if (Math.abs(imgTop) < imgHeight) {
            $(".left img").css({'top': (imgTop - 20) + 'px'});
        }
    } else {
        if (imgTop <= 0) {
            $(".left img").css({'top': (imgTop + 20) + 'px'});
        }
    }
}

/**
 * 旋转图片
 *
 * @param deg
 */
function rotate_image(deg)
{
    var olddeg=eval('get_'+$('.left img').css('transform'));
    $('.left img').css({'transform':'rotate(' + (olddeg + deg) % 360 + 'deg)'});
}



