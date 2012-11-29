$(function(){
	//APAGA VALUE
  $("form input[type=text], form input[type=password], form textarea").focus(function() {
    if ($(this).val()==this.defaultValue) {
     $(this).val('');
    }
  });
  
  $("form input[type=text], form input[type=password], form textarea").blur(function() {
    if ($(this).val()=='') {
     $(this).val(this.defaultValue);
    }
  });

  //ABRE QUADRO LOGIN
  $("a.bt_login").click(function(){
    $(this).parent("li").children("ul").slideToggle(100);
    $(this).parent("li").toggleClass('ativo');
    return false;
  });

  //GALERIA PRODUTO
  $(".prd_imagens a").click(function(){
    var imagem = $(this).attr("href");
    $(this).parents("ul").parent("div").children("img.maior").attr("src", imagem);
    return false;
  });

});