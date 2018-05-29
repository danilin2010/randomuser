<?php

namespace Tests\Randomuser\App\Services;

use Bitrix\Main\Web\Uri;
use Tests\Randomuser\Domain\Entity\User;
use Tests\Randomuser\Domain\Factory\UserFactory;
use Tests\Randomuser\Domain\Repository\UserRepository;

/**
 * Class Users
 * @package Tests\Randomuser\App\Services
 */
class UserServices
{

    protected $GridID="testsRrandomuserGrid";
    protected $recordCount=10;
    protected $api="https://randomuser.me/api/";

    /**
     * @return User[]
     */
    public function getApiUser()
    {
        $uri = new Uri($this->api);
        $param=[
            "seed"=>$this->GridID,
            "results" => $this->recordCount,
        ];
        $uri->addParams($param);
        $json = file_get_contents($uri->getUri());
        $obj = json_decode($json);
        $list=array();
        foreach ($obj->results as $result){
            $data=[
                "gender"=>$result->gender,
                "name_title"=>$result->name->title,
                "name_first"=>$result->name->first,
                "name_last"=>$result->name->last,
                "location_street"=>$result->location->street,
                "location_city"=>$result->location->city,
                "location_state"=>$result->location->state,
                "location_postcode"=>$result->location->postcode,
                "email"=>$result->email,
                "login_username"=>$result->login->username,
                "login_password"=>$result->login->password,
                "login_salt"=>$result->login->salt,
                "dob"=>$result->dob,
                "registered"=>$result->registered,
                "nat"=>$result->nat,
                "picture_large"=>$result->picture->large,
                "picture_medium"=>$result->picture->medium,
                "picture_thumbnail"=>$result->picture->thumbnail,
            ];

            $list[]=$data;
        }
        return UserFactory::createFromCollection($list);
    }

    public function getRows()
    {
        $res=$this->getApiUser();
        $users = new UserRepository();
        foreach ($res as $r)
        {
            $users->create($r);
        }
        //print_r($res);
    }

}