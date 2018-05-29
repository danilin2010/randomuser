<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\UI\PageNavigation;
use \Tests\Randomuser\App\Services\UserServices;
use Bitrix\Main\Localization\Loc as Loc;

class testsRrandomuserGrid extends \CBitrixComponent
{

    protected $GridID="testsRrandomuserGrid";
    protected $recordCount=1000;
    protected $services;

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

    }

    /**
     * проверяет подключение необходиимых модулей
     * @throws LoaderException
     */
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('tests.randomuser'))
            throw new Main\LoaderException(Loc::getMessage('Не найден модуль randomuser.me'));
    }

    protected function getArrSelect()
    {
        return [
            "REFERENCE" => $this->services->getNat(),
            "REFERENCE_ID" =>$this->services->getNat(),
        ];
    }

    protected function htmlSelect($id,$val){
        return SelectBoxFromArray("CHOICE_".$id,
            $this->getArrSelect(),
            $val, "", "onchange='elgridUpdate.setNat(".$id.",this);'");
    }

    protected function getRows(PageNavigation $nav,$sort){

        $Rows=$this->services->getList($nav,$sort);
        $list=[];
        foreach ($Rows as $result){
            $data=$result->getArray();
            if($data["dob"])
                $data["dob"]=$data["dob"]->format('Y-m-d H:i:s');
            if($data["registered"])
                $data["registered"]=$data["registered"]->format('Y-m-d H:i:s');
            $columns=$data;
            $columns["nat"]=$this->htmlSelect($result->getId(),$data["nat"]);
            $list[]=array(
                "id"=>$result->getId(),
                'data'=>$data,
                'columns'=>$columns,
                "editable"=>true,
            );
        }
        return $list;
    }

    protected function getColums(){
        return [
            ['id' => 'id', 'name' => 'id', 'default' => true, 'sort' => 'id'],
            ['id' => 'gender','name' => Loc::getMessage('gender'),'default' => true, 'sort' => 'gender'],
            ['id' => 'name_title', 'name' => Loc::getMessage('name_title'), 'default' => true, 'sort' => 'name_title'],
            ['id' => 'name_first', 'name' => Loc::getMessage('name_first'), 'default' => true, 'sort' => 'name_first'],
            ['id' => 'name_last', 'name' => Loc::getMessage('name_last'), 'default' => true, 'sort' => 'name_last'],
            ['id' => 'location_street', 'name' => Loc::getMessage('location_street'), 'default' => true, 'sort' => 'location_street'],
            ['id' => 'location_city', 'name' => Loc::getMessage('location_city'), 'default' => true, 'sort' => 'location_city'],
            ['id' => 'location_state', 'name' => Loc::getMessage('location_state'), 'default' => true, 'sort' => 'location_state'],
            ['id' => 'location_postcode', 'name' => Loc::getMessage('location_postcode'), 'default' => true, 'sort' => 'location_postcode'],
            ['id' => 'email', 'name' => Loc::getMessage('email'), 'default' => true, 'sort' => 'email'],
            ['id' => 'login_username', 'name' => Loc::getMessage('login_username'), 'default' => true, 'sort' => 'login_username'],
            ['id' => 'login_password', 'name' => Loc::getMessage('login_password'), 'default' => true, 'sort' => 'login_password'],
            ['id' => 'login_salt', 'name' => Loc::getMessage('login_salt'), 'default' => true, 'sort' => 'login_salt'],
            ['id' => 'dob', 'name' => Loc::getMessage('dob'), 'default' => true, 'sort' => 'dob'],
            ['id' => 'registered', 'name' => Loc::getMessage('registered'), 'default' => true, 'sort' => 'registered'],
            ['id' => 'nat', 'name' => Loc::getMessage('nat'), 'default' => true, 'sort' => 'nat'],
        ];
    }

    /**
	 * получение результатов
	 */
	protected function getResult()
	{
        $this->services=new UserServices();
        CJSCore::Init(array('ajax'));
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

        $nav->setRecordCount($this->services->getCount());
        $list=$this->getRows($nav,$sort["sort"]);
        $param=[
            'EDITABLE' => true,
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
            $this->checkModules();
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