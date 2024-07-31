<?php

namespace NZTA\PromoOverlay\Validators;

use NZTA\PromoOverlay\PageTypes\PromoPage;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\RequiredFields;

class PromoPageValidator extends RequiredFields
{
    public function php($data)
    {
        $valid = parent::php($data);
        if (Convert::raw2sql($data['IsActive']) == 1) {
            $promoPageCount = PromoPage::get()
                ->filter('IsActive', true)
                ->exclude('ID', $data['ID'])
                ->count();

            if ($promoPageCount > 0) {
                $this->validationError('IsActive', 'Sorry, You can have only one active promo page.', 'validation');
                $valid = false;
            }
        }

        return $valid;
    }
}
