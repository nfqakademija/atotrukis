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
            ->add('startDate', 'datetime', [
                'constraints' =>[
                    new \Atotrukis\MainBundle\Validator\Constraints\FutureDateTime([
                        'message' => "Pradžios laikas negali būti ankstesnis už dabartinį laiką."
                    ])
                ]
            ])
            ->add('endDate', 'datetime', [
                'constraints' =>[
                    new \Atotrukis\MainBundle\Validator\Constraints\FutureDateTime([
                        'message' => "Pabaigos laikas negali būti ankstesnis už dabartinį laiką."
                    ])
                ]
            ])
            ->add('map', 'text')
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
            ))
            ->add('save', 'submit', array('label' => 'Sukurti'));
    }
    public function getName()
    {
        return 'createEventForm';
    }

}