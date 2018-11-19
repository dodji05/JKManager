<?php

namespace App\Form;

use App\Entity\DetailsAppro;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Fournisseurs;

class DetailsApprovisionType extends AbstractType
{
    private $em;
    private $fournisseur;
//    public function __construct(Fournisseurs $fournisseur)
//    {
//        $this->fournisseur = $fournisseur;
//    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('Produit',EntityType::class, [
                'class' => 'App\Entity\Produit',
                'choice_label'=>'libelleProduit',
                'placeholder' => 'Selectionner un produit',
                'attr'=>[
                    'class'=>'appro_id',
//                    'onchange' =>'Maj()',
                ],
                'query_builder' => function (EntityRepository $er) {

                    return  $er->createQueryBuilder('p')
                        ->leftJoin('p.Fournisseur','four')
                        ->leftJoin('four.Fournisseur','f')
                        ->where('f.id :=fournisseur')
                        ->setParameter('fourniseur',$this->fournisseur)

                     ->orderBy('p.LibelleProduit', 'ASC');
                }])
            ->add('Quantite',null,[
                    'attr'=>[
                        'class'=>'vente_qte text-right',
                        'onkeyup'=>'calculetotal(event,this)',
                        'onchange'=>'calculetotal(event,this)'

                    ]]
            )
            ->add('PrixAppro')
            ->add('total',IntegerType::class,[
                'attr'=>[
                    'class'=>'vente_ss_total text-right',
                    'readonly'=>'readonly'
                ]
            ]);
//

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailsAppro::class,
        ]);
    }
}
