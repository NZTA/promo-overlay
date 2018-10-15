# Promo Overlay

## Requirements
SilverStripe 4.x

## Version info
The master branch of this module is currently aiming for SilverStripe 4.x compatibility

* [SilverStripe 3.0+ compatible version](https://github.com/NZTA/promo-overlay/tree/1.0.1)

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

1. You will need to include the `<% include PromoOverlay IsOverlay=true,PromoSlides=$ActivePromoSlides %>` template into your page.
2. You will then need to add the `<% include JSAppData %>` to the `<head>` of your templates.
3. Add some basic custom styles to make the overlays appear nicely.

## Usage

1. Login to the CMS and create a 'PromoPage'
2. Enter a title and content
3. Ensure to tick 'Active Promo page' to enable this promo page on the front-end
4. Add a 'PromoSlide' by clicking on the 'Promo Slides' tab and clicking 'Add new promo slide'
5. Enter a title, content and embedded video links
