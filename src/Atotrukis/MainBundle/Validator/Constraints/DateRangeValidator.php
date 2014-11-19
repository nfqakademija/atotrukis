<?php
namespace Atotrukis\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateRangeValidator extends ConstraintValidator
{

    public function validate($obj, Constraint $constraint)
    {
        if ($obj->getStartDate() > $obj->getEndDate()) {
            $this->context->buildViolation('Pabaigos laikas negali būti anksčiau nei pradžios laikas.')
                ->atPath('endDate')
                ->addViolation();
        }
    }
}
