<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Context;
use Bitrix\Main\EventManager;
use Bitrix\Main\UI\Extension;
use lib\SidebarWidget;

if (!CSite::InDir('/stream/')) return;

$sidebar = new SidebarWidget("departments_heads", "", [
	"color" => "#000000",
	"title" => "Руководители отделов"
]);

$sidebar->execute();



/* Отладка */
//$eventManager = EventManager::getInstance();
//$eventManager->addEventHandlerCompatible('main', 'OnAfterEpilog', 'dumpViews');
//
//function dumpViews() {
//    global $APPLICATION;
//    \Bitrix\Main\Diag\Debug::writeToFile(json_encode($APPLICATION->__view), "", "view.json");
//
//    $context = Context::getCurrent();
//    $request = $context->getRequest();
//
//	\Bitrix\Main\Diag\Debug::writeToFile(json_encode($request->toArray()), "request", "request.json");
//}