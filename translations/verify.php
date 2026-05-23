#!/usr/bin/env php
<?php
/**
 * farmOS 中文翻译验证脚本
 */

echo "🔍 正在验证 farmOS 中文翻译文件...\n\n";

$translationsDir = __DIR__;
$moduleTranslations = $translationsDir . '/../modules/core/l10n/translations/farm_l10n.zh-hans.po';
$comprehensiveTranslations = $translationsDir . '/farmOS.comprehensive.zh-hans.po';

$checks = [];

// 1. 检查文件是否存在
$checks['模块翻译文件存在'] = file_exists($moduleTranslations);
$checks['完整翻译文件存在'] = file_exists($comprehensiveTranslations);

// 2. 检查文件大小
if ($checks['模块翻译文件存在']) {
    $moduleSize = filesize($moduleTranslations);
    $checks['模块翻译文件非空'] = $moduleSize > 0;
    echo "📄 模块翻译文件大小: " . round($moduleSize / 1024, 2) . " KB\n";
}

if ($checks['完整翻译文件存在']) {
    $compSize = filesize($comprehensiveTranslations);
    $checks['完整翻译文件非空'] = $compSize > 0;
    echo "📄 完整翻译文件大小: " . round($compSize / 1024, 2) . " KB\n";
}

// 3. 简单统计翻译条目
$count = 0;
if ($checks['模块翻译文件存在']) {
    $content = file_get_contents($moduleTranslations);
    $count = preg_match_all('/msgid\s+"/', $content);
    echo "📊 模块翻译文件包含约 {$count} 条翻译\n";
}

$compCount = 0;
if ($checks['完整翻译文件存在']) {
    $content = file_get_contents($comprehensiveTranslations);
    $compCount = preg_match_all('/msgid\s+"/', $content);
    echo "📊 完整翻译文件包含约 {$compCount} 条翻译\n";
}

echo "\n✅ 检查结果:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

$allPassed = true;
foreach ($checks as $name => $passed) {
    $status = $passed ? '✅' : '❌';
    echo "{$status} {$name}\n";
    if (!$passed) {
        $allPassed = false;
    }
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

if ($allPassed) {
    echo "\n🎉 farmOS 中文翻译文件验证通过！\n";
    echo "翻译已准备就绪，可用于安装。\n";
    exit(0);
} else {
    echo "\n⚠️ 部分检查未通过，请检查文件。\n";
    exit(1);
}

