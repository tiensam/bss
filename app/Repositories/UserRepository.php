<?php

namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param User $user
     * @param array $inputs
     */

    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->numero = $inputs['numero'];
        /*if (isset($inputs['droits']))
        {
            $user->droits = $inputs['droits'];
        }*/

        $user->save();
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(Array $inputs)
    {
        $user = new $this->model;
        $user->password = bcrypt($inputs['password']);
        $this->save($user, $inputs);

        return $user;
    }

    /**
     * @param $id
     * @param array $inputs
     */
    public function update($id, Array $inputs)
    {
        $this->save($this->getById($id), $inputs);
    }

   /* public function getAdmin()
    {
        return $this->where('droits','>', 3)
            ->pluck('name', 'id');
    }*/
}