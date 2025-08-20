<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Mautic\CoreBundle\Controller\CommonController;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Entity\MenuItem;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Entity\MenuItemRepository;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type\MenuItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends CommonController
{
    public function indexAction(Request $request, EntityManagerInterface $em, MenuItemRepository $menuItemRepository): Response
    {
        $menuItems = $menuItemRepository->findAll();

        $form = $this->createFormBuilder($menuItems)
            ->getForm();

        if ($request->isMethod('POST')) {

            $itemsData = $request->request->get('items', []);

            foreach ($itemsData as $id => $data) {

                $item = $em->getRepository(MenuItem::class)->find($id);

                if ($item) {
                    $item->setName($data['name']);
                    $item->setLabel($data['label']);
                    $item->setSortOrder((int)$data['sortOrder']);
                    $item->setUrl($data['url']);
                    $item->setType($data['type']);

                    $em->persist($item);
                }
            }

            $em->flush();

            return $this->redirectToRoute('menuitem');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'form' => $form->createView(),
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function newAction(EntityManagerInterface $em): Response
    {
        $menuItem = new MenuItem();
        $menuItem->setName('');
        $menuItem->setLabel('');
        $menuItem->setSortOrder(1);
        $menuItem->setUrl('');
        $menuItem->setType('blank');

        $em->persist($menuItem);
        $em->flush();

        return $this->redirectToRoute('menuitem');
    }

    public function editAction(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }

        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('mautic_menu_item_index');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action'    => 'edit',
                'form'      => $form->createView(),
                'menu_item' => $menuItem,
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }


    public function deleteAction(Request $request, int $id, EntityManagerInterface $em, MenuItemRepository $menuItemRepository): Response
    {
        $menuItem = $menuItemRepository->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }
        if ($this->isCsrfTokenValid('delete'.$menuItem->getId(), $request->request->get('_token'))) {
            $em->remove($menuItem);
            $em->flush();
        }

        return $this->redirectToRoute('mautic_menu_item_index');
    }
}