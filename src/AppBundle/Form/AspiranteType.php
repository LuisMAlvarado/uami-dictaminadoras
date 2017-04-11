<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AspiranteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rfc')->add('nombre')->add('apellidoPaterno')->add('apellidoMaterno')->add('numeroEconomico')->add('createAt')->add('curp')->add('correoElectronico')->add('nacionalidad')->add('edad')->add('sexo')->add('estadoCivil')->add('telefonos')->add('direccion')->add('password')->add('salt')->add('enable')->add('loked')->add('expired')->add('ultimaConexion')->add('role')        ;
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
