<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initRoutes() 
    {
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $router->removeDefaultRoutes();
        
        $router->addRoute('welcome', new Zend_Controller_Router_Route(
            '/', array(
                'controller' => 'index',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('user', new Zend_Controller_Router_Route(
            '/:username', array(
                'controller' => 'members',
                'action'     => 'user',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('login', new Zend_Controller_Router_Route(
            '/login', array(
                'controller' => 'session',
                'action'     => 'login',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('logout', new Zend_Controller_Router_Route(
            '/logout', array(
                'controller' => 'session',
                'action'     => 'logout',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('signup', new Zend_Controller_Router_Route(
            '/signup', array(
                'controller' => 'session',
                'action'     => 'signup',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('about', new Zend_Controller_Router_Route(
            '/about', array(
                'controller' => 'index',
                'action'     => 'about',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('faqs', new Zend_Controller_Router_Route(
            '/faqs', array(
                'controller' => 'index',
                'action'     => 'faqs',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('contact', new Zend_Controller_Router_Route(
            '/contact', array(
                'controller' => 'index',
                'action'     => 'contact',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('home', new Zend_Controller_Router_Route(
            '/home', array(
                'controller' => 'index',
                'action'     => 'home',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('members', new Zend_Controller_Router_Route(
            '/members', array(
                'controller' => 'members',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('woman', new Zend_Controller_Router_Route(
            '/woman', array(
                'controller' => 'woman',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('hot100', new Zend_Controller_Router_Route(
            '/hot100', array(
                'controller' => 'hot100',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('videos', new Zend_Controller_Router_Route(
            '/videos', array(
                'controller' => 'media',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('galleries', new Zend_Controller_Router_Route(
            '/galleries', array(
                'controller' => 'media',
                'action'     => 'galleries',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('events', new Zend_Controller_Router_Route(
            '/events', array(
                'controller' => 'media',
                'action'     => 'events',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('life', new Zend_Controller_Router_Route(
            '/life', array(
                'controller' => 'media',
                'action'     => 'life',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more', new Zend_Controller_Router_Route(
            '/more', array(
                'controller' => 'more',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account', new Zend_Controller_Router_Route(
            '/account', array(
                'controller' => 'account',
                'action'     => 'index',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('user_about', new Zend_Controller_Router_Route(
            '/:username/about', array(
                'controller' => 'members',
                'action'     => 'about',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('user_more', new Zend_Controller_Router_Route(
            '/:username/more', array(
                'controller' => 'members',
                'action'     => 'more',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('user_lookbook', new Zend_Controller_Router_Route(
            '/:username/lookbook', array(
                'controller' => 'members',
                'action'     => 'lookbook',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('woman_hot100', new Zend_Controller_Router_Route(
            '/woman/hot100', array(
                'controller' => 'woman',
                'action'     => 'hot100',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('woman_photoshoot', new Zend_Controller_Router_Route(
            '/woman/photoshoot', array(
                'controller' => 'woman',
                'action'     => 'photoshoot',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('woman_swimsuit', new Zend_Controller_Router_Route(
            '/woman/swimsuit', array(
                'controller' => 'woman',
                'action'     => 'swimsuit',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('woman_shoes', new Zend_Controller_Router_Route(
            '/woman/hot100', array(
                'controller' => 'woman',
                'action'     => 'shoes',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('hot100_new', new Zend_Controller_Router_Route(
            '/hot100/new', array(
                'controller' => 'hot100',
                'action'     => 'new',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('hot100_photos', new Zend_Controller_Router_Route(
            '/hot100/photos', array(
                'controller' => 'hot100',
                'action'     => 'photos',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('hot100_videos', new Zend_Controller_Router_Route(
            '/hot100/videos', array(
                'controller' => 'hot100',
                'action'     => 'videos',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('hot100_questions', new Zend_Controller_Router_Route(
            '/hot100/questions', array(
                'controller' => 'hot100',
                'action'     => 'questions',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('videos_detail', new Zend_Controller_Router_Route(
            '/videos/:id', array(
                'controller' => 'media',
                'action'     => 'video',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('events_details', new Zend_Controller_Router_Route(
            '/events/:id', array(
                'controller' => 'media',
                'action'     => 'event',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('life_details', new Zend_Controller_Router_Route(
            '/life/:id', array(
                'controller' => 'media',
                'action'     => 'lifedetail',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_weekends', new Zend_Controller_Router_Route(
            '/more/weekends', array(
                'controller' => 'more',
                'action'     => 'weekends',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_newsletters', new Zend_Controller_Router_Route(
            '/more/newsletters', array(
                'controller' => 'more',
                'action'     => 'newsletters',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_video', new Zend_Controller_Router_Route(
            '/more/video', array(
                'controller' => 'more',
                'action'     => 'video',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_screensavers', new Zend_Controller_Router_Route(
            '/more/screensavers', array(
                'controller' => 'more',
                'action'     => 'screensavers',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_girl', new Zend_Controller_Router_Route(
            '/more/girl', array(
                'controller' => 'more',
                'action'     => 'girl',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_profile', new Zend_Controller_Router_Route(
            '/account/profile', array(
                'controller' => 'account',
                'action'     => 'profile',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_messages', new Zend_Controller_Router_Route(
            '/account/messages', array(
                'controller' => 'account',
                'action'     => 'messages',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_recent', new Zend_Controller_Router_Route(
            '/account/recent', array(
                'controller' => 'account',
                'action'     => 'recent',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_favorites', new Zend_Controller_Router_Route(
            '/account/favorites', array(
                'controller' => 'account',
                'action'     => 'favorites',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_settings', new Zend_Controller_Router_Route(
            '/account/settings', array(
                'controller' => 'account',
                'action'     => 'settings',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_upgrade', new Zend_Controller_Router_Route(
            '/account/upgrade', array(
                'controller' => 'account',
                'action'     => 'upgrade',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('videos_category', new Zend_Controller_Router_Route(
            '/videos/category/:category', array(
                'controller' => 'media',
                'action'     => 'category',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('more_newsletters_details', new Zend_Controller_Router_Route(
            '/more/newsletters/:id', array(
                'controller' => 'more',
                'action'     => 'newsletter',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_messages_detail', new Zend_Controller_Router_Route(
            '/account/messages/:id', array(
                'controller' => 'account',
                'action'     => 'message',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_settings_media', new Zend_Controller_Router_Route(
            '/account/settings/media', array(
                'controller' => 'account',
                'action'     => 'media',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_settings_password', new Zend_Controller_Router_Route(
            '/account/settings/password', array(
                'controller' => 'account',
                'action'     => 'password',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_settings_privacy', new Zend_Controller_Router_Route(
            '/account/settings/privacy', array(
                'controller' => 'account',
                'action'     => 'privacy',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_settings_subscription', new Zend_Controller_Router_Route(
            '/account/settings/subscription', array(
                'controller' => 'account',
                'action'     => 'subscription',
                'module'     => 'default',
            ))
        );
        
        $router->addRoute('account_upgrade', new Zend_Controller_Router_Route(
            '/account/upgrade', array(
                'controller' => 'account',
                'action'     => 'upgrade',
                'module'     => 'default',
            ))
        );
        
    }
    
    public function _initHelpers() {
        $scripts = new MM_Helpers_Js();
        $styles  = new MM_Helpers_Css();
        
        Zend_Registry::set('scripts', $scripts);
        Zend_Registry::set('styles', $styles);
    }
    
}

