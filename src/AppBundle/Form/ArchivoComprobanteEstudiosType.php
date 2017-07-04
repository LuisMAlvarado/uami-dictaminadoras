<?php

namespace AppBundle\Form;

use AppBundle\Entity\FactorTippa;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Console\Command\ClearCache\EntityRegionCommand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArchivoComprobanteEstudiosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('factor1', EntityType::class, array(
            'class' => 'AppBundle:FactorTippa',
            'query_builder' => function (EntityRepository $er){
                $qb = $er->createQueryBuilder('ft');
                $qb->where($qb->expr()->like('ft.id', ':id_1'));
                $qb->orWhere($qb->expr()->like('ft.id', ':id_2'));
                $qb->setParameter(':id_1', '3.%');
                $qb->setParameter(':id_2', '2.%');
                return $qb;
            },
        ))
            ->add('createAt')
            ->add('pdf')
            ->add('descripcion')
            ->add('isActive')
            ->add('isDelete')
            ->add('updateAt')
            ->add('aspiranteRfc')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Archivo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_archivo';
    }


}
