<?php
namespace App\Libraries;

use App\Models\DashboardModel;

class SelectValidationRules{

    public function validateSelectValue(String $string): bool {
        $model = new DashboardModel();
        $availableValue = $model->getClients();
        $availableValueInArray = array();

        foreach($availableValue as $data){
            array_push($availableValueInArray, $data['client_id']);
        }

        return in_array($string, $availableValueInArray);
    }
}
?>