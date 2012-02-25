<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Stint\ChoreBundle\Entity\User;
use Stint\ChoreBundle\Form\Type\UserType;

class UserController extends Controller
{

  public function showAction($id)
  {
    $user = $this->getDoctrine()->getRepository('StintChoreBundle:User')->find($id);
    return $this->render('StintChoreBundle:User:show.html.twig', array(
      'user' => $user,
    ));
  }

  public function createAction(Request $request)
  {
    $user = new User();
    $form = $this->createForm(new UserType(), $user);
    $form->bindRequest($request);

    if ($form->isValid())
    {
      $em = $this->getDoctrine()->getEntityManager();
      $em->persist($user);
      $em->flush();

      $this->get('session')->setFlash('success', 'User created.');
    }
    else
    {
      $this->get('session')->setFlash('error', 'Creating user failed.');
    }

    return $this->redirect($this->generateUrl('home'));
  }
}