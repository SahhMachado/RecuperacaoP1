<?php
    class ItemV{
        private $iv_v_idVenda;
        private $iv_l_id_livro;
        private $iv_quantidade;
        private $iv_valor_total_item;
        private $iv_data_venda;

        
        public function __construct($idV, $idL, $qtd, $totalI, $data){
            
            $this->setIdV($idV);
            $this->setIdL($idL);
            $this->setQtd($qtd);
            $this->setTotalI($totalI);
            $this->setData($data);
        }

        public function getIdV(){ return $this->iv_v_idVenda; }
        public function setIdV($idV){ return $this->iv_v_idVenda = $idV; }

        public function getIdL(){ return $this->iv_l_id_livro; }
        public function setIdL($idL){ return $this->iv_l_id_livro = $idL; }

        public function getQtd(){ return $this->iv_quantidade; }
        public function setQtd($qtd){ return $this->iv_quantidade = $qtd; }

        public function getTotalI(){return $this->iv_valor_total_item; }
        public function setTotalI($totalI){ return $this->iv_valor_total_item = $totalI; }
        
        public function getData(){return $this->iv_data_venda; }
        public function setData($data){ return $this->iv_data_venda = $data; }
        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO item_venda (iv_l_id_livro, iv_quantidade, iv_valor_total_item, iv_data_venda) 
            VALUES(:iv_l_id_livro, :iv_quantidade, :iv_valor_total_item, :iv_data_venda)');

            $stmt->bindValue(':iv_l_id_livro', $this->getIdL());
            $stmt->bindValue(':iv_quantidade', $this->getQtd());
            $stmt->bindValue(':iv_valor_total_item', $this->getTotalI());
            $stmt->bindValue(':iv_data_venda', $this->getData());

    
            return $stmt->execute();
            
        }

        public function editar($iv_v_idVenda){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE item_venda SET iv_l_id_livro = :iv_l_id_livro, iv_quantidade = :iv_quantidade, iv_valor_total_item = :iv_valor_total_item, iv_data_venda = :iv_data_venda
                WHERE iv_v_idVenda = :iv_v_idVenda');

                $stmt->bindValue(':iv_v_idVenda', $this->setIdV($this->iv_v_idVenda));
                $stmt->bindValue(':iv_l_id_livro', $this->setIdL($this->iv_l_id_livro));
                $stmt->bindValue(':iv_quantidade', $this->setQtd($this->iv_quantidade));
                $stmt->bindValue(':iv_valor_total_item', $this->setTotalI($this->iv_valor_total_item));
                $stmt->bindValue(':iv_data_venda', $this->setData($this->iv_data_venda));

                return $stmt->execute();
            }

        function excluir($iv_v_idVenda){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM item_venda WHERE iv_v_idVenda = :iv_v_idVenda');
            $stmt->bindValue(':iv_v_idVenda', $iv_v_idVenda);
            
            return $stmt->execute();
        }

        public function buscar($idV, $idL){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM item_venda';
            if($idV > 0){
                $query .= ' WHERE iv_v_idVenda = :Id 
                AND iv_l_id_livro = :IdL';
                $stmt->bindParam(':Id', $idV);
                $stmt->bindParam(':IdL', $idL);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }
    }
?>