<div class="flex flex-col items-center justify-center py-24 text-center bg-white rounded-3xl border border-gray-100 shadow-sm">
    <div class="p-6 bg-danger-50 rounded-3xl text-danger-600 mb-6 ring-8 ring-danger-50/50">
        <x-heroicon-o-lock-closed class="h-12 w-12" />
    </div>
    
    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Access Restricted</h2>
    
    <p class="mt-4 text-gray-500 max-w-sm font-medium leading-relaxed">
        Your facility's subscription is currently <span class="text-danger-600 font-bold underline">{{ strtoupper($tenant->subscription_status) }}</span>. 
        Analytics and management tools are hidden for security.
    </p>

    <div class="mt-10 flex flex-col gap-4 w-full max-w-xs">
        <x-filament::button
            size="xl"
            color="primary"
            tag="a"
            href="{{ \App\Filament\Pages\Billing::getUrl() }}"
            icon="heroicon-m-bolt"
            class="font-black rounded-2xl shadow-xl shadow-primary-200"
        >
            Activate Premium Now
        </x-filament::button>
        
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
            Choose a plan to unlock all features
        </p>
    </div>
</div>
