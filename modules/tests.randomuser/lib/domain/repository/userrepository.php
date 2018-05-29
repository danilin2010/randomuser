<?php

namespace Tests\Randomuser\Domain\Repository;

use Tests\Randomuser\Domain\Entity\User;
use Tests\Randomuser\Domain\Factory\UserFactory;
use Tests\Randomuser\Domain\Table\RandomuserUserTable;
use Bitrix\Main\Type;
use DateTime;
use InvalidArgumentException;
use Tests\Randomuser\Domain\Helpers\FactoryConverter;
use Bitrix\Main\Entity;
use Bitrix\Main\UI\PageNavigation;

/**
 * Class Users
 * @package Tests\Randomuser\Domain\Repository
 */
class UserRepository
{

    /**
     * @param DateTime $datetime
     * @return Type\DateTime
     */
    public function GetDateTime(DateTime $datetime)
    {
        return Type\DateTime::createFromPhp($datetime);
    }

    /**
     * @param User $User
     * @return int
     */
    public function create(User &$User)
    {
        $arrUser=$User->getArray();
        unset($arrUser["id"]);
        if($arrUser["dob"])
            $arrUser["dob"]=$this->GetDateTime($arrUser["dob"]);
        if($arrUser["registered"])
            $arrUser["registered"]=$this->GetDateTime($arrUser["registered"]);
        $result = RandomuserUserTable::add($arrUser);
        if ($result->isSuccess())
        {
            return $result->getId();
        }else{
            throw new InvalidArgumentException($result->getErrorMessages());
        }
    }

    /**
     * @param int $id
     * @param User $User
     * @return bool
     */
    public function update($id,User &$User)
    {
        if($id<=0)
            throw new InvalidArgumentException('Неправильный id');
        $arrUser=$User->getArray();
        if($arrUser["dob"])
            $arrUser["dob"]=$this->GetDateTime($arrUser["dob"]);
        if($arrUser["registered"])
            $arrUser["registered"]=$this->GetDateTime($arrUser["registered"]);
        $result = RandomuserUserTable::update($id,$arrUser);
        if ($result->isSuccess())
        {
            return true;
        }else{
            throw new InvalidArgumentException($result->getErrorMessages());
        }
    }

    /**
     * @param int $id
     * @return User
     */
    public function GetById($id)
    {
        if($id<=0)
            throw new InvalidArgumentException('Неправильный id');
        $result=RandomuserUserTable::getList(array(
            'filter' => array('=ID' => $id)
        ));
        if ($row = $result->fetch(new FactoryConverter()))
            return UserFactory::createFromArray($row);
        else
            throw new InvalidArgumentException('Запись не найдена');
    }

    /**
     * @param int $id
     * @return bool
     */
    public function Delete($id)
    {
        if($id<=0)
            throw new InvalidArgumentException('Неправильный id');
        RandomuserUserTable::delete($id);
        return true;
    }

    /**
     * @return User[]
     */
    public function getList(PageNavigation $nav,$sort)
    {
        $parameters=[
            'order'=>$sort,
            "cache"=>["ttl"=>3600],
            'limit'=>$nav->getLimit(),
            "offset"=>$nav->getOffset(),
        ];
        $result = RandomuserUserTable::getList($parameters);
        $FactoryConverter=new FactoryConverter();
        $rows=[];
        while ($row = $result->fetch($FactoryConverter))
            $rows[] = $row;
        return UserFactory::createFromCollection($rows);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $result=RandomuserUserTable::getList(array(
            'select' => ['CNT'],
            "cache"=>["ttl"=>3600],
            'runtime' => [
                new Entity\ExpressionField('CNT', 'COUNT(*)')
            ]
        ));
        if ($row = $result->fetch(new FactoryConverter()))
            return $row["CNT"];
        return 0;
    }

    /**
     * @return array
     */
    public function getNat()
    {
        $r=[];
        $result=RandomuserUserTable::getList(array(
            'order'=>['nat'=>'ASC'],
            'group' => ['nat'],
            'select' => ['nat'],
            "cache"=>["ttl"=>3600],
        ));
        while ($row = $result->fetch(new FactoryConverter()))
        {
            $r[]=$row['nat'];
        }
        return $r;
    }

}