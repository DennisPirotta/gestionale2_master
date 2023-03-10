<x-app-layout>
    @vite('resources/scss/app.scss')
    <x-slot name="path">
        <x-breadcrumb-element route="dashboard.index" :title="__('Dashboard')"/>
    </x-slot>

    <x-loading-animation />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-menu-exchange-card :exchanges="$exchanges"/>
        <x-menu-recent-activities />
        <x-menu-order-status :statuses="$orders_statuses"/>
        <x-menu-employees-hours :hours="$employees_hours" />
        <x-menu-unapproved-holidays :holidays="$holidays" />

        <div class="bg-yellow-200"></div>
    </div>

</x-app-layout>
