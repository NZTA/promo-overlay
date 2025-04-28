<?php

namespace NZTA\PromoOverlay\Extensions;

use NZTA\PromoOverlay\Models\PromoSlide;
use NZTA\PromoOverlay\PageTypes\PromoPage;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\HasManyList;

class PromoPageControllerExtension extends DataExtension
{
    /**
     * Find the active {@link PromoPage} and get the {@link PromoSlide}s attached to the page.
     *
     * @return HasManyList<PromoSlide>|null
     */
    public function getActivePromoSlides()
    {
        return PromoPage::get()->filter('IsActive', true)->first()?->PromoSlides();
    }

    /**
     * Find the active {@link PromoPage} and get the slide data for the front end.
     *
     * @return array
     */
    public function getActivePromoSlideData()
    {
        $data = [];

        $slides = $this->getActivePromoSlides() ?? [];

        foreach ($slides as $slide) {
            $data[] = [
                'Title' => $slide->Title,
                'Content' => $slide->dbObject('Content')->forTemplate(),
            ];
        }

        return $data;
    }

    /**
     * Helper to determine whether the promo overlay should display on initial visit.
     *
     * @return int
     */
    public function getShouldDisplayOverlay()
    {
        $data = $this->getActivePromoSlideData();

        return (count($data) > 0) ? 1 : 0;
    }

    /**
     * Helper to get promo page data as JSON so javascript can access the data to generate the overlay if needed.
     *
     * @return string
     */
    public function getPromoPageJsonData()
    {
        $data = [
            'slideData' => $this->getActivePromoSlideData(),
            'showOverlay' => $this->getShouldDisplayOverlay(),
        ];

        return json_encode($data);
    }
}
