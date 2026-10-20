<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Image;


//rakahh fazet l image 9bal matarja3 ta9ra 
final class JobController extends AbstractController
{

    #[Route('/job', name: 'app_job')]
    public function createDemo(EntityManagerInterface $entityManager): Response
    {
        $job = new Job();
        $job->setType('CDI');
        $job->setCompany('EMKA Med Tunisie');
        $job->setDescription('Technicien méthodes électronique');
        $job->setEmail('recrutement@emkaelec.com');
        $job->setExpiresAt(new \DateTimeImmutable('+30 days'));
        //persiste image 
        $image = new Image();
        $image->setPath('path/to/image.jpg');
        $job->setImage($image);
        $entityManager->persist($image);

        $entityManager->persist($job);
        $entityManager->flush();
        return $this->render('job/index.html.twig', [
            'id' => $job->getId(),
        ]);
    }

    #[Route('/job', name: 'job_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $jobs = $entityManager->getRepository(Job::class)->findAll();
        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/job/{id}', name: 'job_show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $job = $entityManager->getRepository(Job::class)->find($id);
        if (!$job) {
            throw $this->createNotFoundException('Job introuvable');
        }
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }

}
