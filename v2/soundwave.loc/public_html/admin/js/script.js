$(document).ready(function(){

    $('#price_day').on('input', function() 
    {
        var search = $(this).val();

        var num = search.replace(',', '.');

        num = parseFloat(num);

        var price_week = num * 7;

        $("#price_week").val(String(price_week));

    });

    $('#price_day_discount').on('input', function() 
    {
        var search = $(this).val();

        var num = search.replace(',', '.');

        num = parseFloat(num);

        var price_week = num * 7;

        $("#price_week_discount").val(String(price_week));

    });

    $( "#sortable" ).sortable();
  

    $( ".villa_auto" ).autocomplete({
        source: "/admin/api/Villas/Autocomplete/lvd43sdfgjow9skd9f",
        minLength: 2,
        autoFocus:true,
        select: function( event, ui ) {
            var hidden_txt_id = $(this).attr('name');
          $(this).val(ui.item.value);
          $("#" + hidden_txt_id).val(ui.item.id);
        }
    });   
    
    $(".datepicker").datepicker({
        dateFormat: "dd.mm.yy"
    });
});