<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
    public function import($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan5%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan4%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan3%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan2%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan1%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN awb_class = '2' AND status = '1' AND post_date LIKE '$bulan%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('wms_storage_order_qty');
        return $this->db->get()->row_array();
    }

    public function export($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan5%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan4%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan3%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan2%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan1%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN status = '1' AND post_date LIKE '$bulan%' THEN weight_charge ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('eks_storage_order_qty');
        return $this->db->get()->row_array();
    }

    public function in_cgk($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan5%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan4%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan3%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan2%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan1%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('bdl_in_billing');
        return $this->db->get()->row_array();
        // return $this->db->select_sum('total_chargeable')->where('status', '1')->like('tanggal_invoice', $bulan, 'after')->get('bdl_in_billing')->row_array();
    }

    public function out_cgk($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan5%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan4%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan3%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan2%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan1%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN status = '1' AND tanggal_invoice LIKE '$bulan%' THEN total_chargeable ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('bdl_out_billing');
        return $this->db->get()->row_array();
        // return $this->db->select_sum('total_chargeable')->where('status', '1')->like('tanggal_invoice', $bulan, 'after')->get('bdl_out_billing')->row_array();
    }

    public function in_hlp($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan5%' THEN chargeable ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan4%' THEN chargeable ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan3%' THEN chargeable ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan2%' THEN chargeable ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan1%' THEN chargeable ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan%' THEN chargeable ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('in_list');
        return $this->db->get()->row_array();
        // return $this->db->select_sum('total_chargeable')->where('status', '1')->like('tanggal_invoice', $bulan, 'after')->get('in_billing')->row_array();
    }

    public function out_hlp($bulan)
    {
        $bulan1 = date('Ym', strtotime('-1 months', strtotime($bulan)));
        $bulan2 = date('Ym', strtotime('-2 months', strtotime($bulan)));
        $bulan3 = date('Ym', strtotime('-3 months', strtotime($bulan)));
        $bulan4 = date('Ym', strtotime('-4 months', strtotime($bulan)));
        $bulan5 = date('Ym', strtotime('-5 months', strtotime($bulan)));

        $this->db->select("
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan5%' THEN chargeable ELSE 0 END) / 1000, 2) AS '01',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan4%' THEN chargeable ELSE 0 END) / 1000, 2) AS '02',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan3%' THEN chargeable ELSE 0 END) / 1000, 2) AS '03',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan2%' THEN chargeable ELSE 0 END) / 1000, 2) AS '04',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan1%' THEN chargeable ELSE 0 END) / 1000, 2) AS '05',
        ROUND(SUM(CASE WHEN post_date LIKE '$bulan%' THEN chargeable ELSE 0 END) / 1000, 2) AS '06' ");
        $this->db->from('out_list');
        return $this->db->get()->row_array();
        // return $this->db->select_sum('total_chargeable')->where('status', '1')->like('tanggal_invoice', $bulan, 'after')->get('out_billing')->row_array();
    }

    public function outstanding_agent()
    {
        $agentData = [];
        $current_sum = 0;
        $out1_sum = 0;
        $out2_sum = 0;
        $out3_sum = 0;
        $out4_sum = 0;
        $piutang = 0;

        // Query ke database untuk mendapatkan data agen
        $query = $this->db->query("SELECT agent_name FROM bill_manual WHERE (catg_invoice = 'HIS' OR catg_invoice = 'BDL' OR catg_invoice = 'MITE') GROUP BY agent_name ORDER BY agent_name");

        // Lakukan iterasi pada hasil query
        foreach ($query->result_array() as $row) {
            $agent = $row['agent_name'];
            $data = [];

            // Query untuk mendapatkan data sesuai dengan agen tertentu
            if ($agent == "PT. AVS" || $agent == "PT. OWS" || $agent == "RAYSPEED CARGO" || $agent == "PT. BOLLORE") {

                // Query Current
                $current_query = $this->db->query("SELECT SUM(grand_total) AS current_grand_total, SUM(terbayar) AS current_terbayar FROM bill_manual WHERE agent_name = ? AND post_date > (NOW() - INTERVAL 30 DAY) AND status = '0'", array($agent));
                $current_result = $current_query->row();

                $current = $current_result->current_grand_total - $current_result->current_terbayar;

                // Query Outstanding 1
                $outstanding1_query = $this->db->query("SELECT SUM(grand_total) AS outstanding1_grand_total, SUM(terbayar) AS outstanding1_terbayar FROM bill_manual WHERE agent_name = ? AND post_date BETWEEN CURDATE() - INTERVAL 40 DAY AND CURDATE() - INTERVAL 31 DAY AND status = '0'", array($agent));
                $outstanding1_result = $outstanding1_query->row();

                $outstanding1 = $outstanding1_result->outstanding1_grand_total - $outstanding1_result->outstanding1_terbayar;

                // Query Outstanding 2
                $outstanding2_query = $this->db->query("SELECT SUM(grand_total) AS outstanding2_grand_total, SUM(terbayar) AS outstanding2_terbayar FROM bill_manual WHERE agent_name = ? AND post_date BETWEEN CURDATE() - INTERVAL 60 DAY AND CURDATE() - INTERVAL 41 DAY AND status = '0'", array($agent));
                $outstanding2_result = $outstanding2_query->row();

                $outstanding2 = $outstanding2_result->outstanding2_grand_total - $outstanding2_result->outstanding2_terbayar;

                // Query Outstanding 3
                $outstanding3_query = $this->db->query("SELECT SUM(grand_total) AS outstanding3_grand_total, SUM(terbayar) AS outstanding3_terbayar FROM bill_manual WHERE agent_name = ? AND post_date < CURDATE() - INTERVAL 61 DAY AND status = '0'", array($agent));
                $outstanding3_result = $outstanding3_query->row();

                $outstanding3 = $outstanding3_result->outstanding3_grand_total - $outstanding3_result->outstanding3_terbayar;
            } else if ($agent == "WALKIN CUSTOMER") {

                // Query Current
                $current_query = $this->db->query("SELECT SUM(grand_total) AS current_grand_total, SUM(terbayar) AS current_terbayar FROM bill_manual WHERE agent_name = ? AND post_date > (NOW() - INTERVAL 0 DAY) AND status = '0'", array($agent));
                $current_result = $current_query->row();

                $current = $current_result->current_grand_total - $current_result->current_terbayar;

                // Query Outstanding 1
                $outstanding1_query = $this->db->query("SELECT SUM(grand_total) AS outstanding1_grand_total, SUM(terbayar) AS outstanding1_terbayar FROM bill_manual WHERE agent_name = ? AND post_date < (NOW() - INTERVAL 0 DAY) AND status = '0'", array($agent));
                $outstanding1_result = $outstanding1_query->row();

                $outstanding1 = $outstanding1_result->outstanding1_grand_total - $outstanding1_result->outstanding1_terbayar;

                $outstanding2 = 0;
                $outstanding3 = 0;
            } else {

                // Query Current
                $current_query = $this->db->query("SELECT SUM(grand_total) AS current_grand_total, SUM(terbayar) AS current_terbayar FROM bill_manual WHERE agent_name = ? AND post_date > (NOW() - INTERVAL 15 DAY) AND status = '0'", array($agent));
                $current_result = $current_query->row();

                $current = $current_result->current_grand_total - $current_result->current_terbayar;

                // Query Outstanding 1
                $outstanding1_query = $this->db->query("SELECT SUM(grand_total) AS outstanding1_grand_total, SUM(terbayar) AS outstanding1_terbayar FROM bill_manual WHERE agent_name = ? AND post_date BETWEEN CURDATE() - INTERVAL 25 DAY AND CURDATE() - INTERVAL 15 DAY AND status = '0'", array($agent));
                $outstanding1_result = $outstanding1_query->row();

                $outstanding1 = $outstanding1_result->outstanding1_grand_total - $outstanding1_result->outstanding1_terbayar;

                // Query Outstanding 2
                $outstanding2_query = $this->db->query("SELECT SUM(grand_total) AS outstanding2_grand_total, SUM(terbayar) AS outstanding2_terbayar FROM bill_manual WHERE agent_name = ? AND post_date BETWEEN CURDATE() - INTERVAL 46 DAY AND CURDATE() - INTERVAL 26 DAY AND status = '0'", array($agent));
                $outstanding2_result = $outstanding2_query->row();

                $outstanding2 = $outstanding2_result->outstanding2_grand_total - $outstanding2_result->outstanding2_terbayar;

                // Query Outstanding 3
                $outstanding3_query = $this->db->query("SELECT SUM(grand_total) AS outstanding3_grand_total, SUM(terbayar) AS outstanding3_terbayar FROM bill_manual WHERE agent_name = ? AND post_date BETWEEN CURDATE() - INTERVAL 106 DAY AND CURDATE() - INTERVAL 47 DAY AND status = '0'", array($agent));
                $outstanding3_result = $outstanding3_query->row();

                $outstanding3 = $outstanding3_result->outstanding3_grand_total - $outstanding3_result->outstanding3_terbayar;

                // Query Outstanding 4
                $outstanding4_query = $this->db->query("SELECT SUM(grand_total) AS outstanding4_grand_total, SUM(terbayar) AS outstanding4_terbayar FROM bill_manual WHERE agent_name = ? AND post_date < CURDATE() - INTERVAL 106 DAY AND status = '0'", array($agent));
                $outstanding4_result = $outstanding4_query->row();

                $outstanding4 = $outstanding4_result->outstanding4_grand_total - $outstanding4_result->outstanding4_terbayar;
            }

            // Hitung total outstanding
            $data['outstanding_total'] = $current + $outstanding1 + $outstanding2 + $outstanding3 + $outstanding4;

            // Tambahkan data agen ke dalam array
            $agentData[] = $data;

            // Tambahkan variabel ke dalam total
            $current_sum += $current;
            $out1_sum += $outstanding1;
            $out2_sum += $outstanding2;
            $out3_sum += $outstanding3;
            $out4_sum += $outstanding4;
            $piutang += $data['outstanding_total'];
        }

        return array(
            'current_sum' => $current_sum,
            'out1_sum' => $out1_sum,
            'out2_sum' => $out2_sum,
            'out3_sum' => $out3_sum,
            'out4_sum' => $out4_sum,
            'piutang' => $piutang,
            // 'agentData' => $agentData
        );
    }

    public function out_hlp_last_six_months()
    {
        // Mendapatkan tanggal bulan saat ini
        $current_month_year = date('Y-m');

        // Mendapatkan tanggal 6 bulan yang lalu dari bulan saat ini
        $six_months_ago = date('Y-m', strtotime('-6 months'));

        // Mendefinisikan array untuk menyimpan hasil per bulan
        $monthly_totals = [];

        // Iterasi untuk setiap bulan dalam rentang 6 bulan terakhir
        $start_date = new DateTime($six_months_ago . '-01');
        $end_date = new DateTime($current_month_year . '-01');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start_date, $interval, $end_date);

        foreach ($period as $date) {
            $month_year = $date->format('Y-m');

            // Mendapatkan data hasil sum total_chargeable untuk bulan tertentu
            $result = $this->db
                ->select_sum('total_chargeable')
                ->where('status', '1')
                ->where("tanggal_invoice LIKE '$month_year%'")
                ->get('out_billing')
                ->row_array();

            // Menambahkan hasil ke dalam array berdasarkan bulan
            $monthly_totals[$month_year] = $result['total_chargeable'] ?? 0;
        }

        return $monthly_totals;
    }
}
