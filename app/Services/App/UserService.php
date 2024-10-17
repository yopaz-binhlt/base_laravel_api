<?php

namespace App\Services\App;

use App\Repositories\UserRepository;
use App\Services\Service;

class UserService extends Service
{

    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }//end __construct()


    public function getList()
    {
        return $this->userRepository->getAll();

    }//end getList()


    public function create($userDto)
    {
        return $this->userRepository->create($userDto->toArray());

    }//end create()


}//end class
