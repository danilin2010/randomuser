<?php

namespace Tests\Randomuser\Domain\Factory;

use Tests\Randomuser\Domain\Entity\User;
use Tests\Randomuser\Domain\ValueObject\Email;
use InvalidArgumentException;
use DateTime;

/**
 * Class UserFactory
 * @package Tests\Randomuser\Domain\Factory
 */
class UserFactory
{

    /**
     * @param  $data
     * @return DateTime
     */

    public static function DateRecognition($data)
    {
        if ($data instanceof DateTime) {
            return $data;
        }elseif(is_numeric ($data)){
            $d=new DateTime;
            $d->setTimestamp((int)$data);
            return $d;
        }elseif(strlen($data)>0){
            return new DateTime($data);
        }else{
            return new DateTime;
        }
    }

    /**
     * @param array $params
     * @return User
     * @throws InvalidArgumentException
     */
    public static function createFromArray(array $params)
    {
        $user = new User();
        if((int)$params['id']>0)
            $user->setId((int)$params['id']);
        if(strlen($params['gender'])>0)
            $user->setGender(trim($params['gender']));
        if(strlen($params['name_title'])>0)
            $user->setNameTitle(trim($params['name_title']));
        if(strlen($params['name_first'])>0)
            $user->setNameFirst(trim($params['name_first']));
        if(strlen($params['name_last'])>0)
            $user->setNameLast(trim($params['name_last']));
        if(strlen($params['location_street'])>0)
            $user->setLocationStreet(trim($params['location_street']));
        if(strlen($params['location_city'])>0)
            $user->setLocationCity(trim($params['location_city']));
        if(strlen($params['location_state'])>0)
            $user->setLocationState(trim($params['location_state']));
        if(strlen($params['location_postcode'])>0)
            $user->setLocationPostcode(trim($params['location_postcode']));
        if(strlen($params['email'])>0)
            $user->setEmail(new Email(trim($params['email'])));
        if(strlen($params['login_username'])>0)
            $user->setLoginUsername(trim($params['login_username']));
        if(strlen($params['login_password'])>0)
            $user->setLoginPassword(trim($params['login_password']));
        if(strlen($params['login_salt'])>0)
            $user->setLoginSalt(trim($params['login_salt']));

        if($params['dob'])
            $user->setDob(self::DateRecognition($params['dob']));
        if($params['registered'])
            $user->setRegistered(self::DateRecognition($params['registered']));

        if(strlen($params['nat'])>0)
            $user->setNat(trim($params['nat']));
        if(strlen($params['picture_large'])>0)
            $user->setPictureLarge(trim($params['picture_large']));
        if(strlen($params['picture_medium'])>0)
            $user->setPictureMedium(trim($params['picture_medium']));
        if(strlen($params['picture_thumbnail'])>0)
            $user->setPictureThumbnail(trim($params['picture_thumbnail']));
        return $user;
    }

    /**
     * @param array $records
     * @throws InvalidArgumentException
     * @return User[]
     */
    public static function createFromCollection(array $records)
    {
        $output = [];
        array_map(function ($item) use (&$output) {
            $output[] = self::createFromArray($item);
        }, $records);
        return $output;
    }
}