<?php

namespace app\index\repositories;

use app\index\model\User;

class UserRepository extends Repository
{
    public function getUserByName($username, $password)
    {
        $user = User::where('username', $username)
            ->where('password', $password)
            ->find()
            ->toArray();

        return $user;
    }


}
