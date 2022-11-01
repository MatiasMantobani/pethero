<?php
require_once('nav.php');
?>
<form action="<?php echo FRONT_ROOT ?>AvailableDate/Update/" method="post">
    <h4>Formato: YYYY-MM-DD</h4>

    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: "YYYY-MM-DD",
                    separator: ','
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <input type="text" name="daterange" />

    <button type="submit">ENVIAR</button>

</form>