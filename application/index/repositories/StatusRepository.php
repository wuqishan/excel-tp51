<?php

namespace app\index\repositories;

use app\index\model\Status;

class StatusRepository extends Repository
{
    public function getStatusByUserId($user_id, $finished = 0)
    {
        $status = Status::where('user_id', $user_id)
            ->where('finished', $finished)
            ->limit(1)
            ->order('row_id', 'desc')
            ->find()
            ->toArray();

        return $status;
    }


}
