<?php

namespace app\index\repositories;

class FormRepository extends Repository
{
    /**
     * 拼接显示表单的字符串
     *
     * @param $data
     * @return mixed
     */
    public function getForm($data)
    {
        foreach ($data as $k => $v) {
            // 初始化值
            $data[$k]['input_str'] = '';

            // 不需要更新
            if (isset($v['update']) && ! $v['update']) {
                continue;
            }

            // 更新的为选择的
            if (isset($v['values']) && is_array($v['values']) && ! empty($v['values'])) {
                $temp = [];
                foreach ($v['values'] as $vv) {
                    $temp[] = '<label><input type="checkbox" name="'.$k.'" value="'.$vv.'">'.$vv.'</label>';
                }
                $data[$k]['input_str'] = '<div class="item_sel"><span>'.$v['title'].':</span><br>'.implode('', $temp).'</div>';
                $class[] = $k;
            }

            // 更新的内容为手写填充
            if (isset($v['values']) && $v['values'] === '') {
                $data[$k]['input_str'] = '<div class="item_sel"><span>'.$v['title'].':</span><br><input type="text" name="'.$k.'" value=""></div>';
                $class[] = $k;
            }
        }

        return $data;
    }


}
