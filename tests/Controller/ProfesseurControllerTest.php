<?php

namespace App\Tests\Controller;

use App\Entity\Professeur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ProfesseurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $professeurRepository;
    private string $path = '/professeur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->professeurRepository = $this->manager->getRepository(Professeur::class);

        foreach ($this->professeurRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Professeur index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'professeur[nom]' => 'Testing',
            'professeur[prenom]' => 'Testing',
            'professeur[dateNaiss]' => 'Testing',
            'professeur[competences]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->professeurRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professeur();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDateNaiss('My Title');
        $fixture->setCompetences('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Professeur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professeur();
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setDateNaiss('Value');
        $fixture->setCompetences('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'professeur[nom]' => 'Something New',
            'professeur[prenom]' => 'Something New',
            'professeur[dateNaiss]' => 'Something New',
            'professeur[competences]' => 'Something New',
        ]);

        self::assertResponseRedirects('/professeur/');

        $fixture = $this->professeurRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getDateNaiss());
        self::assertSame('Something New', $fixture[0]->getCompetences());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professeur();
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setDateNaiss('Value');
        $fixture->setCompetences('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/professeur/');
        self::assertSame(0, $this->professeurRepository->count([]));
    }
}
