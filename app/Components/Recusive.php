<?php 
namespace App\Components;

class Recusive {
    private $data;
    private $htmlSlelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function categoryRecustive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
				if ( !empty($parentId) && $parentId == $value['id'])
				{
					 $this->htmlSlelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
				}else{
					$this->htmlSlelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
				}
               
             
                $this->categoryRecustive($parentId, $value['id'], $text . '--');
            }
        }

        return $this->htmlSlelect;
    }
}
