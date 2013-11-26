<?php
namespace Curso\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Application\Service\UsuarioService;
//use Curso\Service\UsuarioService;


class UsuarioController extends AbstractActionController
{
	public function indexAction()
	{
		echo "Si llega al metodo nuevo INDEX";
		return new ViewModel();
	}
	
	
	public function agregarAction()
	{
		//echo "Si llega al metodo agregar";
		
		if(!empty($_POST))
		{
			$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
			$usuario->guardar($_POST);
			
		}
		return new ViewModel();
	}
	
	public function eliminarAction()
	{
		
		if(!empty($_POST))
		{
			$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
			$usuario->eliminar($_POST);
			
		}
		return new ViewModel();
	}
	
	public function listarAction()
	{
		$params = $this->params()->fromRoute();
		
		$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
		$datos = $usuario->listar();
		
		//print_r($params);
		//echo get_class( $usuario );
		//$parametros['objeto'] = $usuario;
		
		//print_r($parametros);
		$parametros['lista'] = $datos;
		return new ViewModel($parametros);
		
	}
	
	public function actualizarAction()
	{
		
		$prg = $this->prg('/usuario/listar', true);
	    	$usuario=$this->getServiceLocator()->get('Curso\Service\UsuarioService');
	    	$params=$this->params()->fromRoute();
	    	$datos['editar']=$usuario->loadById($params['id']);
	    	//print_r($datos['editar']);
	    	//////
	    	if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
	    		$editar=array();
	    		$editar['nombre']=$this->params()->fromPost('nombre');
	    		$editar['primer_apellido']=$this->params()->fromPost('primer_apellido');
	    		$editar['segundo_apellido']=$this->params()->fromPost('segundo_apellido');
	    		$usuario->actualizar($this->params()->fromPost('id'), $editar);
	    		// returned a response to redirect us
	    		return $prg;
	    	}
            
	    	
	    	return new ViewModel($datos);
		
		
	}

}