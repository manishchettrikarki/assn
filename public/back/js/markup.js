
function markup(){
    if($('#sitiType').is(':checked')){
        $('#sector').prop('disabled',true).prop('checked',false);
        $('#sectorForm').hide();
        $('#sotoType').prop('disabled',true);
    } else {
        $('#sector').prop('disabled',false);
        $('#sotoType').prop('disabled',false);
    }

    if($('#sotoType').is(':checked')){
        $('#sector').prop('disabled',true).prop('checked',false);
        $('#sectorForm').hide();
        $('#sitiType').prop('disabled',true);
    } else {
        $('#sector').prop('disabled',false);
        $('#sitiType').prop('disabled',false);
    }

    if($('#airline').is(':checked')){
        $('#airlineForm').show();

    } else {
        $('#airlineForm').hide();
    }

    if($('#class').is(':checked')){
        $('#classForm').show();
    } else {
        $('#classForm').hide();
    }

    if($('#tripType').is(':checked')){
        $('#tripTypeForm').show();
    } else {
        $('#tripTypeForm').hide();
    }

    if($('#sector').is(':checked')){
        $('#sectorForm').show();
    } else {
        $('#sectorForm').hide();
    }

}


$('#class,#airline,#tripType,#sector,#sitiType,#sotoType').on('click',function(){
   markup();
})
