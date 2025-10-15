<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function normalizeSlug(string $slug): string
{
    $slug = mb_strtolower($slug);
    $slug = str_replace(['/', ' ', '.'], ['-', '-', '-'], $slug);
    return preg_replace('/[^a-zA-Z0-9\-]/', '', $slug);
}

