
<?php

// Verifica se o evento possui e-mail e tipo válidos.
function eventoValido(array $evento): bool {
    $email = $evento['email'] ?? null;
    $tipo = $evento['tipo'] ?? null;

    return is_string($email)
        && trim($email) !== ''
        && is_string($tipo)
        && trim($tipo) !== '';
}

// Decide se o número de falhas atingiu o limite.
function deveGerarAlerta(int $quantidade, int $limite): bool {
    return $quantidade >= $limite;
}

// Conta apenas falhas de eventos válidos.
function contarFalhas(array $eventos): int {
    $total = 0;

    foreach ($eventos as $evento) {
        if (!is_array($evento) || !eventoValido($evento)) {
            continue;
        }

        if ($evento['tipo'] === 'login_failed') {
            $total++;
        }
    }

    return $total;
}
