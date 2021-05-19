<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        //mettre pleine largeur pour le contenu de l'admin, et pour l'admin en general
        ->renderContentMaximized()
        //laisse seulement les icones du menu sur la gauche, besoin de hover pour voir le texte du menu
        //->renderSidebarMinimized()
        //->setEntityLabelInSingular('Region')
        //fixe le titre du haut au case ou il y a plusieurs resultats
        ->setEntityLabelInPlural('Articles')
        //ajoute listing au titre du haut
        ->setPageTitle('index', '%entity_label_plural% listing')
        //pour les dates
        //->setDateFormat('short')
        //trier par plus grand au plus petit
        //->setDefaultSort(['id' => 'DESC'])
        //le nombre de ligne qui s'affiche sur une page au max, ici je mets 15 resultat par page
        ->setPaginatorPageSize(15)
        //la pagination et combien de pages qui s'affiche avant et apres dans la pagination
        ->setPaginatorRangeSize(3)
        
        
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        //pour l'upload des images , on fixe comme ca les choses
        $imagefile = TextareaField::new('imageFile')->setFormType(VichImageType::class);
        $image = ImageField::new('image')->setBasePath('uploads/article');

    $fields = [
        IdField::new('id')->hideOnForm(),
        TextField::new('titre'),
        TextEditorField::new('contenu'),
        DateTimeField::new('createdAt'),
        AssociationField::new('categorie'),
    ];

    //on affiche imagefile ou image selon la page pour pas avoir de bugs
    if($pageName == crud::PAGE_INDEX || $pageName == crud::PAGE_DETAIL){
        $fields[] = $image;
    }else{
        $fields[] = $imagefile;
    }
    return $fields;
    }
}
