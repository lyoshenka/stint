<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Stint\ChoreBundle\Entity\Chore;
use Stint\ChoreBundle\Form\Type\ChoreType;
use Stint\ChoreBundle\Entity\ChoreList;

class ChoreController extends Controller
{
  public function showAction($id)
  {
    $chore = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->find($id);
    if (!$chore)
    {
      throw $this->createNotFoundException('Chore ' . $id . ' not found.');
    }

    return $this->render('StintChoreBundle:Chore:show.html.twig', array(
      'chore' => $chore,
    ));
  }
  
  public function newAction(Request $request)
  {
    $choreList = $choreLists = $this->getDoctrine()->getRepository('StintChoreBundle:ChoreList')->find($request->get('listId'));
    if (!$choreList)
    {
      throw $this->createNotFoundException('Chore list ' . $request->get('listId') . ' not found.');
    }

    $chore = new Chore();
    $chore->setDescription('A description');
    $chore->setChoreList($choreList);

    $form = $this->createForm(new ChoreType(), $chore);

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);

      if ($form->isValid())
      {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($chore); // can get chore from form with $form->getData()
        $em->flush();

        $this->get('session')->setFlash('success', 'Chore created.');

        return $this->redirect($this->generateUrl('chorelist_show', array('id' => $choreList->getId())));
      }
    }

    return $this->render('StintChoreBundle:Chore:new.html.twig', array(
      'form' => $form->createView(),
      'chore' => $chore
    ));
  }

  public function deleteAction($id)
  {
    $chore = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->find($id);
    if (!$chore)
    {
      $this->get('session')->setFlash('error', 'Chore with id ' . $id . ' not found.');
      return $this->redirect($this->generateUrl('chore_list'));
    }

    $em = $this->getDoctrine()->getEntityManager();
    $em->remove($chore);
    $em->flush();

    $this->get('session')->setFlash('success', 'Chore "' . $chore->getDescription() . '"deleted.');

    return $this->redirect($this->generateUrl('chore_list'));
  }
}