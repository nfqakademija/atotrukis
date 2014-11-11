<?php
namespace Atotrukis\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


class FutureDateTime extends Constraint
{
    public $message = 'Date cannot be earlier than current date.';
}