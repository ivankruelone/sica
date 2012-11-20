<div class="block-border">
    <div class="block-content">


<h1>
            Busca Receta:
</h1>
<?php
	$this->db->select("r.*, date_format(r.fecha, '%Y%m%d') as fecha_folio, r.id as folioreceta, tipo_receta, s.servicio as servicio_nombre, p.apaterno, p.amaterno, p.nombre as nombre_paciente, p.clave, u.nombre as nombre_medico, rfc, receta_estatus", false);
    $this->db->from('receta r');
    $this->db->join('tipo_receta t', 'r.tipo = t.id', 'LEFT');
    $this->db->join('servicios s', 'r.servicio = s.id', 'LEFT');
    $this->db->join('usuarios u', 'r.user_id = u.id', 'LEFT');
    $this->db->join('pacientes p', 'r.paciente_id = p.id', 'LEFT');
    $this->db->join('receta_estatus e', 'r.estatus = e.id', 'LEFT');
    $this->db->where('r.id', $receta);
    $query = $this->db->get();
    $row = $query->row();
    
    
    $this->db->select('r.*, descripcion');
    $this->db->from('receta_detalle r');
    $this->db->join('productos p', 'r.producto_id = p.id', 'LEFT');
    $this->db->where('receta_id', $receta);
    $query2 = $this->db->get();
    
    $logo = array(
        'src' => base_url().'images/logo.png',
    );
    
    $folio = str_pad($this->session->userdata('numsuc'), 6, '0', STR_PAD_LEFT).$row->fecha_folio.$row->folioreceta;
    
    $data['folio'] = $folio;
echo form_open('recetas/surtir', array('class' => 'form', 'id' => 'surte_form'));

?>
<div style="width: 100%;" align="center">
<table border="1" cellpadding="2" cellspacing="2" class="table">
        <tr>
            <td colspan="4">
                <table class="table" width="100%">
                    <tr>
                        <td> <?php echo img($logo);?></td>
                        <td>
                            <b><?php echo EMPRESA;?></b>
                            <br />
                            <b><?php echo CLIENTE;?></b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Sucursal: </td>
            <td><?php echo $this->session->userdata('numsuc').' '.$this->session->userdata('sucursal');?></td>
            <td>Folio: </td>
            <td><?php echo $folio;?></td>
        </tr>
        <tr>
            <td>Tipo de receta: </td>
            <td><?php echo $row->tipo_receta;?></td>
            <td>Servicio: </td>
            <td><?php echo $row->servicio_nombre;?></td>
        </tr>
        <tr>
            <td>Paciente: </td>
            <td><?php echo $row->apaterno.' '.$row->amaterno.' '.$row->nombre_paciente;?></td>
            <td>Cve. Paciente: </td>
            <td><?php echo $row->clave;?></td>
        </tr>
        <tr>
            <td>CIE PRIMARIA: </td>
            <td><?php echo $row->cie_pri;?></td>
            <td>CIE SECUNDARIA: </td>
            <td><?php echo $row->cie_sec;?></td>
        </tr>
        <tr>
            <td colspan="4">
            
            <table class="table" width="100%">
                    <tr>
                        <td>Clave</td>
                        <td>Descripcion</td>
                        <td>Cantidad</td>
                    </tr>
                    <?php foreach($query2->result() as $row2){?>
                    <tr>
                        <td><?php echo $row2->clave?></td>
                        <td><?php echo $row2->descripcion?></td>
                        <td><?php echo $row2->canreq?></td>
                    </tr>
                    <?php
                    
                    $sql = 'SELECT * FROM inventario i where p_id = ? and inv > 0 order by DATEDIFF(now(), caducidad) DESC LIMIT 1;';
                    $query_surte = $this->db->query($sql, $row2->producto_id);
                    if($query_surte->num_rows() > 0){
                        $row_surte = $query_surte->row();
                        
                            
                            $lote = array();
                            $surtidos = array();
                            $caducidad = array();
                            
                            $lote[$row_surte->lote] = $row_surte->lote;
                            $caducidad[$row_surte->caducidad] = $row_surte->caducidad;
                            

                            if($row_surte->inv > $row2->canreq){
                                $surtido = $row2->canreq;
                            }else{
                                $surtido = $row_surte->inv;
                            }

                            $surtidos[$surtido] = $surtido;
                        
                    ?>
                    
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">Lote Sugerido: <?php echo form_dropdown('lote_'.$row2->id, $lote);?> <?php echo form_dropdown('caducidad_'.$row2->id, $caducidad);?></td>
                        <td><?php echo form_dropdown('cansur_'.$row2->id, $surtidos);?></td>
                    </tr>
                    <?php
                        }
                     }
                     ?>

            </table>
            
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table class="table" align="center">
                    <tr>
                        <td>Medico que prescribe: </td>
                        <td><?php echo $row->nombre_medico?></td>
                    </tr>
                    <tr>
                        <td>Clave: </td>
                        <td><?php echo $row->rfc?></td>
                    </tr>
                    <tr>
                        <td>Fecha: </td>
                        <td><?php echo $row->fecha?></td>
                    </tr>
                    <tr>
                        <td>Status: </td>
                        <td><?php echo $row->receta_estatus?></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td colspan="4" align="center"><?php echo $this->load->view('barcode/barcode', $data);?></td>
        </tr>
</table>
                

<button class="big" type="submit">Surtir la Receta</button>
    <?php 
    echo form_hidden('id', $receta);
    echo form_close();
    ?>
    

</div>
    </div>
</div>