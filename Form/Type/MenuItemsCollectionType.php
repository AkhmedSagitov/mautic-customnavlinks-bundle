<?php
// src/Form/MenuItemsCollectionType.php
namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MenuItemsCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('items', CollectionType::class, [
            'entry_type' => MenuItemType::class,
            'entry_options' => ['label' => false],
        ]);
    }
}