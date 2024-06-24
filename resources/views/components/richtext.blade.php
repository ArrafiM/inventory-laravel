@props(['name', 'model'])

<textarea id="ckeditor" name="{{ $name }}" wire:model.defer="{{ $model }}"></textarea>
@push('script')
  <script>
    ClassicEditor.create(document.querySelector("#ckeditor"), {
      ckfinder: {
        uploadUrl: '{{ route('upload-image') . '?_token=' . csrf_token() }}',
      },
    }).then(editor => {
      editor.model.document.on('change:data', () => {
        @this.set('{{ $model }}', editor.getData());
      })
      // document.querySelector('#ckeditor').addEventListener("change:data", () => {
      //   @this.set('{{ $model }}', editor.getData());
      // });
    }).catch(error => console.error(error))
  </script>
@endpush
