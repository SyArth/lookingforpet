<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('pseudo')->hideOnIndex(),
            TextField::new('email')->hideOnIndex(),
            TextField::new('slug')->hideOnIndex(),
            TextField::new('password')->hideOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('telephone')->hideOnIndex(),
            AssociationField::new('adresse')->hideOnIndex(),
            AssociationField::new('animaux'),
            DateTimeField::new('created_at')->hideOnIndex(),
        ];
    }
    
}
