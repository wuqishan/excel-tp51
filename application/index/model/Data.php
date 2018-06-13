<?php
namespace app\index\model;

use think\Model;

class Data extends Model
{
    protected $pk = 'id';

    protected $table = 'data';

    protected function initialize()
    {
        parent::initialize();
        //TODO:自定义的初始化
    }
}







