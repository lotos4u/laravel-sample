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
                </div>
            @endif
            <div class="body">
                @if (count($models) > 0)
                    <table id="{{ $grid_id }}" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            @foreach($titles as $item)
                                <th {!! $item['settings'] !!}>{{ $item['title'] }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                @foreach($fields as $field)
                                    @if(is_array($field))
                                        @foreach($field as $subfield)
                                            <td>{{ $subfield }}</td>
                                        @endforeach
                                    @else
                                        <td>@if(isset($model[$field])){{$model[$field]}}@endif</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    {{ __('main.string_nodata') }}
                @endif
            </div>
        </div>
    </div>
</div>