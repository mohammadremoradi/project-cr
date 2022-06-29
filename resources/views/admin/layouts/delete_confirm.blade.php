<script>
    $(document).ready(function() {
        var className = '{{ $className }}'
        var element = $('.' + className);

        element.on('click', function(e) {

            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({

                title: 'Are you sure?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Cancel`,

                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {

                if (result.value == true) {
                    $(this).parent().submit();
                }

            });

        });

    });
</script>
