<?php

namespace App\Http\Controllers\Blockchain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\{Auth, Validator,  DB};


class BlockchainController extends Controller
{
    private $rpcUrl;
    private $privateKey;
    private $client;
    public function __construct()
    {
        parent::__construct();
        $this->rpcUrl = env('ETHEREUM_RPC_URL');
        $this->privateKey = env('ETHEREUM_PRIVATE_KEY');
        $this->client = new Client(['base_uri' => $this->rpcUrl]);
    }

    public function issueCertData(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $student_id = isset($req->student_id) ? base64_decode($req->input('student_id')) : 0;

            $tnResp = isset($req->tnResp) ? $req->input('tnResp') : false;
            $totalGas = isset($tnResp['cumulativeGasUsed']) && $tnResp != false ? $tnResp['cumulativeGasUsed'] : Null;
            $from = isset($tnResp['from']) && $tnResp != false ? $tnResp['from'] : Null;
            $smartContract = isset($tnResp['to']) && $tnResp != false ? $tnResp['to'] : Null;
            $tokenId = $tnResp != false ?  $tnResp['events']['Transfer']['returnValues']['tokenId'] : null;
            $transactionHash = isset($tnResp['transactionHash']) && $tnResp != false ? $tnResp['transactionHash'] : Null;
            $validate_rules = [
                'student_id' => 'required|string|min:3',
                'tnResp' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);

            $exists = is_exists($this->CertificateIssue, ['student_course_master_id' => $student_id]);


            // return $student_id;
            if (!$validate->fails() && $exists > 0) {
                try {
                    $data = [
                        'deployed_on_blockchain' => $this->time,
                        'chain_response' => json_encode($tnResp),
                        'init_owner' => $from,
                        'smartContract' => $smartContract,
                        'tokenId' => $tokenId,
                        'transactionHash' => $transactionHash,
                        'totalGasUsed' => $totalGas,
                    ];
                    $where = ['student_course_master_id' => $student_id];
                    $status = saveData($this->CertificateIssue, $data, $where);

                    if (isset($status) && $status['status'] === true) {
                        return json_encode(['code' => 200, 'title' => "Successfully Deploy On Blockchain", 'message' => "Transation Hash: " . $transactionHash, "icon" => "success"]);
                    }
                } catch (\Throwable $th) {
                    // return $th;
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                }
            }
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
    }

    public function transferNft(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $student_id = isset($req->student_id) ? base64_decode($req->input('student_id')) : 0;
            $student_address = isset($req->student_address) ? $req->input('student_address') : 0;
            $transfertnHash = isset($req->transfertnHash) ? $req->input('transfertnHash') : Null;
            

            $validate_rules = [
                'student_id' => 'required|string|min:3',
                'student_address' => 'required|string|min:3',
                'transfertnHash' => 'required|string|min:3'
            ];

            // return $student_address;
            $validate = Validator::make($req->all(), $validate_rules);

            // return $req->all();
            $exists = is_exists($this->CertificateIssue, ['student_course_master_id' => $student_id, 'transferred_on' => null]);
            if (!$validate->fails() && $exists > 0) {


                // return $this->time;
                try {
                    $data = [
                        'transferred_on' => $this->time,
                        'trasferTo' => $student_address,
                        'transfer_tn_hash' => $transfertnHash,
                    ];
                    $where = ['student_course_master_id' => $student_id];
                    $status = saveData($this->CertificateIssue, $data, $where);

                    if (isset($status) && $status['status'] === true) {
                        return json_encode(['code' => 200, 'title' => "Successfully Transferred", 'message' => "Transfer to: " . $student_address, "icon" => "success"]);
                    }
                } catch (\Throwable $th) {
                    // return $th;
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Transferred", 'message' => 'Ownership has been changed', "icon" => "error"]);
            }
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }
}