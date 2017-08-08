# Promo Overlay

## Features

* Provides a Promo page type where Promo slides can be created
* Promo slides can be a basic slide with a title and content
* Promo slides can also be a video slide with a background video and fullscreen 
video pop up
* Ability for Promo page to appear as an overlay on initial visit, and when closed 
will not re-open until session has been reset

## Upcoming features

* Ability to carousel through multiple slides
# Ability to add a background image to a slide

## Installation

    `composer require nzta/promo-overlay`

## Setup

1. You will need to include the `PromoOverlay` template into your page.
2. You will then need to add the `JSAppData` to the `<head>` of your templates.
3. You will then need to include the `promooverlay.js` and `overlayvideo.js` javascript
files into your templates, either through `Requirements` or just adding them into 
your page templates directly.
4. You will then need to include the provided `promooverlay.css` and add some basic custom 
styles to make the overlays appear nicely.
