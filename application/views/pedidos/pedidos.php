<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                        ?>
                        
            </h1>
            <?php $paginas = $this->pagination->create_links();?>
            <p align="center">
            <?php echo $paginas;?>
            </p>
            
            <?php $this->load->view('pedidos/pedidos_pedidos')?>


            <p align="center">
            <?php echo $paginas;?>
            </p>
        </div>



    </div>
</section>