# farmOS

[![许可协议](https://img.shields.io/badge/Licence-GPL%202.0-blue.svg)](https://opensource.org/licenses/GPL-2.0/)
[![发布版本](https://img.shields.io/github/release/farmOS/farmOS.svg?style=flat)](https://github.com/farmOS/farmOS/releases)
[![最后提交](https://img.shields.io/github/last-commit/farmOS/farmOS.svg?style=flat)](https://github.com/farmOS/farmOS/commits)
[![Docker](https://img.shields.io/docker/pulls/farmos/farmos.svg)](https://hub.docker.com/r/farmos/farmos/)
[![在线聊天](https://img.shields.io/matrix/farmOS:matrix.org.svg)](https://app.element.io/#/room/#farmOS:matrix.org)
[![Open Collective 支持者](https://opencollective.com/farmOS/backers/badge.svg)](#backers)
[![Open Collective 赞助商](https://opencollective.com/farmOS/sponsors/badge.svg)](#sponsors)

## 项目简介

farmOS 是一个功能强大的基于 Web 的农场管理、规划和记录保存应用程序。它由一群志愿者社区开发，旨在为农民、开发者和研究人员提供一个标准化的开源平台。从家庭小花园到大规模商业农场，从传统农业到生态系统管理，farmOS 都能适应各种规模和类型的农业需求。

**主要特点：**

- 📊 完整的农场数据记录系统
- 🗺️ 集成地图和空间数据管理
- 📱 响应式界面，支持手机和平板设备
- 🔌 开放的 API 和可扩展的模块架构
- 🔐 安全的权限管理和数据隐私保护
- 📈 数据可视化和报表功能
- 🔄 可与传感器和第三方应用集成

## 技术栈

farmOS 基于现代技术构建，具有强大的扩展性和稳定性：

- **框架**：[Drupal 11.x](https://drupal.org) - 成熟的开源内容管理框架
- **编程语言**：PHP 8.4+
- **数据库**：推荐 PostgreSQL 16+，同时支持 MariaDB/MySQL 8.0+ 和 SQLite 3.45+
- **前端主题**：Gin 管理主题，提供直观的用户体验
- **地图库**：集成 OpenLayers，支持多种地图图层
- **地理数据**：GEOS 地理空间库，支持复杂几何操作
- **API**：JSON:API 标准，支持 OAuth2 认证
- **容器化**：提供官方 Docker 镜像，支持快速部署

## 核心功能

### 数据模型

farmOS 使用灵活而强大的数据模型来组织农业信息，主要包括以下记录类型：

#### 资产 (Assets)
资产是农场管理的核心"管理单元"，代表您正在管理的有价值的事物：
- 🌱 植物 - 作物、树木等
- 🐄 动物 - 牲畜、家禽等
- 🌾 土地 - 田地、牧场、林地
- 🚜 设备 - 农机具、工具
- 🧪 材料 - 种子、肥料、农药等
- 📦 产品 - 收获的农产品
- 🏗️ 构筑物 - 建筑、围栏、灌溉系统
- 💧 水源 - 井、池塘、水库
- 🐝 群体 - 动物群体、种植组
- 🌡️ 传感器 - 物联网设备

#### 日志 (Logs)
日志是与资产相关的事件记录，记录农场活动的时间和细节：
- 📝 活动日志 - 一般性农场活动
- 🌱 播种日志 - 种植记录
- 🔄 移栽日志 - 作物移栽
- 🌾 收获日志 - 收获记录
- 💊 医疗日志 - 动物治疗记录
- 🔧 维护日志 - 设备维护
- 🔬 实验室检测 - 土壤、水质检测
- 👶 出生日志 - 动物繁殖
- 📥 投入日志 - 农资投入记录
- 👀 观察日志 - 日常观察记录

#### 其他数据类型
- 📊 数量 - 与日志关联的详细测量数据
- 📈 数据流 - 来自传感器的实时数据
- 📁 文件 - 照片、文档、PDF
- 🏷️ 术语 - 分类、标签、词汇表
- 📋 计划 - 项目管理和规划
- 👥 组织 - 农场、公司、机构
- 👤 用户 - 系统用户和角色

### 高级功能

#### 位置管理
- 资产和日志的空间位置标注
- 分层位置结构（农场 → 区域 → 田块）
- KML 文件导入导出
- 集成地图与导航

#### 库存跟踪
- 精确的库存计数与调整
- 支持多种计量单位
- 库存变化历史记录

#### 群体管理
- 动物群体和作物群组管理
- 成员资格动态跟踪
- 群体位置和库存汇总

#### 快速表单
- 预配置的数据录入快捷表单
- 支持自定义快速表单开发
- 大幅提高数据录入效率

#### 数据导入导出
- CSV 格式数据批量导入
- 灵活的导出功能
- 支持数据迁移

#### 报告与分析
- 可定制的农场报表
- 数据可视化仪表板
- 时间线视图

#### 多语言支持
- 内置国际化框架
- 支持多种语言界面
- 社区贡献的语言包

## 项目结构

farmOS 采用模块化架构，主要模块组织如下：

```
/workspace/
├── modules/              # 核心模块目录
│   ├── asset/           # 资产类型模块
│   ├── core/            # 核心功能模块
│   ├── log/             # 日志类型模块
│   ├── quick/           # 快速表单模块
│   ├── role/            # 用户角色模块
│   └── taxonomy/        # 分类词汇模块
├── docker/              # Docker 相关文件
├── docs/                # 官方文档
└── ...                  # 其他配置文件
```

核心模块包括：
- [api](file:///workspace/modules/core/api) - RESTful JSON:API
- [asset](file:///workspace/modules/core/asset) - 资产管理
- [log](file:///workspace/modules/core/log) - 日志管理
- [map](file:///workspace/modules/core/map) - 地图集成
- [location](file:///workspace/modules/core/location) - 位置功能
- [inventory](file:///workspace/modules/core/inventory) - 库存跟踪
- [import](file:///workspace/modules/core/import) & [export](file:///workspace/modules/core/export) - 数据导入导出
- [quick](file:///workspace/modules/core/quick) - 快速表单

## 快速开始

### 系统要求

#### 服务器要求
- PHP 8.4+
- PostgreSQL 16+（推荐）或 MariaDB 10.6+ / MySQL 8.0+ / SQLite 3.45+
- PHP 扩展：BCMath、EXIF、GEOS、SimpleXML
- 推荐 PHP 配置：
  - `memory_limit=256M`
  - `max_execution_time=240`
  - `max_input_vars=5000`

#### 浏览器支持
farmOS 支持所有现代浏览器，与 Drupal 核心保持一致。

### 安装方式

#### 使用 Docker（推荐）
Docker 是最简单的部署方式，官方提供预配置的 Docker 镜像：

```bash
docker pull farmos/farmos:latest
```

详细文档请参考：[farmOS 官方 Docker 文档](https://farmOS.org/hosting/docker)

#### 使用 Composer
对于开发者或高级用户，可以使用 Composer 安装：

```bash
composer create-project farmos/project:4.x my-farmos --no-interaction
```

#### 托管服务
如果需要付费托管服务，[Farmier](https://farmier.com) 提供了针对个人农场和组织的经济实惠的托管方案。

更多安装选项请访问：[farmOS 安装文档](https://farmOS.org/hosting/install)

## 用户指南

### 仪表板
登录后首先看到的是 farmOS 仪表板，包含：
- 🗺️ 农场地图 - 显示所有位置资产
- 📅 即将到来的任务
- ⚠️ 逾期任务
- 📊 农场指标统计

### 导航
左侧工具栏提供快速访问：
- **快速表单** - 便捷的数据录入
- **位置** - 管理位置层次结构
- **计划** - 项目管理
- **记录** - 资产、日志、数量的完整列表
- **报告** - 数据分析报表
- **人员** - 用户管理
- **管理** - 系统设置

## 开发与贡献

### 参与开发
我们欢迎各种形式的贡献！无论是代码、文档、翻译还是测试。

- [开发环境设置](https://farmOS.org/development/environment)
- [模块开发指南](https://farmOS.org/development/module)
- [API 文档](https://farmOS.org/development/api)
- [贡献指南](https://github.com/farmOS/farmOS/blob/4.x/CONTRIBUTING.md)

### 社区资源
- 🌐 官方网站：[farmOS.org](https://farmOS.org)
- 💬 论坛：[farmOS.discourse.group](https://farmOS.discourse.group)
- 📱 聊天：[Matrix 频道](https://app.element.io/#/room/#farmOS:matrix.org)
- 🐛 问题追踪：[GitHub Issues](https://github.com/farmOS/farmOS/issues)

## 维护者

当前维护者：
 * Michael Stenta (m.stenta) - https://drupal.org/user/581414

## 赞助与支持

本项目由以下组织和机构赞助：

 * [Farmier](http://farmier.com)
 * [康奈尔大学](http://www.cornell.edu)
 * [佛蒙特州农业食品与市场署](http://agriculture.vermont.gov)
 * [佛蒙特州住房与保护委员会](http://www.vhcb.org)
 * [UVM 推广中心](https://www.uvm.edu/extension)
 * [环球旅行家基金会](http://globetrotterfoundation.org)
 * [佛蒙特州蔬菜和浆果种植者协会](http://www.uvm.edu/vtvegandberry)
 * [宾夕法尼亚州可持续农业协会](https://pasafarming.org)
 * [自然资源保护服务](https://www.nrcs.usda.gov)
 * [美国森林服务局 - 国际项目](https://www.fs.fed.us/about-agency/international-programs)
 * [乌干达国家森林管理局](https://www.nfa.org.ug/)
 * [Our Sci](http://our-sci.net)
 * [生物营养食品协会](https://bionutrient.org)
 * [食品与农业研究基金会](https://foundationfar.org/)
 * [PVAMU 农业与人文科学学院](https://www.pvamu.edu/cahs/)
 * [洛桑研究所](https://www.rothamsted.ac.uk/)
 * [OpenTEAM](https://openteam.community)
 * [Wolfe's Neck 农业与环境中心](https://www.wolfesneck.org)
 * [根植方案](https://www.rootedsolutions.io/)
 * [加州州立理工大学气候领导力与韧性倡议](https://climate.calpoly.edu/)
 * [上萨利纳斯-拉斯塔布拉斯资源保护区](https://www.us-ltrcd.org/)
 * [Point Blue 保护科学](https://www.pointblue.org/)

## 贡献者

感谢所有为本项目做出贡献的人们！

<a href="https://github.com/farmOS/farmOS/graphs/contributors"><img src="https://opencollective.com/farmOS/contributors.svg?width=890&button=false" /></a>

## Open Collective 支持者

感谢我们所有的 OpenCollective 支持者！[[成为支持者](https://opencollective.com/farmOS#backer)]

<a href="https://opencollective.com/farmOS#backers" target="_blank"><img src="https://opencollective.com/farmOS/backers.svg?width=890"></a>

## Open Collective 赞助商

通过成为 OpenCollective 赞助商来支持这个项目。[[成为赞助商](https://opencollective.com/farmOS#sponsor)]

<a href="https://opencollective.com/farmOS/sponsor/0/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/0/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/1/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/1/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/2/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/2/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/3/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/3/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/4/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/4/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/5/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/5/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/6/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/6/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/7/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/7/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/8/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/8/avatar.svg"></a>
<a href="https://opencollective.com/farmOS/sponsor/9/website" target="_blank"><img src="https://opencollective.com/farmOS/sponsor/9/avatar.svg"></a>

## 许可证

farmOS 采用 [GNU General Public License, version 2](https://opensource.org/licenses/GPL-2.0/) 开源许可证。
