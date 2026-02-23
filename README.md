# -PHJSP-
Criei um parse com um inject JS para usar no PHP. de forma simples conseguimos concatenar o JS no PHP. [Em desenvolvimento]
no seu documento principal php faça:
"
"<?php"
    "$nome = "max";
    include_once('JS/JS.php');
    $js= new JS();
    echo $js->alert('Seu nome é '. $nome);"
"?>"
"
simples assim!
