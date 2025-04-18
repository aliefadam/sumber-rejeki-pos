@if (session('notification'))
    @php
        $text = session('notification')['text'];
        $title = session('notification')['title'];
        $icon = session('notification')['icon'];
    @endphp
    <script>
        Swal.fire({
            icon: '{{ $icon }}',
            title: '{{ $title }}',
            text: '{{ $text }}',
            showConfirmButton: true,
            // confirmButtonColor: '#0f766e',
        })
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            showConfirmButton: true,
            // confirmButtonColor: '#0f766e',
        })
    </script>
@endif
