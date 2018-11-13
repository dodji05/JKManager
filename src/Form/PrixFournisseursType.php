<?php

namespace App\Form;

use App\Entity\ProduitsFournisseurs;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixFournisseursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('DateVente')
           // ->add('client')

       ->add('Produit',CollectionType::class, [
            'entry_type' => ProduitsFournisseursType::class,
            'allow_add'  => true,
            'label'=>'LibelleProduit'

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitsFournisseurs::class,
        ]);
    }
}
