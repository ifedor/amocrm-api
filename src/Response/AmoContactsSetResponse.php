<?php
/**
 * Created by PhpStorm.
 * User: Ант
 * Date: 29.07.2016
 * Time: 16:43
 */

namespace AmoCrm\Api\Response;


use AmoCrm\Api\Object\AmoContactObject;

class AmoContactsSetResponse extends AmoEntitySetResponse {

  /**
   * AmoContactsSetResponse constructor.
   *
   * @param integer $http_code
   * @param mixed $raw_result
   */
  public function __construct($http_code, $raw_result) {
    // Set type of this entity
    $this->entity = 'contacts';
    parent::__construct($http_code, $raw_result);

    // Customization goes here
    if (!$this->isErrorFlag()) {

      if (count($this->op) > 0) {
        $objects = [];
        // Iterate and create objects
        foreach ($this->op as $operation => $bool) {
          foreach ($this->payload[$this->entity][$operation] as $item) {
            $objects[] = new AmoContactObject($item);
          }
        }
        // Substitute generic array with array of objects
        $this->payload = $objects;
      }

    }
  }
}