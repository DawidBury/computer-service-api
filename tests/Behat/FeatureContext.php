<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\User;
use Behatch\Context\RestContext;
use Behatch\HttpCall\Request;
use Behatch\Json\Json;
use Behatch\Json\JsonInspector;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class FeatureContext extends RestContext
{
    private $inspector;
    private $em;
    private $jwtManager;

    public function __construct(Request $request, EntityManagerInterface $em, JWTTokenManagerInterface $jwtManager)
    {
        parent::__construct($request);
        $this->inspector = new JsonInspector('javascript');
        $this->em = $em;
        $this->jwtManager = $jwtManager;
    }

    /**
     * @Then the JSON node :node should be greater than the number :number
     */
    public function theJsonNodeShouldBeGreaterThanTheNumber($node, $number)
    {
        $value = $this->inspector->evaluate(new Json($this->request->getContent()), $node);
        $this->assertTrue($value > $number);
    }

    /**
     * @Then dump the response
     */
    public function dumpTheResponse()
    {
        $response = $this->request->getContent();
        var_dump($response);
    }

    /**
     * @Then the JSON node :node length should be :length
     */
    public function theJsonNodeLengthShouldBeEqualsTo($node, $length)
    {
        $value = $this->inspector->evaluate(new Json($this->request->getContent()), $node);
        $this->assertEquals($length, strlen($value));
    }

    /**
     * @Given user with this :email has :role
     */
    public function userWithGivenEmailHasRole($email, $role)
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        $this->assertTrue(in_array($role, $user->getRoles()));
    }

    /**
     * @BeforeScenario @login
     */
    public function login(): void
    {
        $user = new User(
            'test@test.pl'
        );
        $user->setPassword('Testowe123!');
        $this->em->persist($user);
        $this->em->flush();

        $token = $this->jwtManager->create($user);
        $this->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }
}
