<?php

namespace NZTA\PromoOverlay\PageTypes;

use NZTA\PromoOverlay\Models\PromoSlide;
use NZTA\PromoOverlay\Validators\PromoPageValidator;
use Page;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * @property bool $IsActive
 * @method \SilverStripe\ORM\HasManyList<PromoSlide> PromoSlides()
 */
class PromoPage extends Page
{
    private static $description = 'Used to display a promo campaign on the website';

    private static $singular_name = 'Promo Page';

    private static $plural_name = 'Promo Pages';

    private static $table_name = 'PromoPage';

    private static $db = [
        'IsActive' => 'Boolean',
    ];

    private static $has_many = [
        'PromoSlides' => PromoSlide::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab(
            'Root.Main',
            [
                CheckboxField::create('IsActive', 'Active Promo page'),
            ],
            'Content'
        );

        $fields->addFieldToTab(
            'Root.PromoSlides',
            GridField::create(
                'PromoSlides',
                'Promo Slides',
                $this->PromoSlides()->sort('SortOrder'),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(new GridFieldOrderableRows('SortOrder'))
            )
        );

        return $fields;
    }

    public function getCMSValidator()
    {
        return PromoPageValidator::create();
    }
}
