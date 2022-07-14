<?php
include("./clases/ClsUsuario.php");

$Usuario =new ClsUsuario;


echo $Usuario->encrypt('40926663','usser');
echo '<br>';
echo $Usuario->encrypt('40926663','pass');
echo '<br>';
echo $Usuario->decrypt('yMCmxaU=','pass');
echo '<br>';
echo $Usuario->decrypt('o6CRo6ujlw==','pass');
echo '<br>';
echo $Usuario->decrypt('vrG1zKWgkqg=','pass');
echo '<br>';
echo $Usuario->decrypt('urmiwaWgkqg=','pass');
echo '<br>';
echo $Usuario->decrypt('yMCmxaU=','pass');
echo '<br>';
echo $Usuario->decrypt('ybWzx7zKk6OkpQ==','pass');
echo '<br>';
echo $Usuario->decrypt('yMCmxQ==','pass');
echo '<br>';
echo $Usuario->decrypt('ybWzx7zKk6OkpQ==','pass');
echo '<br>';
echo $Usuario->decrypt('pKeRrA==','pass');
echo '<br>';
echo $Usuario->decrypt('yMCmxQ==','pass');
echo '<br>';
echo $Usuario->decrypt('p6WVpaaolaQ=','pass');







?>