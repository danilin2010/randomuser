<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\Localization\Loc as Loc;

class testsRrandomuserGrid extends \CBitrixComponent
{

    protected $GridID="testsRrandomuserGrid";
    protected $recordCount=1000;

    /**
     * подготавливает входные параметры
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($params)
    {
        $result = [
            'URL_API' => trim($params['URL_API']),
        ];
        return $result;
    }

    /**
     * проверяет заполнение обязательных параметров
     * @throws SystemException
     */
    protected function checkParams()
    {
        if (strlen($this->arParams['URL_API']) <= 0)
            throw new Main\ArgumentNullException('URL_API');
    }

    protected function getRows(PageNavigation $nav,$sort){
        $uri = new Uri($this->arParams['URL_API']);
        $param=[
            "seed"=>$this->GridID,
            "page"=>$nav->getOffset(),
            "results" => $nav->getLimit(),
        ];
        //$param=array_merge($param,$sort);
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
            $list[]=array(
                'data'=>$data,
            );
        }
        return $list;
    }

    protected function getColums(){
        return [
            ['id' => 'gender', 'name' => Loc::getMessage('gender'), 'default' => true],
            ['id' => 'name_title', 'name' => Loc::getMessage('name_title'), 'default' => true],
            ['id' => 'name_first', 'name' => Loc::getMessage('name_first'), 'default' => true],
            ['id' => 'name_last', 'name' => Loc::getMessage('name_last'), 'default' => true],
            ['id' => 'location_street', 'name' => Loc::getMessage('location_street'), 'default' => true],
            ['id' => 'location_city', 'name' => Loc::getMessage('location_city'), 'default' => true],
            ['id' => 'location_state', 'name' => Loc::getMessage('location_state'), 'default' => true],
            ['id' => 'location_postcode', 'name' => Loc::getMessage('location_postcode'), 'default' => true],
            ['id' => 'email', 'name' => Loc::getMessage('email'), 'default' => true],
            ['id' => 'login_username', 'name' => Loc::getMessage('login_username'), 'default' => true],
            ['id' => 'login_password', 'name' => Loc::getMessage('login_password'), 'default' => true],
            ['id' => 'login_salt', 'name' => Loc::getMessage('login_salt'), 'default' => true],
            ['id' => 'dob', 'name' => Loc::getMessage('dob'), 'default' => true],
            ['id' => 'registered', 'name' => Loc::getMessage('registered'), 'default' => true],
            ['id' => 'nat', 'name' => Loc::getMessage('nat'), 'default' => true],
        ];
    }
	
	/**
	 * получение результатов
	 */
	protected function getResult()
	{
        $grid_options = new Options($this->GridID);
        $sort = $grid_options->GetSorting(
            [
                'sort' =>['gender' => 'DESC'],
                'vars' => ['by' => 'by', 'order' => 'order']
            ]
        );
        $nav_params = $grid_options->GetNavParams();
        $nav = new PageNavigation($this->GridID);
        $nav->allowAllRecords(false)
            ->setPageSize($nav_params['nPageSize'])
            ->initFromUri();

        $nav->setRecordCount($this->recordCount);
        $list=$this->getRows($nav,$sort["sort"]);
        $param=[
            'GRID_ID' => $this->GridID,
            'COLUMNS' => $this->getColums(),
            'ROWS' => $list,
            'SHOW_ROW_CHECKBOXES' => false,
            'NAV_OBJECT' => $nav,
            'AJAX_MODE' => 'Y',
            'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
            'PAGE_SIZES' => [
                ['NAME' => "5", 'VALUE' => '5'],
                ['NAME' => '10', 'VALUE' => '10'],
                ['NAME' => '20', 'VALUE' => '20'],
                ['NAME' => '50', 'VALUE' => '50'],
                ['NAME' => '100', 'VALUE' => '100']
            ],
            'AJAX_OPTION_JUMP'          => 'N',
            'SHOW_CHECK_ALL_CHECKBOXES' => false,
            'SHOW_ROW_ACTIONS_MENU'     => false,
            'SHOW_GRID_SETTINGS_MENU'   => true,
            'SHOW_NAVIGATION_PANEL'     => true,
            'SHOW_PAGINATION'           => true,
            'SHOW_SELECTED_COUNTER'     => false,
            'SHOW_TOTAL_COUNTER'        => false,
            'SHOW_PAGESIZE'             => true,
            'SHOW_ACTION_PANEL'         => true,
            'ALLOW_COLUMNS_SORT'        => true,
            'ALLOW_COLUMNS_RESIZE'      => true,
            'ALLOW_HORIZONTAL_SCROLL'   => true,
            'ALLOW_SORT'                => true,
            'ALLOW_PIN_HEADER'          => true,
            'AJAX_OPTION_HISTORY'       => 'N'
        ];
        $this->arResult["PARAM"]=$param;
	}
	
	/**
	 * выполняет логику работы компонента
	 */
	public function executeComponent()
	{
		try
		{
            $this->checkParams();
			$this->getResult();
			$this->includeComponentTemplate();
		}
		catch (Exception $e)
		{
			ShowError($e->getMessage());
		}
	}
}
?>