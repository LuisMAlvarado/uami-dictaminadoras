<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AspirantePreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rfc')
            ->add('nombre')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('numeroEconomico')
          //  ->add('createAt', DateTimeType::class)
          //  ->add('curp')
            ->add('correoElectronico')
           // ->add('nacionalidad')
            ->add('edad')
           // ->add('sexo')
           // ->add('estadoCivil')
            ->add('telefonos')
          //  ->add('fechaBirthday')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las contraseñas no coinciden.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options'  => array('label' => 'Password      '),
                'second_options' => array('label' => 'Conf. Pass.'),
            ))
          //  ->add('archivos', CollectionType::class, array(
          //      'entry_type' => ArchivoComprobanteEstudiosType::class
          //  ))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Aspirante'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_aspirante';
    }


}
