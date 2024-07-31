<?php

namespace NZTA\PromoOverlay\Test;

use NZTA\PromoOverlay\Models\PromoSlide;
use SilverStripe\Dev\SapphireTest;

class PromoSlideTest extends SapphireTest
{
    /**
     * List of youtube url variations to test video ID extraction.
     *
     * @var array
     */
    public function videoUrlList()
    {
        return [
            ['youtube.com/v/123', '123'],
            ['youtube.com/vi/456', '456'],
            ['youtube.com/?v=789', '789'],
            ['youtube.com/?vi=321', '321'],
            ['youtube.com/watch?v=654', '654'],
            ['youtube.com/watch?vi=987', '987'],
            ['youtu.be/147', '147'],
            ['youtube.com/embed/258', '258'],
            ['http://youtube.com/v/369', '369'],
            ['http://www.youtube.com/v/741', '741'],
            ['https://www.youtube.com/v/852', '852'],
            ['youtube.com/watch?v=963&wtv=wtv', '963'],
            ['http://www.youtube.com/watch?dev=inprogress&v=159&feature=related', '159'],
            ['https://m.youtube.com/watch?v=357', '357'],
        ];
    }

    /**
     * @dataProvider videoUrlList
     */
    public function testGetBackgroundVideoID($videoUrl, $expectedId)
    {
        $slide = new PromoSlide();
        $slide->BackgroundVideo = $videoUrl;
        $this->assertSame($expectedId, $slide->getBackgroundVideoID());
    }

    /**
     * @dataProvider videoUrlList
     */
    public function testGetFullScreenVideoID($videoUrl, $expectedId)
    {
        $slide = new PromoSlide();
        $slide->FullScreenVideo = $videoUrl;
        $this->assertSame($expectedId, $slide->getFullScreenVideoID());
    }
}
