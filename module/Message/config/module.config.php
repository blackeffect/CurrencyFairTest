<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Message\Controller\Message' => 'Message\Controller\MessageController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'message' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/messages[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Message\Controller\Message'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'message_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Message/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Message\Model' => 'message_entities'
                )
            )
        )
    )
);
