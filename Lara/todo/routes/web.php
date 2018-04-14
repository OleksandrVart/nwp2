<?php

use Illuminate\Http\Request;


$router->get('/', function () use ($router) {
    return view('index');
});

$router->get('/todos', function () {
    $todos = app('db')->select("SELECT * FROM todos");
    return response()->json($todos);
});

$router->post('/todos', function (Request $request) {
    $result = app('db')->insert("INSERT INTO todos SET title = ? ", [$request->input('title')]);
    return response()->json([
        'success' => $result,
        'id' => app('db')->getPdo()->lastInsertId()
    ]);
});

$router->delete("/todo/{id}", function ($id) {
    $result = app('db')->delete("DELETE FROM todos WHERE id = ?", [$id]);
    return response()->json(['success' => $result]);
});
