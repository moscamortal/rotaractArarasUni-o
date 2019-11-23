<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Contato</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Solicitação </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($ProdutoErro)?'error ' : '';?>">
                    <label class="control-label">Produto</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="Produto" type="text" placeholder="Produto" required="" value="<?php echo !empty($Produto)?$Produto: '';?>">
                        <?php if(!empty($ProdutoErro)): ?>
                            <span class="help-inline"><?php echo $ProdutoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($UnidadeErro)?'error ': '';?>">
                    <label class="control-label">Unidade</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="Unidade" type="text" placeholder="Unidade" required="" value="<?php echo !empty($Unidade)?$Unidade: '';?>">
                        <?php if(!empty($emailErro)): ?>
                            <span class="help-inline"><?php echo $UnidadeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>
                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="solicitacao.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
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

<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $ProdutoErro = null;
        $UnidadeErro = null;

        $Produto = $_POST['Produto'];
        $Unidade = $_POST['Unidade'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($Produto))
        {
            $ProdutoErro = 'Por favor digite o seu Produto!';
            $validacao = false;
        }

        if(empty($Unidade))
        {
            $UnidadeErro = 'Por favor digite o número do Unidade!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO solicitacao (Produto, Unidade) VALUES(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($Produto,$Unidade));
            Banco::desconectar();
            header("Location: solicitacao.php");
        }
    }
?>
