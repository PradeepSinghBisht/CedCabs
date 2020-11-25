function function1(id) {
    var id = id;
    console.log(id);
    $.ajax({
        url: 'ajax.php',
        data: {id},
        type: 'POST',
        dataType: 'html',
        success: function(result){

        }
    })
    
}