
<?php

require_once __DIR__ . '/funcoes.php';

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

// 2. Configurações e contadores
$falhas = contarFalhas($eventos);
$falhasPorUsuario = [];
$limiteAlerta = 3;

// 3. Processamento dos eventos
foreach ($eventos as $evento) {

    if (!is_array($evento) || !eventoValido($evento)) {
        echo "Evento inválido ignorado\n";
        continue;
    }

    $email = $evento['email'];
    $tipo = $evento['tipo'];

    if ($tipo === 'login_failed') {

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
