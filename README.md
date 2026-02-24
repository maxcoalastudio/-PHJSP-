# -PHJSP-
Um parse com um inject JS para usar no PHP. de forma simples conseguimos unir o JS no PHP. [Em desenvolvimento]

exemplos do uso:


"""

<?php
require_once 'JsBuilder.php';

$js = new JsBuilder();

// ============ 1. DECLARAÇÃO DE VARIÁVEIS ============
$js->comment('=== 1. DECLARAÇÃO DE VARIÁVEIS ===');

// Tipos básicos
$js->var('nome', 'João Silva');           // string
$js->var('idade', 30);                     // number
$js->var('altura', 1.75);                  // float
$js->var('ativo', true);                    // boolean
$js->var('saldo', null);                    // null
$js->var('indefinido', 'undefined');        // undefined (como expressão)

// Let e Const (ES6)
$js->let('cidade', 'São Paulo');
$js->const('PI', 3.14159);

// ============ 2. ARRAYS ============
$js->comment('=== 2. ARRAYS ===');

// Array simples
$js->array('frutas', ['maçã', 'banana', 'laranja', 'uva']);

// Array misto
$js->array('misto', [1, 'texto', true, null, ['outro', 'array']]);

// Array com expressões
$js->array('numeros', [1, 2, 3, 4, 5]);

// ============ 3. OBJETOS ============
$js->comment('=== 3. OBJETOS ===');

// Objeto simples
$js->object('pessoa', [
    'nome' => 'Maria Oliveira',
    'idade' => 28,
    'cidade' => 'Rio de Janeiro',
    'telefone' => '(21) 99999-8888',
    'admin' => false
]);

// Objeto aninhado
$js->object('empresa', [
    'nome' => 'Tech Solutions',
    'fundacao' => 2010,
    'endereco' => [
        'rua' => 'Av. Paulista',
        'numero' => 1000,
        'cidade' => 'São Paulo'
    ],
    'funcionarios' => ['João', 'Maria', 'Pedro']
]);

// ============ 4. OPERADORES E EXPRESSÕES ============
$js->comment('=== 4. OPERADORES E EXPRESSÕES ===');

// Operações matemáticas
$js->var('soma', '5 + 3');
$js->var('subtracao', '10 - 4');
$js->var('multiplicacao', '6 * 7');
$js->var('divisao', '15 / 3');
$js->var('resto', '17 % 5');

// Operadores de comparação
$js->var('maior', 'idade > 18');
$js->var('menor', 'altura < 1.80');
$js->var('igual', 'nome === "João Silva"');
$js->var('diferente', 'cidade !== "São Paulo"');

// Operadores lógicos
$js->var('e_logico', 'ativo && idade > 18');
$js->var('ou_logico', 'ativo || admin');
$js->var('nao_logico', '!ativo');

// ============ 5. FUNÇÕES ============
$js->comment('=== 5. FUNÇÕES ===');

// Função tradicional
$js->function('saudacao', ['nome'], '
    return "Olá, " + nome + "! Bem-vindo ao sistema.";
');

// Função com múltiplos parâmetros
$js->function('calcularIMC', ['peso', 'altura'], '
    let imc = peso / (altura * altura);
    return imc.toFixed(2);
');

// Função anônima (atribuída a variável)
$js->var('dobro', $js->anonymousFunction(['x'], 'return x * 2;'));

// Arrow function (ES6)
$js->var('triplo', $js->arrowFunction(['x'], 'x * 3'));

// ============ 6. ESTRUTURAS DE CONTROLE ============
$js->comment('=== 6. ESTRUTURAS DE CONTROLE ===');

// If/Else
$js->if_('idade >= 18');
$js->consoleLog('"Maior de idade"');
$js->else_();
$js->consoleLog('"Menor de idade"');
$js->endif();

// If/Else If/Else
$js->if_('nota >= 7');
$js->consoleLog('"Aprovado"');
$js->elseIf_('nota >= 5');
$js->consoleLog('"Recuperação"');
$js->else_();
$js->consoleLog('"Reprovado"');
$js->endif();

// Switch
$js->switch_('diaSemana');
$js->case_('1');
$js->consoleLog('"Segunda-feira"');
$js->break_();
$js->case_('2');
$js->consoleLog('"Terça-feira"');
$js->break_();
$js->default_();
$js->consoleLog('"Outro dia"');
$js->endSwitch();

// ============ 7. LOOPS ============
$js->comment('=== 7. LOOPS ===');

// For tradicional
$js->for_('let i = 0', 'i < 5', 'i++');
$js->consoleLog('"i = " + i');
$js->endFor();

// For...in (para objetos)
$js->object('carro', ['marca' => 'Toyota', 'modelo' => 'Corolla', 'ano' => 2022]);
$js->forIn('prop', 'carro');
$js->consoleLog('prop + ": " + carro[prop]');
$js->endFor();

// For...of (para arrays)
$js->forOf('let fruta', 'frutas');
$js->consoleLog('"Fruta: " + fruta');
$js->endFor();

// While
$js->var('contador', 0);
$js->while_('contador < 3');
$js->consoleLog('"Contador: " + contador');
$js->var('contador', 'contador + 1');
$js->endWhile();

// Do...While
$js->var('numero', 5);
$js->do_();
$js->consoleLog('"Número: " + numero');
$js->var('numero', 'numero - 1');
$js->doWhile('numero > 0');

// forEach
$js->forEach('frutas', ['fruta', 'indice'], '
    console.log(indice + ": " + fruta);
');

// forEach com arrow function
$js->forEachArrow('numeros', ['n'], 'console.log(n * n)');

// ============ 8. INTERAÇÃO COM HTML ============
$js->comment('=== 8. INTERAÇÃO COM HTML ===');

// Selecionar elementos
$js->getElementById('titulo', 'tituloElemento');
$js->getElementsByClassName('item', 'itens');
$js->getElementsByTagName('p', 'paragrafos');
$js->querySelector('.container', 'container');
$js->querySelectorAll('li', 'listaItens');

// Manipular conteúdo
$js->innerHTML('tituloElemento', '"Novo Título"');
$js->innerText('container', '"Texto alterado"');
$js->textContent('paragrafos[0]', '"Primeiro parágrafo"');

// Manipular atributos
$js->setAttribute('container', 'class', '"container ativo"');
$js->getAttribute('container', 'class', 'classeContainer');
$js->removeAttribute('container', 'style');

// Manipular classes
$js->classListAdd('container', 'destaque');
$js->classListRemove('container', 'oculto');
$js->classListToggle('container', 'visivel');
$js->classListContains('container', 'destaque', 'temDestaque');

// Manipular estilos
$js->style('container', 'backgroundColor', 'red');
$js->style('container', 'fontSize', '16px');
$js->style('container', 'margin', '10px');

// ============ 9. CRIAÇÃO DE ELEMENTOS HTML ============
$js->comment('=== 9. CRIAÇÃO DE ELEMENTOS HTML ===');

// Criar elementos
$js->createElement('div', 'novaDiv');
$js->createTextNode('Texto da nova div', 'textoDiv');

// Adicionar atributos ao novo elemento
$js->setAttribute('novaDiv', 'id', '"minhaNovaDiv"');
$js->classListAdd('novaDiv', 'classe-nova');

// Adicionar texto à div
$js->appendChild('novaDiv', 'textoDiv');

// Adicionar à página
$js->getElementById('container-principal', 'containerPrincipal');
$js->appendChild('containerPrincipal', 'novaDiv');

// ============ 10. EVENTOS ============
$js->comment('=== 10. EVENTOS ===');

// Adicionar event listeners
$js->getElementById('meuBotao', 'botao');
$js->addEventListener('botao', 'click', 'function() { alert("Botão clicado!"); }');

// Eventos inline
$js->onClick('botao', 'function() { console.log("Clicou!"); }');
$js->onChange('meuInput', 'function(e) { console.log("Valor alterado:", e.target.value); }');
$js->onSubmit('meuForm', 'function(e) { e.preventDefault(); validarFormulario(); }');

// ============ 11. TIMERS ============
$js->comment('=== 11. TIMERS ===');

// setTimeout
$js->setTimeout('function() { alert("Passaram 3 segundos!"); }', 3000);

// setInterval com controle
$js->var('contadorInterval', 0);
$js->var('intervalId', 'setInterval(function() { 
    console.log("Intervalo executado:", ++contadorInterval);
    if (contadorInterval >= 5) {
        clearInterval(intervalId);
        console.log("Intervalo parado!");
    }
}, 1000)');

// ============ 12. TRY/CATCH/FINALLY ============
$js->comment('=== 12. TRY/CATCH/FINALLY ===');

$js->try_();
$js->var('resultado', 'JSON.parse("dados inválidos")');
$js->catch_('erro');
$js->consoleError('"Erro ao fazer parse:", erro');
$js->finally_();
$js->consoleLog('"Bloco finally executado"');
$js->endTry();

// ============ 13. CLASSES E INSTANCIAÇÃO ============
$js->comment('=== 13. CLASSES E INSTANCIAÇÃO ===');

// Definir classe
$js->klass('Produto', '
    constructor(nome, preco, quantidade) {
        this.nome = nome;
        this.preco = preco;
        this.quantidade = quantidade || 0;
    }
    
    get valorTotal() {
        return this.preco * this.quantidade;
    }
    
    adicionarEstoque(qtd) {
        this.quantidade += qtd;
        console.log(`Estoque de ${this.nome} atualizado: ${this.quantidade} unidades`);
    }
    
    removerEstoque(qtd) {
        if (qtd <= this.quantidade) {
            this.quantidade -= qtd;
            return true;
        }
        return false;
    }
    
    info() {
        return `${this.nome} - R$ ${this.preco} (${this.quantidade} em estoque)`;
    }
');

// Instanciar objetos da classe
$js->instanciar('produto1', 'Produto', ['Notebook', 3500, 10]);
$js->instanciar('produto2', 'Produto', ['Mouse', 50, 100]);
$js->instanciar('produto3', 'Produto', ['Teclado', 120, 30]);

// Usar métodos dos objetos
$js->consoleLog('produto1.info()');
$js->consoleLog('"Valor total em estoque: R$" + produto1.valorTotal');

$js->comment('Adicionar estoque');
$js->callMethod('produto1', 'adicionarEstoque', [5]);

$js->comment('Remover estoque');
$js->if_('produto2.removerEstoque(10)');
$js->consoleLog('"Estoque removido com sucesso"');
$js->else_();
$js->consoleLog('"Estoque insuficiente"');
$js->endif();

// ============ 14. ARRAY DE OBJETOS E OPERAÇÕES ============
$js->comment('=== 14. ARRAY DE OBJETOS ===');

// Criar array de produtos
$js->array('produtos', ['produto1', 'produto2', 'produto3']);

// Map - criar array de nomes
$js->map('produtos', 'p => p.nome', 'nomesProdutos');
$js->consoleLog('nomesProdutos');

// Filter - produtos com preço > 100
$js->filter('produtos', 'p => p.preco > 100', 'produtosCaros');
$js->consoleLog('produtosCaros');

// Reduce - somar valor total
$js->reduce('produtos', '(total, p) => total + p.valorTotal', '0', 'valorTotalGeral');
$js->consoleLog('"Valor total geral: R$" + valorTotalGeral');

// Find - encontrar produto por nome
$js->find('produtos', 'p => p.nome === "Mouse"', 'mouse');
$js->consoleLog('mouse.info()');

// Some - verificar se algum produto está sem estoque
$js->some('produtos', 'p => p.quantidade === 0', 'temSemEstoque');
$js->consoleLog('"Algum produto sem estoque? " + temSemEstoque');

// Every - verificar se todos têm estoque
$js->every('produtos', 'p => p.quantidade > 0', 'todosComEstoque');
$js->consoleLog('"Todos têm estoque? " + todosComEstoque');

// ============ 15. MÉTODOS DE STRING ============
$js->comment('=== 15. MÉTODOS DE STRING ===');

$js->var('texto', 'JavaScript é incrível!');

$js->length('texto', 'tamanho');
$js->consoleLog('"Tamanho: " + tamanho');

$js->toUpperCase('texto', 'textoMaiusculo');
$js->consoleLog('textoMaiusculo');

$js->toLowerCase('texto', 'textoMinusculo');
$js->consoleLog('textoMinusculo');

$js->indexOf('texto', '"incrível"', 0, 'posicao');
$js->consoleLog('"Posição da palavra incrível: " + posicao');

$js->includes('texto', '"JavaScript"', 0, 'temJavaScript');
$js->consoleLog('"Contém JavaScript? " + temJavaScript');

$js->replace('texto', '"incrível"', '"fantástico"', 'novoTexto');
$js->consoleLog('novoTexto');

$js->split('texto', '" "', null, 'palavras');
$js->consoleLog('palavras');

// ============ 16. MÉTODOS DE ARRAY ============
$js->comment('=== 16. MÉTODOS DE ARRAY ===');

$js->array('letras', ['a', 'b', 'c', 'd', 'e']);

// Push
$js->push('letras', ['f', 'g']);
$js->consoleLog('letras');

// Pop
$js->pop('letras', 'ultima');
$js->consoleLog('"Último elemento removido:", ultima');

// Shift
$js->shift('letras', 'primeira');
$js->consoleLog('"Primeiro elemento removido:", primeira');

// Unshift
$js->unshift('letras', ['x', 'y']);
$js->consoleLog('letras');

// Join
$js->join('letras', ' - ', 'stringUnida');
$js->consoleLog('stringUnida');

// Slice
$js->arraySlice('letras', 1, 3, 'subArray');
$js->consoleLog('subArray');

// ============ 17. MÉTODOS DE OBJETO ============
$js->comment('=== 17. MÉTODOS DE OBJETO ===');

// Object.keys
$js->objectKeys('pessoa', 'chaves');
$js->consoleLog('"Chaves do objeto pessoa:", chaves');

// Object.values
$js->objectValues('pessoa', 'valores');
$js->consoleLog('"Valores do objeto pessoa:", valores');

// Object.entries
$js->objectEntries('pessoa', 'entradas');
$js->consoleLog('"Entradas do objeto pessoa:", entradas');

// Object.assign (clonar objeto)
$js->objectAssign('{}', ['pessoa'], 'pessoaClone');
$js->consoleLog('pessoaClone');

// ============ 18. JSON ============
$js->comment('=== 18. JSON ===');

// Objeto para JSON string
$js->jsonStringify('pessoa', 'pessoaJSON');
$js->consoleLog('pessoaJSON');

// JSON string para objeto
$js->jsonParse('pessoaJSON', 'pessoaParsed');
$js->consoleLog('pessoaParsed');

// ============ 19. MATH ============
$js->comment('=== 19. MATH ===');

$js->mathRandom('aleatorio');
$js->consoleLog('"Número aleatório:", aleatorio');

$js->mathFloor('5.7', 'arredondadoBaixo');
$js->consoleLog('arredondadoBaixo');

$js->mathCeil('5.2', 'arredondadoCima');
$js->consoleLog('arredondadoCima');

$js->mathRound('5.5', 'arredondado');
$js->consoleLog('arredondado');

$js->mathMax([10, 20, 5, 8, 30], 'maximo');
$js->consoleLog('"Valor máximo:", maximo');

$js->mathMin([10, 20, 5, 8, 30], 'minimo');
$js->consoleLog('"Valor mínimo:", minimo');

// ============ 20. DATE ============
$js->comment('=== 20. DATE ===');

// Data atual
$js->newDate('agora');
$js->consoleLog('"Data atual:", agora');

// Data específica
$js->newDate('natal', [2025, 11, 25]);
$js->consoleLog('"Natal 2025:", natal');

// Timestamp atual
$js->dateNow('timestamp');
$js->consoleLog('"Timestamp atual:", timestamp');

// ============ 21. REGEX ============
$js->comment('=== 21. REGEX ===');

// Criar regex com new RegExp
$js->newRegExp('[a-z]+', 'gi', 'regexLetras');
$js->consoleLog('regexLetras');

// Regex literal
$js->var('regexNumeros', $js->regexLiteral('[0-9]+', 'g'));
$js->consoleLog('regexNumeros');

// Testar regex
$js->var('textoTeste', 'abc123');
$js->var('temLetras', 'regexLetras.test(textoTeste)');
$js->consoleLog('"Tem letras?", temLetras');

// ============ 22. PROMPT, CONFIRM E ALERT ============
$js->comment('=== 22. PROMPT, CONFIRM E ALERT ===');

// Alert (texto)
$js->alertText('Esta é uma mensagem de alerta!');

// Alert (expressão)
$js->alertExpr('"Bem-vindo, " + nome');

// Confirm
$js->confirm('Deseja continuar?', 'confirmacao');
$js->if_('confirmacao');
$js->alertText('Você escolheu continuar!');
$js->else_();
$js->alertText('Operação cancelada!');
$js->endif();

// Prompt
$js->prompt('Digite seu nome:', 'Visitante', 'nomeDigitado');
$js->if_('nomeDigitado && nomeDigitado !== "Visitante"');
$js->alertExpr('"Olá, " + nomeDigitado + "!"');
$js->endif();

// ============ 23. CONSOLE COM DIFERENTES NÍVEIS ============
$js->comment('=== 23. CONSOLE COM DIFERENTES NÍVEIS ===');

$js->consoleLog('"Mensagem normal de log"');
$js->consoleInfo('"Mensagem informativa"');
$js->consoleWarn('"Mensagem de aviso!"');
$js->consoleError('"Mensagem de erro!"');
$js->consoleDebug('"Mensagem de debug"');

// Console.table
$js->consoleTable('pessoa');
$js->consoleTable('frutas');

// Console.group
$js->consoleGroup('Informações da Pessoa');
$js->consoleLog('"Nome: " + pessoa.nome');
$js->consoleLog('"Idade: " + pessoa.idade');
$js->consoleLog('"Cidade: " + pessoa.cidade');
$js->consoleGroupEnd();

// Console.time
$js->consoleTime('loop');
$js->for_('let i = 0', 'i < 10000', 'i++');
$js->var('temp', 'i * i');
$js->endFor();
$js->consoleTimeEnd('loop');

// ============ 24. WINDOW ============
$js->comment('=== 24. WINDOW ===');

// window.location
$js->windowLocation('href', '"https://www.google.com"'); // Redirecionar
$js->windowLocation('pathname', 'caminho'); // Obter caminho

// window.open
$js->windowOpen('https://www.example.com', '_blank', 'width=800,height=600');

// window.scrollTo
$js->windowScrollTo(0, 500);

// ============ 25. OUTROS MÉTODOS ÚTEIS ============
$js->comment('=== 25. OUTROS MÉTODOS ÚTEIS ===');

// typeof
$js->typeof('nome', 'tipoNome');
$js->consoleLog('"Tipo da variável nome:", tipoNome');

// instanceof
$js->instanceof('produto1', 'Produto', 'ehProduto');
$js->consoleLog('"produto1 é instância de Produto?", ehProduto');

// in
$js->in('"nome"', 'pessoa', 'temNome');
$js->consoleLog('"pessoa tem propriedade nome?", temNome');

// delete
$js->delete('pessoaClone.telefone');

// isNaN
$js->isNaN('"abc"', 'naoNumero');
$js->consoleLog('"É NaN?", naoNumero');

// parseInt e parseFloat
$js->parseInt('"123.45"', 10, 'inteiro');
$js->parseFloat('"123.45"', 'flutuante');
$js->consoleLog('inteiro, flutuante');

// encodeURI / decodeURI
$js->encodeURI('"https://exemplo.com/página com espaços"', 'uriCodificada');
$js->consoleLog(uriCodificada);

// ============ 26. COMENTÁRIOS ============
$js->comment('=== 26. COMENTÁRIOS ===');

$js->comment('Este é um comentário de linha');

$js->commentBlock('Este é um comentário
de múltiplas linhas
que pode ter várias linhas');

// ============ 27. USE STRICT ============
$js->useStrict();

// ============ 28. DEBUGGER ============
$js->comment('Se quiser parar a execução para debug');
$js->debugger();

echo $js;
?>
"""
simples assim!
