<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#skins" data-toggle="tab">{{ __('main.menu_skins') }}</a></li>
        <li role="presentation"><a href="#settings" data-toggle="tab">{{ __('main.menu_settings') }}</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
            <ul class="demo-choose-skin">
                @each('basic.parts.switch-skin', $user_shared_data['theme_colors'], 'theme_color')
            </ul>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="settings">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            @include('basic.forms.settings')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>