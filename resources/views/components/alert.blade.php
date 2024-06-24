@props(['type' => 'default'])

@php
  $alert = '';
  switch ($type) {
      case 'primary':
          $alert = 'text-primary bg-onPrimary';
          break;

      case 'success':
          $alert = 'text-success bg-onSuccess';
          break;

      case 'warning':
          $alert = 'text-warning bg-onWarning';
          break;

      case 'danger':
          $alert = 'text-danger bg-onDanger';
          break;

      default:
          $alert = ' ';
          break;
  }
@endphp

<div class="p-4 mb-4 text-sm  rounded-lg {{ $alert }}" role="alert">
  <span class="font-medium">{{ $slot }}</span>
</div>
