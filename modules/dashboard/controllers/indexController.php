<?php

function construct()
{
    load_model('dashboard');
    load('helper', 'format');
}


function indexAction()
{

    load_view('dashboard');
}


function search_billAction()
{
    if (!isset($_POST['btn-search']) || empty($_POST['search'])) {
        redirect('?mod=dashboard&controller=index&action=index');
    }
    load_view('search_bill');
}
