<?php
/*
if (isset($_GET['atualizar'])) {


    include '../conexao.php';

    $dia = $_GET['atualizar'];

    $sql = "SELECT matricula, nome, situacao, endereco, curso, turma, dtmatricula FROM aluno WHERE dia = '$dia';";

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

if (isset($_POST['inseriraluno'])) {

    require 'conexao.php';

    //echo $_SESSION['usuario'];

    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $situacao = $_POST['situacao'];
    $cep = $_POST['cep'];
    $ruabairro = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $curso = $_POST['curso'];
    $turma = $_POST['turma'];
    $dtmatricula = $_POST['dtmatricula'];
    $foto = $_POST['foto'];

    $enderecocompleto = $ruabairro . ", " . 
    $numero . ", " . 
    $complemento . ", " . 
    $cidade . ", " . 
    $uf;

    $sql = "INSERT INTO aluno 
    (matricula, nome, situacao, endereco, curso, turma, dtmatricula, foto)
    VALUES ('$matricula','$nome','$situacao','$enderecocompleto','$curso','$turma','$dtmatricula','$foto');";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: index.php');
    } else {
?>
        <script>
            alert('erro ao inserir médico');
        </script>
    <?php
    }
}

if (isset($_POST['atualizaaluno'])) {

    require 'conexao.php';

    $idaluno = $_POST['id'];

    $sql = "SELECT * FROM `aluno` WHERE id = '$idaluno';";



    $result = mysqli_query($strcon, $sql);

    while ($row = mysqli_fetch_array($result)) {

        $matricula = $row['matricula'];
        $nome = $row['nome'];
        $situacao = $row['situacao'];
        $endereco = $row['endereco'];
        $curso = $row['curso'];
        $turma = $row['turma'];
        $dtmatricula = $row['dtmatricula'];
        $foto = $row['foto'];
    }
    ?>
    <form action="alunoDAO.php" method="POST">

        <input type="hidden" id="id" name="id" value="<?php echo $idaluno ?>"></input>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">Nome do aluno</label>
                <input type="text" required="required" id="nome" name="nome" id="nome" class="form-control" placeholder="nome" value="<?php echo $nome ?>">
            </div>

            <div class="form-group">
                <label for="crm">Matricula do aluno</label>
                <input required="required" type="text" id="matricula" name="matricula" id="matricula" class="form-control" placeholder="Matricula" value="<?php echo $matricula ?>">
            </div>

            <div class="form-group">
                <label for="nome">Aluno ativo?</label>
                <input type="text" required="required" id="situacao" name="situacao" id="situacao" class="form-control" placeholder="ativo" value="<?php echo $situacao ?>">
            </div>

            <div class="form-group">
                <label for="crm">Endereço do aluno</label>
                <input required="required" type="text" id="endereco" name="endereco" id="endereco" class="form-control" placeholder="Endereço" value="<?php echo $endereco ?>">
            </div>

            <div class="form-group">
                <label for="crm">Curso do aluno</label>
                <input required="required" type="text" id="curso" name="curso" id="curso" class="form-control" placeholder="Curso" value="<?php echo $curso ?>">
            </div>

            <div class="form-group">
                <label for="crm">Turma do aluno</label>
                <input required="required" type="text" id="turma" name="turma" id="turma" class="form-control" placeholder="Turma" value="<?php echo $turma ?>">
            </div>

            <div class="form-group">
                <label for="crm">Data de matrícula do aluno</label>
                <input required="required" type="text" id="dtmatricula" name="dtmatricula" id="dtmatricula" class="form-control" placeholder="Data" value="<?php echo $dtmatricula ?>">
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input required="required" type="file" id="foto" name="foto" id="foto" class="form-control" placeholder="Foto" value="<?php echo $foto ?>">
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

    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $situacao = $_POST['situacao'];
    $endereco = $_POST['endereco'];
    $curso = $_POST['curso'];
    $turma = $_POST['turma'];
    $dtmatricula = $_POST['dtmatricula'];
    $foto = $_POST['foto'];

    $sql = "UPDATE aluno SET matricula = '$matricula', 
    nome = '$nome', situacao = '$situacao', endereco = '$endereco', 
    curso = '$curso', turma = '$turma', dtmatricula = '$dtmatricula', foto = '$foto' 
    WHERE id = '$idaluno'";

    echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: index.php');
    } else {
    ?>
        <script>
            alert('erro ao atualizar aluno');
        </script>
    <?php
    }
}

if (isset($_POST['deletaaluno'])) {

    require 'conexao.php';

    $idaluno = $_POST['id'];

    $sql = "DELETE FROM aluno WHERE id = '$idaluno';";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: index.php');
    } else {
    ?>
        <script>
            alert('erro ao deletar aluno');
        </script>
    <?php
    }
}

function readAluno()
{

    require 'conexao.php';



    $dia = date("Y-m-d");



    $sql = "SELECT id, matricula, nome, situacao, endereco, curso, turma, dtmatricula FROM aluno;";

    //echo $sql;

    $result = mysqli_query($strcon, $sql);
    //echo $result;

    while ($row = mysqli_fetch_array($result)) :; ?>


        <tr>
            <form onsubmit="return confirm('Deseja realmente realizar esta ação?')" action="alunoDAO.php" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"></input>
                <td scope="col" class="border" name="matricula" style="white-space: nowrap"><?php echo $row['matricula'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['nome'] ?>" style="white-space: nowrap"><?php echo $row['nome'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['situacao'] ?>" style="white-space: nowrap"><?php echo $row['situacao'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['endereco'] ?>" style="white-space: nowrap"><?php echo $row['endereco'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['curso'] ?>" style="white-space: nowrap"><?php echo $row['curso'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['turma'] ?>" style="white-space: nowrap"><?php echo $row['turma'] ?></td>

                <td scope="col" class="border" name="<?php echo $row['dtmatricula'] ?>" style="white-space: nowrap"><?php echo $row['dtmatricula'] ?></td>

                <td>
                    <button type="submit" id="" name="atualizaaluno" class="btn btn-sm btn-info">Atualizar</a>
                </td>

                <td><button type="submit" id="" name="deletaaluno" class="btn btn-sm btn-danger">Excluir</button></td>
            </form>
        </tr>

<?php endwhile;
}



?>