<?php

function readCursoList(){
    require 'conexao.php';

    $sql = "SELECT codigo, nome FROM curso;";

    //echo $sql;
    $result = mysqli_query($strcon, $sql);

    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>

        <option id="<?php echo $row['codigo'] ?>" value="<?php echo $row['nome'] ?>"><?php echo $row['codigo'] ?></option>

    <?php endwhile;
}
/*
if (isset($_GET['atualizar'])) {


    include '../conexao.php';

    $dia = $_GET['atualizar'];

    $sql = "SELECT codigo, nome FROM curso WHERE dia = '$dia';";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);
    $output .= ' <table id="presenca" class="table bg-success bg-gradient rounded text-white">
          <thead>
            <tr>
                <th scope="col" class="border">MATRICULA</th>
                <th scope="col" class="border">NOME</th>
                <th scope="col" class="border">SITUAÇÃO</th>
                <th scope="col" class="border">ENDEREÇO</th>
                <th scope="col" class="border">CURSO</th>
                <th scope="col" class="border">TURMA</th>
                <th scope="col" class="border">DATA DE MATRICULA</th>
                <th colspan="col-2" class="border">
              </th>
            </tr>
    ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["matricula"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["nome"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["situacao"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["endereco"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["curso"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["turma"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">' . $row["dtmatricula"] . '</td>

            <td scope="col" class="border" style="white-space: nowrap">Não é possível excluir registros passados!</td>

        </tr>
            ';
        }
    } else {
        $output .= '
        <tr>
        <td colspan="9">Nada encontrado</td>
        </tr>
        ';
    }
    $output .= '</table';
    echo $output;
}
*/
if (isset($_POST['inserircurso'])) {

    require 'conexao.php';

    //echo $_SESSION['usuario'];

    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = "INSERT INTO curso 
    (codigo, nome)
    VALUES ('$codigo','$nome');";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: cursos.php');
    } else {
?>
        <script>
            alert('erro ao inserir curso');
        </script>
    <?php
    }
}

if (isset($_POST['atualizacurso'])) {

    require 'conexao.php';

    $idcurso = $_POST['id'];

    $sql = "SELECT * FROM `curso` WHERE id = '$idcurso';";



    $result = mysqli_query($strcon, $sql);

    while ($row = mysqli_fetch_array($result)) {

        $codigo = $row['codigo'];
        $nome = $row['nome'];
    }
    ?>
    <form action="cursoDAO.php" method="POST">

        <input type="hidden" id="id" name="id" value="<?php echo $idcurso ?>"></input>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">Nome do aluno</label>
                <input type="text" required="required" id="nome" name="nome" id="nome" class="form-control" placeholder="nome" value="<?php echo $nome ?>">
            </div>

            <div class="form-group">
                <label for="codigo">Codigo do curso</label>
                <input required="required" type="text" id="codigo" name="codigo" id="codigo" class="form-control" placeholder="codigo" value="<?php echo $codigo ?>">
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" name="update" class="btn btn-info">Atualizar</button>
        </div>
    </form>
    <?php
}

if (isset($_POST['update'])) {
    require 'conexao.php';

    $idaluno = $_POST['id'];

    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = "UPDATE curso SET codigo = '$codigo', 
    nome = '$nome' WHERE id = '$idaluno'";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: cursos.php');
    } else {
    ?>
        <script>
            alert('erro ao atualizar curso');
        </script>
    <?php
    }
}

if (isset($_POST['deletacurso'])) {

    require 'conexao.php';

    $idcurso = $_POST['id'];

    $sql = "DELETE FROM curso WHERE id = '$idcurso';";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: cursos.php');
    } else {
    ?>
        <script>
            alert('erro ao deletar curso');
        </script>
    <?php
    }
}

function readCurso()
{

    require 'conexao.php';



    $dia = date("Y-m-d");



    $sql = "SELECT id, codigo, nome FROM curso;";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);
    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>


        <tr>
            <form onsubmit="return confirm('Deseja realmente realizar esta ação?')" action="cursoDAO.php" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"></input>
                <td scope="col" class="border" name="codigo" style="white-space: nowrap"><?php echo $row['codigo'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['nome'] ?>" style="white-space: nowrap"><?php echo $row['nome'] ?></td>

                <td>
                    <button type="submit" id="" name="atualizacurso" class="btn btn-sm btn-info">Atualizar</a>
                </td>

                <td><button type="submit" id="" name="deletacurso" class="btn btn-sm btn-danger">Excluir</button></td>
            </form>
        </tr>

<?php endwhile;
}



?>