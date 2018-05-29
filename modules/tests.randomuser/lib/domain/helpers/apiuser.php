<?

namespace Tests\Randomuser\Domain\Helpers;

use DateTime;
use Bitrix\Main\Web\Uri;
use Tests\Randomuser\Domain\Entity\User;
use Tests\Randomuser\Domain\Factory\UserFactory;

class ApiUser
{
    const GridID="testsRrandomuserGrid";
    const recordCount=1000;
    const api="https://randomuser.me/api/";

    /**
     * @return User[]
     */
    public static function get()
    {
        $uri = new Uri(self::api);
        $param=[
            "seed"=>self::GridID,
            "results" => self::recordCount,
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
            $data['dob'] = DateTime::createFromFormat('Y-m-d H:i:s', $data['dob']);
            $data['registered'] = DateTime::createFromFormat('Y-m-d H:i:s', $data['registered']);
            $list[]=$data;
        }
        return UserFactory::createFromCollection($list);
    }
}