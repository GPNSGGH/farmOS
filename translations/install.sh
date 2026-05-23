#!/bin/bash
# farmOS 中文翻译包自动安装脚本

set -e

echo "=========================================="
echo "farmOS 中文翻译包安装脚本"
echo "=========================================="
echo ""

# 检查是否以 root 运行
if [ "$EUID" -ne 0 ]; then 
    echo "警告: 建议使用 root 权限运行此脚本以确保正确的文件权限"
    echo ""
fi

# 检查 Drupal 根目录
DRUPAL_ROOT="${1:-.}"

if [ ! -d "$DRUPAL_ROOT" ]; then
    echo "错误: Drupal 根目录不存在: $DRUPAL_ROOT"
    exit 1
fi

echo "Drupal 根目录: $DRUPAL_ROOT"
echo ""

# 创建翻译目录
TRANSLATIONS_DIR="$DRUPAL_ROOT/translations"
if [ ! -d "$TRANSLATIONS_DIR" ]; then
    mkdir -p "$TRANSLATIONS_DIR"
    echo "✓ 创建翻译目录: $TRANSLATIONS_DIR"
else
    echo "✓ 翻译目录已存在: $TRANSLATIONS_DIR"
fi

# 复制翻译文件
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
if [ -f "$SCRIPT_DIR/farmOS.comprehensive.zh-hans.po" ]; then
    cp "$SCRIPT_DIR/farmOS.comprehensive.zh-hans.po" "$TRANSLATIONS_DIR/"
    echo "✓ 复制完整翻译文件到 translations 目录"
else
    echo "✗ 错误: 找不到翻译文件"
    exit 1
fi

if [ -f "$SCRIPT_DIR/farmOS.zh-hans.po" ]; then
    cp "$SCRIPT_DIR/farmOS.zh-hans.po" "$TRANSLATIONS_DIR/"
    echo "✓ 复制核心翻译文件到 translations 目录"
fi

# 设置文件权限
chmod 644 "$TRANSLATIONS_DIR"/*.po
echo "✓ 设置文件权限"

# 清除 Drupal 缓存
echo ""
echo "正在清除 Drupal 缓存..."

cd "$DRUPAL_ROOT"

# 检测是否有 drush
if command -v drush &> /dev/null; then
    echo "使用 Drush 清除缓存..."
    drush cache-rebuild
elif [ -f "$DRUPAL_ROOT/vendor/bin/drush" ]; then
    echo "使用项目中的 Drush 清除缓存..."
    php "$DRUPAL_ROOT/vendor/bin/drush" cache-rebuild
elif command -v vendor/bin/drush &> /dev/null; then
    echo "使用项目中的 Drush 清除缓存..."
    vendor/bin/drush cache-rebuild
else
    echo "警告: 未找到 Drush，请手动清除缓存"
    echo "运行: cd $DRUPAL_ROOT && php core/scripts/drupal cache-rebuild"
fi

echo ""
echo "=========================================="
echo "✓ 安装完成！"
echo "=========================================="
echo ""
echo "后续步骤:"
echo "1. 登录 Drupal 管理后台"
echo "2. 进入 管理 > 配置 > 区域和语言 > 语言"
echo "3. 确认 '简体中文' 已启用"
echo "4. 将 '简体中文' 设置为默认语言"
echo "5. 进入 管理 > 配置 > 区域和语言 > 翻译界面"
echo "6. 点击 '导入' 标签"
echo "7. 选择 '简体中文' 语言"
echo "8. 上传 farmOS.comprehensive.zh-hans.po 文件"
echo "9. 点击 '导入' 按钮"
echo ""
echo "或者使用 Drush 命令:"
echo "  drush locale-import zh-hans $TRANSLATIONS_DIR/farmOS.comprehensive.zh-hans.po"
echo "  drush cache-rebuild"
echo ""
