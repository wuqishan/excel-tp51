<?php
namespace app\index\controller;

use think\Cache;
use think\Request;
use think\Session;
use app\index\repositories\FormRepository;
use app\index\repositories\ImageRepository;

class Index
{
    private $template;

    public function __construct()
    {
        $this->template = APP_PATH . '/data/template.xlsm';
    }

    /**
     * 显示操作页面
     *
     * @return \think\response\View
     */
    public function index()
    {
        $excelInput = get_excel_data();
        $input = (new FormRepository())->getForm($excelInput);

        return view('index', ['input' => $input]);
    }


    /**
     * 初始化操作
     *
     * @param Request $request
     * @return array
     */
    public function initInfo(Request $request)
    {

        $result = ['status' => true, 'data' => []];

        // 删除上次图片和加载这次图片
        $this->removePrevImages();
        $data = $this->getImagesZip();
        if ($data['status']) {
            $result['data'] = $data['data'];
        }

        if (! config('without_b_d_e')) {
            // 缓存初始化的数据 B_D_E
            Cache::set(key_c('B_D_E'), $request->post());
        }

        // 缓存当前处理的行数
        Cache::set(key_c('current_line'), config('excel_start_line'));

        // 拷贝一个excel到 /public/data/ 下面
        $filePath = APP_PATH . '../public/data/' . session_id() . '_template.xlsm';
        Cache::set(key_c('template_excel'), $filePath);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if (! copy($this->template, $filePath)) {
            $result['status'] = false;
        } else {
            chmod($filePath, 0777);
        }

        return $result;
    }

    /**
     * 上传附件并转移
     *
     * @return array
     */
    private function getImagesZip()
    {
        $result = ['status' => false, 'data' => []];
        $imgExt = ['bmp', 'jpg', 'jpeg', 'png', 'gif'];

        // 上传图片
        $file = request()->file('images');
        $savePath = APP_PATH . 'data/upload/';
        $info = $file->validate(['ext' => 'zip'])
            ->rule('get_upload_filename')
            ->move($savePath);

        if($info){
            // 成功上传后解压转移数据到 ROOT_PATH . /public/data/
            $filePath = $savePath . $info->getSaveName();
            $unzipPath = ROOT_PATH . 'public/data/' . get_upload_filename() . '/';
            $visitPath = '/data/' . get_upload_filename() . '/';

            // 解压
            $command = sprintf('unzip -jo %s -d %s', $filePath, $unzipPath);
            exec($command);

            // 获取图片列表
            if (file_exists($unzipPath)) {
                $list = scandir($unzipPath);
                foreach ($list as $v) {
                    if ($v !== '.' && $v !== '..' && in_array(get_file_ext($v), $imgExt)) {
                        $result['data'][] = $visitPath . urlencode($v);
                    }
                }
                $result['status'] = true;
            }
        }else{
            // 上传失败获取错误信息
            $result['data'] = $file->getError();
        }

        return $result;
    }

    /**
     * 删除上次遗留的图片
     *
     * @return bool
     */
    private function removePrevImages()
    {
        $oldImagesDir = ROOT_PATH . 'public/data/' . get_upload_filename() . '/';
        $command = sprintf('rm -rf  %s', $oldImagesDir);
        system($command);

        return true;
    }



}
