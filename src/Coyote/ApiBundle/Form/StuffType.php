<?php

namespace Coyote\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StuffType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('rarity')
            ->add('level')
            ->add('weight')
            ->add('created_at')
            ->add('updated_at')
            ->add('stuffs')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\ApiBundle\Entity\Stuff'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_apibundle_stuff';
    }
}
