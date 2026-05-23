# farmOS 中文语言包安装指南

## 概述

本翻译包为 farmOS 提供完整的中文（简体）界面翻译。

## 包含内容

1. **核心翻译文件** (`farmOS.zh-hans.po`)
   - farmOS 模块的主要界面文本翻译
   - Drupal 核心和常用模块的翻译

2. **完整翻译文件** (`farmOS.comprehensive.zh-hans.po`)
   - 超过 2000+ 条翻译字符串
   - 涵盖农业、畜牧业、种植业等专用术语
   - 包括所有菜单、表单、按钮、提示信息等

## 自动安装（推荐）

当您安装 farmOS 并启用 `farm_l10n` 模块时，系统会自动：

1. 检测并添加中文（简体）语言
2. 将中文设置为默认界面语言
3. 覆盖所有配置项的中文标签

## 手动导入翻译

### 方法一：使用 Drupal 管理界面

1. 登录 Drupal 管理后台
2. 进入 **管理 > 配置 > 区域和语言 > 翻译界面**
   (Administration > Configuration > Regional and Language > Translate Interface)
3. 点击 **导入** 标签
4. 在"翻译文件"部分：
   - 选择语言：**Chinese, Simplified (简体中文)**
   - 编码：选择 **UTF-8**
   - 点击 **选择文件**，选择 `farmOS.comprehensive.zh-hans.po`
5. 点击 **导入** 按钮

### 方法二：使用 Drush 命令行

```bash
# 导入翻译文件
drush locale-import zh-hans translations/farmOS.comprehensive.zh-hans.po

# 或者导入所有翻译文件
drush locale-import zh-hans translations/

# 清除缓存
drush cache-rebuild
```

### 方法三：使用 Drupal Console

```bash
# 导入翻译
drupal locale:import zh-hans translations/farmOS.comprehensive.zh-hans.po --type=customized

# 清除缓存
drupal cache:clear
```

## 手动安装翻译文件

### 步骤 1：将翻译文件复制到正确位置

```bash
# Drupal 7
cp translations/*.po sites/all/translations/

# Drupal 8/9/10/11
# 对于 contrib 模块的翻译，放在 modules 目录下
cp translations/*.po modules/

# 对于自定义翻译，放在 sites/default/files/translations/ 目录
cp translations/*.po sites/default/files/translations/
```

### 步骤 2：设置文件权限

```bash
chmod 644 translations/*.po
```

### 步骤 3：清除缓存

```bash
drush cache-rebuild
# 或
drupal cache:clear
```

## 配置默认语言为中文

### 通过管理界面

1. 进入 **管理 > 配置 > 区域和语言 > 语言**
   (Administration > Configuration > Regional and Language > Languages)
2. 确保 **简体中文** 已启用
3. 将 **简体中文** 拖动到最顶部作为默认值

### 通过配置文件

编辑 `sites/default/settings.php`：

```php
$config['language.negotiation']['selected_langcode'] = 'zh-hans';
$config['language.defaults']['langcode'] = 'zh-hans';
```

## 验证翻译是否生效

### 方法一：检查管理界面

1. 登录 Drupal 管理后台
2. 检查顶部菜单、侧边栏是否显示中文
3. 尝试访问不同页面，检查翻译是否完整

### 方法二：使用 Drush

```bash
# 查看已安装的语言
drush language:status

# 查看翻译状态
drush locale:status zh-hans
```

## 翻译文件格式说明

farmOS 使用 GNU gettext `.po` 文件格式。每个翻译条目格式如下：

```po
msgid "English text"
msgstr "中文翻译"
```

## 扩展翻译

如果您发现某些文本未翻译或翻译不正确，可以：

1. 编辑 `.po` 文件添加或修改翻译
2. 重新导入翻译文件
3. 或者使用 Drupal 管理界面的在线翻译功能

## 常见问题

### Q: 为什么某些页面还是英文？

A: 可能的原因：
- 该模块的翻译文件未导入
- 某些字符串使用了动态内容，无法翻译
- 浏览器缓存未清除

解决方法：
```bash
drush cache-rebuild
```

### Q: 如何翻译自定义模块？

A: 在您的自定义模块中创建 `translations` 目录：

```
custom_module/
  translations/
    zh-hans.po
```

然后在模块的 `.info.yml` 文件中添加：

```yaml
dependencies:
  - locale
```

### Q: 如何批量更新翻译？

A: 使用自动化工具如 `poedit` 或 ` lokalise.co` 进行批量翻译。

## 技术支持

- GitHub Issues: https://github.com/farmOS/farmOS/issues
- 中文社区论坛: https://forum.farmos.org/c/chinese/8

## 许可证

本翻译包遵循 farmOS 相同的开源许可证（GPL-2.0+）。

## 更新日志

### Version 4.x-1.0
- 初始版本
- 支持简体中文
- 包含 farmOS 核心模块翻译
- 包含所有内置资产类型翻译
- 包含所有内置日志类型翻译
- 包含常用农业术语翻译
