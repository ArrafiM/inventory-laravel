<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-span-12">
                <h2 class="text-3xl font-medium text-gray-100">Item 
                    <a href="{{ route('dashboard.item.transaction') }}" wire:navigate>
                        <span class="font-normal text-secondary hover:text-white/60 hover:ring-black/20">
                            / transaction
                        </span>
                    </a>
                    <span class="font-normal text-secondary">/ create</span>
                </h2>
            </div>

            <!-- Table for selecting items -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-12 gap-3 px-4 py-6 space-y-5">
                        <div class="col-span-12 p-2 rounded-md space-y-5">
                            <div class="flex flex-row justify-between items-center">
                                <p class="flex flex-row items-center gap-2 bg-white text-black font-bold py-2 px-7 rounded">
                                    Pilih Item pada tabel di bawah
                                </p>
                                <form class="max-w-md">
                                    <x-search-input model="search" />
                                </form>
                            </div>
                            <livewire:pages.item.list.ItemListAction />

                            <!-- Item Selection Table -->
                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden shadow">
                                            <table class="min-w-full divide-y-2 divide-stroke table-fixed">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Id</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Name</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Type</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Description</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Category</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">stok</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">satuan</th>
                                                        <th scope="col" class="text-sm pb-2 font-semibold text-left uppercase">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-stroke">
                                                    @foreach ($items as $item)
                                                    <tr class="hover:bg-strodivide-stroke">
                                                        <td class="text-sm font-medium whitespace-nowrap py-2">{{ $item->id }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->name }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->type }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->description }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->category->name }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->stok->total ?? '0' }}</td>
                                                        <td class="text-sm font-medium whitespace-nowrap py-2 text-secondary">{{ $item->satuan ?? '-' }}</td>
                                                        <td class="whitespace-nowrap py-2">
                                                            @if($selectedItemId == $item->id)
                                                            <span class="text-green-500">Selected</span>
                                                            @else
                                                            <x-button type="submit" class="inline-block w-fit bg-blue-700 hover:bg-blue-900 px-1 py-1" wire:click="selectItem({{ $item->id }}, '{{$item->name}}')">
                                                                <x-badge class="flex items-center bg-primary w-fit">
                                                                    <x-icon-check />
                                                                </x-badge>
                                                            </x-button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $items->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <!-- Transaction Create Form -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form wire:submit.prevent="submitForm">
                            <!-- Field Item ID (untouched from previous setup) -->
                            <div class="mb-4">
                                <label for="item_id" class="block text-gray-100">Item: {{$itemName}}</label>
                                <div class="flex items-center">
                                    <input type="text" id="item_id" wire:model="item_id" class="w-full px-3 py-2 border text-black rounded" readonly>
                                    @if ($item_id)
                                        <x-button type="button" class="ml-2 bg-red-500 hover:bg-red-700 px-3 py-2 text-white" wire:click="clearItemId">Cancel</x-button>
                                    @endif
                                </div>
                                @error('item_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                           

                            <!-- Rest of the form fields -->
                            <div class="mb-4">
                                <label for="status" class="block text-gray-100">Status:</label>
                                <select wire:model="status" id="status" class="w-full px-3 py-2 border rounded form-control text-gray-500">
                                    <option value="">-- Choose a Category --</option>
                                    <option value="1">Masuk</option>
                                    <option value="2">Keluar</option>
                                </select>
                                @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                             <!-- Field Supplier ID with "Pilih" Button -->
                            @if($showSupplierField)
                            <div class="mb-4" id="supplier_field">
                                <label for="supplier_id" class="block text-gray-100">Supplier: {{ $supplierName }}</label>
                                <div class="flex items-center">
                                    <input type="text" id="supplier_id" wire:model="supplier_id" class="w-full px-3 py-2 border text-black rounded" readonly>
                                    <x-button type="button" class="ml-2 bg-blue-500 hover:bg-blue-700 px-3 py-2 text-white" wire:click="openSupplierModal">Pilih</x-button>
                                </div>
                                @error('supplier_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            @endif

                            <div class="mb-4">
                                <label for="qty" class="block text-gray-100">Qty:</label>
                                <input type="text" id="qty" wire:model="qty" class="w-full px-3 py-2 border text-black rounded form-control">
                                @error('qty') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-row categories-center gap-3 justify-end">
                                <x-button type="button" class="inline-block w-fit bg-green-600 hover:bg-green-700 px-1 py-1" wire:click='submitForm'>
                                    Create
                                </x-button>
                                <x-button type="button" wire:click="closeForm" class="inline-block w-fit bg-red-700 hover:bg-red-900 px-1 py-1">
                                    Close
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal for Supplier Selection -->
                @if($showSupplierModal)
                <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <!-- Modal Content -->
                        <div class="inline-block align-bottom bg-white  rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="flex flex-row justify-between items-center">
                                    <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">
                                        Pilih Supplier
                                    </h3>
                                    <form class="max-w-md">
                                        <x-search-input model="searchSupplier" />
                                    </form>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                            @foreach($suppliers as $supplier)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $supplier->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $supplier->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <x-button type="button" class="bg-blue-500 hover:bg-blue-700 text-white" wire:click="selectSupplier({{ $supplier->id }} , '{{$supplier->name}}')">Pilih</x-button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $suppliers->links() }}
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <x-button type="button" class="bg-red-500 hover:bg-red-700 text-white" wire:click="closeSupplierModal">Tutup</x-button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
 <script>
 console.log(@json($items));
        $(document).ready(function() {
            $('#status').change(function(){
                var selectedValue = $(this).val();
                console.log(selectedValue);
                if (selectedValue === '1') {
                    @this.set('showSupplierField', true);   // Menghapus supplierName di Livewire
                } else {
                    @this.set('supplier_id', null);    // Menghapus supplier_id di Livewire
                    @this.set('supplierName', null);   // Menghapus supplierName di Livewire
                    @this.set('showSupplierField', false);   // Menghapus supplierName di Livewire
                }
            });
        });
    </script>