<?php
namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Assert;
class CreateEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'constraints' =>[
                    new Assert\NotBlank([
                        'message' => "Renginio pavadinimas negali būti tuščias"
                    ]),
                    new Assert\Length([
                        'min' => "2",
                        'max' => "255",
                        'minMessage' => "Renginio pavadinimas negali būti trumpesnis nei {{ limit }} simboliai",
                        'maxMessage' => "Renginio pavadinimas negali būti ilgesnis nei {{ limit }} simboliai"
                    ])
                ]
            ])
            ->add('description', 'textarea', [
                'constraints' =>[
                    new Assert\NotBlank([
                        'message' => "Renginio aprašymas negali būti tuščias"
                    ]),
                    new Assert\Length([
                        'min' => "10",
                        'max' => "5000",
                        'minMessage' => "Renginio aprašymas negali būti trumpesnis nei {{ limit }} simbolių",
                        'maxMessage' => "Renginio aprašymas negali būti ilgesnis nei {{ limit }} simbolių"
                    ])
                ]
            ])
            ->add('startDate', 'collot_datetime', [
                'pickerOptions' => [
                    'format' => 'mm/dd/yyyy',
                    'weekStart' => 0,
                    'startDate' => date('m/d/Y'), //example
                    'endDate' => '01/01/3000', //example
                    'daysOfWeekDisabled' => '0,6', //example
                    'autoclose' => false,
                    'startView' => 'month',
                    'minView' => 'hour',
                    'maxView' => 'decade',
                    'todayBtn' => false,
                    'todayHighlight' => false,
                    'keyboardNavigation' => true,
                    'language' => 'en',
                    'forceParse' => true,
                    'minuteStep' => 5,
                    'pickerReferer ' => 'default', //deprecated
                    'pickerPosition' => 'bottom-right',
                    'viewSelect' => 'hour',
                    'showMeridian' => false,
                    'initialDate' => date('m/d/Y', 1577836800), //example
                ],
                'constraints' =>[
                    new \Atotrukis\MainBundle\Validator\Constraints\FutureDateTime([
                        'message' => "Pradžios laikas negali būti ankstesnis už dabartinį laiką."
                    ])
                ]
            ])
            ->add('endDate', 'collot_datetime', [
                'pickerOptions' => [
                    'format' => 'mm/dd/yyyy',
                    'weekStart' => 0,
                    'startDate' => date('m/d/Y'), //example
                    'endDate' => '01/01/3000', //example
                    'daysOfWeekDisabled' => '0,6', //example
                    'autoclose' => false,
                    'startView' => 'month',
                    'minView' => 'hour',
                    'maxView' => 'decade',
                    'todayBtn' => false,
                    'todayHighlight' => false,
                    'keyboardNavigation' => true,
                    'language' => 'en',
                    'forceParse' => true,
                    'minuteStep' => 5,
                    'pickerReferer ' => 'default', //deprecated
                    'pickerPosition' => 'bottom-right',
                    'viewSelect' => 'hour',
                    'showMeridian' => false,
                    'initialDate' => date('m/d/Y', 1577836800), //example
                ],
                'constraints' =>[
                    new \Atotrukis\MainBundle\Validator\Constraints\FutureDateTime([
                        'message' => "Pabaigos laikas negali būti ankstesnis už dabartinį laiką."
                    ])
                ]
            ])
            ->add('keywords', 'text', [
                'attr' =>[
                    'placeholder' => 'Įveskite paieškos žodžius'
                ],
                'mapped' => false,
                'constraints' =>[
                    new Assert\NotBlank([
                        'message' => "Renginio raktažodžiai negali būti tušti"
                    ]),
                    new Assert\Length([
                        'min' => "2",
                        'max' => "255",
                        'minMessage' => "Renginio raktažodžiai negali būti trumpesni nei {{ limit }} simboliai",
                        'maxMessage' => "Renginio raktažodžiai negali būti ilgesni nei {{ limit }} simboliai"
                    ])
                ]
            ])
            ->add('map', 'hidden')
            ->add('city', 'entity', array(
                'class' => 'AtotrukisMainBundle:City',
                'property' => 'name',
                'constraints' =>[
                    new Assert\NotBlank([
                        'message' => "Privalote pasirinkti miestą"
                    ])
                ],
                'empty_value' => 'Pasirinkite miestą',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->addOrderBy('c.priority', 'ASC')
                        ->addOrderBy('c.name', 'ASC');
                },
            ));
    }
    public function getName()
    {
        return 'createEventForm';
    }

}