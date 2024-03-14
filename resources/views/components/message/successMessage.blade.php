<div {{ $attributes }}>
    @switch($slot)
        @case($slot == 'success')
        {{ __('Поздравляю. Вы добавили новые изображения !') }}
        @break
    @endswitch
</div>
