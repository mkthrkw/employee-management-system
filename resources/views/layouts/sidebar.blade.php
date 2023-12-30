<aside class='fixed z-50 flex flex-col h-screen px-4 py-3 overflow-y-auto w-44 bg-base-200 border-e-4 border-base-300'>
    <a href='/' class='mb-0'>
        <x-application-logo size='sm' />
    </a>

    <nav class='flex flex-col justify-between flex-1 my-2'>
        <div class='-mx-3 space-y-4'>

            @can('gate','gate2')
            <div class='space-y-1'>
                <label class='px-3 py-0 text-xs uppercase'>Basic</label>
                <x-common.icon-link icon='group' text='Account' :href="route('account.index')" nav="True" />
            </div>
            @endcan

            @can('gate','gate4')
            <div class='space-y-1'>
                <label class='px-3 py-0 text-xs uppercase'>Device</label>
                <x-common.icon-link icon='desktop_windows' text='DesktopPC' :href="route('desktop_pc.index')" nav="True" />
                <x-common.icon-link icon='laptop' text='LaptopPC' :href="route('laptop_pc.index')" nav="True" />
                <x-common.icon-link icon='smartphone' text='MobilePhone' :href="route('mobile_phone.index')" nav="True" />
            </div>
            @endcan

            @can('gate','gate4')
            <div class='space-y-1'>
                <label class='px-3 py-0 text-xs uppercase'>Manage</label>
                <x-common.icon-link icon='mail' text='MailingList' :href="route('mailing_list.index')" nav="True" />
                <x-common.icon-link icon='visibility' text='BcRoute' :href="route('bc_route.index')" nav="True" />
                <x-common.icon-link icon='business' text='Department' :href="route('department.index')" nav="True" />
            </div>
            @endcan

            @can('gate','gate8')
            <div class='space-y-1'>
                <label class='px-3 py-0 text-xs uppercase'>Develop</label>
                <x-common.icon-link icon='developer_mode' text='SQL' :href="route('develop.sql.get')" nav="True" />
            </div>
            @endcan

        </div>

        <div class='-mx-3 space-y-1'>
            <label class='px-3 py-0 text-xs uppercase'>user</label>

            <p class='flex items-center px-3 py-1'>
                <x-common.material-icon icon='account_circle' size='sm' type='outlined'/>
                <span class='mx-1 text-sm font-medium opacity-95'>{{ Auth::user()->name }}</span>
            </p>

            <x-modal.theme/>

            <form method='post' name='logout' action={{ route('logout') }}>
                @csrf
                <x-common.icon-link icon='logout' text='Logout' href="javascript:logout.submit()" />
            </form>
        </div>

    </nav>
</aside>
