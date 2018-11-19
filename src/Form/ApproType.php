<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 19/11/2018
 * Time: 11:38
 */

namespace App\Form;



use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// 1. Include Required Namespaces
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;

// Your Entity
use App\Entity\Fournisseurs;

class ApproType extends AbstractType
{
    private $em;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // 2. Remove the dependent select from the original buildForm as this will be
        // dinamically added later and the trigger as well
//        $builder->add('name')
//            ->add('lastName');

        // 3. Add 2 event listeners for the form
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    protected function addElements(FormInterface $form, Produit $produit = null) {
        // 4. Add the province element
        $form->add('Produit', EntityType::class, array(
            'required' => true,
            'data' => $produit,
            'placeholder' => 'Select a City...',
            'class' => 'AppBundle:City'
        ));

        // Neighborhoods empty, unless there is a selected City (Edit View)
        $neighborhoods = array();

        // If there is a city stored in the Person entity, load the neighborhoods of it
        if ($produit) {
            // Fetch Neighborhoods of the City if there's a selected city
            $repoNeighborhood = $this->em->getRepository('App:Fournisseurs');

            $neighborhoods = $repoNeighborhood->createQueryBuilder("q")
                ->leftJoin("q.Ligne", "l")

                ->where("l.Produit = :cityid")
                ->setParameter("cityid", $produit->getId())
                ->getQuery()
                ->getResult();
        }

        // Add the Neighborhoods field with the properly data
        $form->add('Fournisseur', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Select a City first ...',
            'class' => 'App:Fournisseurs',
            'choices' => $neighborhoods
        ));
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected City and convert it into an Entity
        $produit = $this->em->getRepository('App:Produit')->find($data['city']);

        $this->addElements($form, $produit);
    }

    function onPreSetData(FormEvent $event) {
        $person = $event->getData();
        $form = $event->getForm();

        // When you create a new person, the City is always empty
        $produit = $person->getCity() ? $person->getCity() : null;

        $this->addElements($form, $produit);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\ProduitsFournisseurs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_person';
    }
}
