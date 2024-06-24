<div>
    @if($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-75">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
                @if($edit)
                    <h2 class="text-2xl mb-4">Edit Item Transaction</h2>
                @else
                    <h2 class="text-2xl mb-4">Create Item Transaction</h2>
                @endif
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="item_id" class="block text-gray-100">Item:</label>
                        <input type="text" id="item_id" wire:model="item_id" class="w-full px-3 py-2 border text-black rounded"
                            @if($edit) placeholder="{{$transactionData->item_id}}" @endif>
                        @error('item_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-gray-100">Status:</label>
                        <select wire:model="status" id="status" 
                            class="w-full px-3 py-2 border rounded form-control text-gray-500">
                            {{-- @if($edit)
                            <p>Selected Category ID: </p>
                                <option value={{$transactionData->status}}>{{ $items->category->name }}</option>
                            @else --}}
                                <option value="">-- Choose a Category --</option>
                            {{-- @endif --}}
                            {{-- @foreach($categories as $category) --}}
                                <option value="1">Masuk</option>
                                <option value="2">Keluar</option>
                            {{-- @endforeach --}}
                        </select>
                        @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="qty" class="block text-gray-100">Qty:</label>
                        <input type="text" id="qty" wire:model="qty" 
                            @if($edit) placeholder="{{$transactionData->qty}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('qty') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="supplier_id" class="block text-gray-100">Supplier:</label>
                        <input type="text" id="supplier_id" wire:model="supplier_id" 
                            @if($edit) placeholder="{{$transactionData->supplier_id}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('supplier_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-row categories-center gap-3 justify-end">
                        @if($edit)
                            <x-button type="button" class="inline-block w-fit bg-green-600 hover:bg-green-700 px-1 py-1" wire:click='editData' >
                                Edit
                            </x-button>
                        @else
                            <x-button type="button" class="inline-block w-fit bg-green-600 hover:bg-green-700 px-1 py-1" wire:click='submitForm'>
                                Create
                            </x-button>
                        @endif
                        <x-button type="button" wire:click="closeForm" class="inline-block w-fit bg-red-700 hover:bg-red-900 px-1 py-1">
                            Close
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

