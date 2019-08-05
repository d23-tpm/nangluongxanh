$(document).ready(function() {
$('#moveleft').click(function(event) {
    $('#MenuchildrengroupMenuChildId option').attr({
      selected: 'selected'
    });
  });
$('#moveright').click(function(event) {
    $('#MenuchildrengroupMenuChildId option').attr({
      selected: 'selected'
    });
  });

$( "input.datepicker" ).datepicker({
 dateFormat: 'dd/mm/yy',
 altFormat: 'Y-m-d'
});
$('.add-product-form [type="submit"]').on('click', function () {
    $('#success').show().delay(500).fadeOut();
});

    //tooltip
    
    $(".tip-top").tooltip({placement : 'top'});
    $(".tip-right").tooltip({placement : 'right'});
    $(".tip-bottom").tooltip({placement : 'bottom'});
    $(".tip-left").tooltip({ placement : 'left'});

//add record
  var max_fields      = 10; //maximum input boxes allowed

    var x = 1; //initlal text box count
    $('.add_field_button').click(function(e){ //on add input button click
      e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $('#MenuchildTree').val(x);
            $('.input_fields_wrap').append('<fieldset><legend>Record '+x+'</legend><div class="input text"><input name="data[Menuchild][menuname'+x+']" placeholder="Menu Name" required="required" type="text" id="MenuchildMenuname'+x+'"></div><div class="input text"><input name="data[Menuchild][controller'+x+']" placeholder="Controller" required="required" type="text" id="MenuchildController'+x+'"></div><div class="input text"><input name="data[Menuchild][action'+x+']" placeholder="Action" required="required" type="text" id="MenuchildAction'+x+'"></div><a href="#" class="remove_field" title="Xóa">x</a></fieldset>');
          }
        });
    
    $('.input_fields_wrap').on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('fieldset').remove(); x--;
    })

    $(".loginuser").click(function() {
      $(this).attr('href','/users/login/#login');
    });
    $('.cau-hinh table').hide();
    $('.cau-hinh h4 > i').click(function(){
      if($("table").is(':hidden') == true)
      {
        $("table").slideDown();
        $(this).removeClass('fa-plus').addClass('fa-minus');
      }
      else{
        $("table").slideUp();
        $(this).addClass('fa-plus').removeClass('fa-minus');
      }

    });

    $('.menu-cart > a').hover(
      function () {
        if($('.menu-cart #cart-counter').text()==0)
        {
          $('.ds-gio-hang').css('display','none');
        } 
        else 
        {
          $('.ds-gio-hang').slideDown(200);
        }   

      });


    $('.menu-right-admin ul li.nhac-nho .group-sap-het').hide();

    $('.menu-right-admin ul li.nhac-nho > i').click(function(){
      if($(".menu-right-admin ul li.nhac-nho .group-sap-het").is(':hidden') == true)
      {
        $(".menu-right-admin ul li.nhac-nho .group-sap-het").slideDown();
      }
    });
    $('.menu-right-admin ul li.nhac-nho .group-sap-het > .fa-times').click(function(){
     $(".menu-right-admin ul li.nhac-nho .group-sap-het").slideUp();
   });

    $('.slider1').bxSlider({
      slideWidth: 292,
      auto: true,
      minSlides: 1,
      maxSlides: 4,
      slideMargin: 10
    });
    $('.slide-top-product').bxSlider({
      slideWidth: 292,
      auto: true,
      minSlides: 1,
      maxSlides: 1,
      slideMargin: 10
    });

  });