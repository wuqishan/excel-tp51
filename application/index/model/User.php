<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    protected $pk = 'id';

    protected $table = 'user';

    protected function initialize()
    {
        parent::initialize();
        //TODO:自定义的初始化
    }
}







