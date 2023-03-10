<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <x-sidebar-element icon="bi-bar-chart"        :title="__('Dashboard')"            route="dashboard.index" />
            <x-sidebar-element icon="bi-clipboard-plus"   :title="__('Orders')"               route="dashboard.index" />
            <x-sidebar-element icon="bi-globe2"           :title="__('Locations')"            route="dashboard.index" />
            <x-sidebar-element icon="bi-clock-history"    :title="__('Hours Management')"     route="hours.index" :parameters="['month' => \Carbon\Carbon::now()->format('Y-m'), 'user' => auth()->id()]" />
            <x-sidebar-element icon="bi-calendar-week"    :title="__('Holidays')"             route="dashboard.index"/>
            <x-sidebar-element icon="bi-people"           :title="__('Customers')"            route="dashboard.index"/>
            <x-sidebar-element icon="bi-journals"         :title="__('Orders Report')"        route="dashboard.index"/>
            <x-sidebar-element icon="bi-person-workspace" :title="__('Employees Management')" route="dashboard.index"/>
            <x-sidebar-element icon="bi-rocket-takeoff"   :title="__('Planning')"             route="dashboard.index"/>
        </ul>
    </div>
</aside>
