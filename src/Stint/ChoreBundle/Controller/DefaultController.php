<?php
namespace Stint\ChoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Stint\ChoreBundle\Entity\Chore;
use Stint\ChoreBundle\Entity\ChoreList;
use Stint\ChoreBundle\Entity\User;

use Stint\ChoreBundle\Form\Type\ChoreListType;
use Stint\ChoreBundle\Form\Type\UserType;

class DefaultController extends Controller
{
  public function homeAction()
  {
    $choreLists = $this->getDoctrine()->getRepository('StintChoreBundle:ChoreList')->findAll();
    $listForm = $this->createForm(new ChoreListType());
    
    $users = $this->getDoctrine()->getRepository('StintChoreBundle:User')->findAll();
    $userForm = $this->createForm(new UserType());

    return $this->render('StintChoreBundle:Default:home.html.twig', array(
      'choreLists' => $choreLists,
      'users' => $users,
      'listForm' => $listForm->createView(),
      'userForm' => $userForm->createView()
    ));
  }

  public function breadcrumbsAction($object = null)
  {
    $path = array();
    $path['Home'] = $this->generateUrl('home');

    if ($object !== null)
    {
      switch(get_class($object))
      {
        case 'Stint\ChoreBundle\Entity\ChoreList':
          $path[$object->getName()] = $this->generateUrl('chorelist_show', array('id' => $object->getId()));
          break;

        case 'Stint\ChoreBundle\Entity\Chore':
          $choreList = $object->getChoreList();
          $path[$choreList->getName()] = $this->generateUrl('chorelist_show', array('id' => $choreList->getId()));
          if ($object->getId())
          {
            $path[$object->getDescription()] = $this->generateUrl('chore_show', array('id' => $object->getId()));
          }
          else
          {
            $path['New'] = null;
          }
          break;

        case 'Stint\ChoreBundle\Entity\User':
          $path[$object->getName()] = $this->generateUrl('user_show', array('id' => $object->getId()));
          break;

        default:
          $path['UNKNOWN OBJECT'] = null;
          break;
      }
    }

    return $this->render('StintChoreBundle:Default:breadcrumbs.html.twig', array(
      'path' => $path,
    ));
  }
}