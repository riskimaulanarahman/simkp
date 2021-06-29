<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/js/app.min.js"></script>
<script src="/assets/js/theme/default.min.js"></script>
<!-- ================== END BASE JS ================== -->

<script>
    $('.nospecial').bind('keypress', function (e) {
        // Filter non-digits from input value.
        if ($('.nospecial').val().length == 0) {
            if (e.which == 32) { //space bar
                e.preventDefault();
            }
        } else {
            $(this).val($(this).val().replace(/[^A-Za-z0-9_\s]/, ''))
            // alert('symbol yang di izinkan hanya ( _ space)');
        }
    });

    function submitForm(btn) {
        // disable the button
        btn.disabled = true;

        // submit the form    
        btn.form.submit();
    }

    function rollback(status,id) {
        if (confirm('Apakah anda yakin ingin rollback '+id+' ?')) {
            // Save it!
            $.getJSON(base_url+'/api/rollbackkp/'+status+'/'+id);
                location.reload();
                alert('rollback berhasil');
        } else {
            // Do nothing!
            console.log('cancel');
            location.reload();
        }
    }
    
</script>

@stack('scripts')