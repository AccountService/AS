<style>
    #myform {
        text-align: center;
        padding: 5px;
        border: 1px dotted #ccc;
        margin: 2%;
    }
    .qty {
        width: 40px;
        height: 25px;
        text-align: center;
    }
    input.qtyplus { width:25px; height:25px;}
    input.qtyminus { width:25px; height:25px;}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    jQuery(document).ready(function(){
        // This button will increment the value
        $('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
    });

</script>






<form id='myform' method='POST' action='#'>
    <input type='button' value='-' class='qtyminus' field='quantity' />
    <input type='text' name='quantity' value='0' class='qty' />
    <input type='button' value='+' class='qtyplus' field='quantity' />
</form>