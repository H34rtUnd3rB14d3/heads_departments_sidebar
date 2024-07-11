<?php

namespace lib;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use lib\Exceptions\NoControllerException;



class SidebarWidget
{
	protected string $template = ".default";
	protected string $topColor = "#2fc6f6";
	protected int $sort = 300;
	protected string $title = "";

	public function __construct(protected string $controller, string $template, array $params) {
		if (!$controller) {
			throw new NoControllerException();
		}
		if ($template) $this->template = $template;

		$this->topColor = $params["color"] ?? $this->topColor;
		$this->title = $params["title"] ?? $this->title;
		$this->sort = $params["sort"] ?? $this->sort;
	}

	public function execute(): void {
		global $APPLICATION;
		\Bitrix\Main\Loader::includeModule('intranet');
		$arResult = [
			"color" => $this->topColor,
			"title" => $this->title,
			"heads_list" => [],
		];

		$departments = \CIntranetUtils::GetStructure()["DATA"];
		$heads = [];
		foreach ($departments as $department) {
			$heads[] = $department["UF_HEAD"];
		}
		$select = ['ID', 'NAME', 'LAST_NAME', 'PERSONAL_PHOTO'];
		$filter = ['ACTIVE' => 'Y', "ID" => $heads];
		$res = \Bitrix\Main\UserTable::getList(['select' => $select, 'filter' => $filter]);
		$users = $res->fetchAll();
		$userMap = [];
		foreach ($users as $user) {
			$user["PERSONAL_PHOTO"] = \CFile::GetPath($user["PERSONAL_PHOTO"]);
			$user["FULL_NAME"] = $user["NAME"] . " " . $user["LAST_NAME"];
			$userMap[$user["ID"]] = $user;
		}

		foreach ($departments as $department) {
			$arResult["heads_list"][$department["ID"]] = array_merge(["DEPARTMENT_NAME" => $department["NAME"]], $userMap[$department["UF_HEAD"]]);
		}

		$APPLICATION->AddViewContent('sidebar', $this->loadTemplate($arResult), $this->sort);
	}

	public function loadTemplate(array $templateData = []): string {
		$contentHTML = "";
		if (is_file($_SERVER["DOCUMENT_ROOT"] . "/local/templates/" . $this->controller . "/" . $this->template . "/template.php")) {
			ob_start();
			require_once $_SERVER["DOCUMENT_ROOT"] . "/local/templates/" . $this->controller . "/" . $this->template . "/template.php";
			$contentHTML = ob_get_clean();
		} else {
			$contentHTML = "<p style='color: red'>No template found</p>>";
		}
		return $contentHTML;
	}
}