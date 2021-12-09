<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.svg')">
    <!-- Add Sidebar Menu Items Here -->
    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="fas fa-home"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Setting" :link="route('setting')" icon="fas fa-cogs"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Department" :link="route('department')" icon="fas fa-building"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Users" :link="route('users')" icon="fas fa-users"></x-maz-sidebar-item>
</x-maz-sidebar>