<?php

	require 'banco.php';

	$id = null;
	if ( !empty($_GET['id']))
            {
		$id = $_REQUEST['id'];
            }

	if ( null==$id )
            {
		header("Location: solicitacao.php");
            }

	if ( !empty($_POST))
            {

		$ProdutoErro = null;
        $UnidadeErro = null;
        
		$Produto = $_POST['Produto'];
		$Unidade = $_POST['Unidade'];
   

		//Validação
		$validacao = true;
		if (empty($Produto))
                {
                    $ProdutoErro = 'Por favor digite o Produto!';
                    $validacao = false;
                }
                if (empty($Unidade))
                {
                    $Unidade = 'Por favor digite o Unidade!';
                    $validacao = false;
		}
		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE solicitacao  set Produto = ?, Unidade = ? WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($Produto,$Unidade,$id));
                    Banco::desconectar();
                    header("Location: solicitacao.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM solicitacao where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Produto = $data['Produto'];
                $Unidade = $data['Unidade'];
		Banco::desconectar();
	}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
				<title>Atualizar Solicitação</title>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Solicitação </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($ProdutoErro)?'error':'';?>">
                        <label class="control-label">Produto</label>
                        <div class="controls">
                            <input name="Produto" class="form-control" size="50" type="text" placeholder="Produto" value="<?php echo !empty($Produto)?$Produto:'';?>">
                            <?php if (!empty($ProdutoErro)): ?>
                                <span class="help-inline"><?php echo $ProdutoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($UnidadeErro)?'error':'';?>">
                        <label class="control-label">Unidade</label>
                        <div class="controls">
                            <input name="Unidade" class="form-control" size="30" type="text" placeholder="Unidade" value="<?php echo !empty($Unidade)?$Unidade:'';?>">
                            <?php if (!empty($UnidadeErro)): ?>
                                <span class="help-inline"><?php echo $UnidadeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="solicitacao.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
							</div>
						</div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

    </html>
