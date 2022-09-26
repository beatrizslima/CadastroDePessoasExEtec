<?php
//iniciando a sessão
session_start();


//criando a array principal que vai armazenar os outros dados 
$listaDePessoas = array();

if(isset($_GET['idade'])){ //verificando se o campo da url está preenchido
	$idade = $_GET['idade'];// $_GET['nome'] pega os valores dos campos da URL
	$alt   = $_GET['alt'];
	$sexo  = $_GET['sexo'];
	$nome  = $_GET['nome'];
	if ($idade != null) { 
		//se estiver preenchido, esta lógica é feita:
	    $pessoa = array( //atribuindo os dados da nova array à variável $pessoa
	        'sexo'=>$sexo,
	        'alt'=>$alt,
	        'idade'=>$idade,
	        'nome'=>$nome
	    );
	    $listaDePessoas = $_SESSION['list']; //pegando todos os dados da sessão e adicionando na array principal

	    array_push($listaDePessoas, $pessoa); //pegando os dados da array dentro de $pessoa e inserindo na array principal

	    $_SESSION["list"] = $listaDePessoas; //reorganizando tudo o que foi feito dentro da session
	} else { //se não estiver preenchido..
	    unset($_SESSION["list"]); //os dados são limpos, 
	    $_SESSION["list"] = $listaDePessoas; //a sessão atual continua vazia. 
	}
}
?>


<?php
//comparando menor altura e menor altura

function comparaAlt($a, $b) //função criada
{
    return $a['alt'] > $b['alt'];
}
usort($listaDePessoas, "comparaAlt"); //usort vai organizar em ordem crescente, de acordo com a função passada

//tabela
?>
<html>
<body>
	<link rel="stylesheet" type="text/css" href="http://localhost/arrayEx/estilo.css">

	<div class="container">
	<h2>Tabela de Cadastro</h2>
<hr>

<table>
	<thead>
		<th>Nome</th>
		<th>Sexo</th>
		<th>Altura</th>
		<th>Idade</th>
	</thead>


<?php
if(sizeof($listaDePessoas)>0){   //sizeof retorna o número de itens no array passado
for ($i=0; $i < sizeof($listaDePessoas) ; $i++) { 
	echo "<tr>";
	echo "<td>" .$listaDePessoas[$i]['nome']. "</td>";
	echo "<td>" .$listaDePessoas[$i]['sexo']. "</td>";
	echo "<td>" .$listaDePessoas[$i]['alt']. "</td>";
	echo "<td>" .$listaDePessoas[$i]['idade']. "</td>";
	echo "</tr>";
}
echo "</table>
</div";
}

if(sizeof($listaDePessoas) > 0){
echo "<br> <p>".sizeof($listaDePessoas)." Pessoas cadastradas </p> <hr>";
echo "<p>A menor pessoa tem:" . $listaDePessoas[0]['alt']. "</p>";
}

if(sizeof($listaDePessoas) > 0){
	echo "<p>A maior pessoa tem: " . $listaDePessoas[sizeof($listaDePessoas) - 1]['alt']. "</p>";
// $listaDePessoas[sizeof($listaDePessoas) - 1]  pega o ultimo item do array, tamanho -1
}
// media de altura mulheres

$numeroMulheres = 0;
$somaAltM       = 0;
$homemMaisVelho = null;
$mulherMaisNova = null;



for ($i = 0; $i < sizeof($listaDePessoas); $i++) {
    if ($listaDePessoas[$i]['sexo'] == 1) {
        $numeroMulheres++;
        $somaAltM += $listaDePessoas[$i]['alt'];
        
        if($mulherMaisNova==null || $listaDePessoas[$i]['idade']<$mulherMaisNova['idade']){  
			//verificando a mulher mais nova
            $mulherMaisNova = $listaDePessoas[$i];
        }
    } else {
        if ($homemMaisVelho==null || $listaDePessoas[$i]['idade'] > $homemMaisVelho['idade']) {  //verificando o homem mais velho
            $homemMaisVelho = $listaDePessoas[$i]; 
        }
    }
}


if($numeroMulheres > 0){

	echo "<p> A media de altura entre as mulheres é de: " .$somaAltM / $numeroMulheres;
}
if($homemMaisVelho != null){
echo "<p> O homem mais velho é ".$homemMaisVelho['nome']. " e tem: " .$homemMaisVelho['idade']. " anos. </p>";
}
if($mulherMaisNova != null){
echo "<br><p> A mulher mais nova é ".$mulherMaisNova['nome']. " e tem: " .$mulherMaisNova['idade']. " anos. </p><br>";
}
?>
<a href="index.html">Voltar</a>
</div>
</body>

</html>