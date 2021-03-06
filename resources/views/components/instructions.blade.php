@php
    $page = $page ?? null;
@endphp
<div id="modal-instructions" class="modal">
    <div class="custom-modal-content container">
        <h3 class="text-center">Mga Tagubilin</h3>
        <br>
        <p>{{ $instructions }}</p>
        <a href="#" class="close-btn"> <i class="fa fa-times"></i> Close</a>
        <a href="#" class="close-on-this-device" data-item="basamunapopstate{{ $page }}"> <i class="fa fa-times"></i> Close and do not show again</a>
    </div>
</div>
@if(isset( $display_on_load ) && $display_on_load == true)
    <script>
        $(document).ready(function(){
            let itemname = 'basamunapopstate' + "{{ $page }}";
            if(localStorage.getItem(itemname) != 'shown'){
                $('#modal-instructions').fadeIn();
            }
        });
    </script>
@endif