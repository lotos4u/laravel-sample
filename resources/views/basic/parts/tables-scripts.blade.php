@if(isset($grid_ids))
    <script src="{{ asset('grid/jquery.bootgrid.js') }}"></script>
    <script type="text/javascript">
        function init_bootgrid_instance(grid_id, api_token) {
            var searchTimeoutContainer = {};
            var grid = $("#" + grid_id).bootgrid({
                searchSettings: {
                    delay: 150,
                    characters: 1
                },
                ajaxSettings: {
                    method: "POST",
                    cache: false
                },
                post: function () {
                    return {
                        'api_token': api_token
                    };
                },
                labels: {
                    all: '{{ __('grid.string_all') }}',//	This label is used in the row count selection box
                    infos: '{{ __('grid.string_infos') }}',//This label is used by default in the footer section to provide helpful informations regarding the table content.
                    loading: '{{ __('grid.string_loading') }}', //This label shows up in async scenarios while data is loading.	Loading...
                    noResults: '{{ __('grid.string_noresults') }}', //This message is shown in the table content part when no data rows are available.	No results found!
                    refresh: '{{ __('grid.string_refresh') }}', //Tooltip for the refresh button.	Refresh
                    search: '{{ __('grid.string_search') }}' // Placeholder text for the search field.Search
                },
                rowCount: [@foreach($rows_per_page_options as $val)'{{ $val }}', @endforeach ],
                requestHandler: function (request) {
                    request = addSearchDataToRequest(request, grid_id);
                    return request;
                },
                responseHandler: function (response) {
                    addFiltersFromResponse(searchTimeoutContainer, response, grid_id)
                    return response;
                },
                templates: {
                    search: "",
                    headerCell: getHeaderTemplate(grid_id)
                }
            });
            return grid;
        }

        function addSearchDataToRequest(request, gridId) {
            request.grid_id = gridId;
            $('.bootgrid-column-search-input').each(function (index, element) {
                var columnId = $(element).data("columnid");
                var inputGridId = $(element).data("gridid");
                var columnValue = element.value;
                if (columnValue && request && inputGridId == gridId) {
                    if (typeof request.search === 'undefined') {
                        request.search = {};
                    }
                    request.search[columnId] = columnValue;
                }
            });
            return request;
        }

        function addFiltersFromResponse(searchTimeoutContainer, response, gridId) {
            if (response.hasOwnProperty('filters')) {
                var filters = response['filters'];
                for (var property in filters) {
                    addFilterElement(searchTimeoutContainer, filters, property, gridId);
                }
            }
        }

        function addFilterElement(timeouts, filters, property, gridId) {
            if (filters.hasOwnProperty(property)) {
                var selector = '#' + gridId +  '-header-' + property;
                var inputSelector = '#column-search-' + gridId + '-' + property;
                if (!$(inputSelector).length && $(selector).length) {
                    $(selector).append(filters[property]);
                    initFiltersElement(timeouts, inputSelector);
                }
            }
        }

        function getHeaderTemplate(gridId) {
            var template = '@include(config('grid.header_template'))';
            template = template.replace('{{ config('grid.grid_id_placeholder') }}', gridId);
            return template;
        }

        function initFiltersElement(timeouts, element) {
            $(element).on('input', function (event) {
                var elementId = $(this)[0].id;
                if (timeouts.hasOwnProperty(elementId)) {
                    clearTimeout(timeouts[elementId]);
                }
                var grid = $(this).data('gridid');
                timeouts[elementId] = setTimeout(function () {
                    $('#' + grid).bootgrid('reload');
                }, 1000);
            });
        }

        function initInternalGridJs(gridId) {
            initSweetAlertButtons(gridId);
        }

        @foreach($grid_ids as $current_grid_id => $grid_data)
            var grid = init_bootgrid_instance("{{$current_grid_id}}", "{{ $grid_data['api_token'] }}");
            grid.on("loaded.rs.jquery.bootgrid", function()
            {
                initInternalGridJs("{{$current_grid_id}}");
            });
        @endforeach
    </script>
@endif

