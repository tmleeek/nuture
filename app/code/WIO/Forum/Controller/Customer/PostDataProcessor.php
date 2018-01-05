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

namespace WIO\Forum\Controller\Customer;

class PostDataProcessor {
  
  public function __construct() {
    
  }

  public function filter($data) {
    if(!empty($data['nickname'])) {
      $data['nickname'] = strip_tags($data['nickname']);
    }
    if(!empty($data['signature'])) {
      $data['signature'] = strip_tags($data['signature'], '<br><em><i><b>');
    }
    return $data;
  }

}