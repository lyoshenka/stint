<?php
namespace Stint\ChoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Stint\ChoreBundle\Entity\Chore;

class ChoreType extends AbstractType
{

  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('description', 'text');

    $builder->add('period', 'choice', array(
      'choices' => array(Chore::DAILY => 'Daily', Chore::WEEKLY => 'Weekly', Chore::MONTHLY => 'Monthly', Chore::YEARLY => 'Yearly'),
      'label' => 'Repeats'
    ));

    $builder->add('frequency', 'choice', array(
      'choices' => array_combine(range(1,30), range(1,30)),
      'label' => 'Repeat every'
    ));


    $builder->add('start_date', 'date', array(
      'label' => 'Starts on',
      'widget' => 'single_text',
      'format' => 'dd/MM/yyyy'
    ));


    $builder->add('end_count', 'text', array(
      'label' => 'End after',
      'max_length' => 2,
      'required' => false,
      'attr' => array('size' => '2')
    ));

    $builder->add('end_date', 'date', array(
      'label' => 'End on',
      'widget' => 'single_text',
      'format' => 'dd/MM/yyyy',
      'required' => false
    ));
  }

  public function getName()
  {
    return 'chore';
  }
}