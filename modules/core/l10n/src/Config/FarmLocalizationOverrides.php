<?php

declare(strict_types=1);

namespace Drupal\farm_l10n\Config;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Configuration overrides for farmOS localization module.
 */
class FarmLocalizationOverrides implements ConfigFactoryOverrideInterface {

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names) {
    $overrides = [];
    
    // Override system.site default language.
    if (in_array('system.site', $names)) {
      $overrides['system.site']['default_langcode'] = 'zh-hans';
    }
    
    // Override asset.type.animal
    if (in_array('asset.type.animal', $names)) {
      $overrides['asset.type.animal']['label'] = '动物';
      $overrides['asset.type.animal']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.plant
    if (in_array('asset.type.plant', $names)) {
      $overrides['asset.type.plant']['label'] = '植物';
      $overrides['asset.type.plant']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.land
    if (in_array('asset.type.land', $names)) {
      $overrides['asset.type.land']['label'] = '土地';
      $overrides['asset.type.land']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.equipment
    if (in_array('asset.type.equipment', $names)) {
      $overrides['asset.type.equipment']['label'] = '设备';
      $overrides['asset.type.equipment']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.group
    if (in_array('asset.type.group', $names)) {
      $overrides['asset.type.group']['label'] = '群组';
      $overrides['asset.type.group']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.sensor
    if (in_array('asset.type.sensor', $names)) {
      $overrides['asset.type.sensor']['label'] = '传感器';
      $overrides['asset.type.sensor']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.material
    if (in_array('asset.type.material', $names)) {
      $overrides['asset.type.material']['label'] = '材料';
      $overrides['asset.type.material']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.seed
    if (in_array('asset.type.seed', $names)) {
      $overrides['asset.type.seed']['label'] = '种子';
      $overrides['asset.type.seed']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.structure
    if (in_array('asset.type.structure', $names)) {
      $overrides['asset.type.structure']['label'] = '建筑';
      $overrides['asset.type.structure']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.water
    if (in_array('asset.type.water', $names)) {
      $overrides['asset.type.water']['label'] = '水源';
      $overrides['asset.type.water']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.compost
    if (in_array('asset.type.compost', $names)) {
      $overrides['asset.type.compost']['label'] = '堆肥';
      $overrides['asset.type.compost']['langcode'] = 'zh-hans';
    }
    
    // Override asset.type.product
    if (in_array('asset.type.product', $names)) {
      $overrides['asset.type.product']['label'] = '产品';
      $overrides['asset.type.product']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.animal_type
    if (in_array('taxonomy.vocabulary.animal_type', $names)) {
      $overrides['taxonomy.vocabulary.animal_type']['name'] = '动物类型';
      $overrides['taxonomy.vocabulary.animal_type']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.plant_type
    if (in_array('taxonomy.vocabulary.plant_type', $names)) {
      $overrides['taxonomy.vocabulary.plant_type']['name'] = '植物类型';
      $overrides['taxonomy.vocabulary.plant_type']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.crop_family
    if (in_array('taxonomy.vocabulary.crop_family', $names)) {
      $overrides['taxonomy.vocabulary.crop_family']['name'] = '作物科';
      $overrides['taxonomy.vocabulary.crop_family']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.log_category
    if (in_array('taxonomy.vocabulary.log_category', $names)) {
      $overrides['taxonomy.vocabulary.log_category']['name'] = '日志分类';
      $overrides['taxonomy.vocabulary.log_category']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.season
    if (in_array('taxonomy.vocabulary.season', $names)) {
      $overrides['taxonomy.vocabulary.season']['name'] = '季节';
      $overrides['taxonomy.vocabulary.season']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.unit
    if (in_array('taxonomy.vocabulary.unit', $names)) {
      $overrides['taxonomy.vocabulary.unit']['name'] = '单位';
      $overrides['taxonomy.vocabulary.unit']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.material_type
    if (in_array('taxonomy.vocabulary.material_type', $names)) {
      $overrides['taxonomy.vocabulary.material_type']['name'] = '材料类型';
      $overrides['taxonomy.vocabulary.material_type']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.equipment_type
    if (in_array('taxonomy.vocabulary.equipment_type', $names)) {
      $overrides['taxonomy.vocabulary.equipment_type']['name'] = '设备类型';
      $overrides['taxonomy.vocabulary.equipment_type']['langcode'] = 'zh-hans';
    }
    
    // Override taxonomy.vocabulary.product_type
    if (in_array('taxonomy.vocabulary.product_type', $names)) {
      $overrides['taxonomy.vocabulary.product_type']['name'] = '产品类型';
      $overrides['taxonomy.vocabulary.product_type']['langcode'] = 'zh-hans';
    }
    
    // Override farm_flag.flag.priority
    if (in_array('farm_flag.flag.priority', $names)) {
      $overrides['farm_flag.flag.priority']['label'] = '优先';
      $overrides['farm_flag.flag.priority']['langcode'] = 'zh-hans';
    }
    
    // Override farm_flag.flag.monitor
    if (in_array('farm_flag.flag.monitor', $names)) {
      $overrides['farm_flag.flag.monitor']['label'] = '监控';
      $overrides['farm_flag.flag.monitor']['langcode'] = 'zh-hans';
    }
    
    // Override farm_flag.flag.review
    if (in_array('farm_flag.flag.review', $names)) {
      $overrides['farm_flag.flag.review']['label'] = '审核';
      $overrides['farm_flag.flag.review']['langcode'] = 'zh-hans';
    }
    
    // Override user.role.farm_viewer
    if (in_array('user.role.farm_viewer', $names)) {
      $overrides['user.role.farm_viewer']['label'] = '查看者';
      $overrides['user.role.farm_viewer']['langcode'] = 'zh-hans';
    }
    
    // Override user.role.farm_worker
    if (in_array('user.role.farm_worker', $names)) {
      $overrides['user.role.farm_worker']['label'] = '工作者';
      $overrides['user.role.farm_worker']['langcode'] = 'zh-hans';
    }
    
    // Override user.role.farm_manager
    if (in_array('user.role.farm_manager', $names)) {
      $overrides['user.role.farm_manager']['label'] = '管理者';
      $overrides['user.role.farm_manager']['langcode'] = 'zh-hans';
    }
    
    // Override views.view.farm_asset
    if (in_array('views.view.farm_asset', $names)) {
      $overrides['views.view.farm_asset']['label'] = '资产';
      $overrides['views.view.farm_asset']['langcode'] = 'zh-hans';
    }
    
    // Override views.view.farm_log
    if (in_array('views.view.farm_log', $names)) {
      $overrides['views.view.farm_log']['label'] = '日志';
      $overrides['views.view.farm_log']['langcode'] = 'zh-hans';
    }
    
    // Override views.view.farm_people
    if (in_array('views.view.farm_people', $names)) {
      $overrides['views.view.farm_people']['label'] = '人员';
      $overrides['views.view.farm_people']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.activity
    if (in_array('log.type.activity', $names)) {
      $overrides['log.type.activity']['label'] = '活动';
      $overrides['log.type.activity']['name_pattern'] = '活动日志 [log:id]';
      $overrides['log.type.activity']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.observation
    if (in_array('log.type.observation', $names)) {
      $overrides['log.type.observation']['label'] = '观察';
      $overrides['log.type.observation']['name_pattern'] = '观察日志 [log:id]';
      $overrides['log.type.observation']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.harvest
    if (in_array('log.type.harvest', $names)) {
      $overrides['log.type.harvest']['label'] = '收获';
      $overrides['log.type.harvest']['name_pattern'] = '收获日志 [log:id]';
      $overrides['log.type.harvest']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.seeding
    if (in_array('log.type.seeding', $names)) {
      $overrides['log.type.seeding']['label'] = '播种';
      $overrides['log.type.seeding']['name_pattern'] = '播种日志 [log:id]';
      $overrides['log.type.seeding']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.transplanting
    if (in_array('log.type.transplanting', $names)) {
      $overrides['log.type.transplanting']['label'] = '移栽';
      $overrides['log.type.transplanting']['name_pattern'] = '移栽日志 [log:id]';
      $overrides['log.type.transplanting']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.input
    if (in_array('log.type.input', $names)) {
      $overrides['log.type.input']['label'] = '投入';
      $overrides['log.type.input']['name_pattern'] = '投入日志 [log:id]';
      $overrides['log.type.input']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.maintenance
    if (in_array('log.type.maintenance', $names)) {
      $overrides['log.type.maintenance']['label'] = '维护';
      $overrides['log.type.maintenance']['name_pattern'] = '维护日志 [log:id]';
      $overrides['log.type.maintenance']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.medical
    if (in_array('log.type.medical', $names)) {
      $overrides['log.type.medical']['label'] = '医疗';
      $overrides['log.type.medical']['name_pattern'] = '医疗日志 [log:id]';
      $overrides['log.type.medical']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.birth
    if (in_array('log.type.birth', $names)) {
      $overrides['log.type.birth']['label'] = '出生';
      $overrides['log.type.birth']['name_pattern'] = '出生日志 [log:id]';
      $overrides['log.type.birth']['langcode'] = 'zh-hans';
    }
    
    // Override log.type.lab_test
    if (in_array('log.type.lab_test', $names)) {
      $overrides['log.type.lab_test']['label'] = '实验室检测';
      $overrides['log.type.lab_test']['name_pattern'] = '实验室检测日志 [log:id]';
      $overrides['log.type.lab_test']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.field
    if (in_array('farm_land.land_type.field', $names)) {
      $overrides['farm_land.land_type.field']['label'] = '田地';
      $overrides['farm_land.land_type.field']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.bed
    if (in_array('farm_land.land_type.bed', $names)) {
      $overrides['farm_land.land_type.bed']['label'] = '苗床';
      $overrides['farm_land.land_type.bed']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.paddock
    if (in_array('farm_land.land_type.paddock', $names)) {
      $overrides['farm_land.land_type.paddock']['label'] = '围栏';
      $overrides['farm_land.land_type.paddock']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.landmark
    if (in_array('farm_land.land_type.landmark', $names)) {
      $overrides['farm_land.land_type.landmark']['label'] = '地标';
      $overrides['farm_land.land_type.landmark']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.property
    if (in_array('farm_land.land_type.property', $names)) {
      $overrides['farm_land.land_type.property']['label'] = '地产';
      $overrides['farm_land.land_type.property']['langcode'] = 'zh-hans';
    }
    
    // Override farm_land.land_type.other
    if (in_array('farm_land.land_type.other', $names)) {
      $overrides['farm_land.land_type.other']['label'] = '其他';
      $overrides['farm_land.land_type.other']['langcode'] = 'zh-hans';
    }
    
    // Override farm_structure.structure_type.greenhouse
    if (in_array('farm_structure.structure_type.greenhouse', $names)) {
      $overrides['farm_structure.structure_type.greenhouse']['label'] = '温室';
      $overrides['farm_structure.structure_type.greenhouse']['langcode'] = 'zh-hans';
    }
    
    // Override farm_structure.structure_type.building
    if (in_array('farm_structure.structure_type.building', $names)) {
      $overrides['farm_structure.structure_type.building']['label'] = '建筑';
      $overrides['farm_structure.structure_type.building']['langcode'] = 'zh-hans';
    }
    
    // Override farm_structure.structure_type.other
    if (in_array('farm_structure.structure_type.other', $names)) {
      $overrides['farm_structure.structure_type.other']['label'] = '其他';
      $overrides['farm_structure.structure_type.other']['langcode'] = 'zh-hans';
    }
    
    // Override farm_id_tag.tag_type.ear_tag
    if (in_array('farm_id_tag.tag_type.ear_tag', $names)) {
      $overrides['farm_id_tag.tag_type.ear_tag']['label'] = '耳标';
      $overrides['farm_id_tag.tag_type.ear_tag']['langcode'] = 'zh-hans';
    }
    
    // Override farm_id_tag.tag_type.leg_band
    if (in_array('farm_id_tag.tag_type.leg_band', $names)) {
      $overrides['farm_id_tag.tag_type.leg_band']['label'] = '腿环';
      $overrides['farm_id_tag.tag_type.leg_band']['langcode'] = 'zh-hans';
    }
    
    // Override farm_id_tag.tag_type.brand
    if (in_array('farm_id_tag.tag_type.brand', $names)) {
      $overrides['farm_id_tag.tag_type.brand']['label'] = '烙印';
      $overrides['farm_id_tag.tag_type.brand']['langcode'] = 'zh-hans';
    }
    
    // Override farm_id_tag.tag_type.tattoo
    if (in_array('farm_id_tag.tag_type.tattoo', $names)) {
      $overrides['farm_id_tag.tag_type.tattoo']['label'] = '纹身';
      $overrides['farm_id_tag.tag_type.tattoo']['langcode'] = 'zh-hans';
    }
    
    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'FarmLocalizationOverrider';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}
