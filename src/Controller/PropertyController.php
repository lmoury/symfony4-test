<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;


    public function __construct(PropertyRepository $repository)
    {
            $this->repository = $repository;
    }

    /**
     * @Route("/bien", name="property.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties =  $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            10
        );

        // dump($properties);
        // $properties[0]->setSold(true);
        // $this->em->flush();
        // $properties = new Property();
        // $properties->setTitle('mon premier bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBadrooms(3)
        //     ->setDescription('une petite description')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Mouscron')
        //     ->setAdress('boulevard des canadiens')
        //     ->setPostalCode(7711);
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($properties);
        // $em->flush();
        return $this->render('property/index.html.twig', [
            'current_url' => 'bien',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/bien/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        //dump($property->getCategorie()->getCategorie());
        //die();
        if($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'current_url' => 'bien',
            'property' => $property
        ]);
    }
}
