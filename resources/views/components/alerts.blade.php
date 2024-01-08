@switch(true)
    @case(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @break

    @case(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops... Algo Salio Mal',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @break

    @case(session('deleted'))
        <script>
            Swal.fire({
                position: "bottom-start",
                width: "25rem",
                //agregar una altura a la alerta
                heightAuto: true,
                icon: 'warning',
                title: 'Éxito',
                text: '{{ session('deleted') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @break
@endswitch
