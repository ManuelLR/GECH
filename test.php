<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: Prueba de uno o 2 o m&aacute;s div al lado de otro ::. </title>
</head>
<style type="text/css">
body {
background:#59b5ec url(http://robcubbon.com/images/rihanna-pop-art.gif)top left no-repeat fixed;
}
#contenedor{
margin:0 auto;/*para centrarlo el contenedor debe poseer este margen*/
padding:0;
width:632px;/*si queremos que salga 4 veces la imagen con separación de margenes a la derecha de 10px y  incluyendo bordes de 2px, quedando todo junto hacia el centro hacemos esto:
-->Multiplicamos el width=ancho x 4 del espacio 1 =   144 x 4 = 576px  +
-->Multiplicamos el margin=margen x 4 del espacio 1 =  10 x 4 =  40px
-->Sumamos el border=borde derecho y isquierdo del
espacio 1 y luego lo multiplicamos x 4 =            (2 + 2) 4 =  16px
                                                                ------
-->Y nos dar como el total el width que nesecitamos -----------> 632px

NOTA: si ponemos el width:auto del contenedor, todo se ira hacia el margen izquierdo. */
text-align:center;
height:auto;/*aqui puedes poner una altura deseada teniedo en cuenta que tiene que ser mayor o igual al de la imagen, y si tiene bordes la imagen se le suma a la altura, igual si el
div->espacio 1 tuviera bordes se lo sumarias a la altura=height,  y cuando hablo que le sumarias el borde seria el borde de arriba + el borde de abajo ahi que tenerlo en cuenta, por recomendación usar height=auto */
background:transparent;
}
#espacio1{
padding:0;
width:144px;
float:left;
background:transparent;
height:auto;
border:solid black 2px;
margin-right:10px;
}
</style>
<body>
<div id="contenedor">
    <div id="espacio1"><img src="http://robcubbon.com/images/rihanna-pop-art.gif" width="144px" height="192px" /></div>
    <div id="espacio1"><img src="http://robcubbon.com/images/rihanna-pop-art.gif" width="144px" height="192px" /></div>
    <div id="espacio1"><img src="http://robcubbon.com/images/rihanna-pop-art.gif" width="144px" height="192px" /></div>
    <div id="espacio1"><img src="http://robcubbon.com/images/rihanna-pop-art.gif" width="144px" height="192px" /></div>
</div>
</body>
</html>
