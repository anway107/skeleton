<?php
namespace tests\codeception\backend;

use app\models\SystemUser;
use Yii;
use Codeception\Specify;
use Yii\codeception\TestCase;


class ExampleTest extends \Codeception\TestCase\Test
{

    use Specify;

    protected function _before()
    {
//        parent::setUp();
//        $this->tester = new User();
    }

    protected function _after()
    {
//        parent::tearDown();
    }

    // tests
    public function testMe()
    {

//        $user = new \app\models\SystemUser();

        $user = new SystemUser();
        $this->assertArrayHasKey('Message',$user->createUser(array('name'=>'anway')));
        $this->assertArrayHasKey('Message',$user->createUser(array('password'=>'anway')));


//        $this->assertFalse($user->validate(['email']));
//        $this->specify("model must automaticaly create non-meta fields",      function() {
//            $model = new SystemUser();
////            array('password'=>'anway')
////            $model->createUser(array('password'=>'anway'));
////            $this->assertTrue($model->createUser(array('password'=>'anway')), array('Message' => 'Success','Result' => null ) );
//        });
    }

}