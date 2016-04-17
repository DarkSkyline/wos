<?php

namespace GameBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BuildingRessourceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb', IntegerType::class, array('label' => 'Ressource nécessaire'))
            ->add('building', EntityType::class, array(
                'class' => 'GameBundle:Building',
                'choice_label' => 'name'
            ))
            ->add('ressource', EntityType::class, array(
                'class' => 'GameBundle:Ressource',
                'choice_label' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GameBundle\Entity\BuildingRessource'
        ));
    }
}
