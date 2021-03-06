<?php
namespace SurveyGizmo\Tests;

use SurveyGizmo\ApiResource;

class ApiResourceTest extends TestCase
{
    public function testIsTrue()
    {
        $this->assertSame(1, 1);
    }

    public function test_mergePath()
    {
      $expected = '/survey/1234/surveyresponse';
      $tester = new ApiResource();
      $path = "/survey/{survey_id}/surveyresponse";
      $options = array (
        'survey_id' => '1234'
      );
      $result = $tester->_mergePath($path, $options);
      $this->assertEquals($expected, $result);
    }

    public function test_mergePathWithRandomStuff()
    {
      $expected = '/survey/1234/surveyresponse/1/something-else/is_yummy';
      $tester = new ApiResource();
      $path = "/survey/{survey_id}/surveyresponse/{response_id}/something-else/{bacon}";
      $options = array (
        'survey_id' => '1234',
        'response_id' => 1,
        'bacon' => 'is_yummy'
      );
      $result = $tester->_mergePath($path, $options);
      $this->assertEquals($expected, $result);
    }

    public function test_mergePathWithoutsomethingToReplace()
    {
      $expected = '/survey/surveyresponse/something-else/';
      $tester = new ApiResource();
      $path = "/survey/surveyresponse/something-else/";
      $options = array (
        'survey_id' => '1234',
        'response_id' => 1,
        'bacon' => 'is_yummy'
      );
      $result = $tester->_mergePath($path, $options);
      $this->assertEquals($expected, $result);
    }

    /**
    * Call protected/private method of a class.
    *
    * @param object &$object    Instantiated object that we will run method on.
    * @param string $methodName Method name to call
    * @param array  $parameters Array of parameters to pass into method.
    *
    * @return mixed Method return.
    */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
    $reflection = new \ReflectionClass(get_class($object));
    $method = $reflection->getMethod($methodName);
    $method->setAccessible(true);
    return $method->invokeArgs($object, array($parameters));
    }

}
