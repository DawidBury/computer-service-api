<?php declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\User;
use Behatch\Context\RestContext;
use Behatch\HttpCall\Request;
use Behatch\Json\Json;
use Behatch\Json\JsonInspector;
use Doctrine\ORM\EntityManagerInterface;

class FeatureContext extends RestContext
{
    private $inspector;
    private $em;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        parent::__construct($request);
        $this->inspector = new JsonInspector('javascript');
        $this->em = $em;
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
}