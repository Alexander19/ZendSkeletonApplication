<?php

namespace Curso\Service;


use Application\Service\UsuarioInterface;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\RowGateway\RowGateway;
use Zend\Db\Adapter\Driver\ResultInterface;

class UsuarioService implements UsuarioInterface, ServiceManagerAwareInterface {

	protected $serviceLocator;
	protected $nombre;
	protected $apellidoPaterno;
	protected $apellidoMaterno;
	


	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
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
			
		$result = $adapter->query('SELECT * FROM `users` WHERE `id` = ?', array($user_id));
		$data = $result->current();
		return $data;
		
// 		if($data !== null){
// 			$this->hydrator($data);
// 			return true;
// 		}
		
// 		return false;
	}
	
	function eliminar($id)
	{

		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		
		
		// row gateway
		$rowGateway = new RowGateway('id', 'users', $adapter);
		$rowGateway->populate($datos);
		
		
		//$rowGateway->save();
		
		//or delete this row:
		$rowGateway->delete();
	}
	
	function guardar($datos)
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		
		
		// row gateway
		$rowGateway = new RowGateway('id', 'users', $adapter);
		$rowGateway->populate($datos);
		
		
		$rowGateway->save();
		
		// or delete this row:
		//$rowGateway->delete();
	}
	
	function actualizar($id,$editar)
	{
		$adapter = $this->getServiceManager ()->get ( 'Zend\Db\Adapter\Adapter' );
		// query the database
$resultSet = $adapter->query ( 'SELECT * FROM `users` WHERE `id` = ?', array ($id ) );
		
		// get array of data
		$rowData = $resultSet->current ()->getArrayCopy ();
		
		// row gateway
		$rowGateway = new RowGateway ('id', 'users', $adapter );
		$rowGateway->populate ( $rowData,true );
		$rowGateway->nombre = $editar['nombre'];
		$rowGateway->primer_apellido =$editar['primer_apellido'];
		$rowGateway->segundo_apellido = $editar['segundo_apellido'];
		$rowGateway->save();
		
	
			
	}
	
		
	
	function listar()
	{
		
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		
		$stmt = $adapter->createStatement('SELECT * FROM users');
		$stmt->prepare();
		$result = $stmt->execute();
		
		
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);
		
			
		}
		return $resultSet;
	}
	
	function hydrator($data)
	{
				$this->setNombre($data->nombre);
		     	$this->setApellidoPaterno($data->primer_apellido);
		    	$this->setApellidoMaterno($data->segundo_apellido);
	}

	
	

	
	
	
	
	
}


?>