<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AddressingBundle\Form\Type;

use Sylius\Bundle\AddressingBundle\Form\EventListener\BuildAddressFormListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Address form type.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@sylius.pl>
 */
class AddressType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;
    protected $eventListener;

    /**
     * Constructor.
     *
     * @param string $dataClass
     */
    public function __construct($dataClass, BuildAddressFormListener $eventListener)
    {
        $this->dataClass = $dataClass;
        $this->eventListener = $eventListener;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber($this->eventListener)
            ->add('firstName', 'text', array(
                'label' => 'sylius.form.address.first_name'
            ))
            ->add('lastName', 'text', array(
                'label' => 'sylius.form.address.last_name'
            ))
            ->add('country', 'sylius_country_choice', array(
                'label' => 'sylius.form.address.country'
            ))
            ->add('street', 'text', array(
                'label' => 'sylius.form.address.street'
            ))
            ->add('city', 'text', array(
                'label' => 'sylius.form.address.city'
            ))
            ->add('postcode', 'text', array(
                'label' => 'sylius.form.address.postcode'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => $this->dataClass
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_address';
    }
}
