@php if(empty($official)){$official = false;} @endphp

<div class='w-full mb-3 form-control'>
    <label class='py-0 mb-1 label'>
        <span class='font-medium px-7 rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5'>{{ $label }}</span>
    </label>
    <select name={{ $name }} class="w-full max-w-xs py-0 select select-bordered select-sm border border-1 border-base-content/40 rounded-xl">
        @foreach ($cases as $case)
            <option value='{{ $case->value }}'
                @if(isset($selected) && $case->value == $selected) selected @endif>
                {{ ($official) ? $case->label_official() : $case->label() }}
            </option>
        @endforeach
    </select>
</div>
