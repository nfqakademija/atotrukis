<?php
namespace Atotrukis\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class CreateCommentFormType extends AbstractType
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
            ->setAction($this->router->generate('comment_form'))
            ->add('comment', 'textarea')
            ->add('eventId', 'hidden', ['mapped' => false]);
    }
    public function getName()
    {
        return 'createCommentForm';
    }

}