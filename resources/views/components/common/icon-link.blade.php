@php
    if(!isset($href)){$href = '#';}
    $add_class = '';
    $disabled = '';
    if(isset($nav) && $nav){
        $current = explode('/',substr(url()->current(),strlen(url()->to('/'))+1))[0];
        $link = explode('/',substr($href,strlen(url()->to('/'))+1))[0];
        if($current == $link){
            $add_class = 'bg-primary text-primary-content';
        }
    }
    if(isset($center) && $center){
        $add_class .= ' justify-center';
    }
@endphp

<a class='flex items-center px-3 py-1 transition-colors duration-300 transform rounded-lg hover:bg-primary hover:text-primary-content opacity-90 {{ $add_class }}' href={{ $href }}>
    <x-common.material-icon :icon="$icon ?? 'home'" :size="$size ?? 'sm'" type='outlined'/>
    <span class='mx-1 text-{{ $size ?? 'sm' }} font-medium'>{{ $text ?? 'ボタン' }}</span>
</a>
