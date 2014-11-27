<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QuizController extends Controller
{
    /**
     * creates quiz form and if user submits it when redirects to home page, removes unnecessary
     * FosUserBundle flashBag and creates new flashBag with success message
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function quizAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('q1', 'choice', array(
                'label' => 'Pasirink muzikos žanrus, kuriuos mėgsti',
                'required'  => false,
                'choices' => array(
                    array('rokas' => 'Rokas'),
                    array('elektroninė' => 'Elektroninė muzika'),
                    array('pop' => 'Pop'),
                    array('repas' => 'Repas')
                ),
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('t1', 'textarea', array(
                'attr' => array('class' => 'col-md-12', 'style' => 'width: 100%'),
                'label' => 'Įveskite savo mėgstamus nepaminėtus žanrus:',
                'required'  => false,
            ))
            ->add('q2', 'choice', array(
                'label' => 'Sporto šakos, į kurių varžybas ar kitus renginius norėtum nueiti',
                'required'  => false,
                'choices' => array(
                    array('krepšinis' => 'Krepšinis'),
                    array('futbolas' => 'Futbolas'),
                    array('tinklinis' => 'Tinklinis'),
                    array('ritulys' => 'Ledo ritulys')
                ),
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('t2', 'textarea', array(
                'attr' => array('class' => 'col-md-12', 'style' => 'width: 100%'),
                'label' => 'Įveskite kitas savo mėgstamas sporto šakas:',
                'required'  => false,
            ))
            ->add('q3', 'choice', array(
                'label' => 'Į kuriuos iš šių renginių tipų norėtum nueiti?',
                'required'  => false,
                'choices' => array(
                    array('paroda' => 'Paroda'),
                    array('spektaklis' => 'Spektaklis'),
                    array('seminaras' => 'Seminaras'),
                    array('vakarėlis' => 'Vakarėlis')
                ),
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('t3', 'textarea', array(
                'attr' => array('class' => 'col-md-12', 'style' => 'width: 100%'),
                'label' => 'Įveskite kitas renginių rūšis:',
                'required'  => false
            ))
            ->add('save', 'submit', array(
                'label' => 'Baigti apklausą', 'attr' => array('class' => 'btn btn-default save')
            ))
            ->getForm();
        
        if ($request->getMethod() == 'POST') {
            $this->get('quizService')->addKeywords($form, $request);
            $flashBag = $this->get('session')->getFlashBag();
            foreach ($flashBag->keys() as $type) {
                $flashBag->set($type, array());
            }
            $request->getSession()->getFlashBag()->add('success', 'Ačiū, kad atsakėte į klausimus. Dabar jau galite peržiūrėti jums rekomenduojamus renginius.');
            return $this->redirect($this->generateUrl('atotrukis_hello_world'));
        }

        return $this->render('AtotrukisMainBundle:Quiz:quiz.html.twig', array(
               'form' => $form->createView()
        ));
    }
}
