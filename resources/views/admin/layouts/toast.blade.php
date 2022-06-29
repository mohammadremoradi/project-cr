@if (session('success'))

    <div class="toast"  style="position: absolute; top:0; right: 0; max-width: max-content !important;">
        <div class="toast-header">
            <strong class="mr-auto">Success</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>


<script>
    $(document).ready(function () {
        $('.toast').toast('show');
    })
</script>

@endif
