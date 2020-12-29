<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Constants\UserConstants;
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
     * @Then the JSON node :node value should be :value
     */
    public function theJsonNodeValueShouldBeEqualsTo(string $node, string $expectedValue)
    {
        $jsonValue = $this->inspector->evaluate(new Json($this->request->getContent()), $node);

        if (is_bool($jsonValue)) {
            $jsonValue = $jsonValue ? 'true' : 'false';
        }

        $this->assertEquals($expectedValue, $jsonValue);
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
     * @BeforeScenario @loginAsUser
     */
    public function loginAsUser(): void
    {
        $userRepository = $this->em->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => UserConstants::EMAIL_USER]);

        $token = $this->jwtManager->create($user);
        $this->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }
}
