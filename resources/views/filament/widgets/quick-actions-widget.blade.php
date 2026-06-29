<x-filament-widgets::widget>
    <x-filament::section heading="Quick Shortcuts">
        <div class="grid grid-cols-1 gap-3">
            
            <x-filament::button 
                href="{{ url('admin/perfumes/create') }}" 
                tag="a"
                icon="heroicon-o-sparkles" 
                color="primary"
                class="w-full text-left"
            >
                New Perfume Listing
            </x-filament::button>

            <x-filament::button 
                href="{{ url('admin/vendors/create') }}" 
                tag="a"
                icon="heroicon-o-shopping-cart" 
                color="success"
                class="w-full text-left"
            >
                Register Market Vendor
            </x-filament::button>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
