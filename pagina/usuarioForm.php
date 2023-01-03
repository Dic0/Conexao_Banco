<?php
include "../database/bd.php";
include "../pagina/head.php";

$objBD = new BD();
$objBD->conn();
$tb_name = "usuario";

if (!empty($_GET['id'])) {
    $result = $objBD->buscar($tb_name, $_GET['id']);
}
if (!empty($_POST)) {

    if (empty($_POST['id'])) {
        $objBD->inserir($tb_name, $_POST);
    } else {
        $objBD->update($tb_name, $_POST);
    }
    header("Location: ./usuarioList.php");
}

?>

<h2>Formulário Cliente</h2>
<form action="./usuarioForm.php" method="post">
    <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : "" ?>" /><br>

    <label>Nome</label>
    <input type="text" name="nome" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" /><br>

    <label>Telefone</label>
    <input type="text" name="telefone" value="<?php echo !empty($result->telefone) ? $result->telefone : "" ?>" /><br>

    <label>CPF</label>
    <input type="text" name="cpf" value="<?php echo !empty($result->cpf) ? $result->cpf : "" ?>" /><br>

    <input type="submit" value="Salvar" />
</form>
<a href="./usuarioList.php">Voltar</a> <br>

<?php
include "../pagina/footer.php";

?>