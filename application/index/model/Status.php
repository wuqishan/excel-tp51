<?php
namespace app\index\model;

use think\Model;

class Status extends Model
{
    protected $pk = 'id';

    protected $table = 'status';

    protected function initialize()
    {
        parent::initialize();
        //TODO:自定义的初始化
    }
}







