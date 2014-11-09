<?php

namespace Atotrukis\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QuizController extends Controller
{
    public function quizAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('q1', 'choice', array(
                'label' => 'Pirmas klausimas',
                'required'  => false,
                'choices' => array(array('ats1' => 'ats1'), array('ats2' => 'ats2')),
                'expanded' => true,
                'multiple' => true,
                'attr' => array('display' => 'block', 'class' => 'col-md-12')
            ))
            ->add('q2', 'choice', array(
                'label' => 'Antras klausimas',
                'required'  => false,
                'choices' => array(array('ats1' => 'ats1'), array('ats2' => 'ats2'), array('ats3' => 'ats3')),
                'expanded' => true,
                'multiple' => true,
                'attr' => array('display' => 'block', 'class' => 'col-md-12')
            ))
            ->add('q3', 'choice', array(
                'label' => 'Trecias klausimas',
                'required'  => false,
                'choices' => array(array('ats1' => 'ats1'), array('ats2' => 'ats2'), array('ats3' => 'ats3')),
                'expanded' => true,
                'multiple' => true,
                'attr' => array('display' => 'block', 'class' => 'col-md-12')
            ))
            ->add('save', 'submit', array('label' => 'Submit', 'attr' => array('class' => 'save')))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $k = '';
            foreach($form->getData() as $data) {
                foreach($data as $d) {
                    $k .= $d . ", ";
                }
            }
            echo $k;
            /*
             * To do: save keywords to database
             */
            return $this->render('AtotrukisMainBundle:Quiz:result.html.twig', array(

            ));
        }

        return $this->render('AtotrukisMainBundle:Quiz:quiz.html.twig', array(
               'form' => $form->createView()
        ));
    }

}
