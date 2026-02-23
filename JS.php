<?php
class JS {
    private $codigo = '';

    public function __construct($codigo = '') {
        $this->codigo = $codigo;
    }
    private $funcoesJS = array(
        'alert' => 'alert(%s);',
        'consoleLog' => 'console.log(%s);',
        'documentWrite' => 'document.write(%s);',
        'var' => 'var %s = %s;',
        'if' => 'if (%s) {',
        'else' => '} else {',
        'for' => 'for (%s) {',
        'while' => 'while (%s) {',
        'function' => 'function %s(%s) {',
        'return' => 'return %s;',
    );
    private $blocosAbertos = 0;
    public function __call($nomeFuncao, $args) {
        if (!isset($this->funcoesJS[$nomeFuncao])) {
            throw new Exception("Função JavaScript não encontrada: $nomeFuncao");
        }
        $argsStr = '';
        foreach ($args as $arg) {
            if (is_string($arg)) {
                $argsStr .= "'$arg', ";
            } else {
                $argsStr .= "$arg, ";
            }
        }
        $argsStr = rtrim($argsStr, ', ');

        $scr = sprintf($this->funcoesJS[$nomeFuncao], $argsStr);

        if (in_array($nomeFuncao, array('if', 'else', 'for', 'while', 'function'))) {
            $this->blocosAbertos++;
        }
        $retorno = "<script>$scr</script>";
        if ($this->blocosAbertos > 0 && $nomeFuncao != 'else') {
            $this->blocosAbertos--;
            $retorno .= "<script>}</script>";
        }
        return $retorno;
    }
    public function js($codigo) {
        return "<script>$codigo</script>";
    }
}
?>
