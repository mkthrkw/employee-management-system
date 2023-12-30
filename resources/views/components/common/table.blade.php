<div {{ $attributes->merge(['class' => 'overflow-x-auto border border-4 shadow-2xl rounded-xl border-base-300']) }}>
    <table class='table w-full [&_*]:text-center [&_tr]:border-base-300 [&_td]:p-1 [&_tr]:border-y-2 first:[&_thead>tr]:border-t-0 last:[&_tr]:border-b-0'>
        <!-- head -->
        <thead>
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>
