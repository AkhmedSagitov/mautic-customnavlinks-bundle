<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Mautic\CoreBundle\Controller\CommonController;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Entity\MenuItem;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type\MenuItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends CommonController
{
    public function indexAction(Request $request, EntityManagerInterface $em): Response
    {
        $menuItems = $em->getRepository(MenuItem::class)->findAll();

        if ($request->isMethod('POST')) {
            $itemsData = $request->request->get('items', []);
            foreach ($itemsData as $id => $data) {
                $item = $em->getRepository(MenuItem::class)->find($id);
                if ($item) {
                    $item->setName($data['name']);
                    $em->persist($item);
                }
            }
            $em->flush();

            return $this->redirectToRoute('menuitem');
        }

        return $this->render('@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig', [
            'menu_items' => $menuItems,
        ]);
    }


    public function newAction(Request $request, EntityManagerInterface $em): Response
    {
        $menuItem = new MenuItem();
        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($menuItem);
            $em->flush();

            return $this->redirectToRoute('mautic_menu_item_index');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action' => 'new',
                'form'   => $form->createView(),
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
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

    public function showAction(int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action'    => 'show',
                'menu_item' => $menuItem,
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function deleteAction(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

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