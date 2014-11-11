<?php
namespace Atotrukis\MainBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateRange extends Constraint {

    public $message = 'Your message';

    public function getTargets() {
        return Constraint::CLASS_CONSTRAINT;
    }
}