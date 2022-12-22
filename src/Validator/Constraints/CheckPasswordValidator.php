<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Service\UtilService;

/**
 * @Annotation
 */
final class CheckPasswordValidator extends ConstraintValidator
{
    private $us;

    public function __construct(UtilService $us){
        $this->us = $us;
    }

    public function validate($value, Constraint $constraint): void
    {
        if ($this->us->checkPassword($value) != 0) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}