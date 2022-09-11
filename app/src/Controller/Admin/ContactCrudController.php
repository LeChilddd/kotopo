<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
           ->setEntityLabelInPlural('Demande de contact')
            ->setEntityLabelInSingular('Demandes de contact')
            ->setPageTitle('index','Demandes contacts')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('lastname')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('email')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('subject')
                ->setFormTypeOption('disabled', 'disabled'),
            TextareaField::new('message')
                ->setFormTypeOption('disabled', 'disabled')
                ->hideOnIndex(),
            DateTimeField::new('createdAt')
                ->setFormTypeOption('disabled', 'disabled')
                ->hideOnForm()
                ->setFormat('dd.MM.yyyy', 'none')
       ];
    }

}
