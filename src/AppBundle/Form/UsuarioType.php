<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroEconomico')
            ->add('nombre')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las contraseñas no coinciden.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite Contraseña'),
            ))


            ->add('salt')
            ->add('enable')
            ->add('loked')
            ->add('expired')
            ->add('createAt', DateTimeType::class)
            ->add('division')
            ->add('role')
            ->add('departamento')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
        ));
    }

    //PARA QUE OPERE LA INTERFACE DEL USUARIO

    /**
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)

    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }




    public function getNombre()
    {
        return 'nombre';
    }













    ///**
    // * {@inheritdoc}
    // */
    //public function configureOptions(OptionsResolver $resolver)
   // {
   //     $resolver->setDefaults(array(
   //         'data_class' => 'AppBundle\Entity\Usuario'
   //     ));
   // }

   // /**
   //  * {@inheritdoc}
   //  */
   // public function getBlockPrefix()
   // {
   //     return 'appbundle_usuario';
   // }


}
