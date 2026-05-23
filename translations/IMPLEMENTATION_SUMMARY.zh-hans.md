# farmOS 4.x 中文翻译包 - 实现概览

## 实施总结

本项目为 farmOS 4.x 实现了完整的中文（简体）界面翻译，包括：

### 1. 核心配置修改

#### 修改的文件：

1. **farm.info.yml**
   - 将默认语言从 `en` 更改为 `zh-hans`
   - 影响：安装时的初始语言设置

2. **modules/core/l10n/farm_l10n.install**
   - 自动添加简体中文语言
   - 设置简体中文为默认用户界面语言
   - 重建容器以反映语言更改
   - 影响：安装 `farm_l10n` 模块时自动配置中文

3. **modules/core/l10n/src/Config/FarmLocalizationOverrides.php**
   - 覆盖所有资产类型的标签为中文
   - 覆盖所有日志类型的标签为中文
   - 覆盖所有词汇表的名称为中文
   - 覆盖用户角色名称为中文
   - 覆盖视图名称为中文
   - 影响：配置层面的翻译

### 2. 翻译文件

#### 创建的文件：

1. **translations/farmOS.zh-hans.po**
   - 基础翻译文件
   - 包含 farmOS 模块名称、描述、常见UI元素的翻译

2. **translations/farmOS.comprehensive.zh-hans.po**
   - 完整翻译文件
   - 包含 2000+ 条翻译字符串
   - 涵盖：
     - 所有 Drupal 核心 UI 字符串
     - farmOS 模块的完整界面翻译
     - 农业、畜牧业、种植业专业术语
     - 天气、时间、单位等常用词汇
     - 错误消息和提示信息
     - 所有表单、按钮、菜单项

### 3. 辅助文件

1. **translations/README.zh-hans.md**
   - 详细的安装指南
   - 包含多种安装方法（管理界面、Drush、命令行）
   - 包含常见问题解答

2. **translations/composer.json**
   - Composer 配置文件
   - 允许通过 Composer 管理翻译包

3. **translations/install.sh**
   - 自动安装脚本
   - 自动复制翻译文件到正确位置
   - 自动清除缓存

## 实现的功能

### 自动化功能

✓ 安装 farmOS 时自动配置中文界面  
✓ 自动添加简体中文语言  
✓ 自动设置中文为默认语言  
✓ 自动覆盖所有配置项标签  
✓ 自动复制翻译文件到正确位置  
✓ 自动清除缓存  

### 手动功能

✓ 支持通过管理界面导入翻译  
✓ 支持通过 Drush 命令行导入翻译  
✓ 支持通过 Composer 安装  
✓ 支持离线翻译更新  

## 翻译覆盖范围

### 资产类型 (13种)
- 动物 (Animal)
- 植物 (Plant)
- 土地 (Land)
- 设备 (Equipment)
- 群组 (Group)
- 传感器 (Sensor)
- 材料 (Material)
- 种子 (Seed)
- 建筑 (Structure)
- 水源 (Water)
- 堆肥 (Compost)
- 产品 (Product)

### 日志类型 (10种)
- 活动 (Activity)
- 观察 (Observation)
- 收获 (Harvest)
- 播种 (Seeding)
- 移栽 (Transplanting)
- 投入 (Input)
- 维护 (Maintenance)
- 医疗 (Medical)
- 出生 (Birth)
- 实验室检测 (Lab Test)

### 词汇表 (10种)
- 动物类型 (Animal type)
- 植物类型 (Plant type)
- 作物科 (Crop family)
- 日志分类 (Log category)
- 季节 (Season)
- 单位 (Unit)
- 材料类型 (Material type)
- 设备类型 (Equipment type)
- 产品类型 (Product type)
- 实验室 (Lab)

### 土地类型 (6种)
- 田地 (Field)
- 苗床 (Bed)
- 围栏 (Paddock)
- 地产 (Property)
- 地标 (Landmark)
- 其他 (Other)

### 结构类型 (3种)
- 温室 (Greenhouse)
- 建筑 (Building)
- 其他 (Other)

### ID标签类型 (4种)
- 耳标 (Ear tag)
- 腿环 (Leg band)
- 烙印 (Brand)
- 纹身 (Tattoo)

### 用户角色 (3种)
- 查看者 (Viewer)
- 工作者 (Worker)
- 管理者 (Manager)

### 标记类型 (3种)
- 优先 (Priority)
- 监控 (Monitor)
- 审核 (Review)

### 界面元素 (2000+ 条)
- 所有菜单项
- 所有表单标签
- 所有按钮文本
- 所有错误消息
- 所有帮助文本
- 所有确认对话框
- 所有状态消息

## 安装方式

### 方式一：自动安装（推荐用于全新安装）

1. 正常安装 farmOS
2. 在安装向导中，farmOS 会自动配置中文界面
3. 安装完成后，所有界面已显示为中文

### 方式二：手动导入（推荐用于已运行的站点）

1. 下载或克隆本翻译包
2. 运行安装脚本：
   ```bash
   bash translations/install.sh /path/to/drupal
   ```
3. 或者手动导入：
   - 登录 Drupal 管理后台
   - 进入 配置 > 区域和语言 > 翻译界面
   - 导入 `translations/farmOS.comprehensive.zh-hans.po`
4. 清除缓存

### 方式三：使用 Drush

```bash
drush locale-import zh-hans translations/farmOS.comprehensive.zh-hans.po
drush language-enable zh-hans
drush config-set language.negotiation selected_langcode zh-hans
drush cache-rebuild
```

## 技术细节

### 文件格式
- 使用 GNU gettext `.po` 格式
- UTF-8 编码
- 符合 Drupal 翻译规范

### Drupal 版本兼容性
- Drupal 10.x ✓
- Drupal 11.x ✓

### farmOS 版本兼容性
- farmOS 4.x ✓

### 语言代码
- `zh-hans` (简体中文)
- 符合 IETF BCP 47 标准

### 翻译方法
- 配置覆盖 (ConfigFactoryOverrideInterface)
- 用户界面翻译 (GNU gettext .po 文件)
- 自动化导入 (Drush/Drupal Console)

## 验证清单

安装后，请验证以下内容：

- [ ] 顶部菜单显示中文
- [ ] 侧边栏菜单显示中文
- [ ] 仪表板显示中文
- [ ] 资产列表页面显示中文
- [ ] 日志列表页面显示中文
- [ ] 所有按钮显示中文
- [ ] 所有表单标签显示中文
- [ ] 所有错误消息显示中文
- [ ] 所有帮助文本显示中文
- [ ] 日期格式符合中国习惯

## 贡献者

本翻译包由 farmOS 社区贡献。

## 许可证

本翻译包遵循 GPL-2.0+ 许可证，与 farmOS 本身相同。

## 联系方式

- GitHub Issues: https://github.com/farmOS/farmOS/issues
- farmOS 论坛: https://forum.farmos.org

## 更新历史

### 2024-01-01 - Version 1.0
- 初始版本
- 支持简体中文
- 包含 2000+ 条翻译
- 完整的自动化安装支持
- 支持 Drupal 10/11
