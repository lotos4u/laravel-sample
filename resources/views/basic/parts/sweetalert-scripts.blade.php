<script type="text/javascript">
    //These codes takes from http://t4t5.github.io/sweetalert/
    $(function () {
        initSweetAlertButtons();
    });

    function initSweetAlertButtons(containerId) {
        var fixedClass = '{{ \App\Models\ActionFactory::CONFIRM_ACION_CLASS }}';
        var selector = containerId ? '#' + containerId + ' .' + fixedClass : '.' + fixedClass;
        $(selector).on('click', function () {
            var type = $(this).data('type');
            var url = $(this).data('url');
            var token = $(this).data('token');
            var method = $(this).data('method');
            if (type === 'basic') {
                showBasicMessage();
            }
            else if (type === 'with-title') {
                showWithTitleMessage();
            }
            else if (type === 'success') {
                showSuccessMessage();
            }
            else if (type === 'confirm') {
                showConfirmMessage();
            }
            else if (type === 'cancel') {
                showCancelMessage();
            }
            else if (type === 'with-custom-icon') {
                showWithCustomIconMessage();
            }
            else if (type === 'html-message') {
                showHtmlMessage();
            }
            else if (type === 'autoclose-timer') {
                showAutoCloseTimerMessage();
            }
            else if (type === 'prompt') {
                showPromptMessage();
            }
            else if (type === 'confirm-modal') {
                if (containerId) {
                    showGridItemDeleteConfirmation(containerId, url, token, method);
                } else {
                    showItemDeleteConfirmation(url, token, method);
                }
            }
        });
    }

    function showBasicMessage() {
        swal("Here's a message!");
    }

    function showWithTitleMessage() {
        swal("Here's a message!", "It's pretty, isn't it?");
    }

    function showSuccessMessage() {
        swal("Good job!", "You clicked the button!", "success");
    }

    function showConfirmMessage() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
    }

    function showCancelMessage() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    }

    function showWithCustomIconMessage() {
        swal({
            title: "Sweet!",
            text: "Here's a custom image.",
            imageUrl: "../../images/thumbs-up.png"
        });
    }

    function showHtmlMessage() {
        swal({
            title: "HTML <small>Title</small>!",
            text: "A custom <span style=\"color: #CC0000\">html<span> message.",
            html: true
        });
    }

    function showAutoCloseTimerMessage() {
        swal({
            title: "Auto close alert!",
            text: "I will close in 2 seconds.",
            timer: 2000,
            showConfirmButton: false
        });
    }

    function showPromptMessage() {
        swal({
            title: "An input!",
            text: "Write something interesting:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            swal("Nice!", "You wrote: " + inputValue, "success");
        });
    }

    function showItemDeleteConfirmation(url, token, method) {
        swal({
            title: "{{ __('modals.title_entity_delete') }}",
            text: "{{ __('modals.text_entity_delete') }}",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "{{ __('modals.title_button_confirm') }}",
            cancelButtonText: "{{ __('modals.title_button_cancel') }}",
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: method,
                url: url,
                data: {_token: token},
                success: function (response) {
                    return afterAjaxModal(true, response, function () {
                        if (response.success) {
                            console.log('success action');
                        }
                    });
                },
                error: function (response) {
                    return afterAjaxModal(false, response, function () {
                        console.log('error action');
                    });
                }
            });
        });
    }

    function showGridItemDeleteConfirmation(containerId, url, token, method) {
        swal({
            title: "{{ __('modals.title_entity_delete') }}",
            text: "{{ __('modals.text_entity_delete') }}",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "{{ __('modals.title_button_confirm') }}",
            cancelButtonText: "{{ __('modals.title_button_cancel') }}",
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                type: method,
                url: url,
                data: {_token: token},
                success: function (response) {
                    return afterAjaxModal(true, response, function () {
                        if (response.success) {
                            $('#' + containerId).bootgrid('reload');
                        }
                    });
                },
                error: function (response) {
                    return afterAjaxModal(false, response, function () {
                        console.log(response);
                    });
                }
            });
        });
    }

    function afterAjaxModal(success, response, callback) {
        var title = '{{ __('modals.title_success') }}';
        var type = 'success';
        if (!success || !response.success) {
            title = '{{ __('modals.title_error') }}';
            type = 'error';
        }
        var alertObject = {
            title: title,
            text: response.message,
            type: type,
//                        timer: 2000,
//                        showConfirmButton: false
        };
        if (success) {
        } else {
        }
        swal(alertObject, callback);
    }
</script>