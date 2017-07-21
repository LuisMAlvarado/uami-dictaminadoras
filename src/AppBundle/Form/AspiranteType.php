<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddRoleAspiranteSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AspiranteType extends AbstractType
{
    private $security, $em;

    public function __construct($security,$em)
    {
        $this->security=$security;
        $this->em=$em;

    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rfc')
            ->add('fechaBirthday',BirthdayType::class,array(
                    'format'=>'dd-MM-yyyy',
                    'placeholder' => array('year' => 'AñO','day' => 'DIA','month' => 'MES',)
                )
            )
            ->add('nombre')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('numeroEconomico')
          //  ->add('createAt', DateTimeType::class)
            ->add('curp')
            ->add('correoElectronico')
            ->add('nacionalidad')
            ->add('edad')
            ->add('sexo',  ChoiceType::class, array(
                'choices'  => array(
                    'FEMENINO' => 'FEMENINO',
                    'MASCULINO' => 'MASCULINO',

                ),'placeholder' => '--SELECCIONE--',
                'empty_data'  => null))
            ->add('estadoCivil',  ChoiceType::class, array(
                'choices'  => array(
                    'SOLTERO'=>'SOLTERO',
                     'SOLTERA'=>'SOLTERA',
                     'CASADO'=>'CASADO',
                     'CASADA'=>'CASADA',
                     'SEPARADO'=>'SEPARADO',
                     'SEPARADA'=>'SEPARADA',
                     'DIVORCIADO'=>'DIVORCIADO',
                     'DIVORCIADA'=>'DIVORCIADA',
                     'VIUDO'=>'VIUDO',
                     'VIUDA'=>'VIUDA',
                     'UNIÓN LIBRE'=>'UNIÓN LIBRE',


                ),'placeholder' => '--SELECCIONE--',
                'empty_data'  => null))
         
            ->add('telefonos')
            ->add('calle')
            ->add('noExt')
            ->add('edif')
            ->add('depto')
            ->add('coloniaFracc')
            ->add('delegMunc')
            ->add('estado')
            ->add('codPost')


            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las contraseñas no coinciden.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite Contraseña'),
            ))



            ->addEventSubscriber(new AddRoleAspiranteSubscriber($this->security,$this->em))
            ->add('archivos', CollectionType::class, array(
                'entry_type' => ArchivoType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'required'      => false,
                'prototype'     => true,
                'label' => false,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
