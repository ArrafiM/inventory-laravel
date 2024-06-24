@props([
    'type' => 'submit',
    'buttonStyle' => 'default',
    'buttonType' => 'default',
])

@php
  $bStyle = '';
  $bType = '';

  switch ($buttonStyle) {
      case 'primary':
          $bStyle = 'text-white bg-primary hover:bg-primary focus:ring-primary';
          break;
      case 'success':
          $bStyle = 'text-white bg-success hover:bg-success focus:ring-success ';
          break;
      case 'warning':
          $bStyle = 'text-white bg-warning hover:bg-warning focus:ring-warning ';
          break;
      case 'danger':
          $bStyle = 'text-white bg-danger hover:bg-danger focus:ring-danger ';
          break;
      default:
          $bStyle = 'text-white bg-stroke hover:bg-stroke focus:ring-stroke ';
          break;
  }

  switch ($buttonType) {
      case 'outline':
          switch ($buttonStyle) {
              case 'primary':
                  $bStyle = 'border border-primary text-primary hover:bg-primary hover:text-white focus:ring-primary ';
                  break;
              case 'success':
                  $bStyle = 'border border-success text-success hover:bg-success hover:text-white focus:ring-success ';
                  break;
              case 'warning':
                  $bStyle = 'border border-warning text-warning hover:bg-warning hover:text-white focus:ring-warning ';
                  break;
              case 'danger':
                  $bStyle = 'border border-danger text-danger hover:bg-danger hover:text-white focus:ring-danger ';
                  break;
              default:
                  $bStyle =
                      'border border-onStroke text-onStroke hover:bg-onStroke hover:text-white focus:ring-stroke ';
                  break;
          }
          break;

      default:
          $bType = '';
          break;
  }

@endphp

<button
  {{ $attributes->merge(['type' => $type, 'class' => "$bStyle $bType font-medium rounded-full text-sm px-5 py-2.5 text-center focus:outline-none focus:ring-4 transition ease-in-out duration-150"]) }}>
  {{ $slot }}
</button>
