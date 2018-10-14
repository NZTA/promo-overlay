<?php

namespace NZTA\PromoOverlay\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

class PromoPageExtension extends DataExtension
{
    /**
     * Extension funciton
     *
     * @return void
     */
    public function contentcontrollerInit()
    {
        Requirements::javascript('nzta/promo-overlay:javascript/promooverlay.js');
        Requirements::javascript('nzta/promo-overlay:javascript/overlayvideo.js');
        Requirements::css('nzta/promo-overlay:css/promooverlay.css');
    }
}
