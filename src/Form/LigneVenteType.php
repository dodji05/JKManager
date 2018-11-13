<?php

namespace App\Form;

use App\Entity\LigneVentes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('Produit',EntityType::class, [
                'class' => 'App\Entity\Produit',
                'query_builder' => function (EntityRepository $er) {

                  return  $er->createQueryBuilder('p')
                        ->leftJoin('p.stock','s')
                        ->where('s.QteEnStock > 0');


                       // ->orderBy('u.username', 'ASC');
                },
                'choice_label'=>'libelleProduit',
                'placeholder' => 'Selectionner un produit',
                'attr'=>[
                    'class'=>'vente_id',
                    'onchange'=> 'remplissage_prix(event,this)'
                ]])
            ->add('PrixVente',null,[
                'attr'=>[
                    'class'=>'vente_prix text-right',

                ]
            ])
            ->add('quantite',null,[
                'attr'=>[
                    'class'=>'vente_qte text-right',
                    'onkeyup'=>'calculetotal(event,this)',
                    'onchange'=>'calculetotal(event,this)'

                ]
            ])
            ->add('total',IntegerType::class,[
                'attr'=>[
                    'class'=>'vente_ss_total text-right',
                    'readonly'=>'readonly'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneVentes::class,
        ]);
    }
}
