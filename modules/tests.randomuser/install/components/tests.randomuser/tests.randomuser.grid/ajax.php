<?
/** @global \CMain $APPLICATION */
define('STOP_STATISTICS', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use \Tests\Randomuser\App\Services\UserServices;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if (!\Bitrix\Main\Loader::includeModule('tests.randomuser'))
	return;
if($request->isPost())
{
    $id=(int)$request->getPost("id");
    $nat=trim($request->getPost("nat"));
    if($id>0 && strlen($nat)>0)
    {
        $services=new UserServices();
        $services->setNat($id,$nat);
    }

}



