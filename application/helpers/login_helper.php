<?php

function is_logged_in()
{
    $ci = get_instance(); //memanggil librari ci agar bisa dikenali di helper
    if (!$ci->session->userdata('email')) { //cek jika tidak ada di session redirect ke auth
        redirect('auth');
    } else { //jika ada di session maka cek
        $role_id = $ci->session->userdata('role_id'); //cek role berdasarkan session, 
        $menu = $ci->uri->segment(1); //dapatkan akses menu sesuai role uri->segment(1) berarti url pertama. . . misal aa.com/segment1/segment2/dst

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array(); //query menu sesuai id
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [ //query agar menu yang diakses sesuai dengan rolenya
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) { //jika mengakses menu tidak sesuai dengan rolenya akan di blok ke kontroler auth method blocked
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
