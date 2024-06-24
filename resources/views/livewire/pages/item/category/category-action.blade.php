<div>
    @if($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-75">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
                @if($edit)
                    <h2 class="text-2xl mb-4">Edit Category</h2>
                @else
                    <h2 class="text-2xl mb-4">Create Category</h2>
                @endif
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-100">Name:</label>
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border text-black rounded"
                            @if($edit) placeholder="{{$category->name}}" @endif>
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-100">Description:</label>
                        <input type="text" id="description" wire:model="description" 
                            @if($edit) placeholder="{{$category->description}}" @endif
                            class="w-full px-3 py-2 border text-black rounded form-control">
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
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

