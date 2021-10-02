<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function index();

    public function store($objUpdate, $inputs);

    public function update($objUpdate, $inputs);

    public function show($id);

    public function destroy($id);
}
