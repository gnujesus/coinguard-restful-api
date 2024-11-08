<?php

test('that status is 200 on successful authentication', function () {
    $response = $this->post('/api/login', ['username' => 'jondoe', 'password' => 'password']);

    $response->assertStatus(200);
});

test('that status is 401 on invalid credentials', function () {
    $response = $this->post('/api/login', ['username' => 'alberto', 'password' => 'caffaretti']);

    $response->assertStatus(401);
});

test('that status is 200 on logout', function () {
    $loginResponse = $this->post('/api/login', ['username' => 'jondoe', 'password' => 'password']);

    $sanctumToken = $loginResponse->json('token');

    $logoutResponse = $this->withHeaders([
        'Authorization' => "Bearer $sanctumToken",
    ])->post('/api/logout');

    $logoutResponse->assertStatus(200);
});

test('that status is 200 on retrieved currently logged in user information', function () {
    $loginResponse = $this->post('/api/login', ['username' => 'jondoe', 'password' => 'password']);

    $sanctumToken = $loginResponse->json('token');

    $response = $this->withHeaders([
        'Authorization' => "Bearer {$sanctumToken}",
    ])->get('/api/me');

    $response->assertStatus(200);
});