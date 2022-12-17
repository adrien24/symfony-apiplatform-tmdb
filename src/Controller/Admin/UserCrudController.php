<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use phpDocumentor\Reflection\Types\Null_;
use function Symfony\Component\Translation\t;


class UserCrudController extends AbstractCrudController
{
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
       
            return [
                IdField::new('id'),
                TextField::new('email'),
                ArrayField::new('roles')
            ];
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder
    {
        return $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
        ->andWhere('entity.roles = :user')
        ->setParameter('user', '["ROLE_USER"]');


    }

}
