<div {{ $attributes }}>
    @switch($slot)
        @case($slot == 'error_method')
        {{ __('Упс. Ошибка неверный метод !') }}
        @break
        @case($slot == 'error_form_empty')
        {{ __('Упс. Ошибка Вы не заполнили поля !') }}
        @break
        @case($slot == 'error_type_image')
        {{ __('Упс. Ошибка неверный тип файла (должен быть webp,jpeg,jpg,gif,png) !') }}
        @break
    @endswitch
</div>
