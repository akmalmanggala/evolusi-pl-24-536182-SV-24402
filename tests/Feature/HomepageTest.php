<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * Uji apakah halaman beranda dapat diakses dengan sukses.
     */
    public function test_homepage_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Uji apakah halaman beranda memuat teks judul praktikum.
     */
    public function test_homepage_contains_course_title(): void
    {
        $response = $this->get('/');

        $response->assertSee('Evolusi Perangkat Lunak');
        $response->assertSee('Branching Strategy');
    }
}
