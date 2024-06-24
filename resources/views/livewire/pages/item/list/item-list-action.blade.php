<div>
    @if($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-75">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
                @if($edit)
                    <h2 class="text-2xl mb-4">Edit Item</h2>
                @else
                    <h2 class="text-2xl mb-4">Create Item</h2>
                @endif
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-100">Name:</label>
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border text-black rounded"
                            @if($edit) placeholder="{{$items->name}}" @endif>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-100">Type:</label>
                        <input type="text" id="type" wire:model="type" 
                            @if($edit) placeholder="{{$items->type}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-100">Description:</label>
                        <input type="text" id="description" wire:model="description" 
                            @if($edit) placeholder="{{$items->description}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-gray-100">Category:</label>
                        <select wire:model="selectedCategoryId" id="category" 
                            class="w-full px-3 py-2 border rounded form-control text-gray-500">
                            @if($edit)
                            <p>Selected Category ID: </p>
                                <option value={{$items->category_id}}>{{ $items->category->name }}</option>
                            @else
                                <option value="">-- Choose a Category --</option>
                            @endif
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                            @if ($selectedCategoryId)
                                <p>Selected Category ID: {{ $selectedCategoryId }}</p>
                            @endif
                            @error('selectedCategoryId') <span class="text-red-500">{{ $message }}</span> @enderror
                        <div class="mb-4">
                            <label for="satuan" class="block text-gray-100">Satuan:[box,dus,biji,pak,karung,dll]</label>
                            <input type="text" id="satuan" wire:model="satuan" 
                                @if($edit) value="{{$items->satuan}}" @endif
                                class="w-full px-3 py-2 border text-black rounded form-control">
                            @error('satuan') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
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

