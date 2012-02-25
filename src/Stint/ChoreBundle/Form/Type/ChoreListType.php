<?php
namespace Stint\ChoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Stint\ChoreBundle\Entity\ChoreList;

class ChoreListType extends AbstractType
{

  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('name', 'text');
  }

  public function getName()
  {
    return 'choreList';
  }
}