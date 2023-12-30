@php
    $style = 'material-icons';
    if(isset($type)){
        switch ($type) {
            case 'outlined':
                $style = $style.'-outlined';
                break;
            case 'rounded':
                $style = $style.'-round';
                break;
            case 'sharp':
                $style = $style.'-sharp';
                break;
            case 'two-tone':
                $style = $style.'-two-tone';
                break;
        }
    }
    // https://material.io/resources/icons/?style=baseline
    // https://fonts.google.com/icons?selected=Material+Icons
    // https://fonts.google.com/icons?icon.query=home&icon.set=
    $num = '24';
    switch ($size) {
        case 'xs':
            $num = '18';
            break;
        case 'md':
            $num = '36';
            break;
        case 'lg':
            $num = '48';
            break;
    }
@endphp
<span style="font-size:{{ $num }}px;" class={{ $style }}>{{ $icon }}</span>
