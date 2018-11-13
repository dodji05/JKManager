<?php

namespace App\Form;

use App\Entity\Ventes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VentesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('DateVente')
           // ->add('client')
            ->add('ligneVentes',CollectionType::class, array(
                'entry_type' =>LigneVenteType::class,
                'allow_add' => true
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ventes::class,
        ]);
    }
}
