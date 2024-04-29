<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IntegrasiAP2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Auth', 'M_Integrasi']);

        if (!$this->session->userdata('is_logged_in')) {

            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
            redirect('auth');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Integrasi AP2',
            'pages' => 'pages/integrasi_ap2/v_upload',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function incoming()
    {
        $data = [
            'title' => 'AP2 Incoming',
            'pages' => 'pages/dashboard/integrasi_ap2/v_integrasi',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function outgoing()
    {
        $data = [
            'title' => 'AP2 Outgoing',
            'pages' => 'pages/dashboard/integrasi_ap2/v_integrasi',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function invoice($no_inv)
    {
        $data = [
            'title' => 'Invoice No. ' . $no_inv,
            'pages' => 'pages/dashboard/integrasi_ap2/v_invoice',
            'invoice' => $this->M_Integrasi->getInvoiceDetails($no_inv),
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getData()
    {
        $dom_inc = $this->uri->segment(3);
        $jenis = $this->uri->segment(4);

        $results = $this->M_Integrasi->getDataProduct($dom_inc, $jenis);

        $data = [];

        foreach ($results as $r) {
            $row = array();

            $btn_send = base_url('integrasiap2/send/' . $r->no_invoice);
            $btn_invoice = base_url('integrasiap2/invoice/' . $r->no_invoice);

            $row[] = "
			<div class='btn-group' role='group' aria-label='Send button'>
				<a href='$btn_send' class='btn btn-primary btn-xs btn-process'>Kirim</a>
			</div>";
            $row[] = $r->no_invoice;
            $row[] = $r->no_smu;
            $row[] = format_indo_non_hari($r->tanggal_invoice);
            $row[] = $r->nama_agen;
            $row[] = (!$r->koli) ? 0 : number_format($r->koli);
            $row[] = (!$r->berat) ? 0 : number_format($r->berat);
            $row[] = (!$r->cargo_chg) ? 0 : number_format($r->cargo_chg);
            $row[] = (!$r->total_pendapatan_dengan_ppn) ? 0 : number_format($r->total_pendapatan_dengan_ppn);
            $row[] = $r->user_upload;
            $row[] = "
            <a href='$btn_invoice' target='_blank' class='btn btn-success btn-xs'>Invoice</a>";
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Integrasi->count_all_data($dom_inc, $jenis),
            "recordsFiltered" => $this->M_Integrasi->count_filtered_data($dom_inc, $jenis),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function send3($no_inv)
    {
        $signdate = time();
        $post_date = date("Y-m-d H:i:s", $signdate);

        $invoice_details = $this->M_Integrasi->details($no_inv);

        $messages = '';

        foreach ($invoice_details as $row) {
            $uid_invoice = $row["uid"];
            $no_invoice = $row["no_invoice"];
            $tanggal_invoice = $row["tanggal_invoice"];
            $no_smu = $row["no_smu"];
            $nama_agen = $row["nama_agen"];
            $kd_airline = $row["kdairline"];
            $flight_number = $row["flight_number"];
            $dom_int = $row["dom_int"];
            $inc_out = $row["inc_out"];
            $asal = $row["asal"];
            $tujuan = $row["tujuan"];
            $jenis_kargo = $row["jenis_kargo"];
            $tarif_kargo = $row["tarif_kargo"];
            $koli = $row["koli"];
            $berat = $row["berat"];
            $volume = $row["volume"];
            $jml_hari = $row["jml_hari"];
            $cargo_chg = $row["cargo_chg"];
            $kade = $row["kade"];
            $total_pendapatan_tanpa_ppn = $row["total_pendapatan_tanpa_ppn"];
            $total_pendapatan_dengan_ppn = $row["total_pendapatan_dengan_ppn"];
            $pjt_handling_fee = $row["pjt_handling_fee"];
            $rush_handling_fee = $row["rush_handling_fee"];
            $rush_service_fee = $row["rush_service_fee"];
            $transhipment_fee = $row["transhipment_fee"];
            $administration_fee = $row["administration_fee"];
            $documents_fee = $row["documents_fee"];
            $pecah_pu_fee = $row["pecah_pu_fee"];
            $cool_cold_storage_fee = $row["cool_cold_storage_fee"];
            $strong_room_fee = $row["strong_room_fee"];
            $ac_room_fee = $row["ac_room_fee"];
            $dg_room_fee = $row["dg_room_fee"];
            $avi_room_fee = $row["avi_room_fee"];
            $dangerous_good_check_fee = $row["dangerous_good_check_fee"];
            $discount_fee = $row["discount_fee"];
            $rksp_fee = $row["rksp_fee"];
            $hawb = $row["hawb"];
            $hawb_fee = $row["hawb_fee"];
            $hawb_mawb_fee = $row["hawb_mawb_fee"];
            $csc_fee = $row["csc_fee"];
            $envirotainer_elec_fee = $row["envirotainer_elec_fee"];
            $additional_costs = $row["additional_costs"];
            $nawb_fee = $row["nawb_fee"];
            $barcode_fee = $row["barcode_fee"];
            $cargo_development_fee = $row["cargo_development_fee"];
            $dutiable_shipment_fee = $row["dutiable_shipment_fee"];
            $fhl_fee = $row["fhl_fee"];
            $fwb_fee = $row["fwb_fee"];
            $cargo_inspection_report_fee = $row["cargo_inspection_report_fee"];
            $materai_fee = $row["materai_fee"];
            $ppn_fee = $row["ppn_fee"];
            $tanggal_kirim = $row["tanggal_kirim"];

            if (!$tanggal_kirim) {
                $tanggal_inv = $post_date;
            } else {
                $tanggal_inv = $tanggal_kirim;
            }

            // user Dev
            // "USR" => "api.dev.bdl",
            // "PSW" => "api.dev.bdl",
            $data = array(
                "USR" => "user.api.bdl",
                "PSW" => "User4P1bdL!",
                "NO_INVOICE" => "$no_invoice",
                "TANGGAL" => "$tanggal_inv",
                "SMU" => "$no_smu",
                "KDAIRLINE" => "$kd_airline",
                "FLIGHT_NUMBER" => "$flight_number",
                "DOM_INT" => "$dom_int",
                "INC_OUT" => "$inc_out",
                "ASAL" => "$asal",
                "TUJUAN" => "$tujuan",
                "JENIS_KARGO" => "$jenis_kargo",
                "TARIF_KARGO" => "$tarif_kargo",
                "KOLI" => "$koli",
                "BERAT" => "$berat",
                "VOLUME" => "$volume",
                "JML_HARI" => "$jml_hari",
                "CARGO_CHG" => "$cargo_chg",
                "KADE" => "$kade",
                "TOTAL_PENDAPATAN_TANPA_PPN" => "$total_pendapatan_tanpa_ppn",
                "TOTAL_PENDAPATAN_DENGAN_PPN" => "$total_pendapatan_dengan_ppn",
                "PJT_HANDLING_FEE" => "$pjt_handling_fee",
                "RUSH_HANDLING_FEE" => "$rush_handling_fee",
                "RUSH_SERVICE_FEE" => "$rush_service_fee",
                "TRANSHIPMENT_FEE" => "$transhipment_fee",
                "ADMINISTRATION_FEE" => "$administration_fee",
                "DOCUMENTS_FEE" => "$documents_fee",
                "PECAH_PU_FEE" => "$pecah_pu_fee",
                "COOL_COLD_STORAGE_FEE" => "$cool_cold_storage_fee",
                "STRONG_ROOM_FEE" => "$strong_room_fee",
                "AC_ROOM_FEE" => "$ac_room_fee",
                "DG_ROOM_FEE" => "$dg_room_fee",
                "AVI_ROOM_FEE" => "$avi_room_fee",
                "DANGEROUS_GOOD_CHECK_FEE" => "$dangerous_good_check_fee",
                "DISCOUNT_FEE" => "$discount_fee",
                "RKSP_FEE" => "$rksp_fee",
                "HAWB" => "$hawb",
                "HAWB_FEE" => "$hawb_fee",
                "HAWB_MAWB_FEE" => "$hawb_mawb_fee",
                "CSC_FEE" => "$csc_fee",
                "ENVIROTAINER_ELEC_FEE" => "$envirotainer_elec_fee",
                "ADDITIONAL_COSTS" => "$additional_costs",
                "NAWB_FEE" => "$nawb_fee",
                "BARCODE_FEE" => "$barcode_fee",
                "CARGO_DEVELOPMENT_FEE" => "$cargo_development_fee",
                "DUTIABLE_SHIPMENT_FEE" => "$dutiable_shipment_fee",
                "FHL_FEE" => "$fhl_fee",
                "FWB_FEE" => "$fwb_fee",
                "CARGO_INSPECTION_REPORT_FEE" => "$cargo_inspection_report_fee",
                "MATERAI_FEE" => "$materai_fee",
                "PPN_FEE" => "$ppn_fee"
            );

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            $this->load->library('curl');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://apisigo.angkasapura2.co.id/api/invo_dtl_v2',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Cookie: dtCookie=CD78B9A24184B932B72CB79ED316B71D|X2RlZmF1bHR8MQ; cookiesession1=678B28B514A223A84A018C99578FF1E0'
                ),
            ));

            $response = curl_exec($curl);

            $respons = json_decode($response);

            curl_close($curl);

            $statusinv = $respons->status;
            $message = $respons->message;
            $messages .= $respons->message;

            if ($statusinv == "200") {
                $this->db->set('status_billing', '1');
                $this->db->set('tanggal_kirim', $tanggal_inv);
                $this->db->set('user_kasir', $this->session->userdata('user_id'));
                $this->db->set('respon_ap2', $statusinv);
                $this->db->set('message_respon_send', $message);
                $this->db->where('uid', $uid_invoice);
                $this->db->update('integrasi_ap2');
            } else if ($statusinv == "400") {
                if ($message == "400 Error Input or Duplicate Entry - Please try again") {
                    $this->db->set('status_billing', '1');
                    $this->db->set('tanggal_kirim', $tanggal_inv);
                    $this->db->set('user_kasir', $this->session->userdata('user_id'));
                    $this->db->set('respon_ap2', $statusinv);
                    $this->db->set('message_respon_send', $message);
                    $this->db->where('uid', $uid_invoice);
                    $this->db->update('integrasi_ap2');
                } else {
                    $this->db->set('status_billing', '0');
                    $this->db->set('tanggal_kirim', $tanggal_inv);
                    $this->db->set('user_kasir', $this->session->userdata('user_id'));
                    $this->db->set('respon_ap2', $statusinv);
                    $this->db->set('message_respon_send', $message);
                    $this->db->where('uid', $uid_invoice);
                    $this->db->update('integrasi_ap2');
                }
            } else {
                $this->db->set('status_billing', '0');
                $this->db->set('tanggal_kirim', $tanggal_inv);
                $this->db->set('user_kasir', $this->session->userdata('user_id'));
                $this->db->set('respon_ap2', $statusinv);
                $this->db->set('message_respon_send', $message);
                $this->db->where('uid', $uid_invoice);
                $this->db->update('integrasi_ap2');
            }
        }
    }

    public function send($no_inv)
    {
        $signdate = time();
        $post_date = date("Y-m-d H:i:s", $signdate);

        $invoice_details = $this->M_Integrasi->details($no_inv);
        $messages = '';

        foreach ($invoice_details as $row) {
            $uid_invoice = $row["uid"];
            $no_invoice = $row["no_invoice"];
            $tanggal_invoice = $row["tanggal_invoice"];
            $no_smu = $row["no_smu"];
            $nama_agen = $row["nama_agen"];
            $kd_airline = $row["kdairline"];
            $flight_number = $row["flight_number"];
            $dom_int = $row["dom_int"];
            $inc_out = $row["inc_out"];
            $asal = $row["asal"];
            $tujuan = $row["tujuan"];
            $jenis_kargo = $row["jenis_kargo"];
            $tarif_kargo = $row["tarif_kargo"];
            $koli = $row["koli"];
            $berat = $row["berat"];
            $volume = $row["volume"];
            $jml_hari = $row["jml_hari"];
            $cargo_chg = $row["cargo_chg"];
            $kade = $row["kade"];
            $total_pendapatan_tanpa_ppn = $row["total_pendapatan_tanpa_ppn"];
            $total_pendapatan_dengan_ppn = $row["total_pendapatan_dengan_ppn"];
            $pjt_handling_fee = $row["pjt_handling_fee"];
            $rush_handling_fee = $row["rush_handling_fee"];
            $rush_service_fee = $row["rush_service_fee"];
            $transhipment_fee = $row["transhipment_fee"];
            $administration_fee = $row["administration_fee"];
            $documents_fee = $row["documents_fee"];
            $pecah_pu_fee = $row["pecah_pu_fee"];
            $cool_cold_storage_fee = $row["cool_cold_storage_fee"];
            $strong_room_fee = $row["strong_room_fee"];
            $ac_room_fee = $row["ac_room_fee"];
            $dg_room_fee = $row["dg_room_fee"];
            $avi_room_fee = $row["avi_room_fee"];
            $dangerous_good_check_fee = $row["dangerous_good_check_fee"];
            $discount_fee = $row["discount_fee"];
            $rksp_fee = $row["rksp_fee"];
            $hawb = $row["hawb"];
            $hawb_fee = $row["hawb_fee"];
            $hawb_mawb_fee = $row["hawb_mawb_fee"];
            $csc_fee = $row["csc_fee"];
            $envirotainer_elec_fee = $row["envirotainer_elec_fee"];
            $additional_costs = $row["additional_costs"];
            $nawb_fee = $row["nawb_fee"];
            $barcode_fee = $row["barcode_fee"];
            $cargo_development_fee = $row["cargo_development_fee"];
            $dutiable_shipment_fee = $row["dutiable_shipment_fee"];
            $fhl_fee = $row["fhl_fee"];
            $fwb_fee = $row["fwb_fee"];
            $cargo_inspection_report_fee = $row["cargo_inspection_report_fee"];
            $materai_fee = $row["materai_fee"];
            $ppn_fee = $row["ppn_fee"];

            $tanggal_inv = $row["tanggal_kirim"] ?: $post_date;

            $data = array(
                "USR" => "user.api.bdl",
                "PSW" => "User4P1bdL!",
                "NO_INVOICE" => "$no_invoice",
                "TANGGAL" => "$tanggal_inv",
                "SMU" => "$no_smu",
                "KDAIRLINE" => "$kd_airline",
                "FLIGHT_NUMBER" => "$flight_number",
                "DOM_INT" => "$dom_int",
                "INC_OUT" => "$inc_out",
                "ASAL" => "$asal",
                "TUJUAN" => "$tujuan",
                "JENIS_KARGO" => "$jenis_kargo",
                "TARIF_KARGO" => "$tarif_kargo",
                "KOLI" => "$koli",
                "BERAT" => "$berat",
                "VOLUME" => "$volume",
                "JML_HARI" => "$jml_hari",
                "CARGO_CHG" => "$cargo_chg",
                "KADE" => "$kade",
                "TOTAL_PENDAPATAN_TANPA_PPN" => "$total_pendapatan_tanpa_ppn",
                "TOTAL_PENDAPATAN_DENGAN_PPN" => "$total_pendapatan_dengan_ppn",
                "PJT_HANDLING_FEE" => "$pjt_handling_fee",
                "RUSH_HANDLING_FEE" => "$rush_handling_fee",
                "RUSH_SERVICE_FEE" => "$rush_service_fee",
                "TRANSHIPMENT_FEE" => "$transhipment_fee",
                "ADMINISTRATION_FEE" => "$administration_fee",
                "DOCUMENTS_FEE" => "$documents_fee",
                "PECAH_PU_FEE" => "$pecah_pu_fee",
                "COOL_COLD_STORAGE_FEE" => "$cool_cold_storage_fee",
                "STRONG_ROOM_FEE" => "$strong_room_fee",
                "AC_ROOM_FEE" => "$ac_room_fee",
                "DG_ROOM_FEE" => "$dg_room_fee",
                "AVI_ROOM_FEE" => "$avi_room_fee",
                "DANGEROUS_GOOD_CHECK_FEE" => "$dangerous_good_check_fee",
                "DISCOUNT_FEE" => "$discount_fee",
                "RKSP_FEE" => "$rksp_fee",
                "HAWB" => "$hawb",
                "HAWB_FEE" => "$hawb_fee",
                "HAWB_MAWB_FEE" => "$hawb_mawb_fee",
                "CSC_FEE" => "$csc_fee",
                "ENVIROTAINER_ELEC_FEE" => "$envirotainer_elec_fee",
                "ADDITIONAL_COSTS" => "$additional_costs",
                "NAWB_FEE" => "$nawb_fee",
                "BARCODE_FEE" => "$barcode_fee",
                "CARGO_DEVELOPMENT_FEE" => "$cargo_development_fee",
                "DUTIABLE_SHIPMENT_FEE" => "$dutiable_shipment_fee",
                "FHL_FEE" => "$fhl_fee",
                "FWB_FEE" => "$fwb_fee",
                "CARGO_INSPECTION_REPORT_FEE" => "$cargo_inspection_report_fee",
                "MATERAI_FEE" => "$materai_fee",
                "PPN_FEE" => "$ppn_fee"
            );

            echo '<pre>';
            print_r($data);
            echo '</pre>';
            exit;

            // Request ke API menggunakan cURL
            // $response = $this->sendRequest($data);

            // // Mendapatkan status dan pesan dari respons API
            // $statusinv = $response->status;
            // $message = $response->message;
            // $messages .= $message;

            // // Update status billing berdasarkan respons API
            // $this->updateBillingStatus($statusinv, $message, $tanggal_inv, $row["uid"]);
        }

        redirect('integrasiap2/incoming');
    }

    private function sendRequest($data)
    {
        $this->load->library('curl');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apisigo.angkasapura2.co.id/api/invo_dtl_v2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Cookie: dtCookie=CD78B9A24184B932B72CB79ED316B71D|X2RlZmF1bHR8MQ; cookiesession1=678B28B514A223A84A018C99578FF1E0'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    private function updateBillingStatus($statusinv, $message, $tanggal_kirim, $uid_invoice)
    {
        $this->db->set(array(
            'status_billing' => ($statusinv == "200" || $message == "400 Error Input or Duplicate Entry - Please try again") ? '1' : '0',
            'tanggal_kirim' => $tanggal_kirim,
            'user_kasir' => $this->session->userdata('user_id'),
            'respon_ap2' => $statusinv,
            'message_respon_send' => $message
        ));
        $this->db->where('uid', $uid_invoice);
        $this->db->update('integrasi_ap2');
    }
}
