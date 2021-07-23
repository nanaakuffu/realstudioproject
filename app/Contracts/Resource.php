<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface Resource
{
    public function index(): View;

    public function store(Request $request): JsonResponse;

    public function show(int $id): JsonResponse;

    public function update(Request $request, int $id): JsonResponse;

    public function destroy(int $id): JsonResponse;
}
