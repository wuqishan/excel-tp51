<?php

namespace app\index\repositories;

use app\index\model\User;

class UserRepository extends Repository
{
    public function getUserByName($username, $password)
    {
        $user = User::where('username', $username)
            ->where('password', $password)
            ->find();

        return ! empty($user) ? $user->toArray() : [];
    }

    public function login($username, $password)
    {
        $results = false;
        $user = $this->getUserByName($username, $password);
        if (! empty($user)) {
            $results = true;
            $this->initLogin($user);
        }

        return $results;
    }

    private function initLogin($user)
    {
        session('user', $user);
    }

}
