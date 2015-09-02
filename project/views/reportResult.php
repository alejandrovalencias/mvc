<?php
/*
 * Vista que despliega los resultados de la validación
 */
?>
<h1 class="title">Verifica si la lista de archivos existe y si la suma de chequeo es id&eacute;ntica</h1>
<?php
if(isset($params['error']) && count($params['error']) > 0){
?>
<div class="error">
    <?php 
    foreach($params['error'] as $error){
    ?>
        <p><?php echo $error; ?></p>
    <?php 
    }?>
</div>
<?php
}
?>
<h2>
    <p>Par&aacute;metros de configuraci&oacute;n</p>
    <span class="small"><i>La configuraci&oacute;n se puede modificar en el archivo config/Config.php</i></span>
    <?php
        if(isset($params['config'])){
            ?>
            <p>Ruta absoluta donde se buscan los archivos: "<?php echo $params['config']->serverPath; ?>"</p>
    <?php
          
        }
    ?>
</h2>
<hr></hr>
<form enctype="multipart/form-data" method="post" name="fileTextList">
    <p class="color-blue">
        Ingrese el archivo XML con la lista de archivos a validar:<br>
        <input type="file" name="fileXml" size="40">
    </p>
     <div>
     <p>
        Ingrese la ruta del servidor:<br>
        <input type="text" name="pathText" size="40">
    </p>
    </div>
    <div>
        <input type="submit" value="Validar">
    </div>
</form>
<?php
if (isset($params['xml']) && $params['xml'] instanceof SimpleXMLElement) {
    $files = $params['xml']->file;
    
    ?>
<hr></hr>
<h3>  Resultados de la validaci&oacute;n    </h3>
    <table summary="Resultados de la validación" id="newspaper-a">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Existe</th>
                <th>Igual Checksum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $okImage = 'images/ok.png';
            $badImage = 'images/bad.png';
            foreach ($files as $file) {               
                ?>
                <tr>
                    <td><span class="<?php echo (int) $file->hasError === 0
                ?'normal' : 'error'; ?>"><?php echo (string) $file->name; ?></span></td>
                    <td align="center"><img src="<?php echo (int) $file->exist == 1
                ? $okImage : $badImage; ?>" /></td>
                    <td align="center"><img src="<?php echo (int) $file->equalChecksum === 1
                ? $okImage : $badImage; ?>" /></td>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
<link rel="stylesheet" type="text/css" href="css/style.css" />