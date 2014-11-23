<?php
namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keywords', 'text', [
                'constraints' =>[
                    new Assert\NotBlank([
                        'message' => "Įveskite paieškos žodžius"
                    ]),
                    new Assert\Length([
                        'min' => "2",
                        'max' => "255",
                        'minMessage' => "Minimalus paieškos simbolių kiekis {{ limit }} simboliai",
                        'maxMessage' => "Maksimalus paieškos simbolių kiekis  {{ limit }} simboliai"
                    ])
                ]
            ]);

    }
    public function getName()
    {
        return 'searchForm';
    }
}
