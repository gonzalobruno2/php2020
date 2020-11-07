<?php
if ( empty($_REQUEST['tema']) || empty($_REQUEST['comentario']) ){
    echo "<script>alert('Debe de elegir un tema y un comentario'); window.history.back();</script>";
} 
?>
<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= contarLetras($_REQUEST['comentario']);?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= contarPalabras($_REQUEST['comentario']);?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraRepetida($_REQUEST['comentario']);?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= palabraRepetida($_REQUEST['comentario']);?></td></tr>
</table>
</div>

