<?php
namespace dao;

class UsuarioDAO {
    
    public function __construct(){}
    
    public function validaLogin($usr, $pwd) {
        $con = Conexao::openConPostgre();
        /* retorno
        * -2 - erro bd
        * -1 - usuario nao cadastrado no bd
        *  0 - usuario e/ou senha invalido(s)
        *  1 - sucesso no login
        */
        // Verificando se o usuario existe no bd
        $query =   "select * from usuario where usuario='" . $usr . "'";
        $rs = pg_query($con, $query) or die("erro ao obter os dados do usuário");
        $total_records = pg_num_rows($rs);
        if ($total_records == 0)
             return -1;
        // Verificando se usuario e senha sao validos     
        $query = "select * from usuario where usuario='" . $usr . 
                 "' and senha='" . $pwd . "'"; 
        $rs = pg_query($con, $query) or die("erro ao obter os dados do usuário");
        $total_records = pg_num_rows($rs);
        
        if ($total_records > 0) {
            session_start();
            $_SESSION['usuario'] = $usr;
            return 1;
        } else            
            return 0;
    }
    
    public function incUsuario($usr, $pwd){
        $con = Conexao::openConPostgre();
        $query = "insert into usuario(usuario,senha,id_funcionario) values('"
                 . $usr . "', '" . $pwd . "', 1)";
        $rs = pg_query($con, $query) or die("erro ao obter os dados do usuário");
        $resultado = pg_affected_rows($rs);
        if ($resultado == 0)
            return 0;
        else 
            return 1;
    }
}
?>