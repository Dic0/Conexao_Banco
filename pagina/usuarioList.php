<?php
include "../database/bd.php";
include "../pagina/head.php";
?>

<h2>Listagem Clientes</h2>
<form action="./usuarioList.php" method="post">
    <input type="text" name="valor" placeholder="Pesquisar Nome" />
    <select name="tipo">
        <option value="nome" selected>Nome</option>
        <option value="cpf">CPF</option>
    </select>
</form>
<a href="./usuarioForm.php">Cadastrar</a> <br>

<?php

$objBD = new BD();
$objBD->conn();
$tb_name = "usuario";

if (!empty($_POST['valor'])) {
    $result = $objBD->pesquisar($tb_name, $_POST);
} else {
    $result = $objBD->select($tb_name);
}

if (!empty($_GET['id'])) {
    $objBD->remover($tb_name, $_GET['id']);
    header("location: usuarioList.php");
}

echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Ação</th>
                    <th>Ação</th>
                </tr>
            ";
foreach ($result as $item) {
    echo "
        <tr>
            <td>" . $item['id'] . "</td>
            <td>" . $item['nome'] . "</td>
            <td>" . $item['telefone'] . "</td>
            <td>" . $item['cpf'] . "</td>
            <td><a href='./usuarioForm.php?id=" . $item['id'] . "'>Editar</a></td>
            <td><a href='./usuarioList.php?id=" . $item['id'] . "'
                   onclick=\"return confirm('Deseja realmente remover o registro?') \" >Deletar</a></td>
        </tr>";
}
echo "</table>";

?>

<a href="../index.php">Voltar</a>

<?php
include "../pagina/footer.php";

?>