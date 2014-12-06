<?php
namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class SearchFormType extends AbstractType
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($this->router->generate('search_results'))
            ->add('keywords', 'text', [
                'attr' =>[
                    'placeholder' => 'Įveskite paieškos žodžius'
                ],
            ]);

    }
    public function getName()
    {
        return 'searchForm';
    }
}
