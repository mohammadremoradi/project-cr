@if (session('swal-error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'خطا ',
                text: '{{ session('swal-error') }}',
                icon: 'error',
                confirmButtonText: 'ok',
            });
        });
    </script>
@endif


@if (session('swal-error-phone'))
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Is the format of this number incorrect??',
                text: '{{ $client->phone }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.dismiss != "cancel") {

                    $.ajax({
                        url: "{{ route('client.response', $client->id) }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                        },
                        data: {
                            response: "format"
                        },
                        contentType: 'application/json; charset=utf-8',
                        success: function(response) {
                            if (response.status) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your client has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location.replace(
                                        "{{ route('admin.index') }}");

                                });
                            }
                        }


                    });
                }
            });
        });
    </script>
@endif
