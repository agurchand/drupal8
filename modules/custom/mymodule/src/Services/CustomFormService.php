<?php

namespace Drupal\mymodule\Services;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class CustomService.
 */
class CustomFormService {

  use StringTranslationTrait;
		
  public function stateList() {
	
    $countries = [
      'tn' => $this->t('Tamilnadu'),
      'ka' => $this->t('Karnataka'), 
      'ap' => $this->t('Andhra Pradesh'),
    ];
	  
	  return $countries;
  }

  public function cityList($state) {
  
    $cities = [
      'tn' => ['md' => $this->t('Madurai'), 'cb' => $this->t('Coimbatore')], 
      'kn' => ['bn' => $this->t('Bangalore'), 'tm' => $this->t('Tumkur')],
      'ap' => ['tp' => $this->t('Tirupati')]
    ];

    if ($state == 'all') {
      $cities = call_user_func_array('array_merge', $cities);
    }else{
      $cities = $cities[$state];
    }
	  return $cities;
  }

	
}

