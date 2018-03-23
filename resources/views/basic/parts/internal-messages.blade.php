@if(Session::has('flash_temporary'))
    <script>
        @foreach(Session::get('flash_temporary') as $key => $msg)
        document.addEventListener("DOMContentLoaded", function (event) {
            var colorName = 'alert-{{ $key }}';
            var text = "{{ $msg }}";
            var placementFrom = 'top';
            var placementAlign = 'center';
            var animateEnter = '';
            var animateExit = '';
            var allowDismiss = true;
            var timeout = '{{ $user_shared_data['temporary_messages_timeout'] }}';
            showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit, allowDismiss, timeout);
        });
        @endforeach
    </script>
@endif
@if(Session::has('flash_fixed'))
    @foreach(Session::get('flash_fixed') as $key => $msg)
        <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            {{ $msg }}
        </div>
    @endforeach
@endif
