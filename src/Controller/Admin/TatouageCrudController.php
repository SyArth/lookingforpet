<?php

namespace App\Controller\Admin;

use App\Entity\Tatouage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
class TatouageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tatouage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('numero'),
            AssociationField::new('animal'),
        ];
    }
    
}
