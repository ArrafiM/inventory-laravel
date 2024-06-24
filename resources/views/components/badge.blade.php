@props(['type' => 'default'])
@php
  $badge = '';
  switch ($type) {
      case 'primary':
          $badge = 'bg-onPrimary text-primary ';
          break;
      case 'success':
          $badge = 'bg-onSuccess text-success ';
          break;
      case 'warning':
          $badge = 'bg-onWarning text-warning ';
          break;
      case 'danger':
          $badge = 'bg-onDanger text-danger ';
          break;
      default:
          $badge = ' ';
          break;
  }
@endphp

<span
  {{ $attributes->merge(['class' => "$badge text-sm font-medium px-2.5 py-1.5 rounded-full"]) }}>{{ $slot }}</span>
