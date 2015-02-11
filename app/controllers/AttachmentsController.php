<?php

class AttachmentsController extends BaseController {

    protected $attachment;


    public function index()
    {
        dd('kkk');

    }

    public function getIndex()
    {
        dd('hard');
    }

    public function create()
    {

    }

    public function store()
    {
       
        return \Response::json('kkk');
    }

    public function edit($id)
    {

    }

    //update info for attachment edit
    public function update($id)
    {

    }

    //show modal view
    public function show($id)
    {
        $attachment = $this->attachment->find($id);
        return \View::make('company.attachments.show', compact('attachment'));
    }

    //download one attachment
    public function download($id)
    {

    }

    //Move one attachment to category
    public function category()
    {

    }

    //delete attachment
    public function destroy($id)
    {

    }

    //search attachment by option
    public function searchAttachment(){

    }

    //create category
    public function createCategory(){

    }


    // Download multi attachments, delete multi attachments
    public function optionFile(){

    }

    //create file zip attachment for download many
    private function zipFilesAndDownload($file_path,$archive_file_name)
    {
       
    }

    //move multi attachments
    public function move_to_category(){

    }

    //change view attachments
    public function changeView(){

    }

    public function searchAttachmentInPost() {

    }

} 