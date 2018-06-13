<?php
namespace app\index\controller;

use PHPExcel_Reader_Excel2007;
use PHPExcel_Writer_Excel2007;
use think\Cache;
use think\Request;
use think\Session;

class Excel
{
    public function __construct()
    {
        Session::init();
    }

    /**
     * 向excel中添加一条录入的数据
     *
     * @param Request $request
     * @return array
     */
    public function addRecord(Request $request)
    {
        $result = ['status' => true, 'data' => 0];
        if (Request::instance()->isAjax()) {
            $data = $this->paramsFilter($request->post());
            $this->updateExcel($data);

            // 行数加一
            $current_line = (int) Cache::get(key_c('current_line'));
            Cache::set(key_c('current_line'), ++$current_line);

            $result['data'] = ($current_line + 1) - config('excel_start_line');
        }

        return $result;
    }

    /**
     * 更新excel
     *
     * @param $data
     */
    private function updateExcel($data)
    {
        $filename = Cache::get(key_c('template_excel'));
        $phpReader = new PHPExcel_Reader_Excel2007();
        $phpExcel = $phpReader->load($filename);
        $currentSheet = $phpExcel->getSheet(0);
        $objWriter = new PHPExcel_Writer_Excel2007($phpExcel);

        // 获取缓存
        $current_line = (int) Cache::get(key_c('current_line'));
        foreach ($data as $k => $v) {
            $address = $k . $current_line;
            if (! empty($v)) {;
                $currentSheet->setCellValue($address, $v);
            }
        }
        $objWriter->save($filename);
    }

    /**
     * 解析post过来的参数
     *
     * @param $post
     * @return array
     */
    private function paramsFilter($post)
    {
        $params = [];
        foreach ($post as $k => $v) {
            $v = trim($v);
            if (empty($v)){
                continue;
            } else {
                $params[$k] = $v;
            }
        }

        if (! config('without_b_d_e')) {
            // 获取缓存里面的 编号，医院和医生
            $initBde = Cache::get(key_c('B_D_E'));
            $params = array_merge($params, $initBde);
        }

        return $params;
    }
}
