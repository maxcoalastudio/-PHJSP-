# <PHJSP>
Este guia cobre 95% dos casos de uso do <PHJSP>! 🚀
Um parse com um inject JS para usar no PHP. de forma simples conseguimos unir o JS no PHP. [Em desenvolvimento]

exemplos do uso:
1. Declaração de Variáveis
php
<?php
require_once 'PHJSP.php';

$js = new PHJSP();

// Tipos básicos
$js->var('nome', 'João Silva');     // string
$js->var('idade', 30);               // number
$js->var('altura', 1.75);            // float
$js->var('ativo', true);              // boolean
$js->var('saldo', null);              // null

// ES6 (modo estrito)
$js->let('cidade', 'São Paulo');      // let (mutável)
$js->const('PI', 3.14);               // const (imutável)

echo $js;
?>

2. Arrays
php
<?php
$js = new PHJSP();

// Array simples
$js->array('frutas', ['maçã', 'banana', 'laranja']);

// Array numérico
$js->array('numeros', [10, 20, 30, 40, 50]);

// Array misto
$js->array('misto', [1, 'texto', true, null]);

echo $js;
?>

3. Objetos
php
<?php
$js = new PHJSP();

// Objeto simples
$js->object('pessoa', [
    'nome' => 'Maria',
    'idade' => 28,
    'cidade' => 'Rio de Janeiro'
]);

// Objeto aninhado
$js->object('empresa', [
    'nome' => 'Tech Solutions',
    'endereco' => [
        'rua' => 'Av. Paulista',
        'numero' => 1000
    ]
]);

echo $js;
?>


4. Funções
php
<?php
$js = new PHJSP();

// Função tradicional
$js->function('saudacao', ['nome'], '
    return "Olá, " + nome + "!";
');

// Função anônima
$js->var('dobro', $js->anonymousFunction(['x'], 'return x * 2;'));

// Arrow function (ES6)
$js->var('triplo', $js->arrowFunction(['x'], 'x * 3'));

echo $js;
?>


5. Classes e Instanciação
php
<?php
$js = new PHJSP();

// Definir classe
$js->klass('Produto', '
    constructor(nome, preco) {
        this.nome = nome;
        this.preco = preco;
    }
    
    info() {
        return this.nome + " - R$ " + this.preco;
    }
');

// Instanciar objetos
$js->instanciar('produto1', 'Produto', ['Notebook', 3500]);
$js->instanciar('produto2', 'Produto', ['Mouse', 50]);

// Usar métodos
$js->consoleLog('produto1.info()');
$js->consoleLog('produto2.info()');

echo $js;
?>


6. Estruturas de Controle (If/Else)
php
<?php
$js = new PHJSP();

$js->var('nota', 8);

$js->if_('nota >= 7');
$js->consoleLog('"Aprovado"');
$js->elseIf_('nota >= 5');
$js->consoleLog('"Recuperação"');
$js->else_();
$js->consoleLog('"Reprovado"');
$js->endif();

echo $js;
?>

7. Switch
php
<?php
$js = new PHJSP();

$js->var('dia', 3);

$js->switch_('dia');
$js->case_('1');
$js->consoleLog('"Segunda"');
$js->break_();
$js->case_('2');
$js->consoleLog('"Terça"');
$js->break_();
$js->case_('3');
$js->consoleLog('"Quarta"');
$js->break_();
$js->default_();
$js->consoleLog('"Outro dia"');
$js->endSwitch();

echo $js;
?>

8. Loops
php
<?php
$js = new PHJSP();

// For tradicional
$js->for_('let i = 0', 'i < 5', 'i++');
$js->consoleLog('"i = " + i');
$js->endFor();

// While
$js->var('contador', 0);
$js->while_('contador < 3');
$js->consoleLog('contador');
$js->var('contador', 'contador + 1');
$js->endWhile();

// For...of (arrays)
$js->array('frutas', ['maçã', 'banana', 'laranja']);
$js->forOf('let fruta', 'frutas');
$js->consoleLog('fruta');
$js->endFor();

// forEach
$js->forEach('frutas', ['fruta', 'i'], '
    console.log(i + ": " + fruta);
');

echo $js;
?>

9. Manipulação de HTML
php
<?php
$js = new PHJSP();

// Aguardar DOM carregar
$js->raw('document.addEventListener("DOMContentLoaded", function() {');

// Selecionar elementos
$js->getElementById('meuTitulo', 'titulo');
$js->getElementsByClassName('item', 'itens');
$js->querySelector('.container', 'container');

// Manipular conteúdo
$js->if_('titulo');
$js->innerHTML('titulo', '"<u>Novo Título</u>"');
$js->innerText('titulo', '"Texto simples"');
$js->endif();

// Manipular estilos
$js->if_('container');
$js->style('container', 'color', 'blue');
$js->style('container', 'fontSize', '18px');
$js->endif();

// Manipular classes
$js->classListAdd('container', 'destaque');
$js->classListRemove('container', 'oculto');

// Criar elementos
$js->createElement('div', 'novaDiv');
$js->setAttribute('novaDiv', 'id', '"minhaDiv"');
$js->innerHTML('novaDiv', '"Conteúdo da nova div"');
$js->appendChild('document.body', 'novaDiv');

$js->raw('});');

echo $js;
?>


10. Eventos
php
<?php
$js = new PHJSP();

$js->raw('document.addEventListener("DOMContentLoaded", function() {');

// Evento de clique
$js->getElementById('meuBotao', 'botao');
$js->if_('botao');
$js->addEventListener('botao', 'click', 'function() {
    alert("Botão clicado!");
    this.style.backgroundColor = "red";
}');
$js->endif();

// Evento de mouse
$js->getElementById('caixa', 'caixa');
$js->if_('caixa');
$js->onMouseOver('caixa', 'function() { this.style.backgroundColor = "yellow"; }');
$js->onMouseOut('caixa', 'function() { this.style.backgroundColor = ""; }');
$js->endif();

$js->raw('});');

echo $js;
?>

11. Timers
php
<?php
$js = new PHJSP();

// setTimeout (executa uma vez)
$js->setTimeout('function() { alert("3 segundos!"); }', 3000);

// setInterval (executa repetidamente)
$js->var('contador', 0);
$js->var('intervalo', 'setInterval(function() {
    contador++;
    console.log("Contador: " + contador);
    if (contador >= 5) {
        clearInterval(intervalo);
    }
}, 1000)');

echo $js;
?>

12. Try/Catch
php
<?php
$js = new PHJSP();

$js->try_();
$js->var('resultado', 'JSON.parse("dados inválidos")');
$js->catch_('erro');
$js->consoleError('"Erro:", erro');
$js->finally_();
$js->consoleLog('"Bloco finally executado"');
$js->endTry();

echo $js;
?>

13. Métodos de Array
php
<?php
$js = new PHJSP();

$js->array('numeros', [1, 2, 3, 4, 5]);

// Map - dobrar valores
$js->map('numeros', 'n => n * 2', 'dobrados');
$js->consoleLog('dobrados');

// Filter - números pares
$js->filter('numeros', 'n => n % 2 === 0', 'pares');
$js->consoleLog('pares');

// Reduce - somar tudo
$js->reduce('numeros', '(acc, n) => acc + n', '0', 'soma');
$js->consoleLog('"Soma:", soma');

// Push/Pop
$js->push('numeros', [6, 7]);
$js->pop('numeros', 'ultimo');

echo $js;
?>

4. Métodos de String
php
<?php
$js = new PHJSP();

$js->var('texto', 'JavaScript é incrível!');

$js->length('texto', 'tamanho');
$js->toUpperCase('texto', 'maiusculo');
$js->toLowerCase('texto', 'minusculo');
$js->indexOf('texto', '"incrível"', 0, 'posicao');
$js->includes('texto', '"Java"', 0, 'temJava');
$js->replace('texto', '"incrível"', '"fantástico"', 'novoTexto');
$js->split('texto', '" "', null, 'palavras');

echo $js;
?>

15. JSON
php
<?php
$js = new PHJSP();

// Objeto para JSON
$js->object('pessoa', ['nome' => 'João', 'idade' => 30]);
$js->jsonStringify('pessoa', 'jsonString');
$js->consoleLog('jsonString');

// JSON para objeto
$js->jsonParse('jsonString', 'pessoa2');
$js->consoleLog('pessoa2');

echo $js;
?>
16. Math
php
<?php
$js = new PHJSP();

$js->mathRandom('aleatorio');
$js->mathFloor('5.7', 'baixo');
$js->mathCeil('5.2', 'cima');
$js->mathRound('5.5', 'arredondado');
$js->mathMax([10, 5, 20, 8], 'maximo');
$js->mathMin([10, 5, 20, 8], 'minimo');

echo $js;
?>
17. Date
php
<?php
$js = new PHJSP();

// Data atual
$js->newDate('agora');
$js->consoleLog('agora');

// Data específica
$js->newDate('natal', [2025, 11, 25]);
$js->consoleLog('natal');

// Timestamp
$js->dateNow('timestamp');
$js->consoleLog('timestamp');

echo $js;
?>
18. Prompt, Confirm, Alert
php
<?php
$js = new PHJSP();

// Alert simples
$js->alertText('Mensagem de alerta!');

// Confirm (retorna true/false)
$js->confirm('Deseja continuar?', 'resposta');

// Prompt (entrada do usuário)
$js->prompt('Digite seu nome:', 'Visitante', 'nome');

$js->if_('resposta && nome');
$js->alertExpr('"Olá, " + nome + "!"');
$js->endif();

echo $js;
?>
19. Console com diferentes níveis
php
<?php
$js = new PHJSP();

$js->consoleLog('"Mensagem normal"');
$js->consoleInfo('"Mensagem informativa"');
$js->consoleWarn('"Mensagem de aviso"');
$js->consoleError('"Mensagem de erro"');
$js->consoleDebug('"Mensagem de debug"');
$js->consoleTable('pessoa');

// Grupo de console
$js->consoleGroup('Meu Grupo');
$js->consoleLog('"Dentro do grupo"');
$js->consoleLog('"Mais informações"');
$js->consoleGroupEnd();

// Timer
$js->consoleTime('loop');
$js->for_('let i = 0', 'i < 1000', 'i++');
$js->endFor();
$js->consoleTimeEnd('loop');

echo $js;
?>
20. Exemplo Completo (HTML integrado)
php
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PHJSP - Exemplos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .destaque { background-color: yellow; }
        #container { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1 id="titulo">Título Original</h1>
    <div id="container">
        <p>Conteúdo do container</p>
    </div>
    <button id="botao">Clique Aqui</button>
    
    <?php
    require_once 'PHJSP.php';
    
    $js = new PHJSP();
    
    // Aguardar DOM carregar
    $js->raw('document.addEventListener("DOMContentLoaded", function() {');
    
    // Manipular título
    $js->getElementById('titulo', 'titulo');
    $js->if_('titulo');
    $js->innerHTML('titulo', '"<u>PHJSP em Ação!</u>"');
    $js->style('titulo', 'color', 'blue');
    $js->endif();
    
    // Manipular container
    $js->getElementById('container', 'container');
    $js->if_('container');
    $js->innerHTML('container', '"<strong>Container modificado</strong>"');
    $js->classListAdd('container', 'destaque');
    $js->endif();
    
    // Evento de botão
    $js->getElementById('botao', 'botao');
    $js->if_('botao');
    $js->addEventListener('botao', 'click', 'function() {
        alert("Botão clicado!");
        document.getElementById("titulo").innerHTML = "Título alterado pelo botão!";
    }');
    $js->endif();
    
    // Array e loop
    $js->array('frutas', ['maçã', 'banana', 'laranja']);
    $js->consoleLog('"Lista de frutas:"');
    $js->forEach('frutas', ['fruta', 'i'], '
        console.log(i + ": " + fruta);
    ');
    
    $js->raw('});');
    
    echo $js;
    ?>
</body>
</html


    📝 Resumo dos Métodos Mais Usados
Categoria	Métodos
Variáveis	var(), let(), const()
Arrays	array(), push(), pop(), map(), filter()
Objetos	object(), objeto(), getProperty(), setProperty()
Funções	function(), anonymousFunction(), arrowFunction()
Classes	klass(), instanciar(), callMethod()
Condicionais	if_(), else_(), elseIf_(), switch_()
Loops	for_(), while_(), forOf(), forEach()
HTML	getElementById(), innerHTML(), style(), classListAdd()
Eventos	addEventListener(), onClick(), onChange()
Timers	setTimeout(), setInterval()
Console	consoleLog(), consoleWarn(), consoleError()
Interação	alertText(), confirm(), prompt()
Este guia cobre 95% dos casos de uso do PHJSP! 🚀
simples assim!
