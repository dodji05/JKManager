<?php

namespace App\Form;

use App\Entity\Fournisseurs;
use App\Entity\ProduitsFournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseursPrixType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


            $builder->add('Ligne',CollectionType::class, [
                'entry_type' => ProduitsFournisseursType::class,
                'allow_add'  => true,
                'label'=>'prix'

            ])
                ->add('NomFournisseur',null,[
                    'attr' => [
                        'class' => 'prix_fournisseur_nom'

                    ]
                ])
                ->add('PrenomFournisseur',null,[
        'attr' => [
            'class' => 'prix_fournisseur_prenom'

        ]
    ])
                ->add('SituationGeographique',null,[
        'attr' => [
            'class' => 'prix_fournisseur_geo'

        ]
    ])
                ->add('TelephoneFournisseur',null,[
                    'attr' => [
                        'class' => 'prix_fournisseur_telephone',
                        'onblur'=> 'remplissage_fournisseur(event)'
                    ]
                ]);
        }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>Fournisseurs::class,
        ]);
    }
}
