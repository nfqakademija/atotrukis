<?php
namespace Atotrukis\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class FutureDateTimeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $currentDateTime = new \DateTime();
        if ($currentDateTime >= $value) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}