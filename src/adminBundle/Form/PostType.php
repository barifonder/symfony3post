<?php

namespace adminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title')
        ->add('description')
        ->add('body')
        ->add('slug')

        ->add('datepublish',DateType::class,array(
            'widget' => 'choice',
            'format' =>'yyyy-MM-dd',
            'data' =>  new \Datetime()))
        
        ->add('categories',EntityType::class ,array(
            'class' =>'adminBundle\Entity\category' , 
            'choice_label'=>'libelle',
            'expanded'=>false,
            'multiple'=>true 
            ))
        ->add('image',FileType::class ,array('label' => 'png ou jpeg','data_class'=>null,'required' => false) );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'adminBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_post';
    }


}
