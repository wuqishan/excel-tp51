/*******************************************/
/***********       callback      ***********/
/*******************************************/

/**
 * 提交表单后的回调函数
 *
 * @param result
 */
function submit_callback(result)
{
    // 关闭遮罩层
    loading(0);

    if (parseInt(result.data) > 0) {

        // 返回的当前行数大于总行数时表示录入结束
        if ((parseInt(result.data)) > parseInt(window.totalRows)) {

            // 本次所有图片录入结束标志
            window.lasted = '1';

            // 初始化后，初始化的
            $('.init').attr({'disabled': 'disabled'});
            $('.submit').attr({'disabled': 'disabled'});

            alert('已完成全部录入，请务必先下载附，后刷新继续录入！');
        } else {

            // 更新当前更新到的行数
            window.currentRow = result.data;
            $('.current_row').html(result.data);

            // 显示单子的图片
            show_image();
            // 添加成功后再次初始化
            init();
        }
        alert('第 ' + (parseInt(result.data) - 1) + ' 行数据录入完成');
    } else {
        alert('第 '+result.data+' 行数据录入失败，请停止录入，排查错误！');
    }
}

/**
 * 初始化回调函数
 *
 * @param result
 */
function init_callback(result)
{
    // 关闭遮罩层
    loading(0);

    if (result.status === true) {
        // 初始化函数
        init();

        // 初始化已结束
        window.status = "1";

        // 图片数据
        window.images = result.data;

        // 总条数
        window.totalRows = result.data.length;

        // 显示图片，初始化后显示第一张
        show_image();

        // 初始化结束后把默认信息变成不可变
        $('.init_b').attr({'disabled': 'disabled'});
        $('.init_d').attr({'disabled': 'disabled'});
        $('.init_e').attr({'disabled': 'disabled'});
        $('.images').attr({'disabled': 'disabled'});

        // 更新当前行和总行数
        $('.current_row').html(1);
        $('.total_rows').html(window.totalRows);

        alert('初始完成，本次初始化总条数为：' + result.data.length);
    } else {
        alert('初始化失败');
    }
}