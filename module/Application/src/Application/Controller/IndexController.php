<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Application\Service\UsuarioService;
//use Curso\Service\UsuarioService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	echo "hola mundo estoy en la accion INDEX";
        return new ViewModel();
    }
    
    public function holaAction()
    {
    	echo "hola mundo estoy en la accion HOLA"  . "<br />";
   // $adapter = new Zend\Db\Adapter($configArray);
    
    
//     $adapter = new \Zend\Db\Adapter\Adapter(array(
//     		'driver' => 'Mysqli',
//     		'host' => 'localhost',
//     		'database'  => 'sia',
//     		'username' => 'root',
//     		'password' => '',
//     		'options' => array('buffer_results' => true)
//     ));
    	
	
        //$adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
		//$result = $adapter->query('SELECT * FROM `empleados` WHERE `id` = ?', array(1));
		//echo get_class($result).'<br />';
    
    	//$data = $result->current();
    	//print_r( $data );
    	//$usuario = new UsuarioService();
    	
		
		//$usuario->testDB();	
		   
//     	$usuario->setNombre("José Alejandro");
//     	$usuario->setApellidoPaterno("Pren");
//     	$usuario->setApellidoMaterno("Xix");
//     	$parametros ['nombre'] = 'José Alejandro Pren Xix';
    	
    	$params = $this->params()->fromRoute();
    	print_r($params);
    	$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	//$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	//$usuario->testDB();
    	
    	if($params['id']){
    		$usuario->loadById($params['id']);
     	}
     	else{
     		$usuario->loadById(2);
     	}
    	
    	//$parametros['nombre'] = 'José Alejandro Pren Xix';
    	$parametros['objeto'] = $usuario;
    	

    	
    	
    	echo get_class( $usuario );
    	
    	return new ViewModel($parametros);
    	
    //return new ViewModel(array('nombre'=>'José Alejandro'));
    }
}
