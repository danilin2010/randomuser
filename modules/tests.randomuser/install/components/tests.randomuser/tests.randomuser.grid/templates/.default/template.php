<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
$this->addExternalCss("/bitrix/css/main/grid/webform-button.css");
$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '',$arResult["PARAM"]);
?>