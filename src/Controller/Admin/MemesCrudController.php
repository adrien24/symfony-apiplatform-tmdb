<?php

namespace App\Controller\Admin;

use App\Entity\Memes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MemesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Memes::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('url'),
            NumberField::new('width'),
            NumberField::new('height'),
            NumberField::new('box_count'),
            NumberField::new('captions'),
        ];
    }

}
