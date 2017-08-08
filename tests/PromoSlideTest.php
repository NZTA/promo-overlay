<?php

class PromoSlideTest extends SapphireTest
{

    /**
     * @var boolean
     */
    protected $usesDatabase = true;

    /**
     * List of youtube url variations to test video ID extraction.
     *
     * @var array
     */
    protected $videoUrlList = [
        'youtube.com/v/123',
        'youtube.com/vi/123',
        'youtube.com/?v=123',
        'youtube.com/?vi=123',
        'youtube.com/watch?v=123',
        'youtube.com/watch?vi=123',
        'youtu.be/123',
        'youtube.com/embed/123',
        'http://youtube.com/v/123',
        'http://www.youtube.com/v/123',
        'https://www.youtube.com/v/123',
        'youtube.com/watch?v=123&wtv=wtv',
        'http://www.youtube.com/watch?dev=inprogress&v=123&feature=related',
        'https://m.youtube.com/watch?v=123'
    ];

    public function testGetBackgroundVideoID()
    {
        $slide = new PromoSlide();
        $slide->Title = 'Test slide';
        $slide->write();

        foreach ($this->videoUrlList as $url) {
            $slide->BackgroundVideo = $url;
            $slide->write();

            $this->assertEquals('123', $slide->getBackgroundVideoID());
        }
    }

    public function testGetFullScreenVideoID()
    {
        $slide = new PromoSlide();
        $slide->Title = 'Test slide';
        $slide->write();

        foreach ($this->videoUrlList as $url) {
            $slide->FullScreenVideo = $url;
            $slide->write();

            $this->assertEquals('123', $slide->getFullScreenVideoID());
        }
    }

}
