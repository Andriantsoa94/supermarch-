<?php
namespace App\Controllers;

use App\Models\CongeModel;
use CodeIgniter\RESTful\ResourceController;

class CongeController extends ResourceController {
    public function congeAPI() {
        $session = session();
        $employeId = $session->get('id');

        $congeModel = new CongeModel();
        
        $dataConge = $congeModel->getCongesByEmploye($employeId);

        foreach ($dataConge as $d) :
        $data[] = [
            [
                'id' => $d['id'],
                'title' => $d['type_conge'],
                'start' => $d['date_debut'],
                'end' => $d['date_fin'],
                'allDay' => true
            ]
        ];
        endforeach;

        return $this->respond($data);
    }
}
?>