<div>
    @if($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-75">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
                @if($edit)
                    <h2 class="text-2xl mb-4">Edit Supplier</h2>
                @else
                    <h2 class="text-2xl mb-4">Create Supplier</h2>
                @endif
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-100">Name:</label>
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border text-black rounded"
                            @if($edit) placeholder="{{$supplier->name}}" @endif>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-100">Address:</label>
                        <input type="text" id="address" wire:model="address" 
                            @if($edit) placeholder="{{$supplier->address}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-100">Phone:</label>
                        <input type="text" id="phone" wire:model="phone" 
                            @if($edit) placeholder="{{$supplier->phone}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-100">Email:</label>
                        <input type="text" id="email" wire:model="email" 
                            @if($edit) placeholder="{{$supplier->email}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
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

