<?php
//utilização de namespaces
namespace processaAcesso {

include '../config/mysql.php';

    use Mysql as Mysql;

    class ProcessaAcesso {
        var $db;
        public function __construct() {
            $conexao = new Mysql\mysql(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->db = $conexao;
        }
        public function verificaAcesso($login, $senha) {
            $select = $this->db->select('usuario', '*',
            " where login = '$login' and senha = '$senha'");
            return $select;
        }
        public function cadastraUsuario($dados){
            $insert = $this->db->insert('usuario', $dados);
            return $insert;
        }
    }
    
}
?>