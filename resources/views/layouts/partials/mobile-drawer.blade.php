<button class="hidden" type="button" data-drawer-target="drawer-swipe" data-drawer-show="drawer-swipe" data-drawer-placement="bottom" data-drawer-edge="true" data-drawer-edge-offset="bottom-[60px]" aria-controls="drawer-swipe"></button>
<div id="drawer-swipe" class="block md:hidden fixed z-40 w-full overflow-y-auto bg-white border-t border-gray-200 rounded-t-lg dark:border-gray-700 dark:bg-gray-800 transition-transform bottom-0 left-0 right-0 translate-y-full bottom-[60px]" tabindex="-1" aria-labelledby="drawer-swipe-label">
    <div class="p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700" data-drawer-toggle="drawer-swipe">
        <span class="absolute w-8 h-1 -translate-x-1/2 bg-gray-300 rounded-lg top-3 left-1/2 dark:bg-gray-600"></span>
        <h5 id="drawer-swipe-label" class="inline-flex items-center text-base text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"></path></svg>Menu</h5>
    </div>
    <div class="grid grid-cols-3 gap-4 p-4 lg:grid-cols-4">
        <x-mobile-drawer-element icon="bi-bar-chart"        :title="__('Dashboard')"            route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-clipboard-plus"   :title="__('Orders')"               route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-globe2"           :title="__('Locations')"            route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-calendar-week"    :title="__('Holidays')"             route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-people"           :title="__('Customers')"            route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-rocket-takeoff"   :title="__('Planning')"             route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-clock-history"    :title="__('Hours Management')"     route="hours.index" :parameters="['month' => \Carbon\Carbon::now()->format('Y-m'), 'user' => auth()->id()]"/>
        <x-mobile-drawer-element icon="bi-journals"         :title="__('Orders Report')"        route="dashboard.index"/>
        <x-mobile-drawer-element icon="bi-person-workspace" :title="__('Employees Management')" route="dashboard.index"/>
    </div>
</div>
