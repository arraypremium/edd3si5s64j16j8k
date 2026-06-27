<x-filament-panels::page>
    @php
        $headerData = $this->getHeaderData();
        $plans = $this->plans;
        $status = $headerData['status'];
        $isRestricted = in_array($status, ['expired', 'none']);
    @endphp

    <div class="space-y-8">
        {{-- Status Alert --}}
        @if($isRestricted)
            <div @class([
                'flex items-center gap-5 p-6 border-l-8 rounded-3xl shadow-sm',
                'bg-danger-50 border-danger-500 text-danger-900' => $status === 'expired',
                'bg-gray-50 border-gray-500 text-gray-900' => $status === 'none',
            ])>
                <div @class([
                    'p-4 rounded-2xl shadow-inner',
                    'bg-danger-100 text-danger-600' => $status === 'expired',
                    'bg-gray-200 text-gray-600' => $status === 'none',
                ])>
                    <x-heroicon-m-shield-exclamation class="h-8 w-8" />
                </div>
                <div>
                    <h4 class="text-lg font-black uppercase tracking-tight">Action Required</h4>
                    <p class="text-sm font-medium opacity-75">
                        {{ $status === 'expired' 
                            ? "Your premium access has expired. Renew your plan to unlock dashboard data." 
                            : "Welcome! Please subscribe to a plan to start using your gym management portal." }}
                    </p>
                </div>
            </div>
        @endif

        {{-- Current Status Overview --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-filament::card class="text-center p-6 border-none shadow-sm bg-white rounded-3xl">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Plan</p>
                <p class="text-xl font-black text-gray-900">{{ $headerData['plan_name'] }}</p>
            </x-filament::card>

            <x-filament::card class="text-center p-6 border-none shadow-sm bg-white rounded-3xl">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                <x-filament::badge :color="match($status) { 'active' => 'success', 'expired' => 'danger', default => 'gray' }" size="lg" class="font-black px-6">
                    {{ strtoupper($status) }}
                </x-filament::badge>
            </x-filament::card>

            <x-filament::card class="text-center p-6 border-none shadow-sm bg-white rounded-3xl">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Expires On</p>
                <p class="text-xl font-black {{ $status === 'expired' ? 'text-danger-600' : 'text-gray-900' }}">
                    {{ $headerData['expiry_date'] ?? 'N/A' }}
                </p>
            </x-filament::card>
        </div>

        {{-- Plan Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($plans as $plan)
                <div @class([
                    'flex flex-col p-8 bg-white border-2 rounded-[2rem] transition-all duration-300 relative',
                    'border-primary-500 shadow-2xl ring-4 ring-primary-50' => $plan->name === $headerData['plan_name'] && $status === 'active',
                    'border-gray-100 hover:border-primary-200 hover:shadow-xl' => $plan->name !== $headerData['plan_name'] || $status !== 'active',
                ])>
                    <div class="text-center flex-grow">
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">{{ $plan->name }}</h3>
                        <div class="mt-6 flex items-center justify-center gap-1">
                            <span class="text-5xl font-black text-primary-600">₹{{ number_format($plan->amount, 0) }}</span>
                            <span class="text-xs font-bold text-gray-400 uppercase">/ {{ $plan->days }} days</span>
                        </div>
                        <div class="mt-6 text-sm font-medium text-gray-500 leading-relaxed border-t border-gray-50 pt-6 px-4 italic">
                            {{ $plan->description }}
                        </div>
                    </div>

                    <x-filament::button
                        size="xl"
                        class="mt-10 font-black rounded-2xl shadow-lg"
                        color="{{ $plan->name === $headerData['plan_name'] && $status === 'active' ? 'gray' : 'primary' }}"
                        icon="heroicon-m-bolt"
                    >
                        {{ $plan->name === $headerData['plan_name'] && $status === 'active' ? 'Active Plan' : 'Buy Subscription' }}
                    </x-filament::button>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
