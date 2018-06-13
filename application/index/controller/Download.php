<?php
namespace app\index\controller;

use think\Cache;
use think\Session;

class Download
{
    public function __construct()
    {
        Session::init();
    }

    /**
     * 下载excel
     */
    public function down()
    {
        $filePath = Cache::get(key_c('template_excel'));
        $filename = $this->getDownloadName();
        if (file_exists($filePath)) {
            //输入文件标签
            header("Content-type: application/octet-stream");
            header("Accept-Ranges: bytes");
            header("Accept-Length: ".filesize($filePath));
            header("Content-Disposition: attachment; filename=".$filename);
            $handle = fopen($filePath,'r');
            echo fread($handle,filesize($filePath));
            fclose($handle);
        } else {
            exit('没有待下载的附件！');
        }

    }

    private function getDownloadName()
    {
        return 'template.xlsm';
    }
}
