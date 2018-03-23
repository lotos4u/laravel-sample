{!! Form::open(['route' => 'user.settings.update']) !!}
@foreach($user_shared_data['settings_form_data'] as $data_key => $form_data)
    <div class="row clearfix">
        <div class="col-12">
            <b>{{ __('main.form_title_settings_' . $data_key) }}</b>
            @if (isset($form_data['values']))
                {!! Form::select($data_key, $form_data['values'], $form_data['current'], ['class' => 'form-control show-tick']) !!}
            @else
            @endif
        </div>
    </div>
@endforeach
<div class="row clearfix">
    <div class="col-12">
        {!! Form::submit(__('main.button_update'), ['class' => 'btn btn-default waves-effect']) !!}
    </div>
</div>
{!! Form::close() !!}
