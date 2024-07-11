<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule('crm');

use Bitrix\Crm\Service;

$factory = Service\Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$itemId = 4;
$item = $factory->getItem($itemId);
if ($item) {
	$item->setTitle('Тестовая сделка');
	$item->setStageId("PREPARATION");
}
$operation = $factory->getUpdateOperation($item);
$result = $operation->launch();
if (!$result->isSuccess()) {
	echo "Ошибка обновления: " . print_r($result->getErrorMessages(), 1);
} else {
	echo "Сделка успешно обновлена";
}

/*
CModule::IncludeModule('crm');
$dealFields = array(
    'TITLE' => 'Тестовая сделка',
    "STAGE_ID" => 'C2:PREPARATION',
);
$idDeal = 15;
$deal = new CCrmDeal(false);
$dealId = $deal->Update($idDeal, $dealFields);
if ($dealId === false) {
    echo "Ошибка обновления: " . $deal->LAST_ERROR;
} else {
    echo "Сделка успешно обновлена";
}
 * */