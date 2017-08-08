<div class="promooverlay<% if $IsOverlay %> promooverlay--isoverlay<% end_if %>"<% if $IsOverlay %> data-promo-overlay<% end_if %>>
    <% if $PromoSlides %>
        <div class="promooverlay__slides">
            <div id="promooverlay-backgroundplayer"></div>
            <div class="promooverlay__fullscreen-video">
                <a href="#" class="promooverlay__close-fullscreen">
                    Close video
                </a>
                <div id="promooverlay-fullscreenplayer"></div>
            </div>
            <% loop $PromoSlides %>
                <div class="promooverlay__slide<% if $BackgroundVideo %> promooverlay__slide--video<% end_if %><% if $First %> promooverlay__slide--active<% end_if %>"<% if $BackgroundVideo %> data-video="$BackgroundVideoID"<% end_if %>>
                    <% if $IsOverlay %>
                        <a href="#" class="promooverlay__close" data-promo-overlay-close>
                            Close
                        </a>
                    <% else %>
                        <a href="$BaseURL" class="promooverlay__close">
                            Home
                        </a>
                    <% end_if %>
                    <h3 class="promooverlay__slide-title">$Title</h3>
                    <div class="promooverlay__slide-content">
                        $Content
                    </div>
                    <% if $FullScreenVideoID %>
                        <a class="promooverlay__slide-play" href="#" data-video-id="{$FullScreenVideoID}">Play video</a>
                    <% end_if %>
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>
