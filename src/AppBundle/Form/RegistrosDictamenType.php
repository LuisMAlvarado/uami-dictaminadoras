<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddPdfSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrosDictamenType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
          //  ->add('pdfAnexo', null, array(
           //     'attr' => array('nombre' => "NOMBRE")
           // ))
            //ESTA MAGIA EN EL CAMPO pdfAnexo LE PASO LA ETIQUETA nombre EN ATRIBUTO POR MEDIO DE LA VARIABLE $ builder
            ->add('puntaje')
            ->add('prelacion')
            ->add('nivelAsig')
            //->add('aspiranteRfc')
            ->addEventSubscriber(new AddPdfSubscriber())
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registro'
        ));
    }
}
