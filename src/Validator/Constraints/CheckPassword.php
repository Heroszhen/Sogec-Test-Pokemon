<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckPassword extends Constraint
{
    public $message = 'Le format du mot de passe n\'est pas correct';
}