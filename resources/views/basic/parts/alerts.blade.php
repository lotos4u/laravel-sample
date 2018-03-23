@if (count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            {{ $error }}
        </div>
    @endforeach
@endif