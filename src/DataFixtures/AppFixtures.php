<?php
namespace App\DataFixtures;

use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # Populate 10 records which are published
        QuestionFactory::new()->createMany(10);

        # Populate 5 records which are unpublished
        QuestionFactory::new()->unpublished()->createMany(5);
    }
}
