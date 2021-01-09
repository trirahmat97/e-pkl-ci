<?php
function tampilan($halaman, $data = [])
{
    echo view('templates/v_header', $data);
    echo view('templates/v_sidebar', $data);
    echo view('templates/v_topbar', $data);
    echo view($halaman, $data);
    echo view('templates/v_footer', $data);
}
