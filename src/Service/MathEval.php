<?php

class MathEval
{
    private $error;

    public function getExpressionEval($expression)
    {
        // $expression
    }

    /**
     * Список разрешенных знаков математических операций
     * @return array
     */
    private function getValidSymbols()
    {
        return [
            '-',
            '+',
            '=',
            ':'
        ];
    }

    /**
     * Вывод разрешенных знаков математических операций для регулярного выражения
     * @return string
     */
    private function getRegValidSymbols()
    {
        return join('',$this->getValidSymbols());
    }

    /**
     * Вывод разрешенных знаков математических операций в виде списка для вывода в тексты ошибок
     * @return string
     */
    private function getListValidSymbols()
    {
        return join(',',$this->getValidSymbols());
    }

    /**
     * Установка текста ошибки
     * @param $message
     */
    private function setError($message)
    {
        $this->error = $message;
    }

    /**
     * @param $expression
     */
    private function validateExpression($expression)
    {
        if (preg_math('/[0-9'.$this->getRegValidSymbols().']/',$expression)) {
            return $this->setError('В выражении используются недопустимые символы. Необходимо использовать только числа и знаки: '.$this->getListValidSymbols());
        }

        $expression = preg_replace(['/\d{1,}/','/[^\d]/'],['1','_'],$expression);
    }

    private function parceExpression($expression)
    {
        // $expression =
    }
}