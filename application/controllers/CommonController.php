<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class CommonController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('getQuery/getQueryModel');
	}


	public function getPartsByProdFamily()
	{
        $prod_family_id =$_POST['Prod_Family_Id'];
        $pId            =$_POST['pId'];
        $getParts		= $this->getQueryModel->getPartsByProdFamilyId($prod_family_id);
        echo '<option  value="">Choose part</option>';
        foreach($getParts as $pt){ 
        $ids=$pt['part_id'];
        $name=$pt['name'];
        $partno=$pt['partno'];
        $nameNNo=$partno.' - '.$name;
        
       /* if($pId !='')
        {
            $selected = 'selected';
        }else
        {
            $selected = '';
        }*/
         $selected='';
        if($pId==$ids){
          $selected = 'selected';
        }
        echo '<option value="'.$ids.'" '.$selected.'>'.$nameNNo.'</option>';
        }
	}
	  public function getPartsBySearch()
    {
        $search=$this->input->post('search');
        $getParts      = $this->getQueryModel->getPartsBySearchval($search);
        $list="";
        if($getParts){
           // echo "<pre>";print_r($getParts);die;
          foreach($getParts as $pt){ 
                $ids=$pt['part_id'];
                $name=$pt['name'];
                $partno=$pt['partno'];
                $nameNNo=$partno.' - '.$name;
                $list.="<li value='$ids'>".$nameNNo."</li>";
            }
        echo $list;

        }else{
             echo "<li>No Result Found</li>";
        }
       

        

    }

}

?>