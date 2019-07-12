<?php

class MathEval
{
    private $error;

    public function getExpressionEval($expression)
    {
        if (!$this->validateExpression($expression)) {
            return $this->getError();
        }

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
     * Получить сообщение об ошибке
     * @return mixed
     */
    private function getError()
    {
        return $this->error;
    }

    /**
     * Проверка введенного выражения на валидность
     * @param $expression string - входящее математическое выражение в виде строки
     * @return bool - валидное или нет
     */
    private function validateExpression($expression)
    {
        $validSymbols = $this->getRegValidSymbols();
        if (preg_math('/[0-9'.$validSymbols.']/',$expression)) {
            $this->setError('В выражении используются недопустимые символы. Необходимо использовать только числа и следующие математические знаки: '.$this->getListValidSymbols());
            return false;
        }

        $checkExpression = preg_replace(['/\d{1,}/','/[^\d]/'],['1','_'],$expression);
        if (preg_match('/['.$validSymbols.']{2,}/',$checkExpression)) {
            $this->setError('В выражении нельзя использовать два или больше подряд знаков математических действий.');
            return false;
        }

        if ($checkExpression[0] == '_') {
            $this->setError('Выражение не должно начинаться со знака математического действия.');
            return false;
        }

        if ($checkExpression[strlen($checkExpression)-1] == '_') {
            $this->setError('Выражение не должно заказнчиваться знаком математического действия.');
            return false;
        }

        return true;
    }

    private function evalExpression($expression)
    {

    }

}