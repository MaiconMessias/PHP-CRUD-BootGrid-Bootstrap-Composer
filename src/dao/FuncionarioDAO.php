<?php

namespace dao;

use dao\Conexao;

class FuncionarioDAO {

    private $con;
    private $query;
    private $data;
    private $records_per_page;
    private $start_from;
    private $current_page_number;

    public function __construct() {
        $this->con = Conexao::openConPostgre();
        $this->query = 'select id,nome,cpf,rg from funcionario';
        $this->data = array();
        $this->records_per_page = 10;
        $this->start_from = 0;
        $this->current_page_number = 0;
    }

    public function getAllFuncionarios($params) {
        $this->data = $this->getAll($params);
        echo json_encode($this->data);
    }

    private function getAll($params) {
        // Setando o numero da pagina corrente
        if (isset($params["current"])) {
            $this->current_page_number = $params["current"];
        } else {
            $this->current_page_number = 1;
        }

        // Obtendo quantos dados seram exibidos por pagina
        if (isset($params["rowCount"])) {
            $this->records_per_page = $params["rowCount"];
        } else {
            $this->records_per_page = 10;
        }
        $this->start_from = ($this->current_page_number - 1) * $this->records_per_page;

        if (!empty($params["searchPhrase"])) {
            $this->query .= " WHERE (nome LIKE '%" . $params["searchPhrase"] . "%' )";
        }

        // Alterando consulta para ordenacao da coluna clicada
        $order_by = '';
        if (isset($params["sort"]) && is_array($params["sort"])) {
            foreach ($params["sort"] as $key => $value) {
                $order_by .= " $key $value, ";
            }
        } else {
            $this->query .= ' ORDER BY id Asc ';
        }

        if ($order_by != '') {
            $this->query .= ' ORDER BY ' . substr($order_by, 0, -2);
        }

        // Limitando numero de registros obtidos no sql
        if ($this->records_per_page != -1) {
            $this->query .= " LIMIT " . $this->records_per_page . " OFFSET " . $this->start_from;
        }

        /** Obtendo dados com a consulta resultante ******
         */
        $result = pg_query($this->con, $this->query) or die("erro ao obter os dados do funcionário");
        while ($row = pg_fetch_row($result)) {
            $this->data[] = array(
                "id" => $row[0],
                "nome" => $row[1],
                "cpf" => $row[2],
                "rg" => $row[3]
            );
        }

        // Obtendo o numero total de funcionarios
        $query1 = "SELECT * FROM funcionario ";
        $result1 = pg_query($this->con, $query1) or die("erro ao obter os dados do funcionário");
        $total_records = pg_num_rows($result1);

        $output = array(
            "current" => intval($this->current_page_number),
            "rowCount" => $this->records_per_page,
            "total" => intval($total_records),
            "rows" => $this->data
        );

        return $output;
    }

    public function insertFuncionario($param) {
        $this->data = array();
        $this->query = "insert into funcionario (nome,cpf,rg) values('" . $param["name"] . "', '" . $param["cpf"] . "',"
                       . " '" . $param["rg"] . "')";
        echo $result = pg_query($this->con, $this->query) or die("erro ao obter os dados do funcionário");
    }

    public function updateFuncionario($param) {
        $this->data = array();
        $this->query = "update funcionario set nome = '" . $param["edit_name"] . "', cpf='" . $param["edit_cpf"] . "',"
                       . " rg='" . $param["edit_rg"] . "'"
                       . " where id = " . $param["edit_id"];
        echo $result = pg_query($this->con, $this->query) or die("erro ao obter os dados do funcionário");
    }

    public function deleteFuncionario($param) {
        $this->data = array();
        $this->query = "delete from funcionario where id = " . $param["id"];
        echo $result = pg_query($this->con, $this->query) or die("erro ao obter os dados do funcionário");
    }

}
