<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id     = $ci->session->userdata('role_id');
        $ctrl         = $ci->uri->segment(1);

        $queryMenu    = $ci->db->get_where('user_menu', ['controller' => $ctrl])->row_array();
        $menu_id    = $queryMenu['id'];

        $userAccess    = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
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

function simadu($nopen, $simadu)
{
    $ci = get_instance();

    $result = $ci->db->get_where('datul', ['nopen' => $nopen, 'simadu' => '1']);

    $result1 = $ci->db->get_where('datul', ['nopen' => $nopen]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }

    if ($result1->num_rows() < 1) {
        return "disabled";
    }
}

function pinjam($npk)
{
    $ci = get_instance();

    $result = $ci->db->get_where('dbpm_pa', [
        'noreg' => $npk
    ]);

    if ($result->num_rows() > 0) {
        //return "value='".$result[nama_pes]."'";
        return "disabled";
    }
}

function surat($id, $status)
{
    $ci = get_instance();

    $result = $ci->db->get_where('surat_masuk', [
        'id' => $id,
        'status' => '1'
    ]);

    $result1 = $ci->db->get_where('surat_masuk', [
        'id' => $id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }

    if ($result1->num_rows() < 1) {
        return "disabled";
    }
}
