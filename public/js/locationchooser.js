$(document).ready(function(){
    $.get( "/countries", function( data ) {
        $('.countryOption').append('<option></option>');
        $('.countryOption').append('<option value="231"> United States</option>');
        value = $('.countryOption').attr("val");
        $.each(data,function(index,stateObject){
            if(value == stateObject.id){
                appende = '<option  value="'+stateObject.id+'" selected>'+stateObject.name + '</option>';
            }
            else{
                appende = '<option  value="'+stateObject.id+'">'+stateObject.name + '</option>';
            }
            $('.countryOption').append(appende);
        });

        country = $( ".countryOption" ).val();
        loadState(country)
    });

    $('.countryOption').change(function(element){
        $('.stateOption').html('');
        $('.cityOption').html('');
        loadState(this.value)
    })

    $('.stateOption').change(function(element){
        $('.cityOption').html('');
        loadCity(this.value)
    })

});

function loadState(country){
  $.get( "/country/states/"+country, function( data ) {
    $('.stateOption').append('<option></option>');
    value = $('.stateOption').attr("val");
    $.each(data,function(index,stateObject){
        //console.log(value,stateObject.id)
        if(value == stateObject.id){
            $('.stateOption').append('<option  value="'+stateObject.id+'" selected>'+ stateObject.name + '</option>');
        }else{
            $('.stateOption').append('<option  value="'+stateObject.id+'">'+ stateObject.name + '</option>');
        }
    });

    state = $( ".stateOption" ).val();
    loadCity(state)
  })
}


function loadCity(state){
  $.get( "/state/cities/"+state, function( data ) {
    //$('.cityOption').
    value = $('.cityOption').attr("val");
    $('.cityOption').append('<option></option>');
        $.each(data,function(index,stateObject){
            if(value == stateObject.id){
                $('.cityOption').append('<option  value="'+stateObject.id+'"selected>'+stateObject.name + '</option>');
            }else{
                $('.cityOption').append('<option  value="'+stateObject.id+'">'+stateObject.name + '</option>');
            }
        });    
    //loadData()
  });
}