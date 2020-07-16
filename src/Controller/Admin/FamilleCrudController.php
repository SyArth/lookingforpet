<?php

namespace App\Controller\Admin;

use App\Entity\Famille;
use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class FamilleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Famille::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('nom'),
            TextField::new('slug')->hideOnIndex(),
            AssociationField::new('animaux')
            
        ];
    }

}
