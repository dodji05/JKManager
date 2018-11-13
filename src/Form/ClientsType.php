<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomClient',null,[
                'attr'=>[
                    'class'=>'client_nom form-control',

                ]
            ])
            ->add('PrenomClient',null,[
                'attr'=>[
                    'class'=>'client_prenom form-control',

                ]
            ])
            ->add('Telephone1',null,[
                'attr'=>[
                    'class'=>'client_tel1 form-control',
                    'onchange'=> 'remplissage_client(event,this)'
                ]                ]
                )
            ->add('Telephone2',null,[
                'attr'=>[
                    'class'=>'client_tel2 form-control',
                    'onchange'=> 'remplissage_client(event,this)'
                ]   ] )
            ->add('ZoneGeographique',ChoiceType::class,array(
                'choices'  => array(
                    'Zone de livraison' => null,
                    'Ab-Calavi' => 'Ab-Calavi',
                    'Vedoko' => 'Vedoko',
                    'Akpakpa' => 'Akpakpa',
                    'Akassato' => 'Akassato',
                ),),[
                'attr'=>[
                    'class'=>'client_zone form-control',

                ]
            ])
            ->add('LieuxLivraison',null,[
                'attr'=>[
                    'class'=>'client_lieu form-control',

                ]
            ])
            ->add('Sexe',ChoiceType::class,array(
        'choices'  => array(
            'Sexe' => null,
            'Masculin' => 'Masculin',
            'Feminin' => 'Feminin',
        ),),
                [
                    'attr'=>[
                        'class'=>'client_sexe form-control',

                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
