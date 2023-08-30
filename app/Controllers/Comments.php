<?php
/*
 * Project-name: devqualimp
 * File-name: Comments.php
 * Author: WU
 * Start-Date: 2023/8/22 10:58
 */

namespace App\Controllers;

use App\Models\ClientAdresseModel;
use App\Models\CustomerModel;
use App\Models\LedgerModel;
// PDF
use Dompdf\Dompdf;
// Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Comments extends BaseController
{
    public function index()
    {
        $session = session();
        $client_id = $session->get('client_id');

        $client = model(CustomerModel::class);
        $api_keys = $client->select('api_key')->where(['id' => $client_id])->first();
        helper('form');
        $cliadr = model(ClientAdresseModel::class);
        $adrs = $cliadr->getAdrInfo($client_id);
        $data['adrs'] = $adrs;
        $data['client'] = $client_id;
        return view('templates/header',$data)
            . view('comments/comment_add')
            . view('templates/footer');
    }

    public function add_ledger()
    {
        helper('form');
        $post = $this->request->getPost(['client','sel_factory','mold_name','asset_number','purchase_date','mold_quantity','ask_note', 'schedule_note' ,'result_note','reception_date','dispatch_date']);

//        echo '<pre>';print_r($post);echo '</pre>';die;

        if (! $this->validateData($post, [
            'client'  => 'required',
            'sel_factory'  => 'required',
            'mold_name'  => 'required',
            'asset_number'   => 'required',
            'purchase_date'     => 'required',
            'mold_quantity'   => 'required',
            'ask_note'  => 'required',
            'schedule_note'  => 'required',
            'result_note'  => 'required',
            'reception_date'  => 'required',
            'dispatch_date'  => 'required',
        ])){
            return view('templates/header',['errors' => $this->validator->getErrors()])
                . view('comments/comment_add')
                . view('templates/footer');
        }

        $insert_data = [
            'client'    => $post['client'],
            'factory'   => $post['sel_factory'],
            'name'  => $post['mold_name'],
            'assetnum'  => $post['asset_number'],
            'datebought'    => $post['purchase_date'],
            'quantite'  => $post['mold_quantity'],
            'daterepair'    => $post['reception_date'],
            'datereception' => $post['reception_date'],
            'datedispatch'  => $post['dispatch_date'],
            'questions' => $post['ask_note'],
            'schedule'  => $post['schedule_note'],
            'final' => $post['result_note'],
            'datecreation' => date('Y-m-d H:i:s')
        ];

        $ledger = model(LedgerModel::class);
        $ledger_id = $ledger->insert($insert_data);
//        echo '<pre>';
//        print_r($ledger_id);
//        echo '</pre>';die;
        if ($ledger_id){
            $session = session();
            $client_id = $session->get('client_id');
            $cliadr = model(ClientAdresseModel::class);
            $adrs = $cliadr->getAdrInfo($client_id);
            $data['adrs'] = $adrs;
            $data['client'] = $client_id;
            $data['success'] = '1';
            return view('templates/header',$data)
                . view('comments/comment_add')
                . view('templates/footer');
        }else{
            return new \ErrorException("Internal Error");
        }

    }

    public function success()
    {
        // code
    }

    public function listing()
    {
        helper('form');
        $session = session();
        $client_id = $session->get('client_id');
        $ledger = model(LedgerModel::class);
        $lists = $ledger->getAll($client_id);
        $data['lists'] = $lists;
        return view('templates/header',$data)
            . view('comments/comment_list')
            . view('templates/footer');
    }

    public function comment_filter()
    {
        helper('form');
    }

    public function generatePDF(){
        //todo:generatePDF

        $session = session();
        $client_id = $session->get('client_id');
        $ledger = model(LedgerModel::class);
        $lists = $ledger->getAll($client_id);
        $path = 'asset/media/images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = new Dompdf();
        // Sending data to view file
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->loadHtml(view('pdf/commend_pdf', ['lists' => $lists,'logo' => $logo]));
        // setting paper to portrait, also we have landscape
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();
        // Download pdf
        $pdf->stream();
        // to give pdf file name
        // $dompdf->stream("myfile");

        return redirect()->to(base_url('comment_list'));
    }


    public function generateExcel()
    {
        //todo:generateExcel
        $session = session();
        $client_id = $session->get('client_id');
        $ledger = model(LedgerModel::class);
        $lists = $ledger->getAll($client_id);

        $fileName = 'students.xlsx'; // File is to create

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', '工厂地址');
        $sheet->setCellValue('B1', '模具名称');
        $sheet->setCellValue('C1', '资产号');
        $sheet->setCellValue('D1', '购买日期');
        $sheet->setCellValue('E1', '数量');
        $rows = 2;

        foreach ($lists as $val) {
            $sheet->setCellValue('A' . $rows, $val['factory_name']);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $sheet->setCellValue('C' . $rows, $val['assetnum']);
            $sheet->setCellValue('D' . $rows, $val['datebought']);
            $sheet->setCellValue('E' . $rows, $val['quantite']);
            $rows++;
        }

        $writer = new Xlsx($spreadsheet);

        // file inside /public folder
        $filepath = $fileName;

        $writer->save($filepath);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');

        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);

        exit;

    }

}