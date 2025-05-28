<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\Utils;
use Guzzle\Http\Exception\ClientErrorResponseException;
class certificateModel extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'certificate';
    protected $guarded = [];
    protected $headers;

    public function __construct()
    {
        parent::__construct();
        $this->headers_pinata = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. env('PINATA_AUTH_KEY')
        ];

    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->deleted_by = Auth::user()->id;
            $model->save();
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getCertData($certid = '')
    {
        if (Auth::check()) {
            $query = $this->select('id', 'certificate_name', 'certificate_file', 'category_id')->with('category');
            if (isset($certid) && $certid != '' && is_exists($this, ['id' => base64_decode($certid)]) > 0) {
                $query->where('id', base64_decode($certid))->first();
            }
            return $query->get();
        }
    }
    public function setIPFSGroup($course_name){
        
        if (isset($course_name) && !empty($course_name) && Auth::check()) {

            try {   
                $client = new Client();
                $headers = [
                  'Content-Type' => 'application/json',
                  'Authorization' => 'Bearer '.env('PINATA_AUTH_KEY')
                ];
                $body = json_encode([
                    'name' => $course_name
                ]);
                $request = new Request('POST', 'https://api.pinata.cloud/groups', $headers, $body);
                $res = $client->sendAsync($request)->wait();
                if ($res->getStatusCode() === 200) {
                    $data = $res->getBody();
                    $response = json_decode($data, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return [
                            'code' => $res->getStatusCode(),
                            'data' => $response,
                        ];
                    } else {
                        return [
                            'code' => 500,
                            'message' => 'Invalid JSON response received.'
                        ];
                    }
                } else {
                    return [
                        'code' => $res->getStatusCode(),
                        'message' => 'Failed to create group.'
                    ];
                }
            } catch (\Throwable $th) {
                return $th;

            }
        }
    }

    public function setPinFiletoIPFS($file,$group_id)
    {
        if (isset($file) && !empty($file) && Auth::check()) {

            try {   
                $client = new Client();
                $headers = [
                    // 'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.env('PINATA_AUTH_KEY')
                ];

                $multipartData = [
                    [
                        'name'     => 'file', // This should match the expected field name for the file upload
                        'contents' => fopen($file, 'r'),
                        'filename' => basename($file), // Optional, use filename if needed
                    ],
                    [
                        'name'     => 'pinataOptions', // Optional field for additional data
                        'contents' => json_encode([
                            'groupId' => $group_id // Ensure $group_id is properly set
                        ])
                    ]
                ];
                

                $request = new Request('POST', 'https://api.pinata.cloud/pinning/pinFileToIPFS', $headers);
                $res = $client->sendAsync($request, ['multipart' => $multipartData])->wait();
                if ($res->getStatusCode() === 200) {
                    $data = $res->getBody();
                    $response = json_decode($data, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return [
                            'code' => $res->getStatusCode(),
                            'data' => $response,
                        ];
                    } else {
                        return [
                            'code' => 500,
                            'message' => 'Invalid JSON response received.'
                        ];
                    }
                } else {
                    return [
                        'code' => $res->getStatusCode(),
                        'message' => 'Failed to upload image.'
                    ];
                }
            } catch (\Throwable $th) {
                return $th;

            }
        }
        return FALSE;
    }

    public function updateFileMetaData($ipfs_hash,$ipfs_certificate_name,$metadata)
    {
        if (isset($ipfs_hash) && !empty($ipfs_hash) && Auth::check()) {

            try {   
                $client = new Client();
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.env('PINATA_AUTH_KEY')
                ];

                $metadata = json_decode($metadata);

                $body = [
                    "ipfsPinHash" => $ipfs_hash,
                    "name" => $ipfs_certificate_name,
                    "keyvalues" => [
                        "name" => $metadata->name,
                        "course_name" => $metadata->course_name,
                        "file_hash" => $ipfs_hash,
                        "issue_date" => $metadata->issue_date,
                        "course_duration"=> $metadata->course_duration,
                        "certificate_no" => $metadata->certificate_no,
                        "college_name" => $metadata->college_name,
                        'image'=> env("PINATA_IPFS_PATH").$ipfs_hash
                    ]
                ];
                $body = json_encode($body);
                $request = new Request('PUT', 'https://api.pinata.cloud/pinning/hashMetadata', $headers, $body);                
                $res = $client->sendAsync($request)->wait();
              
                if ($res->getStatusCode() === 200) {
                    $data = $res->getBody();
                    $response = json_decode($data, true);
                    return [
                        'code' => $res->getStatusCode(),
                        'data' => 'true',
                    ];
                   
                } else {
                    return [
                        'code' => $res->getStatusCode(),
                        'message' => 'Failed to upload metadata.'
                    ];
                }
            } catch (\Throwable $th) {
                return $th;

            }
        }
        return FALSE;
    }

}