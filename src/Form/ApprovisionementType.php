<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 20/06/2018
 * Time: 10:41
 */

namespace App\Form;


use App\Entity\Approvisionement;
use App\Entity\DetailsAppro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ApprovisionementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detailsAppros',CollectionType::class, array(
                'entry_type' =>DetailsApproType::class,
                'allow_add' => true
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Approvisionement::class
        ));

    }

//    public function getBlockPrefix()
//    {
//        return 'scom_bundle_ventes_type';
//    }

}