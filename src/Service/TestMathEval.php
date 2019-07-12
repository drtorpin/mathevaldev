<?php
/**
 * UNIT-test
 * Class TestMathEval
 */
use MathEval;

class TestMathEval extends MathEval
{
    public function test()
    {
        echo $this->TestEvalExpression('10-5');

        echo $this->TestValidateExpression('10-5');
        echo $this->TestValidateExpression('10+5+');
        echo $this->TestValidateExpression('+10-5');

        echo $this->TestEvalMathAction(10,'+',15);
        echo $this->TestEvalMathAction(10,':',15);
        echo $this->TestEvalMathAction(10,'+',15);
    }

}