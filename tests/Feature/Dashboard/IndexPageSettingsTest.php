<?php

use App\Models\User;

it('can not acces to index page settings without authentication', function () {
    $this->get(route('dashboard.page.index'))->assertRedirect(route('login'));
});

it('can see index page settings without blocks ', function () {
    $owner = User::factory()->create();
    $this->actingAs($owner)->get(route('dashboard.page.index'))->assertOk();

    $this->assertSee('My Page');
    
});