<?php
namespace Wunderman\EpreventionBundle\Tests\Controller\Api;

use Wunderman\EpreventionBundle\Entity\Metier;
use Wunderman\EpreventionBundle\Test\ApiTestCase;
use Symfony\Component\PropertyAccess\PropertyAccess;

class MetierControllerTest extends ApiTestCase
{

    private $metier;

    public function __construct()
    {
        $this->metier = array(
            'titre' => 'nouveau premier métier',
            'code' => 'm001'
        );
    }

    protected function setUp()
    {
        parent::setUp();
    }

    protected function createMetier()
    {
        $data = $this->metier;

        $accessor = PropertyAccess::createPropertyAccessor();
        $metier = new Metier();
        foreach ($data as $key => $value) {
            $accessor->setValue($metier, $key, $value);
        }

        $this->getEntityManager()->persist($metier);
        $this->getEntityManager()->flush();

        return $metier;
    }

    public function testPOST()
    {
        // Form (fields, data)
        $data = $this->metier;

        // 1) Create a metier
        $response = $this->client->post('/api/metiers', [
            'body' => json_encode($data)
        ]);

        // 1) Check creation success (status code + location header)
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $this->assertStringEndsWith('/api/metiers/m001', $response->getHeader('Location'));
        // get response body
        $finishedData = json_decode($response->getBody(true), true);

        //2)  Check response fields list (same list as setup in $data + ID)
        $this->assertArrayHasKey('id', $finishedData);
        foreach ($data as $key => $value){
            $this->assertArrayHasKey($key, $finishedData);
        }

        // 3) Check response data (same list as setup in $data)
        foreach ($data as $key => $value){
            $this->assertEquals($value, $finishedData[$key]);
        }

    }

    public function testGETMetier()
    {
        // create métier
        $this->createMetier();

        $response = $this->client->get('/api/metiers/m001');
        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()->assertResponsePropertiesExist($response, array(
            'id',
            'titre',
            'code',
        ));
        $this->asserter()->assertResponsePropertyEquals($response, 'titre', 'nouveau premier métier');

        /*
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            '_links.self',
            $this->adjustUri('/api/programmers/UnitTester')
        );
        */
    }
    public function testValidationErrors()
    {
        /*
         * Test empty fields
         */
        $data = array(
            'titre' => '',
            'code' => ''
        );

        $response = $this->client->post('/api/metiers', [
            'body' => json_encode($data)
        ]);

        $finishedData = json_decode($response->getBody(true), true);
        $this->assertEquals(400, $response->getStatusCode());


        // titre
        $this->assertArrayHasKey('errors', $finishedData['children']['titre']);
        $this->assertEquals('Please enter a clever title', $finishedData['children']['titre']['errors'][0]);
        // code
        $this->assertArrayHasKey('errors', $finishedData['children']['code']);
        $this->assertEquals('Please enter a clever code', $finishedData['children']['code']['errors'][0]);

        /*
        * Test UNIQUE Fields
        */

    }

}
