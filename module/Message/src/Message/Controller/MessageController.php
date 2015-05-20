<?php

namespace Message\Controller;

use Message\Model\Message;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class MessageController extends AbstractRestfulController {

	public function indexAction() {
		return $this->redirect()->toUrl('app/#/messages');
	}
	
    public function getList() {
		
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $results= $em->createQuery('select m from Message\Model\Message m')->getArrayResult();
        
        return new JsonModel(array(
            'data' => $results)
        );
    }

    public function create($data) {
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        
        $timePlaced = \DateTime::createFromFormat('d-m-Y H:i:s', $data['timePlaced']);
        
        $message = new Message();
        $message->setUserId($data['userId']);
        $message->setCurrencyFrom($data['currencyFrom']);
        $message->setCurrencyTo($data['currencyTo']);
        $message->setAmountSell($data['amountSell']);
        $message->setAmountBuy($data['amountBuy']);
        $message->setRate($data['rate']);
        $message->setTimePlaced($timePlaced);
        $message->setOriginatingCountry($data['originatingCountry']);

        $em->persist($message);
        $em->flush();
        
        return new JsonModel(array(
            'data' => $message->getId(),
        ));
    }
}