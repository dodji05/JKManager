<?php

namespace App\Form;

use App\Entity\Fournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseursType extends AbstractType
{
//    private $nature;
//    public function __construct($nature = "nouveau")
//    {
//        $this->nature = $nature;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomFournisseur',null,[
                    'attr'=>[
                        'class'=>'fournisseur_nom form-control',

                    ]
                ]
            )
            ->add('PrenomFournisseur',null,[
                'attr'=>[
                    'class'=>'fournisseur_prenom form-control',

                ]
            ])

            ->add('SituationGeographique',ChoiceType::class,array(
                'choices'  => array(
                    'Zone de livraison' => null,
                    'Ab-Calavi' => 'Ab-Calavi',
                    'Vedoko' => 'Vedoko',
                    'Akpakpa' => 'Akpakpa',
                    'Akassato' => 'Akassato',
                ),),[
                'attr'=>[
                    'class'=>'zone form-control',

                ]
            ])
            ->add('TelephoneFournisseur',null,[
                'attr'=>[
                    'class'=>'fournisseur_tel form-control',
                    'onchange'=> 'remplissage_fournisseur(event,this)'

                ]
            ])
        ;
//        if ($this->nature == "addprice"){
//            $builder->add('Ligne',CollectionType::class, [
//                'entry_type' => ProduitsFournisseursType::class,
//                'allow_add'  => true,
//                'label'=>'prix'
//
//            ]);
//        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>Fournisseurs::class,
        ]);
    }
}
