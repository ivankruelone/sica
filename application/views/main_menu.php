<?php
	if(!isset($submenu)){
	   $submenu = 0;
	}
    $nivel = $this->session->userdata('nivel');
    
    $this->db->select('estatus');
    $query = $this->db->get('inv_ini_c');
    $row = $query->row();
    
    if($nivel == 1){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 1){echo 'class="home current"';}else{echo 'class="home"';}?>><a href="#" title="Home">Home</a>
				<ul>
                    <li <?php if($submenu == 1.1){echo 'class="current"';}?>><?php echo anchor('webservices/index/1.1', 'Servicios WEB')?></li>
                    <li <?php if($submenu == 1.2){echo 'class="current"';}?>><?php echo anchor('webservices/metodos/1.2', 'Metodos WEB')?></li>
					<li><a href="#" title="Dashboard">Dashboard</a></li>
					<li><a href="#" title="My profile">My profile</a></li>
					<li class="with-menu"><a href="#" title="My settings">My settings</a>
						<div class="menu">
							<img src="<?php echo base_url();?>images/menu-open-arrow.png" width="16" height="16">
							<ul>
								<li class="icon_address"><a href="#">Browse by</a>
									<ul>
										<li class="icon_blog"><a href="#">Blog</a>
											<ul>
												<li class="icon_alarm"><a href="#">Recents</a>
													<ul>
														<li class="icon_building"><a href="#">Corporate blog</a></li>
														<li class="icon_newspaper"><a href="#">Press blog</a></li>
													</ul>
												</li>
												<li class="icon_building"><a href="#">Corporate blog</a></li>
												<li class="icon_computer"><a href="#">Support blog</a></li>
												<li class="icon_search"><a href="#">Search...</a></li>
											</ul>
										</li>
										<li class="icon_server"><a href="#">Website</a></li>
										<li class="icon_network"><a href="#">Domain</a></li>
									</ul>
								</li>
								<li class="icon_export"><a href="#">Export</a>
									<ul>
										<li class="icon_doc_excel"><a href="#">Excel</a></li>
										<li class="icon_doc_csv"><a href="#">CSV</a></li>
										<li class="icon_doc_pdf"><a href="#">PDF</a></li>
										<li class="icon_doc_image"><a href="#">Image</a></li>
										<li class="icon_doc_web"><a href="#">Html</a></li>
									</ul>
								</li>
								<li class="sep"></li>
								<li class="icon_refresh"><a href="#">Reload</a></li>
								<li class="icon_reset">Reset</li>
								<li class="icon_search"><a href="#">Search</a></li>
								<li class="sep"></li>
								<li class="icon_terminal"><a href="#">Custom request</a></li>
								<li class="icon_battery"><a href="#">Stats server load</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li <?php if($menu == 2){echo 'class="productos current"';}else{echo 'class="productos"';}?>><a href="#" title="Productos">Productos</a>
				<ul>
					<li <?php if($submenu == 21){echo 'class="current"';}?>><?php echo anchor('productos/index/21', 'Catalogo de Productos')?></li>
					<li <?php if($submenu == 221){echo 'class="current"';}?>><?php echo anchor('productos/estado/1/221', 'Catalogo de Aguascalientes')?></li>
					<li <?php if($submenu == 2232){echo 'class="current"';}?>><?php echo anchor('productos/estado/32/2232', 'Catalogo de Zacatecas')?></li>
				</ul>
			</li>
			<li <?php if($menu == 3){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Inventario">Inventario</a>
				<ul>
					<li <?php if($submenu == 3.1){echo 'class="current"';}?>><?php echo anchor('inv', 'Inventario')?></li>
					<li <?php if($submenu == 3.15){echo 'class="current"';}?>><?php echo anchor('inv/inv_clasificado_elige', 'Inventario Clasificado')?></li>
					<li <?php if($submenu == 3.3){echo 'class="current"';}?>><?php echo anchor('inv/inicial/3.3', 'Inventario Inicial')?></li>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 3.12){echo 'class="current"';}?>><?php echo anchor('inv/kardex/3.12', 'Kardex')?></li>
					<li <?php if($submenu == 3.17){echo 'class="current"';}?>><?php echo anchor('inv/preajuste/3.17', 'Pre-Ajuste')?></li>
					<li <?php if($submenu == 3.13){echo 'class="current"';}?>><?php echo anchor('inv/ajuste/3.13', 'Ajuste')?></li>
					<li <?php if($submenu == 3.16){echo 'class="current"';}?>><?php echo anchor('inv/ajuste_area/3.16', 'Ajuste Area')?></li>
					<li <?php if($submenu == 3.14){echo 'class="current"';}?>><?php echo anchor('inv/ajuste_hist/3.14', 'Ajuste Hist')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 8){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Entradas">Entradas</a>
				<ul>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 8.1){echo 'class="current"';}?>><?php echo anchor('inv/proveedor/8.1', 'Facturas de Proveedores y transpasos de otros almacenes')?></li>
					<li <?php if($submenu == 8.2){echo 'class="current"';}?>><?php echo anchor('inv/devo/8.2', 'Devolucion de sucursales por excedente')?></li>
					<li <?php if($submenu == 8.3){echo 'class="current"';}?>><?php echo anchor('inv/devo_sucursales_merma/8.3', 'Devolucion de sucursales por merma')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 9){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Salidas">Salidas</a>
				<ul>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 9.1){echo 'class="current"';}?>><?php echo anchor('inv/devo_almacen_merma/9.1', 'Devoluciones por merma en el almacen')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 4){echo 'class="pedidos current"';}else{echo 'class="pedidos"';}?>><?php echo anchor('pedidos', 'Pedidos', 'title="Pedidos"');?>
				<ul>
					<li <?php if($submenu == 4.1){echo 'class="current"';}?>><?php echo anchor('pedidos/nuevo_pedido', 'Nuevo Pedido')?></li>
					<li <?php if($submenu == 4.2){echo 'class="current"';}?>><?php echo anchor('pedidos/en_captura', 'En Captura')?></li>
					<li <?php if($submenu == 4.3){echo 'class="current"';}?>><?php echo anchor('pedidos/en_surtido', 'En Surtido')?></li>
					<li <?php if($submenu == 4.4){echo 'class="current"';}?>><?php echo anchor('pedidos/en_embarque', 'En Embarque')?></li>
					<li <?php if($submenu == 4.5){echo 'class="current"';}?>><?php echo anchor('pedidos/embarcados', 'Embarcados')?></li>
					<li <?php if($submenu == 4.6){echo 'class="current"';}?>><?php echo anchor('pedidos/cancelados', 'Cancelados')?></li>
					<li <?php if($submenu == 4.7){echo 'class="current"';}?>><?php echo anchor('pedidos/busqueda', 'Busqueda')?></li>
					<li <?php if($submenu == 4.8){echo 'class="current"';}?>><?php echo anchor('pedidos/subida', 'Subida')?></li>
				</ul>
			</li>
			<li <?php if($menu == 5){echo 'class="clientes current"';}else{echo 'class="clientes"';}?>><a href="#" title="Sucursales">Sucursales</a>
				<ul>
					<li <?php if($submenu == 5.1){echo 'class="current"';}?>><?php echo anchor('sucursales/catalogo', 'Catalogo de Sucursales')?></li>
					<li <?php if($submenu == 5.2){echo 'class="current"';}?>><?php echo anchor('sucursales/tipos', 'Catalogo de Tipos')?></li>
					<li <?php if($submenu == 5.3){echo 'class="current"';}?>><?php echo anchor('sucursales/juris', 'Catalogo de Jurisdicciones')?></li>
				</ul>
			</li>
			<li <?php if($menu == 6){echo 'class="users current"';}else{echo 'class="users"';}?>><a href="#" title="Usuarios">Usuarios</a>
				<ul>
					<li <?php if($submenu == 6.1){echo 'class="current"';}?>><?php echo anchor('usuarios/catalogo', 'Catalogo de Usuarios')?></li>
				</ul>
			</li>
			<li <?php if($menu == 7){echo 'class="clientes current"';}else{echo 'class="clientes"';}?>><a href="#" title="Proveedores">Proveedores</a>
				<ul>
					<li <?php if($submenu == 7.1){echo 'class="current"';}?>><?php echo anchor('proveedores/catalogo', 'Catalogo de Proveedores')?></li>
				</ul>
			</li>
			<li <?php if($menu == 10){echo 'class="stats current"';}else{echo 'class="stats"';}?>><a href="#" title="Estadisticas">Estadisticas</a>
                <ul>
                    <li <?php if($submenu == 10.1){echo 'class="current"';}?>><?php echo anchor('stats', 'Estadisticas')?></li>
                </ul>
            </li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Configuracion">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>
<?php
	}elseif($nivel == 2){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 2){echo 'class="productos current"';}else{echo 'class="productos"';}?>><a href="#" title="Productos">Productos</a>
				<ul>
					<li <?php if($submenu == 21){echo 'class="current"';}?>><?php echo anchor('productos/index/21', 'Catalogo de Productos')?></li>
					<li <?php if($submenu == 221){echo 'class="current"';}?>><?php echo anchor('productos/estado/1/221', 'Catalogo de Aguascalientes')?></li>
					<li <?php if($submenu == 2232){echo 'class="current"';}?>><?php echo anchor('productos/estado/32/2232', 'Catalogo de Zacatecas')?></li>
				</ul>
			</li>
			<li <?php if($menu == 4){echo 'class="pedidos current"';}else{echo 'class="pedidos"';}?>><?php echo anchor('pedidos', 'Pedidos', 'title="Pedidos"');?>
				<ul>
					<li <?php if($submenu == 4.1){echo 'class="current"';}?>><?php echo anchor('pedidos/nuevo_pedido', 'Nuevo Pedido')?></li>
					<li <?php if($submenu == 4.2){echo 'class="current"';}?>><?php echo anchor('pedidos/en_captura', 'En Captura')?></li>
					<li <?php if($submenu == 4.3){echo 'class="current"';}?>><?php echo anchor('pedidos/en_surtido', 'En Surtido')?></li>
					<li <?php if($submenu == 4.4){echo 'class="current"';}?>><?php echo anchor('pedidos/en_embarque', 'En Embarque')?></li>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Settings">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>

<?php
	}elseif($nivel == 3){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 2){echo 'class="productos current"';}else{echo 'class="productos"';}?>><a href="#" title="Productos">Productos</a>
				<ul>
					<li <?php if($submenu == 21){echo 'class="current"';}?>><?php echo anchor('productos/index/21', 'Catalogo de Productos')?></li>
					<li <?php if($submenu == 221){echo 'class="current"';}?>><?php echo anchor('productos/estado/1/221', 'Catalogo de Aguascalientes')?></li>
					<li <?php if($submenu == 2232){echo 'class="current"';}?>><?php echo anchor('productos/estado/32/2232', 'Catalogo de Zacatecas')?></li>
				</ul>
			</li>
			<li <?php if($menu == 5){echo 'class="clientes current"';}else{echo 'class="clientes"';}?>><?php echo anchor('pacientes/catalogo', 'Pacientes', 'title="Pacientes"');?>
				<ul>
					<li <?php if($submenu == 5.1){echo 'class="current"';}?>><?php echo anchor('pacientes/catalogo', 'Pacientes')?></li>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Settings">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>

<?php
	}elseif($nivel == 4){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 2){echo 'class="productos current"';}else{echo 'class="productos"';}?>><a href="#" title="Productos">Productos</a>
				<ul>
					<li <?php if($submenu == 21){echo 'class="current"';}?>><?php echo anchor('productos/index/21', 'Catalogo de Productos')?></li>
					<li <?php if($submenu == 221){echo 'class="current"';}?>><?php echo anchor('productos/estado/1/221', 'Catalogo de Aguascalientes')?></li>
					<li <?php if($submenu == 2232){echo 'class="current"';}?>><?php echo anchor('productos/estado/32/2232', 'Catalogo de Zacatecas')?></li>
				</ul>
			</li>
			<li <?php if($menu == 5){echo 'class="clientes current"';}else{echo 'class="clientes"';}?>><?php echo anchor('recetas', 'Recetas', 'title="Surtimiento de Recetas"');?>
				<ul>
					<li <?php if($submenu == 5.1){echo 'class="current"';}?>><?php echo anchor('recetas', 'Recetas')?></li>
					<li <?php if($submenu == 5.2){echo 'class="current"';}?>><?php echo anchor('recetas/surtidas', 'Recetas Surtidas')?></li>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Settings">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>

<?php
	}elseif($nivel == 10){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 1){echo 'class="home current"';}else{echo 'class="home"';}?>><a href="#" title="Home">Home</a>
				<ul>
					<li><a href="#" title="Dashboard">Dashboard</a></li>
					<li><a href="#" title="My profile">My profile</a></li>
					<li class="with-menu"><a href="#" title="My settings">My settings</a>
						<div class="menu">
							<img src="<?php echo base_url();?>images/menu-open-arrow.png" width="16" height="16">
							<ul>
								<li class="icon_address"><a href="#">Browse by</a>
									<ul>
										<li class="icon_blog"><a href="#">Blog</a>
											<ul>
												<li class="icon_alarm"><a href="#">Recents</a>
													<ul>
														<li class="icon_building"><a href="#">Corporate blog</a></li>
														<li class="icon_newspaper"><a href="#">Press blog</a></li>
													</ul>
												</li>
												<li class="icon_building"><a href="#">Corporate blog</a></li>
												<li class="icon_computer"><a href="#">Support blog</a></li>
												<li class="icon_search"><a href="#">Search...</a></li>
											</ul>
										</li>
										<li class="icon_server"><a href="#">Website</a></li>
										<li class="icon_network"><a href="#">Domain</a></li>
									</ul>
								</li>
								<li class="icon_export"><a href="#">Export</a>
									<ul>
										<li class="icon_doc_excel"><a href="#">Excel</a></li>
										<li class="icon_doc_csv"><a href="#">CSV</a></li>
										<li class="icon_doc_pdf"><a href="#">PDF</a></li>
										<li class="icon_doc_image"><a href="#">Image</a></li>
										<li class="icon_doc_web"><a href="#">Html</a></li>
									</ul>
								</li>
								<li class="sep"></li>
								<li class="icon_refresh"><a href="#">Reload</a></li>
								<li class="icon_reset">Reset</li>
								<li class="icon_search"><a href="#">Search</a></li>
								<li class="sep"></li>
								<li class="icon_terminal"><a href="#">Custom request</a></li>
								<li class="icon_battery"><a href="#">Stats server load</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li <?php if($menu == 4){echo 'class="pedidos current"';}else{echo 'class="pedidos"';}?>><?php echo anchor('pedidos', 'Pedidos', 'title="Pedidos"');?>
				<ul>
					<li <?php if($submenu == 4.1){echo 'class="current"';}?>><?php echo anchor('pedidos/nuevo_pedido', 'Nuevo Pedido')?></li>
					<li <?php if($submenu == 4.2){echo 'class="current"';}?>><?php echo anchor('pedidos/en_captura', 'En Captura')?></li>
					<li <?php if($submenu == 4.3){echo 'class="current"';}?>><?php echo anchor('pedidos/en_surtido', 'En Surtido')?></li>
					<li <?php if($submenu == 4.4){echo 'class="current"';}?>><?php echo anchor('pedidos/en_embarque', 'En Embarque')?></li>
					<li <?php if($submenu == 4.5){echo 'class="current"';}?>><?php echo anchor('pedidos/embarcados', 'Embarcados')?></li>
					<li <?php if($submenu == 4.6){echo 'class="current"';}?>><?php echo anchor('pedidos/cancelados', 'Cancelados')?></li>
					<li <?php if($submenu == 4.7){echo 'class="current"';}?>><?php echo anchor('pedidos/busqueda', 'Busqueda')?></li>
				</ul>
			</li>
			<li <?php if($menu == 9){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Salidas">Salidas</a>
				<ul>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 9.1){echo 'class="current"';}?>><?php echo anchor('inv/devo_almacen_merma/9.1', 'Devoluciones por merma en el almacen')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 3){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Inventario">Inventario</a>
				<ul>
					<li <?php if($submenu == 3.1){echo 'class="current"';}?>><?php echo anchor('inv', 'Inventario')?></li>
					<li <?php if($submenu == 3.15){echo 'class="current"';}?>><?php echo anchor('inv/inv_clasificado_elige', 'Inventario Clasificado')?></li>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 3.12){echo 'class="current"';}?>><?php echo anchor('inv/kardex/3.12', 'Kardex')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 5){echo 'class="clientes current"';}else{echo 'class="clientes"';}?>><a href="#" title="Sucursales">Sucursales</a>
				<ul>
					<li <?php if($submenu == 5.1){echo 'class="current"';}?>><?php echo anchor('sucursales/catalogo', 'Catalogo de Sucursales')?></li>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Settings">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>
<?php
	}elseif($nivel == 11){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 1){echo 'class="home current"';}else{echo 'class="home"';}?>><a href="#" title="Home">Home</a>
				<ul>
					<li><a href="#" title="Dashboard">Dashboard</a></li>
					<li><a href="#" title="My profile">My profile</a></li>
					<li class="with-menu"><a href="#" title="My settings">My settings</a>
						<div class="menu">
							<img src="<?php echo base_url();?>images/menu-open-arrow.png" width="16" height="16">
							<ul>
								<li class="icon_address"><a href="#">Browse by</a>
									<ul>
										<li class="icon_blog"><a href="#">Blog</a>
											<ul>
												<li class="icon_alarm"><a href="#">Recents</a>
													<ul>
														<li class="icon_building"><a href="#">Corporate blog</a></li>
														<li class="icon_newspaper"><a href="#">Press blog</a></li>
													</ul>
												</li>
												<li class="icon_building"><a href="#">Corporate blog</a></li>
												<li class="icon_computer"><a href="#">Support blog</a></li>
												<li class="icon_search"><a href="#">Search...</a></li>
											</ul>
										</li>
										<li class="icon_server"><a href="#">Website</a></li>
										<li class="icon_network"><a href="#">Domain</a></li>
									</ul>
								</li>
								<li class="icon_export"><a href="#">Export</a>
									<ul>
										<li class="icon_doc_excel"><a href="#">Excel</a></li>
										<li class="icon_doc_csv"><a href="#">CSV</a></li>
										<li class="icon_doc_pdf"><a href="#">PDF</a></li>
										<li class="icon_doc_image"><a href="#">Image</a></li>
										<li class="icon_doc_web"><a href="#">Html</a></li>
									</ul>
								</li>
								<li class="sep"></li>
								<li class="icon_refresh"><a href="#">Reload</a></li>
								<li class="icon_reset">Reset</li>
								<li class="icon_search"><a href="#">Search</a></li>
								<li class="sep"></li>
								<li class="icon_terminal"><a href="#">Custom request</a></li>
								<li class="icon_battery"><a href="#">Stats server load</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li <?php if($menu == 3){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Inventario">Inventario</a>
				<ul>
					<li <?php if($submenu == 3.1){echo 'class="current"';}?>><?php echo anchor('inv', 'Inventario')?></li>
					<li <?php if($submenu == 3.15){echo 'class="current"';}?>><?php echo anchor('inv/inv_clasificado_elige', 'Inventario Clasificado')?></li>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 3.12){echo 'class="current"';}?>><?php echo anchor('inv/kardex/3.12', 'Kardex')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Settings">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>
<?php
	}elseif($nivel == 12){
?>
	<nav id="main-nav">
		
		<ul class="container_12">
			<li <?php if($menu == 8){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Entradas">Entradas</a>
				<ul>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 8.2){echo 'class="current"';}?>><?php echo anchor('inv/devo/8.2', 'Devolucion de sucursales por excedente')?></li>
					<li <?php if($submenu == 8.3){echo 'class="current"';}?>><?php echo anchor('inv/devo_sucursales_merma/8.3', 'Devolucion de sucursales por merma')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 9){echo 'class="inv current"';}else{echo 'class="inv"';}?>><a href="#" title="Salidas">Salidas</a>
				<ul>
                    <?php if($row->estatus == 1){?>
					<li <?php if($submenu == 9.1){echo 'class="current"';}?>><?php echo anchor('inv/devo_almacen_merma/9.1', 'Devoluciones por merma en el almacen')?></li>
                    <?php }?>
				</ul>
			</li>
			<li <?php if($menu == 11){echo 'class="settings current"';}else{echo 'class="settings"';}?>><a href="#" title="Configuracion">Configuraci&oacute;n</a>
				<ul>
					<li <?php if($submenu == 11.1){echo 'class="current"';}?>><?php echo anchor('settings', 'Acerca de...')?></li>
					<li <?php if($submenu == 11.2){echo 'class="current"';}?>><?php echo anchor('settings/modificar_password', 'Modificar Contrase&ntilde;a')?></li>
				</ul>
            </li>
		</ul>
	</nav>
<?php
	}
?>
