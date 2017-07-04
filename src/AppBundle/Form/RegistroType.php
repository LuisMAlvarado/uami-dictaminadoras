<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddRoleRegistroSubscriber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistroType extends AbstractType
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
            //->add('numRegistro')
            ->add('fechaRegistro')
            ->add('pdfAnexo')
            ->add('aspiranteRfc')
            ->add('concurso')
            ->addEventSubscriber(new AddRoleRegistroSubscriber($this->security,$this->em))
            //  ->add('createAt') NO ES NECESARIO PONER ESTE CAMPO
            //->add('puntaje')
            //->add('prelacion')
            //->add('nivelAsig')
        ;
    }
    
    /**
     * {@inheritdoc}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registro'
        ));
    }*/

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_registro';
    }


}
