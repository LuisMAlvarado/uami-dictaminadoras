<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddRoleAspiranteSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('fechaBirthday', DateType::class, array(
                'format' => 'dd-MM-yyyy',
            ))
            ->add('nombre')
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('numeroEconomico')
          //  ->add('createAt', DateTimeType::class)
            ->add('curp')
            ->add('correoElectronico')
            ->add('nacionalidad')
            ->add('edad')
            ->add('sexo')
            ->add('estadoCivil')
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
            //->add('role')
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
