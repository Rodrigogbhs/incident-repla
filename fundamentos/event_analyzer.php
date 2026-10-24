<?php

// EVENT ANALYZER V3 — IncidentReplay

// 0. Funções
function deveGerarAlerta(int $quantidade, int $limite): bool {
    return $quantidade >= $limite;
}

// 1. Eventos simulados
$eventos = [
    ['email' => 'rodrigogbhs@gmail.com', 'tipo' => 'login_failed'],
    ['email' => 'rodrigogbhs@gmail.com', 'tipo' => 'login_failed'],
    ['email' => 'rodrigogbhs@gmail.com', 'tipo' => 'login_success'],
    ['email' => 'ana@email.com', 'tipo' => 'login_failed'],
    ['email' => 'ana@email.com', 'tipo' => 'login_success'],
    ['email' => 'carlos@email.com', 'tipo' => 'login_failed'],
    ['email' => 'carlos@email.com', 'tipo' => 'login_failed'],
];

// 2. Variáveis de controle
$falhas = 0;
$falhasPorUsuario = [];
$limiteAlerta = 3;

// 3. Processamento dos eventos
foreach ($eventos as $evento) {

    $email = $evento['email'];
    $tipo = $evento['tipo'];

    if ($tipo === 'login_failed') {

        $falhas++;

        // Contabiliza falhas individuais
        if (isset($falhasPorUsuario[$email])) {
            $falhasPorUsuario[$email]++;
        } else {
            $falhasPorUsuario[$email] = 1;
        }

        echo "Falha: $email\n";

    } elseif ($tipo === 'login_success') {

        echo "Sucesso: $email\n";

    } else {

        echo "Evento desconhecido ($tipo): $email\n";
    }
}

// 4. Relatório geral
echo "\nTotal de falhas: $falhas\n";
echo "\nFalhas por usuário:\n";

// 5. Motor de detecção
foreach ($falhasPorUsuario as $email => $quantidade) {

    echo "$email: $quantidade falha(s)\n";

    if (deveGerarAlerta($quantidade, $limiteAlerta)) {
        echo "ALERTA: $email atingiu o limite de $limiteAlerta falhas!\n";
    }
}