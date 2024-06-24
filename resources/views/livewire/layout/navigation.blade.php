<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-500 col-span-12 sticky top-0 z-10">
  <!-- Primary Navigation Menu -->
  <div class="">
    <div class="h-16 grid grid-cols-12 items-center justify-between">
      <div class="col-span-2 flex flex-row">
        <div class="flex items-center ps-8">
          <a href="{{ route('dashboard') }}" wire:navigate>
            <h1 class="text-3xl text-gray-100 font-bold">Inventory</h1>
          </a>
        </div>
      </div>

      {{-- <div class="col-span-9">
        <form class="max-w-md">
          <x-search-input model="" />
        </form>
      </div> --}}

      <!-- Settings Dropdown -->
      <div class="col-span-10 hidden ms-auto sm:flex sm:items-center ">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button
              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  bg-white dark:bg-gray-800 focus:outline-none transition ease-in-out duration-150">
              <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
              {{-- <div class="h-8 w-8 bg-secondary rounded-full" x-text="name"
                x-on:profile-updated.window="name = $event.detail.name"></div> --}}

              <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile')" wire:navigate>
              Profile
            </x-dropdown-link>

            <button wire:click="logout" class="w-full text-start">
              <x-dropdown-link>
                Log Out
              </x-dropdown-link>
            </button>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
        Dashboard
      </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200 ">
      <div class="px-4">
        <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
          x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile')" wire:navigate>
          Profile
        </x-responsive-nav-link>

        <button wire:click="logout" class="w-full text-start">
          <x-responsive-nav-link>
            Log Out
          </x-responsive-nav-link>
        </button>
      </div>

    </div>
  </div>
</nav>