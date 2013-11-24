<?php

namespace Curso\Service;


use Application\Service\UsuarioInterface;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class UsuarioService implements UsuarioInterface, ServiceManagerAwareInterface {

	protected $serviceLocator;
	protected $nombre;
	protected $apellidoPaterno;
	protected $apellidoMaterno;
	


	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre.' '.$this->apellidoMaterno. ' '.$this->apellidoMaterno;
	}

	/**
	 * @return the $apellidoPaterno
	 */
	public function getApellidoPaterno() {
		return $this->apellidoPaterno;
	}

	/**
	 * @return the $apellidoMaterno
	 */
	public function getApellidoMaterno() {
		return $this->apellidoMaterno;
	}

	/**
	 * @param field_type $nombrex|
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param field_type $apellidoPaterno
	 */
	public function setApellidoPaterno($apellidoPaterno) {
		$this->apellidoPaterno = $apellidoPaterno;
	}

	/**
	 * @param field_type $apellidoMaterno
	 */
	public function setApellidoMaterno($apellidoMaterno) {
		$this->apellidoMaterno = $apellidoMaterno;
	}
	/* (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceManagerAwareInterface::setServiceManager()
	 */
	public function setServiceManager(ServiceManager $serviceManager) {
		// TODO Auto-generated method stub
		$this->sm = $serviceManager;
	}

	
	public function getServiceManager() {
		// TODO Auto-generated method stub
		return $this->sm;
	}
	
	public function testDB()
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$result = $adapter->query('SELECT * FROM `empleados` WHERE `id` = ?',array(1));
		echo get_class($result). '<br />';
		$data = $result->current();
		print_r( $data);
	}
	
	
	function loadById($user_id)
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$result = $adapter->query('SELECT * FROM `empleados` WHERE `id` = ?',array($user_id));
		$data = $result->current();
		
		if ($data !== null)
		{
			$this->hydrator($data);
			return true;
		}
		return false;
		
	}
	
	function hydrator($data)
	{
				$this->setNombre($data->usuario);
		     	$this->setApellidoPaterno($data->curp);
		    	$this->setApellidoMaterno($data->password);
	}

	
	

	
	
	
	
	
}


?>