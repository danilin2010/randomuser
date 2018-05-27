<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
	"NAME" => Loc::getMessage('TESTS_RANDOMUSER_GRID_NAME'),
	"DESCRIPTION" => Loc::getMessage('TESTS_RANDOMUSER_GRID_DESCRIPTION'),
	"SORT" => 10,
	"PATH" => [
		"ID" => 'mscoder',
		"NAME" => Loc::getMessage('TESTS_RANDOMUSER_GRID_GROUP'),
		"SORT" => 10,
	],
];

?>