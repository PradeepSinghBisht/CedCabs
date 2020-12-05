$(document).ready(function() {
    $('#pickup').change(function(){
        $('#booknow').css('display','none');
        var location = $('#pickup').val();
        $("#drop option[value='"+location+"']").prop('disabled','disabled').siblings().removeAttr('disabled');
        $('#fare').html('Calculate Fare');
    });

    $('#drop').change(function(){
        $('#booknow').css('display','none');
        var location = $('#drop').val();
        $("#pickup option[value='"+location+"']").prop('disabled','disabled').siblings().removeAttr('disabled');
        $('#fare').html('Calculate Fare');
    });

    $('#cabtype').change(function(){
        $('#booknow').css('display','none');
        $('#fare').html('Calculate Fare');
        var type = $('#cabtype').val();
        if (type == 'CedMicro') {
            $('#luggage').val('');
            $('#luggage').attr('placeholder', "No Luggage Allowed");
            $('#luggage').prop('disabled',true);
        } else {
            $('#luggage').attr('placeholder', "Luggage in KG");
            $('#luggage').prop('disabled',false);
        }
    });
    $('#luggage').keyup(function () {
        $("#fare").html("Calculate Fare");
        $("#booknow").css("display", "none");
        this.value = this.value.replace(/[^0-9\.]/g, '');
        });
        
        var original = '';
        $('#luggage').on('input', function () {
        if ($(this).val().replace(/[^.]/g, "").length > 1) {
        $(this).val(original);
        } else {
        original = $(this).val();
        }
    });

    $('#fare').click(function() {
        var pickup = $('#pickup').val();
        var drop = $('#drop').val();
        var cabtype = $('#cabtype').val();
        var luggage = $('#luggage').val();
        var fare = 'fare';
        if (pickup == '' || drop =='' || cabtype == ''){
            alert("Please Fill All Fields");
            return;
        }
        $('#booknow').css('display','block');
        $.ajax({
            url: "ajax.php",
            data: {fare, pickup, drop, cabtype, luggage},
            type: 'POST',
            dataType: 'html',
            success: function(result){
                $('#fare').html('Calculated Fare : Rs. '+result);
                total = result;
                console.log(total);
            }
        });
    });

    $('.book').click(function() {
        var pickup = $('#pickup').val();
        var drop = $('#drop').val();
        var cabtype = $('#cabtype').val();
        var luggage = $('#luggage').val();
        var booknow = "booknow";
        if (pickup == '' || drop =='' || cabtype == ''){
            alert("Please Fill All Fields");
            return;
        }
        $.ajax({
            url: "ajax.php",
            data: {booknow, pickup, drop, cabtype, luggage},
            type: 'POST',
            dataType: 'html',
            success: function(result){
                alert(result);
                $('#pickup').val('');
                $('#drop').val('');
                $('#cabtype').val('');
                $('#luggage').val('');
                window.location.href = "pendingrides.php";
            }
        });
    });
}); 