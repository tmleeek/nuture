<?php

/**
 * webideaonline.com.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://webideaonline.com/licensing/
 *
 */

namespace WIO\Forum\Model\ResourceModel\Usersettings;

use \WIO\Forum\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection {
  
  /**
   * @var string
   */
  protected $_idFieldName = 'user_id';
  
  /**
   * Define resource model
   *
   * @return void
   */
  protected function _construct() {
    $this->_init('WIO\Forum\Model\Usersettings', 'WIO\Forum\Model\ResourceModel\Usersettings');
    /* $this->_map['fields']['store'] = 'store_table.store_id'; */
  }
}
