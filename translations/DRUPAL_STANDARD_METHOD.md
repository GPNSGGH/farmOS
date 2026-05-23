# Drupal标准翻译方案 - farmOS中文实现

## 为什么用Drupal标准方案？

### 问题诊断

之前的方法直接修改`.info.yml`和硬编码，虽然能工作，但：
❌ 不是Drupal标准方式
❌ 无法使用翻译系统管理
❌ 无法在多语言间切换
❌ 更新维护困难

### Drupal标准翻译方案的优势

✅ **符合Drupal规范** - 使用locale模块和.po文件
✅ **可维护** - 翻译可以被管理和更新
✅ **支持多语言** - 可以在中文和英文间切换
✅ **社区友好** - 翻译可以贡献给社区
✅ **与Drupal生态兼容**

---

## Drupal标准翻译实现方案

### 1. 翻译文件结构

```
farmOS/
├── modules/
│   └── core/
│       └── l10n/
│           └── translations/
│               └── farm_l10n.zh-hans.po  ← 模块翻译
├── translations/
│   ├── farmOS.zh-hans.po                   ← 完整翻译
│   └── drupal-zh-hans.po                   ← Drupal核心翻译
└── sites/
    └── default/
        └── files/
            └── translations/
                └── [自动导入的.po文件]
```

### 2. 标准.po文件格式

```po
msgid ""
msgstr ""
"Project-Id-Version: farmOS 4.x\n"
"Language: zh-hans\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"Plural-Forms: nplurals=1; plural=0;\n"

msgid "farmOS"
msgstr "农场管理系统"

msgid "Asset"
msgstr "资产"

msgid "Log"
msgstr "日志"
```

### 3. 自动安装翻译

修改 `farm_l10n.install` 添加自动导入：

```php
function farm_l10n_install() {
  // ... 现有代码 ...
  
  // 自动导入翻译文件
  $module_path = drupal_get_path('module', 'farm_l10n');
  $translation_file = $module_path . '/translations/farm_l10n.zh-hans.po';
  
  if (file_exists($translation_file)) {
    \Drupal::service('locale.po_file_import')
      ->import('zh-hans', $translation_file, [
        'override' => TRUE,
        'customized' => FALSE,
      ]);
  }
}
```

---

## 两种方案对比

| 方面 | 之前方法 | Drupal标准方法 |
|------|----------|----------------|
| 专业度 | 不专业 | ✅ 标准 |
| 可维护性 | 难 | ✅ 容易 |
| 多语言支持 | ❌ 无 | ✅ 完整 |
| 社区贡献 | 难 | ✅ 容易 |
| 更新维护 | 难 | ✅ 简单 |
| 翻译管理 | ❌ 无 | ✅ 完整 |

---

## 推荐方案

我建议采用**混合方案**：

### 方案C：混合方案（最佳平衡）

1. **核心配置** - 用 `ConfigFactoryOverrideInterface` 覆盖（保持中文）
2. **界面文本** - 用 `.po` 文件翻译（Drupal标准）
3. **自动导入** - 安装时自动导入翻译
4. **配置翻译** - 用 config_translation 模块翻译配置

这样既实用又专业！
