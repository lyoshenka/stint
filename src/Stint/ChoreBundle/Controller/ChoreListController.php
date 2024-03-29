<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Stint\ChoreBundle\Entity\ChoreList;
use Stint\ChoreBundle\Form\Type\ChoreListType;

class ChoreListController extends Controller
{

  public function showAction($id)
  {
    $choreList = $this->getDoctrine()->getRepository('StintChoreBundle:ChoreList')->find($id);
    return $this->render('StintChoreBundle:ChoreList:show.html.twig', array(
      'choreList' => $choreList,
    ));
  }

  public function createAction(Request $request)
  {
    $choreList = new ChoreList();
    $form = $this->createForm(new ChoreListType(), $choreList);
    $form->bindRequest($request);

    if ($form->isValid())
    {
      $em = $this->getDoctrine()->getEntityManager();
      $em->persist($choreList);
      $em->flush();

      $this->get('session')->setFlash('success', 'Chore list created.');
    }
    else
    {
      $this->get('session')->setFlash('error', 'Creating list failed.');
    }

    return $this->redirect($this->generateUrl('home'));
  }
}