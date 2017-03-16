/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$( document ).ready( function () 
{
    old_zip_code = '';
    
    function getAddress(zip_code)
    {
        var url = 'https://viacep.com.br/ws/'+zip_code+'/json/';
        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function() 
            {
                old_zip_code = zip_code;
                $("#loader-zip-code").removeClass('hide');
            },
            success: function(res){
                if(res !== false){
                    $("#address").val(res.logradouro);
                    $("#district").val(res.bairro);
                    $("#city").val(res.localidade);
                    $("#state").val(res.uf);
                    $("#number").val('');
                    $("#complemet").val('');
                    if(res.Logradouro == ''){
                        $("#address").focus();
                    }else{
                        $("#number").focus();
                    }
                
                }else{
                    $("#address").focus();
                }
            },
            dataType: "json",
            async: true
        }).always(function() {
                $("#loader-zip-code").addClass('hide');
        });
    }
    
    function maskPhone(event)
    {
        var target, phone, element;  
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
        phone = target.value.replace(/\D/g, '');  
        element = $(target);  
        element.unmask();  
        if(phone.length > 10) {  
                element.mask( "(99) 99999-999?9" );  
        } else {  
                element.mask( "(99) 9999-9999?9" );  
        }
    }
    
    if ($( ".phone" ).length > 0) {
        $( ".phone" ).mask( "(99) 9999-9999?9" ).on( 'focusout, keyup' , function (event) {  
            var check = $(this).val();
            check = check.replace(/\D/g, '');
            if(check.length >= 10){
                maskPhone(event);
            }
        });

        $.each($(".phone"), function(){
            var phone = $(this).val().replace(/\D/g, '');
            if(phone.length > 10) {  
                    $(this).unmask();
                    $(this).mask("(99) 99999-999?9");  
            }
        });
    }
    
    if ($( ".zip-code" ).length > 0) {
        $( ".zip-code" ).mask("99999-999");
        $( ".zip-code" ).keyup( function() 
        {
            var zip_code = $(this).val();
            
        });
        
        $("#zip-code").focusout(function(){
            var zip_code = $(this).val().replace('_','');
            if(zip_code.replace('-','').length == 8 && zip_code != old_zip_code){
                getAddress(zip_code.replace('-',''));
            }
	}).keyup(function(){
            var zip_code = $(this).val().replace('_','');
            if(zip_code.replace('-','').length == 8){
                getAddress(zip_code.replace('-',''));
            }
	});
    }
    
    if ($( ".uf" ).length > 0) {
        $( ".uf" ).keyup( function () 
        {
            $(this).val($(this).val().toUpperCase());
        });
    }
    
    if ($(".dynamic-list").length > 0) {
        $(".dynamic-list").dynamiclist({
            autoClearNewRow: true,
            btnAdd: function (dynamiclist, settings) 
            {
                $( ".phone" ).unmask().unbind( 'focusout, keyup' );
                
                var newRow = dynamiclist.find('.'+settings.listContainerClass+' .'+settings.rowClass+':first').clone(true, true);
                newRow.find('input.phone').attr('id', Date.now());
                newRow.find('input').val('');
                $.each(newRow.find('select'), function(){// force select the first option
                    $(this).val($(this).find('option:first').val()).trigger('change');
                });
                newRow.find("input[name^='phone_id']").remove();
                dynamiclist.find('.'+settings.listContainerClass).append(newRow);
                
                $.each(dynamiclist.find('.phone'), function(){
                    var phone = $(this).val().replace(/\D/g, '');
                    if(phone.length > 10) {
                        $(this).mask("(99) 99999-999?9");  
                    }else{
                        $(this).mask("(99) 9999-9999?9");
                    }
                });
                
                dynamiclist.find('.phone').on( 'focusout, keyup' , function (event) {  
                    var check = $(this).val();
                    check = check.replace(/\D/g, '');
                    if(check.length >= 10){
                        maskPhone(event);
                    }
                });
            }
        });
    }
    
    if($("form#deleteContact").length > 0){
        $("form#deleteContact").submit(function (e) {
            e.preventDefault();
            if(confirm("Tem certeza que deseja excluir este contato?")){
                $(this).unbind('submit').submit();
            }
        });
    }
});