<?php

class PromoSlide extends DataObject
{

	/**
	 * @var array
	 */
	private static $db = [
		'Title' => 'Varchar(100)',
		'Content' => 'HTMLText',
		'SortOrder' => 'Int',
		'BackgroundVideo' => 'Varchar(255)',
		'FullScreenVideo' => 'Varchar(255)',
		'IsHideSlideTitle' => 'Boolean',
		'IsHideContent' => 'Boolean',
		'IsHideHomeLink' => 'Boolean',
		'IsHideHeaderLogo' => 'Boolean',
		'IsRoadStatus' => 'Boolean'
	];

	/**
	 * @var array
	 */
	private static $has_one = [
		'PromoPage' => 'PromoPage',
		'PromoLogoImage' => 'Image'
	];

	/**
	 * @var array
	 */
	private static $default_sort = [
		'SortOrder' => 'ASC'
	];

	/**
	 * @return FieldList
	 */
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		// remove obsolete fields
		$fields->removeByName('SortOrder');
		$fields->removeByName('PromoPageID');

		// add descriptions for example embed urls
		$backgroundVideoField = $fields->dataFieldByName('BackgroundVideo');
		if ($backgroundVideoField) {
			$backgroundVideoField
				->setDescription('Sample embed URL: https://www.youtube.com/embed/aGOuPgktU4Q');
		}

		$fullscreenVideoField = $fields->dataFieldByName('FullScreenVideo');
		if ($fullscreenVideoField) {
			$fullscreenVideoField
				->setDescription('Sample embed URL: https://www.youtube.com/embed/aGOuPgktU4Q');
		}

		$hideSlideTitle = $fields->dataFieldByName('IsHideSlideTitle');
		$hideContent = $fields->dataFieldByName('IsHideContent');
		$hideHomeLink = $fields->dataFieldByName('IsHideHomeLink');
		$hideHeaderLogo = $fields->dataFieldByName('IsHideHeaderLogo');
		$isRoadStatus = $fields->dataFieldByName('IsRoadStatus');

		$promoLogoImage = $fields->dataFieldByName('PromoLogoImage');

		return $fields;
	}

	/**
	 * @return \RequiredFields
	 */
	public function getCMSValidator()
	{
		return new RequiredFields([
			'Title',
			'Content'
		]);
	}

	/**
	 * Helper to strip the YouTube ID from the BackgroundVideo URL entered.
	 * Handles a range of different formats, e.g. watch URLs and embed URLs.
	 *
	 * @return string
	 */
	public function getBackgroundVideoID()
	{
		return $this->getVideoID($this->BackgroundVideo);
	}

	/**
	 * Helper to strip the YouTube ID from the FullscreenVideo URL entered.
	 * Handles a range of different formats, e.g. watch URLs and embed URLs.
	 *
	 * @return string
	 */
	public function getFullScreenVideoID()
	{
		return $this->getVideoID($this->FullScreenVideo);
	}

	/**
	 * Helper to strip the YouTube ID from a provided URL.
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	private function getVideoID($url)
	{
		preg_match(
			"/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
			$url,
			$matches
		);

		return (count($matches) > 1) ? $matches[1] : '';
	}

	public function getHideHeaderLogo()
	{
		if(isset($this->IsHideHeaderLogo)){
			return $this->IsHideHeaderLogo;
		}else {
			return null;
		}
	}

	public function getRoadStatus()
	{
		if(isset($this->IsRoadStatus)){
			return $this->IsRoadStatus;
		}else {
			return null;
		}
	}
}
