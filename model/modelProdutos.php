<?php 

class ModelProdutos{
    function produtos_get($parametro){
        try{
            $opcao = '';   
            if(isset($parametro[0])){
                $opcao = 'Where id = :id';
            }               
            $stmp = CON::getInstance()->prepare('select * from produto '.$opcao);
            $stmp->bindParam( ':id', $parametro[0],PDO::PARAM_INT );            
            $stmp->execute();
            return $stmp->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return 'erro ao cadastrar '.$e.' --- parametros ---'.var_dump($parametro);
        }
    }

    function produto_insert($parametro){
        try{
            if (!isset($parametro['id'])){
                $stmp = CON::getInstance()->prepare('insert into produto(descricao,cor) values (:descricao,:cor) ');
            }else{
                $stmp = CON::getInstance()->prepare('insert into produto(id,descricao,cor) values (:id,:descricao,:cor) ON DUPLICATE KEY UPDATE descricao = :descricao, cor = :cor');
                $stmp->bindParam( ':id', $parametro['id'] );  
            }
            $stmp->bindParam( ':descricao', $parametro['descricao'] );
            $stmp->bindParam( ':cor', $parametro['cor'] );
            $stmp->execute();
            return 'cadastrado com sucesso';
        }
        catch(PDOException $e){
            return 'erro ao cadastrar '.$e.' --- parametros ---'.var_dump($parametro);
        }
    }

    function produto_update($parametro){
        try{    
            $stmp = CON::getInstance()->prepare('update produto  set descricao=:descricao, cor=:cor where id=:id');
            $stmp->bindParam(":id",$parametro['id']);
            $stmp->bindParam(":descricao",$parametro['descricao']);
            $stmp->bindParam(":cor",$parametro['cor']);
            $stmp->execute();    
            return 'cadastrado com sucesso';    
        } catch (PDOException $e){
            return 'erro ao cadastrar '.$e.' --- parametros ---'.var_dump($parametro);
        }
    }

    function produto_delete($parametro){  
        try{    
            $stmp = CON::getInstance()->prepare('delete from produto where id = :id');
            $stmp->bindParam(":id",$parametro['id']); 
            $stmp->execute();    
            return 'cadastrado com sucesso';    
        } catch (PDOException $e){
            return 'erro ao cadastrar '.$e;
        }
    }
}