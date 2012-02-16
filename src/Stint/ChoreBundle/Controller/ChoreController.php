<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Stint\ChoreBundle\Entity\Chore;
use Stint\ChoreBundle\Form\Type\ChoreType;

class ChoreController extends Controller
{

  public function newAction(Request $request)
  {
    $chore = new Chore();
    $chore->setDescription('A description');

    $form = $this->createForm(new ChoreType(), $chore);

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);

      if ($form->isValid())
      {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($chore); // can get chore from form with $form->getData()
        $em->flush();

        return $this->redirect($this->generateUrl('chore_new'));
      }
    }

    return $this->render('StintChoreBundle:Chore:new.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function listAction(Request $request)
  {
    $chores = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->findAll();
    return $this->render('StintChoreBundle:Chore:list.html.twig', array(
      'chores' => $chores,
    ));
  }
}