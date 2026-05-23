
#!/usr/bin/env php
&lt;?php
/**
 * 全面提取farmOS所有翻译字符串
 */

$baseDir = __DIR__ . '/..';
$translations = [];

echo "🔍 全面扫描farmOS代码库提取翻译字符串...\n\n";

// 1. 扫描所有PHP文件
$phpIterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$phpCount = 0;
foreach ($phpIterator as $file) {
    if ($file-&gt;getExtension() === 'php') {
        $content = file_get_contents($file-&gt;getPathname());
        
        // 匹配 $this-&gt;t('...') 格式
        preg_match_all('/\$this-&gt;t\([\'"]([^\'"]+)[\'"]\)/', $content, $matches);
        foreach ($matches[1] as $match) {
            $translations[$match] = true;
        }
        
        // 匹配 t('...') 格式
        preg_match_all('/[^a-zA-Z0-9_]t\([\'"]([^\'"]+)[\'"]\)/', $content, $matches);
        foreach ($matches[1] as $match) {
            $translations[$match] = true;
        }
        
        // 匹配 Drupal::translation()-&gt;translate('...')
        preg_match_all('/Drupal::translation\(\)-&gt;translate\([\'"]([^\'"]+)[\'"]\)/', $content, $matches);
        foreach ($matches[1] as $match) {
            $translations[$match] = true;
        }
        
        $phpCount++;
    }
}
echo "📄 扫描了 {$phpCount} 个PHP文件\n";

// 2. 扫描Twig模板文件
$twigCount = 0;
$twigIterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);
foreach ($twigIterator as $file) {
    if ($file-&gt;getExtension() === 'twig') {
        $content = file_get_contents($file-&gt;getPathname());
        
        // 匹配 {{ '...'|t }} 格式
        preg_match_all('/\{\{\s*[\'"]([^\'"]+)[\'"]\|t\s*\}\}/', $content, $matches);
        foreach ($matches[1] as $match) {
            $translations[$match] = true;
        }
        
        // 匹配 {% trans %}...{% endtrans %} 格式
        preg_match_all('/\{%\s*trans\s*%\}([^{]+)\{%\s*endtrans\s*%\}/', $content, $matches);
        foreach ($matches[1] as $match) {
            $match = trim($match);
            if ($match) {
                $translations[$match] = true;
            }
        }
        
        $twigCount++;
    }
}
echo "📄 扫描了 {$twigCount} 个Twig模板\n";

// 3. 扫描配置文件和模块信息文件
$configCount = 0;
$configIterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);
foreach ($configIterator as $file) {
    if ($file-&gt;getExtension() === 'info' || $file-&gt;getExtension() === 'yml' || $file-&gt;getExtension() === 'yaml') {
        $content = file_get_contents($file-&gt;getPathname());
        
        // 提取 name: 字段
        preg_match_all('/^\s*name:\s*[\'"]?([^\'"\n]+)[\'"]?/m', $content, $matches);
        foreach ($matches[1] as $match) {
            if (strpos($match, 'farm') === 0 || strlen($match) &lt; 50) {
                $translations[$match] = true;
            }
        }
        
        // 提取 description: 字段
        preg_match_all('/^\s*description:\s*[\'"]?([^\'"\n]+)[\'"]?/m', $content, $matches);
        foreach ($matches[1] as $match) {
            if (strlen($match) &lt; 200) {
                $translations[$match] = true;
            }
        }
        
        // 提取 label: 字段
        preg_match_all('/^\s*label:\s*[\'"]?([^\'"\n]+)[\'"]?/m', $content, $matches);
        foreach ($matches[1] as $match) {
            if (strlen($match) &lt; 100) {
                $translations[$match] = true;
            }
        }
        
        // 提取 title: 字段
        preg_match_all('/^\s*title:\s*[\'"]?([^\'"\n]+)[\'"]?/m', $content, $matches);
        foreach ($matches[1] as $match) {
            if (strlen($match) &lt; 100) {
                $translations[$match] = true;
            }
        }
        
        $configCount++;
    }
}
echo "📄 扫描了 {$configCount} 个配置文件\n";

// 4. 清理和排序
// 移除明显的非翻译内容（路径、代码等）
$cleaned = [];
foreach ($translations as $key =&gt; $value) {
    // 跳过看起来像URL、路径、代码的内容
    if (preg_match('/^\//', $key) || 
        preg_match('/\.php$/', $key) ||
        preg_match('/\.twig$/', $key) ||
        preg_match('/^[a-z0-9_-]+$/', $key) ||
        strlen($key) &gt; 300 ||
        strlen($key) &lt; 2) {
        continue;
    }
    $cleaned[$key] = true;
}
ksort($cleaned);

echo "📊 提取到 " . count($cleaned) . " 个翻译字符串\n";

// 5. 生成PO文件
$poContent = "# Chinese Simplified translation for farmOS\n";
$poContent .= "# Copyright (C) 2024 farmOS Community\n";
$poContent .= "# This file is distributed under the same license as the farmOS package.\n";
$poContent .= "#\n";
$poContent .= "msgid \"\"\n";
$poContent .= "msgstr \"\"\n";
$poContent .= "\"Project-Id-Version: farmOS 4.x\\n\"\n";
$poContent .= "\"Report-Msgid-Bugs-To: \\n\"\n";
$poContent .= "\"POT-Creation-Date: 2024-01-01 00:00+0000\\n\"\n";
$poContent .= "\"PO-Revision-Date: 2024-01-01 00:00+0000\\n\"\n";
$poContent .= "\"Last-Translator: \\n\"\n";
$poContent .= "\"Language-Team: Chinese (Simplified)\\n\"\n";
$poContent .= "\"Language: zh-hans\\n\"\n";
$poContent .= "\"MIME-Version: 1.0\\n\"\n";
$poContent .= "\"Content-Type: text/plain; charset=UTF-8\\n\"\n";
$poContent .= "\"Content-Transfer-Encoding: 8bit\\n\"\n";
$poContent .= "\"Plural-Forms: nplurals=1; plural=0;\\n\"\n";
$poContent .= "\n";

// 6. 自动翻译这些字符串
$translationMap = [
    // 模块和基础功能
    'farm' =&gt; '农场',
    'farmOS' =&gt; 'farmOS',
    'Asset' =&gt; '资产',
    'Assets' =&gt; '资产',
    'Log' =&gt; '日志',
    'Logs' =&gt; '日志',
    'Plan' =&gt; '计划',
    'Plans' =&gt; '计划',
    'Taxonomy' =&gt; '分类',
    'Taxonomy term' =&gt; '分类术语',
    'User' =&gt; '用户',
    'Users' =&gt; '用户',
    
    // 资产类型
    'Animal' =&gt; '动物',
    'Animals' =&gt; '动物',
    'Plant' =&gt; '植物',
    'Plants' =&gt; '植物',
    'Equipment' =&gt; '设备',
    'Land' =&gt; '土地',
    'Structure' =&gt; '建筑',
    'Sensor' =&gt; '传感器',
    'Group' =&gt; '群组',
    'Seed' =&gt; '种子',
    
    // 日志类型
    'Activity' =&gt; '活动',
    'Observation' =&gt; '观察',
    'Harvest' =&gt; '收获',
    'Input' =&gt; '投入',
    'Movement' =&gt; '移动',
    'Seeding' =&gt; '播种',
    'Transplanting' =&gt; '移栽',
    'Birth' =&gt; '出生',
    'Maintenance' =&gt; '维护',
    
    // 通用操作
    'Add' =&gt; '添加',
    'Edit' =&gt; '编辑',
    'Delete' =&gt; '删除',
    'View' =&gt; '查看',
    'Save' =&gt; '保存',
    'Cancel' =&gt; '取消',
    'Submit' =&gt; '提交',
    'Update' =&gt; '更新',
    'Create' =&gt; '创建',
    'Clone' =&gt; '克隆',
    'Archive' =&gt; '归档',
    'Unarchive' =&gt; '取消归档',
    'Publish' =&gt; '发布',
    'Unpublish' =&gt; '取消发布',
    'Reset' =&gt; '重置',
    'Upload' =&gt; '上传',
    'Download' =&gt; '下载',
    'Export' =&gt; '导出',
    'Import' =&gt; '导入',
    'Search' =&gt; '搜索',
    'Filter' =&gt; '筛选',
    'Sort' =&gt; '排序',
    
    // 导航和界面
    'Home' =&gt; '首页',
    'Dashboard' =&gt; '仪表板',
    'Settings' =&gt; '设置',
    'Configuration' =&gt; '配置',
    'Help' =&gt; '帮助',
    'About' =&gt; '关于',
    'Profile' =&gt; '个人资料',
    'Login' =&gt; '登录',
    'Logout' =&gt; '退出',
    'Register' =&gt; '注册',
    
    // 表单字段
    'Name' =&gt; '名称',
    'Description' =&gt; '描述',
    'Date' =&gt; '日期',
    'Time' =&gt; '时间',
    'Location' =&gt; '位置',
    'Quantity' =&gt; '数量',
    'Notes' =&gt; '备注',
    'Files' =&gt; '文件',
    'Images' =&gt; '图片',
    'Status' =&gt; '状态',
    'Type' =&gt; '类型',
    'ID' =&gt; 'ID',
    'Label' =&gt; '标签',
    'Title' =&gt; '标题',
    'Summary' =&gt; '摘要',
    'Notes' =&gt; '备注',
    'Reason' =&gt; '原因',
    'Purpose' =&gt; '目的',
    
    // 状态
    'Active' =&gt; '活动',
    'Archived' =&gt; '已归档',
    'Done' =&gt; '完成',
    'Pending' =&gt; '待处理',
    'Complete' =&gt; '完整',
    'Incomplete' =&gt; '不完整',
    'Published' =&gt; '已发布',
    'Unpublished' =&gt; '未发布',
    
    // 确认和提示
    'Are you sure?' =&gt; '确定吗？',
    'This action cannot be undone.' =&gt; '此操作无法撤销。',
    'Success' =&gt; '成功',
    'Error' =&gt; '错误',
    'Warning' =&gt; '警告',
    'Message' =&gt; '消息',
    'Notification' =&gt; '通知',
    
    // 数据和内容
    'Content' =&gt; '内容',
    'Data' =&gt; '数据',
    'Information' =&gt; '信息',
    'Details' =&gt; '详情',
    'Overview' =&gt; '概览',
    'Report' =&gt; '报告',
    'Reports' =&gt; '报告',
    'Record' =&gt; '记录',
    'Records' =&gt; '记录',
    'List' =&gt; '列表',
    'Table' =&gt; '表格',
    'Map' =&gt; '地图',
    
    // 关系和引用
    'Parent' =&gt; '父项',
    'Child' =&gt; '子项',
    'Children' =&gt; '子项',
    'Group' =&gt; '群组',
    'Groups' =&gt; '群组',
    'Member' =&gt; '成员',
    'Members' =&gt; '成员',
    'Owner' =&gt; '所有者',
    
    // 数量和度量
    'Value' =&gt; '值',
    'Unit' =&gt; '单位',
    'Units' =&gt; '单位',
    'Measure' =&gt; '度量',
    'Weight' =&gt; '重量',
    'Length' =&gt; '长度',
    'Area' =&gt; '面积',
    'Volume' =&gt; '体积',
    'Count' =&gt; '数量',
    'Ratio' =&gt; '比例',
    'Rate' =&gt; '比率',
    'Rating' =&gt; '评分',
    
    // 时间相关
    'Today' =&gt; '今天',
    'Yesterday' =&gt; '昨天',
    'Tomorrow' =&gt; '明天',
    'This week' =&gt; '本周',
    'Last week' =&gt; '上周',
    'This month' =&gt; '本月',
    'Last month' =&gt; '上月',
    'This year' =&gt; '今年',
    'Last year' =&gt; '去年',
    'Date range' =&gt; '日期范围',
    'Start date' =&gt; '开始日期',
    'End date' =&gt; '结束日期',
    'Start time' =&gt; '开始时间',
    'End time' =&gt; '结束时间',
    'Duration' =&gt; '持续时间',
    
    // 植物和种植
    'Crop' =&gt; '作物',
    'Crops' =&gt; '作物',
    'Crop family' =&gt; '作物科',
    'Variety' =&gt; '品种',
    'Varieties' =&gt; '品种',
    'Planting' =&gt; '种植',
    'Seed' =&gt; '种子',
    'Seeds' =&gt; '种子',
    'Harvest' =&gt; '收获',
    'Harvested' =&gt; '已收获',
    'Yield' =&gt; '产量',
    
    // 动物和养殖
    'Livestock' =&gt; '牲畜',
    'Animal type' =&gt; '动物类型',
    'Breed' =&gt; '品种',
    'Breeding' =&gt; '繁殖',
    'Herd' =&gt; '畜群',
    'Flock' =&gt; '禽群',
    'Pasture' =&gt; '牧场',
    'Grazing' =&gt; '放牧',
    'Feed' =&gt; '饲料',
    'Water' =&gt; '水',
    
    // 土地和基础设施
    'Field' =&gt; '田地',
    'Bed' =&gt; '苗床',
    'Greenhouse' =&gt; '温室',
    'Building' =&gt; '建筑',
    'Structure' =&gt; '建筑',
    'Fence' =&gt; '围栏',
    'Road' =&gt; '道路',
    'Waterway' =&gt; '水道',
    'Pond' =&gt; '池塘',
    
    // 设备和工具
    'Tool' =&gt; '工具',
    'Machinery' =&gt; '机械',
    'Implement' =&gt; '农具',
    'Vehicle' =&gt; '车辆',
    'Trailer' =&gt; '拖车',
    'Tractor' =&gt; '拖拉机',
    
    // 传感器和数据
    'Sensor' =&gt; '传感器',
    'Sensor type' =&gt; '传感器类型',
    'Reading' =&gt; '读数',
    'Measurement' =&gt; '测量值',
    'Metric' =&gt; '指标',
    'Value' =&gt; '值',
    'Unit' =&gt; '单位',
    'Timestamp' =&gt; '时间戳',
    'Data stream' =&gt; '数据流',
    
    // 环境和天气
    'Weather' =&gt; '天气',
    'Temperature' =&gt; '温度',
    'Humidity' =&gt; '湿度',
    'Rainfall' =&gt; '降雨量',
    'Precipitation' =&gt; '降水',
    'Wind' =&gt; '风',
    'Soil' =&gt; '土壤',
    'Soil moisture' =&gt; '土壤湿度',
    'Soil temperature' =&gt; '土壤温度',
    'Soil type' =&gt; '土壤类型',
    
    // 任务和计划
    'Task' =&gt; '任务',
    'Tasks' =&gt; '任务',
    'Todo' =&gt; '待办',
    'To-do' =&gt; '待办事项',
    'Due' =&gt; '到期',
    'Due date' =&gt; '到期日期',
    'Reminder' =&gt; '提醒',
    'Notification' =&gt; '通知',
    'Assign' =&gt; '分配',
    'Assigned' =&gt; '已分配',
    'Priority' =&gt; '优先级',
    
    // 管理
    'Admin' =&gt; '管理',
    'Administrator' =&gt; '管理员',
    'Manager' =&gt; '管理者',
    'Worker' =&gt; '工作者',
    'Viewer' =&gt; '查看者',
    'Role' =&gt; '角色',
    'Roles' =&gt; '角色',
    'Permission' =&gt; '权限',
    'Permissions' =&gt; '权限',
    'Access' =&gt; '访问',
    'Allowed' =&gt; '允许',
    'Denied' =&gt; '拒绝',
    
    // API和集成
    'API' =&gt; 'API',
    'REST API' =&gt; 'REST API',
    'OAuth' =&gt; 'OAuth',
    'Consumer' =&gt; '客户端',
    'Client' =&gt; '客户端',
    'Token' =&gt; '令牌',
    'Key' =&gt; '密钥',
    'Secret' =&gt; '密钥',
    'Endpoint' =&gt; '端点',
    'Webhook' =&gt; 'Webhook',
    
    // 快速表单
    'Quick form' =&gt; '快速表单',
    'Quick forms' =&gt; '快速表单',
    'Add asset' =&gt; '添加资产',
    'Add log' =&gt; '添加日志',
    'Record activity' =&gt; '记录活动',
    'Record observation' =&gt; '记录观察',
    'Record harvest' =&gt; '记录收获',
    'Record input' =&gt; '记录投入',
    'Record movement' =&gt; '记录移动',
    'Record seeding' =&gt; '记录播种',
    'Record transplanting' =&gt; '记录移栽',
    'Record birth' =&gt; '记录出生',
    'Record maintenance' =&gt; '记录维护',
    'Make a copy' =&gt; '制作副本',
    'Save and add another' =&gt; '保存并添加另一个',
    'Save and continue' =&gt; '保存并继续',
    'Save and edit' =&gt; '保存并编辑',
    'Save and keep unpublished' =&gt; '保存并不发布',
    'Save and publish' =&gt; '保存并发布',
    'Your changes have been saved.' =&gt; '您的更改已保存。',
    
    // 视图和显示
    'View mode' =&gt; '视图模式',
    'Display' =&gt; '显示',
    'Show' =&gt; '显示',
    'Hide' =&gt; '隐藏',
    'Visibility' =&gt; '可见性',
    'Public' =&gt; '公开',
    'Private' =&gt; '私有',
    
    // 批量操作
    'Select all' =&gt; '全选',
    'Select none' =&gt; '取消全选',
    'With selected' =&gt; '对选中项',
    'Action' =&gt; '操作',
    'Actions' =&gt; '操作',
    'Apply' =&gt; '应用',
    'Apply to selected items' =&gt; '应用到选中项',
    
    // 分页
    'Page' =&gt; '页面',
    'Previous' =&gt; '上一页',
    'Next' =&gt; '下一页',
    'First' =&gt; '第一页',
    'Last' =&gt; '最后一页',
    'Items per page' =&gt; '每页项目数',
    'Showing' =&gt; '显示',
    'of' =&gt; '共',
    'total' =&gt; '总计',
    
    // 验证
    'Required' =&gt; '必填',
    'This field is required.' =&gt; '此字段是必填的。',
    'Invalid value' =&gt; '无效值',
    'The provided value is invalid.' =&gt; '提供的值无效。',
    'Error' =&gt; '错误',
    'Errors' =&gt; '错误',
    'Warning' =&gt; '警告',
    'Success' =&gt; '成功',
    'Success!' =&gt; '成功！',
    
    // 词汇表和分类
    'Animal type' =&gt; '动物类型',
    'Plant type' =&gt; '植物类型',
    'Crop family' =&gt; '作物科',
    'Season' =&gt; '季节',
    'Log category' =&gt; '日志类别',
    'Flag' =&gt; '标志',
    'Flags' =&gt; '标志',
    'Land type' =&gt; '土地类型',
    'Structure type' =&gt; '建筑类型',
    'ID tag type' =&gt; 'ID标签类型',
    'Material type' =&gt; '材料类型',
    
    // 标志和状态
    'Priority' =&gt; '优先级',
    'Monitor' =&gt; '监控',
    'Review' =&gt; '审核',
    'Urgent' =&gt; '紧急',
    'Important' =&gt; '重要',
    'Notice' =&gt; '通知',
    'Alert' =&gt; '警报',
    
    // 模块名称和描述
    'farmOS' =&gt; 'farmOS',
    'farmOS Core' =&gt; 'farmOS 核心',
    'farmOS API' =&gt; 'farmOS API',
    'farmOS Assets' =&gt; 'farmOS 资产',
    'farmOS Logs' =&gt; 'farmOS 日志',
    'farmOS Plans' =&gt; 'farmOS 计划',
    'farmOS Taxonomy' =&gt; 'farmOS 分类',
    'farmOS Location' =&gt; 'farmOS 位置',
    'farmOS Inventory' =&gt; 'farmOS 库存',
    'farmOS Flags' =&gt; 'farmOS 标志',
    'farmOS User Roles' =&gt; 'farmOS 用户角色',
    'farmOS Localization' =&gt; 'farmOS 本地化',
    
    'Farm asset management modules.' =&gt; '农场资产管理模块。',
    'Farm log management modules.' =&gt; '农场日志管理模块。',
    'Farm plan management modules.' =&gt; '农场计划管理模块。',
    'Farm taxonomy modules.' =&gt; '农场分类模块。',
    'Provides asset location features.' =&gt; '提供资产位置功能。',
    'Provides inventory tracking features.' =&gt; '提供库存跟踪功能。',
    'Provides flagging features for records.' =&gt; '为记录提供标志功能。',
    'Provides default user roles for farmOS.' =&gt; '为farmOS提供默认用户角色。',
    'Provides localization features for farmOS.' =&gt; '为farmOS提供本地化功能。',
    
    // 模块说明
    'Animal assets' =&gt; '动物资产',
    'Animal assets for farmOS.' =&gt; 'farmOS的动物资产。',
    'Plant assets' =&gt; '植物资产',
    'Plant assets for farmOS.' =&gt; 'farmOS的植物资产。',
    'Equipment assets' =&gt; '设备资产',
    'Equipment assets for farmOS.' =&gt; 'farmOS的设备资产。',
    'Land assets' =&gt; '土地资产',
    'Land assets for farmOS.' =&gt; 'farmOS的土地资产。',
    'Structure assets' =&gt; '建筑资产',
    'Structure assets for farmOS.' =&gt; 'farmOS的建筑资产。',
    'Sensor assets' =&gt; '传感器资产',
    'Sensor assets for farmOS.' =&gt; 'farmOS的传感器资产。',
    'Group assets' =&gt; '群组资产',
    'Group assets for farmOS.' =&gt; 'farmOS的群组资产。',
    'Seed assets' =&gt; '种子资产',
    'Seed assets for farmOS.' =&gt; 'farmOS的种子资产。',
    
    'Activity logs' =&gt; '活动日志',
    'Activity logs for farmOS.' =&gt; 'farmOS的活动日志。',
    'Observation logs' =&gt; '观察日志',
    'Observation logs for farmOS.' =&gt; 'farmOS的观察日志。',
    'Harvest logs' =&gt; '收获日志',
    'Harvest logs for farmOS.' =&gt; 'farmOS的收获日志。',
    'Input logs' =&gt; '投入日志',
    'Input logs for farmOS.' =&gt; 'farmOS的投入日志。',
    'Movement logs' =&gt; '移动日志',
    'Movement logs for farmOS.' =&gt; 'farmOS的移动日志。',
    'Seeding logs' =&gt; '播种日志',
    'Seeding logs for farmOS.' =&gt; 'farmOS的播种日志。',
    'Transplanting logs' =&gt; '移栽日志',
    'Transplanting logs for farmOS.' =&gt; 'farmOS的移栽日志。',
    'Birth logs' =&gt; '出生日志',
    'Birth logs for farmOS.' =&gt; 'farmOS的出生日志。',
    'Maintenance logs' =&gt; '维护日志',
    'Maintenance logs for farmOS.' =&gt; 'farmOS的维护日志。',
    
    // 用户角色
    'Farm Manager' =&gt; '农场管理者',
    'Farm Worker' =&gt; '农场工作者',
    'Farm Viewer' =&gt; '农场查看者',
    'Full access to all farmOS content and configuration.' =&gt; '完全访问所有farmOS内容和配置。',
    'View all farmOS content and edit records.' =&gt; '查看所有farmOS内容并编辑记录。',
    'View all farmOS content.' =&gt; '查看所有farmOS内容。',
    
    // 常见短语
    'Add assets' =&gt; '添加资产',
    'Add logs' =&gt; '添加日志',
    'Add plans' =&gt; '添加计划',
    'Add a new' =&gt; '添加新的',
    'View all' =&gt; '查看全部',
    'View more' =&gt; '查看更多',
    'Read more' =&gt; '阅读更多',
    'Show all' =&gt; '显示全部',
    'See more' =&gt; '查看更多',
    'See less' =&gt; '查看更少',
    'Learn more' =&gt; '了解更多',
    'Find out more' =&gt; '了解更多',
    'Get started' =&gt; '开始',
    'Welcome' =&gt; '欢迎',
    'Thank you' =&gt; '谢谢',
    'Please wait' =&gt; '请稍候',
    'Loading' =&gt; '加载中',
    'Please wait...' =&gt; '请稍候...',
    'No results found' =&gt; '未找到结果',
    'No results found.' =&gt; '未找到结果。',
    'Nothing to show' =&gt; '没有可显示的内容',
    'None' =&gt; '无',
    'Empty' =&gt; '空',
    'All' =&gt; '全部',
    'Every' =&gt; '每个',
    'Any' =&gt; '任何',
    'Some' =&gt; '一些',
    'Other' =&gt; '其他',
    'Another' =&gt; '另一个',
    'Next' =&gt; '下一个',
    'Previous' =&gt; '上一个',
    'First' =&gt; '第一',
    'Last' =&gt; '最后',
    'Finish' =&gt; '完成',
    'Done' =&gt; '完成',
    'Complete' =&gt; '完整',
    'Incomplete' =&gt; '不完整',
    'Final' =&gt; '最终',
    
    // 确认和警告
    'Confirm' =&gt; '确认',
    'Confirmation' =&gt; '确认',
    'Are you sure you want to delete this?' =&gt; '确定要删除吗？',
    'Are you sure you want to do this?' =&gt; '确定要这样做吗？',
    'This action cannot be undone.' =&gt; '此操作无法撤销。',
    'Please confirm your action.' =&gt; '请确认您的操作。',
    'Warning!' =&gt; '警告！',
    'Attention!' =&gt; '注意！',
    'Important!' =&gt; '重要！',
    'Notice!' =&gt; '注意！',
    'Danger!' =&gt; '危险！',
    
    // 日期和时间
    'Monday' =&gt; '星期一',
    'Tuesday' =&gt; '星期二',
    'Wednesday' =&gt; '星期三',
    'Thursday' =&gt; '星期四',
    'Friday' =&gt; '星期五',
    'Saturday' =&gt; '星期六',
    'Sunday' =&gt; '星期日',
    'January' =&gt; '一月',
    'February' =&gt; '二月',
    'March' =&gt; '三月',
    'April' =&gt; '四月',
    'May' =&gt; '五月',
    'June' =&gt; '六月',
    'July' =&gt; '七月',
    'August' =&gt; '八月',
    'September' =&gt; '九月',
    'October' =&gt; '十月',
    'November' =&gt; '十一月',
    'December' =&gt; '十二月',
    'Year' =&gt; '年',
    'Month' =&gt; '月',
    'Week' =&gt; '周',
    'Day' =&gt; '天',
    'Hour' =&gt; '小时',
    'Minute' =&gt; '分钟',
    'Second' =&gt; '秒',
    'Today' =&gt; '今天',
    'Yesterday' =&gt; '昨天',
    'Tomorrow' =&gt; '明天',
    
    // 位置相关
    'Move' =&gt; '移动',
    'Location' =&gt; '位置',
    'Current location' =&gt; '当前位置',
    'Previous location' =&gt; '之前位置',
    'New location' =&gt; '新位置',
    'Fixed' =&gt; '固定',
    'Movable' =&gt; '可移动',
    'Geometry' =&gt; '几何',
    'Shape' =&gt; '形状',
    'Area' =&gt; '面积',
    'Distance' =&gt; '距离',
    'Latitude' =&gt; '纬度',
    'Longitude' =&gt; '经度',
    'Coordinates' =&gt; '坐标',
    'Map' =&gt; '地图',
    'Zoom' =&gt; '缩放',
    'Zoom in' =&gt; '放大',
    'Zoom out' =&gt; '缩小',
    'Pan' =&gt; '平移',
    'Center' =&gt; '居中',
    
    // 库存相关
    'Inventory' =&gt; '库存',
    'Inventory level' =&gt; '库存水平',
    'Stock' =&gt; '库存',
    'In stock' =&gt; '有库存',
    'Out of stock' =&gt; '缺货',
    'Quantity' =&gt; '数量',
    'Increase' =&gt; '增加',
    'Decrease' =&gt; '减少',
    'Adjust' =&gt; '调整',
    'Adjustment' =&gt; '调整',
    'Current' =&gt; '当前',
    'Previous' =&gt; '之前',
    'New' =&gt; '新',
    'Old' =&gt; '旧',
    
    // 文件和媒体
    'File' =&gt; '文件',
    'Files' =&gt; '文件',
    'Image' =&gt; '图片',
    'Images' =&gt; '图片',
    'Photo' =&gt; '照片',
    'Photos' =&gt; '照片',
    'Video' =&gt; '视频',
    'Videos' =&gt; '视频',
    'Document' =&gt; '文档',
    'Documents' =&gt; '文档',
    'Upload' =&gt; '上传',
    'Download' =&gt; '下载',
    'File name' =&gt; '文件名',
    'File size' =&gt; '文件大小',
    'File type' =&gt; '文件类型',
    'Image style' =&gt; '图片样式',
    'Thumbnail' =&gt; '缩略图',
    'Preview' =&gt; '预览',
    
    // 界面按钮和链接
    'Submit' =&gt; '提交',
    'Apply' =&gt; '应用',
    'Save' =&gt; '保存',
    'Update' =&gt; '更新',
    'Cancel' =&gt; '取消',
    'Close' =&gt; '关闭',
    'Continue' =&gt; '继续',
    'Back' =&gt; '返回',
    'Return' =&gt; '返回',
    'Go back' =&gt; '返回',
    'Go to' =&gt; '前往',
    'Goto' =&gt; '前往',
    'Link' =&gt; '链接',
    'URL' =&gt; 'URL',
    'Link text' =&gt; '链接文本',
    
    // 标签和标志
    'Tag' =&gt; '标签',
    'Tags' =&gt; '标签',
    'Flag' =&gt; '标志',
    'Flags' =&gt; '标志',
    'Category' =&gt; '类别',
    'Categories' =&gt; '类别',
    'Group' =&gt; '群组',
    'Groups' =&gt; '群组',
    'Class' =&gt; '类',
    'Classes' =&gt; '类',
    'Type' =&gt; '类型',
    'Types' =&gt; '类型',
    'Kind' =&gt; '种类',
    'Kinds' =&gt; '种类',
    
    // 表单字段
    'Label' =&gt; '标签',
    'Title' =&gt; '标题',
    'Name' =&gt; '名称',
    'Description' =&gt; '描述',
    'Summary' =&gt; '摘要',
    'Body' =&gt; '正文',
    'Content' =&gt; '内容',
    'Notes' =&gt; '备注',
    'Comment' =&gt; '评论',
    'Comments' =&gt; '评论',
    'Message' =&gt; '消息',
    'Messages' =&gt; '消息',
    'Email' =&gt; '电子邮件',
    'Phone' =&gt; '电话',
    'Address' =&gt; '地址',
    'Website' =&gt; '网站',
    'URL' =&gt; 'URL',
    
    // 状态
    'Active' =&gt; '活动',
    'Inactive' =&gt; '不活动',
    'Enabled' =&gt; '已启用',
    'Disabled' =&gt; '已禁用',
    'Available' =&gt; '可用',
    'Unavailable' =&gt; '不可用',
    'Locked' =&gt; '已锁定',
    'Unlocked' =&gt; '已解锁',
    'Published' =&gt; '已发布',
    'Unpublished' =&gt; '未发布',
    'Deleted' =&gt; '已删除',
    'Archived' =&gt; '已归档',
    'Unarchived' =&gt; '未归档',
    
    // 导入和导出
    'Import' =&gt; '导入',
    'Export' =&gt; '导出',
    'Upload' =&gt; '上传',
    'Download' =&gt; '下载',
    'Batch' =&gt; '批量',
    'Bulk' =&gt; '批量',
    'File format' =&gt; '文件格式',
    'CSV' =&gt; 'CSV',
    'JSON' =&gt; 'JSON',
    'XML' =&gt; 'XML',
    'File uploaded successfully.' =&gt; '文件上传成功。',
    'Import failed.' =&gt; '导入失败。',
    'Export failed.' =&gt; '导出失败。',
    'Import complete.' =&gt; '导入完成。',
    'Export complete.' =&gt; '导出完成。',
    
    // 搜索和过滤
    'Search' =&gt; '搜索',
    'Search for' =&gt; '搜索',
    'Filter' =&gt; '筛选',
    'Filter by' =&gt; '按...筛选',
    'Sort' =&gt; '排序',
    'Sort by' =&gt; '按...排序',
    'Ascending' =&gt; '升序',
    'Descending' =&gt; '降序',
    'Results' =&gt; '结果',
    'No results' =&gt; '无结果',
    'Showing results' =&gt; '显示结果',
    
    // 数量和度量
    'Count' =&gt; '数量',
    'Total' =&gt; '总计',
    'Sum' =&gt; '合计',
    'Average' =&gt; '平均',
    'Min' =&gt; '最小',
    'Max' =&gt; '最大',
    'Minimum' =&gt; '最小值',
    'Maximum' =&gt; '最大值',
    'Value' =&gt; '值',
    'Unit' =&gt; '单位',
    'Units' =&gt; '单位',
    'Measure' =&gt; '度量',
    'Quantity' =&gt; '数量',
    'Amount' =&gt; '金额',
    
    // 配置和设置
    'Settings' =&gt; '设置',
    'Configuration' =&gt; '配置',
    'Options' =&gt; '选项',
    'Preferences' =&gt; '偏好',
    'Default' =&gt; '默认',
    'Custom' =&gt; '自定义',
    'Default value' =&gt; '默认值',
    'Default setting' =&gt; '默认设置',
    
    // 帮助和文档
    'Help' =&gt; '帮助',
    'Documentation' =&gt; '文档',
    'Guide' =&gt; '指南',
    'Tutorial' =&gt; '教程',
    'FAQ' =&gt; '常见问题',
    'Support' =&gt; '支持',
    'Contact' =&gt; '联系',
    'About' =&gt; '关于',
    
    // 用户和账户
    'User' =&gt; '用户',
    'Users' =&gt; '用户',
    'Account' =&gt; '账户',
    'Profile' =&gt; '个人资料',
    'Username' =&gt; '用户名',
    'Password' =&gt; '密码',
    'Email' =&gt; '电子邮件',
    'Login' =&gt; '登录',
    'Logout' =&gt; '退出',
    'Register' =&gt; '注册',
    'Forgot password?' =&gt; '忘记密码？',
    'Change password' =&gt; '更改密码',
    
    // 权限和角色
    'Role' =&gt; '角色',
    'Roles' =&gt; '角色',
    'Permission' =&gt; '权限',
    'Permissions' =&gt; '权限',
    'Access' =&gt; '访问',
    'Access denied' =&gt; '访问被拒绝',
    'You are not authorized to access this page.' =&gt; '您没有权限访问此页面。',
    'Access allowed' =&gt; '访问允许',
    'Grant' =&gt; '授予',
    'Revoke' =&gt; '撤销',
    
    // 模块和功能
    'Module' =&gt; '模块',
    'Modules' =&gt; '模块',
    'Feature' =&gt; '功能',
    'Features' =&gt; '功能',
    'Enable' =&gt; '启用',
    'Disable' =&gt; '禁用',
    'Install' =&gt; '安装',
    'Uninstall' =&gt; '卸载',
    'Update' =&gt; '更新',
    
    // 本地化
    'Language' =&gt; '语言',
    'Translation' =&gt; '翻译',
    'Translate' =&gt; '翻译',
    'Localize' =&gt; '本地化',
    'Localization' =&gt; '本地化',
    'Date format' =&gt; '日期格式',
    'Time zone' =&gt; '时区',
    'Currency' =&gt; '货币',
    'Number format' =&gt; '数字格式',
    
    // 界面元素
    'Header' =&gt; '页眉',
    'Footer' =&gt; '页脚',
    'Sidebar' =&gt; '侧边栏',
    'Menu' =&gt; '菜单',
    'Navigation' =&gt; '导航',
    'Breadcrumb' =&gt; '面包屑导航',
    'Tab' =&gt; '选项卡',
    'Tabs' =&gt; '选项卡',
    'Modal' =&gt; '弹窗',
    'Dialog' =&gt; '对话框',
    'Popup' =&gt; '弹窗',
    'Tooltip' =&gt; '提示',
    
    // 操作反馈
    'Success' =&gt; '成功',
    'Successfully done.' =&gt; '成功完成。',
    'Completed successfully.' =&gt; '成功完成。',
    'Error' =&gt; '错误',
    'An error occurred.' =&gt; '发生错误。',
    'Warning' =&gt; '警告',
    'Notice' =&gt; '注意',
    'Message' =&gt; '消息',
    'Info' =&gt; '信息',
    'Status' =&gt; '状态',
    
    // 更多短语
    'Back to top' =&gt; '回到顶部',
    'Scroll to top' =&gt; '滚动到顶部',
    'More' =&gt; '更多',
    'Less' =&gt; '更少',
    'See all' =&gt; '查看全部',
    'View all' =&gt; '查看全部',
    'Show all' =&gt; '显示全部',
    'Hide all' =&gt; '隐藏全部',
    'Expand all' =&gt; '展开全部',
    'Collapse all' =&gt; '折叠全部',
    'Print' =&gt; '打印',
    'Share' =&gt; '分享',
    'Like' =&gt; '喜欢',
    'Dislike' =&gt; '不喜欢',
    
    // 计划相关
    'Plan' =&gt; '计划',
    'Plans' =&gt; '计划',
    'Planning' =&gt; '规划',
    'Schedule' =&gt; '日程',
    'Scheduled' =&gt; '已安排',
    'Timeline' =&gt; '时间线',
    'Calendar' =&gt; '日历',
    'Event' =&gt; '事件',
    'Events' =&gt; '事件',
    'Task' =&gt; '任务',
    'Tasks' =&gt; '任务',
    
    // 记录相关
    'Record' =&gt; '记录',
    'Records' =&gt; '记录',
    'Entry' =&gt; '条目',
    'Entries' =&gt; '条目',
    'Entry log' =&gt; '记录日志',
    'Add entry' =&gt; '添加条目',
    'Edit entry' =&gt; '编辑条目',
    'Delete entry' =&gt; '删除条目',
    
    // 观察和监测
    'Observe' =&gt; '观察',
    'Observation' =&gt; '观察',
    'Observations' =&gt; '观察',
    'Monitor' =&gt; '监控',
    'Monitoring' =&gt; '监控',
    'Sensor' =&gt; '传感器',
    'Reading' =&gt; '读数',
    'Data point' =&gt; '数据点',
    
    // 土壤和种植
    'Soil' =&gt; '土壤',
    'Soil type' =&gt; '土壤类型',
    'Soil amendment' =&gt; '土壤改良',
    'Soil test' =&gt; '土壤测试',
    'Soil health' =&gt; '土壤健康',
    'Soil fertility' =&gt; '土壤肥力',
    'Soil moisture' =&gt; '土壤湿度',
    'Soil temperature' =&gt; '土壤温度',
    'Soil pH' =&gt; '土壤pH值',
    'Tillage' =&gt; '耕作',
    'Cultivation' =&gt; '栽培',
    
    // 投入和材料
    'Input' =&gt; '投入',
    'Inputs' =&gt; '投入',
    'Material' =&gt; '材料',
    'Materials' =&gt; '材料',
    'Supply' =&gt; '供应',
    'Supplies' =&gt; '供应',
    'Fertilizer' =&gt; '肥料',
    'Pesticide' =&gt; '农药',
    'Herbicide' =&gt; '除草剂',
    'Insecticide' =&gt; '杀虫剂',
    'Fungicide' =&gt; '杀菌剂',
    'Organic' =&gt; '有机',
    'Synthetic' =&gt; '合成',
    
    // 灌溉和水
    'Irrigation' =&gt; '灌溉',
    'Water' =&gt; '水',
    'Watering' =&gt; '浇水',
    'Water source' =&gt; '水源',
    'Water use' =&gt; '水使用',
    'Water level' =&gt; '水位',
    'Rainfall' =&gt; '降雨量',
    'Precipitation' =&gt; '降水',
    
    // 天气和气候
    'Weather' =&gt; '天气',
    'Weather forecast' =&gt; '天气预报',
    'Temperature' =&gt; '温度',
    'Humidity' =&gt; '湿度',
    'Wind' =&gt; '风',
    'Wind speed' =&gt; '风速',
    'Wind direction' =&gt; '风向',
    'Pressure' =&gt; '气压',
    'Solar radiation' =&gt; '太阳辐射',
    'Dew point' =&gt; '露点',
    'Evapotranspiration' =&gt; '蒸散',
    
    // 植物健康
    'Plant health' =&gt; '植物健康',
    'Pest' =&gt; '害虫',
    'Pests' =&gt; '害虫',
    'Disease' =&gt; '病害',
    'Diseases' =&gt; '病害',
    'Weed' =&gt; '杂草',
    'Weeds' =&gt; '杂草',
    'Nutrient' =&gt; '养分',
    'Nutrients' =&gt; '养分',
    'Nutrient deficiency' =&gt; '养分缺乏',
    'Nutrient toxicity' =&gt; '养分毒性',
    
    // 动物健康
    'Animal health' =&gt; '动物健康',
    'Veterinary' =&gt; '兽医',
    'Vaccination' =&gt; '疫苗接种',
    'Treatment' =&gt; '治疗',
    'Medication' =&gt; '药物',
    'Symptom' =&gt; '症状',
    'Diagnosis' =&gt; '诊断',
    'Health check' =&gt; '健康检查',
    
    // 收获和产量
    'Harvest' =&gt; '收获',
    'Harvesting' =&gt; '收获',
    'Harvest date' =&gt; '收获日期',
    'Yield' =&gt; '产量',
    'Yield estimate' =&gt; '产量估计',
    'Actual yield' =&gt; '实际产量',
    'Projected yield' =&gt; '预计产量',
    
    // 质量和标准
    'Quality' =&gt; '质量',
    'Grade' =&gt; '等级',
    'Standard' =&gt; '标准',
    'Compliance' =&gt; '合规',
    'Inspection' =&gt; '检查',
    'Testing' =&gt; '测试',
    'Test' =&gt; '测试',
    'Analysis' =&gt; '分析',
    'Sample' =&gt; '样品',
    'Sampling' =&gt; '采样',
    
    // 报告和文档
    'Report' =&gt; '报告',
    'Reports' =&gt; '报告',
    'Documentation' =&gt; '文档',
    'Record keeping' =&gt; '记录保存',
    'Bookkeeping' =&gt; '记账',
    'Audit' =&gt; '审计',
    'Traceability' =&gt; '可追溯性',
    'Chain of custody' =&gt; '监管链',
    
    // 设备和维护
    'Equipment' =&gt; '设备',
    'Machinery' =&gt; '机械',
    'Tool' =&gt; '工具',
    'Tools' =&gt; '工具',
    'Maintenance' =&gt; '维护',
    'Service' =&gt; '服务',
    'Repair' =&gt; '维修',
    'Repairs' =&gt; '维修',
    'Fuel' =&gt; '燃料',
    'Fuel use' =&gt; '燃料使用',
    'Cost' =&gt; '成本',
    'Costs' =&gt; '成本',
    'Expense' =&gt; '费用',
    'Expenses' =&gt; '费用',
    
    // 财务和业务
    'Finance' =&gt; '财务',
    'Financial' =&gt; '财务的',
    'Budget' =&gt; '预算',
    'Budgeting' =&gt; '预算编制',
    'Cost' =&gt; '成本',
    'Price' =&gt; '价格',
    'Pricing' =&gt; '定价',
    'Value' =&gt; '价值',
    'Valuation' =&gt; '估值',
    'Sales' =&gt; '销售',
    'Sale' =&gt; '销售',
    'Purchase' =&gt; '采购',
    'Purchases' =&gt; '采购',
    'Inventory' =&gt; '库存',
    'Stock' =&gt; '库存',
    
    // 土地和资源
    'Land' =&gt; '土地',
    'Soil' =&gt; '土壤',
    'Water' =&gt; '水',
    'Air' =&gt; '空气',
    'Energy' =&gt; '能源',
    'Resources' =&gt; '资源',
    'Conservation' =&gt; '保护',
    'Sustainability' =&gt; '可持续性',
    'Ecology' =&gt; '生态',
    'Ecosystem' =&gt; '生态系统',
    'Biodiversity' =&gt; '生物多样性',
    
    // 区域和地点
    'Farm' =&gt; '农场',
    'Field' =&gt; '田地',
    'Field' =&gt; '田地',
    'Fields' =&gt; '田地',
    'Bed' =&gt; '苗床',
    'Beds' =&gt; '苗床',
    'Plot' =&gt; '地块',
    'Plots' =&gt; '地块',
    'Area' =&gt; '区域',
    'Zone' =&gt; '地带',
    'Zones' =&gt; '地带',
    'Block' =&gt; '区块',
    'Blocks' =&gt; '区块',
    'Section' =&gt; '部分',
    'Sections' =&gt; '部分',
    
    // 结构和建筑
    'Building' =&gt; '建筑',
    'Buildings' =&gt; '建筑',
    'Structure' =&gt; '建筑',
    'Structures' =&gt; '建筑',
    'Greenhouse' =&gt; '温室',
    'Hoop house' =&gt; '塑料大棚',
    'Barn' =&gt; '谷仓',
    'Shed' =&gt; '棚屋',
    'Silos' =&gt; '筒仓',
    'Tank' =&gt; '储槽',
    'Tanks' =&gt; '储槽',
    
    // 围栏和边界
    'Fence' =&gt; '围栏',
    'Fencing' =&gt; '围栏',
    'Gate' =&gt; '门',
    'Gates' =&gt; '门',
    'Boundary' =&gt; '边界',
    'Boundaries' =&gt; '边界',
    'Perimeter' =&gt; '周长',
    'Edge' =&gt; '边缘',
    
    // 道路和路径
    'Road' =&gt; '道路',
    'Roads' =&gt; '道路',
    'Path' =&gt; '路径',
    'Paths' =&gt; '路径',
    'Lane' =&gt; '车道',
    'Driveway' =&gt; '车道',
    'Trail' =&gt; '步道',
    'Access' =&gt; '通道',
    
    // 水源和灌溉
    'Well' =&gt; '井',
    'Pond' =&gt; '池塘',
    'Lake' =&gt; '湖泊',
    'River' =&gt; '河流',
    'Creek' =&gt; '小溪',
    'Stream' =&gt; '溪流',
    'Canal' =&gt; '运河',
    'Ditch' =&gt; '沟渠',
    'Irrigation' =&gt; '灌溉',
    'Sprinkler' =&gt; '喷灌',
    'Drip' =&gt; '滴灌',
    'Flood' =&gt; '漫灌',
    
    // 地图和地理
    'Map' =&gt; '地图',
    'GIS' =&gt; 'GIS',
    'Geographic' =&gt; '地理',
    'Geospatial' =&gt; '地理空间',
    'Latitude' =&gt; '纬度',
    'Longitude' =&gt; '经度',
    'Coordinates' =&gt; '坐标',
    'GPS' =&gt; 'GPS',
    'Track' =&gt; '轨迹',
    'Trace' =&gt; '追踪',
    'Layer' =&gt; '图层',
    'Overlay' =&gt; '叠加层',
    
    // 技术和软件
    'Software' =&gt; '软件',
    'Hardware' =&gt; '硬件',
    'Device' =&gt; '设备',
    'Devices' =&gt; '设备',
    'Sensor' =&gt; '传感器',
    'Internet' =&gt; '互联网',
    'Online' =&gt; '在线',
    'Offline' =&gt; '离线',
    'Cloud' =&gt; '云',
    'Server' =&gt; '服务器',
    'Backup' =&gt; '备份',
    'Restore' =&gt; '恢复',
    
    // API和集成
    'API' =&gt; 'API',
    'Application Programming Interface' =&gt; '应用程序编程接口',
    'Integration' =&gt; '集成',
    'Integrations' =&gt; '集成',
    'Webhook' =&gt; 'Webhook',
    'Endpoints' =&gt; '端点',
    'Authentication' =&gt; '认证',
    'Authorization' =&gt; '授权',
    'Token' =&gt; '令牌',
    'Key' =&gt; '密钥',
    'Secret' =&gt; '密钥',
    
    // 开发和技术
    'Development' =&gt; '开发',
    'Developer' =&gt; '开发者',
    'Code' =&gt; '代码',
    'Open source' =&gt; '开源',
    'Community' =&gt; '社区',
    'Contribute' =&gt; '贡献',
    'Contribution' =&gt; '贡献',
    'Issue' =&gt; '问题',
    'Bug' =&gt; '错误',
    'Feature request' =&gt; '功能请求',
    'Pull request' =&gt; '拉取请求',
    
    // 社区和支持
    'Community' =&gt; '社区',
    'Forum' =&gt; '论坛',
    'Discussion' =&gt; '讨论',
    'Chat' =&gt; '聊天',
    'Support' =&gt; '支持',
    'Help' =&gt; '帮助',
    'Documentation' =&gt; '文档',
    'Guide' =&gt; '指南',
    'Tutorial' =&gt; '教程',
    'FAQ' =&gt; '常见问题',
    
    // 最后一些常见词汇
    'Welcome to farmOS' =&gt; '欢迎使用farmOS',
    'Farm management made easy.' =&gt; '农场管理变得简单。',
    'Start farming smarter.' =&gt; '开始更智能地耕作。',
    'Record your first activity.' =&gt; '记录您的第一次活动。',
    'Add your first asset.' =&gt; '添加您的第一个资产。',
    'Get started today!' =&gt; '立即开始！',
];

// 翻译所有字符串
$translatedCount = 0;
$untranslatedCount = 0;

foreach ($cleaned as $msgid =&gt; $_) {
    // 先尝试完全匹配
    if (isset($translationMap[$msgid])) {
        $msgstr = $translationMap[$msgid];
        $translatedCount++;
    } 
    // 再尝试大小写不敏感的匹配
    else {
        $found = false;
        foreach ($translationMap as $key =&gt; $value) {
            if (strcasecmp($key, $msgid) === 0) {
                $msgstr = $value;
                $found = true;
                $translatedCount++;
                break;
            }
        }
        
        // 如果没找到，留空
        if (!$found) {
            $msgstr = '';
            $untranslatedCount++;
        }
    }
    
    // 转义特殊字符
    $msgidEscaped = addslashes($msgid);
    $msgstrEscaped = addslashes($msgstr);
    
    $poContent .= "msgid \"{$msgidEscaped}\"\n";
    $poContent .= "msgstr \"{$msgstrEscaped}\"\n";
    $poContent .= "\n";
}

// 保存PO文件
$poFile = __DIR__ . '/farmOS-full.zh-hans.po';
file_put_contents($poFile, $poContent);

echo "\n✅ 完整翻译文件已保存到: {$poFile}\n";
echo "📊 翻译统计: {$translatedCount} 已翻译, {$untranslatedCount} 未翻译\n";
echo "📊 总共: " . count($cleaned) . " 个字符串\n";

// 同时更新模块的翻译文件
$modulePoFile = __DIR__ . '/../modules/core/l10n/translations/farm_l10n.zh-hans.po';
file_put_contents($modulePoFile, $poContent);
echo "✅ 模块翻译文件已更新: {$modulePoFile}\n";

