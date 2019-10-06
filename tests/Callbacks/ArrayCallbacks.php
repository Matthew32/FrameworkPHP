<?php

namespace Test\Callbacks;


use Test\PHPUnitFramework;

class ArrayCallbacks extends PHPUnitFramework
{
    protected $arrayKey;

    protected $constraint;

    protected $value;

    /**
     * @param PHPUnit_Framework_Constraint $constraint
     * @param string $arrayKey
     */
    public function __construct(PHPUnitFramework $constraint, $arrayKey)
    {
        $this->constraint = $constraint;
        $this->arrayKey = $arrayKey;
    }


    /**
     * Evaluates the constraint for parameter $other. Returns TRUE if the
     * constraint is met, FALSE otherwise.
     *
     * @param mixed $other Value or object to evaluate.
     * @return bool
     */
    public function evaluate($other)
    {
        if (!array_key_exists($this->arrayKey, $other)) {
            return false;
        }

        $this->value = $other[$this->arrayKey];

        return $this->constraint->evaluate($other[$this->arrayKey]);
    }


    protected function customFailureDescription($other, $description, $not)
    {
        return sprintf('Failed asserting that %s.', $this->toString());
    }
}