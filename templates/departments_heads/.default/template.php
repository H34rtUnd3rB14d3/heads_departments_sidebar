<style>
    .--row {
        margin: 15px;
    }

    .user-avatar {
        align-self: center;
    }
</style>
<div class="sidebar-widget sidebar-widget-tasks">
    <div class="sidebar-widget-top" style="background-color: <?=$templateData["color"]?>">
        <div class="sidebar-widget-top-title">
            <a href="/company/vis_structure.php"><?=$templateData["title"]?></a>
        </div>
    </div>
    <div class="sidebar-widget-content">
        <?php foreach ($templateData["heads_list"] as $department_id => $data):?>
            <a href="/company/personal/user/<?=$data["ID"]?>/" class="sidebar-widget-item --row">
                <span class="user-avatar user-default-avatar" style="background: url('<?=$data["PERSONAL_PHOTO"] ?? "/bitrix/js/ui/icons/b24/images/ui-user.svg?v2"?>') no-repeat center; background-size: cover; <?=$data["PERSONAL_PHOTO"] ? "" : "background-color: #7b8691"?>"></span>
                <span class="sidebar-user-info">
				<span class="user-birth-name"><?=$data["FULL_NAME"]?></span>
				<span class="user-birth-date"><?=$data["DEPARTMENT_NAME"]?></span>
			</span>
            </a>
        <?php endforeach;?>
    </div>
</div>