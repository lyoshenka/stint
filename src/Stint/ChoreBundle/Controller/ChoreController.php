<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Stint\ChoreBundle\Entity\Chore;
use Stint\ChoreBundle\Form\Type\ChoreType;
use Stint\ChoreBundle\Entity\ChoreList;
use Stint\ChoreBundle\Entity\User;

class ChoreController extends Controller
{
  public function showAction($id)
  {
    $chore = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->find($id);
    if (!$chore)
    {
      throw $this->createNotFoundException('Chore ' . $id . ' not found.');
    }

//    $userRepo = $this->get('stint.repo.user');
//    $unassignedUsers = $userRepo->findUnassignedToChore($chore);
    $em = $em = $this->getDoctrine()->getEntityManager();
    $unassignedUsers = $em->getRepository('StintChoreBundle:User')->findUnassignedToChore($chore);

    return $this->render('StintChoreBundle:Chore:show.html.twig', array(
      'chore' => $chore,
      'unassignedUsers' => $unassignedUsers
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

    return $this->redirect($this->generateUrl('chorelist_show', array('id' => $chore->getChoreList()->getId())));
  }

  public function assignAction($choreId, $userId)
  {
    $chore = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->find($choreId);
    $user = $this->getDoctrine()->getRepository('StintChoreBundle:User')->find($userId);
    if (!$chore || !$user)
    {
      $this->get('session')->setFlash('error', 'Could not find chore or user');
      return $this->redirect($this->generateUrl('chore_list'));
    }

//    $user->addChore($chore); // why does this not work, but the opposite does?
    $chore->addUser($user);
    $this->getDoctrine()->getEntityManager()->flush();
    $this->get('session')->setFlash('success', 'Assigned chore to ' . $user->getName());
    return $this->redirect($this->generateUrl('chore_show', array('id' => $chore->getId())));
  }

  public function unassignAction($choreId, $userId)
  {
    $chore = $this->getDoctrine()->getRepository('StintChoreBundle:Chore')->find($choreId);
    $user = $this->getDoctrine()->getRepository('StintChoreBundle:User')->find($userId);
    if (!$chore || !$user)
    {
      $this->get('session')->setFlash('error', 'Could not find chore or user');
      return $this->redirect($this->generateUrl('chore_list'));
    }

//    $user->addChore($chore); // why does this not work, but the opposite does?
    $chore->getUsers()->removeElement($user);
    $this->getDoctrine()->getEntityManager()->flush();
    $this->get('session')->setFlash('success', $user->getName() . ' removed from chore.');
    return $this->redirect($this->generateUrl('chore_show', array('id' => $chore->getId())));

  }
}