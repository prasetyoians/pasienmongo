<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database; 
use App\Models\PasienModel; 
use MongoDB\Client;
use CodeIgniter\HTTP\ResponseInterface;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;


class PasienController extends Controller
{
    private $db;
    private $collection;


     public function __construct()
    {
        $this->pasienModel = new pasienModel(); 
         helper(['form']); 

        $this->db = (new Client("mongodb://localhost:27017"))->pasien;
        $this->collection = $this->db->pasien; 

        $this->pasienCollection = $this->db->pasien;
        $this->statusCollection = $this->db->status;

    }


    public function index()
    {
        $statusData = $this->statusCollection->find()->toArray();

            return view('Pasien/index', [
              'statusList' => $statusData
             ]);
    }


public function table_pasien()
{
    $request = \Config\Services::request();

    $searchValue = $request->getVar('search')['value'] ?? '';
    $start = (int)($request->getVar('start') ?? 0);
    $length = (int)($request->getVar('length') ?? 10);
    $status = $request->getVar('id_status');

    $filter = [];

    $filter = ['deleted_at' => null]; // Hanya data yang belum dihapus

    if ($status && $status !== "all") {
        try {
        $filter['id_status'] = new \MongoDB\BSON\ObjectId($status);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'draw' => intval($request->getVar('draw')),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ]);
        }
    }

    if (!empty($searchValue)) {
        $filter['$or'] = [
            ['nama' => ['$regex' => $searchValue, '$options' => 'i']],
            ['nik' => ['$regex' => $searchValue, '$options' => 'i']],
            ['alamat' => ['$regex' => $searchValue, '$options' => 'i']],
            ['telepon' => ['$regex' => $searchValue, '$options' => 'i']]
        ];
    }

    $pipeline = [
        ['$match' => (object) $filter],
        [
            '$lookup' => [
                'from' => 'status', 
                'localField' => 'id_status', 
                'foreignField' => '_id',
                'as' => 'status_info' 
            ]
        ],
        ['$unwind' => ['path' => '$status_info', 'preserveNullAndEmptyArrays' => true]],
        ['$skip' => $start],
        ['$limit' => $length]
    ];

    $pasienData = $this->collection->aggregate($pipeline)->toArray();
    $totalData = $this->collection->countDocuments([]);
    $totalFiltered = $this->collection->countDocuments($filter);

    $data = [];
    $no = $start + 1;
    foreach ($pasienData as $item) {
        $nama_status = isset($item['status_info']['nama_status']) ? $item['status_info']['nama_status'] : "Tidak Diketahui";

       if($nama_status == "RAWAT INAP") {
          
        $stat =   "<span class='badge bg-primary text-white'>Rawat Inap</span>" ;
       }else{

        $stat=    "<span class='badge bg-danger text-white'>Rawat Jalan</span>";
       }

        $data[] = [
            'no' => $no++,
            'id_pasien' => (string) $item['_id'],
            'nama' => $item['nama'],
            'nik' => $item['nik'],
            'alamat' => $item['alamat'],
            'telepon' => $item['telepon'],
            'status' => $stat,
            'riwayat' =>'<center><button class="btn btn-primary edit" onclick="riwayat_pasien(\'' . $item["_id"] . '\')"><i class="fa fa-info-circle"></i></button></center>' ,
            'aksi' => '<button class="btn btn-warning edit" onclick="edit_pasien(\'' . $item["_id"] . '\')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-danger delete" onclick="delete_pasien(\'' . $item["_id"] . '\')"><i class="fa fa-trash-alt"></i></button>',
        ];
    }

    return $this->response->setJSON([
        'draw' => intval($request->getVar('draw')),
        'recordsTotal' => $totalData,
        'recordsFiltered' => $totalFiltered,
        'data' => $data,
    ]);
}



public function save_pasien()
{
    $request = \Config\Services::request();

    $nama = $request->getPost('nama');
    $nik = $request->getPost('nik');
    $alamat = $request->getPost('alamat');
    $telepon = $request->getPost('telepon');
    $id_status = $request->getPost('id_status'); 
    $id_pasien = $request->getPost('id_pasien'); 
    $tipe = $request->getPost('tipe'); 

    // Validasi data
    $rules = [
        'nama' => 'required|min_length[1]',
        'nik' => 'required|min_length[1]',
        'telepon' => 'required|min_length[1]',
        'alamat' => 'required|min_length[1]',
        'id_status' => 'required|min_length[1]',
    ];

    if (!$this->validate($rules)) {
        $errors = $this->validator->getErrors();
        return $this->response->setJSON([
            'validate' => 0,
            'message' => 'Ada input yang belum terisi',
            'csrf_token' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }

    $id_status = new \MongoDB\BSON\ObjectId($id_status);



    if ($tipe == "0") { 
        $data = [
        'nama' => $nama,
        'nik' => $nik,
        'alamat' => $alamat,
        'telepon' => $telepon,
        'id_status' => $id_status,
        'tipe'=>"satu",
        'created_at'=>new UTCDateTime(time() * 1000),
        'updated_at'=>null,
        'deleted_at'=>null,
    ];

        $existingPasien = $this->pasienCollection->findOne(['nik' => $nik]);

        if (!$existingPasien) {
            $insertResult = $this->pasienCollection->insertOne($data);

            if ($insertResult->getInsertedCount() > 0) {
                return $this->response->setJSON([
                    'ceknik' => '1',
                    'validate' => 1,
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'csrf_token' => csrf_token(),
                    'csrf_hash' => csrf_hash(),
                ]);
            } else {
                return $this->response->setJSON([
                    'ceknik' => '1',
                    'validate' => 1,
                    'success' => false,
                    'message' => 'Gagal menyimpan data',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'ceknik' => '0',
                'validate' => 1,
                'success' => true,
                'message' => 'NIK sudah ada di database',
                'csrf_token' => csrf_token(),
                'csrf_hash' => csrf_hash(),
                'nik' => $nik,
            ]);
        }
    } else { 

         $data = [
        'nama' => $nama,
        'nik' => $nik,
        'alamat' => $alamat,
        'telepon' => $telepon,
        'id_status' => $id_status,
        'tipe'=>"satu",
        'updated_at'=>new UTCDateTime(time() * 1000),
        
    ];


        $id_pasien =  new \MongoDB\BSON\ObjectId($id_pasien);

        $existingPasien = $this->pasienCollection->findOne([
            'nik' => $nik,
            '_id' => ['$ne' => $id_pasien] 
        ]);

        if (!$existingPasien) {
            $updateResult = $this->pasienCollection->updateOne(
                ['_id' => $id_pasien],
                ['$set' => $data]
            );

            if ($updateResult->getModifiedCount() > 0) {
                return $this->response->setJSON([
                    'ceknik' => '1',
                    'validate' => 1,
                    'success' => true,
                    'message' => 'Data berhasil diperbarui',
                    'csrf_token' => csrf_token(),
                    'csrf_hash' => csrf_hash(),
                ]);
            } else {
                return $this->response->setJSON([
                    'ceknik' => '1',
                    'validate' => 1,
                    'success' => false,
                    'message' => 'Gagal memperbarui data',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'ceknik' => '0',
                'validate' => 1,
                'success' => true,
                'message' => 'NIK sudah ada di database',
                'csrf_token' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }
    }
}


public function get_pasien_id($id)
{
    try {
        // Cek apakah ID valid untuk ObjectId
        if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
            throw new \Exception("Invalid ObjectId format");
        }

        $objectId = new \MongoDB\BSON\ObjectId($id);

        $pasien = $this->pasienCollection->findOne(['_id' => $objectId]);

        if ($pasien) {
            $pasien['_id'] = (string) $pasien['_id'];
            $pasien['id_status'] = (string) $pasien['id_status']; 

            return $this->response->setJSON([
                'success' => true,
                'data' => $pasien
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'ID tidak valid: ' . $e->getMessage()
        ]);
    }
}

public function delete_pasien($id)
{
    try {
       
        if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
            throw new \Exception("Invalid ObjectId format");
        }

        $objectId = new \MongoDB\BSON\ObjectId($id);


        $deleteResult = $this->pasienCollection->updateOne(
            ['_id' => $objectId],
            ['$set' => ['deleted_at' => new UTCDateTime(time() * 1000)]]
        );

        if ($deleteResult->getModifiedCount() > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil dihapus',
                'csrf_token' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan atau gagal dihapus'
            ]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'ID tidak valid: ' . $e->getMessage()
        ]);
    }
}


public function restore_pasien($id)
{
    try {
       
        if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
            throw new \Exception("Invalid ObjectId format");
        }

        $objectId = new \MongoDB\BSON\ObjectId($id);


        $restoreResult = $this->pasienCollection->updateOne(
            ['_id' => $objectId],
            ['$set' => ['deleted_at' => null]]
        );

        if ($restoreResult->getModifiedCount() > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil di restore',
                'csrf_token' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan atau gagal di restore'
            ]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'ID tidak valid: ' . $e->getMessage()
        ]);
    }
}





public function table_restore()
{
    $request = \Config\Services::request();

    $searchValue = $request->getVar('search')['value'] ?? '';
    $start = (int)($request->getVar('start') ?? 0);
    $length = (int)($request->getVar('length') ?? 10);
    $status = $request->getVar('id_status');

    $filter = [];

    $filter = ['deleted_at' => ['$ne' => null]]; // Hanya data yang belum dihapus

 

    if (!empty($searchValue)) {
        $filter['$or'] = [
            ['nama' => ['$regex' => $searchValue, '$options' => 'i']],
            ['nik' => ['$regex' => $searchValue, '$options' => 'i']],
            ['alamat' => ['$regex' => $searchValue, '$options' => 'i']],
            ['telepon' => ['$regex' => $searchValue, '$options' => 'i']]
        ];
    }

    $pipeline = [
        ['$match' => (object) $filter],
        [
            '$lookup' => [
                'from' => 'status', 
                'localField' => 'id_status', 
                'foreignField' => '_id',
                'as' => 'status_info' 
            ]
        ],
        ['$unwind' => ['path' => '$status_info', 'preserveNullAndEmptyArrays' => true]],
        ['$skip' => $start],
        ['$limit' => $length]
    ];

    $pasienData = $this->collection->aggregate($pipeline)->toArray();
    $totalData = $this->collection->countDocuments([]);
    $totalFiltered = $this->collection->countDocuments($filter);

    $data = [];
    $no = $start + 1;
    foreach ($pasienData as $item) {
        $nama_status = isset($item['status_info']['nama_status']) ? $item['status_info']['nama_status'] : "Tidak Diketahui";

       if($nama_status == "RAWAT INAP") {
          
        $stat =   "<span class='badge bg-primary text-white'>Rawat Inap</span>" ;
       }else{

        $stat=    "<span class='badge bg-danger text-white'>Rawat Jalan</span>";
       }

        $data[] = [
            'no' => $no++,
            'id_pasien' => (string) $item['_id'],
            'nama' => $item['nama'],
            'nik' => $item['nik'],
            'alamat' => $item['alamat'],
            'telepon' => $item['telepon'],
            'status' => $stat,
            'aksi' => '<button class="btn btn-primary" onclick="restore_pasien(\'' . $item["_id"] . '\')"><i class="fa fa-recycle"></i></button>',
        ];
    }

    return $this->response->setJSON([
        'draw' => intval($request->getVar('draw')),
        'recordsTotal' => $totalData,
        'recordsFiltered' => $totalFiltered,
        'data' => $data,
    ]);
}



    public function table_riwayat_pasien()
    {

        $db = Database::connect(); // Koneksi ke database
        $request = \Config\Services::request();

        // Input dari DataTables
    $searchValue = $request->getVar('search')['value'] ?? ''; // Jika search value null, gunakan string kosong
    $start = $request->getVar('start') ?? 0; // Jika start null, gunakan default 0
    $length = $request->getVar('length') ?? 10; // Jika length null, gunakan default 10

 $id_pasien = $request->getVar('id_pasien');

      
            $where = " and a.id_pasien='".$id_pasien."' ";


        // Query total data tanpa filter
        $totalDataQuery = $db->query("SELECT COUNT(*) AS total FROM tb_riwayat_pasien as a WHERE 1=1 ".$where);
        $totalData = $totalDataQuery->getRow()->total;

        // Query data dengan pencarian
        $sql = "SELECT a.* FROM tb_riwayat_pasien as a WHERE 1=1 ".$where; // Kondisi default (1=1 selalu benar)
        
        if (!empty($searchValue)) {
            $sql .= " AND (a.diagnosa LIKE '%".$db->escapeLikeString($searchValue)."%' 
                        OR a.penyakit LIKE '%".$db->escapeLikeString($searchValue)."%'
                      

                        )

                        ";
        }

        // Tambahkan limit dan offset untuk pagination
        $sql .= " LIMIT $start, $length";

        // Eksekusi query untuk data
        $query = $db->query($sql);
        $pasienData = $query->getResultArray();

        // Query total data setelah filter
        $totalFilteredQuery = $db->query("SELECT COUNT(*) AS total FROM tb_riwayat_pasien as a  WHERE 1=1".$where);
        if (!empty($searchValue)) {
            $totalFilteredQuery = $db->query("SELECT COUNT(*) AS total FROM tb_riwayat_pasien as a  WHERE a.diagnosa LIKE '%".$db->escapeLikeString($searchValue)."%' OR a.penyakit LIKE '%".$db->escapeLikeString($searchValue)."%'  ".$where);
        }
        $totalFiltered = $totalFilteredQuery->getRow()->total;

        // Siapkan array data untuk dikirim ke DataTables
        $data = [];
        $no = 1;
        foreach ($pasienData as $item) {

          
            $data[] = [
                'no'    => $no++,
              
                'penyakit'      => $item['penyakit'],
                'diagnosa'     => $item['diagnosa'],
            
            ];
        }

        // Mengirim response JSON ke DataTables
        $response = [
            'draw' => intval($request->getVar('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

}
