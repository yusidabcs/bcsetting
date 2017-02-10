<hr>
<div class="form-group">
    {!! Form::label($settingName, trans($moduleInfo['description'])) !!}
    <div class="checkbox">
        <?php foreach ($moduleInfo['options'] as $value => $optionName): ?>
        <label for="{{ $optionName }}">
            <input id="{{ $optionName }}"
                   name="{{ $settingName }}"
                   class="currency"
                   data-value="{{$optionName}}"
                   type="radio"
                   class="flat-blue"
                   {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == $value ? 'checked' : '' }}
                   value="{{ $value }}"
                    {{ isset($moduleInfo['default']) && $moduleInfo['default'] == $value ? 'checked' : '' }}
            />

            {{ trans($value) }}
        </label>
        <?php endforeach; ?>
            <input type="hidden" class="currency_symbol" name="{{ $settingName.'_symbol' }}" value="{{ isset($dbSettings[$settingName.'_symbol']) ? $dbSettings[$settingName.'_symbol']->plainValue : $moduleInfo['options'][$moduleInfo['default']]}}">
    </div>
</div>
<script>
    console.log($("input[name='core::currency']"));
    $(".currency").on('change',function (e) {
        $('.currency_symbol').val($(this).data('value'));
    });

</script>