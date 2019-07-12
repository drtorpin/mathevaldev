<?php
/**
 * Класс проверяет на валидность и вычисляет математическое выражение из строки
 * Class MathEval
 */
class MathEval
{
    /**
     * @var еstring - текст ошибки
     */
    private $error;

    /**
     * Вычисляем входящее математическое выражение
     * @param $expression
     * @return mixed
     */
    public function getExpressionEval($expression)
    {
        if (!$this->validateExpression($expression)) {
            $this->getError();
        }

        $result = $this->evalExpression($expression);
        if ($this->getError()) {
            return $this->getError();
        } else {
            return $result;
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
            '*',
            ':'
        ];
    }

    /**
     * Вычисление
     * @param $number1 integer - исходное число
     * @param $sign string - математический знак из выражения
     * @param $number2 integer - второе число в выражении
     * @return float|int - результат вычисления одного действия
     */
    private function evalMathAction($number1,$sign,$number2)
    {
        switch ($sign) {
            case '+':
                return $number1 + $number2;
            case '-':
                return $number1 - $number2;
            case ':':
                return $number1/$number2;
            case '*':
                return $number1 * $number2;
        }
        $this->setError('Ошибка при вычислениее. Не определено математическое действие.');
        return 0;
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

    /**
     * @param $expression string - математическое выражение
     * @return integer - результат вычисления
     */
    private function evalExpression($expression)
    {
        $expressionCheck = trim(preg_replace('/(\d{1,})/','\1 ',$expression));
        $expressionParts = explode(' ',$expressionCheck);
        $count = count($expressionParts);
        if ($count > 1) {
            $result = $expressionParts[$n];
            for ($n = 0; $n < $count; $n+2) {
                if (isset($expressionParts[$n+2]) ) {
                    $result = $this->evalMathAction($result,$expressionParts[$n+1],$expressionParts[$n+2]);
                }
            }
        } else {
            return $expression;
        }

        return $result;
    }

}