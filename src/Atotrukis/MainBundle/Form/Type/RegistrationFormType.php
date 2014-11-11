<?php

namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', "text", [
            'constraints' =>[
                new Assert\NotBlank([
                    'message' => "Vardas negali būti tuščias"
                ]),
                new Assert\Length([
                    'min' => "2",
                    'max' => "255",
                    'minMessage' => "Vardas negali būti trumpesnis nei {{ limit }} simboliai",
                    'maxMessage' => "Vardas negali būti ilgesnis nei {{ limit }} simboliai"
                ])
            ]
        ]);
        parent::buildForm($builder, $options);
        $builder->remove('username');
    }
    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'atotrukis_user_registration';
    }

}

?>