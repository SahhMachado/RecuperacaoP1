<?php
    class Venda{
        private $v_idVenda;
        private $v_valor_total_venda;
        private $v_desconto;
        private $v_c_idCliente;

        
        public function __construct($id, $valorT, $desconto, $idC){
            
            $this->setId($id);
            $this->setValorT($valorT);
            $this->setDesconto($desconto);
            $this->setIdC($idC);
        }

        public function getId(){ return $this->v_idVenda; }
        public function setId($id){ return $this->v_idVenda = $id; }

        public function getValorT(){ return $this->v_valor_total_venda; }
        public function setValorT($valorT){ return $this->v_valor_total_venda = $valorT; }

        public function getdesconto(){ return $this->v_desconto; }
        public function setDesconto($desconto){ return $this->v_desconto = $desconto; }

        public function getIdC(){ return $this->v_c_idCliente; }
        public function setIdC($idC){ return $this->v_c_idCliente = $idC; }

        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO venda (v_valor_total_venda, v_desconto, v_c_idCliente) 
            VALUES(:v_valor_total_venda, :v_desconto, :v_c_idCliente)');

            $stmt->bindValue(':v_valor_total_venda', $this->getValorT());
            $stmt->bindValue(':v_desconto', $this->getdesconto());
            $stmt->bindValue(':v_c_idCliente', $this->getIdC());

    
            return $stmt->execute();
            
        }

        public function editar($v_idVenda){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE venda SET v_valor_total_venda = :v_valor_total_venda, v_desconto = :v_desconto, v_c_idCliente = :v_c_idCliente
                WHERE v_idVenda = :v_idVenda');

                $stmt->bindValue(':v_idVenda', $this->setId($this->v_idVenda));
                $stmt->bindValue(':v_valor_total_venda', $this->setValorT($this->v_valor_total_venda));
                $stmt->bindValue(':v_desconto', $this->setDesconto($this->v_desconto));
                $stmt->bindValue(':v_c_idCliente', $this->setIdC($this->v_c_idCliente));

                return $stmt->execute();
            }

        function excluir($v_idVenda){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM venda WHERE v_idVenda = :v_idVenda');
            $stmt->bindValue(':v_idVenda', $v_idVenda);
            
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM venda';
            if($id > 0){
                $query .= ' WHERE v_c_idCliente = :Id';
                $stmt->bindParam(':Id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }

    }
?>