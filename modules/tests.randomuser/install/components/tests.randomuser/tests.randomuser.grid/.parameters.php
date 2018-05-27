<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__); 

try
{
	$arComponentParameters = array(
		'GROUPS' => array(
		),
		'PARAMETERS' => array(
			'URL_API' => Array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('TESTS_RANDOMUSER_GRID_URL_API'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'https://randomuser.me/api/',
			),
		)
	);
}
catch (Main\LoaderException $e)
{
	ShowError($e->getMessage());
}
?>