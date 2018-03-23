<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            @if(isset($list_title) || isset($list_subtitle))
                <div class="header">
                    <h2>
                        @if(isset($list_title))
                            {{ $list_title }}
                        @endif
                        @if(isset($list_subtitle))
                            <small>{{ $list_subtitle }}</small>
                        @endif
                    </h2>
                    @include('basic.parts.block-actions')
                </div>
            @endif
            <div class="body">
                {{--@if (count($models) > 0)--}}
                <table id="{{ $grid_id }}" class="table table-condensed table-hover table-striped" data-ajax="true"
                       data-url="{{ $api_url }}">
                    <thead>
                    <tr>
                        @foreach($titles as $item)
                            <th {!! $item['settings'] !!}>{{ $item['title'] }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {{--@else--}}
                {{--{{ __('main.string_nodata') }}--}}
                {{--@endif--}}
            </div>
        </div>
    </div>
</div>