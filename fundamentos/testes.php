
<?php

require_once __DIR__ . '/funcoes.php';

// Teste 01 — Array vazio: esperado 0
$resultado01 = contarFalhas([]);

if ($resultado01 === 0) {
    echo "[OK] Teste 01 passou\n";
} else {
    echo "[ERRO] Teste 01: esperado 0, obtido $resultado01\n";
}

// Teste 02 — Somente sucessos: esperado 0
$eventosTeste02 = [
    ['email' => 'ana@email.com', 'tipo' => 'login_success'],
    ['email' => 'ana@email.com', 'tipo' => 'login_success'],
    ['email' => 'carlos@email.com', 'tipo' => 'login_success'],
];

$resultado02 = contarFalhas($eventosTeste02);

if ($resultado02 === 0) {
    echo "[OK] Teste 02 passou\n";
} else {
    echo "[ERRO] Teste 02: esperado 0, obtido $resultado02\n";
}

// Teste 03 — Duas falhas e um sucesso: esperado 2
$eventosTeste03 = [
    ['email' => 'ana@email.com', 'tipo' => 'login_failed'],
    ['email' => 'carlos@email.com', 'tipo' => 'login_failed'],
    ['email' => 'ana@email.com', 'tipo' => 'login_success'],
];

$resultado03 = contarFalhas($eventosTeste03);

if ($resultado03 === 2) {
    echo "[OK] Teste 03 passou\n";
} else {
    echo "[ERRO] Teste 03: esperado 2, obtido $resultado03\n";
}

// Teste 04 — Registros incompletos: esperado 1
$eventosTeste04 = [
    ['email' => 'ana@email.com', 'tipo' => 'login_failed'],
    ['email' => 'ana@email.com', 'tipo' => 'login_success'],
    ['email' => 'ana@email.com'],
    ['tipo' => 'login_failed'],
    ['email' => '   ', 'tipo' => 'login_failed'],
];

$resultado04 = contarFalhas($eventosTeste04);

if ($resultado04 === 1) {
    echo "[OK] Teste 04 passou\n";
} else {
    echo "[ERRO] Teste 04: esperado 1, obtido $resultado04\n";
}

// Teste 05 — Regras de alerta
if (deveGerarAlerta(2, 2) && !deveGerarAlerta(2, 3)) {
    echo "[OK] Teste 05 passou\n";
} else {
    echo "[ERRO] Teste 05 falhou\n";
}
