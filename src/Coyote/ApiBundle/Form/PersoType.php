<?php

namespace Coyote\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('level')
            ->add('class')
            ->add('race')
            ->add('sexe')
            ->add('created_at')
            ->add('updated_at')
            ->add('friendsWithMe')
            ->add('myFriends')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\ApiBundle\Entity\Perso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_apibundle_perso';
    }
}
