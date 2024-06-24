<div class=" dark:bg-gray-800 shadow-sm col-span-2 border-r border-slate-500">
  <div class="sticky top-[64px] py-5">
    <div class="flex-1 px-3 space-y-1  dark:bg-gray-800 divide-y divide-gray-200">
      <ul class="ml-5 pb-2 space-y-2">
        {{-- @can('create ticket')
          <li>
            <a href="{{ route('dashboard.tickets.create') }}" wire:navigate
              class="flex items-center py-2 px-4 text-base font-medium {{ request()->is('dashboard/create-ticket') ? 'bg-gray-100' : '' }} rounded-full hover:bg-gray-100 group w-max border border-primary">
              <x-icon-plus class="w-4 h-4 text-primary" />
              <span class="ml-2 text-primary" sidebar-toggle-item>Create Ticket</span>
            </a>
          </li>
        @endcan --}}
        <li>
          <a href="{{ route('dashboard') }}" wire:navigate
            class="flex items-center p-2 text-base font-medium text-gray-100 {{ request()->is('dashboard') ? 'bg-gray-500' : '' }} rounded-lg hover:bg-gray-600 group">
            <x-icon-sidebar class="w-6 h-6 fill-white" />
            <span class="ml-2" sidebar-toggle-item>Dashboard</span>
          </a>
        </li>
        
        {{-- <li>
          <a href="{{ route('dashboard.tickets') }}" wire:navigate
            class="flex items-center p-2 text-base font-medium text-gray-900 {{ request()->is('dashboard/tickets') ? 'bg-gray-100' : '' }} rounded-lg hover:bg-gray-100 group">
            <x-icon-file-minus class="w-4 h-4" />
            <span class="ml-2" sidebar-toggle-item>Tickets</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.technical-queries') }}" wire:navigate
            class="flex items-center p-2 text-base font-medium text-gray-900 {{ request()->is('dashboard/technical-queries') ? 'bg-gray-100' : '' }} rounded-lg hover:bg-gray-100 group">
            <x-icon-database class="w-4 h-4" />
            <span class="ml-2" sidebar-toggle-item>Technical Queries</span>
          </a>
        </li> --}}
        {{-- @if (Auth::user()->hasRole('TSEL')) --}}
          <li>
            <button type="button"
              class="flex items-center w-full p-2 text-base font-medium text-gray-100 transition duration-75 rounded-lg group hover:bg-gray-600 {{ request()->is('dashboard/item/*') ? 'bg-gray-500' : '' }}"
              aria-controls="dropdown-item" data-collapse-toggle="dropdown-item">
              <x-icon-settings class="w-4 h-4 fill-white" />
              <span class="ml-2" sidebar-toggle-item>Item</span>
              <svg sidebar-toggle-item class="w-6 h-6 ms-auto" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <ul id="dropdown-item"
              class="space-y-2 py-2 {{ request()->is('dashboard/item/*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('dashboard.item.list') }}" wire:navigate
                  class="text-base text-gray-100 rounded-lg flex items-center p-2 group hover:bg-gray-600 transition duration-75 pl-11 {{ request()->is('dashboard/item/list*') ? 'bg-gray-500' : '' }}">
                  List</a>
              </li>
              <li>
                <a href="{{ route('dashboard.item.category') }}" wire:navigate
                  class="text-base text-gray-100 rounded-lg flex items-center p-2 group hover:bg-gray-600 transition duration-75 pl-11 {{ request()->is('dashboard/item/category*') ? 'bg-gray-500' : '' }}">
                  Category</a>
              </li>
              <li>
                <a href="{{ route('dashboard.item.supplier') }}" wire:navigate
                  class="text-base text-gray-100 rounded-lg flex items-center p-2 group hover:bg-gray-600 transition duration-75 pl-11 {{ request()->is('dashboard/item/supplier*') ? 'bg-gray-500' : '' }}">
                  Supplier</a>
              </li>
              <li>
                <a href="{{ route('dashboard.item.transaction') }}" wire:navigate
                  class="text-base text-gray-100 rounded-lg flex items-center p-2 group hover:bg-gray-600 transition duration-75 pl-11 {{ request()->is('dashboard/item/transaction*') ? 'bg-gray-500' : '' }}">
                  Transaction</a>
              </li>
            </ul>
          </li>
        {{-- @endif --}}
      </ul>
    </div>
  </div>
</div>
{{-- @if (Auth::user()->hasRole('TSEL'))
  @push('script') --}}
    <script>
      // Dropdown menu
      document.querySelector("button[aria-controls=dropdown-item]").addEventListener('click', () => {
        document.querySelector('#dropdown-item').classList.toggle('hidden')
      });
    </script>
  {{-- @endpush
@endif --}}
