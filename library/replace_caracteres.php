<?php 
    function limpiar_caracteres_especiales($s) {
        $s = ereg_replace("[áàâãª]","a",$s);
        $s = ereg_replace("[ÁÀÂÃ]","A",$s);
        $s = ereg_replace("[éèê]","e",$s);
        $s = ereg_replace("[ÉÈÊ]","E",$s);
        $s = ereg_replace("[íìî]","i",$s);
        $s = ereg_replace("[ÍÌÎ]","I",$s);
        $s = ereg_replace("[óòôõº]","o",$s);
        $s = ereg_replace("[ÓÒÔÕ]","O",$s);
        $s = ereg_replace("[úùû]","u",$s);
        $s = ereg_replace("[ÚÙÛ]","U",$s);
        $s = str_replace("ñ","n",$s);
        $s = str_replace("Ñ","N",$s);
        //para ampliar los caracteres a reemplazar agregar lineas de este tipo:
        //$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
        return $s;
    }
?>