<?php

class CRM_Civixero_Item extends CRM_Civixero_Base {

  /**
   * Pull Item Codes from Xero and temporarily stash them on static.
   *
   * We don't want to keep stale ones in our DB - we'll check each time
   * We call the civicrm_accountPullPreSave hook so other modules can alter
   * if required.
   *
   *  - I can't think of a reason why they would but it seems consistent
   *
   * @param array $params
   *
   * @return array
   *
   * @throws CRM_Core_Exception
   */
  public function pull($params) {
    static $items = array();
    if (empty($items)) {
      $items = $this->getSingleton()->Items();
      if (!is_array($items) || !is_array($items['Items'])) {
        throw new CRM_Core_Exception('Items is not a valid array' . print_r($items, TRUE));
      }
      $items = $items['Items']['Item'];
    }
    return $items;
  }
}