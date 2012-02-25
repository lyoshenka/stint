<?php
namespace Stint\ChoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Stint\ChoreBundle\Entity\User;

class UserType extends AbstractType
{

  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('name', 'text');
    $builder->add('email', 'text');
  }

  public function getName()
  {
    return 'user';
  }
}