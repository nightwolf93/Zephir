<?php

namespace Zephir\App\Controllers\Offer;

use Zephir\Logic\Controller;
use Zephir\App\Models\Forms\LoginForm;
use Zephir\Core\Database\Database;
use Zephir\App\Modules\OfferModule;

class OfferController extends Controller {

    public function index($parameters){
      $offer = OfferModule::getOffer($parameters['id']);
      if($offer != null){
          $this->set('offer', $offer);
      }
      else {
          $this->set('error', 'Aucune offre avec cette identifiant existe');
      }
    }
}


 