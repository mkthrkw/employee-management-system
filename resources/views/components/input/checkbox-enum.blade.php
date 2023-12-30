<div class='w-full mb-3 form-control'>
    <label class='py-0 label'>
        <span class='font-medium px-7 rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5'>{{ $label }}</span>
    </label>
    <div class='flex flex-wrap'>
        @foreach ($cases as $case)
            <label class='justify-start py-2 mr-3 cursor-pointer label'>
                <span class='mr-1 text-ms label-text'>{{ $case->label() }}</span>
                <input type='checkbox' class='rounded checkbox checkbox-sm border border-1 border-base-content/40' name='{{ $name }}[]' value={{ $case->value }} @if($value && in_array($case->value,$value)) checked @endif>
            </label>
        @endforeach
    </div>
</div>
