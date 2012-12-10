<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  
<style type="text/css">
  body {
  font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 17px;
	font-weight: normal;
	color: #666666;
	text-decoration: none;
	padding: 0px;
	height: 100%;
}
input, textarea, select {
	padding: 4px;
	color: #666666;
	font-family: Arial, Helvetica, sans-serif;
	border: 1px solid #BBBBBB;
}

#firma_kayit_boyut {
    margin-top: 100px;
    margin-left: auto;
    margin-right: auto;
	width: 500px;
}
</style> 
  
 <script type="text/javascript" language="javascript">
	function soy(html) //çift boşluk teke düşürülecek
	{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent||tmp.innerText;
	}
	
	function renkliAutocomplete() {

          var oldFn = $.ui.autocomplete.prototype._renderItem;

          $.ui.autocomplete.prototype._renderItem = function( ul, item) {
              var re = new RegExp("^" + this.term, "i") ;
              var t = item.label.replace(re,"<span style='font-weight:bold; color:Blue;'>" + this.term + "</span>");
              return $( "<li></li>" )
                  .data( "item.autocomplete", item )
                  .append( "<a>" + t + "</a>" )
                  .appendTo( ul );
          };
      } //auto complete 
	 $(document).ready(function(){
	renkliAutocomplete();
	
	$( "#fbul" ).autocomplete({
		source: "firma_bul_ajx2.php",
		minLength: 2,
		select: function( event, ui ) { 
		//alert(JSON.stringify(ui.item));
		}
		}); //autocomplete son
	 
	    });
    </script>
</head>
<body style="margin:20px;">
<div id="firma_kayit_boyut"> 
		<div style="width:400px; margin-left:10px;">Type Some Company Information</div><div class="v" style="position:relative;"><input id="fbul" type="text" size="80" name="fbul"  maxlength="100"></div> 
</div> 
 <!-- $(this).parents('div:eq(1)').attr('id') -->
</body>
</html>