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

            ->add('createAt', DateType::class,array(
                'format' => 'dd-MM-yyyy'
            ))
            //->add('fechaPublicacion', DateType::class, array(
            //    'format' => 'dd-MM-yyyy',
            // ))
            ->add('unidad')
            ->add('areaDepartamental')
            ->add('clasificacion')
            ->add('categoria')
            ->add('tiempoDedicacion')
            ->add('horario')
            ->add('causaltxt')
            ->add('causal',
                ChoiceType::class, array(
                    'choices'  => array(
                        'SABÁTICO' => 'SABÁTICO.',
                        'NOMBRAMIENTO DE CONFIANZA ' => 'NOMBRAMIENTO DE CONFIANZA',
                        'DESIGNACIÓN COMO ÓRGANO PERSONAL ' => 'DESIGNACIÓN COMO ÓRGANO PERSONAL.',
                        'CONCURSO OP. DESIERTO' => 'CONCURSO DE OPOSICIÓN DESIERTO O CONCURSO DE OPOSICIÓN SIN ASPIRANTES',
                        ' NO OPORTUNA DE C. OPO.'=> 'REALIZACIÓN NO OPORTUNA DE CONCURSO DE OPOSICIÓN.',
                        'CON. OPOSI. RECURSADO O IMPUGNADO ' => 'CONCURSO DE  OPOSICIÓN RECURSADO O IMPUGNADO',
                        'GRUPOS ADICIONALES' => 'CREACIÓN NO PREVISTA DE GRUPOS ADICIONALES.',
                        'NUEVA PLAZA' => 'PLAZA NUEVA CREACIÓN.',
                        'LIC. PERSONAL' => 'LICENCIA PERSONAL',
                        'LIC. SINDICAL' => 'LICENCIA SINDICAL',
                        'INCAPACIDAD' => 'INCAPACIDAD FÍSICA TEMPORAL.',
                        ' RENUNCIA O RECISIÓN.' =>'RENUNCIA O RECISIÓN.',
                        ' DEFUNCIÓN.' => 'DEFUNCIÓN.',
                        'ABANDONO DE EMPLEO ' => 'ABANDONO DE EMPLEO.',
                        ' CONDICIÓN DE EXTRANJERO.' => 'CONDICIÓN DE EXTRANJERO.',
                        'ASIGNACIÓN A COMISIÓN' => 'POR ASIGNACIÓN DE COMISIÓN.',
                    ),'placeholder' => '--SELECCIONE--',
                    'empty_data'  => null))

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
