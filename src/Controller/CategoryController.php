<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $this->getIcons();

        $manager = $this->getDoctrine()->getManager();

        $category = new Category;
        $formCategory = $this->createForm(CategoryType::class, $category,
            [
                'action' => $this->generateUrl('category_create')
            ]
        );

        $entities = $manager->getRepository(Category::class)->findAll();


        $icons = $this->getIcons();

        return $this->render('category/list.html.twig', [
            'icons' => $icons,
            'entities' => $entities,
            'form' => $formCategory->createView(),
            'controller_name' => 'CategoryController',
        ]);
    }


    /* ANCIEN
     * @Route("/create", name="create", methods={"GET","HEAD"})
     */
    /**
     * @Route("/create", name="create", methods={"POST","PUT"})
     */
    public function create(Request $request)
    {

        $name = $request->get('category')['name'];
        $icon = $request->get('category')['icon'];
        $cardBackground = $request->get('category')['card_background'];
        $cardColor = $request->get('category')['card_color'];

        $category = new Category;
        $category->setName($name);
        $category->setIcon($icon);
        $category->setCardBackground($cardBackground);
        $category->setCardColor($cardColor);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($category);
        $manager->flush();

        return new Response('OK', 200, []);
        // return $this->index($request);


        /*
        $manager = $this->getDoctrine()->getManager();

        $category = new Category;
        $formCategory = $this->createForm(CategoryType::class, $category,
            [
                'action' => $this->generateUrl('category_create')
            ]
        );

        $categories = $manager->getRepository(Category::class)->findAll();
        */

//        $formCategory->handleRequest($request);
        /*if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            $manager->persist($category);
            $manager->flush();
        }

        return $this->render('category/form.html.twig', [
            'entities' => $categories,
            'form' => $formCategory->createView(),
            'controller_name' => 'CategoryController',
        ]);*/
    }


    /*
     * @Route("/create", name="store", methods={"POST","PATCH","PUT"})
     */
    /*public function store()
    {
    }*/


    /**
     * @Route("/edit", name="edit", methods={"GET","HEAD"})
     */
    public function edit()
    {
        return $this->render('category/form.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }


    /**
     * @Route("/edit", name="update", methods={"POST","PUT"})
     */
    public function update()
    {
        return $this->render('category/form.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    private function getIcons()
    {
        $keyruneIcons = file_get_contents(__DIR__ . '/../../node_modules/keyrune/less/icons.less');
        $iconLines = preg_split('/\./', $keyruneIcons);
        $patternIconLine = '/@\{ss-prefix\}-(\w+).+"\\\\(\w+)".+\/\/(.+)/m';
        $icons = [];
        foreach ($iconLines as $iconLine) {
            preg_match_all($patternIconLine, $iconLine, $icon, PREG_SET_ORDER, 0);
            if ([] !== $icon) {
                $icons[$icon[0][1]] = $icon[0][3];
            }
        }
        return $icons;
    }
}
