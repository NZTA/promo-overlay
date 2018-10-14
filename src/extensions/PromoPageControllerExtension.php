<?php

namespace NZTA\PromoOverlay\Extensions;

use SilverStripe\ORM\DataExtension;
use NZTA\PromoOverlay\PageTypes\PromoPage;

class PromoPageControllerExtension extends DataExtension
{

    /**
     * Find the active {@link PromoPage} and get the {@link PromoSlide}s
     * attached to the page.
     *
     * @return HasManyList|null
     */
    public function getActivePromoSlides()
    {
        $page = PromoPage::get()->filter('IsActive', true)->first();

        if ($page) {
            return $page->PromoSlides();
        }

        return null;
    }

    /**
     * Find the active {@link PromoPage} and get the slide data for the
     * front end.
     *
     * @return array
     */
    public function getActivePromoSlideData()
    {
        $data = [];

        $slides = $this->getActivePromoSlides();

        if ($slides && $slides->count()) {
            foreach ($slides as $slide) {
                $data[] = [
                    'Title' => $slide->Title,
                    'Content' => $slide->dbObject('Content')->forTemplate()
                ];
            }
        }

        return $data;
    }

    /**
     * Helper to determine whether the promo overlay should display on initial
     * visit.
     *
     * @return int
     */
    public function getShouldDisplayOverlay()
    {
        $data = $this->getActivePromoSlideData();

        return (count($data) > 0) ? 1 : 0;
    }

    /**
     * Helper to get promo page data as JSON so javascript can access the data
     * to generate the overlay if needed.
     *
     * @return string
     */
    public function getPromoPageJsonData()
    {
        $data = [
            'slideData' => $this->getActivePromoSlideData(),
            'showOverlay' => $this->getShouldDisplayOverlay()
        ];

        return json_encode($data);
    }

}
