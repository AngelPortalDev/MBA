<?php

namespace App\Http\Controllers\Admin\SectionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator, Storage, DB};

class JournalArticleAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function updateJournalArticle(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $journal_title = isset($req->journal_title) ? $req->input('journal_title') : '';
            $docsFile = $req->hasFile('docsFile') ? $req->file('docsFile') : '';
            $exist_url = isset($req->exist_url) ? base64_decode($req->input('exist_url')) : '';
            $section_id = isset($req->section_id) ? base64_decode($req->input('section_id')) : '';

            if (Storage::exists($exist_url) && $docsFile === '') {
                $validate_rules = [
                    'journal_title' => 'required|string|max:255|min:3',
                ];
                $custom_messages = [
                    'journal_title.min' => 'The document title must be at least :min characters.',
                    'journal_title.max' => 'The document title may not be greater than :max characters.',
                ];
            } else {
                $validate_rules = [
                    'docsFile' => 'required|mimes:pdf,xls,xlsx|max:5120',
                    'journal_title' => 'required|string|max:255|min:3',
                ];
                $custom_messages = [
                    'docsFile.required' => 'Please upload a PDF document.',
                    'docsFile.max' => 'The docs file must not be greater than 5MB.',
                    'journal_title.min' => 'The document title must be between 3 to 255 characters.',
                    'journal_title.max' => 'The document title must be between 3 to 255 characters.',
                ];
            }
        
            $validate = Validator::make($req->all(), $validate_rules,$custom_messages);
            $exists = is_exist('course_section_masters', ['id' => $section_id, 'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists > 0) {

                $where = [];
                if (empty($req->article_id)) {

                    $exists = is_exist('course_content_docs', ['docs_title' => $journal_title,'section_id'=> $section_id,'is_deleted' => 'No']);
                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        return json_encode(['code' => 201, 'title' => "Journal article already exist.", 'message' => 'Please Select Correct Article', "icon" => generateIconPath("error")]);
                    }

                }
                if (isset($req->article_id) && !empty($req->article_id)) {
                    $article_id = isset($req->article_id) ? base64_decode($req->input('article_id')) : '';
                    $exists = is_exist('course_content_docs', ['id' => $article_id, 'is_deleted' => 'No']);

                    $getArticleData = getData('course_content_docs', ['docs_title'],['id' => base64_decode($req->input('article_id'))]);
                    $docs_title_check = $getArticleData[0]->docs_title;
                    if($journal_title != $docs_title_check){
                        $exists = is_exist('course_content_docs', ['docs_title' => $journal_title,'section_id'=> $section_id,'is_deleted' => 'No']);
                        if (isset($exists) && is_numeric($exists) && $exists > 0) {
                            return json_encode(['code' => 201, 'title' => "Journal article already exist.", 'message' => 'Please Select Correct Article', "icon" => generateIconPath("error")]);
                        }else{
                            $where = ['id' => $article_id];
                        }
                    }
                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        $where = ['id' => $article_id];
                    }
                }
                

                if (!$validate->fails()) {
                    $select = [
                        'section_id' => $section_id,
                        'docs_title' =>  $journal_title,
                        'last_updated_by' => $admin_id,
                        'created_at' =>  $this->time,
                    ];
                    if ($req->hasFile('docsFile')) {
                        $doc_file_name = $docsFile->getClientOriginalName();
                        $docsFile =  UploadFiles($docsFile, 'course/JournalArticles', $exist_url);
                        if ($docsFile === FALSE) {
                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                        }
    
                        if (isset($docsFile['url']) && !empty($docsFile['url'])) {
                            $select = array_merge($select, [
                                'file' => !empty($docsFile['url']) ? $docsFile['url'] : 'No File',
                                'doc_file_name'=> $doc_file_name
                            ]);
                        } else {
                            return json_encode(['code' => 404, 'title' => "Unable to Upload PDF", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    }
                    $updateArticles = false;
                    if (isset($docsFile['url']) && Storage::disk('local')->exists($docsFile['url']) || Storage::exists($exist_url)) {
                        $updateArticles = processData(['course_content_docs', 'id'], $select, $where);
                    }


                    // Article Assgin in Section management Table Processing
                    if (isset($updateArticles) && $updateArticles['status'] === true) {
                        $cols = [
                            'content_id' => $updateArticles['id'],
                            'content_type_id' => 2,
                            'is_deleted' => 'No'
                        ];
                        $existsContent = is_exist('section_managment_master', $cols);
                        if (isset($existsContent) && is_numeric($existsContent) && $existsContent === 0) {
                            $update = array_merge(
                                $cols,
                                [
                                    'section_id' => $section_id,
                                    'placement_id' => 0,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time
                                ]
                            );
                            $palcmentUpdate =  processData(['section_managment_master', 'id'], $update);
                            if (isset($palcmentUpdate) && $palcmentUpdate === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        } else {
                            $update =
                                [
                                    'section_id' => $section_id,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time
                                ];
                            $palcmentUpdate =  processData(['section_managment_master', 'id'], $update, $cols);
                            if (isset($palcmentUpdate) && $palcmentUpdate === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        }
                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Uploaded', "message" => "Document details uploaded successfully", "icon" => generateIconPath("success"), "data" => base64_encode($section_id)]);
                } else {
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Section Not Exist", 'message' => 'Please select correct section', "icon" => generateIconPath("warning")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function articleList($cat = '', $action = '')
    {
        if (Auth::check()) {
            $sectionData = [];
            $where = ['is_deleted' => 'No'];
            $id = '';

            if (isset($cat) && !empty($cat) && $cat === 'Yes' || $cat === 'No') {
                $where = array_merge($where, ['is_active' => $cat]);
            } elseif (isset($cat) && !empty($cat) && $cat === 'deleted') {
                $where = ['is_deleted' => 'Yes'];
            } elseif (isset($cat) && !empty($cat) && is_numeric(base64_decode($cat))) {
                $id = base64_decode($cat);
                $where = ['id' => $id, 'is_deleted' => 'No'];
            } elseif (isset($cat) && !empty($cat) && $cat === 'undefined') {
                $where = ['is_deleted' => 'No'];
            }
            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                $exist = is_exist('course_section_masters', $where);
                if ($exist === 0) {
                    return redirect()->back()->with('msg', 'Section not Exist');
                }
                $exist = is_exist('course_content_docs', $where);
                if ($exist === 0) {
                    return redirect()->back()->with('msg', 'Section not Exist');
                }
            }

            $select = ['docs_title', 'file'];
            $articleData = $this->articleDocs->getArticleDetails($where, $select);
            if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
                return view('admin/course/add-journal-articles', compact('articleData'));
            }
            return response()->json($articleData);
        }
        return redirect('/login');
    }
    public function articleListedit($cat = '', $action = '')
    {
        $where = ['is_deleted' => 'No', 'id' => base64_decode($cat)];
        $select = ['docs_title', 'file'];
        $articleData = $this->articleDocs->getArticleDetails($where, $select);
        if (isset($action) && !empty($action) && base64_decode($action) === 'edit') {
            return view('admin/course/add-journal-articles', compact('articleData'));
        }
    }
}