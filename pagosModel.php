<?php
	class PagosModel extends ModelBase {

		public function getPagoById($id = false){
			!$id && System::error("ERROR! An error with var \$id = " . $id, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);

			$sql = "SELECT  
						p.idPago,
						p.idProveedor,
						p.fecha,
						date_format(date(from_unixtime(p.fecha)),'%d-%m-%Y') as str_fecha,
						e.nombre,
						case
							when sum(dp.costo) is null then 0
							else sum(dp.costo)
						end as total,
						(SELECT
							case
								when sum(o.costo) is null then 0
								else sum(o.costo)
							end
						 FROM
						 	reservas r
						 	join ofertas o
						 	on r.oferta=o.id
						 WHERE
						 	estado=10 and o.empresa=p.idProveedor) as pendiente
					FROM 
						pagos_proveedor p
						join empresas e
						on p.idProveedor=e.id
						left join detallePago dp
						on p.idPago=dp.idPago
					WHERE
						p.idPago='{$id}'";

			$result = $this->bd->query($sql);
			$return = false;

			!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

			$result->num_rows == 1 && $return = $result;

			return $return;
		}

		public function getDetallePago($id = false){
			!$id && System::error("ERROR! An error with var \$id = " . $id, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);

			$sql = "SELECT
						r.id,
						r.codigo,
						r.cid,
						dp.costo,
						o.id as oferta,
						o.titulo
					FROM
						detallePago dp
						join reservas r
						on dp.idReserva=r.id
						join ofertas o
						on r.oferta=o.id
					WHERE
						dp.idPago='{$id}'";

			$result = $this->bd->query($sql);

			!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

			return $result;
		}

		public function getReservasPendientes($id = false){
			!$id && System::error("ERROR! An error with var \$id = " . $id, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);

			$sql = "SELECT
						r.id,
						r.codigo,
						r.cid,
						o.costo,
						o.id as oferta,
						o.titulo
					FROM
						reservas r
						join ofertas o
						on r.oferta=o.id
					WHERE
						o.empresa='{$id}' AND r.estado=10";


			$result = $this->bd->query($sql);

			!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

			return $result;
		}

		public function updatePago($id = false, $datos = false){
			!$id && System::error("ERROR! An error with var \$id = " . $id, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);
			!$datos && System::error("ERROR! An error with var \$datos = " . $datos, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);


				$sql = BD::updateSql("pagos_proveedor", $datos, array("id" => $id));

				$result = $this->bd->query($sql);

				!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

				return $result;
			
		}

		public function deletePago($id = false){
			!$id && System::error("ERROR! An error with var \$id = " . $id, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);

			//eliminar el pago 

			$sql = BD::deleteSql("pagos_proveedor", array("idPago" => $id));

			$result = $this->bd->query($sql);

			//actualizar el estado de las reservas de ese detalle de pago

			$sql ="UPDATE
				   		reservas r
				   		join detallePago dp
				   		on r.id=dp.idReserva
				   SET
					    estado=10
					WHERE
						  	dp.idPago='{$id}'";

			$result = $this->bd->query($sql);


			//eliminar el detalle de pago

			$sql = BD::deleteSql("detallePago", array("idPago" => $id));

			$result = $this->bd->query($sql);


			!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

			return $result;
		}

		public function createPago($datos = false){
			(!$datos || !is_array($datos)) && System::error("ERROR! An error with var \$datos = " . $datos, Error::ER_NO_DATA_VAR, __FILE__, __CLASS__, __LINE__, true);

				$sql = BD::insertSql("pagos_proveedor", $datos);

				$result = $this->bd->query($sql);

				!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

				return $this->bd->insert_id;
			
		}

		public function eliminarReserva($idReserva, $idPago){

				$sql = "DELETE FROM
							detallePago
						WHERE
							idPago='{$idPago}' AND idReserva='{$idReserva}'";

				$result = $this->bd->query($sql);

				//actualizar el estado de la reserva a USADO estado=10

				$sql ="UPDATE
							reservas
					   SET
					   		estado=10
					   WHERE
						  	id='{$idReserva}'";

				$result = $this->bd->query($sql);

				!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

				return $result;
			
		}

		public function agregarReserva($idReserva, $idPago){
				
				$datos["idPago"] 	= $idPago;
				$datos["idReserva"]	= $idReserva;

				//obtener el costo de esa oferta

				$sql ="SELECT
							o.costo
						 FROM
						 	reservas r 
						 	join ofertas o
						 	on r.oferta=o.id
						  WHERE
						  	r.id='{$idReserva}'";
				
				$result = $this->bd->query($sql);

				$result_data = $result->fetch_object();

				$datos["costo"] = $result_data->costo;

				//actualizar el estado de la reserva a PAGADA estado=11

				$sql ="UPDATE
							reservas
					   SET
					   		estado=11
					   WHERE
						  	id='{$idReserva}'";

				$result = $this->bd->query($sql);

				//insertar el nuevo detalle de pago

				$sql = BD::insertSql("detallePago", $datos);

				$result = $this->bd->query($sql);

				!$result && System::error("ERROR! An error with exec the sql. " . $sql, Error::ER_EXEC_SQL, __FILE__, __CLASS__, __LINE__, true);

				return $this->bd->insert_id;
			
		}

	}
?>
