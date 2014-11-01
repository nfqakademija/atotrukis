<?php
namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
class CreateEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('map', 'text')
            ->add('city', 'entity', array(
                'class' => 'AtotrukisMainBundle:City',
                'property' => 'name',
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