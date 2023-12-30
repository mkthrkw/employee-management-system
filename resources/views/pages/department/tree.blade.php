<div class="flex-col">
    @foreach ($children as $index => $child)
        @php
            $top_space = false;
            if($child->parent_id){
                $border = "border-dotted border-base-content/30 my-1";
            }else{
                $border = "border-solid border-base-content/50";
                if($index > 0)$top_space = true;
            }
        @endphp
        @if($top_space)<div class="h-5"></div>@endif
        <div class="flex items-center justify-between px-4 py-2 border border-2 rounded-2xl {{ $border }}">
            <div tabindex="0" class="lg:min-w-[150px] xl:min-w-[200px] 2xl:min-w-[250px]">
                <div class="flex items-center gap-1">
                    <div class="px-1 py-0 mb-1 text-xs rounded-2xl text-base-100 bg-base-content/50">D{{ $child->depth }}</div>
                    <div class="text-sm font-bold">{{ $child->name }}</div>
                </div>
                <div class="flex-col">
                    @foreach ($child->members as $member)
                        <div class="text-sm">{{ $member->name }}</div>
                    @endforeach
                </div>
            </div>
            @if ($child->children->count() > 0)
                @include('pages.department.tree',['children' => $child->children])
            @endif
        </div>
    @endforeach
</div>
