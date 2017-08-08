<?php

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
        'PromoSlides' => 'PromoSlide'
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
