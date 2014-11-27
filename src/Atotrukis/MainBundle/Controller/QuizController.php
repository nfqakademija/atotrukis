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
            $form->handleRequest($request);
            $usr = $this->getDoctrine()->getRepository('AtotrukisMainBundle:User')
                ->findOneById($this->get('security.context')->getToken()->getUser());
            foreach ($form->getData() as $data) {
                if (is_array($data)) {
                    foreach ($data as $k) {
                        $this->get('userKeywordService')->addKeyword($k, $usr);
                    }
                } else {
                    $keywords = preg_split("/[, ]/", $data);
                    foreach ($keywords as $keys) {
                        $this->get('userKeywordService')->addKeyword($keys, $usr);
                    }
                }
            }
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
