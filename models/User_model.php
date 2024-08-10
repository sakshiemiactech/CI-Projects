<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_auth_user()
    {
        $query = $this->db->get_where("tbl_users", [
            "email" => $this->security->xss_clean($this->input->post("email")),
            "password" => $this->security->xss_clean(
                hash("sha256", $this->input->post("password") . SALT)
            ),
            "role!=" => "Suspend",
        ]);
        $query = $query->row_array();
        if ($query) {
            $data["last_login"] = time();
            $this->db->where("id", $query["id"]);
            $this->db->update("tbl_users", $data);
        }
        return $query;
    }

    public function is_auth_session($login_id)
    {
        $id = substr($login_id, 6);
        if ($id != 0) {
            $query = $this->db->get_where("tbl_users", ["login_id" => $id]);
            $query = $query->row_array();
            if ($query) {
                $data["last_login"] = time();
                $this->db->where("id", $query["id"]);
                $this->db->update("tbl_users", $data);
            }
            return $query;
        }
        return false;
    }

    public function logout_time()
    {
        $data["last_logout"] = time();
        $this->db->where("email", $this->session->userdata("user_email"));
        $this->db->update("tbl_user", $data);
    }

    public function user_info()
    {
        $result = $this->db->get_where("tbl_user", [
            "email" => $this->session->userdata("user_email"),
            "status" => "Active",
        ]);
        return $result->row_array();
    }

    public function get_user_id()
    {
        $result = $this->db
            ->get_where("tbl_user", [
                "email" => $this->session->userdata("user_email"),
            ])
            ->row_array();
        return $result["id"];
    }

    public function get_all_bl($all)
    {
        $data = $this->input->post();
        /*if (isset($_POST['submit'])){
			    echo '<pre>';print_r($data);die;
			}*/
        if (!empty($data)) {
            if (!empty($data["per_category"])) {
                if (!empty($data["niche_choice"])) {
                    $this->db->where("niche", $data["per_category"]);
                } else {
                    $this->db->like("niche", $data["per_category"]);
                }
            }
            if (!empty($data["price_category"])) {
                $this->db->where_in("price_category", $data["price_category"]);
            }
            if (!empty($data["per_name"])) {
                $this->db->where("person", $data["per_name"]);
            }
            if (
                is_numeric($data["start_price"]) &&
                is_numeric($data["end_price"])
            ) {
                $this->db->where("price>=", $data["start_price"]);
                $this->db->where("price<=", $data["end_price"]);
            }
            if (
                !empty($data["start_selling_price"]) &&
                !empty($data["end_selling_price"])
            ) {
                $this->db->where(
                    "sailing_price>=",
                    $data["start_selling_price"]
                );
                $this->db->where("sailing_price<=", $data["end_selling_price"]);
            }
            if (!empty($data["from_traffic"]) && !empty($data["to_traffic"])) {
                $this->db->where("traffic>=", $data["from_traffic"]);
                $this->db->where("traffic<=", $data["to_traffic"]);
            }
            if (!empty($data["start_da"])) {
                $this->db->where("da>=", $data["start_da"]);
                $this->db->where("da<=", $data["end_da"]);
            }
            if (!empty($data["web_category"])) {
                $this->db->where("web_category", $data["web_category"]);
            }
            if (!empty($data["vendor_country"])) {
                $this->db->where("web_country", $data["vendor_country"]);
            }
            if (!empty($data["contact_from_id"])) {
                $this->db->where("contact_from_id", $data["contact_from_id"]);
            }
        } elseif (empty($all)) {
            $this->db->limit(50);
        }
        if (isset($_POST["submit"]) && empty($data["agency"])) {
            $this->db->where("web_category!=", "Com & Agency");
            $this->db->where("web_category!=", "Agency");
        }
        if (empty($data["duplicate"])) {
            $this->db->group_by(["website"]);
        }

        $this->db->order_by("price", "DESC");
        $this->db->select(
            "tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*"
        );
        $this->db->from("tbl_vendors");
        $this->db->join("tbl_sites", "tbl_sites.person_id = tbl_vendors.id");
        $this->db->join("tbl_users", "tbl_users.id = tbl_sites.user_id");
        $result = $this->db->get();
        return $result->result_array();
        //return $this->db->get('tbl_sites')->result_array();
    }

    public function get_all_bl_assign($all)
    {
        $data = $this->input->post();

        //print_r($data);die;
        /*if($data['start_price'] > 0){
			    print_r($data);die;
			}*/
        if (!empty($data)) {
            if (!empty($data["per_category"])) {
                if (!empty($data["niche_choice"])) {
                    $this->db->where("niche", $data["per_category"]);
                } else {
                    $this->db->like("niche", $data["per_category"]);
                }
            }
            if (!empty($data["price_category"])) {
                $this->db->where_in("price_category", $data["price_category"]);
            }
            if (!empty($data["per_name"])) {
                $this->db->where("person", $data["per_name"]);
            }
            if (
                is_numeric($data["start_price"]) &&
                is_numeric($data["end_price"])
            ) {
                $this->db->where("price>=", $data["start_price"]);
                $this->db->where("price<=", $data["end_price"]);
            }
            if (
                !empty($data["start_selling_price"]) &&
                !empty($data["end_selling_price"])
            ) {
                $this->db->where(
                    "sailing_price>=",
                    $data["start_selling_price"]
                );
                $this->db->where("sailing_price<=", $data["end_selling_price"]);
            }
            if (!empty($data["from_traffic"]) && !empty($data["to_traffic"])) {
                $this->db->where("traffic>=", $data["from_traffic"]);
                $this->db->where("traffic<=", $data["to_traffic"]);
            }
            if (!empty($data["start_da"])) {
                $this->db->where("da>=", $data["start_da"]);
                $this->db->where("da<=", $data["end_da"]);
            }
            if (!empty($data["web_category"])) {
                $this->db->where("web_category", $data["web_category"]);
            }
            if (!empty($data["vendor_country"])) {
                $this->db->where("web_country", $data["vendor_country"]);
            }
            if (!empty($data["contact_from_id"])) {
                $this->db->where("contact_from_id", $data["contact_from_id"]);
            }
        } elseif (empty($all)) {
            $this->db->limit(50);
        }
        $data["duplicate"] = "yes";
        if (empty($data["duplicate"])) {
            $this->db->group_by(["website"]);
        }

        $this->db->order_by("price", "DESC");
        $this->db->select(
            "tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*"
        );
        $this->db->from("tbl_vendors");
        $this->db->join("tbl_sites", "tbl_sites.person_id = tbl_vendors.id");
        $this->db->join("tbl_users", "tbl_users.id = tbl_sites.user_id");
        $result = $this->db->get();
        return $result->result_array();
        //return $this->db->get('tbl_sites')->result_array();
    }

    public function total_rows()
    {
        $this->db->limit(1);
        $this->db->order_by("id", "DESC");
        $data = $this->db->get_where("tbl_sites")->row_array();
        return $data["id"];
    }

    public function get_all_category()
    {
        $this->db->group_by("niche");
        $this->db->select("niche");
        $this->db->order_by("CHAR_LENGTH(niche)", "asc");
        return $this->db->get("tbl_sites")->result_array();
    }

    public function get_all_price_category()
    {
        $this->db->group_by("price_category");
        $this->db->select("price_category");
        return $this->db->get("tbl_sites")->result_array();
    }

    public function get_all_names()
    {
        $this->db->group_by("person");
        $this->db->select("person");
        return $this->db->get("tbl_sites")->result_array();
    }

    public function data_deletion_site($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_sites");
        return $this->db->affected_rows();
    }

    public function do_add_site()
    {
        $data["person_id"] = $this->security->xss_clean(
            $this->input->post("person_id")
        );
        $vendor_info = $this->db
            ->get_where("tbl_vendors", ["id" => $data["person_id"]])
            ->row_array();
        $data["person"] = $vendor_info["name"];
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["niche"] = $this->security->xss_clean(
            $this->input->post("niche")
        );
        $data["cp_update_date"] = $this->security->xss_clean(
            $this->input->post("cp_update_date")
        );
        $data["main_category"] = $this->security->xss_clean(
            $this->input->post("main_category")
        );
        $data["da"] = $this->security->xss_clean($this->input->post("da"));
        $data["pa"] = $this->security->xss_clean($this->input->post("pa"));
        $data["price_category"] = $this->security->xss_clean(
            $this->input->post("price_category")
        );
        $data["price"] = $this->security->xss_clean(
            $this->input->post("price")
        );
        $data["traffic"] = $this->security->xss_clean(
            $this->input->post("traffic")
        );
        $data["follow"] = $this->security->xss_clean(
            $this->input->post("follow")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        //$data['manual_date'] = date('Y-m-d');
        //$data['timestamp'] = time();
        $data["sailing_price"] = $this->security->xss_clean(
            $this->input->post("sailing_price")
        );
        $data["contact"] = $vendor_info["email"];
        $data["contact_from"] = $vendor_info["contacted_from"];
        $data["discount"] = $this->security->xss_clean(
            $this->input->post("discount")
        );
        $data["web_category"] = $this->security->xss_clean(
            $this->input->post("web_category")
        );

        $data["link_insertion_cost"] = $this->security->xss_clean(
            $this->input->post("link_insertion_cost")
        );
        $data["tat"] = $this->security->xss_clean($this->input->post("tat"));
        $data["social_media_posting"] = $this->security->xss_clean(
            $this->input->post("social_media_posting")
        );

        //$data['contact_from_id'] = $this->security->xss_clean($this->input->post('contact_from_id'));
        //$data['vendor_country'] = $this->security->xss_clean($this->input->post('vendor_country'));
        $data["phone_number"] = $vendor_info["phone"];
        $data["sample_url"] = $this->security->xss_clean(
            $this->input->post("sample_url")
        );
        $data["dr"] = $this->security->xss_clean($this->input->post("dr"));
        $data["spam_score"] = $this->security->xss_clean(
            $this->input->post("spam_score")
        );
        $data["casino_adult"] = $this->security->xss_clean(
            $this->input->post("casino_adult")
        );
        $data["adult"] = $this->security->xss_clean(
            $this->input->post("adult")
        );
        $data["sompc"] = $this->security->xss_clean(
            $this->input->post("sompc")
        );
        $data["banner_image_price"] = $this->security->xss_clean(
            $this->input->post("banner_image_price")
        );
        $data["cbd_price"] = $this->security->xss_clean(
            $this->input->post("cbd_price")
        );
        //$data['bank_details'] = $this->security->xss_clean($this->input->post('bank_details'));
        $data["user_id"] = $this->session->user_id;
        $this->db->insert("tbl_sites", $data);
        return $this->db->insert_id();
    }

    public function do_add_language_site()
    {
        $data["person_id"] = $this->security->xss_clean(
            $this->input->post("person_id")
        );
        $vendor_info = $this->db
            ->get_where("tbl_vendors", ["id" => $data["person_id"]])
            ->row_array();
        $data["person"] = $vendor_info["name"];
        $data["language"] = $this->security->xss_clean(
            $this->input->post("language")
        );
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["niche"] = $this->security->xss_clean(
            $this->input->post("niche")
        );
        $data["site_category"] = $this->security->xss_clean(
            $this->input->post("site_category")
        );
        $data["main_category"] = $this->security->xss_clean(
            $this->input->post("main_category")
        );
        $data["da"] = $this->security->xss_clean($this->input->post("da"));
        $data["pa"] = $this->security->xss_clean($this->input->post("pa"));
        $data["price_category"] = $this->security->xss_clean(
            $this->input->post("price_category")
        );
        $data["price"] = $this->security->xss_clean(
            $this->input->post("price")
        );
        $data["traffic"] = $this->security->xss_clean(
            $this->input->post("traffic")
        );
        $data["follow"] = $this->security->xss_clean(
            $this->input->post("follow")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        //$data['manual_date'] = date('Y-m-d');
        //$data['timestamp'] = time();
        $data["sailing_price"] = $this->security->xss_clean(
            $this->input->post("sailing_price")
        );
        $data["contact"] = $vendor_info["email"];
        $data["contact_from"] = $vendor_info["contacted_from"];
        $data["discount"] = $this->security->xss_clean(
            $this->input->post("discount")
        );
        $data["web_category"] = $this->security->xss_clean(
            $this->input->post("web_category")
        );

        $data["link_insertion_cost"] = $this->security->xss_clean(
            $this->input->post("link_insertion_cost")
        );
        $data["tat"] = $this->security->xss_clean($this->input->post("tat"));
        $data["social_media_posting"] = $this->security->xss_clean(
            $this->input->post("social_media_posting")
        );

        //$data['contact_from_id'] = $this->security->xss_clean($this->input->post('contact_from_id'));
        //$data['vendor_country'] = $this->security->xss_clean($this->input->post('vendor_country'));
        $data["phone_number"] = $vendor_info["phone"];
        $data["sample_url"] = $this->security->xss_clean(
            $this->input->post("sample_url")
        );
        $data["dr"] = $this->security->xss_clean($this->input->post("dr"));
        $data["spam_score"] = $this->security->xss_clean(
            $this->input->post("spam_score")
        );
        $data["casino_adult"] = $this->security->xss_clean(
            $this->input->post("casino_adult")
        );
        $data["adult"] = $this->security->xss_clean(
            $this->input->post("adult")
        );
        $data["cbd_price"] = $this->security->xss_clean(
            $this->input->post("cbd_price")
        );
        //$data['bank_details'] = $this->security->xss_clean($this->input->post('bank_details'));
        //echo 'SK';die;
        $data["user_id"] = $this->session->user_id;
        $this->db->insert("tbl_olt", $data);
        return $this->db->insert_id();
    }

    public function do_update_site($id)
    {
        $data["person_id"] = $this->security->xss_clean(
            $this->input->post("person_id")
        );
        //echo '<pre>';print_r($data['person_id']);die;
        $vendor_info = $this->db
            ->get_where("tbl_vendors", ["id" => $data["person_id"]])
            ->row_array();
        $data["person"] = $vendor_info["name"];
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["niche"] = $this->security->xss_clean(
            $this->input->post("niche")
        );
        $data["main_category"] = $this->security->xss_clean(
            $this->input->post("main_category")
        );
        $data["site_category"] = $this->security->xss_clean(
            $this->input->post("site_category")
        );
        $data["cbd_price"] = $this->security->xss_clean(
            $this->input->post("cbd_price")
        );
        $data["casino_adult"] = $this->security->xss_clean(
            $this->input->post("casino_adult")
        );
        $data["adult"] = $this->security->xss_clean(
            $this->input->post("adult")
        );
        $data["da"] = $this->security->xss_clean($this->input->post("da"));
        $data["pa"] = $this->security->xss_clean($this->input->post("pa"));
        $data["price_category"] = $this->security->xss_clean(
            $this->input->post("price_category")
        );
        $data["price"] = $this->security->xss_clean(
            $this->input->post("price")
        );
        $data["traffic"] = $this->security->xss_clean(
            $this->input->post("traffic")
        );
        $data["follow"] = $this->security->xss_clean(
            $this->input->post("follow")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        //$data['manual_date'] = date('Y-m-d');
        $data["site_update_date"] = time();
        $times = $this->db->get_where("tbl_sites", ["id" => $id])->row_array();
        $data["timestamp"] = $times["timestamp"];
        $data["sailing_price"] = $this->security->xss_clean(
            $this->input->post("sailing_price")
        );
        $data["contact"] = $vendor_info["email"];
        $data["contact_from"] = $vendor_info["contacted_from"];
        $data["discount"] = $this->security->xss_clean(
            $this->input->post("discount")
        );
        $data["web_category"] = $this->security->xss_clean(
            $this->input->post("web_category")
        );

        $data["sompc"] = $this->security->xss_clean(
            $this->input->post("sompc")
        );
        $data["banner_image_price"] = $this->security->xss_clean(
            $this->input->post("banner_image_price")
        );
        //$data['contact_from_id'] = $this->security->xss_clean($this->input->post('contact_from_id'));
        //$data['vendor_country'] = $this->security->xss_clean($this->input->post('vendor_country'));
        $data["phone_number"] = $vendor_info["phone"];
        $data["sample_url"] = $this->security->xss_clean(
            $this->input->post("sample_url")
        );
        $data["dr"] = $this->security->xss_clean($this->input->post("dr"));
        $data["spam_score"] = $this->security->xss_clean(
            $this->input->post("spam_score")
        );
        $data["link_insertion_cost"] = $this->security->xss_clean(
            $this->input->post("link_insertion_cost")
        );
        $data["tat"] = $this->security->xss_clean($this->input->post("tat"));
        $this->db->where("id", $id);
        $this->db->update("tbl_sites", $data);
        return $this->db->affected_rows();
    }

    public function do_update_language_site($id)
    {
        $data["person_id"] = $this->security->xss_clean(
            $this->input->post("person_id")
        );
        //echo '<pre>';print_r($data['person_id']);die;
        $vendor_info = $this->db
            ->get_where("tbl_vendors", ["id" => $data["person_id"]])
            ->row_array();
        $data["person"] = $vendor_info["name"];
        $data["language"] = $this->security->xss_clean(
            $this->input->post("language")
        );
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["niche"] = $this->security->xss_clean(
            $this->input->post("niche")
        );
        $data["main_category"] = $this->security->xss_clean(
            $this->input->post("main_category")
        );
        $data["site_category"] = $this->security->xss_clean(
            $this->input->post("site_category")
        );
        $data["cbd_price"] = $this->security->xss_clean(
            $this->input->post("cbd_price")
        );
        $data["casino_adult"] = $this->security->xss_clean(
            $this->input->post("casino_adult")
        );
        $data["adult"] = $this->security->xss_clean(
            $this->input->post("adult")
        );
        $data["da"] = $this->security->xss_clean($this->input->post("da"));
        $data["pa"] = $this->security->xss_clean($this->input->post("pa"));
        $data["price_category"] = $this->security->xss_clean(
            $this->input->post("price_category")
        );
        $data["price"] = $this->security->xss_clean(
            $this->input->post("price")
        );
        $data["traffic"] = $this->security->xss_clean(
            $this->input->post("traffic")
        );
        $data["follow"] = $this->security->xss_clean(
            $this->input->post("follow")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        //$data['manual_date'] = date('Y-m-d');
        $data["site_update_date"] = time();
        $times = $this->db->get_where("tbl_olt", ["id" => $id])->row_array();
        $data["timestamp"] = $times["timestamp"];
        $data["sailing_price"] = $this->security->xss_clean(
            $this->input->post("sailing_price")
        );
        $data["contact"] = $vendor_info["email"];
        $data["contact_from"] = $vendor_info["contacted_from"];
        $data["discount"] = $this->security->xss_clean(
            $this->input->post("discount")
        );
        $data["web_category"] = $this->security->xss_clean(
            $this->input->post("web_category")
        );

        //$data['contact_from_id'] = $this->security->xss_clean($this->input->post('contact_from_id'));
        //$data['vendor_country'] = $this->security->xss_clean($this->input->post('vendor_country'));
        $data["phone_number"] = $vendor_info["phone"];
        $data["sample_url"] = $this->security->xss_clean(
            $this->input->post("sample_url")
        );
        $data["dr"] = $this->security->xss_clean($this->input->post("dr"));
        $data["spam_score"] = $this->security->xss_clean(
            $this->input->post("spam_score")
        );
        $data["tat"] = $this->security->xss_clean($this->input->post("tat"));
        $this->db->where("id", $id);
        $this->db->update("tbl_olt", $data);
        return $this->db->affected_rows();
    }

    public function site_info($id)
    {
        return $this->db->get_where("tbl_sites", ["id" => $id])->row_array();
    }

    public function language_site_info($id)
    {
        return $this->db->get_where("tbl_olt", ["id" => $id])->row_array();
    }

    /*This function adds new the user*/
    public function do_add_user()
    {
        $data = $this->input->post();
        if (isset($data["total_sale"])) {
            $r["total_sale"] = $data["total_sale"];
        }
        /*$permission['reports'] = [
		        'payment_received' => $data['payment_received'],
		        'payment_not_received' => $data['payment_not_received'],
		        'total_vendor_payment' => $data['total_vendor_payment'],
		        'vendor_payment_done' => $data['vendor_payment_done'],
		        'vendor_payment_remaining' => $data['vendor_payment_remaining'],
		        'profit_margin' => $data['profit_margin'],
		        'cancel_order' => $data['cancel_order'],
		        'not_publish' => $data['not_publish'],
		        'given_order' => $data['given_order'] 
		    ];
		    echo'<pre>';print_r($permission);die;*/
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["password"] = $this->security->xss_clean(
            hash("sha256", $this->input->post("password") . SALT)
        );
        $data["role"] = $this->security->xss_clean($this->input->post("role"));
        $data["timestamp"] = time();
        $this->db->insert("tbl_users", $data);
        return $this->db->insert_id();
    }

    /*This function updates the user details*/
    public function do_update_user($id)
    {
        $password = $this->security->xss_clean($this->input->post("password"));
        $check_password = $this->db
            ->get_where("tbl_users", ["password" => $password])
            ->row_array();
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        if (empty($check_password)) {
            $data["password"] = $this->security->xss_clean(
                hash("sha256", $this->input->post("password") . SALT)
            );
        }
        $data["role"] = $this->security->xss_clean($this->input->post("role"));
        $this->db->where("id", $id);
        $this->db->update("tbl_users", $data);
        return $this->db->affected_rows();
    }

    public function do_add_client()
    {
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["phone"] = $this->security->xss_clean(
            $this->input->post("phone")
        );
        $data["fb_id"] = $this->security->xss_clean(
            $this->input->post("fb_id")
        );
        $data["site_name"] = $this->security->xss_clean(
            $this->input->post("site_name")
        );
        $data["contacted_id"] = $this->security->xss_clean(
            $this->input->post("contacted_id")
        );
        $data["source"] = $this->security->xss_clean(
            $this->input->post("source")
        );
        $data["timestamp"] = time();
        $data["user_id"] = $this->session->user_id;
        $this->db->insert("tbl_clients", $data);
        return $this->db->insert_id();
    }

    public function do_update_client($id)
    {
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["phone"] = $this->security->xss_clean(
            $this->input->post("phone")
        );
        $data["fb_id"] = $this->security->xss_clean(
            $this->input->post("fb_id")
        );
        $data["site_name"] = $this->security->xss_clean(
            $this->input->post("site_name")
        );
        $data["contacted_id"] = $this->security->xss_clean(
            $this->input->post("contacted_id")
        );
        $data["source"] = $this->security->xss_clean(
            $this->input->post("source")
        );
        $data["timestamp"] = time();
        $this->db->where("id", $id);
        $this->db->update("tbl_clients", $data);
        return $this->db->affected_rows();
    }

    public function get_all_clients()
    {
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Manage"
        ) {
            $this->db->select("tbl_users.name as user_name, tbl_clients.*");
            $this->db->from("tbl_users");
            $this->db->join(
                "tbl_clients",
                "tbl_clients.user_id = tbl_users.id"
            );
            $result = $this->db->get();
            return $result->result_array();
        } else {
            $this->db->select("tbl_users.name as user_name, tbl_clients.*");
            $this->db->from("tbl_users");
            $this->db->where("tbl_clients.user_id", $this->session->user_id);
            $this->db->join(
                "tbl_clients",
                "tbl_clients.user_id = tbl_users.id"
            );
            $result = $this->db->get();
            return $result->result_array();
        }
    }

    public function get_all_clients_orders()
    {
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Manage" ||
            $this->session->role == "Salesperson"
        ) {
            $this->db->select("tbl_clients.name,tbl_clients.id");
            $this->db->from("tbl_clients");
            $result = $this->db->get();
            return $result->result_array();
        }
    }
    public function get_all_users()
    {
        return $this->db->get("tbl_users")->result_array();
    }

    public function do_add_vendor()
    {
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["phone"] = $this->security->xss_clean(
            $this->input->post("phone")
        );
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["vendor_bank_name"] = $this->security->xss_clean(
            $this->input->post("vendor_bank_name")
        );
        $data["bank_name"] = $this->security->xss_clean(
            $this->input->post("bank_ifsc")
        );
        $data["bank_ifsc"] = $this->security->xss_clean(
            $this->input->post("bank_name")
        );
        $data["paypal_id"] = $this->security->xss_clean(
            $this->input->post("paypal_id")
        );
        $data["skype_id"] = $this->security->xss_clean(
            $this->input->post("skype_id")
        );
        $data["upi_id"] = $this->security->xss_clean(
            $this->input->post("upi_id")
        );
        $data["account_number"] = $this->security->xss_clean(
            $this->input->post("account_number")
        );
        $data["user_id"] = $this->session->user_id;
        $data["timestamp"] = time();

        $this->db->insert("tbl_vendors", $data);
        return $this->db->insert_id();
    }

    public function do_add_vendor_api()
    {
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["phone"] = $this->security->xss_clean(
            $this->input->post("phone")
        );
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["vendor_bank_name"] = $this->security->xss_clean(
            $this->input->post("vendor_bank_name")
        );
        $data["bank_name"] = $this->security->xss_clean(
            $this->input->post("bank_ifsc")
        );
        $data["bank_ifsc"] = $this->security->xss_clean(
            $this->input->post("bank_name")
        );
        $data["paypal_id"] = $this->security->xss_clean(
            $this->input->post("paypal_id")
        );
        $data["skype_id"] = $this->security->xss_clean(
            $this->input->post("skype_id")
        );
        $data["upi_id"] = $this->security->xss_clean(
            $this->input->post("upi_id")
        );
        $data["account_number"] = $this->security->xss_clean(
            $this->input->post("account_number")
        );
        $data["user_id"] = $this->session->user_id;
        $data["timestamp"] = time();

        $this->db->insert("tbl_vendors", $data);
        return $this->db->insert_id();
    }

    public function do_update_vendor($id)
    {
        $data["name"] = $this->security->xss_clean($this->input->post("name"));
        $data["email"] = $this->security->xss_clean(
            $this->input->post("email")
        );
        $data["phone"] = $this->security->xss_clean(
            $this->input->post("phone")
        );
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["vendor_bank_name"] = $this->security->xss_clean(
            $this->input->post("vendor_bank_name")
        );
        $data["bank_name"] = $this->security->xss_clean(
            $this->input->post("bank_ifsc")
        );
        $data["bank_ifsc"] = $this->security->xss_clean(
            $this->input->post("bank_name")
        );
        $data["account_number"] = $this->security->xss_clean(
            $this->input->post("account_number")
        );
        $data["paypal_id"] = $this->security->xss_clean(
            $this->input->post("paypal_id")
        );
        $data["paypal_id"] = $this->security->xss_clean(
            $this->input->post("paypal_id")
        );
        $data["skype_id"] = $this->security->xss_clean(
            $this->input->post("skype_id")
        );
        $data["timestamp"] = time();

        $this->db->where("id", $id);
        $this->db->update("tbl_vendors", $data);
        return $this->db->affected_rows();
    }
    public function get_all_vendors()
    {
        /*if($this->session->role!=='Admin'){
		        $this->db->limit(10);
		    }*/
        $this->db->select("tbl_users.name as user_name,tbl_vendors.*");
        $this->db->from("tbl_users");
        $this->db->join("tbl_vendors", "tbl_vendors.user_id = tbl_users.id");
        $result = $this->db->get();
        return $result->result_array();

        //$this->db->order_by('id','DESC');
        //return $this->db->get('tbl_vendors')->result_array();
    }

    public function get_all_vendors_operate()
    {
        $this->db->select("tbl_vendors.name");
        $this->db->from("tbl_vendors");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function do_add_order()
    {
        $data["client_name"] = $this->security->xss_clean(
            $this->input->post("client_name")
        );
        $data["order_number"] = $this->security->xss_clean(
            $this->input->post("order_number")
        );
        //$data['client_email'] = $this->security->xss_clean($this->input->post('client_email'));
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["client_email"] = $this->security->xss_clean(
            $this->input->post("client_email")
        );
        $data["order_date"] = $this->security->xss_clean(
            $this->input->post("order_date")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        $data["payment_remark"] = $this->security->xss_clean(
            $this->input->post("payment_remark")
        );
        $datas["websites"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $datas["proposed_amounts"] = $this->security->xss_clean(
            $this->input->post("proposed_amount")
        );
        $datas["content_amount"] = $this->security->xss_clean(
            $this->input->post("content_amount")
        );
        $datas["site_type"] = $this->security->xss_clean(
            $this->input->post("site_type")
        );
        $datas["website_remark"] = $this->security->xss_clean(
            $this->input->post("website_remark")
        );
        $data["user_id"] = $this->session->user_id;
        $data["vendor_payment_status"] = "Unpaid";
        //$imagename = '';
        //echo '<pre>';print_r($datas['websites']);die;
        foreach ($datas["websites"] as $key => $value) {
            $data["website"] = $datas["websites"][$key];
            $this->db->order_by("price", "ASC");
            $web_info = $this->db
                ->get_where("tbl_sites", [
                    "website" => $datas["websites"][$key],
                    "web_category!=" => "Lost Sites",
                ])
                ->row_array();
            if (empty($web_info)) {
                $web_info = $this->db
                    ->get_where("tbl_olt", [
                        "website" => $datas["websites"][$key],
                        "web_category!=" => "Lost Sites",
                    ])
                    ->row_array();
            }
            $vendor_info = $this->db
                ->get_where("tbl_vendors", ["id" => $web_info["person_id"]])
                ->row_array();
            //print_r($web_info);die;
            if (
                !empty($_POST["imports_file"]) &&
                isset($_FILES["imports_file"]["name"][$key])
            ) {
                $ext = explode(".", $_FILES["imports_file"]["name"][$key]);
                $ext = end($ext);
                $imgname = time();
                $imagename = $data["website"] . $imgname . $key . "." . $ext;
                $_FILES["file"]["name"] = $imagename;
                $_FILES["file"]["type"] = $_FILES["imports_file"]["type"][$key];
                $_FILES["file"]["tmp_name"] =
                    $_FILES["imports_file"]["tmp_name"][$key];
                $_FILES["file"]["error"] =
                    $_FILES["imports_file"]["error"][$key];
                $_FILES["file"]["size"] = $_FILES["imports_file"]["size"][$key];
                $config["upload_path"] = "./imports/";
                $config["allowed_types"] = "*";
                //$config['file_name'] = $imagename;
                $this->load->library("upload", $config);
                if (!$this->upload->do_upload("file")) {
                    echo "failed to upload file(s)";
                } else {
                    $data["content_doc"] = $imagename;
                }
            }
            $data["vendor_name"] = $vendor_info["name"];
            $data["vendor_email"] = $vendor_info["email"];
            $data["vendor_contacted_from"] = $vendor_info["contacted_from"];
            if ($datas["site_type"][$key] == "Casino") {
                $data["site_cost"] = $web_info["casino_adult"];
            } elseif ($datas["site_type"][$key] == "Adult") {
            } elseif ($datas["site_type"][$key] == "CBD") {
                $data["site_cost"] = $web_info["cbd_price"];
            } else {
                $data["site_cost"] = $web_info["price"];
            }
            $data["proposed_amount"] = $datas["proposed_amounts"][$key];
            $data["content_amount"] = $datas["content_amount"][$key];
            $data["website_remark"] = $datas["website_remark"][$key];
            $data["site_type"] = $datas["site_type"][$key];
            $cpc = $datas["site_type"][$key];
            $webs = $data["website"];
            //echo '<pre>';print_r($vendor_info);die;
            if (
                $data["site_type"] == "Normal" &&
                $web_info["web_category"] != "Lost Sites" &&
                $web_info["website"] != "" &&
                !empty($vendor_info["id"])
            ) {
                //echo '<pre>';print_r('sujeet');die;
                $this->db->insert("tbl_orders", $data);
            } elseif (
                $data["site_cost"] > 0 &&
                $web_info["web_category"] != "Lost Sites" &&
                $web_info["website"] != "" &&
                !empty($vendor_info["id"])
            ) {
                //echo '<pre>';print_r('Kar');die;
                $this->db->insert("tbl_orders", $data);
            } else {
                return "fals";
            }
        }
        return $this->db->insert_id();
    }
    public function get_all_orders()
    {
        $data = $this->input->post();
        if (!empty($data)) {
            if (!empty($data["contacted_from"])) {
                $this->db->where("contacted_from", $data["contacted_from"]);
            }
            if (!empty($data["added_by"])) {
                $this->db->where("tbl_orders.user_id", $data["added_by"]);
            }
            if (!empty($data["status"])) {
                $this->db->where(
                    "client_amount_received_status",
                    $data["status"]
                );
            }
			if (!empty($data["payment_status"])) {
                $this->db->where("client_amount_received_status", $data["payment_status"]);
            }
			if (!empty($data["order_number_starting"])) {
                $this->db->where("order_number>=", $data["order_number_starting"]);
            }
			if (!empty($data["order_number_ending"])) {
                $this->db->where("order_number<=", $data["order_number_ending"]);
            }
            if (!empty($data["oclient_name"])) {
                $this->db->where("client_name", $data["oclient_name"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] != "All") {
                $this->db->where("status", $data["orderstatus"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] == "All") {
                $this->db->where("status!=", ""); //echo'<pre>';print_r($data);die;
            }
            if (!empty($data["client_name"])) {
                foreach ($data["client_name"] as $client) {
                    $this->db->or_where("client_name", $client);
                }
            }
            if (!empty($data["vendor_name"])) {
                foreach ($data["vendor_name"] as $vend) {
                    $this->db->or_where("vendor_name", $vend);
                }
            }
            if (!empty($data["from_date"]) && !empty($data["to_date"])) {
                $this->db->where("order_date>=", $data["from_date"]);
                $this->db->where("order_date<=", $data["to_date"]);
            }
            if (!empty($data["assign_date"])) {
                $this->db->where("assign_date", $data["assign_date"]);
            }
            if (!empty($data["publish_date"])) {
                $this->db->where("publish_date", $data["publish_date"]);
            }
            if (!empty($data["vendor_payment_status"])) {
                if ($data["vendor_payment_status"] == "Unpaid") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                } elseif ($data["vendor_payment_status"] == "UnpaidC") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                    $this->db->where("vendor_payment_status!=", "Cancel");
                } else {
                    $this->db->where(
                        "vendor_payment_status",
                        $data["vendor_payment_status"]
                    );
                }
            }
        } else {
            $this->db->where("status!=", "Cancel");
            $this->db->where("status!=", "Not_Publish");
        }

        $this->db->select("tbl_clients.name as clients_name,tbl_orders.*,tbl_users.name as user_name");
        $this->db->from("tbl_clients");
        if (
            $this->session->role !== "Admin" &&
            $this->session->role !== "Manage" &&
            $this->session->role !== "Finance"
        ) {
            $this->db->where("tbl_orders.user_id", $this->session->user_id);
        }

        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
		$this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
        $result = $this->db->get();
        return $result->result_array();
    }

	public function get_all_orders_main()
    {
        $data = $this->input->post();
        if (!empty($data)) {
            if (!empty($data["contacted_from"])) {
                $this->db->where("contacted_from", $data["contacted_from"]);
            }
            if (!empty($data["added_by"])) {
                $this->db->where("tbl_orders.user_id", $data["added_by"]);
            }
            if (!empty($data["status"])) {
                $this->db->where(
                    "client_amount_received_status",
                    $data["status"]
                );
            }
            if (!empty($data["oclient_name"])) {
                $this->db->where("client_name", $data["oclient_name"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] != "All") {
                $this->db->where("status", $data["orderstatus"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] == "All") {
                $this->db->where("status!=", ""); //echo'<pre>';print_r($data);die;
            }
            if (!empty($data["client_name"])) {
                foreach ($data["client_name"] as $client) {
                    $this->db->or_where("client_name", $client);
                }
            }
            if (!empty($data["vendor_name"])) {
                foreach ($data["vendor_name"] as $vend) {
                    $this->db->or_where("vendor_name", $vend);
                }
            }
            if (!empty($data["from_date"]) && !empty($data["to_date"])) {
                $this->db->where("order_date>=", $data["from_date"]);
                $this->db->where("order_date<=", $data["to_date"]);
            }
            if (!empty($data["assign_date"])) {
                $this->db->where("assign_date", $data["assign_date"]);
            }
			if (!empty($data["indexStatus"] && $data["indexStatus"] == 'Yes')) {
                $this->db->where("indexed_url!=",' ');
            }
			if (!empty($data["indexStatus"] && $data["indexStatus"] == 'No')) {
                $this->db->where("indexed_url",' ');
            }
            if (!empty($data["publish_date"])) {
                $this->db->where("publish_date", $data["publish_date"]);
            }
            if (!empty($data["vendor_payment_status"])) {
                if ($data["vendor_payment_status"] == "Unpaid") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                } elseif ($data["vendor_payment_status"] == "UnpaidC") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                    $this->db->where("vendor_payment_status!=", "Cancel");
                } else {
                    $this->db->where(
                        "vendor_payment_status",
                        $data["vendor_payment_status"]
                    );
                }
            }
        } else {
            $this->db->where("status!=", "Cancel");
            $this->db->where("status!=", "Not_Publish");
        }

        $this->db->select("tbl_clients.name as clients_name,tbl_orders.id,tbl_orders.order_number,tbl_orders.client_amount_received_status,tbl_orders.invoice_no,tbl_orders.client_email,tbl_orders.order_date,tbl_orders.status,tbl_orders.contacted_from,tbl_orders.website,tbl_orders.indexed_url,tbl_orders.proposed_amount,tbl_orders.content_amount,tbl_orders.site_cost,tbl_orders.assign_date,tbl_orders.publish_date,tbl_orders.publish_url,tbl_orders.remark,tbl_orders.website_remark,tbl_orders.payment_remark,tbl_orders.content_doc,tbl_users.name as user_name");
        $this->db->from("tbl_clients");
        if (
            $this->session->role !== "Admin" &&
            $this->session->role !== "Manage" &&
            $this->session->role !== "Finance"
        ) {
            $this->db->where("tbl_orders.user_id", $this->session->user_id);
        }

        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
		$this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
        $result = $this->db->get();
        return $result->result_array();
    }
	
	public function get_all_orders_vendorp()
    {
        $data = $this->input->post();
        if (!empty($data)) {
            if (!empty($data["contacted_from"])) {
                $this->db->where("contacted_from", $data["contacted_from"]);
            }
            if (!empty($data["added_by"])) {
                $this->db->where("tbl_orders.user_id", $data["added_by"]);
            }
            if (!empty($data["status"])) {
                $this->db->where(
                    "client_amount_received_status",
                    $data["status"]
                );
            }
            if (!empty($data["oclient_name"])) {
                $this->db->where("client_name", $data["oclient_name"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] != "All") {
                $this->db->where("status", $data["orderstatus"]);
            }
            if (!empty($data["orderstatus"]) && $data["orderstatus"] == "All") {
                $this->db->where("status!=", ""); //echo'<pre>';print_r($data);die;
            }
            if (!empty($data["client_name"])) {
                foreach ($data["client_name"] as $client) {
                    $this->db->or_where("client_name", $client);
                }
            }
            if (!empty($data["vendor_name"])) {
                foreach ($data["vendor_name"] as $vend) {
                    $this->db->or_where("vendor_name", $vend);
                }
            }
            if (!empty($data["from_date"]) && !empty($data["to_date"])) {
                $this->db->where("order_date>=", $data["from_date"]);
                $this->db->where("order_date<=", $data["to_date"]);
            }
            if (!empty($data["assign_date"])) {
                $this->db->where("assign_date", $data["assign_date"]);
            }
            if (!empty($data["publish_date"])) {
                $this->db->where("publish_date", $data["publish_date"]);
            }
            if (!empty($data["vendor_payment_status"])) {
                if ($data["vendor_payment_status"] == "Unpaid") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                } elseif ($data["vendor_payment_status"] == "UnpaidC") {
                    $this->db->where([
                        "publish_url!=" => "",
                        "vendor_payment_status!=" => "Paid",
                    ]);
                    $this->db->where("vendor_payment_status!=", "Cancel");
                } else {
                    $this->db->where(
                        "vendor_payment_status",
                        $data["vendor_payment_status"]
                    );
                }
            }
        } else {
            $this->db->where("status!=", "Cancel");
            $this->db->where("status!=", "Not_Publish");
        }

        $this->db->select("tbl_clients.name as clients_name,tbl_orders.id,tbl_orders.order_number,tbl_orders.client_amount_received_status,tbl_orders.vendor_payment_status,tbl_orders.client_email,tbl_orders.site_cost,tbl_orders.vendor_payment_date,tbl_orders.vendor_transaction_id,tbl_orders.actual_paid_amount,tbl_orders.vendor_email,tbl_orders.publish_url,tbl_orders.publish_date,tbl_orders.actual_paid_amount,tbl_orders.client_amount_received_status,tbl_orders.vendor_invoice_status,tbl_orders.vendor_transaction_id,tbl_orders.paypal_id,tbl_orders.vendor_name,tbl_users.name as user_name");
        $this->db->from("tbl_clients");
        if (
            $this->session->role !== "Admin" &&
            $this->session->role !== "Manage" &&
            $this->session->role !== "Finance"
        ) {
            $this->db->where("tbl_orders.user_id", $this->session->user_id);
        }

        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
		$this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_orders_ven()
    {
        $data = $this->input->post();

        if (!empty($data)) {
            //print_r($data);die;
            if (!empty($data["order_number_starting"])) {
                $this->db->where("order_number", $data["order_number_starting"]);
            }
			if (!empty($data["order_number_ending"])) {
                $this->db->where("order_number", $data["order_number_ending"]);
            }
			if (!empty($data["added_by"])) {
                $this->db->where("user_id", $data["added_by"]);
            }
            if (!empty($data["status"]) && $data["status"] != "All") {
                $this->db->where("status", $data["status"]);
            }
            if (!empty($data["status"]) && $data["status"] == "All") {
                $this->db->where("status!=", ""); //echo'<pre>';print_r($data);die;
            }
            if (!empty($data["client_name"])) {
                $this->db->where("client_name", $data["client_name"]);
            }
            if (!empty($data["vendor_name"])) {
                $this->db->where("vendor_name", $data["vendor_name"]);
            }
            if (!empty($data["order_date"])) {
                $this->db->where("order_date", $data["order_date"]);
            }
            if (!empty($data["assign_date"])) {
                $this->db->where("assign_date", $data["assign_date"]);
            }
            if (!empty($data["publish_date"])) {
                $this->db->where("publish_date", $data["publish_date"]);
            }
        } else {
			$this->db->where("client_amount_received_status!=", "Received");
            $this->db->where("status!=", "Cancel");
            $this->db->where("status!=", "Not_Publish");
        }
		
        $this->db->select(
            "tbl_clients.name as clients_name,tbl_orders.client_amount_received_status,tbl_orders.discounted_amount,tbl_orders.client_amount_received_status,tbl_orders.status,tbl_orders.assign_date,tbl_orders.publish_date,tbl_orders.publish_url,tbl_orders.vendor_website_ramark,tbl_orders.id,tbl_orders.order_number,tbl_orders.order_date,tbl_orders.indexed_url,tbl_orders.website,tbl_orders.website_type,tbl_orders.vendor_name,tbl_orders.vendor_email,tbl_orders.vendor_contacted_from,tbl_orders.remark,tbl_orders.site_cost,tbl_orders.vendor_payment_status,tbl_users.name as user_name,tbl_vendors.vendor_bank_name,tbl_vendors.bank_name,tbl_vendors.bank_ifsc,tbl_vendors.account_number,tbl_vendors.paypal_id,tbl_vendors.skype_id,tbl_vendors.upi_id"
        );
        //$this->db->select('tbl_orders.id as ids');
        //$this->db->distinct();
		
        $this->db->from("tbl_clients");
        if (
            $this->session->role !== "Admin" &&
            $this->session->role !== "Manage" &&
            $this->session->role !== "Operator" &&
            $this->session->role !== "Finance"
        ) {
            $this->db->where("tbl_orders.user_id", $this->session->user_id);
        }

        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
        $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
        //$this->db->join('tbl_sites', 'tbl_sites.website = tbl_orders.website','left');
        $this->db->join(
            "tbl_vendors",
            "tbl_vendors.email = tbl_orders.vendor_email AND tbl_vendors.contacted_from = tbl_orders.vendor_contacted_from",
            "left"
        );
        $result = $this->db->get();
        return $result->result_array();

        //$this->db->order_by('id','DESC');
        //return $this->db->get('tbl_orders')->result_array();
    }

    public function get_all_orders_for_reports()
    {
        $data = $this->input->post();
        //echo '<pre>';print_r($data);die;
        if (!empty($data["period"])) {
            //$skdate = date("Y-m-d", strtotime("-1 months", $now))
            $skdate = date(
                "Y-m-d",
                strtotime("-" . $data["period"] . " months")
            );
            //echo '<pre>';print_r($skdate);die;
            $this->db->where("order_date >=", $skdate);
        } elseif (!empty($data)) {
            //print_r($data);die;
            if (!empty($data["start_date"]) && !empty($data["end_date"])) {
                $this->db->where("order_date >=", $data["start_date"]);
                $this->db->where("order_date <=", $data["end_date"]);
            }
            if (!empty($data["month"])) {
                $query_date = date("Y") . "-" . date($data["month"]);
                $date_first = date("Y-m-01", strtotime($query_date));
                $date_last = date("Y-m-t", strtotime($query_date));
                $this->db->where("order_date >=", $date_first);
                $this->db->where("order_date <=", $date_last);
            }
        } else {
            $d = new DateTime("first day of this month");
            $first_day_of_month = $d->format("Y-m-d");
            $current_date = date("Y-m-d");
            $this->db->where("order_date >=", $first_day_of_month);
            $this->db->where("order_date <=", $current_date);
        }
        $this->db->where("tbl_orders.status!=", "Cancel");
        $this->db->select("tbl_clients.name as clients_name,tbl_orders.*");
        $this->db->from("tbl_clients");
        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
        $result = $this->db->get();
        return $result->result_array();

        //$this->db->order_by('id','DESC');
        //return $this->db->get('tbl_orders')->result_array();
    }

    public function get_all_orders_for_report_list(
        $target,
        $month,
        $start_date,
        $end_date
    ) {
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where("order_date >=", $start_date);
            $this->db->where("order_date <=", $end_date);
        } elseif (!empty($month)) {
            $query_date = date("Y") . "-" . date($month);
            $date_first = date("Y-m-01", strtotime($query_date));
            $date_last = date("Y-m-t", strtotime($query_date));
            $this->db->where("order_date >=", $date_first);
            $this->db->where("order_date <=", $date_last);
        }
        if ($target == "pr") {
            $this->db->where("client_amount_received_status", "Received");
        } elseif ($target == "pn") {
            $this->db->where("client_amount_received_status", "Not_Received");
            $this->db->where("status!=", "Cancel");
        } elseif ($target == "vp") {
            $this->db->where("vendor_payment_status", "Paid");
            $this->db->where("vendor_payment_amount!=", "0");
        } elseif ($target == "vpn") {
            $this->db->where("vendor_payment_status!=", "Paid");
        }
        $this->db->select("tbl_clients.name as clients_name,tbl_orders.*");
        $this->db->from("tbl_clients");
        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_orders_number()
    {
        $this->db->select("order_number");
        $this->db->distinct("order_number");
        return $this->db->get("tbl_orders")->result_array();
    }

    public function get_all_orders_contacted_from()
    {
        $this->db->select("contacted_from");
        $this->db->distinct("contacted_from");
        return $this->db->get("tbl_orders")->result_array();
    }

    public function get_all_orders_added_by()
    {
        $this->db->select("name,id");
        $this->db->where("role", "Salesperson");
        return $this->db->get("tbl_users")->result_array();
    }

    public function get_single_order($id)
    {
        $result = $this->db->get_where("tbl_orders", ["id" => $id]);
        return $result->row_array();
    }

    public function do_update_order($id)
    {
        $data["assign_date"] = $this->security->xss_clean(
            $this->input->post("assign_date")
        );
		$data["indexed_url"] = $this->security->xss_clean(
            $this->input->post("indexed_url")
        );
        $data["publish_date"] = $this->security->xss_clean(
            $this->input->post("publish_date")
        );
        //$data['client_email'] = $this->security->xss_clean($this->input->post('client_email'));
        $data["publish_url"] = $this->security->xss_clean(
            $this->input->post("publish_url")
        );
        $data["ordered_updated_by"] = $this->session->user_id;
        $data["status"] = $this->security->xss_clean(
            $this->input->post("status")
        );
        $data["vendor_website_ramark"] = $this->security->xss_clean(
            $this->input->post("vendor_website_ramark")
        );
        if ($data["status"] == "Cancel") {
            $data["vendor_payment_status"] = "Cancel";
        }
        $vendor_data = $this->db
            ->get_where("tbl_vendors", [
                "id" => $this->input->post("vendor_id"),
            ])
            ->row_array();
        if (!empty($vendor_data)) {
            $data["vendor_contacted_from"] = $vendor_data["contacted_from"];
            $data["vendor_email"] = $vendor_data["email"];
            $data["vendor_name"] = $vendor_data["name"];
        }

        $CP = $this->security->xss_clean($this->input->post("cost_price"));
        if (!empty($CP)) {
            $data["site_cost"] = $CP;
			$data["discounted_amount"] = $this->input->post("discount_price");
			$order_data = $this->db->get_where("tbl_orders", ["id" => $id])->row_array();
			$this->db->where('person_id',$this->input->post("vendor_id"));
			$this->db->where('website',$order_data["website"]);
			$this->db->update('tbl_sites',['availability' => 'yes']);
			//echo '<pre>';print_r($order_data);die;
        }

        //echo '<pre>';print_r($data);die;
        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function order_deletion($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_orders");
        return $this->db->affected_rows();
    }
    public function order_info($id)
    {
        $this->db->select("tbl_clients.name as clients_name,tbl_orders.*");
        $this->db->from("tbl_clients");
        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
        $this->db->where("tbl_orders.id", $id);
        $result = $this->db->get();
        return $result->row_array();
        //return $this->db->get_where('tbl_orders',['id'=>$id])->row_array();
    }

    public function order_last_id()
    {
        $this->db->select("order_number");
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        return $this->db->get_where("tbl_orders")->row_array();
    }

    public function do_updation_order($id)
    {
        $data["client_name"] = $this->security->xss_clean(
            $this->input->post("client_name")
        );
        $data["client_email"] = $this->security->xss_clean(
            $this->input->post("client_email")
        );
        //$data['client_email'] = $this->security->xss_clean($this->input->post('client_email'));
        $data["order_number"] = $this->security->xss_clean(
            $this->input->post("order_number")
        );
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["order_date"] = $this->security->xss_clean(
            $this->input->post("order_date")
        );
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["payment_remark"] = $this->security->xss_clean(
            $this->input->post("payment_remark")
        );
        $data["invoice_no"] = $this->security->xss_clean(
            $this->input->post("invoice_no")
        );
        if (isset($_FILES["imports_file"]["name"])) {
            $ext = explode(".", $_FILES["imports_file"]["name"]);
            $ext = end($ext);
            if (!empty($ext)) {
                $imgname = time();
                $imagename = $data["website"] . $imgname . "." . $ext;
                $_FILES["file"]["name"] = $imagename;
                $_FILES["file"]["type"] = $_FILES["imports_file"]["type"];
                $_FILES["file"]["tmp_name"] =
                    $_FILES["imports_file"]["tmp_name"];
                $_FILES["file"]["error"] = $_FILES["imports_file"]["error"];
                $_FILES["file"]["size"] = $_FILES["imports_file"]["size"];
                $config["upload_path"] = "./imports/";
                $config["allowed_types"] = "*";
                //$config['file_name'] = $imagename;
                $this->load->library("upload", $config);
                if (!$this->upload->do_upload("file")) {
                    echo "failed to upload file(s)";
                } else {
                    $data["content_doc"] = $imagename;
                }
            }
        }
        //echo '<pre>';print_r($data);die;
        if (!empty($data["website"])) {
            $this->db->order_by("price", "ASC");
            $row_data = $this->db
                ->get_where("tbl_sites", ["website" => $data["website"]])
                ->row_array();
            //echo '<pre>';print_r($row_data);die;
            $vendor_data = $this->db
                ->get_where("tbl_vendors", ["id" => $row_data["person_id"]])
                ->row_array();
            $data["site_cost"] = $row_data["price"];
            $data["vendor_name"] = $vendor_data["name"];
            $data["vendor_email"] = $vendor_data["email"];
            $data["vendor_contacted_from"] = $vendor_data["contacted_from"];
        }
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );
        $data["proposed_amount"] = $this->security->xss_clean(
            $this->input->post("proposed_amount")
        );
        $data["website_remark"] = $this->security->xss_clean(
            $this->input->post("website_remark")
        );
        $data["content_amount"] = $this->security->xss_clean(
            $this->input->post("content_amount")
        );

        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function do_updation_orders($id)
    {
        $data["client_name"] = $this->security->xss_clean(
            $this->input->post("client_name")
        );
        $data["client_email"] = $this->security->xss_clean(
            $this->input->post("client_email")
        );
        //$data['client_email'] = $this->security->xss_clean($this->input->post('client_email'));
        $data["order_number"] = $this->security->xss_clean(
            $this->input->post("order_number")
        );
        $data["contacted_from"] = $this->security->xss_clean(
            $this->input->post("contacted_from")
        );
        $data["order_date"] = $this->security->xss_clean(
            $this->input->post("order_date")
        );
        $data["website"] = $this->security->xss_clean(
            $this->input->post("website")
        );
        $data["remark"] = $this->security->xss_clean(
            $this->input->post("remark")
        );

        $data["proposed_amount"] = $this->security->xss_clean(
            $this->input->post("proposed_amount")
        );
        $data["website_remark"] = $this->security->xss_clean(
            $this->input->post("website_remark")
        );
        $data["content_amount"] = $this->security->xss_clean(
            $this->input->post("content_amount")
        );
        $data["client_amount_received"] = $this->security->xss_clean(
            $this->input->post("client_amount_received")
        );
        $data["client_amount_received_date"] = $this->security->xss_clean(
            $this->input->post("client_amount_received_date")
        );
        $data["client_amount_received_status"] = $this->security->xss_clean(
            $this->input->post("client_amount_received_status")
        );
        $data["client_account_type"] = $this->security->xss_clean(
            $this->input->post("client_account_type")
        );
        $data["client_account_id"] = $this->security->xss_clean(
            $this->input->post("client_account_id")
        );
        $data["vendor_payment_amount"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_amount")
        );
        $data["vendor_payment_date"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_date")
        );
        $data["vendor_payment_status"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_status")
        );
        $data["vendor_transaction_id"] = $this->security->xss_clean(
            $this->input->post("vendor_transaction_id")
        );
        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function get_all_websites()
    {
        $this->db->select("id,website");
        $data = $this->db->get("tbl_sites")->result_array();
        $this->db->select("website,person");
        $datas = $this->db->get("tbl_olt")->result_array();
        $result = array_merge($data, $datas);
        return $result;
    }

    public function get_all_websitess()
    {
        $this->db->select("id,website");
        $this->db->where("id>", 2004);
        return $this->db->get("tbl_sites")->result_array();
    }

    public function vendor_info($id)
    {
        return $this->db->get_where("tbl_vendors", ["id" => $id])->row_array();
    }

    public function client_info($id)
    {
        return $this->db->get_where("tbl_clients", ["id" => $id])->row_array();
    }
    public function user_infor($id)
    {
        return $this->db->get_where("tbl_users", ["id" => $id])->row_array();
    }

    public function vendor_id()
    {
        $this->db->limit(1);
        $this->db->order_by("id", "DESC");
        $this->db->select("id");
        $this->db->where("user_id", $this->session->user_id);
        return $this->db->get_where("tbl_vendors")->row_array();
    }

    public function client_deletion($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_clients");
        return $this->db->affected_rows();
    }
    public function user_deletion($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_users");
        return $this->db->affected_rows();
    }
    public function vendor_deletion($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_vendors");
        return $this->db->affected_rows();
    }

    public function find_email($id)
    {
        return $this->db->get_where("tbl_clients", ["id" => $id])->row_array();
    }

    public function do_update_payment($id)
    {
        $data["actual_received_amount"] = $this->security->xss_clean(
            $this->input->post("actual_received_amount")
        );
        $data["client_amount_received"] = $this->security->xss_clean(
            $this->input->post("client_amount_received")
        );
        $data["client_amount_received_date"] = $this->security->xss_clean(
            $this->input->post("client_amount_received_date")
        );
        $data["client_amount_received_status"] = $this->security->xss_clean(
            $this->input->post("client_amount_received_status")
        );
        $data["client_account_type"] = $this->security->xss_clean(
            $this->input->post("client_account_type")
        );
        $data["client_account_id"] = $this->security->xss_clean(
            $this->input->post("client_account_id")
        );
        $payment_status = $this->db
            ->get_where("tbl_orders", ["id" => $id])
            ->row_array();
        if ($payment_status["client_amount_received_status"] == "Received") {
            $this->send_data_n8n($id);
        }
        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function send_data_n8n($id)
    {
        $data = $this->db->get_where("tbl_orders", ["id" => $id])->row_array();
        $date = explode("/", $data["assign_date"]);
        $date1 = explode("/", $data["publish_date"]);
        $date2 = explode("/", $data["client_amount_received_date"]);
        $date3 = explode("/", $data["vendor_payment_date"]);
        $data["assign_date"] = $date[2] . "-" . $date[1] . "-" . $date[0];
        $data["publish_date"] = $date1[2] . "-" . $date1[1] . "-" . $date1[0];
        $data["client_amount_received_date"] =
            $date2[2] . "-" . $date2[1] . "-" . $date2[0];
        $data["vendor_payment_date"] =
            $date3[2] . "-" . $date3[1] . "-" . $date3[0];
        //$json_data = json_encode($data);
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://n8n.emiactech.com/webhook-test/739ae735-dc8a-47f6-91f0-4ea47c499025"
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        //echo '<pre>'; print_r($data);die;
    }

    public function do_update_vendor_payment($id)
    {
        $data["actual_paid_amount"] = $this->security->xss_clean(
            $this->input->post("actual_paid_amount")
        );
        $data["vendor_payment_amount"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_amount")
        );
        $data["vendor_transaction_id"] = $this->security->xss_clean(
            $this->input->post("vendor_transaction_id")
        );
        $data["vendor_payment_date"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_date")
        );
        $data["vendor_payment_status"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_status")
        );
        $data["vendor_invoice_status"] = $this->security->xss_clean(
            $this->input->post("vendor_invoice_status")
        );
        //print_r($data);die;
        $data["paypal_id"] = $this->security->xss_clean(
            $this->input->post("paypal_id")
        );
        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function get_extensions()
    {
        return $this->db->get("save_passowrd")->result_array();
    }

    // new vedore sites added
    public function get_all_ms($all)
    {
        $data = $this->input->post();
        //print_r($data);die;
        /*if($data['start_price'] > 0){
			    print_r($data);die;
			}*/
        if (!empty($data)) {
            if (!empty($data["per_category"])) {
                if (!empty($data["niche_choice"])) {
                    $this->db->where("category", $data["per_category"]);
                } else {
                    $this->db->like("category", $data["per_category"]);
                }
            }
            if (!empty($data["price_category"])) {
                $this->db->where_in("price_category", $data["price_category"]);
            }
            if (!empty($data["per_name"])) {
                $this->db->where("vendor_name", $data["per_name"]);
            }
            if (
                is_numeric($data["start_price"]) &&
                is_numeric($data["end_price"])
            ) {
                $this->db->where("price>=", $data["start_price"]);
                $this->db->where("price<=", $data["end_price"]);
            }
            if (
                !empty($data["start_selling_price"]) &&
                !empty($data["end_selling_price"])
            ) {
                $this->db->where(
                    "sailing_price>=",
                    $data["start_selling_price"]
                );
                $this->db->where("sailing_price<=", $data["end_selling_price"]);
            }
            if (!empty($data["from_traffic"]) && !empty($data["to_traffic"])) {
                $this->db->where("ahref_traffic>=", $data["from_traffic"]);
                $this->db->where("ahref_traffic<=", $data["to_traffic"]);
            }
            if (!empty($data["start_da"])) {
                $this->db->where("da>=", $data["start_da"]);
                $this->db->where("da<=", $data["end_da"]);
            }
            if (!empty($data["web_category"])) {
                $this->db->where("web_category", $data["web_category"]);
            }

            if (!empty($data["contact_from_id"])) {
                $this->db->where("contact_from_id", $data["contact_from_id"]);
            }
            if (!empty($data["vendor_country"])) {
                $this->db->like("sitename", $data["vendor_country"]);
            }
        } elseif (empty($all)) {
            $this->db->limit(50);
        }

        if (empty($data["duplicate"])) {
            $this->db->group_by(["sitename"]);
        }

        //$this->db->order_by('price','DESC');
        //$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
        //$this->db->from('tbl_vendors');
        //$this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
        //$this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
        // $result = $this->db->get();
        $result = $this->db->get_where("tbl_master_sites");
        return $result->result_array();
        //return $this->db->get('tbl_sites')->result_array();
    }

    public function get_all_ss()
    {
        $client_name = $this->input->post("client_name");
        $comunication_id = $this->input->post("communication_id");
        $this->db->where("client_name", $client_name);
        $this->db->where("communication_id", $comunication_id);
        if ($this->session->role == "Admin") {
            $this->db->select("tbl_users.name as user_name, sent_sites.*");
            $this->db->from("sent_sites");
            $this->db->join("tbl_users", "tbl_users.id = sent_sites.added_by");
            $result = $this->db->get();
            return $result->result_array();
        } else {
            $this->db->where("added_by", $this->session->user_id);
            $this->db->select("tbl_users.name as user_name, sent_sites.*");
            $this->db->from("sent_sites");
            $this->db->join("tbl_users", "tbl_users.id = sent_sites.added_by");
            $result = $this->db->get();
            return $result->result_array();
        }
    }

    public function get_all_orders_client()
    {
        $client_name = $this->input->post("client_name");
        $contacted_from = $this->input->post("contacted_from");
        $this->db->where("client_name", $client_name);
        $this->db->where("contacted_from", $contacted_from);
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Salesperson"
        ) {
            $this->db->select(
                "tbl_users.name as user_name, tbl_clients.name as cname,tbl_orders.*"
            );
            $this->db->from("tbl_clients");
            $this->db->join(
                "tbl_orders",
                "tbl_orders.client_name = tbl_clients.id"
            );
            $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
            $result = $this->db->get();
            //echo'<pre>';print_r($result->result_array());die;
            return $result->result_array();
        }
    }

    public function get_all_orders_vendor()
    {
        $vendor_name = $this->input->post("vendor_email");
        $contacted_from = $this->input->post("contacted_from");
        $this->db->where("vendor_email", $vendor_name);
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Manage"
        ) {
            $this->db->select(
                "tbl_users.name as user_name, tbl_vendors.name as cname,tbl_orders.*"
            );
            $this->db->from("tbl_vendors");
            $this->db->join(
                "tbl_orders",
                "tbl_orders.vendor_email = tbl_vendors.email"
            );
            $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
            $result = $this->db->get();
            //echo'<pre>';print_r($result->result_array());die;
            return $result->result_array();
        }
    }

    public function get_all_send_sites()
    {
        if ($this->session->role == "Admin") {
            $this->db->group_by(["client_name", "communication_id"]);
            $this->db->select(
                "tbl_users.name as user_name, sent_sites.*,COUNT(sent_sites.communication_id) as total"
            );
            $this->db->from("sent_sites");
            $this->db->join("tbl_users", "tbl_users.id = sent_sites.added_by");
            $result = $this->db->get();
            return $result->result_array();
        } else {
            $this->db->group_by(["client_name", "communication_id"]);
            $this->db->where("added_by", $this->session->user_id);
            $this->db->select(
                "tbl_users.name as user_name, sent_sites.*,COUNT(sent_sites.communication_id) as total"
            );
            $this->db->from("sent_sites");
            $this->db->join("tbl_users", "tbl_users.id = sent_sites.added_by");
            $result = $this->db->get();
            return $result->result_array();
        }
    }

    public function get_all_clients_report()
    {
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Salesperson"
        ) {
            $this->db->group_by(["client_name", "contacted_from"]);
            if ($this->session->role == "Salesperson") {
                $this->db->where("tbl_orders.user_id", $this->session->user_id);
            }
            $this->db->select(
                "tbl_users.name as user_name, tbl_orders.*,COUNT(tbl_orders.client_name) as total,SUM(tbl_orders.client_amount_received) as total_amount,SUM(tbl_orders.proposed_amount) as total_sold,SUM(tbl_orders.content_amount) as content_sold,tbl_clients.name as cname,tbl_clients.contacted_id as cid"
            );
            $this->db->from("tbl_clients");
            $this->db->join(
                "tbl_orders",
                "tbl_orders.client_name = tbl_clients.id"
            );
            $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
            $result = $this->db->get();
            return $result->result_array();
        }
    }

    public function get_all_vendors_report()
    {
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Manage" ||
            $this->session->role == "Operator"
        ) {
            $this->db->group_by(["vendor_email"]);
            $this->db->select(
                "tbl_users.name as user_name, tbl_orders.*,COUNT(tbl_orders.vendor_email) as total,SUM(tbl_orders.site_cost) as total_amount,SUM(tbl_orders.site_cost) as total_sold,SUM(tbl_orders.content_amount) as content_sold,tbl_vendors.name as cname,tbl_vendors.contacted_from as cid,tbl_vendors.email as vemail"
            );
            $this->db->from("tbl_vendors");
            $this->db->join(
                "tbl_orders",
                "tbl_orders.vendor_email = tbl_vendors.email"
            );
            $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
            $result = $this->db->get();
            return $result->result_array();
        }
    }

    public function get_all_vendors_report_payment()
    {
        if (
            $this->session->role == "Admin" ||
            $this->session->role == "Manage"
        ) {
            $this->db->group_by(["vendor_email"]);
            $this->db->where("vendor_payment_status", "Paid");
            $this->db->select(
                "tbl_users.name as user_name, tbl_orders.*,SUM(tbl_orders.vendor_payment_amount) as total_amount,tbl_vendors.name as cname,tbl_vendors.contacted_from as cid,tbl_vendors.email as vmail"
            );
            $this->db->from("tbl_vendors");
            $this->db->join(
                "tbl_orders",
                "tbl_orders.vendor_email = tbl_vendors.email"
            );
            $this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
            $result = $this->db->get()->result_array();
            $emil_array = array_column($result, "vmail");
            $total_array = array_column($result, "total_amount");
            return array_combine($emil_array, $total_array);
            //return $result->result_array();
        }
    }

    public function total_rows_ms()
    {
        $data = $this->db->get_where("tbl_master_sites")->result_array();
        return count($data);
    }

    public function total_rows_ss()
    {
        $data = $this->db->get_where("sent_sites")->result_array();
        return count($data);
    }

    public function get_all_category_ms()
    {
        $this->db->group_by("category");
        $this->db->select("category");
        $this->db->order_by("CHAR_LENGTH(category)", "asc");
        return $this->db->get("tbl_master_sites")->result_array();
    }

    public function get_all_category_ss()
    {
        $this->db->group_by("niche");
        $this->db->select("niche");
        $this->db->order_by("CHAR_LENGTH(niche)", "asc");
        return $this->db->get("sent_sites")->result_array();
    }

    public function get_all_names_ms()
    {
        $this->db->group_by("vendor_name");
        $this->db->select("vendor_name");
        return $this->db->get("tbl_master_sites")->result_array();
    }

    // new vedore agency added
    public function get_all_agency($all)
    {
        $data = $this->input->post();
        //print_r($data);die;
        /*if($data['start_price'] > 0){
			    print_r($data);die;
			}*/
        if (!empty($data)) {
            if (!empty($data["per_category"])) {
                if (!empty($data["niche_choice"])) {
                    $this->db->where("niche", $data["per_category"]);
                } else {
                    $this->db->like("niche", $data["per_category"]);
                }
            }
            if (!empty($data["price_category"])) {
                $this->db->where_in("price_category", $data["price_category"]);
            }
            if (!empty($data["per_name"])) {
                $this->db->where("vendor_name", $data["per_name"]);
            }
            if (
                is_numeric($data["start_price"]) &&
                is_numeric($data["end_price"])
            ) {
                $this->db->where("price>=", $data["start_price"]);
                $this->db->where("price<=", $data["end_price"]);
            }
            if (
                !empty($data["start_selling_price"]) &&
                !empty($data["end_selling_price"])
            ) {
                $this->db->where(
                    "sailing_price>=",
                    $data["start_selling_price"]
                );
                $this->db->where("sailing_price<=", $data["end_selling_price"]);
            }
            if (!empty($data["from_traffic"]) && !empty($data["to_traffic"])) {
                $this->db->where("ahref_traffic>=", $data["from_traffic"]);
                $this->db->where("ahref_traffic<=", $data["to_traffic"]);
            }
            if (!empty($data["start_da"])) {
                $this->db->where("da>=", $data["start_da"]);
                $this->db->where("da<=", $data["end_da"]);
            }
            if (!empty($data["web_category"])) {
                $this->db->where("web_category", $data["web_category"]);
            }

            if (!empty($data["contact_from_id"])) {
                $this->db->where("contact_from_id", $data["contact_from_id"]);
            }
            if (!empty($data["vendor_country"])) {
                $this->db->like("sitename", $data["vendor_country"]);
            }
        } elseif (empty($all)) {
            $this->db->limit(50);
        }

        if (empty($data["duplicate"])) {
            $this->db->group_by(["website"]);
        }

        //$this->db->order_by('price','DESC');
        //$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
        //$this->db->from('tbl_vendors');
        //$this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
        //$this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
        // $result = $this->db->get();
        $result = $this->db->get_where("tbl_agency");
        return $result->result_array();
        //return $this->db->get('tbl_sites')->result_array();
    }

    public function total_rows_agency()
    {
        $data = $this->db->get_where("tbl_agency")->result_array();
        return count($data);
    }

    public function get_all_category_agency()
    {
        $this->db->group_by("niche");
        $this->db->select("niche");
        $this->db->order_by("CHAR_LENGTH(niche)", "asc");
        return $this->db->get("tbl_agency")->result_array();
    }

    public function get_all_names_agency()
    {
        $this->db->group_by("person");
        $this->db->select("person");
        return $this->db->get("tbl_agency")->result_array();
    }

    public function languagedata()
    {
        $this->db->group_by("language");
        $this->db->select("language,COUNT(language) as ltotal");
        $result = $this->db->get("tbl_olt")->result_array();
        return $result;
        //echo '<pre>'; print_r($result);die;
    }

    public function quick_updation()
    {
        $data["status"] = $this->security->xss_clean(
            $this->input->post("status")
        );
        $data["assign_date"] = $this->security->xss_clean(
            $this->input->post("assign_date")
        );
        $data["publish_date"] = $this->security->xss_clean(
            $this->input->post("publish_date")
        );
        $data["publish_url"] = $this->security->xss_clean(
            $this->input->post("publish_url")
        );
        $id = $this->security->xss_clean($this->input->post("update_id"));
        //echo '<pre>'; print_r($data);die;

        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function quick_updation_payment()
    {
        $data["vendor_payment_status"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_status")
        );
        $data["vendor_payment_date"] = $this->security->xss_clean(
            $this->input->post("vendor_payment_date")
        );
        $data["vendor_invoice_status"] = $this->security->xss_clean(
            $this->input->post("vendor_invoice_status")
        );
        $data["actual_paid_amount"] = $this->security->xss_clean(
            $this->input->post("actual_paid_amount")
        );
        $data["vendor_transaction_id"] = $this->security->xss_clean(
            $this->input->post("vendor_transaction_id")
        );
        $id = $this->security->xss_clean($this->input->post("order_id"));
        //echo '<pre>'; print_r($data);die;

        $this->db->where("id", $id);
        $this->db->update("tbl_orders", $data);
        return $this->db->affected_rows();
    }

    public function get_all_ordered_website()
    {
        $this->db->select("COUNT(tbl_orders.website) as total,tbl_sites.*");
        $this->db->group_by(["website"]);
        $this->db->from("tbl_orders");
        $this->db->join("tbl_sites", "tbl_sites.website = tbl_orders.website");
        $result = $this->db->get();
        //echo '<pre>'; print_r($result->result_array());die;
        return $result->result_array();
    }

    public function get_all_order_numbers()
    {
        $this->db->select("order_number");
        $this->db->distinct("order_number");
        $this->db->from("tbl_orders");
        $result = $this->db->get();
        //echo '<pre>'; print_r($result->result_array());die;
        return $result->result_array();
    }

    public function do_update_invoices()
    {
        $data["invoice_no"] = $this->security->xss_clean(
            $this->input->post("invoice_number")
        );
        $order_numbers = $this->security->xss_clean(
            $this->input->post("order_numbers")
        );
        //echo '<pre>'; print_r($order_numbers);die;
		if($order_numbers){
			$this->db->where_in("order_number", $order_numbers);
			$this->db->update("tbl_orders", $data);
			return $this->db->affected_rows();
		}else{
			return false;
		}
    }

	public function do_bulk_update_invoices()
    {
        $invoices = $this->security->xss_clean(
            $this->input->post("invoice_numbers")
        );
		$novoice_array = explode(",", $invoices); 
        $data["client_amount_received_status"] = 'Received';
        //echo '<pre>'; print_r($novoice_array);die;
		if($invoices){
			$this->db->where_in("invoice_no", $novoice_array);
			$this->db->update("tbl_orders", $data);
			return $this->db->affected_rows();
		}else{
			return false;
		}
    }

	public function get_all_published_url()
    {
	 $this->db->select("tbl_clients.name as clients_name,tbl_clients.site_name  as cnishe,tbl_orders.id,tbl_orders.order_number,tbl_orders.publish_url,tbl_orders.remark");
		$this->db->where("tbl_orders.publish_url!="," ");
        $this->db->from("tbl_clients");
        $this->db->join(
            "tbl_orders",
            "tbl_orders.client_name = tbl_clients.id"
        );
		$this->db->join("tbl_users", "tbl_users.id = tbl_orders.user_id");
		//$this->db->join("tbl_sites", "tbl_sites.website = tbl_orders.website");
        $result = $this->db->get();
        return $result->result_array();
    }
	
	public function get_website_data() {
		$this->db->select('website,da,pa');
		$this->db->distinct('website');
		$this->db->from('tbl_sites');
		$this->db->limit(300);
        $query = $this->db->get()->result_array();
		$websites = array_column($query, 'website');
		$da = array_column($query, 'da');
		$pa = array_column($query, 'pa');
		$main_array = ['website'=>implode(', ', $websites),'da'=>implode(', ', $da),'pa'=>implode(', ', $pa)];
		return $main_array;
        echo '<pre>'; print_r($main_array);die();
    }

	public function get_website_data2() {
		$this->db->select('website,da,pa');
		$this->db->distinct('website');
		$this->db->from('tbl_sites');
		$this->db->limit(300);
        $query = $this->db->get()->result_array();
		$websites = array_column($query, 'website');
		$da = array_column($query, 'da');
		$pa = array_column($query, 'pa');
		$main_array = ['website'=>implode(', ', $websites),'da'=>implode(', ', $da),'pa'=>implode(', ', $pa)];
		//return $main_array;
        echo '<pre>'; print_r($main_array);die();
    }
	
	public function get_gpt_data($query) {
		//echo '<pre>'; print_r($query);die();
		//$main_query = explode('sql',$query);
		//$final_array = explode('sql',$main_query);
		//$query = $this->db->query(strstr($main_query[1], ';', true). ";");
		//echo '<pre>'; print_r($query);die();
		$query = $this->db->query($query);
		$results = $query->result_array();
		$text = "";
		foreach ($results as $item) {
			foreach ($item as $key => $value) {
				$text .= $value . "\t";
			}
			$text .= "\n";
		}
		//$last_query = $this->db->last_query();
		//echo '<pre>'; print_r($results);die();
		//$main_output = $this->format_tabular_data($results);
		return $text;
		//echo '<pre>'; print_r($main_output);die();
    }

	public function format_tabular_data($data) {
		$output = "";
		$header = array('Website', 'Domain Authority', 'Page Authority');

		$output .= sprintf("%-25s %-18s %-15s\n", ...$header);

		foreach ($data as $row) {
			$output .= sprintf("%-25s %-18s %-15s\n", $row['website'], $row['da'], $row['pa']);
		}

		return $output;
	}
	
	                public function getEmployees($postData) {
                        $hideshow = $this->db->get_where('hideshow',['table_name' => 'testing'])->row_array();
                    if(isset($hideshow)){
                        if($postData){
                    $showColumns = implode(",",array_keys($postData));
                    $this->db->update('hideshow',['show_columns' => $showColumns]);
                    }
                    $finalhideshow = $this->db->get_where('hideshow',['table_name' => 'testing'])->row_array();
                    $this->db->select($finalhideshow['show_columns']);
                    $result = $this->db->get('testing')->result_array();
                    $skkd = explode(",",$finalhideshow['show_columns']);
                    return ['employees'=>$result,'showColumns'=>array_flip($skkd)];
                    }
                    else{
            if($postData){
                //$viewName = $this->input->post('view_name');
                $showColumns = implode(",",array_keys($postData));
                $this->db->insert("hideshow", ['table_name' => 'testing','show_columns' => $showColumns]);
            }

            
            $result = $this->db->get('testing')->result_array();
            //print_r($result);die;
            return ['employees'=>$result,'showColumns'=>array_flip(array('Name','Email','City','Country','Age','Position','Address'))];
        }
        
        
    }
    
    


    public function getformdata() {
        $formarray = $this->input->post();
        $this->db->insert('formtable', $formarray);

    }

    public function create() {
        $formData = $this->input->post();
        $formData['created_at'] = date('Y-m-d');
        //print_r($formData);die;
        $this->db->insert('users', $formData);
    }

 
    public function all() {
        return $users = $this->db->get('users')->result_array();
    }

    public function all_users() {
        return $forms = $this->db->get('formtable')->result_array();
    }

    public function getuser($userid) {
        $this->db->where('user_id',$userid);
        return $this->db->get('users')->row_array();
         
}

                            public function updateuser($userid, $formarray)
                        {
                            $this->db->where('user_id', $userid); // Use $userid to specify the record to update
                            $this->db->update('users', $formarray); // Use 'update' instead of 'updates'
                            return $this->db->affected_rows() > 0;
    
    
                        }



                    public function deleteuser($userid) 
                {
                    $this->db->where('user_id',$userid);
                    $this->db->delete('users');
                     
                }



                        public function news()
                    {
                        return $this->db->get('news')->result_array();
                    }



                    public function create_entry() {
                        $formData = $this->input->post();
                        $viewName = $formData['view_name'];
                        unset($formData['view_name']);
                        
                        // Extract the names of checked fields
                        $selectedColumns = array();
                        foreach ($formData as $fieldName => $fieldValue) {
                            if ($fieldValue === 'on') {
                                $selectedColumns[] = $fieldName;
                            }
                        }
                       
                        // Convert the array of selected columns to a comma-separated string
                        $showColumns = implode(",", $selectedColumns);
                        
                        $data = array(
                            'view_name' => $viewName,
                            'selected_columns' => $showColumns
                        );
                        
                        $this->db->insert('user_view_preferences', $data);
                    }
                
        public function getSelectedUserData() 
        {
                    $formData = $this->input->post();
                    $viewName = $formData['view_name'];
                    unset($formData['view_name']);          
                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                    //print_r($userPreferences);
                    if(isset($userPreferences)){
                        if($formData)
                {
                    $showColumns = implode(",",array_keys($formData));
                    $this->db->where('view_name',$viewName);
                    $this->db->update('user_view_preferences',['selected_columns' => $showColumns]);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
            else
            {
                    if($formData)
                {
                    $selectedColumns = array();
                    foreach ($formData as $fieldName => $fieldValue) {
                    if ($fieldValue === 'on') {
                        $selectedColumns[] = $fieldName;
                    }
                    }   
            
                    // Convert the array of selected columns to a comma-separated string
                    $showColumns = implode(",", $selectedColumns);
                
                    $data = array(
                    'view_name' => $viewName,
                    'selected_columns' => $showColumns
                    );
                
                    $this->db->insert('user_view_preferences', $data);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
        }

        public function getSelectedUserData1($data)
        {
            //print_r($data);die;
            if (empty($data)) {
                return null; // or any other desired behavior when $data is empty
            }
            else{
                    $formData = $data;
                    //print_r($formData);die;
                   $viewName = $formData['view_name'];
                    //print_r($viewName);die;
                    unset($formData['view_name']);
                    //print_r($viewName);print_r($formData);die;         
                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                    //print_r($userPreferences);
                    if(isset($userPreferences)){
                        if($formData)
                {
                    $showColumns = implode(",",array_keys($formData));
                    $this->db->where('view_name',$viewName);
                    $this->db->update('user_view_preferences',['selected_columns' => $showColumns]);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                //echo '<pre>'; print_r($result);
                //echo '<pre>'; print_r($finalhideshow);die;
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
            else
            {
                    if($formData)
                {
                    //print_r($formData);die;
                    $selectedColumns = array();
                    foreach ($formData as $fieldName => $fieldValue) {
                    if ($fieldValue === 'on') {
                        $selectedColumns[] = $fieldName;
                    }
                    }   
            
                    // Convert the array of selected columns to a comma-separated string
                    $showColumns = implode(",", $selectedColumns);
                
                    $data = array(
                    'view_name' => $viewName,
                    'selected_columns' => $showColumns
                    );
                
                    $this->db->insert('user_view_preferences', $data);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                //$user_view_preferences['selected_columns'] = array_flip($user_view_preferences['selected_columns']);
                
                //echo '<pre>'; print_r($finalhideshow);
                //echo '<pre>'; print_r($result);die;
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
        }
        }

        public function testing() 
        {
            $data = $this->input->post();
           // print_r($data); // Check if $data contains expected data
            $result = $this->getSelectedUserData1($data);
            //echo '<pre>'; print_r($result);die;
            return $result;
        }
        


                            public function getviewname() 
                        {                
                            $this->db->select('view_name');
                            $result = $this->db->get('user_view_preferences')->result_array();
                            return $viewNames = array_column($result, 'view_name');
                            
                        }


                        public function gettestingdata()
                        {
                            return $this->db->get('testing')->result_array();
                        }




                        public function filterData($selectedField, $selectedOperator, $enteredValue, $andor) {
                            //print_r($selectedField);print_r($selectedOperator);print_r($enteredValue);die;
                            
                            $filteredData = array();
                            $sql = "SELECT * FROM testing WHERE ";
                            
                            for ($i = 0; $i < count($selectedField); $i++) {
                                switch ($selectedOperator[$i]) {
                                    case 'contains':
                                        $sql .= $selectedField[$i] . " LIKE '%" . $enteredValue[$i] . "%'";
                                        break;
                                    case 'does not contain':
                                        $sql .= $selectedField[$i] . " NOT LIKE '%" . $enteredValue[$i] . "%'";
                                        break;
                                    case 'is':
                                        $sql .= $selectedField[$i] . " = '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is not':
                                        $sql .= $selectedField[$i] . " != '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is empty':
                                        $sql .= $selectedField[$i] . " = ''";
                                        break;
                                    case '>':
                                        $sql .= $selectedField[$i] . " > '" . $enteredValue[$i] . "'";
                                        break;
                                    case '>=':
                                        $sql .= $selectedField[$i] . " >= '" . $enteredValue[$i] . "'";
                                        break;
                                    case '<=':
                                        $sql .= $selectedField[$i] . " <= '" . $enteredValue[$i] . "'";
                                        break;
                                    case '<':
                                        $sql .= $selectedField[$i] . " < '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is not empty':
                                        $sql .= $selectedField[$i] . " != ''";
                                        break;
                                    default:
                                        // Handle other cases or errors as needed
                                        break;
                                        
                                }
                        
                                // If there are more conditions and an AND/OR condition is specified, add it
                                if ($i < count($selectedField) - 1 && isset($andor[$i])) {
                                    $sql .= " " . $andor[$i] . " ";
                                }
                            }
                            
                            $query = $this->db->query($sql); // Execute the query
                            //print_r($sql);die;
                        
                            // Check if the query was successful
                            if ($query) {
                                // Fetch the result data
                                $filteredData = $query->result_array();
                                //print_r($filteredData);die;
                            
                            }
                        
                            return $filteredData;
                        }
                        
                        

                    public function filterData1($selectedField, $selectedOperator, $enteredValue, $andor)
                    {
                        $filteredData = array();
                        $this->db->select('*');
                            for ($i = 0; $i < count($selectedField); $i++){
                                if($i == 0){
                                    $this->db->where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                }
                                if($i > 0){
                                    if($andor[$i-1]=='or'){
                                        $this->db->or_where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                    }
                                    else{
                                        $this->db->where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                    }
                                    
                                }
                                $query = $this->db->get('testing');
                                if ($query) {
                                    $filteredData = $query->result_array();
                                }
                                return $filteredData;
                        }
                    }

                                public function combined() 
                            {
                               
                               
                            }

                    
                                public function testing2($data) {
                                    if (empty($data)) {
                                        //print_r('sakshi');die;
                                        return null; // or any other desired behavior when $data is empty
                                    }
                                    //print_r($data);die;
                                    $viewName = $data['view_name'];
                                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                                    unset($data['view_name']);
                                    $showColumns = implode(",",array_keys($data));
                                    //print_r($showColumns);die;
                                
                                    if ($userPreferences) {
                                        $this->db->where('view_name', $viewName);
                                        $this->db->update('user_view_preferences', ['selected_columns' => $showColumns]);
                                    } else {
                                        $data = [
                                            'view_name' => $viewName,
                                            'selected_columns' => $showColumns
                                        ];
                                        $this->db->insert('user_view_preferences', $data);
                                    }
                                
                                    $this->db->select($showColumns);
                                    $result = $this->db->get('testing')->result_array();
                                    //print_r($result);die;
                                
                                    return [
                                        'testing' => $result,
                                        'user_view_preferences' => explode(",", $showColumns),
                                    ];
                                }
                                
                            }
/* if (empty($data)) {
                return null; // or any other desired behavior when $data is empty
            }
            else{
                    $formData = $data;
                    //print_r($formData);die;
                   $viewName = $formData['view_name'];
                    //print_r($viewName);die;
                    unset($formData['view_name']);
                    //print_r($formData);die;         
                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                    //print_r($userPreferences);
                    if(isset($userPreferences)){
                        if($formData)
                {
                    $showColumns = implode(",",array_keys($formData));
                    $this->db->where('view_name',$viewName);
                    $this->db->update('user_view_preferences',['selected_columns' => $showColumns]);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
            else
            {
                    if($formData)
                {
                    print_r($formData);die;
                    $selectedColumns = array();
                    foreach ($formData as $fieldName => $fieldValue) {
                    if ($fieldValue === 'on') {
                        $selectedColumns[] = $fieldName;
                    }
                    }   
            
                    // Convert the array of selected columns to a comma-separated string
                    $showColumns = implode(",", $selectedColumns);
                
                    $data = array(
                    'view_name' => $viewName,
                    'selected_columns' => $showColumns
                    );
                
                    $this->db->insert('user_view_preferences', $data);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            } */










































































                






                














                              /* if($selectedOperator == 'contains'){
                            // Build the SQL query
                            $sql = "SELECT * FROM testing WHERE $selectedField LIKE '%$enteredValue%'";
                            $query = $this->db->query($sql); // Execute the query with the entered value as a parameter
                            return $query->result_array();   // Return the result as an array of rows
                        }
                            elseif($selectedOperator == 'does not contain'){
                                $sql = "SELECT * FROM testing WHERE $selectedField NOT LIKE '%$enteredValue%'";
                                $query = $this->db->query($sql);
                                return $query->result_array();
                            }
                            elseif($selectedOperator == 'is'){
                                $sql = "SELECT * FROM testing WHERE $selectedField = '$enteredValue'" ; 
                                $query = $this->db->query($sql);
                                return $query->result_array();
                            } 
                            elseif($selectedOperator == 'is not'){
                                $sql = "SELECT * FROM testing WHERE $selectedField != '$enteredValue'" ;  
                                $query = $this->db->query($sql);
                                return $query->result_array();
                            }
                            elseif($selectedOperator == 'is empty')
                            {
                                if(empty($enteredValue)){
                                    $sql = "SELECT * FROM testing WHERE $selectedField = ''";
                                    $query = $this->db->query($sql);
                                    return $query->result_array();
                                }
                                
                            
                            else{
                                $sql = "SELECT * FROM testing WHERE $selectedField != ''" ; 
                                $query = $this->db->query($sql);
                                return $query->result_array();
                            }

                        }   
                    
                
                //IF User Entered More Than One Condition
                else {
                    //echo '<pre>'; print_r($selectedField);echo '<pre>'; print_r($selectedOperator);echo '<pre>'; print_r($enteredValue);echo '<pre>'; print_r($andor);echo '<pre>'; print_r($tableHeaderSec);echo '<pre>'; print_r($textOperatorSec);echo '<pre>'; print_r($userInputSec);die;
                    if($andor == 'or')
                {
                        //echo 'sakshi';
                        if($selectedOperator == 'contains'|| $textOperatorSec== 'is empty')
                    {
                        //echo 'Cosmic';die;
                        $sql = "SELECT * FROM testing WHERE $selectedField LIKE '%$enteredValue%' OR $tableHeaderSec = ''";
                        $query = $this->db->query($sql); // Execute the query with the entered value as a parameter
                        return $query->result_array();   // Return the result as an array of rows
                       
                    }
                }
                    else{//AND
                        if($selectedOperator == 'contains' && $textOperatorSec== 'is empty')
                    {
                        //echo 'Cosmic';die;
                        $sql = "SELECT * FROM testing WHERE $selectedField LIKE '%$enteredValue%' AND $tableHeaderSec = ''";
                        $query = $this->db->query($sql); // Execute the query with the entered value as a parameter
                        return $query->result_array();   // Return the result as an array of rows
                       
                    }
                    }
                }*/
                        
            



                       /* public function filterData1($selectedField, $selectedOperator, $enteredValue)
                        {
                            // Initialize the SQL query string
                            $sql = "SELECT * FROM testing";
                        
                            // Use a switch statement to construct the WHERE clause based on $selectedOperator
                            switch ($selectedOperator) {
                                case '=':
                                case 'Is':
                                    $sql .= " WHERE $selectedField = '$enteredValue'";
                                    break;
                                case 'Contains':
                                    $sql .= " WHERE $selectedField LIKE '%$enteredValue%'";
                                    break;
                                case 'Empty':
                                    $sql .= " WHERE $selectedField IS NULL";
                                    break;
                                case 'Not Empty':
                                    $sql .= " WHERE $selectedField IS NOT NULL";
                                    break;
                                default:
                                    // Handle other operators or provide a default case as needed
                                    break;
                            }
                          // Execute the query
                            $query = $this->db->query($sql);
                            // Return the result as an array
                            return $query->result_array();
                        }
                         public function filterData2($selectedField, $selectedOperator, $enteredValue){
                            //print_r($selectedField);print_r($selectedOperator);die;
                                  if($selectedOperator == 'is empty'){
                                $sql = "SELECT * FROM testing WHERE $selectedField IS NULL" ;
                                $query = $this->db->query($sql);
                                
                                return $query->result_array();
                                print_r($query);die;
                            }
                            else{
                                $sql = "SELECT * FROM testing WHERE $selectedField IS NOT NULL" ;
                                $query = $this->db->query($sql);
                                return $query->result_array();
                                print_r($query);die;
                            }
                        }
                        */

                        


                  


                       
                    
                    




