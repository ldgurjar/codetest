<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends CI_Model {

    public function getRowById($table, $primary_key, $primary_key_value, $where = "") {
        $sql = "SELECT * FROM " . $table . " WHERE " . $primary_key . "='" . $primary_key_value . "' " . $where;
        $query = $this->db->query($sql);
        $data = $query->result();
        if ($data) {
            return $data[0];
        }
        return false;
    }    
    
    public function insertQuestion($obj){
        $obj = json_decode($obj['QuestionData'], true);
     
        try{
           foreach($obj as $QuestionData){
               $dataq = array(
                'questiontext' => $QuestionData['questiontext'],
                'question_parent' => 0
               );
                $this->db->insert('questions', $dataq);
                $intertid = $this->db->insert_id(); 
                // echo $intertid ;
           
               foreach($QuestionData['answertext'] as $answerarr){
                    $data_ans = array(
                    'answertext' => $answerarr['answertext'],
                    'answertype' => $answerarr['optionValue'],
                    'question_id' => $intertid,
                    'hassubquestion' => $answerarr['hassubquestion'],
                    'subquestiondata' => serialize($answerarr['subquestiondata'])

                   );
                   $this->db->insert('answers', $data_ans);
                   //$intertid = $this->db->insert_id();
                }
           }
           return 'data saved'; 
        }
        catch(Exception $e) {
          return 'Message: ' .$e->getMessage();
        }
    }
}
