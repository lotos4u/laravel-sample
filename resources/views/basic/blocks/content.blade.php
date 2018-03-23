<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    @yield('block-title')
                    <small>@yield('block-subtitle')</small>
                </h2>
                @include('basic.parts.block-actions')
            </div>
            <div class="body">
                @if(isset($block_elements))
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#entity_view_tab_general" data-toggle="tab">
                                @if(isset($tab_icon))<i
                                        class="material-icons">{{ $tab_icon }}</i>@endif {{ $tab_title_main }}
                            </a>
                        </li>
                        @if(isset($block_related_lists))
                            @foreach($block_related_lists as $key => $related)
                                <li role="presentation">
                                    <a href="#entity_view_tab_related_list_{{ $key }}" data-toggle="tab">
                                        @if(isset($related['tab_icon']))<i
                                                class="material-icons">{{ $related['tab_icon'] }}</i>@endif {{ $related['tab_title_related'] }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="entity_view_tab_general">
                            @if(isset($block_elements))
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{ __('main.parameter_name_title') }}</th>
                                        <th>{{ __('main.parameter_value_title') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($block_elements as $element)
                                        <tr>
                                            <td>{{ $element['title'] }}</td>
                                            <td>{{ $element['content'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        @if(isset($block_related_lists))
                            @foreach($block_related_lists as $key => $related)
                                <div role="tabpanel" class="tab-pane fade" id="entity_view_tab_related_list_{{ $key }}">
                                    @include('basic.parts.list', $related)
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
