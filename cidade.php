<?php
require_once ('classes/cidade.class.php');
$estado = $_GET['estado'];
    $c1 = new Cidade();    
    @$linha2=count($c1->CidadePorEstado($estado));
    @$cpe=$c1->CidadePorEstado($estado);
echo "
        <select name='cidade' id='pref'>";      // Cidade
        	if ($cpe == false) 
        	{
        		echo "<option value='NULO'>Selecione um estado</option><br>";
        	}
        	else
        	{
		for( $n=0 ; $n < $linha2 ; $n++)
            	{
            			$codigo = $cpe[$n][1];
           		echo "<option value='$codigo'>".$cpe[$n][0]."</option><br>";
            	}
         	}
echo "</select>";
?>