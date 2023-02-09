<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\DashboardModel;
use CodeIgniter\CodeIgniter;

class Dashboard extends BaseController{

    protected $model;

    public function __construct()
    {
        $this->model = new DashboardModel();
    }

    public function index(){
        $clients = $this->model->getClients();
        $data = [
            "clients" => $clients
        ];
        return view('dashboard_view', $data);
    }

    public function getData(){
        if($this->request->isAJAX()){
            $projectName = $this->request->getVar("project_name");
            $client = $this->request->getVar("client");
            $status = $this->request->getVar("status");
            return $this->model->getData($projectName, $client, $status);
        }
    }

    public function addData(){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();
            $runValidation = $this->validation($validation);

            if(!$runValidation){
                return json_encode($validation->getErrors());
            }

            $projectName = $this->request->getVar("project_name");
            $client = $this->request->getVar("client");
            $status = $this->request->getVar("status");
            $timeNow = date("Y-m-d", time());
            $nextMonth = date("Y-m-d", strtotime("+1 month", time()));

            $addData = $this->model->addData($projectName, $client, $timeNow, $nextMonth, $status);

            return json_encode($addData);
        }
    }

    public function deleteData(){
        if($this->request->isAJAX()){
            $projectIDs = $this->request->getVar("projects");
            $deleteData = $this->model->deleteData($projectIDs);
            return json_encode($deleteData);
        }
    }

    public function getSingleProject(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar("project_id");
            return json_encode($this->model->getSingleProject($id));
        }
    }

    public function editData(){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();
            $runValidation = $this->validation($validation);
            if(!$runValidation){
                return json_encode($validation->getErrors());
            }

            $raw = $this->request->getRawInput();
            $projectID = $raw["project_id"];
            $projectName = $raw["project_name"];
            $client = $raw["client"];
            $status = $raw["status"];

            $edit = $this->model->editProject($projectID, $projectName, $client, $status);

            return json_encode($edit);
        }
    }

    /**
     * @param $validation \CodeIgniter\Validation\ValidationInterface
     */
    private function validation(\CodeIgniter\Validation\ValidationInterface $validation){
            $validation->setRules(
                [
                    "project_name" => "required|alpha_numeric_space",
                    "client" => "required|validateSelectValue",
                    "status" => "required|in_list[OPEN, DOING, DONE]"
                ],
                [
                    "project_name" => [
                        "required" => "Project name cannot be empty",
                        "alpha_numeric_space" => "Project name can only contain alpha numeric space characters"
                    ],
                    "client" => [
                        "required" => "Client cannot be empty",
                        "validateSelectValue" => "Client is not valid"
                    ],
                    "status" => [
                        "required" => "Status cannot be empty",
                        "in_list" => "Status is not valid"
                    ]
                ]
            );

            $runValidation = $validation->withRequest($this->request)->run();
            return $runValidation;
    }
}
?>