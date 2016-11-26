<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zendlib\Validator\StringLength;

class IndexController extends AbstractActionController{
    public function indexAction(){

       // return false;
    }

    public function viewInfoAction(){

//        $config =  \HTMLPurifier_Config::createDefault();
//        $config->set('HTML.AllowedElements','div,h1');
//
//        $purifier = new \HTMLPurifier_HTMLPurifier($config);
//        $input = '<h1>Zend</h1>';
//       echo $output = $purifier->purify($input);
//
//
//        $mailService = $this->getServiceLocator()->get('AcMailer\Service\MailService');
//        $mailService->setSubject('This is the subject')
//            ->setBody('This is the body'); // This can be a string, HTML or even a zend\Mime\Message or a Zend\Mime\Part
//
//        $result = $mailService->send();
//        if ($result->isValid()) {
//            echo 'Message sent. Congratulations!';
//        } else {
//            if ($result->hasException()) {
//                echo sprintf('An error occurred. Exception: \n %s', $result->getException()->getTraceAsString());
//            } else {
//                echo sprintf('An error occurred. Message: %s', $result->getMessage());
//            }
//        }


      return false;
    }
}