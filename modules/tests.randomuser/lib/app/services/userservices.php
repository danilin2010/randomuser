<?php

namespace Tests\Randomuser\App\Services;

use Tests\Randomuser\Domain\Repository\UserRepository;
use Tests\Randomuser\Domain\Helpers\ApiUser;
use Tests\Randomuser\Domain\Entity\User;
use Bitrix\Main\UI\PageNavigation;

/**
 * Class Users
 * @package Tests\Randomuser\App\Services
 */
class UserServices
{

    /**
     * @var UserRepository $users
     */
    protected $users;

    /**
     * UserServices constructor.
     */
    public function __construct()
    {
        $this->users = new UserRepository();
    }

    private function ChekCount()
    {
        $count=$this->users->getCount();
        if($count<=0)
        {
            $res = ApiUser::get();
            foreach ($res as $r)
                $this->users->create($r);
        }
    }

    public function getCount()
    {
        return $this->users->getCount();
    }

    public function getNat()
    {
        return $this->users->getNat();
    }

    public function setNat($id,$nat)
    {
        $User=new User();
        $User->setNat($nat);
        $this->users->update($id,$User);
    }

    /**
     * @param array $records
     * @return User[]
     */
    public function getList(PageNavigation $nav,$sort)
    {
        $res=[];
        $this->ChekCount();
        $res=$this->users->getList($nav,$sort);
        return $res;
    }

}