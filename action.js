$(document).ready(function() {
    $('#pickup').change(function(){
        var location = $('#pickup').val();
        $("#drop option[value='"+location+"']").prop('disabled','disabled').siblings().removeAttr('disabled');
        $('#fare').html('Calculate Fare');
    });

    $('#drop').change(function(){
        var location = $('#drop').val();
        $("#pickup option[value='"+location+"']").prop('disabled','disabled').siblings().removeAttr('disabled');
        $('#fare').html('Calculate Fare');
    });
    
    $('#cabtype').change(function(){
        $('#fare').html('Calculate Fare');
        var type = $('#cabtype').val();
        if (type == 'CedMicro') {
            $('#luggage').val('');
            $('#luggage').prop('disabled',true);
        } else {
            $('#luggage').prop('disabled',false);
        }
    });

    $("#luggage").keyup(function(){
        var w =$("#luggage").val();
        if(isNaN(w) == true) {
            alert("Interger Value Needed");
            $('#luggage').val('');
        }
    });
    
    $('#fare').click(function() {
        var pickup = $('#pickup').val();
        var drop = $('#drop').val();
        var cabtype = $('#cabtype').val();
        var luggage = $('#luggage').val();
        if (pickup == '' || drop =='' || cabtype == ''){
            alert("Please Fill All Fields");
            return;
        }
        $.ajax({
            url: "ajax.php",
            data: {pickup, drop, cabtype, luggage},
            type: 'POST',
            dataType: 'html',
            success: function(result){
                $('#fare').html('Calculated Fare : Rs. '+result);
            }
        });
    });
});