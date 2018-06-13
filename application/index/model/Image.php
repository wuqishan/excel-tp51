<?php
namespace app\index\model;

use think\Model;

class Image extends Model
{
    protected $pk = 'id';

    protected $table = 'image';

    protected function initialize()
    {
        parent::initialize();
        //TODO:自定义的初始化
    }
}







