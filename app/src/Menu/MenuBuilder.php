<?php

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MenuBuilder
{

    const CSS_CLASSES = [
        'ROOT' => 'nav-item',
        'MENU' => 'nav-link-text ms-1 ps-2',
        'ITEM' => 'sidenav-normal sidemenu-item',
        'LINK' => 'nav-link m-0'
    ];

    private ItemInterface $menu;
    private ?string $userRole = null;

    public function __construct(
        private readonly FactoryInterface       $factory,
        private readonly ParameterBagInterface  $parameterBag
    )
    {
        $this->menu = $this->factory->createItem('root', [
            'navbar' => true,
            'childrenAttributes' => [
                'id' => 'side-menu',
                'class' => self::CSS_CLASSES['ROOT']
            ]
        ]);

    }

    final public function createAsideMenu(RequestStack $requestStack, TokenStorageInterface $storage): ItemInterface
    {
        $this->setEntriesForAdmin();
        return $this->menu;
    }

    private function setEntriesForAdmin(): void
    {
        $this->menu->addChild('Dashboard', [
            'route' => 'app_home',
            'attributes' => ['class' => self::CSS_CLASSES['ITEM']],
            'linkAttributes' => ['class' => self::CSS_CLASSES['MENU']],
            'label' => '<span class="sidenav-normal">Dashboard</span>',
            'extras' => array('safe_label' => true)
        ]);

        $this->menu->addChild('Users', [
            'route' => 'app_home',
            'attributes' => ['class' => self::CSS_CLASSES['ITEM']],
            'linkAttributes' => ['class' => self::CSS_CLASSES['MENU']],
            'label' => '<span class="sidenav-normal">J\'ajoute le reste demain</span>',
            'extras' => array('safe_label' => true)
        ]);
    }
}
