<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle('index','Administration des utilisateurs')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('lastname')
                ->setFormTypeOption('disabled', 'disabled'),
            EmailField::new('email')
            ->setFormTypeOption('disabled', 'disabled'),
            ArrayField::new('roles'),
            NumberField::new('cardNumber'),
            DateTimeField::new('createdAt')
                ->setFormTypeOption('disabled', 'disabled')
                ->setFormat('long', 'none')
                ->hideOnIndex(),
            DateTimeField::new('expiredAt')
                ->setFormTypeOption('disabled', 'disabled')
                ->setFormat('dd.MM.yyyy', 'none')
                /*->hideOnIndex()*/,
        ];
    }

}
