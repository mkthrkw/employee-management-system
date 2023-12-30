<div class='w-full mb-3 form-control'>
    <label class='py-0 label'>
        <span class='font-medium px-7 rounded-xl bg-base-content/50 label-text text-base-100 pt-0.5'>{{ $label }}</span>
    </label>
    <div class='flex flex-row gap-10 mt-1 ml-1'>
        @foreach ($cases as $case)
            <div class='gap-4'>
                <input type="radio" name="display_type" class="radio" value="{{ $case['value'] }}" @if($case['value'] == $checked ) checked @endif />
                <span class='text-base align-middle'>{{ $case['name'] }}</span>
            </div>
        @endforeach
    </div>
</div>
