<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userId', TextType::class, array('label' => false, 'required' => true, 'attr' => array(
                'placeholder' => 'Référence client'
            )))
            ->add('refFact', TextType::class,  array( 'label' => false,'required' => true, 'attr' => array(
                'placeholder' => 'Numéro facture'
            )))

            ->add('save', SubmitType::class, array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary btn-round-sm btn-sm')));


    }

}