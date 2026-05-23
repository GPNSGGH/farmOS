#!/usr/bin/env php
<?php
/**
 * 批量翻译 farmOS 模块的 .info.yml 文件为中文
 */

$modules_dir = __DIR__;

// 翻译映射表
$translations = [
    // Core modules
    'modules/core/asset/asset.info.yml' => [
        'name' => '资产',
        'description' => '提供用于现实世界记录管理的资产实体类型。',
        'package' => '资产'
    ],
    'modules/core/api/farm_api.info.yml' => [
        'name' => '农场管理系统API',
        'description' => '提供农场管理系统的REST API功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/comment/farm_comment.info.yml' => [
        'name' => '农场管理系统评论',
        'description' => '为农场管理系统实体提供评论功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/csv/farm_csv.info.yml' => [
        'name' => '农场管理系统CSV',
        'description' => '提供CSV格式的导入导出功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/data_stream/data_stream.info.yml' => [
        'name' => '数据流',
        'description' => '提供数据流实体类型用于存储传感器数据。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/entity/farm_entity.info.yml' => [
        'name' => '农场管理系统实体',
        'description' => '提供农场管理系统实体类型的核心功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/export/farm_export.info.yml' => [
        'name' => '农场管理系统导出',
        'description' => '提供数据导出功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/field/farm_field.info.yml' => [
        'name' => '农场管理系统字段',
        'description' => '提供自定义字段类型和功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/flag/farm_flag.info.yml' => [
        'name' => '标记',
        'description' => '提供资产和日志的标记功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/form/farm_form.info.yml' => [
        'name' => '农场管理系统表单',
        'description' => '提供表单保护和验证功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/format/farm_format.info.yml' => [
        'name' => '农场管理系统格式',
        'description' => '提供数据格式化和显示功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/geo/farm_geo.info.yml' => [
        'name' => '农场管理系统地理',
        'description' => '提供地理位置和地理数据功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/id_tag/farm_id_tag.info.yml' => [
        'name' => 'ID标签',
        'description' => '提供资产ID标签功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/image/farm_image.info.yml' => [
        'name' => '农场管理系统图片',
        'description' => '提供图片上传和显示功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/import/farm_import.info.yml' => [
        'name' => '农场管理系统导入',
        'description' => '提供数据导入功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/inventory/farm_inventory.info.yml' => [
        'name' => '库存',
        'description' => '提供资产库存跟踪功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/kml/farm_kml.info.yml' => [
        'name' => 'KML导入',
        'description' => '提供KML格式的地理位置导入功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/l10n/farm_l10n.info.yml' => [
        'name' => '农场管理系统本地化',
        'description' => '提供农场管理系统的本地化和翻译功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/location/farm_location.info.yml' => [
        'name' => '位置',
        'description' => '提供资产位置跟踪功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/log/farm_log.info.yml' => [
        'name' => '日志',
        'description' => '提供用于记录农场数据的日志实体类型。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/login/farm_login.info.yml' => [
        'name' => '农场管理系统登录',
        'description' => '提供登录功能和OAuth认证。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/map/farm_map.info.yml' => [
        'name' => '地图',
        'description' => '提供地图显示和交互功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/migrate/farm_migrate.info.yml' => [
        'name' => '农场管理系统迁移',
        'description' => '提供从旧版本迁移的功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/notification/farm_notification.info.yml' => [
        'name' => '通知',
        'description' => '提供通知和提醒功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/organization/farm_organization.info.yml' => [
        'name' => '组织',
        'description' => '提供组织实体类型。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/owner/farm_owner.info.yml' => [
        'name' => '所有者',
        'description' => '提供资产所有者功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/parent/farm_parent.info.yml' => [
        'name' => '父级关系',
        'description' => '提供资产父级关系功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/plan/plan.info.yml' => [
        'name' => '计划',
        'description' => '提供计划实体类型用于规划农场活动。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/quantity/farm_quantity.info.yml' => [
        'name' => '数量',
        'description' => '提供数量字段类型。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/quick/farm_quick.info.yml' => [
        'name' => '快速表单',
        'description' => '提供快速创建资产和日志的表单。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/report/farm_report.info.yml' => [
        'name' => '报告',
        'description' => '提供报告生成功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/role/farm_role.info.yml' => [
        'name' => '农场管理系统角色',
        'description' => '提供角色和权限管理功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/setup/farm_setup.info.yml' => [
        'name' => '农场管理系统设置',
        'description' => '提供安装设置向导。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/test/farm_test.info.yml' => [
        'name' => '农场管理系统测试',
        'description' => '提供测试基础设施。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/timeline/farm_timeline.info.yml' => [
        'name' => '时间线',
        'description' => '提供时间线显示功能。',
        'package' => '农场管理系统核心'
    ],
    'modules/core/ui/farm_ui.info.yml' => [
        'name' => '农场管理系统用户界面',
        'description' => '提供默认的用户界面元素（按类型组织为子模块）。',
        'package' => '农场管理系统用户界面'
    ],
    'modules/core/update/farm_update.info.yml' => [
        'name' => '农场管理系统更新',
        'description' => '提供数据库更新功能。',
        'package' => '农场管理系统核心'
    ],
    
    // Asset modules
    'modules/asset/animal/farm_animal.info.yml' => [
        'name' => '动物资产',
        'description' => '添加动物资产类型。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/compost/farm_compost.info.yml' => [
        'name' => '堆肥资产',
        'description' => '添加堆肥资产类型。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/equipment/farm_equipment.info.yml' => [
        'name' => '设备资产',
        'description' => '添加设备资产类型。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/group/farm_group.info.yml' => [
        'name' => '群组资产',
        'description' => '添加群组资产类型用于将其他资产分组。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/land/farm_land.info.yml' => [
        'name' => '土地资产',
        'description' => '添加土地资产类型用于追踪农场地理区域。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/material/farm_material.info.yml' => [
        'name' => '材料资产',
        'description' => '添加材料资产类型用于库存追踪。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/plant/farm_plant.info.yml' => [
        'name' => '植物资产',
        'description' => '添加植物资产类型用于追踪种植的作物。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/product/farm_product.info.yml' => [
        'name' => '产品资产',
        'description' => '添加产品资产类型用于追踪农场产品。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/seed/farm_seed.info.yml' => [
        'name' => '种子资产',
        'description' => '添加种子资产类型用于追踪种子库存。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/sensor/farm_sensor.info.yml' => [
        'name' => '传感器资产',
        'description' => '添加传感器资产类型用于追踪传感器和设备数据。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/structure/farm_structure.info.yml' => [
        'name' => '建筑资产',
        'description' => '添加建筑资产类型用于追踪农场建筑和结构。',
        'package' => '农场管理系统资产'
    ],
    'modules/asset/water/farm_water.info.yml' => [
        'name' => '水源资产',
        'description' => '添加水源资产类型用于追踪水体和灌溉。',
        'package' => '农场管理系统资产'
    ],
    
    // Log modules
    'modules/log/activity/farm_activity.info.yml' => [
        'name' => '活动日志',
        'description' => '添加活动日志类型。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/birth/farm_birth.info.yml' => [
        'name' => '出生日志',
        'description' => '添加出生日志类型用于记录动物出生。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/harvest/farm_harvest.info.yml' => [
        'name' => '收获日志',
        'description' => '添加收获日志类型用于记录作物收获。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/input/farm_input.info.yml' => [
        'name' => '投入日志',
        'description' => '添加投入日志类型用于记录肥料、农药等投入。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/lab_test/farm_lab_test.info.yml' => [
        'name' => '实验室检测日志',
        'description' => '添加实验室检测日志类型用于记录检测结果。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/maintenance/farm_maintenance.info.yml' => [
        'name' => '维护日志',
        'description' => '添加维护日志类型用于记录设备维护。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/medical/farm_medical.info.yml' => [
        'name' => '医疗日志',
        'description' => '添加医疗日志类型用于记录动物医疗。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/observation/farm_observation.info.yml' => [
        'name' => '观察日志',
        'description' => '添加观察日志类型用于记录观察和发现。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/seeding/farm_seeding.info.yml' => [
        'name' => '播种日志',
        'description' => '添加播种日志类型用于植物资产。',
        'package' => '农场管理系统日志'
    ],
    'modules/log/transplanting/farm_transplanting.info.yml' => [
        'name' => '移栽日志',
        'description' => '添加移栽日志类型用于记录植物移栽。',
        'package' => '农场管理系统日志'
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
    
    // UI modules
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
];

echo "开始翻译 farmOS 模块文件...\n\n";

$count = 0;
foreach ($translations as $file => $values) {
    $full_path = $modules_dir . '/' . $file;
    
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
