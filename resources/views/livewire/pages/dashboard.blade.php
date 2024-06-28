    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="grid grid-cols-12 gap-3 px-4 py-6 space-y-5">
        <div class="col-span-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                
            </div>
        </div>
        <div class="col-span-4 rounded-lg h-36 flex flex-row items-center justify-around 
        bg-white dark:bg-gray-600">
            <div class="flex flex-col gap-3 ">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Total Item / Stok</h3>
            <p class="text-4xl font-semibold text-blue-900 dark:text-blue-500">
            {{ $summary['item'] ?? 0 }} / {{$summary['stok'] ?? 0}}</p>
            </div>
            <div>
            <x-icon-box />
            </div>
        </div>
        <div class="col-span-4 rounded-lg h-36 flex flex-row items-center justify-around 
        bg-white dark:bg-gray-600">
            <div class="flex flex-col gap-3">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Item Stok Masuk</h3>
            <p class="text-4xl font-semibold text-green-900 dark:text-green-500 ">{{  $summary['masuk'] ?? 0 }}</p>
            </div>
            <div>
            <x-icon-masuk />
            </div>
        </div>
        <div class="col-span-4 rounded-lg h-36 flex flex-row items-center justify-around 
        bg-white dark:bg-gray-600">
            <div class="flex flex-col gap-3">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Item Stok Keluar</h3>
            <p class="text-4xl font-semibold text-red-900 dark:text-red-500">{{  $summary['keluar'] ?? 0 }}</p>
            </div>
            <div>
            <x-icon-keluar />
            </div>
        </div>
        <div class="col-span-12">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-xl font-bold">Last 10 Transaction</h3>
                            <div class="grid grid-cols-12 gap-3 px-4 py-6 space-y-5">
                                <div class="col-span-12 p-2 rounded-md space-y-5">
                                    <div class="flex flex-row justify-between items-center">
                                    <form class="max-w-md">
                                    </form>
                                </div>
                                <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden shadow">
                                        <table class="min-w-full divide-y-2 divide-stroke table-fixed">
                                        <thead>
                                            <tr>
                                            <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">
                                                Item Id
                                            </th>
                                            <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">
                                                Name
                                            </th>
                                            <th scope="col" class="text-sm pb-2 font-semibold text-center uppercase">
                                                Status
                                            </th>
                                            <th scope="col" class="text-sm pb-2 font-semibold text-center uppercase">
                                                qty
                                            </th>
                                            <th scope="col" class="text-sm pb-2 font-semibold text-center uppercase">
                                                supplier_id
                                            </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-stroke" >
                                            @foreach ($transactions as $item)
                                            <tr class="hover:bg-strodivide-stroke " style="height: 50px">
                                                <td class="text-sm font-medium whitespace-nowrap py-2">{{ $item->item_id }}
                                                </td>
                                                <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">
                                                {{ $item->item->name ?? '-' }}
                                                </td>
                                                @if($item->status === 1)
                                                <td class="text-sm font-medium whitespace-nowrap py-2 ">
                                                    <p style="background-color: green; border-radius: 10px; text-align: center; padding:20;">
                                                    Masuk</p></td>
                                                @else
                                                <td class="text-sm font-medium whitespace-nowrap py-2">
                                                    <p style="background-color: #B22222; border-radius: 10px; text-align: center; padding:20;">
                                                    Keluar</p></td>
                                                @endif
                                                <td class="text-sm font-medium whitespace-nowrap py-2 text-center">{{ $item->qty }}
                                                </td>
                                                <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary text-center">
                                                {{ $item->supplier->name ?? '-' }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    console.log(@json($summary));
    console.log(@json($transactions));
    </script>
    
