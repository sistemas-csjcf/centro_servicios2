<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
        <title><?php echo titulo?></title>
        <script src="views/js/jquery.js" type="text/javascript"></script>
        <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
        <script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
        <script src="views/js/jquery.validate.js" type="text/javascript"></script>
        <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
        <link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8"/>
        <link href="views/css/main.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".topMenuAction").click( function() {
                    if ($("#openCloseIdentifier").is(":hidden")) {
                        $("#sliderm").animate({ 
                            marginTop: "-238px"
                        }, 500 );
                        $("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
                        $("#openCloseIdentifier").show();
                    } else {
                        $("#sliderm").animate({ 
                            marginTop: "0px"
                        }, 500 );
                        $("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
                        $("#openCloseIdentifier").hide();
                    }
                });  
                $("#sliderop").easySlider({});	
                $("#frm").validate();
                var validator = $("#frm").validate({
                    meta: "validate"
                });
                $(".btn_limpiar").click(function() {
                    validator.resetForm();
                });			
            });
        </script>	
        <script type="text/javascript">
            function mainmenu(){
                $(" #menusec ul ").css({display: "none"});
                $(" #menusec li").hover(function(){
                    $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
                },function(){
                    $(this).find('ul:first').slideUp(400);
                });
            }
            $(document).ready(function(){
                mainmenu();
            });
        </script>
        <script>
            function limpiar(frm){
                frm.fechai.value ="";
                frm.fechaf.value ="";
            }
            function consultar(frm){
                variable=1;
                variable1=frm.fechai.value;
                variable2=frm.fechaf.value;
                variable3=frm.juzgado.value;
                //alert(radicado);
                if(variable1!="" && variable2!=""){
                    frm.fechai.style.border ="solid #00FF00 1px";
                    frm.fechaf.style.border ="solid #00FF00 1px";
                    //location.href="index.php?controller=correspondencia&action=editarActuaciones&nombre="+variable;
                    document.getElementById("load").style.display = "block";
                    var x = document.createElement("IMG");
                    x.setAttribute("src", "assets/imagenes/load1.gif");
                    x.setAttribute("width", "90");
                    x.setAttribute("width", "90");
                    x.setAttribute("alt", "Cargando Datos...");
                    document.getElementById("load").appendChild(x);
                    //document.getElementById("load").innerHTML="<p>Realizando Consulta por favor Espere un momento...</>";
                    location.href="index.php?controller=migracion&action=migracion_inc1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3;
                }else{
                    alert("Por favor ingrese un rango de fecha a consultar");
                    if(variable1==="" && variable2===""){
                        frm.fechai.style.border ="solid #A52A2A 1px";
                        frm.fechaf.style.border ="solid #A52A2A 1px";
                    }else if(variable2==="" && variable1!==""){
                        frm.fechaf.style.border ="solid #A52A2A 1px";
                        frm.fechai.style.border ="solid #00FF00 1px";
                    }else if(variable1==="" && variable2 !==""){
                        frm.fechai.style.border ="solid #A52A2A 1px";
                        frm.fechaf.style.border ="solid #00FF00 1px";
                    }else{
                        frm.fechai.style.border ="solid #00FF00 1px";
                        frm.fechaf.style.border ="solid #00FF00 1px";
                    }
                }
            }
            function llenar(frm,op){
                if(op==1){
                    for (i=0;i<document.frm.elements.length;i++) 
                        if(document.frm.elements[i].type == "checkbox")	
                            document.frm.elements[i].checked=1  
                }
                if(op==2){
                    for (i=0;i<document.frm.elements.length;i++) 
                        if(document.frm.elements[i].type == "checkbox")	
                            document.frm.elements[i].checked=0 
                }
            }
            function activar_acc(frm,i){
                x= document.getElementById("op"+i).checked;
                if(x==true){
                    document.getElementById("anio"+i).disabled=false;
                    document.getElementById("ncaja"+i).disabled=false;
                    document.getElementById("cons"+i).disabled=false;  
                }else{
                    document.getElementById("anio"+i).value="";
                    document.getElementById("ncaja"+i).value="";
                    document.getElementById("cons"+i).value="";
                    document.getElementById("anio"+i).disabled=true;
                    document.getElementById("ncaja"+i).disabled=true;
                    document.getElementById("cons"+i).disabled=true;
                }
            } 
        </script>
    </head>
    <body>
        <!---->
        <?php require 'header.php'; ?>
        <!---->
        <?php require 'secc_migracion.php'; ?>
        <!---->
        <?php
        /*SERV-JUSTICIA2
            local
            consejoPN
            T103DAINFOPROC
            A103LLAVPROC
        */
?>
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr><td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td></tr>
            <tr>
                <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
                    <div id="contenido">
                        <form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
                            <div id="titulo_frm">Procesos con Inconsistencias</div>
                            <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                                <tr>
                                    <td width="157">Fecha Inicial:</td>
                                    <td width="346">
                                        <input name="fechai" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre1'];?>" readonly="readonly"/>
                                        <script type="text/javascript" charset="utf-8">
                                            jQuery(document).ready(function(){
                                                jQuery(".tinicio").datepicker({ changeFirstDay: false	});
                                            });
                                        </script>	
                                    </td>
                                    <td width="107">Fecha Final:</td>
                                    <td width="148">
                                        <input name="fechaf" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre2'];?>" readonly="readonly"/>
                                        <script type="text/javascript" charset="utf-8">
                                            jQuery(document).ready(function(){
                                                jQuery(".tinicio").datepicker({ changeFirstDay: false	});
                                            });
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Despacho:</td>
                                    <td>
                                        <select name="juzgado" id="sl_input">
                                            <?php $j=0;$cont_desp = count($datos_despachos)?>
                                            <?php while($j<$cont_desp){  $val=$datos_despachos[$j][codi_nume]."-".$datos_despachos[$j][codi_espe]."-".$datos_despachos[$j][codi_enti];?>
                                                <option value="<?php echo $datos_despachos[$j][codi_nume]."-".$datos_despachos[$j][codi_espe]."-".$datos_despachos[$j][codi_enti];?>" <?php if($_GET['nombre3']==$val){?>selected="selected"<?php }?>><?php echo $datos_despachos[$j][nom_pone];?></option>
                                            <?php $j++;}?>
                                        </select>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td><label></label></td>
                                </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <input name="opcion" type="hidden" value="" />
                                    <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)" />
                                    <input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)"/>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr><td colspan="4"><div id="load"></div></td></tr>
                        </table>
                        <?php 
                            $opcion = $_GET['nombre'];
                            if($opcion==1){
                        ?>
                                <br /><br />
                                <div id="titulo_frm">
                                    <p>Lista de Procesos con inconsistencias</p>
                                </div>
                                <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Cantidad de Registros: ".count($datos_justicia);?></p>
                                <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                                    <thead>
                                        <tr><th colspan="8"><input type="submit" name="btn_input" value="Actualizar En Justicia" id="btn_input" /></th></tr>
                                        <tr>
                                            <th width="75">&nbsp;</th>
                                            <th width="75">N&deg; Proceso</th>
                                            <th width="80">Demandado</th>
                                            <th width="85">Demandante</th>
                                            <th width="34">Tipo </th>
                                            <th width="38">Clase</th>
                                            <th width="99">Observaciones</th>
                                            <th width="502"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php     
                                                /*echo $datos_saidoj;
                                                //$row = sqlsrv_fetch_array( $stmt)
                                                echo $row['id_tipo_inc']. ",";
                                                echo $row['id_juzgado']. ",";
                                                $date= $row['fecha_demanda'];
                                                echo date_format($date, 'Y-m-d');*/
                                                $cont= count($datos_justicia);
                                                $i=0;
                                                while($i<$cont) {
                                            ?>
                                                <td>
                                                    <div align="center">
                                                        <input name="op<?php echo $i;?>" type="checkbox" value="1" id="<?php echo "op".$i;?>" onclick="activar_acc(frm,<?php echo $i ?>)" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php   echo $datos_justicia[$i][num];?>
                                                    <input type="hidden" name="llave<?php echo$i;?>" id="hiddenField" value="<?php   echo $datos_justicia[$i][num];?>" />
                                                </td>
                                                <td><?php echo $datos_justicia[$i][demandado];?></td>
                                                <td><?php echo $datos_justicia[$i][demandante];?></td>
                                                <td><?php echo $datos_justicia[$i][tipo];?></td>
                                                <td><?php echo $datos_justicia[$i][clase];?></td>
                                                <td><?php echo $datos_justicia[$i][observaciones];?></td>
                                                <td>
                                                    <label>
                                                        <input type="text" name="anio" id="txt_input_medio" value="A&Ntilde;O " readonly="readonly" />
                                                        <input name="anio<?php echo $i;?>" type="text" class="required number" id="anio<?php echo $i;?>" size="4" maxlength="4" minlength="4" disabled="disabled" />
                                                        <input type="text" name="tcaja" id="txt_input_medio" value=" CAJA " readonly="readonly" />
                                                        <input name="ncaja<?php echo $i;?>" type="text" class="required number" id="ncaja<?php echo $i;?>" size="4" maxlength="4" minlength="4" disabled="disabled" />
                                                        <input type="text" name="tcaja" id="txt_input_medio" value=" No. " readonly="readonly" />
                                                        <input name="cons<?php echo $i;?>" type="text" class="required number" id="cons<?php echo $i;?>" size="4" maxlength="4" minlength="4" disabled="disabled" />
                                                    </label>
                                                </td>
                                            </tr>
                                        <?php $i++; } ?>
                                        <input name="contador" type="hidden" value="<?php echo $i; ?>" />
                                        <tr>
                                            <td colspan="8">
                                                <div align="center">
                                                    <input type="submit" name="btn_input" value="Actualizar En Justicia" id="btn_input"  onclick="validar_ex(frm)" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <p></p>
                        </form>
                    </div>		
                </td>
            </tr>
            <tr><td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td></tr>
        </table>
        <?php require 'alertas.php';?>
    </body>
</html>