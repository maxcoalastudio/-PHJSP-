# -PHJSP-
Um parse com um inject JS para usar no PHP. de forma simples conseguimos concatenar o JS no PHP. [Em desenvolvimento]
no seu documento principal php faça:
"""

<?php
class JS {
    private $codigo = '';
    private $blocosAbertos = 0;
    private $vars = array();
    private $blocos = array(
        'if' => true,
        'else' => true,
        'for' => true,
        'while' => true,
        'function' => true,
        'switch' => true,
        'try' => true,
        'catch' => true,
    );

    public function __call($nomeFuncao, $args) {
        $funcoesJS = array(
            'alert' => 'alert(%s);',
            'consoleLog' => 'console.log(%s);',
            'documentWrite' => 'document.write(%s);',
            'if' => 'if (%s) {',
            'else' => '} else {',
            'for' => 'for (%s) {',
            'while' => 'while (%s) {',
            'function' => 'function %s(%s) {',
            'return' => 'return %s;',
            'switch' => 'switch (%s) {',
            'case' => 'case %s:',
            'break' => 'break;',
            'default' => 'default:',
            'try' => 'try {',
            'catch' => '} catch (%s) {',
            'throw' => 'throw %s;',
            'new' => 'new %s(%s);',
            'instanceof' => '%s instanceof %s',
            'typeof' => 'typeof %s',
            'delete' => 'delete %s;',
            'void' => 'void %s;',
        );

        if (!isset($funcoesJS[$nomeFuncao])) {
            throw new Exception("Função JavaScript (não encontrada: $nomeFuncao)");
        }

        if (isset($this->blocos[$nomeFuncao])) {
            $this->blocosAbertos++;
        }

        if ($nomeFuncao == 'function') {
            $nome = $args[0];
            $parametros = implode(', ', $args[1]);
            $scr = sprintf($funcoesJS[$nomeFuncao], $nome, $parametros);
        } else {
            $argsStr = '';
            foreach ($args as $arg) {
                if (is_array($arg)) {
                    $argsStr .= implode(', ', $arg) . ', ';
                } elseif (is_string($arg) && !isset($this->vars[$arg])) {
                    $argsStr .= $this->parseExpression($arg) . ', ';
                } else {
                    $argsStr .= $arg . ', ';
                }
            }
            $argsStr = rtrim($argsStr, ', ');
            $scr = sprintf($funcoesJS[$nomeFuncao], $argsStr);
        }

        $this->codigo .= $scr;
    }

    private function parseExpression($expr) {
        $expr = trim($expr);
        if (preg_match('/^([a-zA-Z0-9_]+)\s*\+\s*([a-zA-Z0-9_]+)$/', $expr, $match)) {
            return '(' . $match[1] . ' + ' . $match[2] . ')';
        }
        if (preg_match('/^([a-zA-Z0-9_]+)\s*-\s*([a-zA-Z0-9_]+)$/', $expr, $match)) {
            return '(' . $match[1] . ' - ' . $match[2] . ')';
        }
        if (preg_match('/^([a-zA-Z0-9_]+)\s*(==|!=|>|<|>=|<=)\s*([a-zA-Z0-9_]+)$/', $expr, $match)) {
            return '(' . $match[1] . ' ' . $match[2] . ' ' . $match[3] . ')';
        }
        return $expr;
    }

    public function for_($init, $cond, $incr) {
        $this->codigo .= 'for (' . $init . '; ' . $cond . '; ' . $incr . ') {';
        $this->blocosAbertos++;
    }
    public function for($args) {
    $expr = '';
    foreach ($args as $arg) {
        if (is_array($arg)) {
            $expr .= implode(' ', $arg) . '; ';
        } else {
            $expr .= $arg . '; ';
        }
    }
    $expr = rtrim($expr, '; ');
    $this->codigo .= 'for (' . $expr . ') {';
}

    public function __destruct() {
        while ($this->blocosAbertos > 0) {
            $this->codigo .= "}";
            $this->blocosAbertos--;
        }
    }

    public function var($nome, $valor) {
        if (is_numeric($valor)) {
            $valor = (int)$valor;
        } elseif (is_bool($valor)) {
            $valor = $valor ? 'true' : 'false';
        } elseif (is_string($valor)) {
            $valor = "'" . $valor . "'";
        } elseif (is_null($valor)) {
            $valor = 'null';
        }
        $this->vars[$nome] = $valor;
        $this->codigo .= "var $nome = $valor;";
    }

    public function objeto($nome, $propriedades) {
        $this->codigo .= "var $nome = {";
        foreach ($propriedades as $prop => $valor) {
            $this->codigo .= "$prop: '$valor', ";
        }
        $this->codigo = rtrim($this->codigo, ', ') ;
    }
    public function new($classe, ...$args) {
        $argsStr = '';
        foreach ($args as $arg) {
            if (is_array($arg)) {
                $argsStr .= implode(', ', $arg) . ', ';
            } elseif (is_string($arg) && !isset($this->vars[$arg])) {
                $argsStr .= $this->parseExpression($arg) . ', ';
            } else {
                $argsStr .= $arg . ', ';
            }
        }
        $argsStr = rtrim($argsStr, ', ');
        $this->codigo .= 'new ' . $classe . '(' . $argsStr . ')';
    }
    public function array($nome, $elementos) {
        $this->codigo .= "var $nome = [";
        foreach ($elementos as $elemento) {
            $this->codigo .= "'$elemento', ";
        }
        $this->codigo = rtrim($this->codigo, ', ') . "];";
    }

    public function function($nome, $parametros, $corpo) {
        $parametrosStr = implode(', ', $parametros);
        $this->codigo .= 'function ' . $nome . '(' . $parametrosStr . ') {' . $corpo . '}';
    }

    private function gerarCodigo() {
        $blocos = array('if', 'else', 'for', 'while', 'function', 'switch', 'try', 'catch');
        $ultimoBloco = substr($this->codigo, -10);
        if (in_array(explode(' ', $ultimoBloco)[0], $blocos)) {
            return $this->codigo . "}";
        } else {
            return $this->codigo;
        }
    }
    
    public function __toString() {
        return "<script>" . $this->gerarCodigo() . "</script>";
    }
}
?>
"""
simples assim!
