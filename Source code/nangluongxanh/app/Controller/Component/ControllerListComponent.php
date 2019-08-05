<?php
class ControllerListComponent extends Component {
    public function get() {
        $controllerClasses = App::objects('controller');
            foreach ($controllerClasses as $controller) {
                if ($controller != 'AppController') {
                    // Load the controller
                    App::import('Controller', str_replace('Controller', '', $controller));
                    // Load its methods / actions
                    $actionMethods = get_class_methods($controller);
                    foreach ($actionMethods as $key => $method) {
    
                        if ($method{0} == '_') {
                            unset($actionMethods[$key]);
                        }
                    }
                    // Load the ApplicationController (if there is one)
                    App::import('Controller', 'AppController');
                    $parentActions = get_class_methods('AppController');
                    $controllers[$controller] = array_diff($actionMethods, $parentActions);
                }
            }
            return $controllers;
    }
}