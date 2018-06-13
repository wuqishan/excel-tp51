<?php

namespace app\index\repositories;

use app\index\model\Data;

class DataRepository extends Repository
{
    public function getDataByUserId($user_id, $row_id = 0)
    {
        $data = Data::where('user_id', $user_id);
        if (intval($row_id > 0)) {
            $data->where('row_id', $row_id);
        }
        $data = $data->select()->toArray();

        return $data;
    }


}
