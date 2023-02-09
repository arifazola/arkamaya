<?php
namespace App\Models;

use CodeIgniter\Model;
use Hermawan\DataTables\DataTable;

class DashboardModel extends Model{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getData(string $projectName = null, string $clientID = null, string $status = null){
        $builder = $this->db->table("tb_m_project");
        $builder->select("tb_m_project.project_id, tb_m_project.project_name, tb_m_client.client_name, 
        tb_m_project.project_start, tb_m_project.project_end, tb_m_project.project_status");

        $builder->join('tb_m_client', 'tb_m_project.client_id = tb_m_client.client_id', 'INNER');

        if($projectName != null){
            $builder->like('tb_m_project.project_name', $projectName);
        }

        if($clientID != null){
            $builder->where("tb_m_project.client_id", $clientID);
        }

        if($status != null){
            $builder->where("tb_m_project.project_status", $status);
        }
        return $this->toJson($builder);
    }

    public function getClients(){
        $builder = $this->db->table("tb_m_client");
        $builder->select('client_id, client_name');
        return $builder->get()->getResultArray();
    }

    public function toJson($builder){
        return DataTable::of($builder)
        ->edit('project_id', function($row){
                        return '<div class="form-group">
            <div class="form-check">
              <input class="form-check-input check-content" type="checkbox" id="'.$row->project_id.'">
            </div>
        </div>';
        })
        ->add('action', function($row){
            return '<a href="#" id="'.$row->project_id .'" class="btn-edit" data-toggle="modal" data-target="#editData">Edit</a>';
        }, 'last')
        ->format('project_start', function($value){
            $date = date_create($value);
            return date_format($date, 'd M y');
        })
        ->format('project_end', function($value){
            $date = date_create($value);
            return date_format($date, 'd M y');
        })
        ->toJson(true);
    }

    /**
     * @param $projectName string
     * @param $client string
     * @param $projectSart string
     * @param $projectEnd string
     * @param $status string
     */
    public function addData($projectName, $client, $projectStart, $projectEnd, $status){
        $builder = $this->db->table("tb_m_project");
        $data = [
            "project_name" => $projectName,
            "client_id" => $client, 
            "project_start" => $projectStart,
            "project_end" => $projectEnd,
            "project_status" => $status
        ];

        return $builder->insert($data);
    }

    /**
     * @param $projectIDs array: list of id
     */
    public function deleteData(array $projectIDs){
        $builder = $this->db->table("tb_m_project");
        $builder->whereIn("project_id", $projectIDs);
        return $builder->delete();
    }

    /**
     * @param $id string
     */
    public function getSingleProject($id){
        $builder = $this->db->table("tb_m_project");
        $builder->select("project_name, client_id, project_status");
        $builder->where("project_id", $id);
        return $builder->get()->getFirstRow('array');
    }

    /**
     * @param $projectID string
     * @param $projectName string
     * @param $client string
     * @param $projectSart string
     * @param $projectEnd string
     * @param $status string
     */
    public function editProject($projectID, $projectName, $clientID, $projectStatus){
        $builder = $this->db->table("tb_m_project");
        $data = [
            "project_name" => $projectName,
            "client_id" => $clientID,
            "project_status" => $projectStatus
        ];
        $builder->where("project_id", $projectID);
        return $builder->update($data);
    }
}
?>