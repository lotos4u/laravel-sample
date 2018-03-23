<script type="text/javascript">

    initMultiSelectElements();

    function initMultiSelectElements() {
        var elementSelector = '.' + '{{ \App\Models\FormFactory::MULTI_SELECT_CLASS }}';
        var options = {
            selectableOptgroup: true,
            selectableHeader: '@include("basic.forms.multiselect.selectable-header")',
            selectionHeader: '@include("basic.forms.multiselect.selection-header")',
            selectableFooter: '@include("basic.forms.multiselect.selectable-footer")',
            selectionFooter: '@include("basic.forms.multiselect.selection-footer")'
        };
        $(elementSelector).multiSelect(options);
    }
</script>