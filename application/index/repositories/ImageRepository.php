<?php

namespace app\index\repositories;

use app\index\model\Image;

class ImageRepository extends Repository
{
    public function getImageByUserId($user_id, $limit = 1, $record = 0)
    {
        $image = Image::where('user_id', $user_id)
            ->where('record', $record)
            ->where('password', $password)
            ->limit($limit)
            ->order('name', 'asc')
            ->select()
            ->toArray();

        return $image;
    }


}
