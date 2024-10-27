<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- Show affiliate link -->
                    @if ($affiliateLink)
                        <div class="mt-4">
                            <strong>Your Affiliate Link:</strong>
                            <div>
                                <a href="{{ route('affiliate.link', ['unique_code' => $affiliateLink->unique_code]) }}" target="_blank">
                                    {{ url('/ref/' . $affiliateLink->unique_code) }}
                                </a>

                            </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <strong>You don't have an affiliate link yet.</strong>
                        </div>
                    @endif

                    <!-- Section to display commissions -->
                    <div class="mt-12">
                        <h2 class="font-semibold text-xl">Your Commissions</h2>

                        @if($commissions->isEmpty())
                            <p>No commissions earned yet.</p>
                        @else
                            <table class="min-w-full bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mt-4">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($commissions as $commission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $commission->order_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($commission->commission_amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($commission->status) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
