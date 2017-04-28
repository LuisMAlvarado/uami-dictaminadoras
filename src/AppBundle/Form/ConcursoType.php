<?php

namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddConcursoAsisDivSubscriber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ConcursoType extends AbstractType
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

            ->add('plaza')

          //  ->add('createAt')
            ->add('fechaPublicacion', DateType::class, array(
                'format' => 'dd-MM-yyyy',
            ))
            ->add('unidad')
            ->add('areaDepartamental')
            ->add('clasificacion',  ChoiceType::class, array(
                'choices'  => array(
                    'PROFESOR' => 'PROFESOR ORDINARIO POR TIEMPO DETERMINADO',
                    'TECNICO ACAD.' => 'TECNICO ACADÉMICO POR TIEMPO DETERMINADO',
                    'AYUDANTE' => 'AYUDANTE'
                ),
                'placeholder' => '--SELECCIONE--',
                'empty_data'  => null))
            ->add('categoria')
            ->add('tiempoDedicacion', ChoiceType::class, array(
                'choices'  => array(
                    'COMPLETO' => 'COMPLETO',
                    'MEDIO' => 'MEDIO TIEMPO',
                    'PARCIAL' => 'PARCIAL',
                ),
                'placeholder' => '--SELECCIONE--',
                'empty_data'  => null))
            ->add('horario')
            ->add('causal')
            ->add('salarioA', MoneyType::class, array('currency'=>'MXN','grouping'=> true, 'required' => false))
            ->add('salarioB', MoneyType::class, array('currency'=>'MXN','grouping'=> true, 'required' => false))
            ->add('actividades')
            ->add('aConocimiento',  ChoiceType::class, array(
                'choices'  => array(
                    'CIENCIAS B.' => 'CIENCIAS BASICAS',
                    'INGENIERIA' => 'INGENIERIA',
                    'C. BIOLOG.' => 'CIENCIAS BIOLOGICAS',
                    'C. SALUD' => 'CIENCIAS DE LA SALUD',
                    'C. SOC.' => 'CIENCIAS SOCIALES',
                    'C. ECO. ADMIN.' => 'CIENCIAS ECONOMICAS ADMINISTRATIVAS',
                    'HUMANIDADES' => 'HUMANIDADES',
                ),'placeholder' => '--SELECCIONE--',
                'empty_data'  => null))
            ->add('disciplina')
            ->add('requisitos')
            ->add('fechaIn', DateType::class, array(
                'format' => 'dd-MM-yyyy',
            ))
            ->add('fechaTer', DateType::class, array(
                'format' => 'dd-MM-yyyy',
            ))
            ->add('tpHclase')
            ->add('tpHacademia')
            ->add('tpHayudantia')
            ->add('clavePlaza')
            ->add('departamento')
            ->add('dictamen',HiddenType::class)
            ->addEventSubscriber(new AddConcursoAsisDivSubscriber($this->security,$this->em))

           // ->add('estatus')
           // ->add('pdfConcurso')
            ->add('numConcurso')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Concurso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_concurso';
    }


}
