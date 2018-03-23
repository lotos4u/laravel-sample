@include('basic.parts.alerts')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    @yield('block-title')
                    <small>@yield('block-subtitle')</small>
                </h2>
                {{--@if(isset($block_actions))--}}
                    {{--@if (is_array($block_actions))--}}
                        {{--<ul class="header-dropdown m-r--5">--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                                   {{--aria-haspopup="true" aria-expanded="false">--}}
                                    {{--<i class="material-icons">more_vert</i>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu pull-right">--}}
                                    {{--@foreach($block_actions as $action)--}}
                                        {{--<li>{!! $action !!}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--@endif--}}
                {{--@endif--}}
            </div>
            <div class="body">
                @if(isset($block_elements))
                    {{--<ul class="nav nav-tabs" role="tablist">--}}
                        {{--<li role="presentation" class="active">--}}
                            {{--<a href="#entity_view_tab_general" data-toggle="tab">--}}
{{--                                @if(isset($tab_icon))<i--}}
                                        {{--class="material-icons">{{ $tab_icon }}</i>@endif {{ $tab_title_main }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--@if(isset($block_related_lists))--}}
{{--                            @foreach($block_related_lists as $key => $related)--}}
                                {{--<li role="presentation">--}}
                                    {{--<a href="#entity_view_tab_related_list_{{ $key }}" data-toggle="tab">--}}
{{--                                        @if(isset($related['tab_icon']))<i--}}
                                                {{--class="material-icons">{{ $related['tab_icon'] }}</i>@endif {{ $related['tab_title_related'] }}--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="entity_view_tab_general">
                            @if(isset($block_elements))
                                {!! Form::open(['route' => isset($model) ? [$model_name. '.update', $model['id']] : [$model_name. '.create']]) !!}
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($block_elements as $element)
                                        <tr>
                                            <td>{{ $element['title'] }}</td>
                                            <td>{!! $element['content'] !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row clearfix">
                                    <div class="col-12">
                                        {!! Form::submit(__('main.button_update'), ['class' => 'btn btn-primary waves-effect']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                        {{--@if(isset($block_related_lists))--}}
{{--                            @foreach($block_related_lists as $key => $related)--}}
                                {{--<div role="tabpanel" class="tab-pane fade" id="entity_view_tab_related_list_{{ $key }}">--}}
{{--                                    @include('basic.parts.list', $related)--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
