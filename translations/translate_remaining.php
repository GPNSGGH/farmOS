#!/usr/bin/env php
<?php
/**
 * 批量翻译 farmOS 剩余模块的 .info.yml 文件
 */

$base_path = __DIR__;

// 要翻译的文件列表
$files_to_translate = [
    // Core modules
    'modules/core/api/farm_api.info.yml' => [
        'name' => '农场管理系统API',
        'description' => '提供农场管理系统的REST API功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/comment/farm_comment.info.yml' => [
        'name' => '农场管理系统评论',
        'description' => '为农场管理系统实体提供评论功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/csv/farm_csv.info.yml' => [
        'name' => '农场管理系统CSV',
        'description' => '提供CSV格式的导入导出功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/data_stream/data_stream.info.yml' => [
        'name' => '数据流',
        'description' => '提供数据流实体类型用于存储传感器数据。',
        'package' => '农场管理系统'
    ],
    'modules/core/entity/farm_entity.info.yml' => [
        'name' => '农场管理系统实体',
        'description' => '提供农场管理系统实体类型的核心功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/export/farm_export.info.yml' => [
        'name' => '农场管理系统导出',
        'description' => '提供数据导出功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/field/farm_field.info.yml' => [
        'name' => '农场管理系统字段',
        'description' => '提供自定义字段类型和功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/form/farm_form.info.yml' => [
        'name' => '农场管理系统表单',
        'description' => '提供表单保护和验证功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/format/farm_format.info.yml' => [
        'name' => '农场管理系统格式',
        'description' => '提供数据格式化和显示功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/geo/farm_geo.info.yml' => [
        'name' => '农场管理系统地理',
        'description' => '提供地理位置和地理数据功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/id_tag/farm_id_tag.info.yml' => [
        'name' => 'ID标签',
        'description' => '提供资产ID标签功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/image/farm_image.info.yml' => [
        'name' => '农场管理系统图片',
        'description' => '提供图片上传和显示功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/import/farm_import.info.yml' => [
        'name' => '农场管理系统导入',
        'description' => '提供数据导入功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/kml/farm_kml.info.yml' => [
        'name' => 'KML导入',
        'description' => '提供KML格式的地理位置导入功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/l10n/farm_l10n.info.yml' => [
        'name' => '农场管理系统本地化',
        'description' => '提供农场管理系统的本地化和翻译功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/login/farm_login.info.yml' => [
        'name' => '农场管理系统登录',
        'description' => '提供登录功能和OAuth认证。',
        'package' => '农场管理系统'
    ],
    'modules/core/migrate/farm_migrate.info.yml' => [
        'name' => '农场管理系统迁移',
        'description' => '提供从旧版本迁移的功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/notification/farm_notification.info.yml' => [
        'name' => '通知',
        'description' => '提供通知和提醒功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/organization/farm_organization.info.yml' => [
        'name' => '组织',
        'description' => '提供组织实体类型。',
        'package' => '农场管理系统'
    ],
    'modules/core/owner/farm_owner.info.yml' => [
        'name' => '所有者',
        'description' => '提供资产所有者功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/parent/farm_parent.info.yml' => [
        'name' => '父级关系',
        'description' => '提供资产父级关系功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/quantity/farm_quantity.info.yml' => [
        'name' => '数量',
        'description' => '提供数量字段类型。',
        'package' => '农场管理系统'
    ],
    'modules/core/quick/farm_quick.info.yml' => [
        'name' => '快速表单',
        'description' => '提供快速创建资产和日志的表单。',
        'package' => '农场管理系统'
    ],
    'modules/core/report/farm_report.info.yml' => [
        'name' => '报告',
        'description' => '提供报告生成功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/role/farm_role.info.yml' => [
        'name' => '农场管理系统角色',
        'description' => '提供角色和权限管理功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/setup/farm_setup.info.yml' => [
        'name' => '农场管理系统设置',
        'description' => '提供安装设置向导。',
        'package' => '农场管理系统'
    ],
    'modules/core/test/farm_test.info.yml' => [
        'name' => '农场管理系统测试',
        'description' => '提供测试基础设施。',
        'package' => '农场管理系统'
    ],
    'modules/core/timeline/farm_timeline.info.yml' => [
        'name' => '时间线',
        'description' => '提供时间线显示功能。',
        'package' => '农场管理系统'
    ],
    'modules/core/update/farm_update.info.yml' => [
        'name' => '农场管理系统更新',
        'description' => '提供数据库更新功能。',
        'package' => '农场管理系统'
    ],
    
    // UI submodules
    'modules/core/ui/action/farm_ui_action.info.yml' => [
        'name' => '农场管理系统操作',
        'description' => '提供用户界面操作功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/breadcrumb/farm_ui_breadcrumb.info.yml' => [
        'name' => '农场管理系统面包屑',
        'description' => '提供面包屑导航功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/dashboard/farm_ui_dashboard.info.yml' => [
        'name' => '仪表板',
        'description' => '提供仪表板功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/help/farm_ui_help.info.yml' => [
        'name' => '农场管理系统帮助',
        'description' => '提供帮助功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/location/farm_ui_location.info.yml' => [
        'name' => '农场管理系统位置',
        'description' => '提供位置用户界面功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/map/farm_ui_map.info.yml' => [
        'name' => '农场管理系统地图',
        'description' => '提供地图用户界面功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/menu/farm_ui_menu.info.yml' => [
        'name' => '农场管理系统菜单',
        'description' => '提供菜单功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/metrics/farm_ui_metrics.info.yml' => [
        'name' => '农场管理系统指标',
        'description' => '提供指标显示功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/term/farm_ui_term.info.yml' => [
        'name' => '农场管理系统术语',
        'description' => '提供术语用户界面功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/theme/farm_ui_theme.info.yml' => [
        'name' => '农场管理系统主题',
        'description' => '提供默认主题功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/user/farm_ui_user.info.yml' => [
        'name' => '农场管理系统用户',
        'description' => '提供用户界面功能。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/ui/views/farm_ui_views.info.yml' => [
        'name' => '农场管理系统视图',
        'description' => '提供视图功能。',
        'package' => '农场管理系统用户界面'
    ],
    
    // Quick modules
    'modules/quick/birth/farm_quick_birth.info.yml' => [
        'name' => '快速出生',
        'description' => '提供快速创建出生日志的表单。',
        'package' => '农场管理系统快速表单'
    ],
    'modules/quick/group/farm_quick_group.info.yml' => [
        'name' => '快速群组',
        'description' => '提供快速创建群组资产的表单。',
        'package' => '农场管理系统快速表单'
    ],
    'modules/quick/inventory/farm_quick_inventory.info.yml' => [
        'name' => '快速库存',
        'description' => '提供快速调整库存的表单。',
        'package' => '农场管理系统快速表单'
    ],
    'modules/quick/movement/farm_quick_movement.info.yml' => [
        'name' => '快速移动',
        'description' => '提供快速移动资产的表单。',
        'package' => '农场管理系统快速表单'
    ],
    'modules/quick/planting/farm_quick_planting.info.yml' => [
        'name' => '快速种植',
        'description' => '提供快速创建植物资产和播种日志的表单。',
        'package' => '农场管理系统快速表单'
    ],
    
    // Quantity modules
    'modules/quantity/material/farm_quantity_material.info.yml' => [
        'name' => '材料数量',
        'description' => '提供材料数量字段类型。',
        'package' => '农场管理系统数量'
    ],
    'modules/quantity/standard/farm_quantity_standard.info.yml' => [
        'name' => '标准数量',
        'description' => '提供标准数量字段类型。',
        'package' => '农场管理系统数量'
    ],
    
    // Organization modules
    'modules/organization/farm/farm_farm.info.yml' => [
        'name' => '农场组织',
        'description' => '添加农场组织类型。',
        'package' => '农场管理系统组织'
    ],
    
    // Taxonomy modules
    'modules/taxonomy/animal_type/farm_animal_type.info.yml' => [
        'name' => '动物类型词汇表',
        'description' => '提供动物类型的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/equipment_type/farm_equipment_type.info.yml' => [
        'name' => '设备类型词汇表',
        'description' => '提供设备类型的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/lab/farm_lab.info.yml' => [
        'name' => '实验室词汇表',
        'description' => '提供实验室的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/log_category/farm_log_category.info.yml' => [
        'name' => '日志分类词汇表',
        'description' => '提供日志分类的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/material_type/farm_material_type.info.yml' => [
        'name' => '材料类型词汇表',
        'description' => '提供材料类型的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/plant_type/farm_plant_type.info.yml' => [
        'name' => '植物类型词汇表',
        'description' => '提供植物类型的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/product_type/farm_product_type.info.yml' => [
        'name' => '产品类型词汇表',
        'description' => '提供产品类型的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/season/farm_season.info.yml' => [
        'name' => '季节词汇表',
        'description' => '提供季节的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/test_method/farm_test_method.info.yml' => [
        'name' => '测试方法词汇表',
        'description' => '提供测试方法的词汇表。',
        'package' => '农场管理系统分类'
    ],
    'modules/taxonomy/unit/farm_unit.info.yml' => [
        'name' => '单位词汇表',
        'description' => '提供计量单位的词汇表。',
        'package' => '农场管理系统分类'
    ],
    
    // Role modules
    'modules/role/viewer/farm_viewer.info.yml' => [
        'name' => '查看者角色',
        'description' => '提供查看者角色。',
        'package' => '农场管理系统角色'
    ],
    'modules/role/worker/farm_worker.info.yml' => [
        'name' => '工作者角色',
        'description' => '提供工作者角色。',
        'package' => '农场管理系统角色'
    ],
    'modules/role/manager/farm_manager.info.yml' => [
        'name' => '管理者角色',
        'description' => '提供管理者角色。',
        'package' => '农场管理系统角色'
    ],
    'modules/role/config_admin/farm_config_admin.info.yml' => [
        'name' => '配置管理员角色',
        'description' => '提供配置管理员角色。',
        'package' => '农场管理系统角色'
    ],
    'modules/role/account_admin/farm_account_admin.info.yml' => [
        'name' => '账户管理员角色',
        'description' => '提供账户管理员角色。',
        'package' => '农场管理系统角色'
    ],
];

echo "开始翻译剩余的 farmOS 模块文件...\n\n";

$count = 0;
foreach ($files_to_translate as $file => $values) {
    $full_path = $base_path . '/' . $file;
    
    if (!file_exists($full_path)) {
        echo "跳过不存在的文件: $file\n";
        continue;
    }
    
    $content = file_get_contents($full_path);
    
    // 替换 name
    if (isset($values['name'])) {
        $content = preg_replace('/^name: .+$/m', 'name: ' . $values['name'], $content);
    }
    
    // 替换 description
    if (isset($values['description'])) {
        $content = preg_replace("/^description: .+$/m", 'description: \'' . $values['description'] . '\'', $content);
    }
    
    // 替换 package
    if (isset($values['package'])) {
        $content = preg_replace('/^package: .+$/m', 'package: ' . $values['package'], $content);
    }
    
    file_put_contents($full_path, $content);
    $count++;
    echo "✓ 已翻译: $file\n";
}

echo "\n完成！共翻译 $count 个文件。\n";
