<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\repositories\UserRepository;
use think\Session;

class File extends Controller
{

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

    private function upload()
    {
        $result = ['status' => false, 'data' => []];
        $imgExt = ['bmp', 'jpg', 'jpeg', 'png', 'gif'];

        // 上传图片
        $file = request()->file('images');
        $savePath = APP_PATH . 'data/upload/';
        $info = $file->validate(['ext' => 'zip'])
            ->rule('get_upload_filename')
            ->move($savePath);

        if($info) {
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
        } else {
            // 上传失败获取错误信息
            $result['data'] = $file->getError();
        }

        return $result;
    }
}
