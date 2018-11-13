<?php

namespace App\Form;

use App\Entity\ProduitsFournisseurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsFournisseursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Produit',EntityType::class, [
                'class' => 'App\Entity\Produit',
                'choice_label'=>'libelleProduit',
                'placeholder' => 'Selectionner un produit',
                'attr'=>[
                    'class'=>'vente_id',
                ]])
            ->add('Prix')
          //  ->add('Fournisseur',NULL,['choice_label'=>'NomFournisseur'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitsFournisseurs::class,
        ]);
    }
}
