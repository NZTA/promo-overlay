<?php

namespace NZTA\PromoOverlay\PageTypes;

use Page;
use SilverStripe\Forms\CheckboxField;
use NZTA\PromoOverlay\Models\PromoSlide;
use SilverStripe\Forms\GridField\GridField;
use NZTA\PromoOverlay\Validators\PromoPageValidator;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class PromoPage extends Page
{
    /**
     * @var string
     */
    private static $description = 'Used to display a promo campaign on the website';

    /**
     * @var array
     */
    private static $db = [
        'IsActive' => 'Boolean',
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'PromoSlides' => PromoSlide::class,
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab(
            'Root.Main',
            [
                CheckboxField::create('IsActive', 'Active Promo page')
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
                    ->addComponent(new GridFieldSortableRows('SortOrder'))
            )
        );

        return $fields;
    }

    /**
     * @return PromoPageValidator
     */
    public function getCMSValidator()
    {
        return new PromoPageValidator();
    }

}
