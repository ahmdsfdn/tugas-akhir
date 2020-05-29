 

$(document).ready(function(){

 
  $("#laporan1").click(function(){
     if ($(".kaskeluar").hasClass("muncul") || $(".kasmasuk").hasClass("muncul") ) {
          
          $(".kaskeluar").removeClass("muncul");
          $(".kasmasuk").removeClass("muncul");

            $(".laporan").each(function(i){
                  setTimeout(function() {
                  $(".laporan").eq(i).toggleClass("muncul");
              }, 300 * (i+1));
            });
    } else {
          $(".laporan ").each(function(i){
                  setTimeout(function() {
                  $(".laporan ").eq(i).toggleClass("muncul");
              }, 300 * (i+1));
            });
    }
    
  });

  $("#kaskeluar").click(function(){
    if ($(".laporan ").hasClass("muncul") || $(".kasmasuk").hasClass("muncul") ) {

      $(".laporan ").removeClass("muncul");
      $(".kasmasuk").removeClass("muncul");

       setTimeout(function(){
          $(".kaskeluar").toggleClass("muncul");
       }, 300);
       
    } else 
    {
       setTimeout(function(){
          $(".kaskeluar").toggleClass("muncul");
       }, 300);
    }
  });

  $("#kasmasuk").click(function(){
    if ($(".laporan ").hasClass("muncul") || $(".kaskeluar").hasClass("muncul") ) {

      $(".laporan ").removeClass("muncul");
      $(".kaskeluar").removeClass("muncul");

       setTimeout(function(){
          $(".kasmasuk").toggleClass("muncul");
       }, 300);
       
    } else {
      setTimeout(function(){
          $(".kasmasuk").toggleClass("muncul");
       }, 300);
    }
  });


  });