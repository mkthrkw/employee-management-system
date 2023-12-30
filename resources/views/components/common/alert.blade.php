@php
    if(isset($type)){
        switch ($type) {
            case 'info':
                $add = 'alert-info';
                $icon = 'info';
                break;
            case 'success':
                $add = 'alert-success';
                $icon = 'check_circle';
                break;
            case 'warning':
                $add = 'alert-warning';
                $icon = 'warning_amber';
                break;
            case 'error':
                $add = 'alert-error';
                $icon = 'cancel';
                break;
        }
    }
@endphp

<div class='mx-5 {{ $additionalClasses ?? '' }}'>
    <div class="shadow-lg opacity-75 alert min-h-fit mx-auto py-2 max-w-2xl rouded-2xl {{ $add ?? '' }}">
        <x-common.material-icon :icon="$icon ?? 'info'" :size="$size ?? 'sm'" type='outlined'/>
        <span>{{ $message }}</span>
    </div>
</div>
