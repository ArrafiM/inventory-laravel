<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col-span-12">
            <h2 class="text-3xl font-medium text-gray-100">Item <span class="font-normal text-secondary">/ transaction</span></h2>
        </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("Item management") }} --}}
                    <div class="grid grid-cols-12 gap-3 px-4 py-6 space-y-5">
                    

                    <div class="col-span-12 p-2 rounded-md space-y-5">
                        <div class="flex flex-row justify-between items-center">
                            {{-- <x-button buttonStyle="primary" onclick="Livewire.dispatch('openForm')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-7 rounded">
                                <x-icon-plus class="text-white w-4 h-4" />
                                    <span>
                                    Add New Tranasction
                                    </span>
                            </x-button> --}}
                            <a href="{{ route('dashboard.item.transaction.create') }}" wire:navigate>
                                <x-button buttonStyle="primary" class="flex flex-row items-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-7 rounded">
                                    <x-icon-plus class="text-white w-4 h-4" />
                                    <span>
                                    Add New Transaction
                                    </span>
                                </x-button>
                            </a>
                            <form class="max-w-md">
                                <x-search-input model="search" />
                            </form>
                        </div>
                        {{-- <livewire:pages.item.transaction.TransactionAction /> --}}
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
                                    {{-- <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">
                                        Action
                                    </th> --}}
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
                                        {{-- <td class="whitespace-nowrap py-2">
                                        <div class="flex flex-row items-center gap-3">
                                            <x-button wire:click='editForm({{ $item->id }})'
                                             class="inline-block w-fit bg-green-600 hover:bg-green-700 px-1 py-1">
                                                <x-badge class="flex items-center bg-primary w-fit ">
                                                    <x-icon-edit /><span class="text-white ms-2">Edit</span>
                                                </x-badge>
                                            </x-button>
                                            <x-button type="submit" class="inline-block w-fit bg-red-700 hover:bg-red-900 px-1 py-1"
                                             wire:click='delete({{ $item->id }} )'>
                                                <x-badge class="flex items-center bg-danger w-fit">
                                                <x-icon-trash /><span class="text-white ms-2">Delete</span>
                                                </x-badge>
                                            </x-button>
                                        </div>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                {{ $transactions->links() }}
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
