<?php

namespace Tests\Randomuser\Domain\Repository;

use Tests\Randomuser\Domain\Entity\User;
use Tests\Randomuser\Domain\Factory\UserFactory;
use Tests\Randomuser\Domain\Table\RandomuserUserTable;
use Bitrix\Main\Type;
use DateTime;
use InvalidArgumentException;
use Tests\Randomuser\Domain\Helpers\FactoryConverter;

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
        $dob=new Type\DateTime();
        $dob->createFromPhp($datetime);
        return $dob;
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
        $result=$this->db->GetQuery("SELECT * FROM guestbook_user WHERE id=".$id);
        $r=$result->fetch_array(MYSQLI_ASSOC);
        return UserFactory::createFromArray($r);
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
    public function getList()
    {
        $parameters=[];
        $result = RandomuserUserTable::getList($parameters);
        $FactoryConverter=new FactoryConverter();
        $rows=[];
        while ($row = $result->fetch($FactoryConverter))
            $rows[] = $row;
        return UserFactory::createFromCollection($rows);
    }

    /*
use \Bitrix\Main\Loader;
use \Tests\Randomuser\App\Services\UserServices;
use \Tests\Randomuser\Domain\Repository\UserRepository;
Loader::includeModule('tests.randomuser');

//$Services=new UserServices();
//$Rows=$Services->getRows();

$Services=new UserRepository();
$Rows=$Services->getList();
print_r($Rows);
*/
}