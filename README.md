# -PHJSP-
Um parse com um inject JS para usar no PHP. de forma simples conseguimos concatenar o JS no PHP. [Em desenvolvimento]
no seu documento principal php faça:
"""

<?php
 include_once('JS/JS.php');
    // $js = new JS();
    // $js->function('Pessoa', array('nome', 'idade'));
    // $js->var('this.nome', 'nome');
    // $js->var('this.idade', 'idade');
    // $js->function('apresentar', array());
    // $js->alert('"Olá, meu nome é " + this.nome + " e eu tenho " + this.idade + " anos."');
    // echo $js;
    
    
    // Criar um objeto da classe
    
    
     $js = new JS();
    $js->var('pessoa', 'new Pessoa("João", 30)');
    echo $js;
    
    
    // Chamar uma função do objeto
    
    $js->alert('pessoa');
    echo $js;
    
    
    // Criar uma função
    // $js = new JS();
    // $js->function('somar', array('a', 'b'), 'return a + b;' );


    // echo $js;
    
    
    // Chamar uma função
    // $js = new JS();
    // $js->alert('somar(2, 3)');
    // echo $js;
    
    
    // Criar um array
    
    
    // $js = new JS();
    // $js->array('numeros', array(1, 2, 3, 4, 5));
    // echo $js;
    
    
    // Criar um objeto
    
    
    // $js = new JS();
    // $js->objeto('pessoa', array('nome' => 'João', 'idade' => 30));
    // echo $js;
    
    
    // Usar um if
    
    
    // $js = new JS();
    // $js->var('idade', 30);
    // $js->if('idade > 18');
    // $js->alert('"Maior de idade"');
    // $js->else();
    // $js->alert('"Menor de idade"');

    // echo $js;
    
    
    // Usar um loop for
    
    
    // $js = new JS();
    // $js->for(array('var i = 0', 'i < 5', 'i++')); // podendo ser assim tambem : $js->for(array('var i = 0', 'i' < '5', 'i++'));
    // $js->alert('i');

    // echo $js;

?>
"""
simples assim!
