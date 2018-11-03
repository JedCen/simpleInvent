<div class="row">
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fab fa-facebook-square', 'Facebook', array('class' => 'btn btn-block btn-social btn-facebook')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitter']), 'fab fa-twitter', 'Twitter', array('class' => 'btn btn-block btn-social btn-twitter')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fab fa-google-plus', 'Google +', array('class' => 'btn btn-block btn-social btn-google')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fab fa-github', 'GitHub', array('class' => 'btn btn-block btn-social btn-github')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'youtube']), 'fab fa-youtube', 'YouTube', array('class' => 'btn btn-block btn-social btn-youtube btn-danger')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitch']), 'fab fa-twitch', 'Twitch', array('class' => 'btn btn-block btn-social btn-twitch btn-info')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'instagram']), 'fab fa-instagram', 'Instagram', array('class' => 'btn btn-block btn-social btn-instagram')) !!}
    </div>
    <div class="col-sm-6 mb-2">
        {!! HTML::icon_link(route('social.redirect',['provider' => '37signals']), 'fa fa-signal', 'Basecamp', array('class' => 'btn btn-block btn-social btn-basecamp btn-warning')) !!}
    </div>
</div>
